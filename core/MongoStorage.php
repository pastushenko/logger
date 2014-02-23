<?php
/**
 * Класс по работе с бд.
 * @author pastushenko
 *
 */ 
Class MongoStorage implements Storageable {
	
	
	/**
	 * Свойство хранящее экземпляр объекта DB
	 * 
	 * @var object of DB
	 */
	static $instance = null;
	
	
	/**
	 * Коллекция для записи
	 * @var object MongoCollection
	 */
	private $collection;
	
	
	/**
	 * Указатель на соединение
	 * @var object MongoClient
	 */
	private $connection;
	
	
	/**
	 * Конструктор класса
	 * 
	 * @return boolean
	 */
	private function __construct() {

		try {
			$this->connection = new MongoClient();
		} catch (Exception $ex) {
			die($ex->getMessage()."\n");
		}
		
		$this->collection = $this->connection->{DB_NAME}->{DB_COLLECTION};
		
		return $this;
		
	}
	
	
	/**
	 * Получение экземпляра класса
	 * 
	 * @return object of DB
	 */
	static public function getInstance() {
		
		if (is_null(self::$instance)) {
			self::$instance = new MongoStorage();
		}
		
		return self::$instance;
		
	}
	
	
	/**
	 * текстовая ф-ция
	 * 
	 * @param string $text
	 * @return string
	 */
	public function save($data) {

		$this->collection->insert($data);
		
	}
	
	
	/**
	 * Закрытие соединения.
	 */
	public function __destruct() {
		
		$this->connection->close();
		
	}
	
}
?>