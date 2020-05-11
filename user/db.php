<?php
// hook our custom function into the 'db_connect_custom_dsn' filter
yourls_add_filter( 'db_connect_custom_dsn', 'gcp_gae_unix_socket_dsn' );

// Set up a Unix socket DSN
function gcp_gae_unix_socket_dsn( $original_dsn ) {
    $dbhost = YOURLS_DB_HOST;
    $dbname = YOURLS_DB_NAME;
    if ( substr($dbhost,0,5) != 'host=' && substr($dbhost,0,12) != 'unix_socket=' ) {
        $dbhost = 'host=' . $dbhost;
    }
	// Get custom port if any
	if ( substr($dbhost,0,5) == 'host=' && false !== strpos( $dbhost, ':' ) ) {
		list( $dbhost, $dbport ) = explode( ':', $dbhost );
		$dbhost = sprintf( '%1$s;port=%2$d', $dbhost, $dbport );
	}
	$dsn = 'mysql:' . $dbhost . ';dbname=' . $dbname ;
    return $dsn;
}

require_once(YOURLS_INC.'/class-mysql.php');
yourls_db_connect();
