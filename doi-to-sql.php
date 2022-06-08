<?php

// Import DOIs as SQL


require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/wikidata.php');

//----------------------------------------------------------------------------------------
// Convert a simple CSL object to SQL
function csl_to_sql($csl)
{
	$keys = array();
	$values = array();
	
	$guid = '';
	
	if ($guid == '')
	{
		if (isset($csl->DOI))
		{
			$guid = $csl->DOI;
		}
	}
	
	if ($guid == '')
	{
		$guid = uniqid();
	}

	$keys[] = 'guid';
	$values[] = '"' . $guid . '"';
	
	$multilingual_keys = array();
	$multilingual_values = array();
	
	$pdf = ''; // just want one PDF
	
	foreach ($csl as $k => $v)
	{
		switch ($k)
		{
			case 'DOI':
				$keys[] ='doi';
				$values[] = '"' . $v . '"';	
				break;			
			
			case 'volume':
			case 'issue':
				$keys[] = $k;
				$values[] = '"' . $v . '"';	
				break;	
	
			case 'container-title':
				if (is_array($v) && count($v) > 0)
				{
					$keys[] = 'journal';
					$values[] = '"' . addcslashes($v[0], '"') . '"';					
				}
				else 
				{
					$keys[] = 'journal';
					$values[] = '"' . addcslashes($v, '"') . '"';					
				}
				break;

			case 'title':
				if (is_array($v) && count($v) > 0)
				{
					$keys[] = 'title';
					$values[] = '"' . addcslashes($v[0], '"') . '"';					
				}
				else 
				{
					$keys[] = 'title';
					$values[] = '"' . addcslashes($v, '"') . '"';	
					
					/*
					$language = 'en';

					if (preg_match('/\p{Han}+/u', $v))
					{
						$language = 'zh';
					}
		
					// multilingual
					$kk = array();
					$vv = array();
					$kk[] = "`key`";
					$vv[] = '"title"';

					$kk[] = 'language';
					$vv[] = '"' . $language . '"';
			
					$kk[] = 'value';
					$vv[] = '"' . addcslashes($v, '"') . '"';

					$multilingual_keys[] = $kk;
					$multilingual_values[] = $vv;
					*/														
				}
				break;

			case 'ISSN':
				if (is_array($v))
				{
					$keys[] = 'issn';
					$values[] = '"' . addcslashes($v[0], '"') . '"';					
				}
				else 
				{
					$keys[] = 'issn';
					$values[] = '"' . addcslashes($v, '"') . '"';					
				}
				break;
	
			case 'issued':
				$keys[] = 'year';
				$values[] = '"' . $v->{'date-parts'}[0][0] . '"';		
				
				$date = array();
				
				if (count($v->{'date-parts'}[0]) > 0) $date[] = $v->{'date-parts'}[0][0];
				if (count($v->{'date-parts'}[0]) > 1) $date[] = str_pad($v->{'date-parts'}[0][1], 2, '0', STR_PAD_LEFT);
				if (count($v->{'date-parts'}[0]) > 2) $date[] = str_pad($v->{'date-parts'}[0][2], 2, '0', STR_PAD_LEFT);

				if (count($date) == 1)
				{
					$date[] = '00';
					$date[] = '00';
				}

				if (count($date) == 2)
				{
					$date[] = '00';
				}
								
				if (count($date) == 3)
				{
					$keys[] = 'date';
					$values[] = '"' . join('-', $date) . '"';						
				}
							
				break;
	
			case 'page':
				if (preg_match('/(?<spage>\d+)-(?<epage>\d+)/', $v, $m))
				{
					$keys[] = 'spage';
					$values[] = '"' . $m['spage'] . '"';					

					$keys[] = 'epage';
					$values[] = '"' . $m['epage'] . '"';					

				}
				else
				{
					$keys[] = 'spage';
					$values[] = '"' . $v . '"';					
		
				}
				break;
			
			case 'article-number':
				$keys[] = 'article_number';
				$values[] = '"' . $v . '"';							
				break;
				
			case 'author':
				$authors = array();
				
				foreach ($v as $author)
				{
					if (isset($author->family))
					{
						$authors[] = $author->given . ' ' . $author->family;
					}
					else
					{
						if (isset($author->literal))
						{
							$authors[] = $author->literal;
						}
					}
				}
				
				if (count($authors) > 0)
				{
	
					$keys[] = 'authors';
					$values[] = '"' . join(';', $authors) . '"';						
				}
				break;
		
			case 'link':
				foreach ($v as $link)
				{
					if (($link->{'content-type'} == 'application/pdf') && ($pdf == ''))
					{
						$keys[] = 'pdf';
						$values[] = '"' . $link->URL . '"';		
					
						$pdf = $link->URL;	
					}
				}					
				break;

			default:
				break;
		}
	}
	
	$sql = 'REPLACE INTO publications(' . join(',', $keys) . ') VALUES (' . join(',', $values) . ');' . "\n";

	/*	
	$n = count($multilingual_keys);
	for($i =0; $i < $n; $i++)
	{
		$multilingual_keys[$i][] = 'guid';
		$multilingual_values[$i][] = '"' . $guid . '"';

		$sql .= 'REPLACE INTO multilingual(' . join(',', $multilingual_keys[$i]) . ') values('
			. join(',', $multilingual_values[$i]) . ');' . "\n";
	}
	*/
	
	return $sql;

}



$dois=array();


$dois=array(
"10.23797/2159-6719_24_1",
"10.23797/2159-6719_24_2",
"10.23797/2159-6719_24_3",
"10.23797/2159-6719_24_4",
"10.23797/2159-6719_24_5",
"10.23797/2159-6719_24_6",
"10.23797/2159-6719_24_7",
"10.23797/2159-6719_24_8",
"10.23797/2159-6719_24_9",
"10.23797/2159-6719_24_10",
"10.23797/2159-6719_24_11",
"10.23797/2159-6719_24_12",
"10.23797/2159-6719_24_13",
"10.23797/2159-6719_24_14",
"10.23797/2159-6719_24_15",
"10.23797/2159-6719_24_16",
"10.23797/2159-6719_24_17",
"10.23797/2159-6719_24_18",
"10.23797/2159-6719_24_19",
"10.23797/2159-6719_24_20",
"10.23797/2159-6719_24_21",
"10.23797/2159-6719_24_22",
"10.23797/2159-6719_24_23",
);


foreach ($dois as $doi)
{
	$doi = strtolower($doi);
	
	// check cache
	
	$id = 'https://doi.org/' . $doi;

	$exists = $couch->exists($id);
	
	if ($exists)
	{
		$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($id));			
		//echo $resp;
		$work = json_decode($resp);
	}
	else
	{
		$work = get_work($doi);
		
		if ($work)
		{
			$work->_id = $id;
		
			// store
			$couch->add_update_or_delete_document($work, $work->_id, 'add');	
		}

	}
	
	if ($work)
	{
		$sql = csl_to_sql($work->message);
		
		echo $sql . "\n";
	}



}


?>
