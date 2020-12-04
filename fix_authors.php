<?php

// read a list of article authors and add 


error_reporting(E_ALL);


//----------------------------------------------------------------------------------------


$filename = 'medauthors.txt';

$w = array();


$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$line = trim(fgets($file_handle));
		
	$row = explode("\t",$line);
	
	$item = $row[0];
	
	$w[$item] = array();
	
	$authors = explode(";", $row[1]);
	
	$count = count($authors);
	
	for ($i = 0; $i < $count; $i++)
	{
		// series ordinal
		$qualifier = "\tP1545\t\"" . ($i + 1) . "\"";
	
		$w[$item][] = array('P2093' => '"' . $authors[$i] . '"' . $qualifier);
	}


	
}	

$quickstatements = '';


foreach ($w as $item => $statement_list)
{

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
	//$quickstatements .= "\n";
}

echo $quickstatements . "\n";


?>

