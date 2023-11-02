<?php 
  function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    return str_replace($rus, $lat, $str);
  }
class db {              
    public $time_load_page; # Время выполнения скрипта 
    public $mem_start; # Потребление памяти при выполнении скрипта 
    public $mem_pek_start; # Пиковое потребление памяти при выполнении скрипта           
                           
    const DB_HOST = "localhost"; # mysql хост 
    const DB_USER = "root"; # mysql пользователь 
    const DB_PASS = ""; # mysql пароль 
    const DB_NAME = "Tgames"; # БД mysql 
                           
    private $counter_mysql = 0; # Количество запросов 
    private $timer_mysql = 0; # Общее время запросов 
    private $mysql_query_desc; # Список запросов 
              
	# Соединение с БД и запуск класса 
    public function __construct() { 
	$connect = mysql_connect(self::DB_HOST, self::DB_USER, self::DB_PASS) or die("База данных ушла в себя"); 
	mysql_select_db(self::DB_NAME,$connect) or die("Невозможно найти БД"); 
			  
	# Установка языка записи в БД 
    mysql_query("SET NAMES utf8"); 
    mysql_set_charset("utf8"); 
} 
                           
    # Считаются запросы 
    # @query:String - mysql запрос 
    public function q($query)              
    {
		# Добавляется запрос в список запросов
        $this->mysql_query_desc[] = $query;
		# Увеличивается количество запросов 			   
        $this->counter_mysql++;
               
		# Считается время выполнения запроса 
        $start = microtime(true); 
        $result = mysql_query($query); 
        $this->timer_mysql += microtime(true)-$start; 
               
		# Возвращается выполненый mysql запрос 
        return $result; 
    } 
              
	# Выводится отладочная инфа 
    public function debug() 
        { 
            $txt = ""; 
            $txt .= "Скрипт выполнен за ".$this->time_load_page." сек.<br>\n"; 
            $txt .= "Количество запросов к БД: ".$this->counter_mysql."<br>\n"; 
            $txt .= "Время запросов к БД: ".round($this->timer_mysql,4)."<br>\n"; 
            $txt .= "Список запросов<br>\n<div>"; 
            $len = sizeof($this->mysql_query_desc); 
            for ($i=0;$i<$len;$i++) { 
            $txt .= "[".($i+1)."] ".$this->mysql_query_desc[$i]."<br>\n"; 
        } 
            $txt .= "</div>"; 
            if ( function_exists('memory_get_usage') ) 
				{ 
					$type = "Kb"; 
					$num = round($this->mem_start/1024, 2); 
					if ($num > 1024) 
						{ 
							$type = "Mb"; 
							$num = round($this->mem_start/1024/1024, 2); 
						} 
					$txt .= "Потребление памяти: ".$num.$type." <br>\n"; 
               }         
               return $txt; 
                 }           
} 
?>