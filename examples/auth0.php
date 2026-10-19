<?php
require_once __DIR__ . '/../_includes/init.inc.php';
require_once GJC_DIR_INC . '/config.inc.php';

define('GJC_AUTH0_DOMAIN', 'example.auth0.com');
define('GJC_AUTH0_CLIENT_ID', 'xxxxxxxxxx');
define('GJC_AUTH0_CLIENT_SECRET', 'xxxxxxxxxxxxxxxxxxxx');
define('GJC_AUTH0_COOKIE_SECRET', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); // a long random string, e.g. from `openssl rand -hex 32`
define('GJC_AUTH0_LOGIN_URL', 'https://example.com/login.php');
define('GJC_AUTH0_CALLBACK_URL', 'https://example.com/loggedin.php');
define('GJC_AUTH0_AUDIENCE', 'https://example.auth0.com/userinfo');
define('GJC_AUTH0_SCOPE', 'openid profile');
define('GJC_AUTH0_PER_ID_TOKEN', true);
define('GJC_AUTH0_PER_ACCESS_TOKEN', true);
define('GJC_AUTH0_PER_REFRESH_TOKEN', true);

require_once GJC_DIR_ROOT . '/vendor/autoload.php';

$auth0 = new \GJClasses\Auth0();

/*
 * The below actions should be on separate pages.
 */

////////////////////////////////////////////////////////////////////////////////
// LOGIN URL - Display Login Form
////////////////////////////////////////////////////////////////////////////////
$auth0->login();

////////////////////////////////////////////////////////////////////////////////
// CALLBACK URL - Check for errors, then log in (check() exchanges Auth0's code) and return user data
////////////////////////////////////////////////////////////////////////////////
$auth0_error = isset($_GET['error']) ? $_GET['error'] : '';
$auth0_message = isset($_GET['error_description']) ? $_GET['error_description'] : '';
$auth0->errorCheck($auth0_error, $auth0_message);
$user_info = $auth0->check();

////////////////////////////////////////////////////////////////////////////////
// PAGES TO BE PROTECTED - Check if logged in (and return user data)
////////////////////////////////////////////////////////////////////////////////
$user_info = $auth0->check();

////////////////////////////////////////////////////////////////////////////////
// LOGOUT URL - Logout
////////////////////////////////////////////////////////////////////////////////
$auth0->logout();
