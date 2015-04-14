<?php

class DB {

    public static $instance = null; // stores the instance of the databse if it's available
    private $_pdo = null, // pdo object stored here
            $_query = null, // last query executed
            $_error = false, // errors 
            $_results = null, // store result set 
            $_count = 0, // count of results
            $_obj = true;      // return object or associative array

    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch (PDOExeption $e) {
            die($e->getMessage()); // kill the aplication if there is any errors
        }
    }

    public static function getInstance() {
        // Already an instance of this? Return, if not, create.
        if (!isset(self::$instance)) { // if instance has not been set. if it has been used twice on a page all it will do is return the instance
            self::$instance = new DB(); // create DB instance
        }
        return self::$instance; // returns instance, allows use of the class functionality
    }

    public function run($sql = '') {

        $this->_error = false;

        $this->_query = $this->_pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        if ($this->_query->execute()) {
            if ($this->_obj) {
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
    
    // generic query method. Allow public query or query inside of a class from other methods. Removes possibity of sql injections.

    public function query($sql, $params = array()) { // query string and array of paramaters. 

        $this->_error = false; // reset the error back to false incase there is more than one query on a page

        if ($this->_query = $this->_pdo->prepare($sql)) { // check if sql statement was prepared successfully
            $x = 1; // set a counter
            if (count($params)) { // check if paramaters exist, if anything was added to the $params array
                foreach ($params as $param) { // list through the params
                    $this->_query->bindValue($x, $param); // bind the value of the position($x) to this value($param) e.g. bind first paramter to 1, second paramater to 2.
                    $x++; // increment x for each loop
                }
            }

            if ($this->_query->execute()) { // if there isn't any paramters execute the query
                if ($this->_obj) {
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ); // if the query has executed correctly, store the results set. Fetch the object of the results
                } else {
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_ASSOC);
                }
                $this->_count = $this->_query->rowCount();  // update the count of the results that we get back
            } else {
                $this->_error = true; // if there has been an error
            }
        }

        return $this; // return the current object, allows us to chain on error
    }

    // makes use of action method.
    public function get($table, $where, $obj = true) {
        $this->_obj = $obj;
        return $this->action('SELECT *', $table, $where);
    }

    // makes use of action method.
    public function getAll($table, $obj = true) {
        $this->_obj = $obj;
        $sql = "SELECT * FROM {$table}";

        if (!$this->run($sql)->error()) {
            return $this;
        }
    }

    // makes use of action method. Calls action. Makes it more efficient. Dont have to use action each time
    public function delete($table, $where) {
        return $this->action('DELETE', $table, $where);
    }

    // The action function allows more effieient querying. Makes querying more abstract. Less work in writing queries.

    public function action($action, $table, $where = array()) {
        if (count($where) === 3) { // check if the count of where is equal to 3. A field, operator and value is required
            $operators = array('=', '>', '<', '>=', '<='); // define a list of allowed operators

            $field = $where[0]; // set the three variables needed.
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) { // check whether the operator is in the operator array.
                
                // construct the query. 
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";  // ? = $value

                if (!$this->query($sql, array($value))->error()) { // If there is not an error; use the query method to perfrom the query. Value is binded on.
                    return $this; // return the object
                }
            }

            return false; // return false if there are errors
        }
    }

    public function insert($table, $fields = array()) { // tables and fields we want to insert
        $keys = array_keys($fields); // 
        $values = ''; //
        $x = 1; // counter

        foreach ($fields as $value) { // 
            $values .= "?"; // ? binds as values
            if ($x < count($fields)) { // If there are still more fields add a comma to the end of the field
                $values .= ', ';
            }
            $x++; // increment counter afer loop
        }

        // Build insert query. 
        // Implode the keys of the array. Take the keys of the array and create it as a string with a seperator.
        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})"; 

        if (!$this->query($sql, $fields)->error()) { // if there are no errors
            return true;
        }

        return false;
    }

    // Similar to insert. $id added
    public function update($table, $id, $fields = array()) {
        $set = '';
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        if (!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    public function results() {
        // Return result object
        return $this->_results;
    }

    public function first() {
        // return only the first result
        return $this->_results[0];
    }

    public function count() {
        // Return count
        return $this->_count;
    }

    public function error() { // if there has been an error, this method returns true
        return $this->_error;
    }

}
