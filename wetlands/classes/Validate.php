<?php
class Validate {
	private $_passed = false, 
			$_errors = array(),
			$_db = null;

	public function __construct() { 
		$this->_db = DB::getInstance(); // Use DB class
	}

	public function check($source, $items = array()) { //source is get or post
		foreach($items as $item => $rules) { // item e.g. username. Rules is the array that governs the rules.
			$value = trim($source[$item]);
			$item = escape($item);
			
			foreach($rules as $rule => $rule_value) { // rule_value is value of the rule e.g. min value 5

				if($rule === 'required' && $rule_value === true && empty($value)) { // check if there is there is a value 
					$this->addError("{$item} is required."); // call add error
				} else if (!empty($value)) { // if there is a value

					switch($rule) { // switch to defined case
						case 'min':
							if(strlen($value) < $rule_value) { //strlen to check amount of charaters in the string
								$this->addError("{$item} must be a minimum of {$rule_value} characters.");
							}
						break;
						case 'max':
							if(strlen($value) > $rule_value) {
								$this->addError("{$item} must be a maximum of {$rule_value} characters.");
							}
						break;
						case 'matches':
							if($value != $source[$rule_value]) { // items have the same value
								$this->addError("{$rule_value} must match {$item}.");
							}
						break;
                        case 'unique': // uniques value, doesn't have the same value as any record in the users table
							$check = $this->_db->get($rule_value, array($item, '=', $value));
							if($check->count()) {
								$this->addError("{$item} is already taken.");
							}
						break;
						
					}

				}

			}
		}

		if(empty($this->_errors)) {
			$this->_passed = true; // passed if errors array is empty
		}

		return $this;
	}

	protected function addError($error) { // add an error to the errors array
		$this->_errors[] = $error;
	}

	public function passed() { 
		return $this->_passed;
	}

	public function errors() {
		return $this->_errors;
	}
}