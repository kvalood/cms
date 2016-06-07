<?php

require_once('Simpla.php');

class Slider extends Simpla
{
    /*
     * Список слайдеров
     */
    public function sliders() {

        $query = $this->db->placehold("SELECT * FROM __sliders ORDER BY id");
        $this->db->query($query);
        return $this->db->results();
    }

    /*
    * Создание слайдера
    */
    public function add_slider($data) {

        $query = $this->db->placehold("INSERT INTO __sliders SET ?%", $data);
        $this->db->query($query);
        return $this->db->insert_id();
    }

    /*
    * Просмотр слайдера
    */
    public function get_slider($id) {

        $query = $this->db->placehold("SELECT * FROM __sliders WHERE id = ?", intval($id));
        $this->db->query($query);
        return $this->db->result();
    }

    /*
    * Редактирование группы слайдеров
    */
    public function update_slider($id, $data) {
        $query = $this->db->placehold("UPDATE __sliders SET ?% WHERE id = ?", (array)$data, intval($id));
        $this->db->query($query);
        return $id;
    }

    /*
	* Удаление группы слайдеров
	*/
    public function delete_sliders($id) {
        if(!empty($id))
        {
            $query = $this->db->placehold("DELETE FROM __sliders WHERE id=? LIMIT 1", $id);
            $this->db->query($query);
        }
    }

    /*
    * Список слайдов.
    */
	public function get_slides($filter = []) {
		$where = 'WHERE 1';

        // Слайды определенной группы слайдеров
        if(isset($filter['slider_id']))
            $where .= $this->db->placehold(' AND slider_id = ?', intval($filter['slider_id']));

        if(isset($filter['visible']))
            $where .= $this->db->placehold(' AND visible = ?', intval($filter['visible']));

		// Выбираем все слайды
		$query = $this->db->placehold("SELECT * FROM __slider_images $where ORDER BY position");
		$this->db->query($query);
		return $this->db->results();
	}

	/*
	* Слайд по URL или ID
	*/
	public function get_slide($id) {

        $where = 'WHERE';

		if(is_int($id))			
			$where .= $this->db->placehold(' id = ?', $id);
		else
            $where .= $this->db->placehold(' url = ?', $id);

		$query = "SELECT * FROM __slider_images $where LIMIT 1";
		$this->db->query($query);
		return $this->db->result();
	}

	/*
	* Добавление слайда
	*/
	public function add_slide($data) {

		$query = $this->db->placehold("INSERT INTO __slider_images SET ?%", $data);
		$this->db->query($query);
		$id = $this->db->insert_id();

		$query = $this->db->placehold("UPDATE __slider_images SET position=id WHERE id=? LIMIT 1", $id);
		$this->db->query($query);

		return $id;
	}

	/*
	* Обновление слайда(ов)
	*/
	public function update_slide($id, $data) {
		$query = $this->db->placehold("UPDATE __slider_images SET ?% WHERE id in(?@) LIMIT ?", (array)$data, (array)$id, count((array)$id));
		$this->db->query($query);
		return $id;
	}
	
	/*
	* Удаление слайда
	*/
	public function delete_slide($id) {
		if(!empty($id))
		{
			$this->delete_image($id);
			$query = $this->db->placehold("DELETE FROM __slider_images WHERE id=? LIMIT 1", intval($id));
			$this->db->query($query);		
		}
	}
}