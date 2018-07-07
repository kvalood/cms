<?php

require_once('Simpla.php');

class Menu extends Simpla
{
	
	//Управление категориями меню
	public function list_cat_menu()
	{
		$query = $this->db->placehold('SELECT id,name FROM __menu_category WHERE id ORDER BY id DESC LIMIT 0,100');		
		$this->db->query($query);
		return $this->db->results();
	}

	//Добавить меню
	public function add_cat($a_cat)
	{		
		$query = $this->db->placehold("INSERT INTO __menu_category SET ?%", $a_cat);
		
		if(!$this->db->query($query))
			return false;
		else
			return $this->db->insert_id();
	}
	
	//Удалить меню
	public function del_cat($id)
	{
		if(!empty($id))
		{
			$query = $this->db->placehold("DELETE FROM __menu_category WHERE id=? LIMIT 1", intval($id));
			$this->db->query($query);
			$query = $this->db->placehold("DELETE FROM __menu WHERE category=?", intval($id));			
			$this->db->query($query);
		}
		return false;	
	}
	
	public function update_cat($id, $articlecat)
	{
		$query = $this->db->placehold("UPDATE __menu_category SET ?% WHERE id in(?@) LIMIT ?", $articlecat, (array)$id, count((array)$id));
		$this->db->query($query);
		return $id;	
	}

    // Узнать категорию меню
	public function get_cat($id)
	{
		$query = $this->db->placehold("SELECT b.id, b.name FROM __menu_category b WHERE id=? LIMIT 1",$id);
		if($this->db->query($query))
			return $this->db->result();
		else
			return false;
	}
	

	/***
	* Работа с пунтками меню
	*/

	//Список всех пунктов меню.
	public function all_list_id($filter = array())
	{
		$visible_filter = '';
		
		if(isset($filter['visible']))
			$visible_filter = $this->db->placehold('WHERE visible = ?', intval($filter['visible']));			
		
		$query = $this->db->placehold("SELECT * FROM __menu $visible_filter ORDER BY position");		
		$this->db->query($query);
		return $this->db->results();
	}
	
	//Список пунктов заданного меню
	public function list_id($id, $filter = [])
	{
        $select = '';
        $where = '';

        if(isset($filter['visible']))
            $where .= $this->db->placehold(' AND visible=?', intval($filter['visible']));

		$query = $this->db->placehold("SELECT * FROM __menu WHERE category=? $where ORDER BY position", intval($id));
		$this->db->query($query);

		$items = [];
        foreach($this->db->results() as $item)
            $items[$item->id] = $item;

        //Создаем древовидное меню
        return $this->getTree($items);
	}

	// Строим дерево для меню
    private function getTree($dataset) {
        $tree = array();

        foreach ($dataset as $id => &$node) {
            //Если нет вложений
            if (!$node->parent_id){
                $tree[$id] = &$node;
            }else{
                //Если есть потомки то перебераем массив
                $dataset[$node->parent_id]->childs[$id] = &$node;
            }
        }
        return $tree;
    }
	
	//Получить пункт меню по ID/url
	public function get_id($id)
	{
		if(is_int($id))
			$where = $this->db->placehold("b.id = ?", intval($id));
		else
			$where = $this->db->placehold("b.url = ?", $id);
		
		$query = $this->db->placehold("SELECT * FROM __menu b WHERE $where LIMIT 1");
		
		if($this->db->query($query))
			return $this->db->result();
		else
			return false; 
	}
	
	//Получить пункт меню по показываемому материалу/категории + типу
	public function get_id_show($filter = array())
	{
		$where = '';
		
		if(is_int($filter['id_show']))
			$where .= $this->db->placehold(" AND b.id_show = ?", intval($filter['id_show']));
		
		if($filter['type'])
			$where .= $this->db->placehold(" AND b.type = ?", intval($filter['type']));
		
		$query = $this->db->placehold("SELECT * FROM __menu b WHERE 1 $where LIMIT 1");
				
		if($this->db->query($query))
			return $this->db->result();
		else
			return false; 
	}

	
	//Получить пункт меню по домашней странице.
	public function get_home()
	{
		$query = $this->db->placehold("SELECT * FROM __menu WHERE home=1 LIMIT 1");
		if($this->db->query($query))
			return $this->db->result();
		else
			return false; 
	}
	
	//Создание нового пункта
	public function add_id($menu)
	{
		$query = $this->db->placehold("INSERT INTO __menu SET ?%", $menu);
		if(!$this->db->query($query))
		return false;

		$id = $this->db->insert_id();
		$this->db->query("UPDATE __menu SET position=id WHERE id=?", $id);	
		return $id;
	
	}
	//Удаление пункта меню
	public function del_id($id)
	{
		if(!empty($id))
		{
			$query = $this->db->placehold("DELETE FROM __menu WHERE id=? LIMIT 1", intval($id));
			$this->db->query($query);
		}
		return false;
	}
	//редактирование пункта меню
	public function update_id($id,$menu)
	{
		$query = $this->db->placehold('UPDATE __menu SET ?% WHERE id in (?@)', $menu, (array)$id);
		if(!$this->db->query($query))
			return false;
		return $id;
	}
}
