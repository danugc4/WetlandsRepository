<?php
require 'core/init.php';
$user->logout();

Redirect::to('index.php');