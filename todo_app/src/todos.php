<?php
/**
 * Form handler for to-do form
 *
 * @package TodoApp
 */

session_start();
$token = $_SESSION['token'];
unset( $_SESSION['token'] );
session_write_close();

header( 'Location: ' . $_SERVER['HTTP_REFERER'], true, 302 );

// Very basic and crappy CSRF protection.
if ( ! isset( $_POST['action'], $_POST['token'], $token ) || $_POST['token'] !== $token ) {
	exit;
}

require_once dirname( __FILE__ ) . '/class-actions.php';
require_once dirname( __FILE__ ) . '/class-database.php';

switch ( $_POST['action'] ) {
	case Actions::ADD_TODO:
		$db->add_todo( $_POST['todo'] );
		break;
	case Actions::DELETE_TODO:
		$db->delete_todo( $_POST['id'] );
		break;
	case Actions::TOGGLE_TODO:
		$db->toggle_todo( $_POST['id'] );
		break;
	case Actions::CLEAR_COMPLETED:
		$db->clear_completed();
		break;
}

