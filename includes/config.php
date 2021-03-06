<?php
/* This is a sample config file.
 * Edit this file with your own settings and save it as "config.php"
 *
 * IMPORTANT: edit and save this file as plain ASCII text, using a text editor, for instance TextEdit on Mac OS or
 * Notepad on Windows. Make sure there is no character before the opening <?php at the beginning of this file.
 */

use Google\Cloud\Logging\LoggingClient;
$logger = LoggingClient::psrBatchLogger('yourls-gaefront');

/*
 ** MySQL settings - You can get this info from your web host
 */

/** MySQL database username */
define( 'YOURLS_DB_USER', $_ENV['YOURLS_DB_USER'] );
$logger->debug('MySQL database username ' . YOURLS_DB_USER);

/** MySQL database password */
define( 'YOURLS_DB_PASS', $_ENV['YOURLS_DB_PASS'] );

/** The name of the database for YOURLS */
define( 'YOURLS_DB_NAME', $_ENV['YOURLS_DB_NAME'] );
$logger->debug('The name of the database ' . YOURLS_DB_NAME);


/** MySQL hostname.
 ** If using a non standard port, specify it like 'hostname:port', eg. 'localhost:9999' or '127.0.0.1:666' */
define( 'YOURLS_DB_HOST', $_ENV['YOURLS_DB_HOST'] );
$logger->debug('MySQL hostname ' . YOURLS_DB_HOST);

/** MySQL tables prefix */
define( 'YOURLS_DB_PREFIX', $_ENV['YOURLS_DB_PREFIX'] );
$logger->debug('MySQL tables prefix ' . YOURLS_DB_PREFIX);

/*
 ** Site options
 */

/** YOURLS installation URL -- all lowercase and with no trailing slash.
 ** If you define it to "http://sho.rt", don't use "http://www.sho.rt" in your browser (and vice-versa) */
define( 'YOURLS_SITE', rtrim($_ENV['YOURLS_SITE'], '/') );
$logger->debug('YOURLS installation URL ' . YOURLS_SITE);

/** Server timezone GMT offset */
define( 'YOURLS_HOURS_OFFSET', $_ENV['YOURLS_HOURS_OFFSET'] ); 
$logger->debug('Server timezone GMT offset ' . YOURLS_HOURS_OFFSET);

/** YOURLS language
 ** Change this setting to use a translation file for your language, instead of the default English.
 ** That translation file (a .mo file) must be installed in the user/language directory.
 ** See http://yourls.org/translations for more information */
define( 'YOURLS_LANG', $_ENV['YOURLS_LANG'] ); 
$logger->debug('YOURLS language ' . YOURLS_LANG);

/** Allow multiple short URLs for a same long URL
 ** Set to true to have only one pair of shortURL/longURL (default YOURLS behavior)
 ** Set to false to allow multiple short URLs pointing to the same long URL (bit.ly behavior) */
define( 'YOURLS_UNIQUE_URLS', $_ENV['YOURLS_UNIQUE_URLS'] );
$logger->debug('Allow multiple short URLs ' . YOURLS_UNIQUE_URLS);

/** Private means the Admin area will be protected with login/pass as defined below.
 ** Set to false for public usage (eg on a restricted intranet or for test setups)
 ** Read http://yourls.org/privatepublic for more details if you're unsure */
define( 'YOURLS_PRIVATE', $_ENV['YOURLS_PRIVATE'] );
$logger->debug('Private site ' . YOURLS_PRIVATE);

/** A random secret hash used to encrypt cookies. You don't have to remember it, make it long and complicated. Hint: copy from http://yourls.org/cookie **/
define( 'YOURLS_COOKIEKEY', $_ENV['YOURLS_COOKIEKEY'] );

/** Username(s) and password(s) allowed to access the site. Passwords either in plain text or as encrypted hashes
 ** YOURLS will auto encrypt plain text passwords in this file
 ** Read http://yourls.org/userpassword for more information */
define( 'YOURLS_NO_HASH_PASSWORD', true ); // no need for YOURLS to try and hash passwords as they are not here!
$user_passwords = explode(';', $_ENV['YOURLS_ETC_PASSWD']);
$yourls_user_passwords = array();
foreach ($user_passwords as $user_password) {
    $entry = explode(':', $user_password, 2);
    $logger->debug("Username {$entry[0]}"); // TODO Hide password
    $yourls_user_passwords[$entry[0]] = $entry[1];
}

/** Debug mode to output some internal information
 ** Default is false for live site. Enable when coding or before submitting a new issue */
define( 'YOURLS_DEBUG', $_ENV['YOURLS_DEBUG'] );
$logger->debug('Debug mode ' . YOURLS_DEBUG);
	
/*
 ** URL Shortening settings
 */

/** URL shortening method: 36 or 62 */
define( 'YOURLS_URL_CONVERT', $_ENV['YOURLS_URL_CONVERT'] );
$logger->debug('URL shortening method ' . YOURLS_URL_CONVERT);

/*
 * 36: generates all lowercase keywords (ie: 13jkm)
 * 62: generates mixed case keywords (ie: 13jKm or 13JKm)
 * Stick to one setting. It's best not to change after you've started creating links.
 */

/** 
* Reserved keywords (so that generated URLs won't match them)
* Define here negative, unwanted or potentially misleading keywords.
*/
$banned_words = explode(';', $_ENV['YOURLS_ETC_BANNED']);
$yourls_reserved_URL = array();
foreach ($banned_words as $banned_word) {
    $yourls_reserved_URL[] = $banned_word;
    $logger->debug("Banned word '$banned_word'");
}

/*
 ** Personal settings would go after here.
 */
