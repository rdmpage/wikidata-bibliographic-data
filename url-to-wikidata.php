<?php

// Given list of URLs match to Wikidata and update local publications table

require_once (dirname(__FILE__) . '/wikidata.php');

$filename = 'urls.txt';


$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$guid = trim(fgets($file_handle));
	
	echo "-- $guid\n";
	
	$done = false;
	
	if (!$done)
	{
		if (preg_match('/pmid:(?<id>\d+)/', $guid, $m))
		{
			$pmid = $m['id'];
			
			$item = wikidata_item_from_pmid($pmid);
			if ($item)
			{
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE pmid='" . $pmid . "';" . "\n";
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
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}

	if (!$done)
	{
		if (preg_match('/^10\.\d+\//', $guid, $m))
		{
			$item = wikidata_item_from_doi($guid);
			if ($item)
			{
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				//echo "UPDATE publications_tmp SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}
	
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
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}
	
	// CNKI
	if (!$done)
	{
		if (preg_match('/^[A-Z]{4}\d+/', $guid, $m))
		{
			$cnki = $guid;
			
			//echo $cnki . "\n";
			
			$item = wikidata_item_from_cnki($cnki);
			if ($item)
			{
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
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
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}
	
	if (!$done)
	{
		if (preg_match('/\d+\/[a-zA-Z0-9_]+/', $guid))
		{
			//$bhl_part = $m['id'];
			
			$item = wikidata_item_from_handle($guid);
			if ($item)
			{
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}	
	
	
	if (!$done)
	{
		if (preg_match('/https?:\/\/hdl.handle.net\/(?<id>.*)/', $guid, $m))
		{
			$handle = $m['id'];
			
			
			$item = wikidata_item_from_handle($handle);
			if ($item)
			{
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
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
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
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
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
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
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}				
	
	// BioStor
	if (!$done)
	{
		if (preg_match('/https?:\/\/biostor.org\/reference\/(?<id>\d+)/', $guid, $m))
		{
			$biostor = $m['id'];
						
			$item = wikidata_item_from_biostor($biostor);
			if ($item)
			{
				//echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
			else
			{
				echo "Not found $biostor\n";
			}
		}			
	}			
	
	// PMC
	if (!$done)
	{
		if (preg_match('/PMC(?<id>\d+)/', $guid, $m))
		{
			$item = wikidata_item_from_pmc($guid);
			if ($item)
			{
				echo "UPDATE publications_tmp SET wikidata='" . $item . "' WHERE pmc='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}			
	
	// ZooBank
	if (!$done)
	{
		if (preg_match('/zoobank.org\/(?<id>.*)/', $guid, $m))
		{
			$item = wikidata_item_from_zoobank($m['id']);
			if ($item)
			{
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}
		}			
	}			
	

	if (!$done)
	{
		$item = wikidata_item_from_url($guid);
		if ($item)
		{
			echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
			$done = true;
		}		
	}
	
	// SICI?
	// 0037-2102(1999)79<101:TEVPAF>2.0.CO;2-W
	/*
	if (!$done)
	{
		if (preg_match('/(?<issn>[0-9]{4}-[0-9]{3}[0-9X])\([0-9]{4}\)(?<volume>\d+)<(?<spage>\d+)/', $guid, $m))
		{		
			print_r($m);
			$item =  wikidata_item_from_openurl($m['issn'], $m['volume'], $m['spage']);
			if ($item != '')
			{
				echo "UPDATE publications SET wikidata='" . $item . "' WHERE guid='" . $guid . "';" . "\n";
				$done = true;
			}		
		}
	}
	*/
	
	
	

}

fclose($file_handle);

?>
