<?php

class User {

    private $_db,
            $_sessionName = null,
            $_cookieName = null,
            $_data = array(),
            $_isLoggedIn = false;

    public function __construct($user = null) { // define if we want to pass in a user value. User object will be used.
        $this->_db = DB::getInstance(); // make use of DB class

        $this->_sessionName = Config::get('session/session_name'); 
        $this->_cookieName = Config::get('remember/cookie_name');

        // Check if a session exists and set user if so.
        if (Session::exists($this->_sessionName) && !$user) {
            $user = Session::get($this->_sessionName);

            if ($this->find($user)) {
                $this->_isLoggedIn = true;
            } else {
                $this->logout();
            }
        } else {
            $this->find($user);
        }
    }

    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    // method to get a users data
    public function find($user = null) {
       
        if ($user) {
            $field = (is_numeric($user)) ? 'id' : 'username'; // field is either id or username
            $data = $this->_db->get('users', array($field, '=', $user)); // get the users data for the user

            if ($data->count()) {
                $this->_data = $data->first(); // store data
                return true; // user does exist
            }
        }
        return false; // user doesn't exist
    }

    public function create($fields = array()) { // create a user
        if (!$this->_db->insert('users', $fields)) { // insert fields into users table
            throw new Exception('There was a problem creating an account.');
        }
    }

    public function update($fields = array(), $id = null) {
        if (!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if (!$this->_db->update('users', $id, $fields)) {
            throw new Exception('There was a problem updating.');
        }
    }

    
    public function login($username = null, $password = null, $remember = false) {

        if (!$username && !$password && $this->exists()) { // check if username and password are supplied
            Session::put($this->_sessionName, $this->data()->id);
        } else {
            $user = $this->find($username); // call find method to get user data

            if ($user) {
                if ($this->data()->password === Hash::make($password, $this->data()->salt)) { // if password matches
                    Session::put($this->_sessionName, $this->data()->id); // set a session for a user and place the id in it

                    if ($remember) {
                        $hash = Hash::unique();
                        $hashCheck = $this->_db->get('user_session', array('user_id', '=', $this->data()->id));

                        if (!$hashCheck->count()) {
                            $this->_db->insert('user_session', array(
                                'user_id' => $this->data()->id,
                                'hash' => $hash
                            ));
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }

                        Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }

                    return true; // successfull login
                }
            }
        }

        return false;
    }

    public function hasPermission($key) {
        $access = $this->_db->query("SELECT * FROM groups WHERE id = ?", array($this->data()->access));

        if ($access->count()) {
            $permissions = json_decode($access->first()->permissions, true);
            
            if ($permissions[$key] === 1) {
                return true;
            }
        }

        return false;
    }

    public function isLoggedIn() {
        return $this->_isLoggedIn;
    }

    public function data() { // method that returns data
        return $this->_data;
    }

    public function logout() {
        $this->_db->delete('users_session', array('user_id', '=', $this->data()->id));

        Cookie::delete($this->_cookieName);
        Session::delete($this->_sessionName);
    }

}
