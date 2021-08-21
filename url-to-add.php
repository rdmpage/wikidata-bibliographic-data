<?php

// Given list of URLs match to Wikidata if not found add to list to add

require_once (dirname(__FILE__) . '/wikidata.php');

$filename = 'urls.txt';

$to_do = array();

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
	
	echo "-- $guid\n";
	
	$done = false;
	
	/*
	if (!$done)
	{
		if (preg_match('/pmid:(?<id>\d+)/', $guid, $m))
		{
			$pmid = $m['id'];
			
			$item = wikidata_item_from_pmid($pmid);
			if ($item)
			{
				echo "UPDATE names SET wikidata='" . $item . "' WHERE pmid='" . $pmid . "';" . "\n";
				$done = true;
			}
		}			
	}
		
	
	if (!$done)
	{
		if (preg_match('/https?:\/\/www.jstor.org\/stable\/(?<id>.*)/', $guid, $m))
		{
			$jstor = $m['id'];
			
			//echo $jstor . "\n";
			
			$item = wikidata_item_from_jstor($jstor);
			if ($item)
			{
				echo "UPDATE names SET wikidata='" . $item . "' WHERE jstor='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}
	*/
	
	if (!$done)
	{
		if (preg_match('/^10\.\d+\//', $guid, $m))
		{
			$item = wikidata_item_from_doi($guid);
			if ($item)
			{
				//echo "UPDATE names SET wikidata='" . $item . "' WHERE doi='" . $guid . "';" . "\n";
				//echo "UPDATE names_indexfungorum SET wikidata='" . $item . "' WHERE doi='" . $guid . "';" . "\n";
				
				echo "found $item\n";
				
				$done = true;
			}
		}			
	}
	
	/*
	// http://www.cnki.com.cn/Article/CJFDTOTAL-KCFL197901001.htm
	if (!$done)
	{
		if (preg_match('/www.cnki.com.cn\/Article\/CJFDTOTAL-(?<id>.*)\.htm/', $guid, $m))
		{
			$cnki = $m['id'];
			
			//echo $cnki . "\n";
			
			$item = wikidata_item_from_cnki($cnki);
			if ($item)
			{
				echo "UPDATE names SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}
		
	if (!$done)
	{
		if (preg_match('/biodiversitylibrary.org\/part\/(?<id>\d+)/', $guid, $m))
		{
			$bhl_part = $m['id'];
			
			$item = wikidata_item_from_bhl_part($bhl_part);
			if ($item)
			{
				echo "UPDATE names SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}
	
	if (!$done)
	{
		if (preg_match('/\d+\/[A-Z0-9_]+/', $guid))
		{
			//$bhl_part = $m['id'];
			
			$item = wikidata_item_from_handle($guid);
			if ($item)
			{
				echo "UPDATE names SET wikidata='" . $item . "' WHERE handle='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}	
	
	/*
	if (!$done)
	{
		if (preg_match('/https?:\/\/hdl.handle.net\/(?<id>.*)/', $guid, $m))
		{
			$handle = $m['id'];
			
			
			$item = wikidata_item_from_handle($handle);
			if ($item)
			{
				echo "UPDATE names SET wikidata='" . $item . "' WHERE handle='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}		
	
	// http://scholarspace.manoa.hawaii.edu/handle/
	if (!$done)
	{
		if (preg_match('/http:\/\/scholarspace.manoa.hawaii.edu\/handle\/(?<id>.*)/', $guid, $m))
		{
			$handle = $m['id'];
			
			
			$item = wikidata_item_from_handle($handle);
			if ($item)
			{
				echo "UPDATE names SET wikidata='" . $item . "' WHERE handle='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}	
	
	// DIALNET
	if (!$done)
	{
		if (preg_match('/https?:\/\/dialnet.unirioja.es\/servlet\/articulo\?codigo=(?<id>\d+)/', $guid, $m))
		{
			$dialnet = $m['id'];
						
			$item = wikidata_item_from_dialnet($dialnet);
			if ($item)
			{
				echo "UPDATE names SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}				


	// CINII
	if (!$done)
	{
		if (preg_match('/https?:\/\/ci.nii.ac.jp\/naid\/(?<id>\d+)/', $guid, $m))
		{
			$cinii = $m['id'];
						
			$item = wikidata_item_from_cinii($cinii);
			if ($item)
			{
				echo "UPDATE names SET wikidata='" . $item . "' WHERE cinii='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}				
	

	if (!$done)
	{
		$item = wikidata_item_from_url($guid);
		if ($item)
		{
			echo "UPDATE names SET wikidata='" . $item . "' WHERE url='" . $guid . "';" . "\n";
			$done = true;
		}		
	}
	*/
	

	if ($item == '')
	{
		$to_do[] = $guid;
	
	}
	
	
	

}

fclose($file_handle);

print_r($to_do);

?>
