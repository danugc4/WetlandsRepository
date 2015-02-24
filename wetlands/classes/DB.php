<?php
class DB {
	public static $instance = null;

	private 	$_pdo = null,      // pdo object
				$_query = null,    // last query executed
				$_error = false,   
				$_results = null,  // store result set 
				$_count = 0,       // count of results
				$_obj = true;      // return object or associative array

	private function __construct() {
		try {
			$this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
		} catch(PDOExeption $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance() {
		// Already an instance of this? Return, if not, create.
		if(!isset(self::$instance)) {
			self::$instance = new DB();
		}
		return self::$instance;
	}

	public function run($sql = '') {

		$this->_error = false;

		$this->_query = $this->_pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		
		if($this->_query->execute()) {
			if($this->_obj) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
			} else {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_ASSOC);
			}
			$this->_count = $this->_query->rowCount();
		} else {
			$this->_error = true;
		}
		return $this;
	}
	
	public function query($sql, $params = array()) {
	
		$this->_error = false;
	
		if($this->_query = $this->_pdo->prepare($sql)) {
			$x = 1;
			if(count($params)) {
				foreach($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
	
			if($this->_query->execute()) {
				if($this->_obj) {
				  $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				} else {
				  $this->_results = $this->_query->fetchAll(PDO::FETCH_ASSOC);
				}
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true;
			}
		}
	
		return $this;
	}
	

	public function get($table, $where, $obj = true) {
		$this->_obj = $obj;
		return $this->action('SELECT *', $table, $where);
	}

	public function getAll($table, $obj = true) {
		$this->_obj = $obj;
		$sql = "SELECT * FROM {$table}";
		
		if(!$this->run($sql)->error()) {
			return $this;
		}
	}

	public function delete($table, $where) {
		return $this->action('DELETE', $table, $where);
	}

	public function action($action, $table, $where = array()) {
		if(count($where) === 3) {
			$operators = array('=', '>', '<', '>=', '<=');

			$field 		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];

			if(in_array($operator, $operators)) {
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}

			}
			
			return false;
		}
	}

	public function insert($table, $fields = array()) {
		$keys 	= array_keys($fields);
		$values = '';
		$x 		= 1;

		foreach($fields as $value) {
			$values .= "?";
			if($x < count($fields)) {
				$values .= ', ';
			}
			$x++;
		}

		$sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

		if(!$this->query($sql, $fields)->error()) {
			return true;
		}

		return false;
	}

	public function update($table, $id, $fields = array()) {
		$set 	= '';
		$x		= 1;

		foreach($fields as $name => $value) {
			$set .= "{$name} = ?";
			if($x < count($fields)) {
				$set .= ', ';
			}
			$x++;
		}

		$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

		if(!$this->query($sql, $fields)->error()) {
			return true;
		}

		return false;
	}

	public function results() {
		// Return result object
		return $this->_results;
	}

	public function first() {
		return $this->_results[0];
	}

	public function count() {
		// Return count
		return $this->_count;
	}

	public function error() {
		return $this->_error;
	}
}