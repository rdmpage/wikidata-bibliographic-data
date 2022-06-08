<?php

ini_set("auto_detect_line_endings", true); // vital because some files have Windows ending


$row_count = 0;

$header = array();
$header_lookup = array();

$filename = 'bsef.tsv';

$filename = '/Users/rpage/Downloads/query-6.tsv';
$filename = '/Users/rpage/Downloads/query-2.tsv';
$filename = '/Users/rpage/Downloads/query-4.tsv';
$filename = '/Users/rpage/Downloads/query-6.tsv';
$filename = '/Users/rpage/Downloads/query.tsv';
$filename = '/Users/rpage/Downloads/query-2.tsv';
$filename = '/Users/rpage/Downloads/query-3.tsv';
$filename = '/Users/rpage/Downloads/query-4.tsv';
$filename = '/Users/rpage/Downloads/query-14.tsv';


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
			
			if (0)
			{
				// add Wikidata based on DOI
				if (isset($obj->doi))
				{
			
					$sql = 'UPDATE publications_tmp SET wikidata="' 
						. preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work) . '"'
						. ' WHERE doi="' . strtolower($obj->doi) . '"'
						. ' AND wikidata IS NULL'
						. ';';
					
					echo $sql . "\n";
			
				}
			}
			
			if (1)
			{
				// Add Wikidata based on metadata matchso we can get DOI
				if (isset($obj->volume) && isset($obj->pages)
				 //&& !isset($obj->doi)
				 )
				{
					
					$parts = preg_split('/[-|–]/u', $obj->pages);
					
					$sql = 'UPDATE publications SET wikidata="' 
						. preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work) . '"'
						. ' WHERE issn="0254-5853"'
						. ' AND volume="' .$obj->volume . '"'
						. ' AND spage="' . $parts[0] . '"';
						
						if (count($parts) == 2)
						{
							$sql .= ' AND epage="' . $parts[1] . '"';
						}
						
						$sql .=  ' AND wikidata IS NULL'
						. ';';					
					echo $sql . "\n";
				}
			}			
			
			
			// simple metadata
			if (0)
			{
				// Add Wikidata from PMID record based on metadata match
				if (isset($obj->volume) && isset($obj->pages)
				
					
				)
				{
					//$issn = '1674-4918';
					$journal = '植物分类学报';
					
					$parts = preg_split('/[-|–]/u', $obj->pages);
					
					$sql = 'UPDATE publications SET wikidata="' 
						. preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work) . '"'
						. ' WHERE journal="' . $journal . '"'
						. ' AND volume="' .$obj->volume . '"'
						. ' AND spage="' . $parts[0] . '"'
						. ' AND wikidata IS NULL'
						. ';';					
					echo $sql . "\n";
				}
			}			
			
			if (0)
			{
				// Add Wikidata from PMID record based on metadata match
				if (isset($obj->pmid) && isset($obj->volume) && isset($obj->pages)
				
					&& ($obj->year < 2004)
				)
				{
					$issn = '0027-5514';
					
					$parts = preg_split('/[-|–]/u', $obj->pages);
					
					if (count($parts) == 2)
					{
						$sql = 'UPDATE publications_tmp SET pii="' 
							. preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work) . '"'
							. ', pmid=' . $obj->pmid
							. ' WHERE issn="' . $issn . '"'
							. ' AND volume="' . $obj->volume . '"'
							. ' AND spage="' . $parts[0] . '"'
							//. ' AND epage="' . $parts[1] . '"'
							. ' AND pii IS NULL'
							. ';';					
					}
					else
					{
						$sql = 'UPDATE publications_tmp SET pii="' 
							. preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work) . '"'
							. ', pmid=' . $obj->pmid
							. ' WHERE issn="' . $issn . '"'
							. ' AND volume="' .$obj->volume . '"'
							. ' AND spage="' . $parts[0] . '"'
							. ' AND pii IS NULL'
							. ';';					
					
					}
					echo $sql . "\n";
				}
			}
			
			if (0)
			{
				if (isset($obj->doi))
				{
					echo 'UPDATE publications_tmp SET wikidata="' 
							. preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work) . '"'
							. ' WHERE doi="' . strtolower($obj->doi). '"'
							. ' AND wikidata IS NULL'
							. ';'
							. "\n";								
				}
			}			
			
			
			if (0)
			{
				if (isset($obj->doi) && !isset($obj->jstor))
				{
					if (preg_match('/10.2307\/(?<id>\d+)/', $obj->doi, $m))
					{
						echo join("\t", array(preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work), 'P888', '"' . $m['id'] . '"', 'S854', '"https://www.jstor.org/stable/' . $m['id'] . '"')) . "\n";				

					}
			
			
				}
			}
			
			if (0)
			{
				$keys = array();
				$values = array();

			
				$keys[] = 'guid';
				$values[] = '"' . $obj->work . '"';

				$keys[] = 'issn';
				$values[] = '"1000-0739"';

				$keys[] = 'wikidata';
				$values[] = '"' . str_replace('http://www.wikidata.org/entity/', '', $obj->work) . '"';

				if (isset($obj->title))
				{
					$keys[] = 'title';
					$values[] = '"' . addcslashes($obj->title, '"') . '"';	
				}

				if (isset($obj->doi))
				{
					$keys[] = 'doi';
					$values[] = '"' . addcslashes($obj->doi, '"') . '"';	
				}

				if (isset($obj->cnki))
				{
					$keys[] = 'cnki';
					$values[] = '"' . addcslashes($obj->cnki, '"') . '"';	
				}

				if (isset($obj->year))
				{
					$keys[] = 'year';
					$values[] = '"' . addcslashes($obj->year, '"') . '"';	
				}
				
				if (isset($obj->pages))
				{
					$parts = preg_split('/[-|–]/u', $obj->pages);

					$keys[] = 'spage';
					$values[] = '"' . addcslashes($parts[0], '"') . '"';	
				
					if (count($parts) == 2)
					{
						$keys[] = 'epage';
						$values[] = '"' . addcslashes($parts[1], '"') . '"';	
					}				
				}
			
				$sql = 'REPLACE INTO publications(' . join(',', $keys) . ') VALUES (' . join(',', $values) . ');' . "\n";
				
				echo $sql;

			
			}
			
			
			
			
			/*
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
			*/
			
			/*
			{
				$parts = preg_split('/[-|–]/u', $obj->pages);
				$spage = $parts[0];
				
				if (count($parts) == 2)
				{
					$epage = $parts[1];
				}
				else
				{
					$epage = $spage;
				}
				
				
				$volume = $obj->volume - 1895;
				
				$sql = 'UPDATE publications_tmp SET wikidata="' 
					. preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $obj->work) . '"'
					. ' WHERE issn="0037-928X"'
					. ' AND volume="' . $volume . '"'
					. ' AND spage="' . $spage . '"'
					. ' AND epage="' . $epage . '"'
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
