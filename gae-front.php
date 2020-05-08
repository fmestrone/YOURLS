<?php
// This is needed in order to autoload composer dependency classes
require_once __DIR__ . '/vendor/autoload.php';

// This needs the require_once statement above
use Google\Cloud\Logging\LoggingClient;
$logger = LoggingClient::psrBatchLogger('yourls-gaefront');

$url_path = @parse_url($_SERVER['REQUEST_URI'])['path'];
$url_path = trim($url_path, "/");

$logger->debug("URL Path: $url_path");

if (empty($url_path)) {
    // If you want an index page for the website, it goes here
    $logger->debug("URL Path Result: No Index Page");
    http_response_code(404);
    die();
} else if ($url_path == 'admin') { // includes/functions.php line 1750
    $logger->debug("URL Path Result: Admin Index");
    require('admin/index.php');
} else if (substr($url_path, 0, 6) == 'admin/') {
    $logger->debug("URL Path Result: Other Admin Page");
    require($url_path);
} else {
    switch ($url_path) {
        // TODO: Looks like this is not needed
        // case 'yourls-api.php':
        // case 'yourls-go.php':
        // case 'yourls-infos.php':
        //     $logger->debug("URL Path Result: Other Top Level YOURLS Page");
        //     require($url_path);
        //     break;
        default:
            $logger->debug("URL Path Result: YOURLS Loader");
            require('yourls-loader.php');
    }
}
