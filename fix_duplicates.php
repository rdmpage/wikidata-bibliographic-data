<?php

$headings = array();

$row_count = 0;

$filename = "query.tsv";

$ids = array();

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$line = trim(fgets($file_handle));
		
	$row = explode("\t",$line);
	
	$go = is_array($row) && count($row) > 1;
	
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
		
			print_r($obj);	
			
			if (isset($obj->jstor))
			{
			
				if (!isset($ids[$obj->jstor]))
				{
					$ids[$obj->jstor] = array();
				}
				$ids[$obj->jstor][] = str_replace('http://www.wikidata.org/entity/', '', $obj->item);
			}

			if (isset($obj->ia))
			{
			
				if (!isset($ids[$obj->ia]))
				{
					$ids[$obj->ia] = array();
				}
				$ids[$obj->ia][] = str_replace('http://www.wikidata.org/entity/', '', $obj->item);
			}
			
			
		}
	}	
	$row_count++;	
	
}	

print_r($ids);

foreach ($ids as $k => $v)
{
	$n = count($v);
	if ($n > 1)
	{
		$Qdestination = $v[0];
		
		for ($i = 1; $i < $n; $i++)
		{
			$Qsource = $v[$i];
			
			echo "MERGE\t$Qsource\t$Qdestination\n";
		}
		
		
	
	}


}

?>
