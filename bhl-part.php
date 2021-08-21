<?php

// Fetch BioStor article


require_once(dirname(__FILE__) . '/wikidata.php');


$ids = array(
241552
);

$start = 0;
$end   = 0;

$check 					= true;
$update 				= false;
$languages 				= array('en', 'fr', 'de', 'es', 'la');
$always_english_label   = true;

//----------------------------------------------------------------------------------------
function get_part_from_bhl_part($id)
{
	$config['api_key'] = '0d4f0303-712e-49e0-92c5-2113a5959159';
	
	$part = null;
	
	$parameters = array(
		'op' 		=> 'GetPartMetadata',
		'partid'	=> $id,
		'apikey'	=> $config['api_key'],
		'format'	=> 'json'
	);
	
	$url = 'https://www.biodiversitylibrary.org/api2/httpquery.ashx?' . http_build_query($parameters);
	
	//echo $url . "\n";
	
	$json = get($url);
	
	$obj = json_decode($json);
	
	// print_r($obj);
	
	if ($obj && isset($obj->Result))
	{
		$part = $obj->Result;
	}
	
	return $part;
	
}



//----------------------------------------------------------------------------------------

//for ($id = $start; $id <= $end; $id++)

foreach ($ids as $id)
{


	$item = wikidata_item_from_bhl_part($id);
	
	if ($item != '')
	{
		//echo "Have $id already: $item\n";
	}
	else
	{
		$part = get_part_from_bhl_part($id);
		
		// print_r($part);
				
		$csl = new stdclass;
		
		$csl->BHLPART = $id;
		
		$csl->license = array(new stdclass);
		$csl->license[0]->URL = $part->LicenseUrl;
		
		$csl->BHL = $part->StartPageID;		
		
		$keys = array('GenreName', 'Title', 'Volume', 'Issue', 'PageRange', 'Doi', 'ContainerTitle');
		
		foreach ($keys as $k)
		{
			if (isset($part->{$k}) && ($part->{$k} != ''))
			{
				switch ($k)
				{
					case 'GenreName':
						switch ($part->{$k})
						{
							case 'Article':
							default:
								$csl->type = "article-journal";
								break;
						}			
						break;
				
					case 'ContainerTitle':
						$csl->{'container-title'} = $part->{$k};
						break;
				
					case 'PageRange':
						$csl->page = $part->{$k};
						break;
				
					default:
						$csl->{strtolower($k)} = $part->{$k};
						break;
				}
			}		
		}
		
		// ISSN?
		if (isset($csl->{'container-title'}))
		{
			switch($csl->{'container-title'})
			{		
				case 'Contributions in science':
					$csl->ISSN[] = '0459-8113';
					break;
				
				default:
					break;
			}
		}
		
		// authors
		$csl->authors = array();
		foreach ($part->Authors as $author)
		{
			$a = new stdclass;
			$a->literal = $author->Name;
			$a->BHL = $author->CreatorID;
			
			$csl->author[] = $a;
		}
		
		// date
		if (isset($part->Date))
		{
			$csl->issued = new stdclass;			
			$csl->issued->{'date-parts'} = array();
			
			if (preg_match("/^[0-9]{4}$/", $part->Date))
			{                
				$csl->issued->{'date-parts'}[0] = array(
						(Integer)$part->Date
					);         
			}		   

			if (preg_match("/^(?<year>[0-9]{4})\-[0-9]{2}\-[0-9]{2}$/", $part->Date, $matches))
			{
				$csl->issued->{'date-parts'}[0] = explode('-', $part->Date);
			}
		}
		
		$work = new stdclass;
		$work->message = $csl;
		
		// print_r($work);

		$source = array();
		$source[] = 'S248';
		$source[] = 'Q172266'; // BHL

		$source[] = 'S854';
		$source[] = '"https://www.biodiversitylibrary.org/part/' . $id . '"';			
		
		$quickstatements = csljson_to_wikidata($work, 
			$check, 
			$update, 
			$languages,
			$source,
			true
			);
			
		echo $quickstatements . "\n";


	}


}


?>
