<?php

// $Id: //

/**
 * @file config.php
 *
 * Global configuration variables (may be added to by other modules).
 *
 */

global $config;

// Date timezone
date_default_timezone_set('UTC');


// Database-----------------------------------------------------------------------------------------

// CouchDB--------------------------------------------------------------------------------
		
if (1)
{
		// local
		$config['couchdb_options'] = array(
				'database' => 'crossref-cache',
				'host' => 'localhost',
				'port' => 5984,
				'prefix' => 'http://'
				);		
}


$config['stale'] = false;


	
?>