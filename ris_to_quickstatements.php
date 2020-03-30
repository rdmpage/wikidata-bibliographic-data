<?php

// import from RIS

require_once(dirname(__FILE__) . '/ris2csl.php');
require_once(dirname(__FILE__) . '/wikidata.php');


//--------------------------------------------------------------------------------------------------
function ris_import($reference)
{
	//print_r($reference);
	
	$doc = new stdclass;
	$doc->message = $reference;
	
	$quickstatements = csljson_to_wikidata($doc);
	
	echo $quickstatements;

	
}




//--------------------------------------------------------------------------------------------------
$filename = '';
if ($argc < 2)
{
	echo "Usage: import_ris.php <RIS file> \n";
	exit(1);
}
else
{
	$filename = $argv[1];
}

$file = @fopen($filename, "r") or die("couldn't open $filename");
fclose($file);

import_ris_file($filename, 'ris_import');


?>