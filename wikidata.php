<?php

require_once 'vendor/autoload.php';
use LanguageDetection\Language;


//----------------------------------------------------------------------------------------
// trim a string nicelt
function nice_shorten($str, $length = 250) {
	if (mb_strlen($str) > $length)
	{
		$str = mb_substr($str, 0, $length - 1);
		
		$pos = mb_strrpos($str, ' ');
		if ($pos === false) {
		} else {
			$str = mb_substr($str, 0, $pos);		
		}
		
		$str .= '…';	
	}

	return $str;
}


//----------------------------------------------------------------------------------------
function get($url, $user_agent='', $content_type = '')
{	
	$data = null;

	$opts = array(
	  CURLOPT_URL =>$url,
	  CURLOPT_FOLLOWLOCATION => TRUE,
	  CURLOPT_RETURNTRANSFER => TRUE
	);

	if ($content_type != '')
	{
		
		$opts[CURLOPT_HTTPHEADER] = array(
			"Accept: " . $content_type, 
			"User-agent: Mozilla/5.0 (iPad; U; CPU OS 3_2_1 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Mobile/7B405" 
		);
		
	}
	
	$ch = curl_init();
	curl_setopt_array($ch, $opts);
	$data = curl_exec($ch);
	$info = curl_getinfo($ch); 
	curl_close($ch);
	
	return $data;
}

//----------------------------------------------------------------------------------------
// Does wikidata have this funder with a Crossref funder DOI
function wikidata_funder_from_doi($doi)
{
	$item = '';
	
	$id = $doi;
	$id = strtoupper(str_replace('10.13039/', '', $id));
	
	$sparql = 'SELECT * WHERE { ?funder wdt:P3153 "' . $id . '" }';
	
	// echo $sparql . "\n";
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->funder->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
// Does wikidata have this DOI?
function wikidata_item_from_doi($doi)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P356 "' . strtoupper($doi) . '" }';
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
// Does wikidata have this URL?
function wikidata_item_from_url($url)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P953 <' . $url . '> }';
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
	
		
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
// Does wikidata have this JSTOR id?
function wikidata_item_from_jstor($jstor)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P888 "' . $jstor . '" }';
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
// Does wikidata have this BHL part id?
function wikidata_item_from_bhl_part($bhl_part)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P6535 "' . $bhl_part . '" }';
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}


//----------------------------------------------------------------------------------------
// Does wikidata have this BioStor id?
function wikidata_item_from_biostor($biostor)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P5315 "' . $biostor . '" }';
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
// Does wikidata have this CNKI?
function wikidata_item_from_cnki($cnki)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P6769 "' . $cnki . '" }';
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}


//----------------------------------------------------------------------------------------
// Does wikidata have this PDF
function wikidata_item_from_pdf($pdf)
{
	$item = '';
	
	// URI
	$sparql = 'SELECT * WHERE { ?work wdt:P953 <' . $pdf . '> }';
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
			
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
// Does wikidata have this Handle id?
function wikidata_item_from_handle($handle)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P1184 "' . $handle . '" }';
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
// Do we have a journal with this ISSN?
function wikidata_item_from_issn($issn)
{
	$cached_issn = array(
		'0067-0464' => 'Q15214730', // Records of the Auckland Institute and Museum
		'0001-804X' => 'Q58814054', // Adansonia nouvelle série
	);

	$item = '';
	
	if (isset($cached_issn[$issn]))
	{
		$item = $cached_issn[$issn];
	}
	else
	{
	
		$sparql = 'SELECT * WHERE { ?work wdt:P236 "' . strtoupper($issn) . '" }';
	
		$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
		$json = get($url, '', 'application/json');
	
		if ($json != '')
		{
			$obj = json_decode($json);
			if (isset($obj->results->bindings))
			{
				if (count($obj->results->bindings) != 0)	
				{
					$item = $obj->results->bindings[0]->work->value;
					$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
				}
			}
		}
	}
		
	return $item;
}

//----------------------------------------------------------------------------------------
function wikidata_item_from_journal_name($name, $language = 'en')
{
	$item = '';
	
	// Try  description
	$sparql = 'SELECT * WHERE { ?item rdfs:label "' . addcslashes($name, '"') . '"@' . $language . ' . ?item wdt:P31 wd:Q5633421}';

	
	// echo $sparql . "\n";
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
	
	if ($json != '')
	{
		$obj = json_decode($json);
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->item->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
function wikidata_item_from_orcid($orcid)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?author wdt:P496 "' . $orcid . '" }';
	
	//echo $sparql . "\n";
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
	
	if ($json != '')
	{
		$obj = json_decode($json);
		
		//print_r($obj);
		
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) == 1)	
			{
				$item = $obj->results->bindings[0]->author->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
function wikidata_item_from_wikispecies_author($wikispecies)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { VALUES ?article {<https://species.wikimedia.org/wiki/' . urlencode($wikispecies) . '> } ?article schema:about ?author . ?author wdt:P31 wd:Q5 . }';
	
	//echo $sparql . "\n";
	//echo urlencode($sparql) . "\n";
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
	
	if ($json != '')
	{
		$obj = json_decode($json);
		
		//print_r($obj);
		
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) == 1)	
			{
				$item = $obj->results->bindings[0]->author->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}

//----------------------------------------------------------------------------------------
// Convert a csl json object to Wikidata quickstatments
function csljson_to_wikidata($work, $check = true, $update = true, $languages_to_detect = array('en'), $source = array())
{

	$MAX_LABEL_LENGTH = 250;

	$quickstatements = '';
	
	// Map language codes to Wikidata items
	$language_map = array(
		'da' => 'Q9035',
		'de' => 'Q188',
		'en' => 'Q1860',
		'es' => 'Q1321',
		'fr' => 'Q150',
		'ja' => 'Q5287',
		'nl' => 'Q7411',
		'pt' => 'Q5146',
		'ru' => 'Q7737',
		'th' => 'Q9217',
		'zh' => 'Q7850',		
	);
	

	// Do we have this already in wikidata?
	$item = '';
	
	if ($check)
	{
	
		// DOI
		if (isset($work->message->DOI))
		{
			$item = wikidata_item_from_doi($work->message->DOI);
		}
	
		// JSTOR
		if ($item == '')
		{
			if (isset($work->message->JSTOR))
			{
				$item = wikidata_item_from_jstor($work->message->JSTOR);
			
			}
		}	
		
		
		// HANDLE
		if ($item == '')
		{
			if (isset($work->message->HANDLE))
			{
				$item = wikidata_item_from_handle($work->message->HANDLE);
			
			}
		}					
	
		// BioStor
		if ($item == '')
		{
			if (isset($work->message->BIOSTOR))
			{
				$item = wikidata_item_from_biostor($work->message->BIOSTOR);
			}
		}		

		// CNKI
		if ($item == '')
		{
			if (isset($work->message->CNKI))
			{
				$item = wikidata_item_from_cnki($work->message->CNKI);
			}
		}		
	
		// PDF
		if ($item == '')
		{
			if (isset($work->message->link))
			{
				foreach ($work->message->link as $link)
				{
					if ($link->{'content-type'} == 'application/pdf')
					{
						$item = wikidata_item_from_pdf($link->URL);
					}
				}
			}
		}
		
		// OpenURL
		if ($item == '')
		{
			$parts = array();
	
			if (isset($work->message->ISSN))
			{
				$parts[] = $work->message->ISSN[0];
			}
			if (isset($work->message->volume))
			{
				$parts[] = $work->message->volume;
			}
			if (isset($work->message->page))
			{
				if (preg_match('/^(?<spage>\d+)(-\d+)?/', $work->message->page, $m))
				{
					$parts[] = $m['spage'];
				}
			}
			
			//print_r($parts);
	
			if (count($parts == 3))
			{
				$item = wikidata_item_from_openurl($parts[0], $parts[1], $parts[2]);
			}
		}

	}
	
	if ($item != '')
	{
		// already exists, if $update is false exit
		
		//echo "Have item $item\n";
		
		if (!$update)
		{
			return;
		}	
	}
	
	
	if ($item == '')
	{
		$item = 'LAST';
	}
	
	$w = array();
	
	/*
$this->props = array(
			'pmid' => 'P698' ,
			'pmcid' => 'P932' ,
			'doi' => 'P356' ,
			'title' => 'P1476' ,
			'published in' => 'P1433' ,
			'original language' => 'P364' ,
			'volume' => 'P478' ,
			'page' => 'P304' ,
			'issue' => 'P433' ,
			'publication date' => 'P577' ,
			'main subject' => 'P921' ,
			'author' => 'P50' ,
			'short author' => 'P2093' ,
			'order' => 'P1545' ,
		) ;*/
		
	$wikidata_properties = array(
		'type'					=> 'P31',
		'BHL' 					=> 'P687',
		'BHLPART' 				=> 'P6535',
		'BIOSTOR' 				=> 'P5315',
		'CNKI'					=> 'P6769',
		'DOI' 					=> 'P356',
		'HANDLE'				=> 'P1184',
		'JSTOR'					=> 'P888',
		'PMID'					=> 'P698',
		'PMC' 					=> 'P932',
		'URL'					=> 'P953',	// https://twitter.com/EvoMRI/status/1062785719096229888
		'title'					=> 'P1476',	
		'volume' 				=> 'P478',
		'issue' 				=> 'P433',
		'page' 					=> 'P304',
		'PDF'					=> 'P953',
		'ARCHIVE'				=> 'P724',
		'ZOOBANK_PUBLICATION' 	=> 'P2007',
		'abstract'				=> 'P1922', // first line
	);
	
	// Need to think how to handle multi tag
	
	foreach ($work->message as $k => $v)
	{
	
		switch ($k)
		{
			case 'type':
				switch ($v)
				{
					case 'article-journal':
					case 'journal-article':
					default:
						$w[] = array('P31' => 'Q13442814');
						break;
				}
				break;
		
			case 'title':
				// Handle multiple languages
				$done = false;
				
				if (isset($work->message->multi))
				{
					if (isset($work->message->multi->_key->title))
					{					
						foreach ($work->message->multi->_key->title as $language => $v)
						{
							// title
							$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . str_replace('"', '""', $v) . '"');

							// label
							$w[] = array('L' . $language => '"' . str_replace('"', '""', nice_shorten($v, $MAX_LABEL_LENGTH)) . '"');
						}					
						$done = true;
					}					
				}
			
				if (!$done)
				{			
					$title = $v;
					if (is_array($v))
					{
						if (count($v) == 0)
						{
							$title = '';
						}
						{
							$title = $v[0];
						}
					}				
					
					if ($title != '')
					{
				
						// We always want a title for the English language, even if
						// it isn't English
						$language = 'en';					
						$title = strip_tags($title);
						
						$title = html_entity_decode($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
					
						/*
						// title
						$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . addcslashes($title, '"') . '"');
						// label
						$w[] = array('L' . $language => '"' . addcslashes($title, '"') . '"');
						*/
										
					
						if (1)
						{
							$language == 'en';
							
							$detect = true;
							
							if (count($languages_to_detect) == 1 && $languages_to_detect[0] == 'en')
							{
								//echo "Assume English\n";
							
								// English is default
								$detect = false;
								
								
							}
							
							if ($detect)
							{			
								//echo "Detect language\n";
											
								// Detect language of title
								$ld = new Language($languages_to_detect);						
								$language = $ld->detect($title)->__toString();
							}
						
							if ($language == 'en')
							{
								// Assume work is English
								$w[] = array('P407' => $language_map[$language]);

								// title
								$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . str_replace('"', '""', $title) . '"');

								// label
								$w[] = array('L' . $language => '"' . str_replace('"', '""', nice_shorten($title, $MAX_LABEL_LENGTH)) . '"');
							
							
							}
							else											
							{
								// title
								$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . str_replace('"', '""', $title) . '"');

								// label
								$w[] = array('L' . $language => '"' . str_replace('"', '""', nice_shorten($title, $MAX_LABEL_LENGTH)) . '"');
							
								// language of work (assume it is the same as the title)
								$w[] = array('P407' => $language_map[$language]);							
							
								// add label in English anyway
								$w[] = array('Len' => '"' . str_replace('"', '""', nice_shorten($title, $MAX_LABEL_LENGTH)) . '"');
							
							}	
						}
					}					
			
				}
				break;
				
			case 'author':
				// For now just use author names, but will want to do lookup to see if there is an item for each person
				// in which case we would only add the item, not the name (can have one or the other)
				// Note that we can't seem to add language codes to author names, they are just dumb strings
				$count = 1;
				foreach ($work->message->author as $author)
				{
					/*
					if (isset($author->multi))
					{
						if (isset($author->multi->_key->literal))
						{
							foreach ($author->multi->_key->literal as $language => $v)
							{
								$w[] = array('P2093' => $language . ':' . '"' . addcslashes($v, '"') . '"' . "\tP1545\t\"$count\"");
							}											
						}
					}
					*/
					
					$done = false;
					
					
					// Do we have an ORCID?
					if (!$done)
					{
						if (isset($author->ORCID))
						{
							$orcid = $author->ORCID;
							$orcid = preg_replace('/https?:\/\/orcid.org\//', '', $orcid);
							
							// echo "orcid =$orcid\n"; 
						
							$author_item = wikidata_item_from_orcid($orcid);
						
							if ($author_item != '')
							{							
								$w[] = array('P50' => $author_item . "\tP1545\t\"$count\"");
								$done = true;
							}						
						}						
					}
					
					// Do we have WIKISPECIES?
					if (!$done)
					{
						if (isset($author->WIKISPECIES))
						{
							$author_item = wikidata_item_from_wikispecies_author($author->WIKISPECIES);
						
							if ($author_item != '')
							{							
								$w[] = array('P50' => $author_item . "\tP1545\t\"$count\"");
								$done = true;
							}						
						}						
					}
					
					// If we've reached this point we only have literals, so add these
					
					if (!$done)
					{
						$name = '';
						
						// multilingual?
						if (isset($author->multi->_key->literal))
						{
							$strings = array();
							
							foreach ($author->multi->_key->literal as $language => $v)
							{
								$strings[] = $v;
							}
							
							$name = join("/", $strings);				
						}
						else 
						{						
							if (isset($author->literal))
							{
								$name = $author->literal;
							}
							else
							{
								$parts = array();
								if (isset($author->given))
								{
									$parts[] = $author->given;
								}
								if (isset($author->family))
								{
									$parts[] = $author->family;
								}
								$name = join(' ', $parts);				
							}
						}
					
						$qualifier = "\tP1545\t\"$count\"";
					
						if (isset($author->affiliation))
						{
							foreach ($author->affiliation as $affiliation)
							{
								if (isset($affiliation->name))
								{
									$qualifier .= "\tP6424\t\"" . addcslashes($affiliation->name, '"') . '"';
								}
							}						
						}						
					
						$w[] = array('P2093' => '"' . addcslashes($name, '"') . '"' . $qualifier);

					}
					$count++;
				}
				break;
		
			case 'volume':
			case 'issue':
			case 'page':
				$w[] = array($wikidata_properties[$k] => '"' . addcslashes($v, '"') . '"');
				break;
				
			case 'BHL':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;

			case 'BHLPART':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;

			case 'BIOSTOR':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;

			case 'CNKI':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
				
			case 'DOI':
				$w[] = array($wikidata_properties[$k] => '"' . strtoupper($v) . '"');
				break;
				
			case 'JSTOR':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
								
			case 'HANDLE':
				$w[] = array($wikidata_properties[$k] => '"' . strtoupper($v) . '"');
				break;								
				
			case 'ARCHIVE':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
				
			case 'PMID':
				$w[] = array($wikidata_properties[$k] => '"' . strtoupper($v) . '"');
				break;								
				
			// BioStor CSL-JSON
			case 'bhl_pages':
				// Get first element of page array
				// https://stackoverflow.com/a/42066999/9684
				$w[] = array($wikidata_properties['BHL'] => '"' . current($v) . '"');
				break;
			
			
			case 'URL':
				if (is_array($v))
				{
					foreach ($v as $url)
					{
						$go = true;
						
						if (preg_match('/https?:\/\/www.jstor.org/', $url))
						{
							// force JSTOR to be https						
							$url = preg_replace('/http:\/\/www.jstor.org/', 'https://www.jstor.org', $url);
							// For now ignore JSTOR URLs
							$go = false;
						}						
					
						if ($go)
						{
							$w[] = array($wikidata_properties[$k] => '"' . $url . '"');
						}
					}
				}
				else
				{		
					$url = $v;
					$go = true;
					
					if (preg_match('/https?:\/\/www.jstor.org/', $url))
					{
						// force JSTOR to be https						
						$url = preg_replace('/http:\/\/www.jstor.org/', 'https://www.jstor.org', $url);
						// For now ignore JSTOR URLs
						$go = false;
					}						
				
					if ($go)
					{
						$w[] = array($wikidata_properties[$k] => '"' . $url . '"');
					}
				}
				break;
				
			case 'WIKISPECIES':
				$w[] = array('Sspecieswiki' => $v);
				break;
				
			case 'ZOOBANK':
				$w[] = array($wikidata_properties['ZOOBANK_PUBLICATION'] => '"' . $v . '"');
				break;				
				
			case 'link':
				foreach ($v as $link)
				{
					if ($link->{'content-type'} == 'application/pdf')
					{
						// do we have an archive version?
						if (isset($work->message->WAYBACK))
						{
							$wayback = $work->message->WAYBACK;
							
							if (!preg_match('/^\//', $wayback))
							{
								$wayback = '/' . $wayback;
							}
						
							$qualifier = "\tP1065\t\"https://web.archive.org" . $wayback . '"';
							$w[] = array($wikidata_properties['PDF'] => '"' . $link->URL . '"' . $qualifier);
						}
						else
						{
							$w[] = array($wikidata_properties['PDF'] => '"' . $link->URL . '"');
						}
						
					}
				}
				break;
								
			case 'container-title':
				$container = $v;
				if (is_array($v))
				{
					$container = $v[0];
				}
				
				// OK, we need to link this to a Wikidata item
				
				// try via ISSN
				$journal_item = '';
				
				if ($journal_item == '')
				{
					if (isset($work->message->ISSN))
					{
						$n = count($work->message->ISSN);
						$i = 0;
						while (($journal_item == '') && ($i < $n))
						{
							$journal_item = wikidata_item_from_issn($work->message->ISSN[$i]);
							$i++;
						}
					}
				}	
				
				if ($journal_item == '')
				{
					// try to find from name
					$journal_item = wikidata_item_from_journal_name($container, $languages_to_detect[0]);
				}
				
				// If we have the container in Wikidata link to it
				if ($journal_item != '')
				{
					$w[] = array('P1433' => $journal_item);
				}
				break;
				
			// based on https://bitbucket.org/magnusmanske/sourcemd/src/6c998c4809df/sourcemd.php?at=master
			case 'issued':			
				$date = '';
				$d = $v->{'date-parts'}[0];
				if ( count($d) > 0 ) $year = $d[0] ;
				if ( count($d) > 1 ) $month = preg_replace ( '/^0+(..)$/' , '$1' , '00'.$d[1] ) ;
				if ( count($d) > 2 ) $day = preg_replace ( '/^0+(..)$/' , '$1' , '00'.$d[2] ) ;
				if ( isset($month) and isset($day) ) $date = "+$year-$month-$day"."T00:00:00Z/11";
				else if ( isset($month) ) $date = "+$year-$month-00T00:00:00Z/10";
				else if ( isset($year) ) $date = "+$year-00-00T00:00:00Z/9";
				
				$w[] = array('P577' => $date);
				break;
				
				
			case 'reference':
				foreach ($v as $reference)
				{
					
					if (isset($reference->DOI))
					{
						// for now just see if this already exists
						$cited = wikidata_item_from_doi($reference->DOI);
						if ($cited != '')
						{
							$w[] = array('P2860' => $cited);
						}					
					}
					
				}
				break;
				

/*				
funder: [
{
DOI: "10.13039/501100001659",
name: "Deutsche Forschungsgemeinschaft",
doi-asserted-by: "publisher",
award: [
"PA 1818/3-1",
"HU 1561/1-1, 1-2"
]
},
{
name: "European Union Improving Human Potential program SYNTHESYS",
award: [
"GB-TAF-3410",
"GB-TAF-5177"
]
}
],
*/

			case 'funder':
				foreach ($v as $funder)
				{
					//print_r($funder);
					if (isset($funder->DOI))
					{
						$funder_qid = wikidata_funder_from_doi($funder->DOI);
						if ($funder_qid != '')
						{
							$w[] = array('P859' => $funder_qid);
						}
					}				
				}
				break;
				
			case 'license':
				if (isset($v[0]->URL))
				{
				
					// map to Wikidata
					$license_item = '';
					switch ($v[0]->URL)
					{
						case 'https://creativecommons.org/licenses/by-nd/4.0/':						
							// CC-BY-ND 4.0 
							$license_item = 'Q36795408';
							break;
							
						case 'http://creativecommons.org/licenses/by-nc/3.0/':						
						case 'http://creativecommons.org/licenses/by-nc/3.0/nl/':						
							// CC-BY-NC 
							$license_item = 'Q18810331';					
							break;
							
						case 'http://creativecommons.org/licenses/by-sa/3.0/nl/':
							// CC-BY-SA 
							$license_item = 'Q14946043';												
							break;
					
						default:
							break;
					}
					
					if ($license_item != '')
					{
						$w[] = array('P275' => $license_item);
					}					
					
					
				}
				break;
				
			case 'abstract':
				// Handle multiple languages
				$done = false;
				
				if (isset($work->message->multi))
				{
					if (isset($work->message->multi->_key->abstract))
					{					
						foreach ($work->message->multi->_key->abstract as $language => $text)
						{
							$text = preg_replace('/^(SUMMARY|Abstract|ABSTRACT|INTRODUCTION)/u', '', $text);
							$text = preg_replace('/^<jats:p>/u', '', $text);
							$text = strip_tags($text);
						
				
							
							$sentences = '';
							
							switch ($language)
							{
								case 'zh':
									$sentences = preg_split('/。/u', $text);
									break;							
							
								case 'en':
								default:
									// sentence split (assumes English-style text)
									// see https://stackoverflow.com/a/16377765/9684 for some ideas
									$sentences = preg_split('/(?<=[a-z\)])[.?!](?=\s+[A-Z])/u', $text);
									break;
							}
							
								
							if (count($sentences) != 0)
							{
								$first_line = $sentences[0] . '.';								
								$first_line = nice_shorten($first_line);
				
								$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . addcslashes($first_line, '"') . '"');
							}
						}					
						$done = true;
					}					
				}
			
				if (!$done)
				{			
					// one language only
					$text = $v;
				
					// for now just single language 9to do: multilingual)
				
					// clean
					$text = preg_replace('/^(SUMMARY|Abstract|ABSTRACT|INTRODUCTION)/u', '', $text);
					$text = preg_replace('/^<jats:p>/u', '', $text);
					$text = strip_tags($text);
				
					// sentence split (assumes English-style text)
					// see https://stackoverflow.com/a/16377765/9684 for some ideas
					$sentences = preg_split('/(?<=[a-z\)])[.?!](?=\s+[A-Z])/u', $text);
								
					if (count($sentences) != 0)
					{
						$first_line = $sentences[0] . '.';
						$first_line = nice_shorten($first_line);
				
						// Detect language of first_line
						$ld = new Language($languages_to_detect);						
						$language = $ld->detect($first_line)->__toString();

						$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . addcslashes($first_line, '"') . '"');
					}
				}
				break;
				
	
			default:
				break;
		}
	}
	
	// echo "--------------------------\n";
	
	// assume create
	if ($item == 'LAST')
	{
		echo "CREATE\n";
	}	
	
	foreach ($w as $statement)
	{
		foreach ($statement as $property => $value)
		{
			$row = array();
			$row[] = $item;
			$row[] = $property;
			$row[] = $value;
		
			$quickstatements .= join("\t", $row);
			
			// labels don't get references 
			if (count($source) > 0 && !preg_match('/^L/', $property))
			{
				$quickstatements .= "\t" . join("\t", $source);
			}
			
			$quickstatements .= "\n";
			
		}
	}
	
	// echo "--------------------------\n";
	
	
	
	return $quickstatements;

	
}

//----------------------------------------------------------------------------------------
// list of items already in Wikidata for a journal
// from ISSN, could use as basis for RIS export for matching, etc.
function works_for_journal($issn)
{
	$works = array();
	$sparql = 'SELECT ?work (group_concat(?author;separator=";") as ?authors) ?title ?volume ?issue ?pages ?doi 
	WHERE { 
	?container wdt:P236 "' . strtoupper($issn) . '" .
  ?work wdt:P1433 ?container .
  
  ?work wdt:P1476 ?title .
  
  ?work wdt:P2093 ?author .
  
  ?work wdt:P478 ?volume .
  OPTIONAL {
    ?work wdt:P433 ?issue .
   }
  ?work wdt:P304 ?pages .
  
  OPTIONAL {
    ?work wdt:P356 ?doi .
   }  
}
GROUP BY ?work ?title ?volume ?issue ?pages ?doi ';

	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		
		
		if (isset($obj->results->bindings))
		{
			foreach ($obj->results->bindings as $binding)
			{
				$work = new stdclass;
				
				foreach ($binding as $k => $v)
				{
					$work->{$k} = $v->value;
				}
				
				$works[] = $work;

			}
		}
	}
	
	return $works;

}

//----------------------------------------------------------------------------------------
// list of items already in Wikidata for a journal
// from Wikidata Q, could use as basis for RIS export for matching, etc.
function works_for_journal_from_qid($qid)
{
	$works = array();
	$sparql = 'SELECT ?work (group_concat(?author;separator=";") as ?authors) ?title ?volume ?issue ?pages ?doi 
	WHERE { 
	VALUES ?container { wd:' . $qid . '}
  ?work wdt:P1433 ?container .
  
  ?work wdt:P1476 ?title .
  
  ?work wdt:P2093 ?author .
  
  ?work wdt:P478 ?volume .
  OPTIONAL {
    ?work wdt:P433 ?issue .
   }
  ?work wdt:P304 ?pages .
  
  OPTIONAL {
    ?work wdt:P356 ?doi .
   }  
}
GROUP BY ?work ?title ?volume ?issue ?pages ?doi ';

	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		
		
		if (isset($obj->results->bindings))
		{
			foreach ($obj->results->bindings as $binding)
			{
				$work = new stdclass;
				
				foreach ($binding as $k => $v)
				{
					$work->{$k} = $v->value;
				}
				
				$works[] = $work;

			}
		}
	}
	
	return $works;

}

//----------------------------------------------------------------------------------------
// OpenURL lookup using ISSN, volume, spage
function wikidata_item_from_openurl($issn, $volume, $spage)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE 
{ 
  VALUES ?issn {"' . $issn . '" } .
  VALUES ?volume {"' . $volume . '" } .
  VALUES ?firstpage {"^' . $spage . '[^0-9]" } .
  
  ?work wdt:P1433 ?container .
  ?container wdt:P236 ?issn.
  ?work wdt:P478 ?volume .
  ?work wdt:P304 ?pages .
  FILTER regex(?pages,?firstpage,"i")
}';
	
	
	$url = 'https://query.wikidata.org/bigdata/namespace/wdq/sparql?query=' . urlencode($sparql);
	$json = get($url, '', 'application/json');
		
	if ($json != '')
	{
		$obj = json_decode($json);
		
		//print_r($obj);
		
		if (isset($obj->results->bindings))
		{
			if (count($obj->results->bindings) != 0)	
			{
				$item = $obj->results->bindings[0]->work->value;
				$item = preg_replace('/https?:\/\/www.wikidata.org\/entity\//', '', $item);
			}
		}
	}
	
	return $item;
}



//----------------------------------------------------------------------------------------
// Fetch CrossRef DOI
function get_work($doi)
{
	$obj = null;
	
	$url = 'https://api.crossref.org/v1/works/http://dx.doi.org/' . $doi;
	
	$json = get($url);
	
	if ($json != '')
	{
		$obj = json_decode($json);
	}
	return $obj;
}

//----------------------------------------------------------------------------------------


// fix
if (0)
{

	$dois=array(
	'10.1071/is07053',
	'10.1071/is02015',
	'10.1071/is05024',
	'10.1071/is05035',
	'10.1071/is05035',
	'10.1071/is04021',
	'10.1071/is05056',
	'10.1071/it00036',
	'10.1071/it01004',
	'10.1071/is10034',
	'10.1071/is16046',
	'10.1071/is10044',
	'10.1071/it01029',
	'10.1071/is15047',
	'10.1071/it01039',
	'10.1071/is07018',
	'10.1071/is05022',
	'10.1071/is15039',
	'10.1071/is11037',
	'10.1071/is05005',
	'10.1071/is05005',
	'10.1071/is05005',
	'10.1071/is16006',
	'10.1071/is15046',
	'10.1071/is15028',
	'10.1071/is15028',
	'10.1071/is10013',
	'10.1071/is06031',
	'10.1071/is07039',
	'10.1071/is15011',
	'10.1071/is14021',
	'10.1071/is14025',
	'10.1071/is14025',
	'10.1071/is14025',
	'10.1071/is14025',
	'10.1071/is14025',
	'10.1071/is14025',
	'10.1071/is04020',
	'10.1071/is14043',
	'10.1071/it01038',
	'10.1071/is02007',
	'10.1071/is08028',
	'10.1071/is12008',
	'10.1071/is16054',
	'10.1071/is05019',
	'10.1071/is07016',
	'10.1071/is05033',
	'10.1071/is10035',
	'10.1071/is14036',
	'10.1071/is03008',
	'10.1071/is04009',
	'10.1071/it01043',
	'10.1071/is02008',
	'10.1071/is03005',
	'10.1071/is04010',
	'10.1071/is03005'
	);

	foreach ($dois as $doi)
	{
		$item = wikidata_item_from_doi($doi);
		
		if ($item != '')
		{
			echo $item . "\n";
		}
	}

}

// tests
if (0)
{

	// add to Wikidata via DOI
	$dois=array(
	'10.1071/is07053',
	'10.1071/is02015',
	'10.1071/is05024',
	'10.1071/is05035',
	'10.1071/is05035',
	'10.1071/is04021',
	'10.1071/is05056',
	'10.1071/it00036',
	'10.1071/it01004',
	'10.1071/is10034',
	'10.1071/is16046',
	'10.1071/is10044',
	'10.1071/it01029',
	'10.1071/is15047',
	'10.1071/it01039',
	'10.1071/is07018',
	'10.1071/is05022',
	'10.1071/is15039',
	'10.1071/is11037',
	'10.1071/is05005',
	'10.1071/is05005',
	'10.1071/is05005',
	'10.1071/is16006',
	'10.1071/is15046',
	'10.1071/is15028',
	'10.1071/is15028',
	'10.1071/is10013',
	'10.1071/is06031',
	'10.1071/is07039',
	'10.1071/is15011',
	'10.1071/is14021',
	'10.1071/is14025',
	'10.1071/is14025',
	'10.1071/is14025',
	'10.1071/is14025',
	'10.1071/is14025',
	'10.1071/is14025',
	'10.1071/is04020',
	'10.1071/is14043',
	'10.1071/it01038',
	'10.1071/is02007',
	'10.1071/is08028',
	'10.1071/is12008',
	'10.1071/is16054',
	'10.1071/is05019',
	'10.1071/is07016',
	'10.1071/is05033',
	'10.1071/is10035',
	'10.1071/is14036',
	'10.1071/is03008',
	'10.1071/is04009',
	'10.1071/it01043',
	'10.1071/is02008',
	'10.1071/is03005',
	'10.1071/is04010',
	'10.1071/is03005'
	);

	$dois=array(
	'10.12681/eh.11534'
	);

	$dois=array(
	'10.1080/0028825X.2019.1587474'
	);

	$dois=array(
	'10.1111/j.1096-3642.1979.tb01909.x'
	);

	$dois=array(
	'10.1163/187631208788784318'
	);

	$dois=array(
	'10.1111/syen.12241'
	);

	$dois=array(
	//'10.1023/A:1024669103815'
	//'10.1023/a:1003296302957'
	'10.1080/23802359.2018.1545547'
	);

	/*
	$dois = array(
	'10.1071/IS02015'
	);
	*/

	foreach ($dois as $doi)
	{
		$work = get_work($doi);
	
		//print_r($work);
	
		if ($work)
		{
			// print_r($work);
			$q = csljson_to_wikidata($work);
		
			echo $q;
			echo "\n";
		}
	}	
	
}


//----------------------------------------------------------------------------------------
// Try to locate an item using any identifier or metadata that we have
function wikidata_find_from_anything ($work)
{
	// Do we have this already in wikidata?
	$item = '';
	
	// DOI
	if (isset($work->message->DOI))
	{
		$item = wikidata_item_from_doi($work->message->DOI);
	}

	// JSTOR
	if ($item == '')
	{
		if (isset($work->message->JSTOR))
		{
			$item = wikidata_item_from_jstor($work->message->JSTOR);
		
		}
	}	

	// BioStor
	if ($item == '')
	{
		if (isset($work->message->BIOSTOR))
		{
			$item = wikidata_item_from_biostor($work->message->BIOSTOR);
		}
	}		

	// PDF
	if ($item == '')
	{
		if (isset($work->message->link))
		{
			foreach ($work->message->link as $link)
			{
				if ($link->{'content-type'} == 'application/pdf')
				{
					$item = wikidata_item_from_pdf($link->URL);
				}
			}
		}
	}	
	
	// OpenURL
	if ($item == '')
	{
		$terms = array();
				
		$issn = $volume = $spage = '';
		
		if (isset($work->message->ISSN))
		{
			$terms[] = $work->message->ISSN;
		}		
		
		if (isset($work->message->volume))
		{
			$terms[] = $work->message->volume;
		}

		if (isset($work->message->{'page-first'}))
		{
			$terms[] = $work->message->{'page-first'};
		}
			
		if (count(terms) == 3)
		{
			foreach ($terms[0] as $issn)
			{
				$hit = wikidata_item_from_openurl($issn, $terms[1], $terms[2]);
				if ($hit <> '')
				{
					$item = $hit;
				}
			}
		}

	}	
	
	return $item;	


}

// Microcitations
if (0)
{
	$guids=array(
'http://docs.niwa.co.nz/library/public/Memoir%20110_Marine%20Fauna%20of%20NZ_Cephalopoda%20(Giant%20Squid)%20-%201998.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20109_The%20Marine%20Fauna%20of%20NZ_Pycnogonida%20(Sea%20Spiders).pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20108_Marine%20Fauna%20of%20Ross%20Sea_Polychaeta%20-%201998.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20107_The%20Marine%20Fauna%20of%20NZ_Porifera_Demospongiae%20Part%205_Dendroceratida%20and%20Halisarcida.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20106_The%20Marine%20Fauna%20of%20NZ_Athecate%20Hydroids%20and%20their%20Medusae%20(Cnidaria-Hydrozoa).pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20105_Marine%20Fauna%20of%20NZ_Index%20to%20the%20Fauna_Mollusca%20-%201995.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20104_Pelagic%20Copepoda.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20103_Scletactinia_of_New_Zealand%20-%201995.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20102_Pelagic%20Calanoid%20Copepoda%20(1).pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20101_Marine%20Fauna%20of%20NZ_Chaetognatha%20(Arrow%20Worms)%20-%201993.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20100_Marine%20Fauna%20of%20NZ_Index%20to%20the%20Porifera%20-%201993.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20099_The%20Marine%20Fauna%20of%20New%20Zealand%20-%20Index%20to%20the%20Fauna%201%20-%20Protozoa%20-%201992.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20098_Stylasteridae_of_New_Zealand%20-%201991.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20097_Marine%20Fauna%20of%20NZ_Bryozoa_Gymnolaemata%20from%20the%20Western%20South%20Island%20Shelf%20and%20Slope%20-%201989.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20096_Marine%20Fauna%20of%20NZ_Porifera,%20Demospongiae,%20Part%204%20(Poecilosclerida)%20-%201988.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20095_Marine%20Fauna%20of%20NZ_Bryozoa_Gymnolaemata%20from%20the%20Western%20South%20Island%20Shelf%20and%20Slope%20-%201986.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20094_Marine%20Fauna%20of%20NZ_Deep%20Sea%20Isopoda%20Asellota%20-%201985.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20093_Sedimentation_of_the_South_Otago_Continental_Shelf%20-%201985.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20092_Marine%20Fauna%20of%20NZ_Larvae%20of%20the%20Brachyura%20(Decapoda)%20-%201985.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20091_Marine%20Fauna%20of%20NZ_Bryozoa_Gymnolaemata%20from%20the%20Kermadec%20Ridge%20-%201984.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20090_Marine%20Fauna%20of%20NZ_Pelagic%20Calanoid%20Copepods%20-%201983.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20089_Late%20Quarternary%20Stratigraphy%20and%20Sedimentation%20of%20the%20Canterbury%20Continental%20Shelf,%20New%20Zealand.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20088_Physical%20Oceanography%20of%20the%20New%20Zealand%20Fiords.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20087_The%20Marine%20Fauna%20of%20New%20Zealand_Porifera,%20Demospongiae,%20Part%203%20(Haplosclerida%20and%20Nepheliospongida).pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20086_The%20Marine%20Fauna%20of%20New%20Zealand_Pelagic%20Alanoid%20Copepods_Family%20Aetideidae.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20085_The%20Marine%20Fauna%20of%20New%20Zealand_Ascidiacea.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20084_Foraminifera%20on%20the%20Continental%20Shelf%20and%20Slope%20off%20Southern%20Hawke\'s%20Bay,%20New%20Zealand.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20083_The%20Hydraulic%20Regime%20and%20its%20Potential%20to%20Transport%20Sediment%20on%20the%20Canterbury%20Continental%20Shelf.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20082_The%20Marine%20Fauna%20of%20New%20Zealand_Bethnic%20Ostracoda%20(Suborder%20Myodocopina).pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20081_Late%20Cenozoic%20Geology%20of%20the%20West%20Coast%20Shelf%20-%201978.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20080_Soft-bottom%20Bethnic%20Communities%20in%20Otago%20Harbour%20and%20Blueskin%20Bay,%20New%20Zealand.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20079_Fiord%20Studies%20Caswell%20and%20Nancy%20Sounds%20NZ%20-%201978.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20078_%20The%20Marine%20Fauna%20of%20New%20Zealand_Ostracods%20of%20the%20Otago%20Shelf.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20077_Distribution%20and%20Morphology%20of%20Chatham%20Rise%20Phosphorites.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20076_Catalogue%20of%20type%20and%20figured%20specimens%20in%20NZOI%20-%201979.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20075_Hydrology%20of%20the%20Bounty%20Islands%20Region.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20074_Checklist%20of%20NZ%20Lakes%20-%201975.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20073_Hydrology%20of%20the%20Kermadec%20Islands%20Region.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20072_Oceanic%20Circulation%20and%20Hydrology%20off%20the%20Southern%20Half%20of%20South%20Island,%20New%20Zealand.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20071_Comprehensive%20Bibliography%20of%20Marine%20Manganese%20Nodules.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20070_Settlement%20and%20Succession%20on%20Rocky%20Shores%20at%20Auckland,%20North%20Island,%20New%20Zealand.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20063_Marine%20Fauna%20of%20NZ_Sphaeromatidae%20(Isopoda)%20-%201977.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20062_The%20Marine%20Fauna%20of%20NZ%20Algae%20Living%20Littoral%20Gammaridea%20(Crustacea%20Amphipoda)%20-%201972.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20061_The%20Marine%20Fauna%20of%20New%20Zealand_Macrourid%20Fishes%20(Pisces-Gadida).pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20060_Internal%20Structure%20in%20Marine%20Shelf,%20Slope,%20and%20Abyssal%20Sediments%20East%20of%20New%20Zealand.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20059_The%20Fauna%20of%20the%20Ross%20Sea_Part%208.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20058_Hydrological%20Studies%20in%20the%20New%20Zealand%20Region%201966%20and%201967.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20057_Biological%20Results%20of%20the%20Chatham%20Islands%201954%20Expedition.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20056_Hydrology%20of%20the%20Southern%20Kermadec%20Trench%20Region.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20055_Oceanic%20Circulation%20off%20the%20East%20Coast%20of%20New%20Zealand.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20054_Systematics%20and%20Ecology%20of%20NZ%20Kaikoura%20Plankton%20-%201972.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20053_Zooplankton%20and%20Hydrology%20of%20Hauraki%20Gulf%20-%201971.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20052_The%20Marine%20Fauna%20of%20NZ%20-%20Sea%20Cucumbers%20-%201970.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20051_The%20Marine%20Fauna%20of%20New%20Zealand-Porifera,%20Demospongiae,%20Part%202%20(Axinellida%20and%20Halichondrida).pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20050_Marine%20Geology%20of%20the%20NZ%20Subantarctic%20Sea%20Floor%20-%201969.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20049_Fauna%20of%20the%20Ross%20Sea%20(Part%207)_Pycnogonida_1-%201969.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20048_Hydrology%20of%20the%20South-East%20Tasman%20Sea.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20047_Outline%20Distribution%20of%20NZ%20Shelf%20Fauna%20(Echinoidea)%20-%201969.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20046_Fauna%20of%20the%20Ross%20Sea%20(Part%206)_Foraminifera%20-%201968.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20045_A%20Key%20to%20the%20Recent%20Genera%20of%20Foraminiferida%20-%201970.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20044_A%20Checklist%20of%20Recent%20New%20Zealand%20Foraminifera.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20043_The%20Marine%20Fauna%20of%20New%20Zealand_Scleractinian%20Corals.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20042_The%20Echinozoan%20Fauna%20of%20the%20New%20Zealand%20Subantarctic%20Islands,%20Macquarie%20Island,%20and%20the%20Chatham%20Rise.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20041_Bathymetry%20and%20Geologic%20Structure%20of%20the%20North%20West%20Tasman%20Sea%20and%20South%20Solomon%20Sea%20-%201967%20.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20040_Sediments%20of%20the%20Western%20Shelf,%20North%20Island,%20New%20Zealand.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20039_Hydrology%20of%20the%20Southern%20Hikurangi%20Trench%20Region.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20038_The%20Marine%20Fauna%20of%20New%20Zealand_Intertidal%20Foraminifera%20of%20the%20Corallina%20Officinalis%20Zone%20-%201967.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20037_The%20Marine%20Fauna%20of%20New%20Zealand-Porifera,%20Demospongiae,%20Part%201%20(Tetractinomorpha%20and%20Lithistida)%20-%201968.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20036_Water%20Masses%20and%20Fronts%20in%20the%20Southern%20Ocean%20South%20of%20New%20Zealand%20-%201967.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20035_Spider_Crabs_Family_Majidae%20-%201966.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20034_Marine%20Fauna%20of%20NZ%20-%20Family%20Hymenosomatidea%20-%201975.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20033_Submrine_Geology_Foveaux_Strait%20-%201967.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20032_Fauna%20of%20the%20Ross%20Sea_Part%205%20-%201967.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20031_Contributions%20to%20Manihiki%20Atoll%20-%20Cook%20Islands%20-%201974.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20030_Geology%20and%20Geomagnetism%20of%20the%20Bounty%20Region%20East%20of%20the%20South%20Island%20-%201966.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20029_Biological%20Results%20of%20The%20Chatham%20Islands%201954%20Expedition%20-%201964.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20028_Sedimentation%20in%20Hawke%20Bay%20-%201966.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20027_The%20Fauna%20of%20the%20Ross%20Sea%20(Part%204)%20Mysidacea%20and%20Sipunculoidea%20-%201965.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20026_Sediments%20of%20Chatham%20Rise%20-%201964.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20025_A%20Foraminiferal%20Fauna%20from%20the%20Western%20Continental%20Shelf,%20North%20Island,%20New%20Zealand%20-%201965.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20024_A%20Bibliography%20of%20the%20Oceanography%20of%20the%20Tasman%20and%20Coral%20Seas%20(1860-1960)%20-%201964.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20023_Marine%20Fauna%20of%20NZ%20-%20Crustaceans%20of%20the%20order%20Cumacea%20-%201963.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20022_The%20Marine%20Fauna%20of%20New%20Zealand_Crustacea%20Brachyura%20-%201964.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20021_The%20Fauna%20of%20the%20Ross%20Sea_part%203_Asteroidea%20-%201963.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20020_Flabellum%20rubrum%20-%201963.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20019_Fauna%20of%20the%20Ross%20Sea_Part%202%20-%20Scleractinian%20Chorals%20-%201962.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20018_Fauna%20of%20the%20Ross%20Sea_Part%201%20-%20Ophiuroidea%20-%201961.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20017_Studies%20of%20a%20Southern%20Fiord%20-%201964.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20016_Bibliography%20of%20NZ%20Marine%20Zoology%201769%20to%201899%20-%201963.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20015_Bay%20Head%20sand%20beaches%20of%20Banks%20Peninsula%20NZ%20-%201974.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20014_Submarine%20Morphology%20East%20of%20the%20North%20Island%20NZ%20-%201963.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20013_Results%20of%20the%20Chatham%20Islands%20(1954%20Exped)_Part%205%20-%201961.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20012_Hydrology%20of%20NZ%20Offshore%20Waters%20-%201965.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20011_Bathymetry%20of%20the%20New%20Zealand%20Region%20-%201964.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20010_Hydrology%20of%20Circumpolar%20Waters%20South%20of%20New%20Zealand%20-%201961.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20009_Analysis%20of%20hydrological%20observations%20in%20the%20New%20Zealand%20region%20(1874-1955)%20-%201962.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20008_Hydrology%20of%20NZ%20Coastal%20waters%20(1955)%20-%201961.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20007_Biological%20results%20of%20the%20Chatham%20Islands%201954%20expedition%20(Part%204)%20-%201960.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20006_Results%20of%20the%20Chatham%20Islands%20(1954%20Exped)_Part%203%20-%201960.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20005_Biological%20results%20of%20the%20Chatham%20Islands%201954%20expedition%20(Part%202)%20-%201960.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20004_Biological%20Rsults%20of%20the%20Chatham%20Islands%201954%20expidition%20(Part%201)%20-%201960.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20003_Contributions%20to%20Marine%20Microbiology%20-%201959.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20002_General%20Account%20of%20the%20Chatham%20Islands%201954%20Expidition%20-%201957.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20001_Bibliography%20of%20NZ%20Oceanography%20from%201949%20to%201953%20-%201955.pdf',
	);
	
	$guids=array(
	'http://docs.niwa.co.nz/library/public/Memoir%20130_The%20Marine%20Fauna%20of%20New%20Zealand_Euplectellid%20sponges%20-%202018.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20129_The%20Marine%20Fauna%20of%20New%20Zealand_Primnoid%20octocorals%20(Part%202)%20-%202016.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20128_The%20Marine%20Fauna%20of%20New%20Zealand_Geodiidae.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20127_The%20Marine%20Fauna%20of%20New%20Zealand_Amphipoda,%20Synopiidae.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20126_The%20Marine%20Fauna%20of%20New%20Zealand_Primnoidae%20Part%201.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20125_The%20Marine%20Fauna%20of%20New%20Zealand_Mantis%20Shrimps.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20123_The%20Marine%20Fauna%20of%20New%20Zealand_King%20Crabs.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20122_The%20Marine%20Fauna%20of%20New%20Zealand_Isopoda,%20Aegidae.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20121_The%20Marine%20Fauna%20of%20New%20Zealand_Lithistid%20Demospongiae.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20120_The%20Marine%20Fauna%20of%20New%20Zealand_Echinodermata%20part%203.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20119_The%20Marine%20Fauna%20of%20New%20Zealand_Leptothecata_Cnidaria%20Hydrozoa.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20118_Marine%20Fauna%20of%20NZ_Nemertea%20(Ribbon%20Worms)%20-%202002.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20117_Marine%20Fauna%20of%20NZ_Echinodermata%20-%20Asteroidea%20(order%20Valvatida)%20-%202001.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20116_The%20Marine%20Fauna%20of%20NZ_Echinodermata-Asteroidea%20(Sea-stars).pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20115_The%20Marine%20Fauna%20of%20NZ_Basket-stars%20and%20Snake-stars%20(Echinodermata-Ophiuroidea-Euryalinida).pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20114_Marine%20Fauna%20of%20NZ_Paguridea%20(Hermit%20Crabs)%20-%202000.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20113_Marine%20Fauna%20of%20NZ_Hydromedusae%20-%201999.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20112_The%20Marine%20Fauna%20of%20New%20Zealand_Octopoda%20-%201999.pdf',
'http://docs.niwa.co.nz/library/public/Memoir%20111_Pelagic%20Calanoid%20Copepoda.pdf',
);
	
	foreach ($guids as $guid)
	{
	
		$json = get('http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . urlencode($guid));
	
		//echo $json;

		$obj = json_decode($json);

		//print_r($obj);

		$work = new stdclass;
		$work->message = $obj;
	
		//print_r($work);

		$q =  csljson_to_wikidata($work);
		echo $q;
		echo "\n";
	}
}


if (0)
{

/*
// DOI
$doi = '10.1080/00222933.2010.520169';
$doi = '10.3956/2011-13.1';
$doi = '10.3969/J.ISSN.2095-0845.2001.02.002';
$item = wikidata_item_from_doi($doi);
echo "$doi $item\n";

// ISSN
$issn = '1175-5326';
$issn = '0001-6799';
$item = wikidata_item_from_issn($issn);
echo "$issn $item\n";

// Journal name
$name = 'Allertonia';
//$name = 'Munis Entomology & Zoology';
//$name = 'The Pan-Pacific entomologist';
$item =  wikidata_item_from_journal_name($name);
echo "$name $item\n";

// BioStor
$biostor = 217669;
$item =  wikidata_item_from_biostor($biostor);
echo "$biostor $item\n";

// Add from microcitation
$guid = '10.3969/j.issn.2095-0845.2001.02.002';
$guid = '10.13346/j.mycosystema.140275';
$guid = '10.3969/j.issn.1005-9628.2005.01.005';

// JSTOR only
//$guid = 'http://www.jstor.org/stable/23187393';

// PDF is GUID, need to have OpenURL and/or PDF lookup to check doesn't exist
//$guid = urlencode('http://www.museunacional.ufrj.br/publicacoes/wp-content/arquivos/Arqs%2065%20n%204%20p%20485-504%20Calvo%20et%20al.pdf');

$json = get('http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . $guid);


// BioStor examples
$biostor = 240296;
$biostor = 217669;

//$json = get('http://biostor.org/api.php?id=biostor/' . $biostor . '&format=citeproc');


$obj = json_decode($json);

//print_r($obj);

$work = new stdclass;
$work->message = $obj;

csljson_to_wikidata($work);

// works for a journal 
$issn = '0079-8835';

// $works = works_for_journal($issn);
// print_r($works);

// OpenURL


$issn	= "1175-5326";
$volume = "2528";
$spage 	= "1";

$item = wikidata_item_from_openurl($issn, $volume, $spage);
echo "$issn  $volume  $spage $item\n";

*/

/*
$doi = '10.1371/journal.pone.0029715';
$doi = '10.1111/aen.12333'; // I've added this
$work = get_work($doi);
if ($work)
{
	// print_r($work);
	csljson_to_wikidata($work);
}
*/



if (0)
{
	// JSTOR-based journal

	$issn = '1174-9202';
	$works = works_for_journal($issn);
	print_r($works);
}

if (0)
{
	$guid = 'http://www.jstor.org/stable/42905863';

	$guid = urlencode('http://www.guihaia-journal.com/ch/reader/view_abstract.aspx?file_no=1986Z1003&flag=1');

	$guid = urlencode('http://www.guihaia-journal.com/ch/reader/view_abstract.aspx?file_no=20070426&flag=1');


	$json = get('http://localhost/~rpage/microcitation/www/citeproc-api.php?guid=' . $guid);


	$obj = json_decode($json);

	//print_r($obj);

	$work = new stdclass;
	$work->message = $obj;

	csljson_to_wikidata($work);
}

}

?>
