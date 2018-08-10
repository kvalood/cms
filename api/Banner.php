<?php

require_once('Simpla.php');

class Banner extends Simpla
{
    /*
     * Список групп баннеров
     */
    public function get_banners() {

        $query = $this->db->placehold("SELECT * FROM __banners ORDER BY id");
        $this->db->query($query);
        return $this->db->results();
    }

    /*
    * Создание группы баннеров
    */
    public function add_banner($data) {

        $query = $this->db->placehold("INSERT INTO __banners SET ?%", $data);
        $this->db->query($query);
        return $this->db->insert_id();
    }

    /*
    * Просмотр группы баннеров
    */
    public function get_banner($id) {

        $query = $this->db->placehold("SELECT * FROM __banners WHERE id = ?", intval($id));
        $this->db->query($query);
        return $this->db->result();
    }

    /*
    * Редактирование группы баннеров
    */
    public function update_banner($id, $data) {
        $query = $this->db->placehold("UPDATE __banners SET ?% WHERE id = ?", (array)$data, intval($id));
        $this->db->query($query);
        return $id;
    }

    /*
	* Удаление группы баннеров
	*/
    public function delete_banner($id) {
        if(!empty($id))
        {
            $query = $this->db->placehold("DELETE FROM __banners WHERE id=? LIMIT 1", $id);
            $this->db->query($query);
        }
    }

    /*
    * Список баннеров.
    */
	public function get_banner_images($filter = []) {
		$where = 'WHERE 1';

        // баннеры определенной группы баннереров
        if(isset($filter['banner_id']))
            $where .= $this->db->placehold(' AND banner_id = ?', intval($filter['banner_id']));

        if(isset($filter['visible']))
            $where .= $this->db->placehold(' AND visible = ?', intval($filter['visible']));

		// Выбираем все баннеры
		$query = $this->db->placehold("SELECT * FROM __banner_images $where ORDER BY position");
		$this->db->query($query);
		return $this->db->results();
	}

	/*
	* баннер по URL или ID
	*/
	public function get_banner_image($id) {

        $where = 'WHERE';

		if(is_int($id))			
			$where .= $this->db->placehold(' id = ?', $id);
		else
            $where .= $this->db->placehold(' url = ?', $id);

		$query = "SELECT * FROM __banner_images $where LIMIT 1";
		$this->db->query($query);
		return $this->db->result();
	}

	/*
	* Добавление баннера
	*/
	public function add_banner_image($data) {

		$query = $this->db->placehold("INSERT INTO __banner_images SET ?%", $data);
		$this->db->query($query);
		$id = $this->db->insert_id();

		$query = $this->db->placehold("UPDATE __banner_images SET position=id WHERE id=? LIMIT 1", $id);
		$this->db->query($query);

		return $id;
	}

	/*
	* Обновление баннера(ов)
	*/
	public function update_banner_image($id, $data) {
		$query = $this->db->placehold("UPDATE __banner_images SET ?% WHERE id in(?@) LIMIT ?", (array)$data, (array)$id, count((array)$id));
		$this->db->query($query);
		return $id;
	}
	
	/*
	* Удаление баннера
	*/
	public function delete_banner_image($id) {
		if(!empty($id))
		{
			$this->delete_image($id);
			$query = $this->db->placehold("DELETE FROM __banner_images WHERE id=? LIMIT 1", intval($id));
			$this->db->query($query);		
		}
	}
}