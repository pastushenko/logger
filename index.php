<?php
include('config/config.php');

//Создаем объект отвечающий за запись в хранилище
try {
	$storage = StorageFactory::getStorage(DB_TYPE);
} catch (StorageException $ex) {
	die($ex->getMessage()."\n");
}


$logger = new Logger();
$logger->setStorage($storage);
//$logger->error('%d дней не пользовались кредитной картой 5192696222257727', '17.3');

$logger->exception(new StorageException('test exception'), "%d", "17,999");

