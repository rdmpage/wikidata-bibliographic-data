<?php


$filename = "lepdup.tsv";

$dois = array();

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$line = trim(fgets($file_handle));
		
	$row = explode("\t",$line);
	
	if (is_array($row))
	{
		if (!isset($dois[$row[0]]))
		{
			$dois[$row[0]] = array();
		}
		$dois[$row[0]][] = $row[1];
	

	}	

	
}	

// print_r($dois);

foreach ($dois as $k => $v)
{
	if (count($v) > 1)
	{
		sort($v);
		//print_r($v);
		
		// wikidata
		//echo "MERGE\t" . $v[1] . "\t" . $v[0] . "\n";
		
		// sql
		echo 'DELETE FROM publications WHERE wikidata="' . $v[1] . '";' . "\n";
	}

}

?>




