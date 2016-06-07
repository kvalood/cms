<?PHP

/**
 * Simpla CMS
 * Представление для Карты сайта HtmL
 */
 
require_once('View.php');

class SitemapView extends View
{
    function fetch()
    {
        // Товары
        $categories = $this->categories->get_categories_tree();
        $this->getProducts($categories);
        $this->design->assign('categories', $categories);

        // Материалы
        $articles = array();

        // Материалы в категориях
        $articles_cat = array();

        $materials = array();
        // материалы из меню и подкатегорий меню. (Только видимые)
        foreach($this->menu->all_list_id($filter['visible'] = 1) as $menu_item)
        {
            if($menu_item->type==1 && $menu_item->home!=1)
            {
                //Выводим все корневые материалы
                $article = $this->article->get_article((int) $menu_item->id_show);
                if($article->visible==1)
                {
                    $articles[$article->id] = array('url' => $menu_item->url, 'name' => $article->name);
                    $materials[$menu_item->position] = $articles[$article->id];
                }
            }
            elseif($menu_item->type==2 && $menu_item->home!=1)
            {
                //выводим все материалы категории (С только отображаемой категорией на сайте)
                $articles_cat[$menu_item->id_show] = array('name' => $menu_item->name, 'url' => $menu_item->url, 'articles' => array());

                $art = array();
                foreach($this->article->get_articles(array('id' => $menu_item->id_show, 'visible' => 1)) as $a_cat)
                {
                    $art[$a_cat->id] = array( 'name' => $a_cat->name, 'url' => $menu_item->url.'/'.$a_cat->url);
                    $articles_cat[$menu_item->id_show]['articles'] += $art;
                    $materials[$menu_item->position] = $articles_cat[$menu_item->id_show];
                }
            }
        }

        $this->design->assign('materials', $materials);
        return $this->design->fetch('sitemap.tpl');
    }

    private function getProducts($categories)
    {
        foreach ($categories as &$category) {
            $category->products = $this->products->get_products(array('category_id' => $category->children));
            if (isset($category->subcategories)) {
                $this->getProducts($category->subcategories);
            }
        }
    }
}