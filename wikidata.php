<?php

error_reporting(E_ALL);

require_once 'vendor/autoload.php';
use LanguageDetection\Language;
use Biblys\Isbn\Isbn as Isbn;



//----------------------------------------------------------------------------------------
// Extract type of work from title
function types_from_title(&$w, $title)
{
	// errata
	
	if (preg_match('/^ERRATA\b/i', $title))
	{
		$w[] = array('P31' => 'Q1348305');	
		
		if (preg_match('/^ERRATA ET ADDENDA/i', $title))
		{
			$w[] = array('P31' => 'Q352858');	
		}
	
	}
}	

//----------------------------------------------------------------------------------------
function nice_strip_tags($str)
{
	$str = preg_replace('/</u', ' <', $str);
	$str = preg_replace('/>/u', '> ', $str);
	
	$str = strip_tags($str);
	
	$str = preg_replace('/&amp;/u', '&', $str);
	
	$str = preg_replace('/\s\s+/u', ' ', $str);
	
	$str = preg_replace('/^\s+/u', '', $str);
	$str = preg_replace('/\s+$/u', '', $str);
	
	return $str;
	
}

//----------------------------------------------------------------------------------------
// trim a string nicely
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
// Does wikidata have this Internet Archive item?
function wikidata_item_from_internet_archive($ia)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P724 "' . $ia . '" }';
	
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
// Does wikidata have this Google Book?
function wikidata_item_from_google_book($gb)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P675 "' . $gb . '" }';
	
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
// Does wikidata have this DOI?
function wikidata_item_from_doi($doi)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P356 "' . mb_strtoupper($doi) . '" }';
	
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
	
	
	//echo $sparql;
		
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
// Does wikidata have this PMID?
function wikidata_item_from_pmid($pmid)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P698 "' . $pmid . '" }';
	
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
// Does wikidata have this DIALNET?
function wikidata_item_from_dialnet($dialnet)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P1610 "' . $dialnet . '" }';
	
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
// Does wikidata have this CINII?
function wikidata_item_from_cinii($cinii)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P2409 "' . $cinii . '" }';
	
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
// Does wikidata have this SUDOC id?
function wikidata_item_from_sudoc($sudoc)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P1025 "' . $sudoc . '" }';
	
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
// Do we have a book with this ISBN-10?
function wikidata_item_from_isbn10($isbn10)
{
	$item = '';

	$isbns = array($isbn10);
	
	$isbn = new Isbn($isbn10);
	$isbns[] = $isbn->format("ISBN-10");
	
	// print_r($isbns);
	
	foreach ($isbns as $id)
	{
		$sparql = 'SELECT * WHERE { ?work wdt:P212 "' . strtoupper($id) . '" }';

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
// Do we have a book with this ISBN-13?
function wikidata_item_from_isbn13($isbn13)
{
	$item = '';
	
	$isbns = array($isbn13);
	
	$isbn = new Isbn($isbn13);
	$isbns[] = $isbn->format("ISBN-13");
	
	foreach ($isbns as $id)
	{
		$sparql = 'SELECT * WHERE { ?work wdt:P212 "' . strtoupper($id) . '" }';

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
// Does wikidata have this OCLC ?
function wikidata_item_from_oclc($oclc)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P243 "' . $oclc . '" }';
	
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
// Does wikidata have this VIAF ?
function wikidata_item_from_viaf($viaf)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?work wdt:P214 "' . $viaf . '" }';
	
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
function wikidata_item_from_persee($perse)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?author wdt:P2732 "' . $perse . '" }';
	
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
function wikidata_item_from_idref($id)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE { ?author wdt:P269 "' . $id . '" }';
	
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
function csljson_to_wikidata($work, $check = true, $update = true, $languages_to_detect = array('en'), $source = array(), $always_english_label = true)
{

	$MAX_LABEL_LENGTH = 250;

	$quickstatements = '';
	
	// Map language codes to Wikidata items
	$language_map = array(
		'ca' => 'Q7026',
		'da' => 'Q9035',
		'de' => 'Q188',
		'en' => 'Q1860',
		'es' => 'Q1321',
		'fr' => 'Q150',
		'hu' => 'Q9067',
		'it' => 'Q652',
		'ja' => 'Q5287',
		'la' => 'Q397',
		'nl' => 'Q7411',
		'pt' => 'Q5146',
		'ru' => 'Q7737',
		'th' => 'Q9217',
		'vi' => 'Q9199',
		'zh' => 'Q7850',		
	);
	
	// Is record sane?
	if (!isset($work->message->title))
	{
		return;
	}

	if (isset($work->message->title))
	{
		if (is_array($work->message->title) && count($work->message->title) == 0)
		{
			return;
		}
		else
		{
			if ($work->message->title == '')
			{
				return;
			}
		}
	}
	

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

		// SUDOC
		if ($item == '')
		{
			if (isset($work->message->SUDOC))
			{
				$item = wikidata_item_from_sudoc($work->message->SUDOC);
			
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
		
		if ($item == '')
		{
			if (isset($work->message->DIALNET))
			{
				$item = wikidata_item_from_dialnet($work->message->DIALNET);
			}
		}		

		if ($item == '')
		{
			if (isset($work->message->CINII))
			{
				$item = wikidata_item_from_cinii($work->message->CINII);
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
		
		// URL
		if ($item == '')
		{
			if (isset($work->message->URL))
			{
				$item = wikidata_item_from_url($work->message->URL);
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
			
			if (isset($work->message->{'issued'}))
			{
				$parts[] = $work->message->{'issued'}->{'date-parts'}[0][0];
			}
			
			//print_r($parts);
	
			if (count($parts) == 4)
			{
				$item = wikidata_item_from_openurl_issn($parts[0], $parts[1], $parts[2], $parts[3]);
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
		'CINII'					=> 'P2409',
		'CNKI'					=> 'P6769',
		'DIALNET'				=> 'P1610',
		'DOI' 					=> 'P356',
		'HANDLE'				=> 'P1184',
		'JSTOR'					=> 'P888',
		'PMID'					=> 'P698',
		'PMC' 					=> 'P932',
		'SUDOC' 				=> 'P1025',
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
			//----------------------------------------------------------------------------
			case 'type':
				switch ($v)
				{
					case 'dissertation':
						// default is thesis
						$dissertation_type = 'Q1266946';
						
						if (isset($work->message->degree))
						{
							switch ($work->message->degree[0])
							{
								case 'PhD Thesis':
									$dissertation_type = 'Q187685';
									break;
									
								default:
									break;
							}
						}
					
						$w[] = array('P31' => $dissertation_type);
						break;
						
					case 'book-chapter':
						$w[] = array('P31' => 'Q1980247');
						break;				
				
					case 'article-journal':
					case 'journal-article':
					default:
						$w[] = array('P31' => 'Q13442814');
						break;
						
					
				}
				break;
		
			//----------------------------------------------------------------------------
			case 'title':
			
				// Handle multiple languages
				$done = false;
				
				$english_label = '';
				$last_label = '';
				
				if (isset($work->message->multi))
				{
					if (isset($work->message->multi->_key->title))
					{					
						foreach ($work->message->multi->_key->title as $language => $v)
						{
							$v = preg_replace('/\s+$/u', '', $v);
							
							//echo "|$v|\n";
							
							// full width right parenthesis
							//$v = preg_replace('/）$/u', ')', $v);
							
							//echo "|$v|\n";
							
							$v = nice_strip_tags($v);
							
						
							// title
							$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . $v . '"');

							// label
							$last_label = nice_shorten($v, $MAX_LABEL_LENGTH);
							$w[] = array('L' . $language => '"' . $last_label . '"');
							
							if ($language == 'en')
							{
								$english_label = $last_label;
							}
						}					
						$done = true;
					}					
				}
				
				if ($done && $english_label == '' && $always_english_label)
				{
					// make an English label for display
					$w[] = array('Len' => '"' . $last_label . '"');											
				
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
						else
						{
							$title = $v[0];
						}
					}				
					
					if ($title != '')
					{
				
						// We always want a title for the English language, even if
						// it isn't English
						$language = 'en';					
						$title = nice_strip_tags($title);
						
						// J-Stage fixes
						if (preg_match('/(\^\|\^[a-z]+);/i', $title, $m))
						{
							$title = str_replace('^|^', '&', $title);
						}						
						
						$title = html_entity_decode($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
						
						$title = str_replace("\n", "", $title);
					
						/*
						// title
						$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . addcslashes($title, '"') . '"');
						// label
						$w[] = array('L' . $language => '"' . addcslashes($title, '"') . '"');
						*/
										
					
						if (1)
						{
							$language = 'en';
							
							$detect = true;
							
							if (count($languages_to_detect) == 1)
							{
								$language = $languages_to_detect[0];
								$detect = false;
							}							
							
							//print_r($languages_to_detect);
							
							
							if ($detect)
							{			
								// echo "Detect language\n";								
											
								// Detect language of title
								$ld = new Language($languages_to_detect);						
								$language = $ld->detect($title)->__toString();
								
								// double check Russian
								// https://stackoverflow.com/a/3212339/9684
								if (preg_match('/[А-Яа-яЁё]/u', $title))
								{
									$language = 'ru';
								}
								
								
								// double check Chinese
								if (preg_match('/\p{Han}+/u', $title))
								{
									$language = 'zh';
									
									// maybe Japanese?
									if (in_array('ja', $languages_to_detect)) 
									{
										$language = 'ja';
									}
									
									
								}
								
								// double check German
								if (preg_match('/[ä|ö|ü]/iu', $title) && $language == 'en')
								{
									$language = 'de';
								}								
								
								// echo $title . " " . $language . "\n";
								// exit();
								
								if ($language == 'en')
								{
									if (isset($work->message->ISSN))
									{
										if (is_array($work->message->ISSN) 
										&& 
										(count(array_intersect(array('1983-0572','1808-2688','2175-7860', '2358-1980'), $work->message->ISSN)) > 0)
										)
										
										{
								
											// Portuguese doesn't seem to be detected properly
											if (preg_match('/[ç|ā|ê|á|â|ó|é]/u', $title))
											{
												$language = 'pt';
											}
										}	
									}							
								}
								
							}
							
							//echo "language=$language\n";
							//exit();
						
							if ($language == 'en')
							{
								// Assume work is English
								$w[] = array('P407' => $language_map[$language]);

								// title
								$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . $title . '"');

								// label
								$w[] = array('L' . $language => '"' . nice_shorten($title, $MAX_LABEL_LENGTH) . '"');
								
								// Can we deduce anything about the type of article?
								
								types_from_title($w, $title);
						
							
							
							}
							else											
							{
								if (isset($work->message->ISSN))
								{
								
									if (count(array_intersect(array('1808-2688','2175-7860', '2358-1980'), $work->message->ISSN)) > 0)
									{
										if ($language == 'es')
										{
											$language = 'pt';
										}								
									}
								}
															
								// title
								$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . $title . '"');

								// label
								$w[] = array('L' . $language => '"' . nice_shorten($title, $MAX_LABEL_LENGTH) . '"');
							
								switch ($language)
								{
									case 'la':
										// very unlikely an article is actially in Latin
										break;
										
									default:
										// language of work (assume it is the same as the title)
										$w[] = array('P407' => $language_map[$language]);	
										break;
								
								}
							
								// add label in English anyway
								if ($always_english_label)
								{
									$w[] = array('Len' => '"' . nice_shorten($title, $MAX_LABEL_LENGTH) . '"');
								}
								

								
							
							}	
						}
					}					
			
				}
				break;
				
			//----------------------------------------------------------------------------
			// CrossRef sometimes stores title in original language 
			case 'original-title':
				$title = $v;
				
				// Check if container is an array, if it is not empty take the first string
				if (is_array($v) && count($v) > 0)
				{
					$title = $v[0];
				}
				
				// by this stage we should have a string name for the container,
				// (unless record is empty array, which can happen with CrossRef)
				if (is_string($title))
				{
					// language
					$ld = new Language(array('en', 'es', 'ja', 'ru', 'pt', 'zh'));						
					$language = $ld->detect($title)->__toString();
					
					
					// add
					
					// title
					$w[] = array($wikidata_properties['title'] => $language . ':' . '"' . $title . '"');
					
					// langauge of work
					$w[] = array('P407' => $language_map[$language]);	

					// label
					$w[] = array('L' . $language => '"' . nice_shorten($title, $MAX_LABEL_LENGTH) . '"');
				
				}
				break;			
			
				
			//----------------------------------------------------------------------------
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
					
					// Do we have PERSEE?
					if (!$done)
					{
						if (isset($author->PERSEE))
						{
							$author_item = wikidata_item_from_persee($author->PERSEE);
						
							if ($author_item != '')
							{							
								$w[] = array('P50' => $author_item . "\tP1545\t\"$count\"");
								$done = true;
							}						
						}						
					}

					// Do we have IDREF?
					if (!$done)
					{
						if (isset($author->IDREF))
						{
							$author_item = wikidata_item_from_idref($author->IDREF);
						
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
						/*
						We may need to check for CrossRef weirdness, e.g. 
						
						doi:10.3406/linly.1963.7123
						
						[1] => stdClass Object
                        (
                            [name] => Groupe Ornithologique Lyonnais
                            [sequence] => additional
                            [affiliation] => Array
                                (
                                )

                        )
						
						*/
						$ok = false; 
						
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
							
							$ok = true;			
						}
						else 
						{						
							if (isset($author->literal))
							{
								$name = $author->literal;
								
								$ok = true;		
							}
							else
							{
								$parts = array();
								if (isset($author->given))
								{
									$parts[] = $author->given;
									$ok = true;		
								}
								if (isset($author->family))
								{
									$parts[] = $author->family;
									$ok = true;		
								}
								$name = join(' ', $parts);				
							}
						}
					
						if ($ok == true)
						{
							$qualifier = "\tP1545\t\"$count\"";
					
							if (isset($author->affiliation))
							{
								foreach ($author->affiliation as $affiliation)
								{
									if (isset($affiliation->name))
									{
										// clean
										$affiliation->name = str_replace("\t", "", $affiliation->name);
										$affiliation->name = str_replace("\r", "", $affiliation->name);
										$affiliation->name = str_replace("\n", " ", $affiliation->name);
									
										$qualifier .= "\tP6424\t\"" . $affiliation->name . '"';
									}
								}						
							}						
					
							$w[] = array('P2093' => '"' . $name . '"' . $qualifier);
						}

					}
					if ($ok = true)
					{
						$count++;
					}
				}
				break;
		
			//----------------------------------------------------------------------------
			case 'volume':
			case 'issue':
			case 'page':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
				
			//----------------------------------------------------------------------------
			case 'alternative-id':
				// e.g. 10.5354/0717-8883.2014.31638
				if (preg_match('/Pág.\s+(?<pages>.*)/u', $v[0], $m))
				{
					$w[] = array($wikidata_properties['page'] => '"' . $m['pages'] . '"');
				}			
				break;
				
			//----------------------------------------------------------------------------
			case 'BHL':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;

			//----------------------------------------------------------------------------
			case 'BHLPART':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;

			//----------------------------------------------------------------------------
			case 'BIOSTOR':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;

			//----------------------------------------------------------------------------
			case 'CNKI':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
				
			//----------------------------------------------------------------------------
			case 'DOI':
				$w[] = array($wikidata_properties[$k] => '"' . mb_strtoupper($v) . '"');
				
				//Zenodo?
				
				if (preg_match('/10.5281\/ZENODO\.(?<id>\d+)/i', $v, $m))
				{
					$w[] = array('P4901' => '"' . $m['id'] . '"');
				}
				
				break;
				
			//----------------------------------------------------------------------------
			case 'JSTOR':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
								
			//----------------------------------------------------------------------------
			case 'HANDLE':
				$w[] = array($wikidata_properties[$k] => '"' . mb_strtoupper($v) . '"');
				break;								
				
			//----------------------------------------------------------------------------
			case 'ARCHIVE':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
				
			//----------------------------------------------------------------------------
			case 'PMID':
				$w[] = array($wikidata_properties[$k] => '"' . strtoupper($v) . '"');
				break;	
				
			//----------------------------------------------------------------------------
			case 'SUDOC':
				$w[] = array($wikidata_properties[$k] => '"' . strtoupper($v) . '"');
				break;	
								
			//----------------------------------------------------------------------------
			case 'DIALNET':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
				
			//----------------------------------------------------------------------------
			case 'CINII':
				$w[] = array($wikidata_properties[$k] => '"' . $v . '"');
				break;
								
			//----------------------------------------------------------------------------
			case 'ISBN':
			
				switch ($work->message->type)
				{
					case 'book-chapter':
						
						$isbn_string = $v[0];
						
						$book = '';
						
						if ($book == '')
						{
							$book = wikidata_item_from_isbn10($isbn_string);
						}
						if ($book == '')
						{
							$book = wikidata_item_from_isbn13($isbn_string);
						}
						
						if ($book != '')
						{
							// part of
							$w[] = array('P361' => $book);
						}
						
						
						break;
				
					// book 
					// article
					default:
						$isbns = array();
						if (is_array($v))
						{
							$isbns = $v;
						}
						else
						{
							$isbns[] = $v;
						}
			
						foreach ($isbns as $isbn_string)
						{
							$isbn = new Isbn($isbn_string);
						
							switch (strlen($isbn_string))
							{
								case 10:
									// echo " Line: " . __LINE__ . "\n";

									$w[] = array('P957' => '"' .  $isbn->format("ISBN-10") . '"' );			
									break;
					
								case 13:
									// echo " Line: " . __LINE__ . "\n";
				
				
									$w[] = array('P212' => '"' .  $isbn->format("ISBN-13") . '"' );
									break;
					
								default:
									break;
			
							}
						}
					break;
				}
				
				break;								
											
				
			//----------------------------------------------------------------------------
			// BioStor CSL-JSON
			case 'bhl_pages':
				// Get first element of page array
				// https://stackoverflow.com/a/42066999/9684
				$w[] = array($wikidata_properties['BHL'] => '"' . current($v) . '"');
				break;
			
			
			//----------------------------------------------------------------------------
			case 'URL':
				if (is_array($v))
				{
					foreach ($v as $url)
					{
						$go = true;
						
						// Cybium
						$url = preg_replace('/\x{A0}/u', '%C2%A0', $url);
						
						if (preg_match('/https?:\/\/www.jstor.org/', $url))
						{
							// force JSTOR to be https						
							$url = preg_replace('/http:\/\/www.jstor.org/', 'https://www.jstor.org', $url);
							// For now ignore JSTOR URLs
							$go = false;
						}	
						
						if (preg_match('/[\[|<|;]/', url ))
						{
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
					
					// Cybium
					$url = preg_replace('/\x{A0}/u', '%C2%A0', $url);
					
					$go = true;
					
					if (preg_match('/https?:\/\/www.jstor.org/', $url))
					{
						// force JSTOR to be https						
						$url = preg_replace('/http:\/\/www.jstor.org/', 'https://www.jstor.org', $url);
						// For now ignore JSTOR URLs
						$go = false;
					}	
					
					// ignore SICI based DOIs as they break quickstatements
					if (preg_match('/[\[|<|;]/', $url ))
					{
						$go = false;
					}
					
					
					//$go = false;					
				
					if ($go)
					{
						$w[] = array($wikidata_properties[$k] => '"' . $url . '"');
					}
				}
				break;
				
			//----------------------------------------------------------------------------
			case 'WIKISPECIES':
				$w[] = array('Sspecieswiki' => $v);
				break;
				
			//----------------------------------------------------------------------------
			case 'ZOOBANK':
				$w[] = array($wikidata_properties['ZOOBANK_PUBLICATION'] => '"' . $v . '"');
				break;				
				
			//----------------------------------------------------------------------------
			case 'link':
				// Some publishers such as Springer may have multiple entries for the same PDF
				// so keep track of them to avoid adding more than once
				$pdfs = array();
			
				foreach ($v as $link)
				{
					if ($link->{'content-type'} == 'application/pdf')
					{
						$go = true;
						
						// some PDFs we have to ignore as they are gone
						if (preg_match('/ci.nii.ac.jp/', $link->URL))
						{
							$go = false;
						}
						
						if (preg_match('/^S/', $link->URL))
						{
							$go = false;
						}
						
						if ($go)
						{
										
							if (in_array($link->URL, $pdfs))
							{
								// skip
							}
							else
							{
								$pdfs[] = $link->URL;
							
								$qualifier = "\tP2701\tQ42332";
					
								// do we have an archive version?
								if (isset($work->message->WAYBACK))
								{
									$wayback = $work->message->WAYBACK;
							
									if (!preg_match('/^\//', $wayback))
									{
										$wayback = '/' . $wayback;
									}
						
									$qualifier .= "\tP1065\t\"https://web.archive.org" . $wayback . '"';
								}
								$w[] = array($wikidata_properties['PDF'] => '"' . str_replace(' ', '%20', $link->URL) . '"' . $qualifier);						
							}
						}
					}
				}
				break;
								
			//----------------------------------------------------------------------------
			case 'container-title':
				$container = $v;
				
				// Check if container is an array, if it is not empty take the first string
				if (is_array($v) && count($v) > 0)
				{
					$container = $v[0];
				}
				
				// by this stage we should have a string name for the container,
				// (unless record is empty array, which can happen with CrossRef)
				if (is_string($container))
				{
				
					// OK, we need to link this to a Wikidata item
				
					// try via ISSN
					$journal_item = '';
				
					if ($journal_item == '')
					{
						if (isset($work->message->ISSN))
						{
							if (is_array($work->message->ISSN))
							{
								$n = count($work->message->ISSN);
								$i = 0;
								while (($journal_item == '') && ($i < $n))
								{
									$journal_item = wikidata_item_from_issn($work->message->ISSN[$i]);
									$i++;
								}
							}
							else
							{	
								$journal_item = wikidata_item_from_issn($work->message->ISSN);
							}
						}					
							
					}	
				
					if ($journal_item == '')
					{
						// try to find from name
						//$journal_item = wikidata_item_from_journal_name($container, $languages_to_detect[0]);
					
						if ($container == 'The Bulletin of The Raffles Museum')
						{
							$journal_item = 'Q47083652';
						}
					
						// Abhandlungen Aus Dem Gebiete Der Naturwissenschaften Hamburg
					
						if ($container == 'Abhandlungen Aus Dem Gebiete Der Naturwissenschaften Hamburg')
						{
							$journal_item = 'Q13548385';
						}
					
					}
				
					// If we have the container in Wikidata link to it
					if ($journal_item != '')
					{
						$w[] = array('P1433' => $journal_item);
					}
				}
				break;
				
			//----------------------------------------------------------------------------
			// based on https://bitbucket.org/magnusmanske/sourcemd/src/6c998c4809df/sourcemd.php?at=master
			case 'approved': // for theses
			case 'issued':			
				$date = '';
				$d = $v->{'date-parts'}[0];
				
				// sanity check
				if (is_numeric($d[0]))
				{
					if ( count($d) > 0 ) $year = $d[0] ;
					if ( count($d) > 1 ) $month = preg_replace ( '/^0+(..)$/' , '$1' , '00'.$d[1] ) ;
					if ( count($d) > 2 ) $day = preg_replace ( '/^0+(..)$/' , '$1' , '00'.$d[2] ) ;
					if ( isset($month) and isset($day) ) $date = "+$year-$month-$day"."T00:00:00Z/11";
					else if ( isset($month) ) $date = "+$year-$month-00T00:00:00Z/10";
					else if ( isset($year) ) $date = "+$year-00-00T00:00:00Z/9";
				
					$w[] = array('P577' => $date);
				}
				break;
				
				
			//----------------------------------------------------------------------------
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

			//----------------------------------------------------------------------------
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
				
			//----------------------------------------------------------------------------
			// Datacite
			case 'copyright':
				$license_item = '';
				switch ($v)
				{
					case 'Creative Commons BY-NC-ND 3.0 FR':
						$license_item = 'Q19125045';
						break;
						
					default:
						break;
				}
				
				if ($license_item != '')
				{
					$w[] = array('P275' => $license_item);
				}					
				break;
			
				
			//----------------------------------------------------------------------------
			case 'license':
				if (is_array($v))
				{
					foreach ($v as $license)

					if (isset($license->URL))
					{
				
						// map to Wikidata
						$license_item = '';
						switch ($license->URL)
						{
							  
							case 'https://creativecommons.org/licenses/by/4.0/':
								// CC-BY 4.0
								$license_item = 'Q20007257';
								break;
							  
							case 'https://creativecommons.org/licenses/by-nd/4.0/':						
								// CC-BY-ND 4.0 
								$license_item = 'Q36795408';
								break;
							
							case 'http://creativecommons.org/licenses/by-nc/3.0/':						
							case 'http://creativecommons.org/licenses/by-nc/3.0/nl/':						
								// CC-BY-NC 
								$license_item = 'Q18810331';					
								break;
								
							case 'https://creativecommons.org/licenses/by-nc/4.0':
								// CC-BY-NC  4.0
								$license_item = 'Q34179348';
								break;
							
							case 'http://creativecommons.org/licenses/by-sa/3.0/nl/':
								// CC-BY-SA 
								$license_item = 'Q14946043';												
								break;
								
							case 'http://creativecommons.org/licenses/by-sa/4.0':
								// CC-BY-SA 
								$license_item = 'Q18199165';												
								break;
							
							case 'https://creativecommons.org/licenses/by-nc-nd/4.0/':
								// CC-BY-NC-ND 
								$license_item = 'Q24082749';
								break;
							
							case 'https://creativecommons.org/licenses/by-nc-nd/1.0/':
								// CC-BY-NC-ND 
								$license_item = 'Q47008926';
								break;
								
							case 'http://creativecommons.org/licenses/by-nc-nd/4.0/':
							case 'https://creativecommons.org/licenses/by-nc-nd/4.0/':
								// CC-BY-NC-ND 4.0
								$license_item = 'Q24082749';
								break;
												
							default:
								break;
						}
					
					
					
						if ($license_item != '')
						{
							$w[] = array('P275' => $license_item);
						}					
					}
					
				}
				break;
				
			//----------------------------------------------------------------------------
			case 'abstract':
				if (1)
				{
					// Handle multiple languages
					$done = false;
				
					if (isset($work->message->multi))
					{
						if (isset($work->message->multi->_key->abstract))
						{					
							foreach ($work->message->multi->_key->abstract as $language => $text)
							{
								$text = preg_replace('/^<jats:p>/u', '', $text);
								$text = nice_strip_tags($text);
								$text = preg_replace('/^(SUMMARY|Abstract|ABSTRACT|INTRODUCTION)/u', '', $text);
						
				
							
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
									$first_line = preg_replace('/\n/u', ' ', $first_line);
									$first_line = preg_replace('/\s\s+/u', ' ', $first_line);								
									$first_line = nice_shorten($first_line);
				
									$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . $first_line . '"');
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
						$text = str_replace('<jats:p>-</jats:p>', '', $text);
						$text = preg_replace('/^<jats:p>/u', '', $text);
						$text = str_replace('..', '', $text);
					
					
						$text = nice_strip_tags($text);
					
						$text = preg_replace('/^(SUMMARY|Abstract|ABSTRACT|INTRODUCTION)\s*/u', '', $text);
					
					
						if ($text != '')
						{
				
							// sentence split (assumes English-style text)
							// see https://stackoverflow.com/a/16377765/9684 for some ideas
							$sentences = preg_split('/(?<=[a-z\)])[.?!](?=\s+[A-Z])/u', $text);
								
							if (count($sentences) != 0)
							{
								$first_line = $sentences[0] . '.';
								$first_line = preg_replace('/\n/u', ' ', $first_line);
								$first_line = preg_replace('/\s\s+/u', ' ', $first_line);								
						
								$first_line = nice_shorten($first_line);
				
								// Detect language of first_line
								$ld = new Language($languages_to_detect);						
								$language = $ld->detect($first_line)->__toString();
						
								// We don't seem to detect Portguese
								if (isset($work->message->ISSN) && is_array($work->message->ISSN) && in_array('2175-7860', $work->message->ISSN))
								{
									if ($language == 'es')
									{
										$language = 'pt';
									}								
								}
						

								$w[] = array($wikidata_properties[$k] => $language . ':' . '"' . $first_line . '"');
							}
						}
					}
				}
				break;
				
	
			//----------------------------------------------------------------------------
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
			$properties_to_ignore = array();
			
			$properties_to_ignore = array(
				'P724',
				'P953',
				'P407', // language of work is almost never set by the source
				'P1922',
			); // e.g., when adding PDFs or IA to records from JSTOR
							
			if (count($source) > 0 && !preg_match('/^[D|L]/', $property) && !in_array($property, $properties_to_ignore))
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
// Update based on subset of data, e.g. citations
// Convert a csl json object to Wikidata quickstatments
function update_citation_data($work, $source = array())
{

	$quickstatements = '';
	

	// Do we have this already in wikidata?
	$item = wikidata_item_from_doi($work->message->DOI);

	// If not found then retrun	
	if ($item == '')
	{
		return;
	}
	

	
	$w = array();
	

	
	foreach ($work->message as $k => $v)
	{
	
		switch ($k)
		{

				
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
					else
					{
						// lets try metadata-based search (OpenURL)
						$parts = array();
	
						if (isset($reference->ISSN))
						{
							$parts[] = str_replace("http://id.crossref.org/issn/", '', $reference->ISSN);

							if (isset($reference->volume))
							{
								$parts[] = $reference->volume;
							}
							if (isset($reference->{'first-page'}))
							{
								$parts[] = $reference->{'first-page'};
							}
							if (isset($reference->year))
							{
								$parts[] = $reference->year;
							}	
	
							print_r($parts);
	
							if (count($parts == 4))
							{
								$cited = wikidata_item_from_openurl_issn($parts[0], $parts[1], $parts[2], $parts[3]);
								
								if ($cited != '')
								{
									echo "Found $cited\n";								
								
									$w[] = array('P2860' => $cited);
								}	
							}						
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

/*
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
*/				
				

	
			default:
				break;
		}
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
			$properties_to_ignore = array();
			
			$properties_to_ignore = array(
				'P724',
				'P953',
				'P407', // language of work is almost never set by the source
				'P1922',
			); // e.g., when adding PDFs or IA to records from JSTOR
							
			if (count($source) > 0 && !preg_match('/^[D|L]/', $property) && !in_array($property, $properties_to_ignore))
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
// Update based on subset of data, e.g. funder
// Convert a csl json object to Wikidata quickstatments
function update_funder_data($work, $source = array())
{

	$quickstatements = '';
	

	// Do we have this already in wikidata?
	$item = wikidata_item_from_doi($work->message->DOI);

	// If not found then retrun	
	if ($item == '')
	{
		return;
	}
	

	
	$w = array();
	

	
	foreach ($work->message as $k => $v)
	{
	
		switch ($k)
		{


				

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
				
				

	
			default:
				break;
		}
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
			$properties_to_ignore = array();
			
			$properties_to_ignore = array(
				'P724',
				'P953',
				'P407', // language of work is almost never set by the source
				'P1922',
			); // e.g., when adding PDFs or IA to records from JSTOR
							
			if (count($source) > 0 && !preg_match('/^[D|L]/', $property) && !in_array($property, $properties_to_ignore))
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
function wikidata_item_from_openurl_issn($issn, $volume, $spage, $year)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE 
{ 
  VALUES ?issn {"' . $issn . '" } .
  VALUES ?volume {"' . $volume . '" } .
  VALUES ?firstpage {"^' . $spage . '([^0-9]|$)" } .
  VALUES ?year {"' . $year . '" } .
  
  ?work wdt:P1433 ?container .
  ?container wdt:P236 ?issn.
  ?work wdt:P478 ?volume .
  ?work wdt:P304 ?pages .
  ?work wdt:P577 ?date .
  FILTER regex(?pages,?firstpage,"i")
  FILTER (STR(year(?date)) = ?year)
}';
	
	// echo $sparql . "\n";
	
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
// OpenURL lookup using journal name, volume, spage
function wikidata_item_from_openurl_journal($journal, $volume, $spage, $year)
{
	$item = '';
	
	$sparql = 'SELECT * WHERE 
{ 
  VALUES ?journal {"' . $journal . '"@en } .
  VALUES ?volume {"' . $volume . '" } .
  VALUES ?firstpage {"^' . $spage . '([^0-9]|$)" } .
  VALUES ?year {"' . $year . '" } .
  
 #?container wdt:P1160 ?journal . # ISO 4 abbreviation 
  ?container rdfs:label ?journal .
  ?work wdt:P1433 ?container .
  ?work wdt:P478 ?volume .
  ?work wdt:P304 ?pages .
  ?work wdt:P577 ?date .
  FILTER regex(?pages,?firstpage,"i")
  FILTER (STR(year(?date)) = ?year)
}';
	
	//echo $sparql . "\n";
	
	//exit();
	
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
	
	$url = 'https://api.crossref.org/v1/works/' . $doi;
	
	$json = get($url);
	
	if ($json != '')
	{
		$obj = json_decode($json);
	}
	return $obj;
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
	
	// Handle
	if ($item == '')
	{
		if (isset($work->HANDLE))
		{
			$item = wikidata_item_from_handle($work->HANDLE);
		}
	}		
	
	// PMID
	if ($item == '')
	{
		if (isset($work->message->PMID))
		{
			$item = wikidata_item_from_pmid($work->message->PMID);
		}
	}	
	
	// ISBN	
	if ($item == '')
	{
		if (strlen($work->message->ISBN) == 10)
		{
			$item = wikidata_item_from_isbn10($work->message->ISBN);
		}
		if (strlen($work->message->ISBN) == 13)
		{
			$item = wikidata_item_from_isbn13($work->message->ISBN);
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
				
		if (isset($work->message->{'issued'}))
		{
			$terms[] = $work->message->{'issued'}->{'date-parts'}[0][0];
		}
			
		if (count($terms) == 4)
		{
			foreach ($terms[0] as $issn)
			{
				$hit = wikidata_item_from_openurl_issn($issn, $terms[1], $terms[2], $terms[3]);
				if ($hit <> '')
				{
					$item = $hit;
				}
			}
		}

	}	
	
	return $item;	


}

//----------------------------------------------------------------------------------------
function googlebooks_to_wikidata($book_id, $namespace = 'isbn', $update = true)
{

	$MAX_LABEL_LENGTH = 250;

	$quickstatements = '';
	
	$source = array();
	
	// Map language codes to Wikidata items
	$language_map = array(
		'da' => 'Q9035',
		'de' => 'Q188',
		'en' => 'Q1860',
		'es' => 'Q1321',
		'fr' => 'Q150',
		'it' => 'Q652',
		'ja' => 'Q5287',
		'la' => 'Q397',
		'nl' => 'Q7411',
		'pt' => 'Q5146',
		'ru' => 'Q7737',
		'th' => 'Q9217',
		'vi' => 'Q9199',
		'zh' => 'Q7850',		
	);
	

	// Do we have this already in wikidata?
	$item = '';
	
	
	// isbn
	if ($namespace == 'isbn')
	{
		if ($item == '')
		{
			$item = wikidata_item_from_isbn10($book_id);
		}
		if ($item == '')
		{
			$item = wikidata_item_from_isbn13($book_id);
		}
	}
	
	// google
	if ($namespace == 'google')
	{
		if ($item == '')
		{
			$item = wikidata_item_from_google_book($book_id);
		}
	}
	
	if ($item != '' && !$update)
	{
		return $quickstatements;
	}
		
	if ($namespace == 'isbn')
	{	
		// Google expects clean ISBN
		$book_id = str_replace('-', '', $book_id);
		
		$url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' . $book_id;
	}
	
	if ($namespace == 'google')
	{
		$url = 'https://www.googleapis.com/books/v1/volumes/' . $book_id;
	}
	
	//echo $url;
	
	$json = get($url);
	
	$obj = json_decode($json);
	
	//print_r($obj);
	
	$thing = null;
	
	if (isset($obj->items) && count($obj->items) > 0) 
	{
		$thing = $obj->items[0];
	}
	if (isset($obj->volumeInfo) )
	{
		$thing = $obj;
	}
	
	if ($thing)
	{		
		// echo " Line: " . __LINE__ . "\n";
			
		if ($item == '')
		{						
			// double check for existence
			if (isset($thing->volumeInfo->industryIdentifiers))
			{
				foreach($thing->volumeInfo->industryIdentifiers as $identifier)
				{
					if ($identifier->type == 'ISBN_10')
					{
						$item = wikidata_item_from_isbn10($identifier->identifier);
					}
					if ($identifier->type == 'ISBN_13')
					{
						$item = wikidata_item_from_isbn13($identifier->identifier);
					}		
				}
			}
		}	
		
		// echo " Line: " . __LINE__ . "\n";
				
		if ($item == '')
		{
			$item = 'LAST';
		}	
		else
		{
			if (!$update)
			{
				echo "Have already\n\n";
				
				return $quickstatements;
			}
		}
		
		$w = array();			
		
		// Type (here be dragons)
		// simple model is to have a "book" item with ISBN
		// Wikidata book project has model where each "book" has a work item and 
		// one or more expressions (which have unique ISBNs).
		
		$w[] = array('P31' => 'Q47461344'); // written work
		
		//$w[] = array('P31' => 'Q3331189');  // version, edition, or translation
		
		
		// Google Books
		$w[] = array('P675' => '"' . $thing->id . '"' );
		
		// Google Books is the source
		$source[] = 'S248';
		$source[] = 'Q206033';
		$source[] = 'S854';
		$source[] = '"' . $url . '"';
				
		// ISBNs
		$isbns = array();

		// echo " Line: " . __LINE__ . "\n";
		
		// Sometimes Google API doesn't return ISBNs even though Google Books web page has them (FFS!)		
		if (isset($thing->volumeInfo->industryIdentifiers))
		{
			foreach($thing->volumeInfo->industryIdentifiers as $identifier)
			{
				if ($identifier->type == 'ISBN_10')
				{
					$isbns[] = $identifier->identifier;
				}
				if ($identifier->type == 'ISBN_13')
				{
					$isbns[] = $identifier->identifier;
				}		
			}
		}
				
		// echo " Line: " . __LINE__ . "\n";		
		
		if (count($isbns) == 0 && ($namespace == 'isbn'))
		{
			$isbns[] = $book_id;
		}
		
		// echo " Line: " . __LINE__ . "\n";
		
		//print_r($isbns);
		
		
		foreach($isbns as $isbn_string)
		{
			// echo " Line: " . __LINE__ . "\n";
			// echo $isbn_string . "\n";
		
			$isbn = new Isbn($isbn_string);
		
			switch (strlen($isbn_string))
			{
				case 10:
					// echo " Line: " . __LINE__ . "\n";

					$w[] = array('P957' => '"' .  $isbn->format("ISBN-10") . '"' );			
					break;
					
				case 13:
					// echo " Line: " . __LINE__ . "\n";
				
				
					$w[] = array('P212' => '"' .  $isbn->format("ISBN-13") . '"' );
					break;
					
				default:
					break;
			
			}

		}
		
		// echo " Line: " . __LINE__ . "\n";
		
		
		//print_r($isbns);
		
		// title
		if (isset($thing->volumeInfo->title))
		{
			$title = $thing->volumeInfo->title;
		
			// language
			$language = 'en';
			
			if (isset($thing->volumeInfo->language))
			{
				$language = $thing->volumeInfo->language;
				
				$language = str_replace('-CN', '', $language);
			}
			
			if ($language == 'en')
			{
				// Assume work is English
				$w[] = array('P407' => $language_map[$language]);

				// title
				$w[] = array('P1476' => $language . ':' . '"' . $title . '"');

				// label
				$w[] = array('L' . $language => '"' . nice_shorten($title, $MAX_LABEL_LENGTH) . '"');
			
			
			}			
			else
			{
				// Language of work
				$w[] = array('P407' => $language_map[$language]);

				// title
				$w[] = array('P1476' => $language . ':' . '"' . $title . '"');

				// label
				$w[] = array('L' . $language => '"' . nice_shorten($title, $MAX_LABEL_LENGTH) . '"');
			
				// Ensure we have a label in English
				$w[] = array('Len' => '"' . nice_shorten($title, $MAX_LABEL_LENGTH) . '"');
				
			
			}			
		
		}
		
		//  subtitle
		if (isset($thing->volumeInfo->subtitle))
		{
			$subtitle = $thing->volumeInfo->subtitle;
		
			// language
			$language = 'en';
			
			if (isset($thing->volumeInfo->language))
			{
				$language = $thing->volumeInfo->language;
			}
			
			// subtitle
			$w[] = array('P1680' => $language . ':' . '"' . $subtitle . '"');
		
		}
		
		
		
		// authors
		if (isset($thing->volumeInfo->authors))
		{		
			$count = 1;
			foreach ($thing->volumeInfo->authors as $name)
			{
				$qualifier = "\tP1545\t\"$count\"";
				$w[] = array('P2093' => '"' . $name . '"' . $qualifier);	
				
				$count++;		
			}
			
			// Generate a human-friendly description
			$n = count($thing->volumeInfo->authors);
			$names = array();
			if ($n > 1)
			{
				$names = array_slice($thing->volumeInfo->authors, 0, $n - 1);
			}
			$description = "Book by ";
			
			if (count($names) > 0)
			{			
			 	$description .= join(", ", $names) . " and ";
			}
			 
			$description .= $thing->volumeInfo->authors[$n - 1];
			
			$w[] = array('Den' => '"' . $description . '"');	
			
		}
		
		
		// pages
		if (isset($thing->volumeInfo->pageCount))
		{
			$w[] = array('P304' => '"' . $thing->volumeInfo->pageCount . '"' );
		}

		// date
		if (isset($thing->volumeInfo->publishedDate))
		{
			$d = explode('-', $thing->volumeInfo->publishedDate);
		
			if ( count($d) > 0 ) $year = $d[0] ;
			if ( count($d) > 1 ) $month = preg_replace ( '/^0+(..)$/' , '$1' , '00'.$d[1] ) ;
			if ( count($d) > 2 ) $day = preg_replace ( '/^0+(..)$/' , '$1' , '00'.$d[2] ) ;
			if ( isset($month) and isset($day) ) $date = "+$year-$month-$day"."T00:00:00Z/11";
			else if ( isset($month) ) $date = "+$year-$month-00T00:00:00Z/10";
			else if ( isset($year) ) $date = "+$year-00-00T00:00:00Z/9";
		
			$w[] = array('P577' => $date);
		}
		
		/*
		// publisher
		
		// this doesn't work as Quickstatments can't add somevalue with LAST, and can't
		// add qualifiers to it either. Need to investigate using the API
		
		if (isset($thing->volumeInfo->publisher))
		{
			$qualifier = "\tP1932\t\"" . $thing->volumeInfo->publisher . "\"";
		
			$w[] = array('P123' => 'somevalue' . $qualifier );
		
		}
		*/
		
		
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
				if (count($source) > 0 && !preg_match('/^[D|L]/', $property))
				{
					$quickstatements .= "\t" . join("\t", $source);
				}
			
				$quickstatements .= "\n";
			
			}
		}
		
	
	
	}


	return $quickstatements;	

}

if (0)
{
	// Bats of the Indian Subcontinent
	//$quickstatements = googlebooks_to_wikidata('0951731319');
	
	//$quickstatements = googlebooks_to_wikidata('9789838120517');
	
	//$quickstatements = googlebooks_to_wikidata('9780615116402');
	
	//$quickstatements = googlebooks_to_wikidata('9787533508647');
	
	$quickstatements = googlebooks_to_wikidata('9783768212441');
	
	$quickstatements = googlebooks_to_wikidata('9781919766362');

	echo $quickstatements . "\n";
}



?>
