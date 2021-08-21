<?php

// Add records for books from WorldCat 
error_reporting(E_ALL);

require_once (dirname(__FILE__) . '/wikidata.php');

require_once 'vendor/autoload.php';
use LanguageDetection\Language;
use Biblys\Isbn\Isbn as Isbn;



$oclcs = array(
/*
891113992,
39076440,
871364018,
*/
//52305971,
//636735311,
17545801
);



foreach ($oclcs as $oclc)
{
	$url = 'http://experiment.worldcat.org/oclc/' . $oclc . '.jsonld';
	
	if (1)
	{
		$json = get($url);
	}
	else
	{
	
	$json = '{
  "@graph" : [ {
    "@id" : "http://experiment.worldcat.org/entity/work/data/8913073298#Agent/australian_orchid_foundation",
    "@type" : "bgn:Agent",
    "name" : "Australian Orchid Foundation"
  }, {
    "@id" : "http://experiment.worldcat.org/entity/work/data/8913073298#Person/jones_david_l",
    "@type" : "schema:Person",
    "familyName" : "Jones",
    "givenName" : "David L.",
    "name" : "David L. Jones"
  }, {
    "@id" : "http://experiment.worldcat.org/entity/work/data/8913073298#Place/essendon_vic",
    "@type" : "schema:Place",
    "name" : "Essendon, Vic"
  }, {
    "@id" : "http://experiment.worldcat.org/entity/work/data/8913073298#Series/australian_orchid_research",
    "@type" : "bgn:PublicationSeries",
    "hasPart" : "http://www.worldcat.org/oclc/891113992",
    "name" : "Australian orchid research ;"
  }, {
    "@id" : "http://experiment.worldcat.org/entity/work/data/8913073298#Thing/orch",
    "@type" : "schema:Thing",
    "name" : "ORCH"
  }, {
    "@id" : "http://id.loc.gov/vocabulary/countries/vra",
    "@type" : "schema:Place",
    "identifier" : "vra"
  }, {
    "@id" : "http://worldcat.org/isbn/9780959538465",
    "@type" : "schema:ProductModel",
    "isbn" : [ "9780959538465", "0959538461" ]
  }, {
    "@id" : "http://www.worldcat.org/oclc/891113992",
    "@type" : [ "schema:Book", "schema:CreativeWork" ],
    "oclcnum" : "891113992",
    "placeOfPublication" : [ "http://experiment.worldcat.org/entity/work/data/8913073298#Place/essendon_vic", "http://id.loc.gov/vocabulary/countries/vra" ],
    "about" : "http://experiment.worldcat.org/entity/work/data/8913073298#Thing/orch",
    "bookFormat" : "bgn:PrintBook",
    "creator" : "http://experiment.worldcat.org/entity/work/data/8913073298#Person/jones_david_l",
    "datePublished" : "1991",
    "exampleOfWork" : "http://worldcat.org/entity/work/id/8913073298",
    "inLanguage" : "en",
    "isPartOf" : "http://experiment.worldcat.org/entity/work/data/8913073298#Series/australian_orchid_research",
    "name" : "New taxa for australian orchidaceae",
    "productID" : "891113992",
    "publication" : "http://www.worldcat.org/title/-/oclc/891113992#PublicationEvent/essendon_vic_australian_orchid_foundation_1991",
    "publisher" : "http://experiment.worldcat.org/entity/work/data/8913073298#Agent/australian_orchid_foundation",
    "workExample" : "http://worldcat.org/isbn/9780959538465",
    "describedby" : "http://www.worldcat.org/title/-/oclc/891113992"
  }, {
    "@id" : "http://www.worldcat.org/title/-/oclc/891113992",
    "@type" : [ "genont:ContentTypeGenericResource", "genont:InformationResource" ],
    "inDataset" : "http://purl.oclc.org/dataset/WorldCat",
    "about" : "http://www.worldcat.org/oclc/891113992",
    "dateModified" : "2019-02-15"
  }, {
    "@id" : "http://www.worldcat.org/title/-/oclc/891113992#PublicationEvent/essendon_vic_australian_orchid_foundation_1991",
    "@type" : "schema:PublicationEvent",
    "location" : "http://experiment.worldcat.org/entity/work/data/8913073298#Place/essendon_vic",
    "organizer" : "http://experiment.worldcat.org/entity/work/data/8913073298#Agent/australian_orchid_foundation",
    "startDate" : "1991"
  } ],
  "@context" : {
    "location" : {
      "@id" : "http://schema.org/location",
      "@type" : "@id"
    },
    "organizer" : {
      "@id" : "http://schema.org/organizer",
      "@type" : "@id"
    },
    "startDate" : {
      "@id" : "http://schema.org/startDate"
    },
    "isbn" : {
      "@id" : "http://schema.org/isbn"
    },
    "familyName" : {
      "@id" : "http://schema.org/familyName"
    },
    "givenName" : {
      "@id" : "http://schema.org/givenName"
    },
    "name" : {
      "@id" : "http://schema.org/name"
    },
    "inLanguage" : {
      "@id" : "http://schema.org/inLanguage"
    },
    "bookFormat" : {
      "@id" : "http://schema.org/bookFormat",
      "@type" : "@id"
    },
    "isPartOf" : {
      "@id" : "http://schema.org/isPartOf",
      "@type" : "@id"
    },
    "describedby" : {
      "@id" : "http://www.w3.org/2007/05/powder-s#describedby",
      "@type" : "@id"
    },
    "about" : {
      "@id" : "http://schema.org/about",
      "@type" : "@id"
    },
    "workExample" : {
      "@id" : "http://schema.org/workExample",
      "@type" : "@id"
    },
    "placeOfPublication" : {
      "@id" : "http://purl.org/library/placeOfPublication",
      "@type" : "@id"
    },
    "exampleOfWork" : {
      "@id" : "http://schema.org/exampleOfWork",
      "@type" : "@id"
    },
    "productID" : {
      "@id" : "http://schema.org/productID"
    },
    "creator" : {
      "@id" : "http://schema.org/creator",
      "@type" : "@id"
    },
    "publisher" : {
      "@id" : "http://schema.org/publisher",
      "@type" : "@id"
    },
    "datePublished" : {
      "@id" : "http://schema.org/datePublished"
    },
    "publication" : {
      "@id" : "http://schema.org/publication",
      "@type" : "@id"
    },
    "oclcnum" : {
      "@id" : "http://purl.org/library/oclcnum"
    },
    "identifier" : {
      "@id" : "http://purl.org/dc/terms/identifier"
    },
    "dateModified" : {
      "@id" : "http://schema.org/dateModified"
    },
    "inDataset" : {
      "@id" : "http://rdfs.org/ns/void#inDataset",
      "@type" : "@id"
    },
    "hasPart" : {
      "@id" : "http://schema.org/hasPart",
      "@type" : "@id"
    },
    "schema" : "http://schema.org/",
    "library" : "http://purl.org/library/",
    "genont" : "http://www.w3.org/2006/gen/ont#",
    "void" : "http://rdfs.org/ns/void#",
    "rdf" : "http://www.w3.org/1999/02/22-rdf-syntax-ns#",
    "bgn" : "http://bibliograph.net/",
    "xsd" : "http://www.w3.org/2001/XMLSchema#",
    "dcterms" : "http://purl.org/dc/terms/",
    "wdrs" : "http://www.w3.org/2007/05/powder-s#",
    "pto" : "http://www.productontology.org/id/"
  }
}';
	
	}
	//echo $json;
	
	if ($json != '')
	{
	
		$obj = json_decode($json);
		
		//print_r($obj);
		
		// get nodes in graph
		$nodes = array();
		foreach ($obj->{'@graph'} as $graph)
		{
			$nodes[$graph->{'@id'}] = $graph;
		}
		
		print_r($nodes);
		
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
		
		$MAX_LABEL_LENGTH = 250;
	
		$item = '';
		
		$w = array();
		
		// get book details
		
		$id = 'http://www.worldcat.org/oclc/' . $oclc;
		
		foreach ($nodes[$id] as $k => $v)
		{
			switch ($k)
			{
				// Type (here be dragons)
				// simple model is to have a "book" item with ISBN
				// Wikidata book project has model where each "book" has a work item and 
				// one or more expressions (which have unique ISBNs).
			
				case '@type':
					$types = array();
					
					if (is_array($v))
					{
						foreach ($v as $t)
						{
							$types[] = $t;				
						}
					}
					else
					{
						$types[] = $v;
					}
					
					foreach ($types as $t)
					{
						switch ($t)
						{
							case 'schema:Book':
								$w[] = array('P31' => 'Q47461344'); // written work
								
								//$w[] = array('P31' => 'Q3331189');  // version, edition, or translation
								break;
								
							case 'bgn:Thesis':
								$w[] = array('P31' => 'Q1266946'); // thesis
								break;
								
						
							default:
								break;
						}
					}
					break;
			
			
			
				case 'oclcnum':
					$w[] = array('P243' => '"' . $v . '"' );
					
					if ($item == '')
					{
						$item = wikidata_item_from_oclc($v);
					}										
					
					break;
			
				case 'datePublished':
					$date_string = $v;
					if (is_array($v))
					{
						$date_string = $v[0];
					}
				
					$d = explode('-', $date_string);
		
					if ( count($d) > 0 ) $year = $d[0] ;
					if ( count($d) > 1 ) $month = preg_replace ( '/^0+(..)$/' , '$1' , '00'.$d[1] ) ;
					if ( count($d) > 2 ) $day = preg_replace ( '/^0+(..)$/' , '$1' , '00'.$d[2] ) ;
					if ( isset($month) and isset($day) ) $date = "+$year-$month-$day"."T00:00:00Z/11";
					else if ( isset($month) ) $date = "+$year-$month-00T00:00:00Z/10";
					else if ( isset($year) ) $date = "+$year-00-00T00:00:00Z/9";
		
					$w[] = array('P577' => $date);	
					break;	
					
				case 'name':
					$language = '';
					
					if (is_object($v))
					{
						$language = $v->{'@language'};
						$title = $v->{'@value'};
					}
					else
					{
						$title = $v;
					}					
					
					if (isset($nodes[$id]->inLanguage))
					{
						$language = $nodes[$id]->inLanguage;
					}
					
					// if no language for now assume English
					if ($language == '')
					{
						$language = 'en';
					}					
					
					//if ($language == 'en')
					{
						// Assume work is English
						$w[] = array('P407' => $language_map[$language]);

						// title
						$w[] = array('P1476' => $language . ':' . '"' . $title . '"');

						// label
						$w[] = array('L' . $language => '"' . nice_shorten($title, $MAX_LABEL_LENGTH) . '"');
					}								
					break;
					
					
				case 'alternateName':
					$title = $v;
					$ld = new Language();						
					$language = $ld->detect($title)->__toString();
					
					// title
					$w[] = array('P1476' => $language . ':' . '"' . $title . '"');

					// label
					$w[] = array('L' . $language => '"' . nice_shorten($title, $MAX_LABEL_LENGTH) . '"');
					break;
				
					
				case 'workExample':
					if (isset($nodes[$v]))
					{
						if (isset($nodes[$v]->isbn))
						{
							$isbn_strings = array();
							
							if (is_array($nodes[$v]->isbn))
							{
								foreach ($nodes[$v]->isbn as $isbn_string)
								{
									$isbn_strings[] = $isbn_string;				
								}
							}
							else
							{
								$isbn_strings[] = $nodes[$v]->isbn;
							}
							
							// print_r($isbn_strings);
							
							foreach ($isbn_strings as $isbn_string)
							{
								$isbn = new Isbn($isbn_string);
							
								if ((strlen($isbn_string) == 10) && ($item == ''))
								{
									$item = wikidata_item_from_isbn10($isbn_string);
									
									$w[] = array('P957' => '"' .  $isbn->format("ISBN-10") . '"' );
								}
								if ((strlen($isbn_string) == 13) && ($item == ''))
								{
									$item = wikidata_item_from_isbn13($isbn_string);
									
									$w[] = array('P212' => '"' .  $isbn->format("ISBN-13") . '"' );
								}
							
							}
							
							
						
						}
					
					}
					break;
					
				case 'contributor':
				case 'creator':
					$contributors = array();
					if (is_array($v))
					{
						$contributors = $v;
					}
					else
					{
						$contributors[] = $v;
					}
					
					$name_strings = array();
					
					$count = 1;
					
					foreach ($contributors as $contributor_id)
					{
						// either a string or a VIAF
						
						if (isset($nodes[$contributor_id]))
						{
							$id = $nodes[$contributor_id]->{'@id'};
							$name =  $nodes[$contributor_id]->name;
							
							$name_strings[] = $name;
							
							$done = false;
							
							if (preg_match('/http:\/\/viaf.org\/viaf\/(?<id>\d+)/', $nodes[$contributor_id]->{'@id'}, $m))
							{
								$viaf = $m['id'];
								$author_item = wikidata_item_from_viaf($viaf);
							
								if ($author_item != '')
								{							
									$w[] = array('P50' => $author_item . "\tP1545\t\"$count\"");
									$done = true;
								}								
							}
							
							if (!$done)
							{
								$w[] = array('P2093' => '"' . $name . '"' . "\tP1545\t\"$count\"");
							}
							
							
						
						}
						
						$count++;
					
					
					}
					
					if (count($name_strings) > 0)
					{
						// Generate a human-friendly description
						$n = count($name_strings);
						$names = array();
						if ($n > 1)
						{
							$names = array_slice($name_strings, 0, $n - 1);
						}
						$description = "Book by ";
			
						if (count($names) > 0)
						{			
							$description .= join(", ", $names) . " and ";
						}
			 
						$description .= $name_strings[$n - 1];
			
						$w[] = array('Den' => '"' . $description . '"');	
					}
					
					
					break;
				
			
				default:
					break;
			
			}
		
			
		
		}
		
		// add ISBNs
		
		
		// output
		
		// print_r($w);
		
		$source = array();
		
		// assume create
		if ($item == '')
		{
			echo "CREATE\n";
			$item = 'LAST';
		}	
		
		// WorldCat is the source
		$source[] = 'S248';
		$source[] = 'Q846596';
		$source[] = 'S854';
		$source[] = '"' . $url . '"';
		
		
		$quickstatements = '';
	
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
		
		echo $quickstatements . "\n";
		
	}

}


// Q57320752 orcid
// Q21391702 wikispecies
// Q47125134 IPNI
