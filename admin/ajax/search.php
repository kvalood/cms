<?php
	require_once('../../api/Simpla.php');
	$simpla = new Simpla();
	$limit = 100;


	$keyword = $simpla->request->get('query', 'string');
	$object = $simpla->request->get('object', 'string');

    $suggestions = array();

    switch ($object) {

        // Поиск статей
        case 'articles':
            $filter = ['keyword' => $keyword, 'limit' => $limit];
            $data = $simpla->article->get_articles($filter);

            foreach($data as $d)
            {
                $suggestion = new stdClass();
                $suggestion->value = $d->name." ($d->id)";
                $suggestion->data = $d;
                $suggestions[] = $suggestion;
            }
            break;

        case 'articles_category':
            $filter = ['keyword' => $keyword];
            $data = $simpla->article->get_article_category($filter);

            foreach($data as $d)
            {
                $suggestion = new stdClass();
                $suggestion->value = $d->name." ($d->id)";
                $suggestion->data = $d;
                $suggestions[] = $suggestion;
            }
            break;
    }



	$res = new stdClass;
	$res->query = $keyword;
	$res->suggestions = $suggestions;
	header("Content-type: application/json; charset=UTF-8");
	header("Cache-Control: must-revalidate");
	header("Pragma: no-cache");
	header("Expires: -1");
	print json_encode($res);