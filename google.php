<?php

require_once('api/Simpla.php');
$simpla = new Simpla();
$currency = $simpla->money->get_currency();

header("Content-type: text/xml; charset=UTF-8");
print (pack('CCC', 0xef, 0xbb, 0xbf));
// Заголовок
print
"<?xml version='1.0' encoding='UTF-8'?>

<rss xmlns:g='http://base.google.com/ns/1.0' version='2.0'>
<channel>
<title>".$simpla->settings->site_name."</title>
<link>".$simpla->config->root_url."</link>";

//$stock_filter = $simpla->settings->google_export_not_in_stock ? '' : ' AND (v.stock >0 OR v.stock is NULL) ';
// Товары
$simpla->db->query("SET SQL_BIG_SELECTS=1");

$simpla->db->query("SELECT  /* p.google_category_name,*/
                            p.google, p.body, p.name as product_name, p.id as product_id, p.url, p.annotation, pc.category_id,
                            b.name as brand_name,
                            v.google_stock, v.sku, v.price, v.id as variant_id, v.name as variant_name, v.position as variant_position, v.stock, v.compare_price
					FROM __variants v
					LEFT JOIN __products p ON v.product_id=p.id
					LEFT JOIN __products_categories pc ON p.id = pc.product_id
					  AND pc.position=(SELECT MIN(position) FROM __products_categories WHERE product_id=p.id LIMIT 1)
                    LEFT JOIN __brands b on (b.id = p.brand_id) 
					WHERE p.visible AND p.google = 1 ".$stock_filter." GROUP BY v.id ORDER BY p.id, v.position ");
                                        
$prev_product_id = null;

$products = $simpla->db->results();
$p_ids = array();
foreach ($products as $p) {
    if (!in_array($p->product_id, $p_ids)) {
        $p_ids[] = $p->product_id;
    }
}
$p_images = array();
foreach($simpla->products->get_images(array('product_id' => $p_ids)) as $image) {
    $p_images[$image->product_id][] = $image->filename;
}
foreach($products as $p) {
    $variant_url = '';
    if ($prev_product_id === $p->product_id) {
        $variant_url = '?variant='.$p->variant_id;
    }
    $prev_product_id = $p->product_id;

    // Доступность товара (МОжно было сделать через активность/неактивность товара (простой способ) - ($v->google_stock == 1 ? "in stock" : $p->google_out_of_stock))
    switch($p->google_stock){
        case '0':
            $avaliable = 'out of stock';
            break;
        case '1':
            $avaliable = 'in stock';
            break;
        case '2':
            $avaliable = 'preorder';
            break;
    }

    // ID товара
    if($p->sku)
        $sku = strip_tags($p->sku);
    else
        $sku = $p->variant_id;

    
    $price = round($simpla->money->convert($p->price, $currency->id, false),2);
    print "
    <item>
    <title><![CDATA[".(strip_tags($p->product_name)).($p->variant_name ? " ".(strip_tags($p->variant_name)) : '')."]]></title>
    <link><![CDATA[".$simpla->config->root_url.'/products/'.$p->url.$variant_url."]]></link>
    <description><![CDATA[".(strip_tags($p->annotation))."]]></description>
    <g:id><![CDATA[".$sku."]]></g:id>
    <g:condition>new</g:condition>
    <g:price>$price ".$currency->code."</g:price>
    <g:availability>".$avaliable."</g:availability>
    <g:brand><![CDATA[".(strip_tags($p->brand_name))."]]></g:brand>";

    if($p->google_category_name) {
        print "<g:google_product_category ><![CDATA[".(strip_tags($p->google_category_name))."]]></g:google_product_category >";
    }

    if(!empty($p_images[$p->product_id])) {
        foreach($p_images[$p->product_id] as $i => $img) {
            if ($i == 0) {
                print "<g:image_link><![CDATA[".$simpla->design->resize_modifier($img, 800, 600)."]]></g:image_link>";
            } else {
                print "<g:additional_image_link><![CDATA[".$simpla->design->resize_modifier($img, 800, 600)."]]></g:additional_image_link>";
            }
            if ($i == 9) {
                break;
            }
        }
    }
    
    print "</item>";
}
print "</channel></rss>";