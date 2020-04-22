<?php

// parse quickstaments and do some fixing if needed

$headings = array();

$row_count = 0;

$filename = "malaya.txt";

$q = array();

$state = 0;
$P1433 = '';
$id = '';

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$line = trim(fgets($file_handle));
		
	$row = explode("\t",$line);
	
	switch ($state)
	{
		case 0:
			if ($line = 'CREATE')
			{
				$state = 1;
				$P1433 = '';
				$id = '';
			}		
			break;
			
		case 1:
			if (count($row) == 3)
			{
				if ($row[1] == 'P1433')
				{
					$P1433 = $row[2];
				}
			
				if ($row[1] == 'P888')
				{
					$id = str_replace('"', '', $row[2]);
				}
			}
		
			if ($line == '')
			{
				if ($P1433 == '')
				{
					$q[] = $id;
				}
			
			
				$state = 0;
			}
			break;
			
		default:
			break;
	
	}
	
	
}	

echo(join(",", $q));



?>
