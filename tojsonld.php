<?php

// Wikidata item to JSON-LD

require_once 'vendor/autoload.php';

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
		$opts[CURLOPT_HTTPHEADER] = array("Accept: " . $content_type);
	}
	
	$ch = curl_init();
	curl_setopt_array($ch, $opts);
	$data = curl_exec($ch);
	$info = curl_getinfo($ch); 
	curl_close($ch);
	
	return $data;
}

//----------------------------------------------------------------------------------------
// get Wikidata record for person
function get_wikidata_author_ld($qid)
{
	$url = 'https://www.wikidata.org/wiki/Special:EntityData/' . $qid . '.json';

	$json = get($url);

	$obj = json_decode($json);
	
	$author = new stdclass;
	$author->id = 'https://www.wikidata.org/wiki/' . $qid;
	
	$author->names = array();
	
	foreach ($obj->entities->{$qid}->labels as $language => $label)
	{
		$author->names[] = '"' . $label->value . '"@' . $language;	
	}

	foreach ($obj->entities->{$qid}->claims as $p => $claims)
	{
		switch ($p)
		{
				
			// ORCID
			case 'P496':
				foreach ($claims as $claim)
				{
					$author->orcid = $claim->mainsnak->datavalue->value;
				}			
				break;
				

			default:
				break;
		}
	}	
	
	return $author;
}	

//----------------------------------------------------------------------------------------
// get Wikidata record
function get_wikidata_container_ld(&$triples, $qid)
{
	$property_map = array(
		'P1476' => '<http://schema.org/name>',
		'P236' => '<http://schema.org/issn>',
	);

	$subject = '<https://www.wikidata.org/wiki/' . $qid . '>';

	$url = 'https://www.wikidata.org/wiki/Special:EntityData/' . $qid . '.json';

	$json = get($url);

	$obj = json_decode($json);

	//echo $json;

	//echo json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
	
	$triple = array();
	$triple[] = $subject;
	$triple[] = '<http://www.w3.org/1999/02/22-rdf-syntax-ns#type>';					
	$triple[] = '<http://schema.org/Periodical>';
	
	$triples[] = $triple;
	
	
	foreach ($obj->entities->{$qid}->claims as $p => $claims)
	{
		//echo $p . "\n";
		
		switch ($p)
		{
			// title
			case 'P1476':			
				foreach ($claims as $claim)
				{
					$triple = array();
					$triple[] = $subject;
					$triple[] = $property_map[$p];					
					$triple[] = '"' . addcslashes($claim->mainsnak->datavalue->value->text, '"') . '"' . '@' . $claim->mainsnak->datavalue->value->language;
					
					$triples[] = $triple;
				}			
				break;
				
			// ISSN
			case 'P236':
				foreach ($claims as $claim)
				{
					$triple = array();
					$triple[] = $subject;
					$triple[] = $property_map[$p];				
					$triple[] = '"' . $claim->mainsnak->datavalue->value . '"';
					
					$triples[] = $triple;				
				}			
				break;
				

			default:
				break;
		}
	}	
	
}	


//----------------------------------------------------------------------------------------
function wikidata_identifier(&$triples, $subject, $namespace, $value)
{
	$bnode = '_:' . $namespace;

	$triple = array();
	$triple[] = $subject;
	$triple[] = '<http://schema.org/identifier>';					
	$triple[] = $bnode;
	
	$triples[] = $triple;
	
	$triple = array();
	$triple[] = $bnode;
	$triple[] = '<http://www.w3.org/1999/02/22-rdf-syntax-ns#type>';					
	$triple[] = '<http://schema.org/PropertyValue>';
	
	$triples[] = $triple;
	
	
	$triple = array();
	$triple[] = $bnode;
	$triple[] = '<http://schema.org/propertyID>';					
	$triple[] = '"' . $namespace . '"';
	
	$triples[] = $triple;
	
	$triple = array();
	$triple[] = $bnode;
	$triple[] = '<http://schema.org/value>';					
	$triple[] = '"' . strtolower($value) . '"';
	
	$triples[] = $triple;
	
	switch ($namespace)
	{
		case 'doi':
			$triple = array();
			$triple[] = $subject;
			$triple[] = '<http://schema.org/sameAs>';					
			$triple[] = '"https://doi.org/' . strtolower($value) . '"';
			
			$triples[] = $triple;
			break;					

		case 'jstor':
			$triple = array();
			$triple[] = $subject;
			$triple[] = '<http://schema.org/sameAs>';					
			$triple[] = '"https://www.jstor.org/stable/' . $value . '"';
			
			$triples[] = $triple;
			break;					
			
		default:
			break;
	}
}					

//----------------------------------------------------------------------------------------
// get Wikidata record
function get_wikidata_work_ld(&$triples, $qid)
{
	$property_map = array(
		'P1476' => '<http://schema.org/name>',
		
		'P304' => '<http://schema.org/pagination>',
		'P433' => '<http://schema.org/issueNumber>',
		'P478' => '<http://schema.org/volumeNumber>',
		
		'P577' => '<http://schema.org/datePublished>',
	
	);

	$subject = '<https://www.wikidata.org/wiki/' . $qid . '>';


	$url = 'https://www.wikidata.org/wiki/Special:EntityData/' . $qid . '.json';

	$json = get($url);

	$obj = json_decode($json);

	//echo $json;

	//echo json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
	
	//print_r($obj);
	
	$triple = array();
	$triple[] = $subject;
	$triple[] = '<http://www.w3.org/1999/02/22-rdf-syntax-ns#type>';					
	$triple[] = '<http://schema.org/ScholarlyArticle>';
	
	$triples[] = $triple;
	
	$authors = array();
	
	foreach ($obj->entities->{$qid}->claims as $p => $claims)
	{
		//echo $p . "\n";
		
		switch ($p)
		{
			// title
			case 'P1476':			
				foreach ($claims as $claim)
				{
					$triple = array();
					$triple[] = $subject;
					$triple[] = $property_map[$p];					
					$triple[] = '"' . addcslashes($claim->mainsnak->datavalue->value->text, '"') . '"' . '@' . $claim->mainsnak->datavalue->value->language;
					
					$triples[] = $triple;
				}			
				break;
				
			// journal
			case 'P1433':
				foreach ($claims as $claim)
				{
					$triple = array();
					$triple[] = $subject;
					$triple[] = '<http://schema.org/isPartOf>';					
					$triple[] = '<https://www.wikidata.org/wiki/' . $claim->mainsnak->datavalue->value->id . '>';	
					
					$triples[] = $triple;				
				
					get_wikidata_container_ld($triples, $claim->mainsnak->datavalue->value->id);
				}			
				break;
			
			// authors and author strings
			case 'P2093':
				foreach ($claims as $claim)
				{
					$author_string = $claim->mainsnak->datavalue->value;
					if (isset($claim->qualifiers->P1545))
					{
						$order = $claim->qualifiers->P1545[0]->datavalue->value;
						$authors[$order] = $author_string;
					}
				}			
				break;
				
			case 'P50':
				foreach ($claims as $claim)
				{
					$author = get_wikidata_author_ld($claim->mainsnak->datavalue->value->id);
					
					if (isset($claim->qualifiers->P1545))
					{
						$order = $claim->qualifiers->P1545[0]->datavalue->value;
						$authors[$order] = $author;
					}
						
				}			
				break;

			// date
			case 'P577':
				foreach ($claims as $claim)
				{
					$triple = array();
					$triple[] = $subject;
					$triple[] = $property_map[$p];	
					
					$value = $claim->mainsnak->datavalue->value->time;
					
					$value = preg_replace('/^\+/', '', $value);
					$value = preg_replace('/T.*$/', '', $value);
					
									
					$triple[] = '"' . $value . '"';
					
					$triples[] = $triple;
				}
				break;			
			
			
				

			// simple properties			
			case 'P304':
			case 'P433':
			case 'P478':			
				foreach ($claims as $claim)
				{
					$triple = array();
					$triple[] = $subject;
					$triple[] = $property_map[$p];					
					$triple[] = '"' . addcslashes($claim->mainsnak->datavalue->value, '"') . '"';
					
					$triples[] = $triple;
				}			
				break;
				
			// identifiers
			case 'P356':
				foreach ($claims as $claim)
				{
					wikidata_identifier($triples, $subject, 'doi', $claim->mainsnak->datavalue->value);
				}			
				break;
				
			case 'P698':
				foreach ($claims as $claim)
				{
					wikidata_identifier($triples, $subject, 'pmid', $claim->mainsnak->datavalue->value);
				}			
				break;

			case 'P888':
				foreach ($claims as $claim)
				{
					wikidata_identifier($triples, $subject, 'jstor', $claim->mainsnak->datavalue->value);					
				}			
				break;				
		
			default:
				break;
		}
	
	}
	
	ksort($authors);
	//print_r($authors);
	
	foreach ($authors as $k => $v)
	{
		if (is_object($v))
		{
			$id = '<' . $v->id . '>';

			$triple = array();
			$triple[] = $subject;
			$triple[] = '<http://schema.org/creator>';					
			$triple[] = $id;
	
			$triples[] = $triple;
	
			$triple = array();
			$triple[] = $id;
			$triple[] = '<http://www.w3.org/1999/02/22-rdf-syntax-ns#type>';					
			$triple[] = '<http://schema.org/Person>';
				
			$triples[] = $triple;
		
			foreach ($v->names as $name)
			{
				$triple = array();
				$triple[] = $id;
				$triple[] = '<http://schema.org/name>';					
				$triple[] = $name;
			
				$triples[] = $triple;
			}
			
			if (isset($v->orcid))
			{
				$triple = array();
				$triple[] = $id;
				$triple[] = '<http://schema.org/sameAs>';					
				$triple[] = '"https://orcid.org/' . $v->orcid . '"';
			
				$triples[] = $triple;
				
			}
		}
		else
		{
			$bnode = '_:creator' . $k;

			$triple = array();
			$triple[] = $subject;
			$triple[] = '<http://schema.org/creator>';					
			$triple[] = $bnode;
	
			$triples[] = $triple;
	
			$triple = array();
			$triple[] = $bnode;
			$triple[] = '<http://www.w3.org/1999/02/22-rdf-syntax-ns#type>';					
			$triple[] = '<http://schema.org/Person>';
	
			$triples[] = $triple;
		
			$triple = array();
			$triple[] = $bnode;
			$triple[] = '<http://schema.org/name>';					
			$triple[] = '"' . addcslashes($v, '"') . '"';
			
			$triples[] = $triple;
		}
	}


}


$qid = 'Q58837514';

$qid = 'Q42258926';

$qid = 'Q58676985';

$qid = 'Q47164672'; // 毛尾足螨屬3新種(蜱螨亞綱:尾足螨股)

//$qid = 'Q29035814';

//$qid = 'Q28944234';

$triples = array();

get_wikidata_work_ld($triples, $qid);

//print_r($triples);

$nt = '';

foreach ($triples as $triple)
{
	$nt .= join(' ', $triple) . ' .' . "\n";
}

//echo $nt;

$doc = jsonld_from_rdf($nt, array('format' => 'application/nquads'));

//print_r($doc);

// Frame it-------------------------------------------------------------------------------

// Identifier is always an array
$identifier = new stdclass;
$identifier->{'@id'} = "http://schema.org/identifier";
$identifier->{'@container'} = "@set";
	
// Creator is always an array
$creator = new stdclass;
$creator->{'@id'} = "http://schema.org/creator";
$creator->{'@container'} = "@set";

// Creator is always an array
$sameAs = new stdclass;
$sameAs->{'@id'} = "http://schema.org/sameAs";
$sameAs->{'@container'} = "@set";

// Context to set vocab to schema
$context = new stdclass;
$context->{'@vocab'} = "http://schema.org/";

$context->creator = $creator;
$context->identifier = $identifier;
$context->sameAs = $sameAs;

$frame = (object)array(
	'@context' => $context,

	// Root on article
	'@type' => 'http://schema.org/ScholarlyArticle',

);	

$framed = jsonld_frame($doc, $frame);

// Note JSON_UNESCAPED_UNICODE so that, for example, Chinese characters are not escaped
echo json_encode($framed, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
echo "\n";


?>
