<?php

/*

SELECT * WHERE {
  ?work wdt:P1433 wd:Q15766889;
    wdt:P1476 ?title.
  OPTIONAL { ?work wdt:P356 ?doi. }
  OPTIONAL { ?work wdt:P698 ?pmid. }
  OPTIONAL { ?work wdt:P932 ?pmc. }
  OPTIONAL { ?work wdt:P478 ?volume. }
  OPTIONAL { ?work wdt:P433 ?issues. }
  OPTIONAL { ?work wdt:P304 ?pages. }
}

*/

//----------------------------------------------------------------------------------------

$filename = 'query-2.tsv';

$headings = array();

$row_count = 0;

$file = @fopen($filename, "r") or die("couldn't open $filename");
		
$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$row = fgetcsv(
		$file_handle, 
		0, 
		"\t" 
		);
		
	$go = is_array($row);
	
	if ($go)
	{
		if ($row_count == 0)
		{
			$headings = $row;		
		}
		else
		{
			$obj = new stdclass;
		
			foreach ($row as $k => $v)
			{
				if ($v != '')
				{
					$obj->{$headings[$k]} = $v;
				}
			}
		
			//print_r($obj);	
			
			$qid = str_replace('http://www.wikidata.org/entity/', '', $obj->work);
			
			if (1)
			{
				echo $qid . "\n";
			}
			
			
			if (0)
			{
				if (isset($obj->doi))
				{
					echo 'UPDATE publications SET wikidata="' . $qid . '" WHERE doi="' . $obj->doi . '";' . "\n";
				}
			}
			
			if (0)
			{
				if (isset($obj->pages) && isset($obj->volume))
				{
					$parts = preg_split('/[-|—]/u', $obj->pages);
			
					$sql = 'UPDATE publications SET wikidata="' . $qid . '" WHERE issn="2095-8137" AND volume="' . $obj->volume . '" AND spage="' . $parts[0] .'"';
				
					if (count($parts) == 2)
					{
						$sql .= ' AND epage="' . $parts[1] . '"';
					}
				
					$sql .= ';';
				
					echo $sql . "\n";
			
				}
			}
			
		}
	}	
	$row_count++;
}
?>

