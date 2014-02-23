<?php
/**
 * Класс по логгированию событий
 * @author pastushenko
 *
 */ 
Class Logger {
	
	
	/**
	 * Хранит объект хранилища
	 * @var object
	 */
	private $storage;
	
	
	/**
	 * Тип лога
	 * @var string
	 */
	private $level;
	
	
	/**
	 * Аргументы принемаемые методами логгинга
	 * @var array
	 */
	private $args;
	
	/**
	 * Указание хранилища
	 * 
	 * @param object
	 */
	public function setStorage($storage) {
		
		$this->storage = $storage;
		
	}
	
	
	/**
	 * Логирование событий с уровнем "debug"
	 */
	public function debug() {
		
		$this->args = func_get_args();
		$this->level = 'debug';
		
		$this->saveLog();
		
	}

	
	/**
	 * Логирование событий с уровнем "error"
	 */
	public function error() {
		
		$this->args = func_get_args();
		$this->level = 'error';
	
		$this->saveLog();
		
	}
	
	
	/**
	 * Логирование событий с уровнем "exception"
	 */
	public function exception() {
		
		$this->args = func_get_args();
		if (!is_a($this->args[0], 'Exception')) {
			throw new LoggerException('First argument of method exception() must be an exception object.');
		}
		
		$this->level = 'exception';
	
		$this->saveLog();
		
	}
	
	
	/**
	 * Сохранение лога в бд
	 */
	private function saveLog() {
		
		$data = array();
		
		//Если был вызван метод exception - добавляем данные о исключении для записи.
		if ($this->level == 'exception') {
			
			$data['exception'] = array(
				'message' => $this->args[0]->getMessage(),
				'code' => $this->args[0]->getCode(),
				'exceptionClass' => get_class($this->args[0]),
				'file' => $this->args[0]->getFile(),
				'line' => $this->args[0]->getLine(),
				'trace' => $this->args[0]->getTrace()
			);
			
			unset($this->args[0]);
		}
		
		//Экранируем номера карточек, генерируем отформатированную строку
		$message = StringHelper::generateErrorString($this->args);
		
		$data['level'] = $this->level;
		$data['message'] = $message;
		$data['created'] = time();

		//Сохраняем значение в храниоище
		$this->storage->save($data);
		
	}
	
	
}
?>