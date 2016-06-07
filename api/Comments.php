<?php

/**
 * Simpla CMS
 *
 * @copyright	2011 Denis Pikusov
 * @link		http://simplacms.ru
 * @author		Denis Pikusov
 *
 */

require_once('Simpla.php');

class Comments extends Simpla
{

	// Возвращает комментарий по id
	public function get_comment($id)
	{
		$query = $this->db->placehold("SELECT c.id, c.parent, c.date, c.ip, c.object_id, c.name, c.email, c.text, c.type, c.approved FROM __comments c WHERE id=? LIMIT 1", intval($id));

		if($this->db->query($query))
			return $this->db->result();
		else
			return false; 
	}
	
	// Возвращает комментарии, удовлетворяющие фильтру
	public function get_comments($filter = array())
	{	
		// По умолчанию
		$limit = 0;
		$page = 1;
		$object_id_filter = '';
		$type_filter = '';
		$keyword_filter = '';
		$approved_filter = '';

		if(isset($filter['limit']))
			$limit = max(1, intval($filter['limit']));

		if(isset($filter['page']))
			$page = max(1, intval($filter['page']));

		if(isset($filter['ip']))
			$ip = $this->db->placehold("OR c.ip=?", $filter['ip']);

		if(isset($filter['approved']))
			$approved_filter = $this->db->placehold("AND (c.approved=? $ip)", intval($filter['approved']));
			
		if($limit)
			$sql_limit = $this->db->placehold(' LIMIT ?, ? ', ($page-1)*$limit, $limit);
		else
			$sql_limit = '';

		if(!empty($filter['object_id']))
			$object_id_filter = $this->db->placehold('AND c.object_id in(?@)', (array)$filter['object_id']);

		if(!empty($filter['type']))
			$type_filter = $this->db->placehold('AND c.type=?', $filter['type']);

		if(!empty($filter['keyword']))
		{
			$keywords = explode(' ', $filter['keyword']);
			foreach($keywords as $keyword)
				$keyword_filter .= $this->db->placehold('AND c.name LIKE "%'.$this->db->escape(trim($keyword)).'%" OR c.text LIKE "%'.$this->db->escape(trim($keyword)).'%" ');
		}

		$sort='DESC';
		
		$query = $this->db->placehold("SELECT c.id, c.parent, c.date, c.ip, c.object_id, c.name, c.email, c.text, c.type, c.approved
										FROM __comments c WHERE 1 $object_id_filter $type_filter $keyword_filter $approved_filter ORDER BY id $sort $sql_limit");
	
		$this->db->query($query);
		return $this->db->results();
	}
	
	// Количество комментариев, удовлетворяющих фильтру
	public function count_comments($filter = array())
	{	
		$object_id_filter = '';
		$type_filter = '';
		$approved_filter = '';
		$keyword_filter = '';

		if(!empty($filter['object_id']))
			$object_id_filter = $this->db->placehold('AND c.object_id in(?@)', (array)$filter['object_id']);

		if(!empty($filter['type']))
			$type_filter = $this->db->placehold('AND c.type=?', $filter['type']);

		if(isset($filter['approved']))
			$approved_filter = $this->db->placehold('AND c.approved=?', intval($filter['approved']));

		if(!empty($filter['keyword']))
		{
			$keywords = explode(' ', $filter['keyword']);
			foreach($keywords as $keyword)
				$keyword_filter .= $this->db->placehold('AND c.name LIKE "%'.$this->db->escape(trim($keyword)).'%" OR c.text LIKE "%'.$this->db->escape(trim($keyword)).'%" ');
		}

		$query = $this->db->placehold("SELECT count(distinct c.id) as count
										FROM __comments c WHERE 1 $object_id_filter $type_filter $keyword_filter $approved_filter", $this->settings->date_format);
	
		$this->db->query($query);	
		return $this->db->result('count');

	}
	
	// Добавление комментария
	public function add_comment($comment)
	{	
		$query = $this->db->placehold('INSERT INTO __comments
		SET ?%,
		date = NOW()',
		$comment);

		if(!$this->db->query($query))
			return false;

		$id = $this->db->insert_id();
		return $id;
	}
	
	// Изменение комментария
	public function update_comment($id, $comment)
	{
		$date_query = '';
		if(isset($comment->date))
		{
			$date = $comment->date;
			unset($comment->date);
			$date_query = $this->db->placehold(', date=STR_TO_DATE(?, ?)', $date, $this->settings->date_format);
		}
		$query = $this->db->placehold("UPDATE __comments SET ?% $date_query WHERE id in(?@) LIMIT 1", $comment, (array)$id);
		$this->db->query($query);
		return $id;
	}

	// Удаление комментария
	public function delete_comment($id)
	{
		if(!empty($id))
		{
			$query = $this->db->placehold("DELETE FROM __comments WHERE id=? LIMIT 1", intval($id));
			$this->db->query($query);
		}
	}


    // Список указателей на комментарии в дереве комментариев (ключ = id комментария)
    private $all_comments;

    // Дерево комментариев
    private $comments_tree;

    // Функция возвращает дерево комментариев
    public function get_comments_tree($filter = array())
    {
        if(!isset($this->comments_tree))
            $this->init_comments($filter);

        return $this->comments_tree;
    }


    // Инициализация категорий, после которой категории будем выбирать из локальной переменной
    private function init_comments($filter)
    {
        $object_id_filter = '';
        $type_filter = '';
        $approved_filter = '';

        if(!empty($filter['object_id']))
            $object_id_filter = $this->db->placehold('AND object_id in(?@)', (array)$filter['object_id']);

        if(!empty($filter['type']))
            $type_filter = $this->db->placehold('AND type=?', $filter['type']);

        if(isset($filter['approved']))
            $approved_filter = $this->db->placehold('AND approved=?', intval($filter['approved']));


        // Дерево комментов
        $tree = new stdClass();
        $tree->subcomments = array();

        // Указатели на узлы дерева
        $pointers = array();
        $pointers[0] = &$tree;
        $pointers[0]->path = array();
        $pointers[0]->level = 0;

        // Выбираем все комменты
        $query = $this->db->placehold("SELECT c.id, c.parent, c.date, c.ip, c.object_id, c.name, c.email, c.text, c.type, c.approved
                                              FROM __comments c
                                              WHERE 1 $object_id_filter $type_filter $approved_filter
                                              ORDER BY parent");
        $this->db->query($query);
        $comments = $this->db->results();

        $finish = false;
        // Не кончаем, пока не кончатся комментарии, или пока ниодну из оставшихся некуда приткнуть
        while(!empty($comments)  && !$finish)
        {
            $flag = false;
            // Проходим все выбранные категории
            foreach($comments as $k=>$comment)
            {
                if(isset($pointers[$comment->parent]))
                {
                    // В дерево категорий (через указатель) добавляем текущую категорию
                    $pointers[$comment->id] = $pointers[$comment->parent]->subcomments[] = $comment;

                    // Путь к текущей категории
                    $curr = $pointers[$comment->id];
                    $pointers[$comment->id]->path = array_merge((array)$pointers[$comment->parent]->path, array($curr));

                    // Уровень вложенности категории
                    $pointers[$comment->id]->level = 1+$pointers[$comment->parent]->level;

                    // Убираем использованную категорию из массива категорий
                    unset($comments[$k]);
                    $flag = true;
                }
            }
            if(!$flag) $finish = true;
        }

        $this->comments_tree = $tree->subcomments;
        $this->all_comments = $pointers;
    }
}