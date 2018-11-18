<?php

ini_set("auto_detect_line_endings", true); // vital because some files have Windows ending


$row_count = 0;

$header = array();
$header_lookup = array();

$filename = 'output.tsv';

$file = @fopen($filename, "r") or die("couldn't open $filename");		
$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$row = explode("\t", trim(fgets($file_handle)));
		
	$go = is_array($row);
			
	if ($go && ($row_count == 0))
	{
		$header = $row;
		
		$n = count($header);
		for ($i = 0; $i < $n; $i++)
		{
			$header_lookup[$header[$i]] = $i;
		}
		
		$go = false;
	}
	if ($go)
	{
		//print_r($row);
		
		if (count($row) != 0)
		{
		
			$obj = new stdclass;
		
			foreach ($row as $k => $v)
			{
				if ($v != '')
				{
					$obj->{$header[$k]} = trim($v);
				}
			}

			//print_r($obj);
			
			if (isset($obj->issn))
			{
				$parts = explode('-', $obj->pages);
				$spage = $parts[0];
			
				$sql = 'UPDATE publications SET wikidata="' 
					. preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work) . '"'
					. ' WHERE issn="' . $obj->issn . '"'
					. ' AND volume="' . $obj->volume . '"'
					. ' AND spage="' . $spage . '"'
					. ';';
					
				echo $sql . "\n";
			
			}



		}		
		
	}

	$row_count++;
	
	//if ($row_count > 3) exit();
}

?>
