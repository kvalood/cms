<?php
require_once('Simpla.php');

class Article extends Simpla
{

	/***
	*	Работа с материалами
	*/


	//Отобразить все статьи.
	public function get_all_articles()
	{
		$query = $this->db->placehold('SELECT id,name,date,visible,category FROM __article WHERE id ORDER BY date DESC, id DESC LIMIT 0,10000');
		$this->db->query($query);
		return $this->db->results();
	}

	//Отображение статей
	public function get_articles($filter = array())
	{
		$category_filter = '';
		$keyword_filter = '';
		$limit = '';
		$page = 1;
		$visible_filter = '';

		$select = '';
		$inner = '';

		$sort = 'a.name';

		if(isset($filter['id']))
		{
			$category_filter = $this->db->placehold('AND a.category=?', $filter['id']);

			//Сортировка статей
			$cat = $this->article->get_category($filter['id']);

			if(!empty($cat->sorting_method))
				$sort = $this->db->placehold("a.$cat->sorting_method ");

			if(!empty($cat->sorting_type))
				$sort .= $cat->sorting_type;
		}


		if(!empty($filter['keyword']))
		{
			$keywords = explode(' ', $filter['keyword']);
			foreach($keywords as $keyword)
				$keyword_filter .= $this->db->placehold(' AND (name LIKE "%'.$this->db->escape(trim($keyword)).'%" OR meta_keywords LIKE "%'.$this->db->escape(trim($keyword)).'%") ');
		}

		if(!empty($filter['limit']))
			$limit = $this->db->placehold(' LIMIT ?,?',0,$filter['limit']);

		if(isset($filter['page']))
		{
			if(isset($filter['limit']))
			{
				$limit = max(1, intval($filter['limit']));
			}
			$page = max(1, intval($filter['page']));
			$limit = $this->db->placehold(' LIMIT ?, ? ', ($page-1)*$limit, $limit);
		}

		if(isset($filter['visible']))
			$visible_filter = $this->db->placehold('AND a.visible = ?', intval($filter['visible']));

		//Для показа полных URL (при выводе блока "список материалов категории")
		if(!empty($filter['all_url']))
		{
			$select = ', c.url as category_url';
			$inner = $this->db->placehold('INNER JOIN __article_categories as c ON a.category = c.id');
		}

		$query = $this->db->placehold("
			SELECT a.id,a.name,a.url,a.annotation,a.text,a.visible,a.date,a.category,a.date_update $select
			FROM __article as a 
			$inner
			WHERE 1 $category_filter $visible_filter $keyword_filter 
			ORDER BY $sort $limit");

		$this->db->query($query);
		return $this->db->results();
	}


	//Количество материалов
	public function count_article($filter = array())
	{
		$category_filter = '';
		$keyword_filter = '';
		$visible_filter = '';

		if(isset($filter['id']))
			$category_filter = $this->db->placehold('AND a.category=?', $filter['id']);

		if(!empty($filter['keyword']))
		{
			$keywords = explode(' ', $filter['keyword']);
			foreach($keywords as $keyword)
				$keyword_filter .= $this->db->placehold(' AND (name LIKE "%'.$this->db->escape(trim($keyword)).'%" OR meta_keywords LIKE "%'.$this->db->escape(trim($keyword)).'%") ');
		}

		if(isset($filter['visible']))
			$visible_filter = $this->db->placehold('AND a.visible = ?', intval($filter['visible']));


		$query = $this->db->placehold("SELECT COUNT(DISTINCT id)as count FROM __article as a WHERE 1 $category_filter $visible_filter $keyword_filter");
		$this->db->query($query);

		if($this->db->query($query))
			return $this->db->result('count');
		else
			return false;

	}


	//получить материал
	public function get_article($id)
	{
		if(is_int($id))
			$where = $this->db->placehold(' b.id=? ', intval($id));
		else
			$where = $this->db->placehold(' b.url=? ', $id);

		$query = $this->db->placehold("SELECT b.id, b.url, b.name, b.annotation, b.text, b.meta_title, b.meta_keywords, b.meta_description, b.visible, b.date, b.category, b.date_update, c.url as category_url
            FROM __article as b 
            LEFT JOIN __article_categories as c ON b.category = c.id            
            WHERE $where LIMIT 1");

		if($this->db->query($query))
			return $this->db->result();
		else
			return false;

	}


	//добавить материал
	public function add_article($article)
	{
		if(isset($article->date))
		{
			$date = $article->date;
			unset($article->date);
			$date_query = $this->db->placehold(', date=STR_TO_DATE(?, ?), date_update=STR_TO_DATE(?, ?)', $date, $this->settings->date_format, $date, $this->settings->date_format);
		}
		$query = $this->db->placehold("INSERT INTO __article SET ?% $date_query", $article);

		if(!$this->db->query($query))
			return false;
		else
			return $this->db->insert_id();

	}


	//ОБновить материал
	public function update_article($id, $article)
	{
		$date_update = $this->db->placehold(', date_update=STR_TO_DATE(?, ?)', date('Y-m-d H:i:s'), $this->settings->date_format);
		$query = $this->db->placehold("UPDATE __article SET ?% $date_update WHERE id in(?@) LIMIT ?", $article, (array)$id, count((array)$id));

        if($this->db->query($query))
            return $id;
        else
            return false;
	}


	//Удалить материал
	public function delete_article($id)
	{
		if(!empty($id))
		{
			$query = $this->db->placehold("DELETE FROM __article WHERE id=? LIMIT 1", intval($id));
			if($this->db->query($query))
			{
				return true;
			}
		}
		return false;
	}



	/***
	*	Работа с категориями материалов
	*/

	// Список всех категорий
	public function get_article_category($filter = [])
	{
        $keyword_filter = '';

        if(!empty($filter['keyword']))
        {
            $keywords = explode(' ', $filter['keyword']);
            foreach($keywords as $keyword)
                $keyword_filter .= $this->db->placehold(' AND (name LIKE "%'.$this->db->escape(trim($keyword)).'%"');
        }

		$query = $this->db->placehold("SELECT id, name, template, url FROM __article_categories WHERE 1 $keyword_filter ORDER BY id DESC");
		$this->db->query($query);
		return $this->db->results();
	}

	// Выборка категории
	public function get_category($id)
	{
        if(is_int($id))
            $where = $this->db->placehold(' id=? ', intval($id));
        else
            $where = $this->db->placehold(' url=? ', $id);

		$query = $this->db->placehold("SELECT * FROM __article_categories WHERE $where LIMIT 1");

		if($this->db->query($query))
			return $this->db->result();
		else
			return false;
	}

	//Добавить категорию
	public function add_cat($a_cat)
	{
		$query = $this->db->placehold("INSERT INTO __article_categories SET ?%", $a_cat);

		if(!$this->db->query($query))
			return false;
		else
			return $this->db->insert_id();
	}

	//Удалить категоирю
	public function del_cat($id)
	{
		if(!empty($id))
		{
			$query = $this->db->placehold("DELETE FROM __article_categories WHERE id=? LIMIT 1", intval($id));
			if($this->db->query($query))
			{
				return true;
			}
		}
		return false;
	}

	//Обновить категоирю
	public function update_cat($id, $articlecat)
	{
		$query = $this->db->placehold("UPDATE __article_categories SET ?% WHERE id in(?@) LIMIT ?", $articlecat, (array)$id, count((array)$id));
		$this->db->query($query);
		return $id;

	}

}