<?php

// read a list of article titles and fix the language


error_reporting(E_ALL);

require_once 'vendor/autoload.php';
use LanguageDetection\Language;

//----------------------------------------------------------------------------------------
// Map language codes to Wikidata items
$language_map = array(
	'ca' => 'Q7026',
	'da' => 'Q9035',
	'de' => 'Q188',
	'en' => 'Q1860',
	'es' => 'Q1321',
	'fr' => 'Q150',
	'it' => 'Q652',
	'ja' => 'Q5287',
	'la' => 'Q397',
	'nl' => 'Q7411',
	'pt' => 'Q5146',
	'ru' => 'Q7737',
	'th' => 'Q9217',
	'zh' => 'Q7850',		
);


$languages_to_detect = array('en', 'de', 'nl');


//----------------------------------------------------------------------------------------
// trim a string nicely
function nice_shorten($str, $length = 250) {
	if (mb_strlen($str) > $length)
	{
		$str = mb_substr($str, 0, $length - 1);
		
		$pos = mb_strrpos($str, ' ');
		if ($pos === false) {
		} else {
			$str = mb_substr($str, 0, $pos);		
		}
		
		$str .= '…';	
	}

	return $str;
}

//----------------------------------------------------------------------------------------


$filename = 'medtitles.txt';

$d = array();
$w = array();


$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$line = trim(fgets($file_handle));
		
	$row = explode("\t",$line);
	
	$item = $row[0];
	
	$title = $row[1];
	
	$ld = new Language($languages_to_detect);						
	$language = $ld->detect($title)->__toString();
	
	if ($language != 'en')
	{
		//echo $language . ' ' . $title . "\n";
		
		// delete
		$d[$item] = array();
		
		$d[$item][] = array('P407' => $language_map['en']);
		$d[$item][] = array('P1476' => 'en:' . '"' . $title . '"');
		
		
		// add
		
		$w[$item] = array();
		
		$w[$item][] = array('P407' => $language_map[$language]);
		
		$w[$item][] = array('P1476' => $language . ':' . '"' . $title . '"');
		
		// label
		$w[$item][] = array('L' . $language => '"' . nice_shorten($title, 250) . '"');
		
		
	
	}

	
}	

$quickstatements = '';


foreach ($w as $item => $statement_list)
{
	foreach ($d[$item] as $statement)
	{
	
		foreach ($statement as $property => $value)
		{
			$row = array();
			$row[] = '-' . $item;
			$row[] = $property;
			$row[] = $value;
	
			$quickstatements .= join("\t", $row);
			$quickstatements .= "\n";
			
		
		}
		
		
	}


	foreach ($statement_list as $statement)
	{
	
		foreach ($statement as $property => $value)
		{
			$row = array();
			$row[] = $item;
			$row[] = $property;
			$row[] = $value;
	
			$quickstatements .= join("\t", $row);
			$quickstatements .= "\n";
			
		
		}
		
		
	}
	$quickstatements .= "\n";
}

echo $quickstatements . "\n";


?>

