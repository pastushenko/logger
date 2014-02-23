<?php
/**
 * Класс помошник форматирования строк
 * @author pastushenko
 *
 */
Class StringHelper {
	
	
	/**
	 * Генерация сообщения об ошибке
	 * 
	 * @param unknown $args
	 * @return string
	 */
	static function generateErrorString($args) {
		
		$string = call_user_func_array("sprintf", $args);
		$string = self::encodeCCNumbers($string);
		
		return $string;
		
	}
	
	
	/**
	 * Экранирование номеров кредиток
	 * 
	 * @param string $string
	 * @return string
	 */
	static function encodeCCNumbers($string) {

		#TODO Надо дописать регулярные выражения на экранирование.
		$string = preg_replace('/(^|[\s]{1})[\d+]{16}([\s]{1}|$)/', ' XXXXXXXXXXXXXXXX ', $string);
		$string = preg_replace('/(^|[\s]{1})[\d+]{3}([\s]{1}|$)/', ' XXX ', $string);
		
		return $string;
		
	}
	
	
}