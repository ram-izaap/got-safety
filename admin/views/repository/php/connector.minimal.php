<?php

error_reporting(0); // Set E_ALL for debuging

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderConnector.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeDriver.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeLocalFileSystem.class.php';
// Required for MySQL storage connector
// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeMySQL.class.php';
// Required for FTP connector support
// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeFTP.class.php';
// ===============================================

/**
 * # Dropbox volume driver need `composer require dropbox-php/dropbox-php:dev-master@dev`
 *  OR "dropbox-php's Dropbox" and "PHP OAuth extension" or "PEAR's HTTP_OAUTH package"
 * * dropbox-php: http://www.dropbox-php.com/
 * * PHP OAuth extension: http://pecl.php.net/package/oauth
 * * PEAR's HTTP_OAUTH package: http://pear.php.net/package/http_oauth
 *  * HTTP_OAUTH package require HTTP_Request2 and Net_URL2
 */
// // Required for Dropbox.com connector support
// // On composer
// require 'vendor/autoload.php';
// elFinder::$netDrivers['dropbox'] = 'Dropbox';
// // OR on pear
// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeDropbox.class.php';

// // Dropbox driver need next two settings. You can get at https://www.dropbox.com/developers
// define('ELFINDER_DROPBOX_CONSUMERKEY',    '');
// define('ELFINDER_DROPBOX_CONSUMERSECRET', '');
// define('ELFINDER_DROPBOX_META_CACHE_PATH',''); // optional for `options['metaCachePath']`
// ===============================================

// // Required for Google Drive network mount
// // Installation by composer
// // `composer require nao-pon/flysystem-google-drive:~1.1 google/apiclient:~2.0@rc nao-pon/elfinder-flysystem-driver-ext`
// // composer autoload
// require 'vendor/autoload.php';
// // Enable network mount
// elFinder::$netDrivers['googledrive'] = 'FlysystemGoogleDriveNetmount';
// // GoogleDrive Netmount driver need next two settings. You can get at https://console.developers.google.com
// // AND reuire regist redirect url to "YOUR_CONNECTOR_URL?cmd=netmount&protocol=googledrive&host=1"
// define('ELFINDER_GOOGLEDRIVE_CLIENTID',     '');
// define('ELFINDER_GOOGLEDRIVE_CLIENTSECRET', '');
// ===============================================

/**
 * Simple function to demonstrate how to control file access using "accessControl" callback.
 * This method will disable accessing files/folders starting from '.' (dot)
 *
 * @param  string  $attr  attribute name (read|write|locked|hidden)
 * @param  string  $path  file path relative to volume root directory started with directory separator
 * @return bool|null
 **/
function access($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
}

$role = $_GET['role'];
$condition =$_GET['condition'];
//echo $condition;exit;
//echo $condition;exit;admin|client|user1|client2|user2|gift|
//admin|client|user1|client2|user2| gift|tester
if($role == 2) {
	$folder = $_GET['name'];
	$url = dirname($_SERVER['PHP_SELF']) . '/../files/'.$folder.'/';
	$path = '../files/';
	
	$final_result = array(
	// 'debug' => true,
	'roots' => array(
		array(
			'driver'        => 'LocalFileSystem',          		 // driver for accessing file system (REQUIRED)
			'path'          => $path,                 			// path to files (REQUIRED)
			'URL'           => $url, 							// URL to files (REQUIRED)
			//'uploadDeny'    => array('all'),                	// All Mimetypes not allowed to upload
			'uploadAllow'   => array('image','application/pdf','audio','video'),	// Mimetype `image` and `text/plain` allowed to upload
			'uploadOrder'   => array('allow', 'deny'),      	// allowed Mimetype `image` and `text/plain` only
			'accessControl' => 'access',
			'attributes' => array(
                array(// hide anything else
                    'pattern' => '!^/'.$condition.'!',
                    'hidden' => true
                )
            )                    
		),
	)
);
		
}else {
	$url = dirname($_SERVER['PHP_SELF']) . '/../files/';
	$path = '../files/';
	$final_result = array(
	// 'debug' => true,
	'roots' => array(
		array(
			'driver'        => 'LocalFileSystem',           	// driver for accessing file system (REQUIRED)
			'path'          => $path,                 			// path to files (REQUIRED)
			'URL'           => $url, 							// URL to files (REQUIRED)
			//'uploadDeny'    => array('all'),              	// All Mimetypes not allowed to upload
			'uploadAllow'   => array('image','application/pdf','audio','video'),	// Mimetype `image` and `text/plain` allowed to upload
			'uploadOrder'   => array('allow', 'deny'),      	// allowed Mimetype `image` and `text/plain` only
			'accessControl' => 'access'
			                   
		)
	)
);
}

$opts = $final_result;

// run elFinder
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();

