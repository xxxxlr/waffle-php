<?php
require 'waffle.php';

facebook_api_connect();
database_connect();


$action = $_GET['action'];


// Call the module
if (isset($action)) {

	require "modules/ajax_$action.php";
}

?>
