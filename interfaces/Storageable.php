<?php
/**
 * Интерфейс обязующий иметь возможность сохранять в хранилище
 * @author pastushenko
 *
 */
interface Storageable {
	
	
	/**
	 * Cохранение
	 * @param array $data
	 */
	public function save($data);
	
}