<?php

$headings = array();

$row_count = 0;

$filename = "dups.tsv";

$last_qid = 0;
$last_label = '';


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
		
			//print_r($obj);	
			
			if (preg_match('/(?<label>.*)\s*\(Q(?<id>\d+)\)/u', $obj->Item, $m))
			{
				$qid = $m['id'];
				$label = $m['label'];
				
				//echo $label . "\n";
				
				if ((($last_qid + 1) == $qid) && ($label == $last_label))
				{
					//echo $label . "\n";
					echo "MERGE\tQ$qid\tQ$last_qid\n";
				}
				
				$last_qid = $qid;
				$last_label = $label;
			}
			else{
				//echo "*** bad **\n";
				//exit();
			}
		}
	}	
	$row_count++;	
	
}	


