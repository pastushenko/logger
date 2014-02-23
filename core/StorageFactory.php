<?php
/**
 * Фабрика для создания соединения.
 * @author pastushenko
 *
 */ 
Class StorageFactory {
	
	
	private function __construct() {}
	
	
	/**
	 * Получение экземпляра класса
	 * 
	 * @return object
	 */
	static public function getStorage($storageType) {
		
		$storage = false;
		switch ($storageType) {
			case 'mongo':
				$storage = MongoStorage::getInstance();
				break;
		}
		
		if (!$storage) {
			throw new StorageException('Unknown storage type! Please specify other storage type.');
		}
		
		return $storage;
		
	}
	
}
?>