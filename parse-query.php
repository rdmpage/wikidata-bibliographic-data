<?php

ini_set("auto_detect_line_endings", true); // vital because some files have Windows ending


$row_count = 0;

$header = array();
$header_lookup = array();

$filename = 'query-2.tsv';
$filename = 'query-3.tsv';
$filename = 'query-4.tsv';
$filename = 'query-5.tsv';
$filename = 'query.tsv';

/*
SELECT * WHERE {
  ?work wdt:P1433 wd:Q21385526;
    wdt:P1476 ?title.
  OPTIONAL { ?work wdt:P356 ?doi. }
  OPTIONAL { ?work wdt:P478 ?volume. }
  OPTIONAL { ?work wdt:P433 ?issues. }
  OPTIONAL { ?work wdt:P304 ?pages. }
  OPTIONAL { ?work wdt:P577 ?date . }
  BIND (YEAR(?date) AS ?year)
}
*/

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
			
			$issn = '0003-049X';
			$issn = '0199-9818';
			$issn = '0024-0974';
			
			if (0)
			{
				if (isset($obj->jstor))
				{
					$sql = 'UPDATE publications SET wikidata="' 
						. preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work) . '"'
						. ' WHERE jstor="' . $obj->jstor . '"'
						. ';';
					
					echo $sql . "\n";
				
			
				}
			}
			
			if (0)
			{
				if (isset($obj->doi))
				{
					$sql = 'UPDATE publications SET wikidata="' 
						. preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work) . '"'
						. ' WHERE doi="' . $obj->doi . '"'
						. ';';
					
					echo $sql . "\n";
				
			
				}			
			}
			
			// simple populate
			if (0)
			{
				if (isset($obj->work))
				{
			
					$keys = array();
					$values = array();
				
					$keys[] = 'guid';
					$values[] = '"' . addcslashes(preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work), '"') . '"';							
				
					$keys[] = 'doi';
					$values[] = '"' . $obj->doi . '"';

					$keys[] = 'issn';
					$values[] = '"' . $issn . '"';
				
					foreach ($obj as $k => $v)
					{
						switch ($k)
						{
							case 'title':
							case 'volume':
							case 'year':
								$keys[] = $k;
								$values[] = '"' . addcslashes($v, '"') . '"';							
								break;
							
							case 'pages':
								$parts = preg_split('/[-|—]/u',$v);
								$keys[] = 'spage';
								$values[] = '"' . addcslashes($parts[0], '"') . '"';	
							
								if (count($parts) == 2)
								{
									$keys[] = 'epage';
									$values[] = '"' . addcslashes($parts[1], '"') . '"';								
								}
								break;
							
							
							case 'work':
								$keys[] = 'wikidata';
								$values[] = '"' . addcslashes(preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work), '"') . '"';							
								break;
							
							default:
								break;
					
					
						}
				
				
					}
				
					echo 'REPLACE INTO publications(' . join(',', $keys) . ') VALUES (' . join(',', $values) . ');' . "\n";
				}
			
			}
			
			/*
			if (isset($obj->volume) && isset($obj->pages))
			{
				$parts = preg_split('/[-|—]/', $obj->pages);
				
				$spage = $parts[0];
				
				$sql = 'UPDATE publications SET wikidata="' 
					. preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work) . '"'
					. ' WHERE issn="' . $issn . '"'
					. ' AND volume="' . $obj->volume . '"'
					. ' AND spage="' . $spage . '"'
					. ';';
					
				echo $sql . "\n";
				
			
			}
			*/
			
			
			/*
			if (isset($obj->volume) && isset($obj->pages))
			{
				$parts = preg_split('/[-|—]/', $obj->pages);
				
				$spage = $parts[0];
				
				$sql = 'UPDATE publications SET wikidata="' 
					. preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work) . '"'
					. ' WHERE issn="' . $issn . '"'
					. ' AND volume="' . $obj->volume . '"'
					. ' AND spage="' . $spage . '"'
					. ';';
					
				echo $sql . "\n";
				
			
			}
			*/
			



		}		
		
	}

	$row_count++;
	
	//if ($row_count > 3) exit();
}

?>
