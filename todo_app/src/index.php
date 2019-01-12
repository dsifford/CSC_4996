<?php
/**
 * Main entrypoint.
 *
 * @package TodoApp
 */

define( 'TODO_APP_LOADED', true );

// Very, very basic CSRF protection. Use something better in real life.
session_start();
$_SESSION['token'] = uniqid();
session_write_close();

require_once dirname( __FILE__ ) . '/class-actions.php';
require_once dirname( __FILE__ ) . '/class-database.php';

require_once dirname( __FILE__ ) . '/templates/header.php';
require_once dirname( __FILE__ ) . '/templates/body.php';
