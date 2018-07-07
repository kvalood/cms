<?php
require_once('Simpla.php');
class Lang extends Simpla
{
    // Языковой файл
    public $config_file = 'config/ru.php';
    private $vars = array();

    // В конструкторе записываем настройки файла в переменные этого класса
    public function __construct()
    {
        // Читаем настройки из дефолтного файла
        $ini = parse_ini_file(dirname(dirname(__FILE__)).'/'.$this->config_file);
        // Записываем настройку как переменную класса
        foreach($ini as $var=>$value)
            $this->vars[$var] = $value;
    }
    // Возвращаем переменную языкового файла
    public function __get($name)
    {
        if(isset($this->vars[$name]))
            return $this->vars[$name];
        else
            return null;
    }
}