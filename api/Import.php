<?php

require_once('Simpla.php');

class Import extends Simpla
{
	public function __construct()
	{		
		parent::__construct();
	}

	// Список прайс листов
    public function get_prices($filter = array()) {
        $query = $this->db->placehold("SELECT * FROM __import");
        $this->db->query($query);
        return $this->db->results();
    }

    // Количество прайсов
    public function count_prices($filter = array()) {
        $query = $this->db->placehold("SELECT COUNT(DISTINCT id)as count FROM __import");
        $this->db->query($query);

        if($this->db->query($query))
            return $this->db->result('count');
        else
            return false;
    }

    // Выводим прайс
    public function get_price($id) {

        $query = $this->db->placehold("SELECT * FROM __import WHERE id=? LIMIT 1", intval($id));
        if($this->db->query($query))
            return $this->db->result();
        else
            return false;
    }

    // добавить прайс
    public function add_price($data) {
        $query = $this->db->placehold("INSERT INTO __import SET ?%", $data);

        if(!$this->db->query($query))
            return false;
        else
            return $this->db->insert_id();

    }


    // ОБновить прайс
    public function update_price($id, $data) {

        $query = $this->db->placehold("UPDATE __import SET ?% WHERE id in(?@) LIMIT ?", $data, (array)$id, count((array)$id));

        if($this->db->query($query))
            return $id;
        else
            return false;
    }


    // Удалить прайс
    public function delete_price($id)
    {
        if(!empty($id))
        {
            $query = $this->db->placehold("DELETE FROM __import WHERE id=? LIMIT 1", intval($id));
            if($this->db->query($query))
                return true;
        }
        return false;
    }



    public function convert_file($source, $dest)
    {
        // Узнаем какая кодировка у файла
        $teststring = file_get_contents($source, null, null, null, 1000000);

        if (preg_match('//u', $teststring)) // Кодировка - UTF8
        {
            // Просто копируем файл
            return copy($source, $dest);
        }
        else
        {
            // Конвертируем в UFT8
            if(!$src = fopen($source, "r"))
                return false;

            if(!$dst = fopen($dest, "w"))
                return false;

            while (($line = fgets($src, 4096)) !== false)
            {
                $line = $this->win_to_utf($line);
                fwrite($dst, $line);
            }
            fclose($src);
            fclose($dst);
            return true;
        }
    }

    public function win_to_utf($text)
    {
        if(function_exists('iconv'))
        {
            return @iconv('windows-1251', 'UTF-8', $text);
        }
        else
        {
            $t = '';
            for($i=0, $m=strlen($text); $i<$m; $i++)
            {
                $c=ord($text[$i]);
                if ($c<=127) {$t.=chr($c); continue; }
                if ($c>=192 && $c<=207)    {$t.=chr(208).chr($c-48); continue; }
                if ($c>=208 && $c<=239) {$t.=chr(208).chr($c-48); continue; }
                if ($c>=240 && $c<=255) {$t.=chr(209).chr($c-112); continue; }
//				if ($c==184) { $t.=chr(209).chr(209); continue; };
//				if ($c==168) { $t.=chr(208).chr(129);  continue; };
                if ($c==184) { $t.=chr(209).chr(145); continue; }; #ё
                if ($c==168) { $t.=chr(208).chr(129); continue; }; #Ё
                if ($c==179) { $t.=chr(209).chr(150); continue; }; #і
                if ($c==178) { $t.=chr(208).chr(134); continue; }; #І
                if ($c==191) { $t.=chr(209).chr(151); continue; }; #ї
                if ($c==175) { $t.=chr(208).chr(135); continue; }; #ї
                if ($c==186) { $t.=chr(209).chr(148); continue; }; #є
                if ($c==170) { $t.=chr(208).chr(132); continue; }; #Є
                if ($c==180) { $t.=chr(210).chr(145); continue; }; #ґ
                if ($c==165) { $t.=chr(210).chr(144); continue; }; #Ґ
                if ($c==184) { $t.=chr(209).chr(145); continue; }; #Ґ
            }
            return $t;
        }
    }
	
}