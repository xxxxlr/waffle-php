<?php

require 'config.php';
require 'libs/facebook-php-sdk/src/facebook.php';
require 'libs/pdo-wrapper.php';




// ----------------------------- Global Vars  ---------------------------------

$facebook;				// Facebook API Connector
$fb_user_id;			// Facebook User ID
$fb_user_profile;		// Facebook User Profile
$fb_user_friends;		// Facebook user Friend List


$db_conn;				// Local Database Connector




// ---------------------------- Facebook API ----------------------------------

/**
  * -> facebook_api_connect()
  *
  * 1. Create connection with Facebook API.
  *	2. Retreve useful user information.
  *
  */
function facebook_api_connect() {
	global $FB_API_KEY;
	global $facebook, $fb_user_id, $fb_user_profile, $fb_user_friends;
	
	$facebook = new Facebook($FB_API_KEY);

	// Retrieve current user Facebook ID.
	$fb_user_id = $facebook->getUser();

	// Retrieve current user profile and friend list.
	if ($fb_user_id) {
		try {
			$fb_user_profile = $facebook->api('/me');
			$fb_user_friends = $facebook->api('/me/friends');
		}
		catch (FacebookApiException $e) {
			error_log($e);
			$fb_user_id = null;
		}
	}
}


// --------------------------  Database Connection ---------------------------

/**
  * -> database_connect()
  *
  * Create connection with local database.
  *
  */
function database_connect() {
	global $MYSQL_HOSTNAME, $MYSQL_DATABASE, $MYSQL_USERNAME, $MYSQL_PASSWORD;
	global $db_conn;

	// Default port of MySQL is 8889
	$db_conn = new db("mysql:host=$MYSQL_HOSTNAME;dbname=$MYSQL_DATABASE", 
					  $MYSQL_USERNAME, 
					  $MYSQL_PASSWORD);
}

/**
  * -> retrieve_user(Facebook ID)
  *
  * Retrieve user information by using Facebook ID.
  * 
  */
function retrieve_user($facebook_id) {
	global $TABLE_USER;
	global $db_conn;

	$user = $db_conn->select($TABLE_USER, "Facebook_ID = '$facebook_id'");
		
	return (count($user) > 0) ? $user[0] : NULL;
}

/**
  * -> add_user(Facebook ID, Note)
  *
  * Create a new user, consume a Facebook ID and note(optional).
  * 
  */
function add_user($facebook_id, $note = '') {
	global $TABLE_USER;
	global $db_conn;

	$sql = array(
			"Facebook_ID"	=> $facebook_id,
			"Join_Date"		=> date("Y-m-d H:i:s"),
			"Note"			=> $note
	);

	$db_conn->insert($TABLE_USER, $sql);
}

/**
  * -> del_user(Index ID)
  *
  * Delete a exist user, using index ID.
  * 
  */
function del_user($id) {
	global $TABLE_USER;
	global $db_conn;

	$db_conn->delete($TABLE_USER, "ID = '$id'");
}
	
/**
  * -> is_exist_user(Facebook ID)
  *
  * Check exist user in database using Facebook ID.
  * 
  */
function is_exist_user($facebook_id) {
	return (retrieve_user($facebook_id) != NULL);
}

// --------------------------- Tool Functions ---------------------------------


function create_new_user() {
	global $fb_user_id;

	if (is_exist_user($fb_user_id) || $fb_user_id == NULL) return;
	
	add_user($fb_user_id);
}

function retrieve_user_friends() {
	global $fb_user_id, $fb_user_friends;

	if ($fb_user_id == NULL) return;

	$arr_friends = array();

	foreach ($fb_user_friends['data'] as $friend) {
		if (is_exist_user($friend['id'])) {
			array_push($arr_friends, $friend);
		}
	}
	
	return $arr_friends;
}

function logout_helper() {
	global $facebook;

	$token = $facebook->getAccessToken();
	$url = 'https://www.facebook.com/logout.php?next=' . 
		'http://localhost/waffle/' 
		.'&access_token='.$token;

	session_destroy();
	header('Location: '.$url);
}
// --------------------------------------------------------------------------
	
	


?>

