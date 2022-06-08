<?php

// Add records to Wikidata from PMC (via EBI)

require_once (dirname(__FILE__) . '/wikidata.php');


$pmcs=array(
"PMC8473672",
"PMC8473674",
"PMC8319620",
"PMC8473673",
"PMC8473675",
"PMC8315928",
"PMC8315927",
"PMC8292844",
"PMC8292842",
"PMC8231403",
"PMC8181156",
"PMC8181171",
"PMC8181159",
"PMC8181153",
"PMC8181160",
"PMC8181164",
"PMC8181165",
"PMC8181161",
"PMC8181155",
"PMC7807172",
"PMC7807174",
"PMC7807173",
"PMC8315926",
"PMC8315924",
"PMC8292846",
"PMC8292845",
"PMC8292843",
"PMC8181154",
"PMC8181157",
"PMC8181166",
"PMC8181158",
"PMC8181168",
"PMC8181167",
"PMC7807176",
);




// True to update existing record, false to skip
$update = false;
//$update = true;

$check = true; // set to false if we are sure that record will exist with DOI

$detect_languages = array('en');


$count = 1;

foreach ($pmcs as $pmc)
{
	$go = true;
	
	$item = '';
	
	$item = wikidata_item_from_pmc($pmc);
	
	if ($item != '')
	{
		if (!$update)
		{
			//echo "Have $item already $item\n";
			
			$go = false;
		}
	}
	if ($go)
	{
	
		$parameters = array(
			'query' => 'PMCID:' . $pmc,
			'resulttype'	=> 'core',
			'format'		=> 'json'
		);
	
		$url = 'https://www.ebi.ac.uk/europepmc/webservices/rest/search?' . http_build_query($parameters);

		$json = get($url);
						
		$obj = json_decode($json);
		//print_r($obj);
		
		
		$csl = new stdclass;
		$csl->type = 'article-journal';
		
		foreach ($obj->resultList->result[0] as $k => $v)
		{
			switch ($k)
			{
				case 'pmcid':
					$csl->PMC = $v;
					break;

				case 'pmid':
					$csl->PMID = $v;
					break;

				case 'doi':
					$csl->DOI = $v;
					break;

				case 'title':
					$csl->title =strip_tags($v);
					break;

				case 'firstPublicationDate':
					$csl->issued = new stdclass;
					$csl->issued->{'date-parts'} = array();
					$csl->issued->{'date-parts'}[0] = array();
					$csl->issued->{'date-parts'}[0] = explode('-', $v);
					break;
					
				case 'pageInfo':
					$csl->page = $v;
					break;
					
				case 'journalInfo':
					if (isset($v->journal->title))
					{
						$csl->{'container-title'} = $v->journal->title;
					}
					if (isset($v->journal->issn))
					{
						$csl->ISSN = array($v->journal->issn);
					}
					if (isset($v->volume))
					{
						$csl->volume = $v->volume;
					}
					if (isset($v->issue))
					{
						$csl->issue = $v->issue;
					}
					break;
					
				case 'authorList':
					foreach ($v->author as $author)
					{
						$a = new stdclass;
						$a->given = $author->firstName;
						$a->family = $author->lastName;
						
						if (isset($author->authorId))
						{
							if ($author->authorId->type == 'ORCID')
							{
								$a->ORCID = 'https://orcid.org/' . $author->authorId->value;
							}
						}
						
						if (isset($author->authorAffiliationDetailsList))
						{
							foreach ($author->authorAffiliationDetailsList->authorAffiliation as $affiliation)
							{
								$aff = new stdclass;
								$aff->name = $affiliation->affiliation;
								$a->affiliation[] = $aff;
							}
						}
						
					
						$csl->author[] = $a;
					
					}
					break;
					
				case 'fullTextUrlList':
					foreach ($v->fullTextUrl as $fullTextUrl)
					{
						if ($fullTextUrl->documentStyle == 'pdf')
						{
							$link = new stdclass;
							$link->{'content-type'} = 'application/pdf';
							$link->URL = $fullTextUrl->url;
							
							$csl->link[] = $link;
							
						}
					}
					break;				

				default:
					break;
			}
		
		
		}		
		
		$work = new stdclass;
		$work->message = $csl;	
		
	
		//print_r($work);				
		
		//exit();
	
		if ($work)
		{
			$source = array();
			
			$source[] = 'S248';
			$source[] = 'Q5412157'; // Europe PubMed Central
							
			$source[] = 'S854';
			$source[] = '"' . $url . '"';
			
			$q = csljson_to_wikidata(
				$work, 
				$check, 	// check if already exists
				$update, // true to update an existing record, false to skip an existing record
				$detect_languages,
				$source
				);
		
			echo $q;
			echo "\n";
		}
		
		
		// Give server a break every 10 items
		if (($count++ % 10) == 0)
		{
			$rand = rand(1000000, 3000000);
			usleep($rand);
		}

		
	}	


}


?>
