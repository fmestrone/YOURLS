<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/yourls-api.php':
        require 'yourls-api.php';
        break;
    case '/yourls-go.php':
        require 'yourls-go.php';
        break;
    case '/yourls-infos.php':
        require 'yourls-infos.php';
        break;
    default:
        require 'yourls-loader.php';
}
