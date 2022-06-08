<?php

// Find articles for a journal in Zenodo


// https://zenodo.org/api/records?page=1&q=journal.title%3AOnychium&size=100

require_once (dirname(__FILE__) . '/wikidata.php');

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
				if (is_array($v))
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
				if (is_array($v))
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
						$authors[] = $author->literal;
					}
				}
	
				$keys[] = 'authors';
				$values[] = '"' . join(';', $authors) . '"';						
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

$update = false;
$check = true; // set to false if we are sure that record will exist with DOI
$detect_languages = array('en', 'it');


$dois=array();

$json = '{
    "aggregations": {
        "access_right": {
            "buckets": [
                {
                    "doc_count": 33,
                    "key": "open"
                }
            ],
            "doc_count_error_upper_bound": 0,
            "sum_other_doc_count": 0
        },
        "file_type": {
            "buckets": [
                {
                    "doc_count": 33,
                    "key": "pdf"
                }
            ],
            "doc_count_error_upper_bound": 0,
            "sum_other_doc_count": 0
        },
        "keywords": {
            "buckets": [
                {
                    "doc_count": 10,
                    "key": "new species"
                },
                {
                    "doc_count": 7,
                    "key": "Italy"
                },
                {
                    "doc_count": 6,
                    "key": "Tuscany"
                },
                {
                    "doc_count": 5,
                    "key": "Coleoptera"
                },
                {
                    "doc_count": 5,
                    "key": "distribution"
                },
                {
                    "doc_count": 4,
                    "key": "new records"
                },
                {
                    "doc_count": 3,
                    "key": "Scorpion"
                },
                {
                    "doc_count": 3,
                    "key": "Tuscan Archipelago"
                },
                {
                    "doc_count": 3,
                    "key": "biogeography"
                },
                {
                    "doc_count": 3,
                    "key": "new record"
                }
            ],
            "doc_count_error_upper_bound": 0,
            "sum_other_doc_count": 132
        },
        "type": {
            "buckets": [
                {
                    "doc_count": 33,
                    "key": "publication",
                    "subtype": {
                        "buckets": [
                            {
                                "doc_count": 33,
                                "key": "article"
                            }
                        ],
                        "doc_count_error_upper_bound": 0,
                        "sum_other_doc_count": 0
                    }
                }
            ],
            "doc_count_error_upper_bound": 0,
            "sum_other_doc_count": 0
        }
    },
    "hits": {
        "hits": [
            {
                "conceptdoi": "10.5281/zenodo.1219119",
                "conceptrecid": "1219119",
                "created": "2018-04-20T08:31:39.517671+00:00",
                "doi": "10.5281/zenodo.1219120",
                "files": [
                    {
                        "bucket": "07aebb58-b615-44a1-8ecb-d44fa0bd5a43",
                        "checksum": "md5:f2601bd1ad9c242ee0bcfb99c210a0c1",
                        "key": "Scaccini_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/07aebb58-b615-44a1-8ecb-d44fa0bd5a43/Scaccini_2018_Onychium14.pdf"
                        },
                        "size": 2225548,
                        "type": "pdf"
                    }
                ],
                "id": 1219120,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219120.svg",
                    "bucket": "https://zenodo.org/api/files/07aebb58-b615-44a1-8ecb-d44fa0bd5a43",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219119.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1219119",
                    "doi": "https://doi.org/10.5281/zenodo.1219120",
                    "html": "https://zenodo.org/record/1219120",
                    "latest": "https://zenodo.org/api/records/1219120",
                    "latest_html": "https://zenodo.org/record/1219120",
                    "self": "https://zenodo.org/api/records/1219120"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Zelo Buon Persico (Lodi), Italy",
                            "name": "Scaccini, Davide"
                        }
                    ],
                    "description": "<p>The updated distribution of the two Italian <em>Platycerus </em>species (Coleoptera: Lucanidae) in Piacenza province and surroundings (northern Italy) is reported, adding data mainly from field research, but also from one collection and from websites. Furthermore, host trees are listed from field data, showing the relationship between <em>Platycerus caraboides</em> (Linnaeus, 1758) and plants not reported yet (<em>Acer </em>spp., <em>Corylus avellana</em> L., and <em>Ostrya carpinifolia</em> Scop.), and confirming bibliographic data for both species.</p>",
                    "doi": "10.5281/zenodo.1219120",
                    "journal": {
                        "pages": "135-144",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Platycerus caprea",
                        "Platycerus caraboides",
                        "distribution",
                        "new records",
                        "host plants",
                        "Piacenza province",
                        "northern Apennines",
                        "Italy"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Scaccini, Davide (2018) Updated distribution of the species of the genus Platycerus Geoffroy, 1762 in Piacenza province and surroundings (northern Italy), with new records of host trees (Coleoptera: Lucanidae). Onychium, 14: 135-144"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1219119",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1219120"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1219119"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Updated distribution of the species of the genus Platycerus Geoffroy, 1762 in Piacenza province and surroundings (northern Italy), with new records of host trees (Coleoptera: Lucanidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 4,
                "stats": {
                    "downloads": 22,
                    "unique_downloads": 20,
                    "unique_views": 30,
                    "version_downloads": 22,
                    "version_unique_downloads": 20,
                    "version_unique_views": 30,
                    "version_views": 31,
                    "version_volume": 48962056,
                    "views": 31,
                    "volume": 48962056
                },
                "updated": "2020-01-20T14:27:55.502715+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1219558",
                "conceptrecid": "1219558",
                "created": "2018-04-20T08:32:22.525872+00:00",
                "doi": "10.5281/zenodo.1219559",
                "files": [
                    {
                        "bucket": "76c5370d-cdfc-4ceb-8de5-ba4b517f773e",
                        "checksum": "md5:0b40d379f3dd2798e45142b397a51a3d",
                        "key": "Papi_Franzini_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/76c5370d-cdfc-4ceb-8de5-ba4b517f773e/Papi_Franzini_2018_Onychium14.pdf"
                        },
                        "size": 1412734,
                        "type": "pdf"
                    }
                ],
                "id": 1219559,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219559.svg",
                    "bucket": "https://zenodo.org/api/files/76c5370d-cdfc-4ceb-8de5-ba4b517f773e",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219558.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1219558",
                    "doi": "https://doi.org/10.5281/zenodo.1219559",
                    "html": "https://zenodo.org/record/1219559",
                    "latest": "https://zenodo.org/api/records/1219559",
                    "latest_html": "https://zenodo.org/record/1219559",
                    "self": "https://zenodo.org/api/records/1219559"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Papi, Rossano"
                        },
                        {
                            "affiliation": "Milan, Italy",
                            "name": "Franzini, Gabriele"
                        }
                    ],
                    "description": "<p><em>Catalog of the Malachidae and Dasytidae of the Pratomagno massif (Tuscan pre-Apennines) (Coleoptera: Cleroidea).</em>The Malachiidae and Dasytidae so far known in the Pratomagno massif (Tuscan preApennines) are listed, on the basis of data from literature or unpublished records, for a total of 40 species ascertained (21 Malachiidae and 19 Dasytidae). The finding of Malachius stolatus Mulsant &amp; Rey, 1867, which is here recorded for the first time for Central Italy, is particularly interesting.</p>",
                    "doi": "10.5281/zenodo.1219559",
                    "journal": {
                        "pages": "145-168",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Coleoptera",
                        "Malachidae",
                        "Malachidae",
                        "Dasytidae",
                        "Dasytinae",
                        "Melyridae",
                        "Malachius",
                        "first record",
                        "Tuscany"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Papi, Rossano & Franzini, Gabriele (2018). Catalogo dei Malachiidae e Dasytidae del Massiccio del Pratomagno (Preappennino Toscano) (Coleoptera: Cleroidea). Onychium, 14: 145-168"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1219558",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1219559"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1219558"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Catalogo dei Malachiidae e Dasytidae del Massiccio del Pratomagno (Preappennino Toscano) (Coleoptera: Cleroidea)"
                },
                "owners": [
                    29896
                ],
                "revision": 4,
                "stats": {
                    "downloads": 48,
                    "unique_downloads": 44,
                    "unique_views": 285,
                    "version_downloads": 47,
                    "version_unique_downloads": 43,
                    "version_unique_views": 285,
                    "version_views": 295,
                    "version_volume": 66398498,
                    "views": 295,
                    "volume": 67811232
                },
                "updated": "2020-01-20T17:04:21.429403+00:00"
            },
            {
                "conceptrecid": "795794",
                "created": "2017-04-20T10:21:40.554753+00:00",
                "doi": "10.5281/zenodo.545804",
                "files": [
                    {
                        "bucket": "a78c1056-20eb-49cf-a509-6cca6361d7cc",
                        "checksum": "md5:65f812da5fc825ac2a64ad20429657c8",
                        "key": "Dondini_etal_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/a78c1056-20eb-49cf-a509-6cca6361d7cc/Dondini_etal_2017_Onychium13.pdf"
                        },
                        "size": 864104,
                        "type": "pdf"
                    }
                ],
                "id": 545804,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.545804.svg",
                    "bucket": "https://zenodo.org/api/files/a78c1056-20eb-49cf-a509-6cca6361d7cc",
                    "doi": "https://doi.org/10.5281/zenodo.545804",
                    "html": "https://zenodo.org/record/545804",
                    "latest": "https://zenodo.org/api/records/545804",
                    "latest_html": "https://zenodo.org/record/545804",
                    "self": "https://zenodo.org/api/records/545804"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Nature and Archaeological Center of Pistoiese Apennine, Campo Tizzoro (Pistoia), Italy",
                            "name": "Dondini, Gianna"
                        },
                        {
                            "affiliation": "Department of Biological Sciences, School of Applied Sciences, University of Huddersfield, United Kingdom",
                            "name": "Vanin, Stefano"
                        },
                        {
                            "affiliation": "Nature and Archaeological Center of Pistoiese Apennine, Campo Tizzoro (Pistoia), Italy",
                            "name": "Vergari, Sebastiano"
                        },
                        {
                            "affiliation": "Nature and Archaeological Center of Pistoiese Apennine, Campo Tizzoro (Pistoia), Italy",
                            "name": "Vergari, Simone"
                        }
                    ],
                    "description": "<p>The presence of <em>Basilia mediterranea </em>Hůrka, 1970, species with Western Mediterranean distribution, is reported for the first time from Italy. Two specimens, a male and a female, were collected from two bats belonging to the species <em>Pipistrellus pipistrellus </em>Schreber, 1774 captured with mist nets during a research on bats of Montecristo and Capraia islands (Tuscan Archipelago National Park, Central Italy).</p>",
                    "doi": "10.5281/zenodo.545804",
                    "journal": {
                        "pages": "139-142",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Diptera",
                        "Nycteribiidae",
                        "Basilia mediterranea",
                        "Pipistrellus pipistrellus",
                        "Chiroptera",
                        "Italy",
                        "Tuscan Archipelago National Park"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Dondini, Gianna (2017). First record of Basilia mediterranea Hůrka, 1970 from Italy (Diptera: Nycteribiidae). Onychium, 13: 139-142"
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "545804"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "795794"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "First record of Basilia mediterranea Hůrka, 1970 from Italy (Diptera: Nycteribiidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 14,
                    "unique_downloads": 13,
                    "unique_views": 19,
                    "version_downloads": 14,
                    "version_unique_downloads": 13,
                    "version_unique_views": 19,
                    "version_views": 20,
                    "version_volume": 12097456,
                    "views": 20,
                    "volume": 12097456
                },
                "updated": "2020-01-20T14:24:36.081162+00:00"
            },
            {
                "conceptrecid": "795113",
                "created": "2017-04-20T10:13:09.376319+00:00",
                "doi": "10.5281/zenodo.495599",
                "files": [
                    {
                        "bucket": "cabedf99-d4ee-4238-b8c5-500ee794d209",
                        "checksum": "md5:6441e3e8e44fcc1b1f02406b49e3bf61",
                        "key": "Rocchi_etal_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/cabedf99-d4ee-4238-b8c5-500ee794d209/Rocchi_etal_2017_Onychium13.pdf"
                        },
                        "size": 407445,
                        "type": "pdf"
                    }
                ],
                "id": 495599,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.495599.svg",
                    "bucket": "https://zenodo.org/api/files/cabedf99-d4ee-4238-b8c5-500ee794d209",
                    "doi": "https://doi.org/10.5281/zenodo.495599",
                    "html": "https://zenodo.org/record/495599",
                    "latest": "https://zenodo.org/api/records/495599",
                    "latest_html": "https://zenodo.org/record/495599",
                    "self": "https://zenodo.org/api/records/495599"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Rocchi, Saverio"
                        },
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Terzani, Fabio"
                        },
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Cianferoni, Fabio"
                        },
                        {
                            "affiliation": "Portoferraio (Livorno), Italy",
                            "name": "Forbicioni, Leonardo"
                        },
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Papi, Rossano"
                        },
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Pizzocaro, Lucia"
                        }
                    ],
                    "description": "<p><em>Update to the knowledge of aquatic beetles of the Tuscan Archipelago (Coleoptera)</em>. This paper is an update of a previous contribution on the aquatic beetles of the Tuscan Archipelago (Rocchi <em>et al.</em>, 2014). The list includes 101 taxa (species and subspecies): 3 Gyrinidae, 3 Haliplidae, 1 Noteridae, 32 Dytiscidae, 4 Helophoridae, 1 Georissidae, 2 Hydrochidae, 32 Hydrophilidae, 19 Hydraenidae, 2 Elmidae, 1 Dryopidae, 1 Heteroceridae. The family Georissidae is recorded for the first time from the Tuscan Archipelago; 1 species from Tuscany, 8 from the Tuscan Archipelago, 2 from Capraia Island, 10 from Elba Island, 1 from Giglio Island, 5 from Montecristo Island, 1 from Cerboli Islet, and 1 from Palmaiola Islet are first records for these areas; the opaque form of the female <em>Bidessus saucius</em> (Desbrochers des Loges, 1871) is recorded for the first time from Italy (Montecristo Island and Sardinia).</p>",
                    "doi": "10.5281/zenodo.495599",
                    "journal": {
                        "pages": "75-91",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "aquatic Coleoptera",
                        "Tuscan Archipelago",
                        "Italy"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Rocchi, Saverio et al. (2017). Aggiornamenti alla conoscenza della coleotterofauna acquatica  dell\'Arcipelago Toscano (Coleoptera). Onychium, 13: 75-91"
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "495599"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "795113"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Aggiornamenti alla conoscenza della coleotterofauna acquatica  dell\'Arcipelago Toscano (Coleoptera)"
                },
                "owners": [
                    29896
                ],
                "revision": 6,
                "stats": {
                    "downloads": 11,
                    "unique_downloads": 11,
                    "unique_views": 25,
                    "version_downloads": 11,
                    "version_unique_downloads": 11,
                    "version_unique_views": 25,
                    "version_views": 26,
                    "version_volume": 4481895,
                    "views": 26,
                    "volume": 4481895
                },
                "updated": "2020-01-20T14:43:12.687003+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1219129",
                "conceptrecid": "1219129",
                "created": "2018-04-20T08:33:15.047577+00:00",
                "doi": "10.5281/zenodo.1219130",
                "files": [
                    {
                        "bucket": "495329ab-a1ca-4cd2-9ede-eb6ecad477c2",
                        "checksum": "md5:f1a3610226f2d0f8949720d945225465",
                        "key": "Colonnelli_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/495329ab-a1ca-4cd2-9ede-eb6ecad477c2/Colonnelli_2018_Onychium14.pdf"
                        },
                        "size": 596754,
                        "type": "pdf"
                    }
                ],
                "id": 1219130,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219130.svg",
                    "bucket": "https://zenodo.org/api/files/495329ab-a1ca-4cd2-9ede-eb6ecad477c2",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219129.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1219129",
                    "doi": "https://doi.org/10.5281/zenodo.1219130",
                    "html": "https://zenodo.org/record/1219130",
                    "latest": "https://zenodo.org/api/records/1219130",
                    "latest_html": "https://zenodo.org/record/1219130",
                    "self": "https://zenodo.org/api/records/1219130"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Rome, Italy",
                            "name": "Colonnelli, Enzo"
                        }
                    ],
                    "description": "<p><em>Acanthalophus bicaudatus</em> n. sp. from Sichuan, China, is described, illustrated, and compared with the Japanese species thus far known, from all four of which it readily differs by the separate mucros of elytra.</p>",
                    "doi": "10.5281/zenodo.1219130",
                    "journal": {
                        "pages": "169-171",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Curculionidae",
                        "Acanthalophus",
                        "new species",
                        "China"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Colonnelli, Enzo (2018). A new Acanthalophus Morimoto, 2015 from China (Coleoptera: Curculionidae). Onychium, 14: 169-171"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:0504E603-09DD-46C4-B575-147DEB6D1963",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        },
                        {
                            "identifier": "10.5281/zenodo.1219129",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1219130"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1219129"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new Acanthalophus Morimoto, 2015 from China (Coleoptera: Curculionidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 4,
                "stats": {
                    "downloads": 22,
                    "unique_downloads": 22,
                    "unique_views": 17,
                    "version_downloads": 22,
                    "version_unique_downloads": 22,
                    "version_unique_views": 17,
                    "version_views": 17,
                    "version_volume": 13128588,
                    "views": 17,
                    "volume": 13128588
                },
                "updated": "2020-01-20T14:49:29.050176+00:00"
            },
            {
                "conceptrecid": "797116",
                "created": "2017-04-20T10:14:03.844911+00:00",
                "doi": "10.5281/zenodo.439628",
                "files": [
                    {
                        "bucket": "0b79ae10-4447-4325-af1c-2c03753973a6",
                        "checksum": "md5:c28ca6b0866ba39fc379ab741a2bdf6c",
                        "key": "Rocchi_Terzani_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/0b79ae10-4447-4325-af1c-2c03753973a6/Rocchi_Terzani_2017_Onychium13.pdf"
                        },
                        "size": 323318,
                        "type": "pdf"
                    }
                ],
                "id": 439628,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.439628.svg",
                    "bucket": "https://zenodo.org/api/files/0b79ae10-4447-4325-af1c-2c03753973a6",
                    "doi": "https://doi.org/10.5281/zenodo.439628",
                    "html": "https://zenodo.org/record/439628",
                    "latest": "https://zenodo.org/api/records/439628",
                    "latest_html": "https://zenodo.org/record/439628",
                    "self": "https://zenodo.org/api/records/439628"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Rocchi, Saverio"
                        },
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Terzani, Fabio"
                        }
                    ],
                    "description": "<p><em>Contribution to the knowledge of the aquatic beetles from Tuscany (Central Italy). V. Updates: Hydraenidae (Coleoptera). </em>An update of the previous contribution (Rocchi <em>et al</em>., 1999) on the presence in Tuscany of the family Hydraenidae is given. The list includes 75 species belonging to 4 genera: <em>Hydraena</em> Kugelann,1794 (27 species), <em>Limnebius</em> Leach, 1815 (11 species), <em>Aulacochthebius</em> Kuwert, 1887 (1 species), and <em>Ochthebius</em> Leach, 1815 (36 species).</p>",
                    "doi": "10.5281/zenodo.439628",
                    "journal": {
                        "pages": "93-106",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Coleoptera",
                        "Hydraenidae",
                        "records",
                        "Tuscany"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Rocchi, Saverio & Terzani, Fabio (2017) Contributo alla conoscenza dei Coleotteri degli ambienti acquatici della Toscana (Italia Centrale). V. Aggiornamenti: Hydraenidae (Coleoptera). Onychium, 13: 93-106"
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "439628"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "797116"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Contributo alla conoscenza dei Coleotteri degli ambienti acquatici della Toscana (Italia Centrale). V. Aggiornamenti: Hydraenidae (Coleoptera)"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 34,
                    "unique_downloads": 33,
                    "unique_views": 58,
                    "version_downloads": 34,
                    "version_unique_downloads": 33,
                    "version_unique_views": 58,
                    "version_views": 60,
                    "version_volume": 10992812,
                    "views": 60,
                    "volume": 10992812
                },
                "updated": "2020-01-20T12:05:13.733159+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1219107",
                "conceptrecid": "1219107",
                "created": "2018-04-20T08:30:02.685589+00:00",
                "doi": "10.5281/zenodo.1219108",
                "files": [
                    {
                        "bucket": "b46f7257-72f5-4d77-8fea-4388489220d5",
                        "checksum": "md5:6c2fc5db3e69c4590f64c5028c160bd6",
                        "key": "Rocchi_Terzani_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/b46f7257-72f5-4d77-8fea-4388489220d5/Rocchi_Terzani_2018_Onychium14.pdf"
                        },
                        "size": 429529,
                        "type": "pdf"
                    }
                ],
                "id": 1219108,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219108.svg",
                    "bucket": "https://zenodo.org/api/files/b46f7257-72f5-4d77-8fea-4388489220d5",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219107.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1219107",
                    "doi": "https://doi.org/10.5281/zenodo.1219108",
                    "html": "https://zenodo.org/record/1219108",
                    "latest": "https://zenodo.org/api/records/1219108",
                    "latest_html": "https://zenodo.org/record/1219108",
                    "self": "https://zenodo.org/api/records/1219108"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Rocchi, Saverio"
                        },
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Terzani, Fabio"
                        }
                    ],
                    "description": "<p><em>Contribution to the knowledge of the aquatic beetles of Tuscany (Central Italy). VI. Update: Sphaeriusidae, Helophoridae, Georissidae, Hydrochidae, Spercheidae, Hydrophilidae (Coleoptera).</em> An update of the distribution in Tuscany of the family Sphaeriusidae, Helophoridae, Georissidae, Hydrochidae, Spercheidae, Hydrophilidae is given. The list includes 95 species: 1 Sphaeriusidae, 25 Helophoridae, 4 Georissidae, 7 Hydrochidae, 1 Spercheidae, 57 Hydrophilidae; for 9 of them the presence in Tuscany is to be considered erroneous or at least doubtful.</p>",
                    "doi": "10.5281/zenodo.1219108",
                    "journal": {
                        "pages": "109-130",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Aquatic beetles",
                        "records",
                        "Tuscany"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Rocchi, Saverio & Terzani, Fabio (2018) Contributo alla conoscenza dei Coleotteri degli ambienti acquatici della Toscana (Italia Centrale). VI. Aggiornamenti: Sphaeriusidae, Helophoridae, Georissidae, Hydrochidae, Spercheidae, Hydrophilidae (Coleoptera). Onychium, 14: 109-130"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1219107",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1219108"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1219107"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Contributo alla conoscenza dei Coleotteri degli ambienti acquatici della Toscana (Italia Centrale). VI. Aggiornamenti: Sphaeriusidae, Helophoridae, Georissidae, Hydrochidae, Spercheidae, Hydrophilidae (Coleoptera)"
                },
                "owners": [
                    29896
                ],
                "revision": 6,
                "stats": {
                    "downloads": 9,
                    "unique_downloads": 9,
                    "unique_views": 23,
                    "version_downloads": 9,
                    "version_unique_downloads": 9,
                    "version_unique_views": 23,
                    "version_views": 25,
                    "version_volume": 3865761,
                    "views": 25,
                    "volume": 3865761
                },
                "updated": "2020-01-20T13:33:54.484767+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1218954",
                "conceptrecid": "1218954",
                "created": "2018-04-20T08:27:25.744235+00:00",
                "doi": "10.5281/zenodo.1218955",
                "files": [
                    {
                        "bucket": "87f5fbf3-5b5a-46fd-bea2-9497dd40de97",
                        "checksum": "md5:1063312be0bb2aaac671fcee389a5fc2",
                        "key": "Letardi_Badano_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/87f5fbf3-5b5a-46fd-bea2-9497dd40de97/Letardi_Badano_2018_Onychium14.pdf"
                        },
                        "size": 310914,
                        "type": "pdf"
                    }
                ],
                "id": 1218955,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1218955.svg",
                    "bucket": "https://zenodo.org/api/files/87f5fbf3-5b5a-46fd-bea2-9497dd40de97",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1218954.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1218954",
                    "doi": "https://doi.org/10.5281/zenodo.1218955",
                    "html": "https://zenodo.org/record/1218955",
                    "latest": "https://zenodo.org/api/records/1218955",
                    "latest_html": "https://zenodo.org/record/1218955",
                    "self": "https://zenodo.org/api/records/1218955"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "ENEA, C.R. Casaccia, Rome, Italia",
                            "name": "Letardi, Agostino"
                        },
                        {
                            "affiliation": "University of Genova, Genoa, Italy",
                            "name": "Badano, Davide"
                        }
                    ],
                    "description": "<p><em>New records of lacewings of Montecristo Island (Insecta: Neuroptera).</em> We report the results of entomological surveys done in 2011 and 2012. We identified 14 Neuroptera species, 7 of which are new records for the island and, among them, 4 are new for the Tuscan archipelago as a whole: <em>Coniopteryx</em> sp. (Coniopterygidae); <em>Wesmaelius subnebulosus</em> (Stephens, 1836) (Hemerobiidae); <em>Micromus angulatus</em> (Stephens, 1836) (Hemerobiidae); <em>Cunctochrysa</em> sp. pr. <em>albolineata</em> (Killington, 1935) (Chrysopidae); <em>Pseudomallada clathratus </em>(Schneider, 1845) (Chrysopidae); <em>P. </em>sp. pr. <em>picteti</em> (McLachlan, 1865) (Chrysopidae); <em>Myrmeleon gerlindae</em> H&ouml;lzel, 1974 (Myrmeleontidae).</p>",
                    "doi": "10.5281/zenodo.1218955",
                    "journal": {
                        "pages": "93-97",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Montecristo Island",
                        "Tuscan Archipelago",
                        "faunal composition",
                        "biogeography"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Letardi, Agostino & Badano, Davide (2018) Nuovi dati sui Neurotteri dell\'Isola di Montecristo (Insecta: Neuroptera). Onychium, 14: 93-97"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1218954",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1218955"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1218954"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Nuovi dati sui Neurotteri dell\'Isola di Montecristo (Insecta: Neuroptera)"
                },
                "owners": [
                    29896
                ],
                "revision": 4,
                "stats": {
                    "downloads": 11,
                    "unique_downloads": 11,
                    "unique_views": 21,
                    "version_downloads": 11,
                    "version_unique_downloads": 11,
                    "version_unique_views": 21,
                    "version_views": 21,
                    "version_volume": 3420054,
                    "views": 21,
                    "volume": 3420054
                },
                "updated": "2020-01-20T14:45:06.259831+00:00"
            },
            {
                "conceptrecid": "794999",
                "created": "2017-04-20T10:19:26.609954+00:00",
                "doi": "10.5281/zenodo.495568",
                "files": [
                    {
                        "bucket": "49bbda82-38ea-4e9b-8289-56de65aae68a",
                        "checksum": "md5:8a5f111461199c853e0d5aa805c4c9cd",
                        "key": "Biondi_D\'Alessandro_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/49bbda82-38ea-4e9b-8289-56de65aae68a/Biondi_D%27Alessandro_2017_Onychium13.pdf"
                        },
                        "size": 2370774,
                        "type": "pdf"
                    }
                ],
                "id": 495568,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.495568.svg",
                    "bucket": "https://zenodo.org/api/files/49bbda82-38ea-4e9b-8289-56de65aae68a",
                    "doi": "https://doi.org/10.5281/zenodo.495568",
                    "html": "https://zenodo.org/record/495568",
                    "latest": "https://zenodo.org/api/records/495568",
                    "latest_html": "https://zenodo.org/record/495568",
                    "self": "https://zenodo.org/api/records/495568"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Department of Health, Life and Environmental Sciences, University of L\'Aquila, L\'Aquila, Italy",
                            "name": "Biondi, Maurizio"
                        },
                        {
                            "affiliation": "Department of Health, Life and Environmental Sciences, University of L\'Aquila, L\'Aquila, Italy",
                            "name": "D\'Alessandro, Paola"
                        }
                    ],
                    "description": "<p><em>Psylliodes urbaniae</em> sp. nov. from Central Apennines (Italy) is described. Male genitalia and some biometric characters allow to distinguish between the new species and the very similar <em>P. napi</em> (Fabricius, 1792). Due to its limited distribution in mountain areas, its monophagy, and its subapterism, we propose possible processes leading to its differentiation.</p>",
                    "doi": "10.5281/zenodo.495568",
                    "journal": {
                        "pages": "121-130",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Chrysomelidae",
                        "Psylliodes",
                        "new species",
                        "Apennines",
                        "endemism",
                        "wing reduction"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Biondi, Maurizio & D\'Alessandro Paola (2017). Psylliodes urbaniae: a new species from Central Apennines  (Coleoptera: Chrysomelidae: Galerucinae: Alticini). Onychium, 13: 121-130"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:BA8B702B-3615-4D76-BE8B-FA169067D34D",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "495568"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "794999"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Psylliodes urbaniae: a new species from Central Apennines  (Coleoptera: Chrysomelidae: Galerucinae: Alticini)"
                },
                "owners": [
                    29896
                ],
                "revision": 6,
                "stats": {
                    "downloads": 9,
                    "unique_downloads": 9,
                    "unique_views": 18,
                    "version_downloads": 9,
                    "version_unique_downloads": 9,
                    "version_unique_views": 18,
                    "version_views": 18,
                    "version_volume": 21336966,
                    "views": 18,
                    "volume": 21336966
                },
                "updated": "2020-01-20T13:39:27.195944+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1219117",
                "conceptrecid": "1219117",
                "created": "2018-04-20T08:30:53.933635+00:00",
                "doi": "10.5281/zenodo.1219118",
                "files": [
                    {
                        "bucket": "64c5d514-3d39-44a5-a1d9-28a7685583d4",
                        "checksum": "md5:57de608c59b6b4669d5a7277d48087bb",
                        "key": "Bartolozzi_Cianfanelli_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/64c5d514-3d39-44a5-a1d9-28a7685583d4/Bartolozzi_Cianfanelli_2018_Onychium14.pdf"
                        },
                        "size": 913452,
                        "type": "pdf"
                    }
                ],
                "id": 1219118,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219118.svg",
                    "bucket": "https://zenodo.org/api/files/64c5d514-3d39-44a5-a1d9-28a7685583d4",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219117.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1219117",
                    "doi": "https://doi.org/10.5281/zenodo.1219118",
                    "html": "https://zenodo.org/record/1219118",
                    "latest": "https://zenodo.org/api/records/1219118",
                    "latest_html": "https://zenodo.org/record/1219118",
                    "self": "https://zenodo.org/api/records/1219118"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Bartolozzi, Luca"
                        },
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Cianfanelli, Simone"
                        }
                    ],
                    "description": "<p>A locality record of <em>Platycerus caprea</em> (De Geer, 1774) from Northern Albania is given; it is the first verified one for the country, due to the existing confusion concerning the old records of the two closely related species of the stag beetles <em>P. caprea</em> and <em>P. caraboides caraboides</em> (Linnaeus, 1758). A locality record for <em>Dorcus parallelipipedus</em> (Linnaeus, 1758) is also given.</p>",
                    "doi": "10.5281/zenodo.1219118",
                    "journal": {
                        "pages": "131-134",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Albania",
                        "Lucanidae",
                        "Platycerus",
                        "Dorcus",
                        "new record"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Bartolozzi, Luca & Cianfanelli, Simone (2018) New record of Platycerus caprea (De Geer, 1774) from Albania (Coleoptera: Lucanidae). Onychium, 14: 131-134"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1219117",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1219118"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1219117"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "New record of Platycerus caprea (De Geer, 1774) from Albania (Coleoptera: Lucanidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 4,
                "stats": {
                    "downloads": 18,
                    "unique_downloads": 18,
                    "unique_views": 29,
                    "version_downloads": 18,
                    "version_unique_downloads": 18,
                    "version_unique_views": 29,
                    "version_views": 30,
                    "version_volume": 16442136,
                    "views": 30,
                    "volume": 16442136
                },
                "updated": "2020-01-20T14:27:58.489755+00:00"
            },
            {
                "conceptrecid": "796127",
                "created": "2017-04-20T09:52:50.478863+00:00",
                "doi": "10.5281/zenodo.546380",
                "files": [
                    {
                        "bucket": "d4ca3652-8acf-43ee-88fa-c6f44a045ed6",
                        "checksum": "md5:2e91296571c338847244e916c24f3d31",
                        "key": "Tassi_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/d4ca3652-8acf-43ee-88fa-c6f44a045ed6/Tassi_2017_Onychium13.pdf"
                        },
                        "size": 365602,
                        "type": "pdf"
                    }
                ],
                "id": 546380,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.546380.svg",
                    "bucket": "https://zenodo.org/api/files/d4ca3652-8acf-43ee-88fa-c6f44a045ed6",
                    "doi": "https://doi.org/10.5281/zenodo.546380",
                    "html": "https://zenodo.org/record/546380",
                    "latest": "https://zenodo.org/api/records/546380",
                    "latest_html": "https://zenodo.org/record/546380",
                    "self": "https://zenodo.org/api/records/546380"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Centro Studi Ecologici Appenninici, Campagnatico (Grosseto), Italy",
                            "name": "Tassi, Franco"
                        }
                    ],
                    "description": "<p>Obituary of the entomologist Giuseppe Ferro (1934-2013).</p>",
                    "doi": "10.5281/zenodo.546380",
                    "journal": {
                        "pages": "159-161",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Tassi, Franco (2017). Commemorazione di Giuseppe Ferro (1934-2013). Onychium, 13: 159-161"
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "546380"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "796127"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Commemorazione di Giuseppe Ferro"
                },
                "owners": [
                    29896
                ],
                "revision": 6,
                "stats": {
                    "downloads": 10,
                    "unique_downloads": 10,
                    "unique_views": 16,
                    "version_downloads": 10,
                    "version_unique_downloads": 10,
                    "version_unique_views": 16,
                    "version_views": 16,
                    "version_volume": 3656020,
                    "views": 16,
                    "volume": 3656020
                },
                "updated": "2020-01-20T13:34:42.692523+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1219091",
                "conceptrecid": "1219091",
                "created": "2018-04-20T08:29:09.808128+00:00",
                "doi": "10.5281/zenodo.1219092",
                "files": [
                    {
                        "bucket": "3761f882-e0db-4d41-ba72-02c5085bf395",
                        "checksum": "md5:96da604e399fc5f28daeeb3fc5b8d357",
                        "key": "Terzani_Insom_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/3761f882-e0db-4d41-ba72-02c5085bf395/Terzani_Insom_2018_Onychium14.pdf"
                        },
                        "size": 299546,
                        "type": "pdf"
                    }
                ],
                "id": 1219092,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219092.svg",
                    "bucket": "https://zenodo.org/api/files/3761f882-e0db-4d41-ba72-02c5085bf395",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219091.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1219091",
                    "doi": "https://doi.org/10.5281/zenodo.1219092",
                    "html": "https://zenodo.org/record/1219092",
                    "latest": "https://zenodo.org/api/records/1219092",
                    "latest_html": "https://zenodo.org/record/1219092",
                    "self": "https://zenodo.org/api/records/1219092"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Terzani, Fabio"
                        },
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Insom, Emilio"
                        }
                    ],
                    "description": "<p><em>New chorological data of </em>Osmylus fulvicephalus<em> (Scopoli, 1763) in Italy (Neuroptera: Osmylidae).</em> New chorological data of <em>Osmylus fulvicephalus</em> (Scopoli, 1763) are provided for some Italian regions, in particular for Tuscany. This species is firstly recorded for Basilicata and confirmed for Molise and Calabria.</p>",
                    "doi": "10.5281/zenodo.1219092",
                    "journal": {
                        "pages": "105-107",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Neuroptera",
                        "Osmylidae",
                        "Osmylus fulvicephalus",
                        "Italy",
                        "Tuscany",
                        "chorological data"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Terzani, Fabio & Insom, Emilio (2018) Osmylus fulvicephalus (Scopoli, 1763): nuovi dati corologici in Italia (Neuroptera: Osmylidae). Onychium, 14: 105-107"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1219091",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1219092"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1219091"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Osmylus fulvicephalus (Scopoli, 1763): nuovi dati corologici in Italia (Neuroptera: Osmylidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 4,
                "stats": {
                    "downloads": 5,
                    "unique_downloads": 5,
                    "unique_views": 13,
                    "version_downloads": 5,
                    "version_unique_downloads": 5,
                    "version_unique_views": 13,
                    "version_views": 13,
                    "version_volume": 1497730,
                    "views": 13,
                    "volume": 1497730
                },
                "updated": "2020-01-20T14:44:24.589211+00:00"
            },
            {
                "conceptrecid": "796368",
                "created": "2017-04-20T09:38:38.477997+00:00",
                "doi": "10.5281/zenodo.546330",
                "files": [
                    {
                        "bucket": "a69d1dbb-a91a-495a-b71c-c73a1836eb44",
                        "checksum": "md5:f7d8b4a655c48d666d4a3ad08e01a489",
                        "key": "Rossi_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/a69d1dbb-a91a-495a-b71c-c73a1836eb44/Rossi_2017_Onychium13.pdf"
                        },
                        "size": 564298,
                        "type": "pdf"
                    }
                ],
                "id": 546330,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.546330.svg",
                    "bucket": "https://zenodo.org/api/files/a69d1dbb-a91a-495a-b71c-c73a1836eb44",
                    "doi": "https://doi.org/10.5281/zenodo.546330",
                    "html": "https://zenodo.org/record/546330",
                    "latest": "https://zenodo.org/api/records/546330",
                    "latest_html": "https://zenodo.org/record/546330",
                    "self": "https://zenodo.org/api/records/546330"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Gruppo Entomologico Toscano, c/o Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Rossi, Andrea"
                        }
                    ],
                    "description": "<p>The presence of the genus <em>Buthus</em> Leach, 1815 in the basin countries of the Gulf of Guinea was reported almost seventy years ago, but the precise identity of the species remained for a long time unknown. Up to now only three species of the genus <em>Buthus</em> are recorded in such region: <em>Buthus prudenti</em> Lourenço <em>&amp;</em> Leguin, 2012 from Cameroon, <em>Buthus elizabethae</em> Lourenço, 2005 from Guinea (but also present in Senegal) and <em>Buthus elhennawyi</em> Lourenço, 2005 from Niger (but also present in Senegal). A fourth species, <em>Buthus danyii </em>sp. n., is now described from Ghana.</p>",
                    "doi": "10.5281/zenodo.546330",
                    "journal": {
                        "pages": "9-15",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Scorpiones",
                        "Gulf of Guinea",
                        "Ghana",
                        "Buthus danyii"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Rossi, Andrea (2017). The genus Buthus Leach, 1815 in the basin countries of the Gulf of Guinea with the description of a new species from Ghana (Scorpiones: Buthidae). Onychium, 13: 9-15"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:FE6A1D4F-95A0-4D20-B74D-AE5DE260A1D7",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "546330"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "796368"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "The genus Buthus Leach, 1815 in the basin countries of the Gulf of Guinea with the description of a new species from Ghana (Scorpiones: Buthidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 6,
                "stats": {
                    "downloads": 24,
                    "unique_downloads": 24,
                    "unique_views": 78,
                    "version_downloads": 24,
                    "version_unique_downloads": 24,
                    "version_unique_views": 78,
                    "version_views": 78,
                    "version_volume": 13543152,
                    "views": 78,
                    "volume": 13543152
                },
                "updated": "2020-01-20T17:24:55.254784+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1219089",
                "conceptrecid": "1219089",
                "created": "2018-04-20T08:28:15.427725+00:00",
                "doi": "10.5281/zenodo.1219090",
                "files": [
                    {
                        "bucket": "54c06f6f-f01d-497e-9d8a-45674439da03",
                        "checksum": "md5:e029ea7d2fb50c5251f48f64e3d00799",
                        "key": "Letardi_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/54c06f6f-f01d-497e-9d8a-45674439da03/Letardi_2018_Onychium14.pdf"
                        },
                        "size": 307644,
                        "type": "pdf"
                    }
                ],
                "id": 1219090,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219090.svg",
                    "bucket": "https://zenodo.org/api/files/54c06f6f-f01d-497e-9d8a-45674439da03",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219089.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1219089",
                    "doi": "https://doi.org/10.5281/zenodo.1219090",
                    "html": "https://zenodo.org/record/1219090",
                    "latest": "https://zenodo.org/api/records/1219090",
                    "latest_html": "https://zenodo.org/record/1219090",
                    "self": "https://zenodo.org/api/records/1219090"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "ENEA, C.R. Casaccia, Rome, Italia",
                            "name": "Letardi, Agostino"
                        }
                    ],
                    "description": "<p>Contribution to the knowledge of the Italian Neuropterida through Bioblitz events (Insecta: Raphidioptera, Neuroptera). A list of faunal data of Neuropterida collected during bioblitz activities in Central Italy during the last four years are presented. <em>Fibla maclachlani </em>(Albarda, 1891), <em>Chrysoperla pallida </em>Henry et al., 2002, <em>Sympherobius pellucidus </em>(Walker, 1853), and <em>Coniopteryx arcuata</em> Kis, 1965 are recorded for the first time in Tuscany; <em>Sisyra terminalis</em> Curtis, 1854 is recorded for the first time in Lazio and Central Italy; <em>Wesmaelius nervosus</em> (Fabricius, 1793) is recorded for the first time in Abruzzo; <em>Ornatoraphidia flavilabris</em> (Costa, 1855), <em>Chrysoperla lucasina</em> (Lacroix, 1912), <em>Sympherobius pellucidus</em> (Walker, 1853) are recorded for the first time in Molise.</p>",
                    "doi": "10.5281/zenodo.1219090",
                    "journal": {
                        "pages": "99-104",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Bioblitz",
                        "citizen science",
                        "Neuropterida",
                        "Central Italy"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Letardi, Agostino (2018) Contributo alla conoscenza dei Neurotteroidei italiani attraverso eventi Bioblitz (Insecta: Raphidioptera, Neuroptera). Onychium, 14: 99-104"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1219089",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1219090"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1219089"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Contributo alla conoscenza dei Neurotteroidei italiani attraverso eventi Bioblitz (Insecta: Raphidioptera, Neuroptera)"
                },
                "owners": [
                    29896
                ],
                "revision": 4,
                "stats": {
                    "downloads": 19,
                    "unique_downloads": 18,
                    "unique_views": 23,
                    "version_downloads": 19,
                    "version_unique_downloads": 18,
                    "version_unique_views": 23,
                    "version_views": 24,
                    "version_volume": 5845236,
                    "views": 24,
                    "volume": 5845236
                },
                "updated": "2020-01-20T14:20:29.331991+00:00"
            },
            {
                "conceptrecid": "796233",
                "created": "2017-04-20T09:25:27.014410+00:00",
                "doi": "10.5281/zenodo.546331",
                "files": [
                    {
                        "bucket": "2374d40c-f674-4748-a4aa-09ac72884017",
                        "checksum": "md5:9bb187483c4f1966cd5c303079d74e77",
                        "key": "Lourenço_Rossi_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/2374d40c-f674-4748-a4aa-09ac72884017/Louren%C3%A7o_Rossi_2017_Onychium13.pdf"
                        },
                        "size": 2265997,
                        "type": "pdf"
                    }
                ],
                "id": 546331,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.546331.svg",
                    "bucket": "https://zenodo.org/api/files/2374d40c-f674-4748-a4aa-09ac72884017",
                    "doi": "https://doi.org/10.5281/zenodo.546331",
                    "html": "https://zenodo.org/record/546331",
                    "latest": "https://zenodo.org/api/records/546331",
                    "latest_html": "https://zenodo.org/record/546331",
                    "self": "https://zenodo.org/api/records/546331"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "National Museum of Natural History, Sorbonne University,  Institute of Systematic, Evolution, Biodiversity, Paris, France",
                            "name": "Lourenço, Wilson R."
                        },
                        {
                            "affiliation": "Gruppo Entomologico Toscano, c/o Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Rossi, Andrea"
                        }
                    ],
                    "description": "<p>A new species, <em>Babycurus</em> <em>brignolii</em> sp. n., is described from North Savannah formations in Central African Republic. This is the second record of a <em>Babycurus</em> species from Central African Republic. The new species is characterized by a small total body size, with respect to other species within the genus, and a general yellow to yellow-testaceous coloration with some diffuse fuscosity. This species, a possible endemic element from the savannah formations of Northern Central African Republic, provides further evidence regarding the unsuspected scorpion richness of this region.</p>",
                    "doi": "10.5281/zenodo.546331",
                    "journal": {
                        "pages": "3-8",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Scorpion",
                        "Babycurus",
                        "new species",
                        "sub-Saharan",
                        "Savannah formations",
                        "Africa",
                        "Central African Republic"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Lourenço, Wilson R. & Rossi, Andrea (2017). A new species of Babycurus Karsch, 1886 from dry Savannahs in Central African Republic (Scorpiones: Buthidae). Onychium, 13: 3-8"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:82EC812D-AE72-4008-B583-0936E06F1460",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "546331"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "796233"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new species of Babycurus Karsch, 1886 from dry Savannahs in Central African Republic (Scorpiones: Buthidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 32,
                    "unique_downloads": 32,
                    "unique_views": 71,
                    "version_downloads": 32,
                    "version_unique_downloads": 32,
                    "version_unique_views": 71,
                    "version_views": 74,
                    "version_volume": 72511904,
                    "views": 74,
                    "volume": 72511904
                },
                "updated": "2020-01-20T14:57:56.537382+00:00"
            },
            {
                "conceptrecid": "797007",
                "created": "2017-04-20T10:15:07.851243+00:00",
                "doi": "10.5281/zenodo.439728",
                "files": [
                    {
                        "bucket": "84efeb8b-8b0c-44ba-961a-c51cb7fe0cb1",
                        "checksum": "md5:2eabcc4199b64944d4eab9cdf942e859",
                        "key": "Bordoni_2017a_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/84efeb8b-8b0c-44ba-961a-c51cb7fe0cb1/Bordoni_2017a_Onychium13.pdf"
                        },
                        "size": 1289081,
                        "type": "pdf"
                    }
                ],
                "id": 439728,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.439728.svg",
                    "bucket": "https://zenodo.org/api/files/84efeb8b-8b0c-44ba-961a-c51cb7fe0cb1",
                    "doi": "https://doi.org/10.5281/zenodo.439728",
                    "html": "https://zenodo.org/record/439728",
                    "latest": "https://zenodo.org/api/records/439728",
                    "latest_html": "https://zenodo.org/record/439728",
                    "self": "https://zenodo.org/api/records/439728"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Bordoni, Arnaldo"
                        }
                    ],
                    "description": "<p>Species of Xantholinini from the Palaearctic Region are listed. Some of these are common but the records expand the known distribution of the taxa; other species are less common and new records for the named countries are given: <em>Gauropterus bucharicus </em>Bernhauer, 1905 (Turkmenistan), <em>Nudobius umbratus </em>(Motschulsky, 1869) (Czechia), <em>Gyrohypnus ochripennis </em>(Eppelsheim, 1892) (Central Russia), <em>Xantholinus elegans</em> (Olivier, 1795) (Aosta Valley, Italy), <em>Xantholinus gridellii</em> Coiffait, 1956 (Jordan), and <em>Phacophallus flavipennis </em>(Kraatz, 1859) (Pakistan: see Distribution of the species); lectotype and paralectotypes are designated for <em>Xantholinus laniger</em> Fauvel, 1899. A new species (<em>Xantholinus chalusianus </em>sp. n.) from Iran is described and figured. Furthermore the following nomenclature act is made: <em>Xantholinus postfactus</em> nom. nov. for <em>X. apterus</em> Bordoni, 2016, nom. preocc. by <em>X. apterus</em> Bernhauer, 1939.</p>",
                    "doi": "10.5281/zenodo.439728",
                    "journal": {
                        "pages": "107-115",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Coleoptera",
                        "Staphylinidae",
                        "Xantholinini",
                        "geonemical data",
                        "new records",
                        "new species",
                        "lectotype",
                        "Europe",
                        "Central Asia"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Bordoni, Arnaldo (2017). New data on the Palaearctic Xantholinini. 12. New species, new designations and new records (Coleoptera: Staphylinidae). 275th contribution to the knowledge of the Staphylinidae. Onychium, 13: 107-115"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:6B9D2F9A-452C-4E37-85F7-ACD46791ABBA",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "439728"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "797007"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "New data on the Palaearctic Xantholinini. 12. New species, new designations and new records (Coleoptera: Staphylinidae). 275th contribution to the knowledge of the Staphylinidae"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 33,
                    "unique_downloads": 32,
                    "unique_views": 30,
                    "version_downloads": 33,
                    "version_unique_downloads": 32,
                    "version_unique_views": 30,
                    "version_views": 31,
                    "version_volume": 42539673,
                    "views": 31,
                    "volume": 42539673
                },
                "updated": "2020-01-20T14:35:00.469058+00:00"
            },
            {
                "conceptrecid": "796438",
                "created": "2017-04-20T09:55:37.448751+00:00",
                "doi": "10.5281/zenodo.546321",
                "files": [
                    {
                        "bucket": "eb4c65d1-5b4a-4274-a182-447e56003867",
                        "checksum": "md5:b469f04064d283e2c3f871538e9f49a3",
                        "key": "DalPos_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/eb4c65d1-5b4a-4274-a182-447e56003867/DalPos_2017_Onychium13.pdf"
                        },
                        "size": 986848,
                        "type": "pdf"
                    }
                ],
                "id": 546321,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.546321.svg",
                    "bucket": "https://zenodo.org/api/files/eb4c65d1-5b4a-4274-a182-447e56003867",
                    "doi": "https://doi.org/10.5281/zenodo.546321",
                    "html": "https://zenodo.org/record/546321",
                    "latest": "https://zenodo.org/api/records/546321",
                    "latest_html": "https://zenodo.org/record/546321",
                    "self": "https://zenodo.org/api/records/546321"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "c/o Natural History Museum of Venice, Venice, Italy",
                            "name": "Dal Pos, Davide"
                        }
                    ],
                    "description": "<p><em>Zombrus bicolor </em>(Enderlein, 1912)<em> </em>is recorded from new and further sites in Tuscany, far from the previous and only record, suggesting its establishment in Italy.</p>",
                    "doi": "10.5281/zenodo.546321",
                    "journal": {
                        "pages": "39-43",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "alien species",
                        "Braconidae",
                        "parasitoid",
                        "distribution"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Dal Pos, Davide (2017). Zombrus bicolor (Enderlein, 1912): evidence of its establishment in Italy (Hymenoptera: Braconidae: Doryctinae). Onychium, 13: 39-43"
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "546321"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "796438"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Zombrus bicolor (Enderlein, 1912): evidence of its establishment in Italy (Hymenoptera: Braconidae: Doryctinae)"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 12,
                    "unique_views": 22,
                    "version_downloads": 12,
                    "version_unique_downloads": 12,
                    "version_unique_views": 22,
                    "version_views": 22,
                    "version_volume": 11842176,
                    "views": 22,
                    "volume": 11842176
                },
                "updated": "2020-01-20T14:03:52.060137+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1218892",
                "conceptrecid": "1218892",
                "created": "2018-04-20T08:17:31.236999+00:00",
                "doi": "10.5281/zenodo.1218893",
                "files": [
                    {
                        "bucket": "c92c5bb7-a2d4-43cc-b710-2357be8bef32",
                        "checksum": "md5:1e0faf67e909f6c976405b7630e6efd3",
                        "key": "Lourenço_Rossi_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/c92c5bb7-a2d4-43cc-b710-2357be8bef32/Louren%C3%A7o_Rossi_2018_Onychium14.pdf"
                        },
                        "size": 1791446,
                        "type": "pdf"
                    }
                ],
                "id": 1218893,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1218893.svg",
                    "bucket": "https://zenodo.org/api/files/c92c5bb7-a2d4-43cc-b710-2357be8bef32",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1218892.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1218892",
                    "doi": "https://doi.org/10.5281/zenodo.1218893",
                    "html": "https://zenodo.org/record/1218893",
                    "latest": "https://zenodo.org/api/records/1218893",
                    "latest_html": "https://zenodo.org/record/1218893",
                    "self": "https://zenodo.org/api/records/1218893"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "National Museum of Natural History, Sorbonne University, Institute of Systematic, Evolution, Biodiversiy,  Paris, France",
                            "name": "Lourenço, Wilson R."
                        },
                        {
                            "affiliation": "Gruppo Entomologico Toscano, c/o Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Rossi, Andrea"
                        }
                    ],
                    "description": "<p>The <em>Compsobuthus </em>population from the A&iuml;r Massif in the North of Niger, previously recorded by Vachon as <em>Compsobuthus werneri </em>(Birula, 1908), is now confirmed as a new species. The new species is described based on one pre-adult female specimen, collected several decades ago and located in the collections of the National Museum of Natural History, Paris. This specimen was apparently examined by Vachon but does not correspond to any of the specimens cited by him as <em>C. werneri</em>. The new species certainly corresponds to an endemic element of the A&iuml;r Massif, as other scorpion species previously reported.</p>",
                    "doi": "10.5281/zenodo.1218893",
                    "journal": {
                        "pages": "3-8",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Scorpion",
                        "Buthidae",
                        "Compsobuthus",
                        "new species",
                        "Aïr Massif",
                        "Niger"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Lourenço, Wilson R. & Rossi, Andrea (2018) A new species of Compsobuthus Vachon, 1949 from Aïr Massif, Niger (Scorpiones: Buthidae). Onychium, 14: 3-8"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:0A4305DD-4366-40F8-8521-1242371A114F",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        },
                        {
                            "identifier": "10.5281/zenodo.1218892",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1218893"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1218892"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new species of Compsobuthus Vachon, 1949 from Aïr Massif, Niger (Scorpiones: Buthidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 4,
                "stats": {
                    "downloads": 29,
                    "unique_downloads": 27,
                    "unique_views": 45,
                    "version_downloads": 29,
                    "version_unique_downloads": 27,
                    "version_unique_views": 45,
                    "version_views": 47,
                    "version_volume": 51951934,
                    "views": 47,
                    "volume": 51951934
                },
                "updated": "2020-01-20T15:00:16.917307+00:00"
            },
            {
                "conceptrecid": "796079",
                "created": "2017-04-20T10:22:39.568269+00:00",
                "doi": "10.5281/zenodo.546373",
                "files": [
                    {
                        "bucket": "220a45cb-c1d4-45a9-a72e-907cc7e16aab",
                        "checksum": "md5:72afc196daee0d4cd845a70be36adf29",
                        "key": "Fabiano_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/220a45cb-c1d4-45a9-a72e-907cc7e16aab/Fabiano_2017_Onychium13.pdf"
                        },
                        "size": 2077093,
                        "type": "pdf"
                    }
                ],
                "id": 546373,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.546373.svg",
                    "bucket": "https://zenodo.org/api/files/220a45cb-c1d4-45a9-a72e-907cc7e16aab",
                    "doi": "https://doi.org/10.5281/zenodo.546373",
                    "html": "https://zenodo.org/record/546373",
                    "latest": "https://zenodo.org/api/records/546373",
                    "latest_html": "https://zenodo.org/record/546373",
                    "self": "https://zenodo.org/api/records/546373"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Fabiano, Filippo"
                        }
                    ],
                    "description": "<p><em>New data on the lepidopteran fauna of Montecristo Island (Lepidoptera)</em>. In this paper the results of a lepidopterological survey done at the end of May and the beginning of June 2016 are reported. The author collected 65 Lepidoptera species, 26 of which resulted to be new records for the island and, among them, four new for the Tuscan archipelago as a whole: <em>Scotomerodes fuscolimbalis</em> (Ragonot, 1887) (Pyralidae); <em>Eilema pygmaeola</em> (Doubleday, 1847) (Erebidae); <em>Phyllophila obliterata</em> (Rambur, 1833) and<em> Sesamia nonagrioides</em> (Lefèbvre, 1827) (Noctuidae). The other new records for the island are: <em>Lozotaenia mabilliana </em>(Ragonot, 1875) (Tortricidae); <em>Oncocera semirubella</em> (Scopoli, 1763), <em>Acrobasis porphyrella </em>(Duponchel, 1836) and <em>Hypsopygia glaucinalis </em>(Linnaeus, 1758) (Pyralidae); <em>Loxostege sticticalis</em> (Linnaeus, 1761), <em>Pyrausta despicata</em> (Scopoli, 1763), <em>Udea ferrugalis</em> (Hübner, [1796]), <em>Diasemiopsis ramburialis</em> (Duponchel, 1834), <em>Dolicharthria bruguieralis</em> (Duponchel, 1833) and <em>Nomophila noctuella</em> ([Denis &amp; Schiffermüller], 1775) (Crambidae); <em>Dendrolimus pini</em> (Linnaeus, 1758) (Lasiocampidae); <em>Acherontia atropos</em> (Linnaeus, 1758),<em> Deilephila elpenor</em> (Linnaeus, 1758) and <em>Hyles dahlii</em> (Geyer, 1827) (Sphingidae);<em> Watsonalla uncinula </em>(Borkhausen, 1790) (Drepanidae);<em> Costaconvexa polygrammata</em> (Borkhausen, 1794) (Geometridae); <em>Hypena obsitalis </em>(Hübner, [1813]), <em>Nodaria nodosalis</em> (Herrich-Schäffer, [1851]),<em> Euproctis chrysorrhoea</em> (Linnaeus, 1758) and<em> Dysauxes famula</em> (Freyer, 1836) (Erebidae); <em>Mythimna vitellina </em>(Hübner, [1808]) and <em>Mythimna unipuncta </em>(Haworth, [1809]) (Noctuidae).</p>",
                    "doi": "10.5281/zenodo.546373",
                    "journal": {
                        "pages": "143-158",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Montecristo Island",
                        "Tuscan Archipelago",
                        "faunistic",
                        "biogeography"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Fabiano, Filippo (2017). Nuovi dati sulla Lepidotterofauna dell\'Isola di Montecristo (Lepidoptera). Onychium, 13: 143-158"
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "546373"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "796079"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Nuovi dati sulla Lepidotterofauna dell\'Isola di Montecristo (Lepidoptera)"
                },
                "owners": [
                    29896
                ],
                "revision": 6,
                "stats": {
                    "downloads": 27,
                    "unique_downloads": 23,
                    "unique_views": 76,
                    "version_downloads": 27,
                    "version_unique_downloads": 23,
                    "version_unique_views": 76,
                    "version_views": 77,
                    "version_volume": 56081511,
                    "views": 77,
                    "volume": 56081511
                },
                "updated": "2020-01-20T14:49:52.768163+00:00"
            },
            {
                "conceptrecid": "795309",
                "created": "2017-04-20T09:48:23.582193+00:00",
                "doi": "10.5281/zenodo.495564",
                "files": [
                    {
                        "bucket": "7a28ac9d-040f-4f34-8652-23bac9181d6c",
                        "checksum": "md5:25da6ad57d575c752b74213110ee5e02",
                        "key": "Bramanti_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/7a28ac9d-040f-4f34-8652-23bac9181d6c/Bramanti_2017_Onychium13.pdf"
                        },
                        "size": 1071082,
                        "type": "pdf"
                    }
                ],
                "id": 495564,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.495564.svg",
                    "bucket": "https://zenodo.org/api/files/7a28ac9d-040f-4f34-8652-23bac9181d6c",
                    "doi": "https://doi.org/10.5281/zenodo.495564",
                    "html": "https://zenodo.org/record/495564",
                    "latest": "https://zenodo.org/api/records/495564",
                    "latest_html": "https://zenodo.org/record/495564",
                    "self": "https://zenodo.org/api/records/495564"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Pietrasanta (Lucca), Italy",
                            "name": "Bramanti, Alessandro"
                        }
                    ],
                    "description": "<p><em>Faunal notes on </em>Bicolorana bicolor bicolor<em> </em><em>(Philippi, 1830) and </em>Euthystira brachyptera<em> (Ocskay, 1826) in Italy (Orthoptera). </em>The presence of <em>Bicolorana bicolor bicolor</em> and<em> Euthystira brachyptera </em>is recorded for first time in the Apuan Alps. Another station of <em>E. brachyptera</em> was found in the Tusco-Emilian Appennines and these two findings represent the first presence for Tuscany. Finally an unpublished record for <em>B. bicolor bicolor</em> in the Campania region represents a new southern limit for the species in the Italian territory.</p>",
                    "doi": "10.5281/zenodo.495564",
                    "journal": {
                        "pages": "31-34",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Tettigoniidae",
                        "Acrididae",
                        "new record",
                        "faunistics",
                        "Tuscany",
                        "Campania",
                        "Apuan Alps",
                        "Italy"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Bramanti, Alessandro (2017). Note faunistiche su Bicolorana bicolor bicolor (Philippi, 1830) ed Euthystira brachyptera (Ocskay, 1826) in Italia (Orthoptera). Onychium, 13: 31-34"
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "495564"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "795309"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Note faunistiche su Bicolorana bicolor bicolor (Philippi, 1830) ed Euthystira brachyptera (Ocskay, 1826) in Italia (Orthoptera)"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 11,
                    "unique_downloads": 11,
                    "unique_views": 15,
                    "version_downloads": 11,
                    "version_unique_downloads": 11,
                    "version_unique_views": 15,
                    "version_views": 15,
                    "version_volume": 11781902,
                    "views": 15,
                    "volume": 11781902
                },
                "updated": "2020-01-20T14:46:45.811325+00:00"
            },
            {
                "conceptrecid": "796192",
                "created": "2017-04-20T09:42:49.667083+00:00",
                "doi": "10.5281/zenodo.546371",
                "files": [
                    {
                        "bucket": "b29bf230-71c9-428e-91eb-5a4a5d2936af",
                        "checksum": "md5:11ad292215e905b5a0a53d6455b73429",
                        "key": "Lourenço_Ythier_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/b29bf230-71c9-428e-91eb-5a4a5d2936af/Louren%C3%A7o_Ythier_2017_Onychium13.pdf"
                        },
                        "size": 2062640,
                        "type": "pdf"
                    }
                ],
                "id": 546371,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.546371.svg",
                    "bucket": "https://zenodo.org/api/files/b29bf230-71c9-428e-91eb-5a4a5d2936af",
                    "doi": "https://doi.org/10.5281/zenodo.546371",
                    "html": "https://zenodo.org/record/546371",
                    "latest": "https://zenodo.org/api/records/546371",
                    "latest_html": "https://zenodo.org/record/546371",
                    "self": "https://zenodo.org/api/records/546371"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "National Museum of Natural History, Sorbonne University,  Institute of Systematic, Evolution, Biodiversity, Paris, France",
                            "name": "Lourenço, Wilson R."
                        },
                        {
                            "affiliation": "SynTech Research, La Chapelle de Guinchay, France",
                            "name": "Ythier, Eric"
                        }
                    ],
                    "description": "<p>Biological observations were made since 2005 by both authors on live specimens of<em> Palaeocheloctonus septentrionalis </em>Lourenço &amp; Wilmé, 2015. These were collected in the north of Madagascar, from an imprecise location, but probably from grassland formations of the extreme north, the same from where the type material of <em>P. septentrionalis</em> was collected. The total duration of embryonic development was of 17 months. The observed post-embryonic developmental periods are significantly longer than those of most medium-sized species of scorpions but are similar to the ones previously observed in species of the closely related genus <em>Opisthacanthus</em>. Morphometric growth values of the different instars are also similar to those in other studied species of the family Hormuridae. No significant allometric growing of appendages has been observed in males.</p>",
                    "doi": "10.5281/zenodo.546371",
                    "journal": {
                        "pages": "17-24",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Scorpion",
                        "Palaeocheloctonus septentrionalis",
                        "Madagascar",
                        "life history",
                        "embryonic development",
                        "post-embryonic development"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Lourenço, Wilson R. & Ythier, Eric (2017). Embryonic and post-embryonic developments of the Malagasy scorpion Palaeocheloctonus septentrionalis Lourenço & Wilmé, 2015 (Scorpiones: Hormuridae). Onychium, 13: 17-24"
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "546371"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "796192"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Embryonic and post-embryonic developments of the Malagasy scorpion Palaeocheloctonus septentrionalis Lourenço & Wilmé, 2015 (Scorpiones: Hormuridae)"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 11,
                    "unique_downloads": 11,
                    "unique_views": 17,
                    "version_downloads": 11,
                    "version_unique_downloads": 11,
                    "version_unique_views": 17,
                    "version_views": 17,
                    "version_volume": 22689040,
                    "views": 17,
                    "volume": 22689040
                },
                "updated": "2020-01-20T14:33:50.843161+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1218922",
                "conceptrecid": "1218922",
                "created": "2018-04-20T08:23:20.655761+00:00",
                "doi": "10.5281/zenodo.1218923",
                "files": [
                    {
                        "bucket": "c439c371-3127-46ab-a5b7-c31a6e94be18",
                        "checksum": "md5:bce063332ec098c04982694882e1daa7",
                        "key": "Dioli_Lai_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/c439c371-3127-46ab-a5b7-c31a6e94be18/Dioli_Lai_2018_Onychium14.pdf"
                        },
                        "size": 766532,
                        "type": "pdf"
                    }
                ],
                "id": 1218923,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1218923.svg",
                    "bucket": "https://zenodo.org/api/files/c439c371-3127-46ab-a5b7-c31a6e94be18",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1218922.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1218922",
                    "doi": "https://doi.org/10.5281/zenodo.1218923",
                    "html": "https://zenodo.org/record/1218923",
                    "latest": "https://zenodo.org/api/records/1218923",
                    "latest_html": "https://zenodo.org/record/1218923",
                    "self": "https://zenodo.org/api/records/1218923"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Civic Museum of Natural History, Milan, Italy",
                            "name": "Dioli, Paride"
                        },
                        {
                            "affiliation": "Fo.Re.S.T.A.S., Territorial Service of Sassari, Sassari, Italy",
                            "name": "Lai, Gianni"
                        }
                    ],
                    "description": "<p><em>First record of </em>Pinalitus conspurcatus<em> (Reuter, 1875) for Sardinia and notes on its distribution and biology (Hemiptera: Heteroptera: Miridae).</em> The occurrence in Italy of <em>Pinalitus conspurcatus</em> (Reuter, 1875), which is new for Sardinia, is confirmed. Previously it was known only from Sicily. The finding in November probably coincides with the late flowering of the carob tree (<em>Ceratonia siliqua</em> L.).</p>",
                    "doi": "10.5281/zenodo.1218923",
                    "journal": {
                        "pages": "39-42",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Heteroptera",
                        "Miridae",
                        "Pinalitus conspurcatus",
                        "first record",
                        "Sardinia",
                        "distribution"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Dioli, Paride & Lai, Gianni (2018). Prima segnalazione per la Sardegna di Pinalitus conspurcatus (Reuter, 1875) e note sulla sua distribuzione e biologia (Hemiptera: Heteroptera: Miridae). Onychium, 14: 39-42"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1218922",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1218923"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1218922"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Prima segnalazione per la Sardegna di Pinalitus conspurcatus (Reuter, 1875) e note sulla sua distribuzione e biologia (Hemiptera: Heteroptera: Miridae)"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 11,
                    "unique_downloads": 10,
                    "unique_views": 19,
                    "version_downloads": 11,
                    "version_unique_downloads": 10,
                    "version_unique_views": 19,
                    "version_views": 19,
                    "version_volume": 8431852,
                    "views": 19,
                    "volume": 8431852
                },
                "updated": "2020-01-20T13:31:14.107296+00:00"
            },
            {
                "conceptrecid": "795236",
                "created": "2017-04-20T10:11:18.827376+00:00",
                "doi": "10.5281/zenodo.495565",
                "files": [
                    {
                        "bucket": "e3ff0e8f-c173-4dec-ae3e-940aade87cb4",
                        "checksum": "md5:319a5253964bfbe66ef41e532b5d84f7",
                        "key": "Toledo_Rocchi_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/e3ff0e8f-c173-4dec-ae3e-940aade87cb4/Toledo_Rocchi_2017_Onychium13.pdf"
                        },
                        "size": 384743,
                        "type": "pdf"
                    }
                ],
                "id": 495565,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.495565.svg",
                    "bucket": "https://zenodo.org/api/files/e3ff0e8f-c173-4dec-ae3e-940aade87cb4",
                    "doi": "https://doi.org/10.5281/zenodo.495565",
                    "html": "https://zenodo.org/record/495565",
                    "latest": "https://zenodo.org/api/records/495565",
                    "latest_html": "https://zenodo.org/record/495565",
                    "self": "https://zenodo.org/api/records/495565"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Brescia, Italy",
                            "name": "Toledo, Mario"
                        },
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Rocchi, Saverio"
                        }
                    ],
                    "description": "<p><em>New records of aquatic Coleoptera from Italy (Coleoptera: Hydroscaphidae, Gyrinidae, Dytiscidae, Helophoridae, Hydrophilidae, Hydraenidae, Limnichidae, Erirhinidae). </em>New records concerning the distribution in Italy of 41 species of aquatic Coleoptera are reported: 1 Hydroscaphidae, 1 Gyrinidae, 13 Dytiscidae, 5 Helophoridae, 14 Hydrophilidae, 5 Hydraenidae, 1 Limnichidae, 1 Erirhinidae.</p>",
                    "doi": "10.5281/zenodo.495565",
                    "journal": {
                        "pages": "63-74",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Coleoptera",
                        "Hydroscaphidae",
                        "Gyrinidae",
                        "Dytiscidae",
                        "Helophoridae",
                        "Hydrophilidae",
                        "Hydraenidae",
                        "Limnichidae",
                        "Erirhinidae",
                        "distribution",
                        "new records",
                        "Italy"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Toledo, Mario & Rocchi, Saverio (2017). Reperti inediti di Coleotteri acquatici in Italia (Coleoptera: Hydroscaphidae, Gyrinidae, Dytiscidae, Helophoridae, Hydrophilidae, Hydraenidae, Limnichidae, Erirhinidae). Oncyhium, 13: 63-74"
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "495565"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "795236"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Reperti inediti di Coleotteri acquatici in Italia (Coleoptera: Hydroscaphidae, Gyrinidae, Dytiscidae, Helophoridae, Hydrophilidae, Hydraenidae, Limnichidae, Erirhinidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 6,
                "stats": {
                    "downloads": 27,
                    "unique_downloads": 26,
                    "unique_views": 58,
                    "version_downloads": 27,
                    "version_unique_downloads": 26,
                    "version_unique_views": 58,
                    "version_views": 59,
                    "version_volume": 10388061,
                    "views": 59,
                    "volume": 10388061
                },
                "updated": "2020-01-20T12:51:17.218236+00:00"
            },
            {
                "conceptrecid": "796210",
                "created": "2017-04-20T09:58:58.476200+00:00",
                "doi": "10.5281/zenodo.546377",
                "files": [
                    {
                        "bucket": "6146300b-a576-4e4d-8dbf-02e0358e5fc8",
                        "checksum": "md5:42f2129e2d77647fc563e441611e203b",
                        "key": "Insom_Terzani_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/6146300b-a576-4e4d-8dbf-02e0358e5fc8/Insom_Terzani_2017_Onychium13.pdf"
                        },
                        "size": 967868,
                        "type": "pdf"
                    }
                ],
                "id": 546377,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.546377.svg",
                    "bucket": "https://zenodo.org/api/files/6146300b-a576-4e4d-8dbf-02e0358e5fc8",
                    "doi": "https://doi.org/10.5281/zenodo.546377",
                    "html": "https://zenodo.org/record/546377",
                    "latest": "https://zenodo.org/api/records/546377",
                    "latest_html": "https://zenodo.org/record/546377",
                    "self": "https://zenodo.org/api/records/546377"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Insom, Emilio"
                        },
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Terzani, Fabio"
                        }
                    ],
                    "description": "<p>The authors describe a new species of Acanthaclisini (Neuroptera: Myrmeleontidae) from Somalia: <em>Syngenes carfii</em>.</p>",
                    "doi": "10.5281/zenodo.546377",
                    "journal": {
                        "pages": "55-62",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Acanthaclisini",
                        "Syngenes",
                        "Somalia"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Insom, Emilio & Terzani, Fabio (2017). A new species of Syngenes Kolbe, 1897 from Somalia (Neuroptera: Myrmeleontidae: Acanthaclisini). Onychium, 13: 55-62"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:CFE27D13-76DC-43B8-B34C-EA9725C70357",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "546377"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "796210"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new species of Syngenes Kolbe, 1897 from Somalia (Neuroptera: Myrmeleontidae: Acanthaclisini)"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 11,
                    "unique_downloads": 11,
                    "unique_views": 20,
                    "version_downloads": 11,
                    "version_unique_downloads": 11,
                    "version_unique_views": 20,
                    "version_views": 20,
                    "version_volume": 10646548,
                    "views": 20,
                    "volume": 10646548
                },
                "updated": "2020-01-20T14:58:32.132099+00:00"
            },
            {
                "conceptrecid": "795923",
                "created": "2017-04-20T10:17:17.047353+00:00",
                "doi": "10.5281/zenodo.545795",
                "files": [
                    {
                        "bucket": "672b2518-8b16-41d9-af91-90551d867b2d",
                        "checksum": "md5:b7ae9fd1d8bc23f9577cd5c4cddf6941",
                        "key": "Bordoni_2017b_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/672b2518-8b16-41d9-af91-90551d867b2d/Bordoni_2017b_Onychium13.pdf"
                        },
                        "size": 289663,
                        "type": "pdf"
                    }
                ],
                "id": 545795,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.545795.svg",
                    "bucket": "https://zenodo.org/api/files/672b2518-8b16-41d9-af91-90551d867b2d",
                    "doi": "https://doi.org/10.5281/zenodo.545795",
                    "html": "https://zenodo.org/record/545795",
                    "latest": "https://zenodo.org/api/records/545795",
                    "latest_html": "https://zenodo.org/record/545795",
                    "self": "https://zenodo.org/api/records/545795"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Bordoni, Arnaldo"
                        }
                    ],
                    "description": "<p><em>Hypnogyra angularis </em>(Ganglbauer, 1895) = <em>Xantholinus laevissimus </em>Reitter, 1898, syn. n. is established with a short history of the cited species. First records of <em>Hypnogyra angularis </em>(Ganglbauer, 1895)<em> </em>for Crimea and <em>H. hoffmanni</em> (Bernhauer, 1928) for South Korea are given.</p>",
                    "doi": "10.5281/zenodo.545795",
                    "journal": {
                        "pages": "117-119",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Coleoptera",
                        "Staphylinidae",
                        "Xantholinini",
                        "Hypnogyra",
                        "new synonymy",
                        "new record",
                        "Crimea",
                        "South Korea"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Bordoni, Arnaldo (2017). New data on the Palaearctic Xantholinini. 13. Systematic position of Xantholinus laevissimus Reitter, 1898 (Coleoptera: Staphylinidae). 276th contribution to the knowledge of the Staphylinidae. Onychium, 13: 117-119"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:D654A639-703C-44DE-A840-A5CC6349713F",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "545795"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "795923"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "New data on the Palaearctic Xantholinini. 13. Systematic position of Xantholinus laevissimus Reitter, 1898 (Coleoptera: Staphylinidae). 276th contribution to the knowledge of the Staphylinidae"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 14,
                    "unique_downloads": 14,
                    "unique_views": 18,
                    "version_downloads": 14,
                    "version_unique_downloads": 14,
                    "version_unique_views": 18,
                    "version_views": 18,
                    "version_volume": 4055282,
                    "views": 18,
                    "volume": 4055282
                },
                "updated": "2020-01-20T15:00:34.452454+00:00"
            },
            {
                "conceptrecid": "796432",
                "created": "2017-04-20T09:35:29.152145+00:00",
                "doi": "10.5281/zenodo.546324",
                "files": [
                    {
                        "bucket": "c480722d-308f-4e8d-86c6-7318e1722314",
                        "checksum": "md5:af2e742f242e8898501661263963e31c",
                        "key": "Orbach_Bartolozzi_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/c480722d-308f-4e8d-86c6-7318e1722314/Orbach_Bartolozzi_2017_Onychium13.pdf"
                        },
                        "size": 760749,
                        "type": "pdf"
                    }
                ],
                "id": 546324,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.546324.svg",
                    "bucket": "https://zenodo.org/api/files/c480722d-308f-4e8d-86c6-7318e1722314",
                    "doi": "https://doi.org/10.5281/zenodo.546324",
                    "html": "https://zenodo.org/record/546324",
                    "latest": "https://zenodo.org/api/records/546324",
                    "latest_html": "https://zenodo.org/record/546324",
                    "self": "https://zenodo.org/api/records/546324"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Qiryat Tivon, Israel",
                            "name": "Orbach, Eylon"
                        },
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Bartolozzi, Luca"
                        }
                    ],
                    "description": "<p><em>Calodromus bambii</em> n. sp. is described based on three male specimens from Vietnam and Thailand. The new taxon is closely related to <em>Calodromus amabilis</em> Kleine, 1916, but can be distinguished by the different shape of the first tarsal article of male posterior legs, the different proportions between its thickened part and the slender one, and by the ball-like apical part of the distal tubercle. An updated key for the identification of the males of the known species of <em>Calodromus</em> is provided. A photo of the peculiar defensive behaviour of a <em>Calodromus</em> species is published for the first time.</p>",
                    "doi": "10.5281/zenodo.546324",
                    "journal": {
                        "pages": "131-137",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "new species",
                        "Calodromus bambii",
                        "Vietnam",
                        "Thailand",
                        "identification key",
                        "defensive behaviour"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Orbach, Eylon & Bartolozzi, Luca (2017). Description of a new species of Calodromus Guérin-Méneville, 1832 (Coleoptera: Brentidae: Cyphagoginae). Onychium, 13: 131-137"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:B5E26DB5-FFEA-4833-9543-2B9F92C6DD9A",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "546324"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "796432"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Description of a new species of Calodromus Guérin-Méneville, 1832 (Coleoptera: Brentidae: Cyphagoginae)"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 41,
                    "unique_downloads": 36,
                    "unique_views": 46,
                    "version_downloads": 41,
                    "version_unique_downloads": 36,
                    "version_unique_views": 46,
                    "version_views": 51,
                    "version_volume": 31190709,
                    "views": 51,
                    "volume": 31190709
                },
                "updated": "2020-01-20T14:59:06.467943+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1218950",
                "conceptrecid": "1218950",
                "created": "2018-04-20T08:26:24.677155+00:00",
                "doi": "10.5281/zenodo.1218951",
                "files": [
                    {
                        "bucket": "4d455457-5e43-4ebb-80fc-3bee31b23971",
                        "checksum": "md5:c5d4f6f6f8aae4104f507619aab88594",
                        "key": "Boni Bartalucci_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/4d455457-5e43-4ebb-80fc-3bee31b23971/Boni%20Bartalucci_2018_Onychium14.pdf"
                        },
                        "size": 9074067,
                        "type": "pdf"
                    }
                ],
                "id": 1218951,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1218951.svg",
                    "bucket": "https://zenodo.org/api/files/4d455457-5e43-4ebb-80fc-3bee31b23971",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1218950.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1218950",
                    "doi": "https://doi.org/10.5281/zenodo.1218951",
                    "html": "https://zenodo.org/record/1218951",
                    "latest": "https://zenodo.org/api/records/1218951",
                    "latest_html": "https://zenodo.org/record/1218951",
                    "self": "https://zenodo.org/api/records/1218951"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Boni Bartalucci, Mario"
                        }
                    ],
                    "description": "<p>A key of all known species of the genus <em>Meria </em>Illiger, 1807 of the Afrotropical region is given. Eleven new species are described: <em>Meria aequatorialis</em> n. sp., <em>Meria conophora</em> n. sp., <em>Meria eterodira </em>n. sp., <em>Meria hermonensis </em>n. sp., <em>Meria mhaladai</em> n. sp., <em>Meria namibensis</em> n. sp., <em>Meria ordinaria </em>n. sp., <em>Meria ornativentris</em> n. sp., <em>Meria peripatetica</em> n. sp., <em>Meria shabeella</em> n. sp., <em>Meriodes laticeps</em> n. sp. Two taxa of the genus <em>Poecilotiphia </em>are described from Austral Africa for the first time: <em>Poecilotiphia australis</em> n. sp., <em>Poecilotiphia idioptera</em> n. sp. Lectotypes of <em>Plesia meruensis</em> Cameron, 1910, <em>Meira rufitarsis</em> Cameron, 1910, <em>Myzine (Hemimeria) sublevis</em> Turner, 1908, <em>Myzine (Pseudomeria) neavei </em>Turner, 1911, <em>Myzine umbratica</em> Turner, 1912, <em>Myzine impetuosus </em>Turner, 1913, <em>Myzine basutorum </em>Turner, 1913 are designed and their new combinations under <em>Meria </em>are established. The shift of <em>Meria anomala</em> Boni Bartalucci, 2009 to <em>Afromeria </em>Boni Bartalucci, 2007 is proposed besides the synonymy of <em>Mesa erythrodira </em>Boni Bartalucci, 2013 with <em>Elis (Mesa) arnoldi</em> Turner, 1917.</p>",
                    "doi": "10.5281/zenodo.1218951",
                    "journal": {
                        "pages": "43-92",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Meria",
                        "Meriodes",
                        "Poecilotiphia",
                        "new species",
                        "Afrotropical Region"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Boni Bartalucci, Mario (2018) Afrotropical Myzininae of the subtribe Meriina (with identification key for the genus Meria Illiger, 1807) (Hymenoptera: Tiphiidae). Onychium, 14: 43-92"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:16F063DB-AA93-4C75-9E26-B5D0D6B7247B",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        },
                        {
                            "identifier": "10.5281/zenodo.1218950",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1218951"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1218950"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Afrotropical Myzininae of the subtribe Meriina (with identification key for the genus Meria Illiger, 1807) (Hymenoptera: Tiphiidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 4,
                "stats": {
                    "downloads": 33,
                    "unique_downloads": 29,
                    "unique_views": 28,
                    "version_downloads": 33,
                    "version_unique_downloads": 29,
                    "version_unique_views": 28,
                    "version_views": 28,
                    "version_volume": 299444211,
                    "views": 28,
                    "volume": 299444211
                },
                "updated": "2020-01-20T14:33:12.827831+00:00"
            },
            {
                "conceptrecid": "797249",
                "created": "2017-04-20T09:57:03.575241+00:00",
                "doi": "10.5281/zenodo.545781",
                "files": [
                    {
                        "bucket": "32344186-cba6-4513-a517-dafde8b96444",
                        "checksum": "md5:416b4a79dd9feb9e58b54736e41271f7",
                        "key": "BoniBartalucci_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/32344186-cba6-4513-a517-dafde8b96444/BoniBartalucci_2017_Onychium13.pdf"
                        },
                        "size": 3351096,
                        "type": "pdf"
                    }
                ],
                "id": 545781,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.545781.svg",
                    "bucket": "https://zenodo.org/api/files/32344186-cba6-4513-a517-dafde8b96444",
                    "doi": "https://doi.org/10.5281/zenodo.545781",
                    "html": "https://zenodo.org/record/545781",
                    "latest": "https://zenodo.org/api/records/545781",
                    "latest_html": "https://zenodo.org/record/545781",
                    "self": "https://zenodo.org/api/records/545781"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Boni Bartalucci, Mario"
                        }
                    ],
                    "description": "<p>Data about knowledge of the Myzinin fauna from Canary, Madeira, and Cabo Verde Islands are given. Description of the insofar-unknown females of<strong> </strong><em>Poecilotiphia guichardi</em> (Guiglia, 1967) and <em>Poecilotiphia trichogastra</em> Boni Bartalucci, 2004 are produced.</p>",
                    "doi": "10.5281/zenodo.545781",
                    "journal": {
                        "pages": "45-54",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Canary Islands",
                        "Cabo Verde",
                        "Madeira",
                        "Myzininae",
                        "Poecilotiphia"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Boni Bartalucci, Mario (2017). Myzininae from Canary, Madeira, and Cabo Verde Islands (Hymenoptera: Tiphiidae). Onychium, 13: 45-54"
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "545781"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "797249"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Myzininae from Canary, Madeira, and Cabo Verde Islands (Hymenoptera: Tiphiidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 14,
                    "unique_downloads": 13,
                    "unique_views": 33,
                    "version_downloads": 14,
                    "version_unique_downloads": 13,
                    "version_unique_views": 33,
                    "version_views": 33,
                    "version_volume": 46915344,
                    "views": 33,
                    "volume": 46915344
                },
                "updated": "2020-01-20T16:57:45.407898+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1218896",
                "conceptrecid": "1218896",
                "created": "2018-04-20T08:18:59.788282+00:00",
                "doi": "10.5281/zenodo.1218897",
                "files": [
                    {
                        "bucket": "fb8cbd0e-8793-440e-90f8-d582e4477a00",
                        "checksum": "md5:4fb7eb416e75ef38ef2e4b474e816859",
                        "key": "Taiti_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/fb8cbd0e-8793-440e-90f8-d582e4477a00/Taiti_2018_Onychium14.pdf"
                        },
                        "size": 5132321,
                        "type": "pdf"
                    }
                ],
                "id": 1218897,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1218897.svg",
                    "bucket": "https://zenodo.org/api/files/fb8cbd0e-8793-440e-90f8-d582e4477a00",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1218896.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1218896",
                    "doi": "https://doi.org/10.5281/zenodo.1218897",
                    "html": "https://zenodo.org/record/1218897",
                    "latest": "https://zenodo.org/api/records/1218897",
                    "latest_html": "https://zenodo.org/record/1218897",
                    "self": "https://zenodo.org/api/records/1218897"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Institute of Ecosystem Study, National Research Council, Sesto Fiorentino, Florence, Italy",
                            "name": "Taiti, Stefano"
                        }
                    ],
                    "description": "<p>A new species of Armadillidae, <em>Ctenorillo meyeri </em>n. sp., from termite nests of the Kruger National Park in South Africa is described. This is the first termitophilous terrestrial isopod in the family Armadillidae. Termitophilous isopods were previously known only from the families Schoebliidae, Titanidae, Styloniscidae, Turanoniscidae, Platyarthidae, and the genus <em>Exalloniscus</em>.</p>",
                    "doi": "10.5281/zenodo.1218897",
                    "journal": {
                        "pages": "9-15",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Oniscidea",
                        "Armadillidae",
                        "Ctenorillo",
                        "termites",
                        "new species",
                        "South Africa"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Taiti, Stefano (2018) A new termitophilous species of Armadillidae from South Africa (Isopoda: Oniscidea). Onychium, 14: 9-15"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:060F854E-A8B6-4755-88AB-E7447E8605B3",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        },
                        {
                            "identifier": "10.5281/zenodo.1218896",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1218897"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1218896"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new termitophilous species of Armadillidae from South Africa (Isopoda: Oniscidea)"
                },
                "owners": [
                    29896
                ],
                "revision": 4,
                "stats": {
                    "downloads": 72,
                    "unique_downloads": 68,
                    "unique_views": 136,
                    "version_downloads": 72,
                    "version_unique_downloads": 68,
                    "version_unique_views": 136,
                    "version_views": 146,
                    "version_volume": 369527112,
                    "views": 146,
                    "volume": 369527112
                },
                "updated": "2020-01-20T14:43:19.772946+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1218906",
                "conceptrecid": "1218906",
                "created": "2018-04-20T08:20:09.301860+00:00",
                "doi": "10.5281/zenodo.1218907",
                "files": [
                    {
                        "bucket": "00b8cacd-5a24-4566-86de-bde93123a60d",
                        "checksum": "md5:90c9bf831a51a60ce016230c91f8c21c",
                        "key": "Taiti_Montesanto_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/00b8cacd-5a24-4566-86de-bde93123a60d/Taiti_Montesanto_2018_Onychium14.pdf"
                        },
                        "size": 6507213,
                        "type": "pdf"
                    }
                ],
                "id": 1218907,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1218907.svg",
                    "bucket": "https://zenodo.org/api/files/00b8cacd-5a24-4566-86de-bde93123a60d",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1218906.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1218906",
                    "doi": "https://doi.org/10.5281/zenodo.1218907",
                    "html": "https://zenodo.org/record/1218907",
                    "latest": "https://zenodo.org/api/records/1218907",
                    "latest_html": "https://zenodo.org/record/1218907",
                    "self": "https://zenodo.org/api/records/1218907"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Institute of Ecosystem Study, National Research Council, Sesto Fiorentino, Florence, Italy",
                            "name": "Taiti, Stefano"
                        },
                        {
                            "affiliation": "Department of Biology, University of Pisa,  Pisa, Italy",
                            "name": "Montesanto, Giuseppe"
                        }
                    ],
                    "description": "<p>The terrestrial isopods of Djibouti are still very poorly known. Two new species of Eubelidae are here described: <em>Periscyphis ugoliniii</em> n. sp. and <em>Koweitoniscus agnellii</em> n. sp. A third species is recorded, <em>Periscyphis sudanensis</em> Taiti, Ferrara &amp; Allspach, 1997, previously known only from two localities in Sudan.</p>",
                    "doi": "10.5281/zenodo.1218907",
                    "journal": {
                        "pages": "17-31",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Oniscidea",
                        "Eubelidae",
                        "Periscyphis",
                        "Koweitoniscus",
                        "new species",
                        "Djibouti"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Taiti, Stefano & Montesanto, Giuseppe (2018). New species and records of Eubelidae from Djibouti, eastern Africa (Isopoda: Oniscidea). Onychium, 14: 17-31"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:494549CA-DD96-4C9C-A5A6-E1C3D6B50007",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        },
                        {
                            "identifier": "10.5281/zenodo.1218906",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1218907"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1218906"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "New species and records of Eubelidae from Djibouti, eastern Africa (Isopoda: Oniscidea)"
                },
                "owners": [
                    29896
                ],
                "revision": 4,
                "stats": {
                    "downloads": 22,
                    "unique_downloads": 21,
                    "unique_views": 33,
                    "version_downloads": 22,
                    "version_unique_downloads": 21,
                    "version_unique_views": 33,
                    "version_views": 34,
                    "version_volume": 143158686,
                    "views": 34,
                    "volume": 143158686
                },
                "updated": "2020-01-20T13:59:15.200716+00:00"
            },
            {
                "conceptrecid": "796306",
                "created": "2017-04-20T09:44:32.312756+00:00",
                "doi": "10.5281/zenodo.546318",
                "files": [
                    {
                        "bucket": "067143a7-e097-4e26-96ae-f8c427348500",
                        "checksum": "md5:d37d95e0ec7927be21d9737f6998e9b8",
                        "key": "Battiston_etal_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/067143a7-e097-4e26-96ae-f8c427348500/Battiston_etal_2017_Onychium13.pdf"
                        },
                        "size": 2017565,
                        "type": "pdf"
                    }
                ],
                "id": 546318,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.546318.svg",
                    "bucket": "https://zenodo.org/api/files/067143a7-e097-4e26-96ae-f8c427348500",
                    "doi": "https://doi.org/10.5281/zenodo.546318",
                    "html": "https://zenodo.org/record/546318",
                    "latest": "https://zenodo.org/api/records/546318",
                    "latest_html": "https://zenodo.org/record/546318",
                    "self": "https://zenodo.org/api/records/546318"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Museums of Canal di Brenta, Valstagna (Vicenza), Italy",
                            "name": "Battiston, Roberto"
                        },
                        {
                            "affiliation": "Seneghe (Oristano), Italy",
                            "name": "Andria, Simone"
                        },
                        {
                            "affiliation": "Cagliari, Italy",
                            "name": "Ruzzante, Gianpaolo"
                        }
                    ],
                    "description": "<p>The recent discovery of new specimens of <em>Sphodromantis viridis</em> (Forskål, 1775) in Sardinia, together with the increasing number of sightings reported in the literature for the Mediterranean islands, allow a first investigation of the spreading dynamics of this mantis outside of its continental habitat in a biogeographical perspective. An insect historically absent from the Mediterranean islands but often sinantropic and with spreading dynamics compatible with an anthropogenic dispersal is confirmed here as a new species for Italy.</p>",
                    "doi": "10.5281/zenodo.546318",
                    "journal": {
                        "pages": "25-30",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Mantodea",
                        "distribution",
                        "taxonomy",
                        "biogeography",
                        "alien species",
                        "natural spread"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Battiston, Roberto et al. (2017). The silent spreading of a giant mantis: a critical update on the distribution of Sphodromantis viridis (Forskål, 1775) in the Mediterranean islands (Mantodea: Mantidae). Onychium, 13: 25-30"
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "546318"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "796306"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "The silent spreading of a giant mantis: a critical update on the distribution of Sphodromantis viridis (Forskål, 1775) in the Mediterranean islands (Mantodea: Mantidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 6,
                "stats": {
                    "downloads": 131,
                    "unique_downloads": 127,
                    "unique_views": 78,
                    "version_downloads": 131,
                    "version_unique_downloads": 127,
                    "version_unique_views": 78,
                    "version_views": 81,
                    "version_volume": 264301015,
                    "views": 81,
                    "volume": 264301015
                },
                "updated": "2020-01-20T17:19:09.873010+00:00"
            },
            {
                "conceptrecid": "793844",
                "created": "2017-04-20T09:54:03.153641+00:00",
                "doi": "10.5281/zenodo.439110",
                "files": [
                    {
                        "bucket": "352c7e42-a7e2-486e-af40-27d1d4ed8782",
                        "checksum": "md5:0aaad421936e5548138da0a3d248b688",
                        "key": "Vergari_etal_2017_Onychium13.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/352c7e42-a7e2-486e-af40-27d1d4ed8782/Vergari_etal_2017_Onychium13.pdf"
                        },
                        "size": 685863,
                        "type": "pdf"
                    }
                ],
                "id": 439110,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.439110.svg",
                    "bucket": "https://zenodo.org/api/files/352c7e42-a7e2-486e-af40-27d1d4ed8782",
                    "doi": "https://doi.org/10.5281/zenodo.439110",
                    "html": "https://zenodo.org/record/439110",
                    "latest": "https://zenodo.org/api/records/439110",
                    "latest_html": "https://zenodo.org/record/439110",
                    "self": "https://zenodo.org/api/records/439110"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Nature and Archaeological Center of Pistoiese Apennine, Campo Tizzoro (Pistoia), Italy",
                            "name": "Vergari, Sebastiano"
                        },
                        {
                            "affiliation": "Nature and Archaeological Center of Pistoiese Apennine, Campo Tizzoro (Pistoia), Italy",
                            "name": "Vergari, Simone"
                        },
                        {
                            "affiliation": "Nature and Archaeological Center of Pistoiese Apennine, Campo Tizzoro (Pistoia), Italy",
                            "name": "Dondini, Gianna"
                        },
                        {
                            "affiliation": "Castelplanio (Ancona), Italy",
                            "name": "Carotti, Giovanni"
                        }
                    ],
                    "description": "<p><em>First record of </em>Saga pedo<em> (Pallas, 1771) for Tuscany<strong> </strong>(Orthoptera: Tettigoniidae)</em><em>. </em>The presence in Tuscany of the katydid <em>Saga pedo</em> (Pallas, 1771) is recorded for the first time. <em>Saga pedo</em> is considered a vulnerable species in the EU and it is included in Annex IV of Council Directive 92/43/EEC.</p>",
                    "doi": "10.5281/zenodo.439110",
                    "journal": {
                        "pages": "35-37",
                        "title": "Onychium",
                        "volume": "13"
                    },
                    "keywords": [
                        "Orthoptera",
                        "Saga pedo",
                        "Tuscany",
                        "Italy"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-04-20",
                    "references": [
                        "Vergari, Sebastiano et al. (2017) Prima segnalazione di Saga pedo (Pallas, 1771) per la Toscana  (Orthoptera: Tettigoniidae). Onychium, 13: 35-37"
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "439110"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "793844"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Prima segnalazione di Saga pedo (Pallas, 1771) per la Toscana (Orthoptera: Tettigoniidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 5,
                "stats": {
                    "downloads": 26,
                    "unique_downloads": 26,
                    "unique_views": 64,
                    "version_downloads": 26,
                    "version_unique_downloads": 26,
                    "version_unique_views": 64,
                    "version_views": 65,
                    "version_volume": 17832438,
                    "views": 65,
                    "volume": 17832438
                },
                "updated": "2020-01-20T16:43:00.597728+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1219134",
                "conceptrecid": "1219134",
                "created": "2018-04-20T08:34:07.722208+00:00",
                "doi": "10.5281/zenodo.1219135",
                "files": [
                    {
                        "bucket": "e52029eb-78af-4a86-802c-02b275ee5934",
                        "checksum": "md5:c624e521a4c3616c9b49b66b219e7494",
                        "key": "Tomasovic_Bartolozzi_2018_Onychium14.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/e52029eb-78af-4a86-802c-02b275ee5934/Tomasovic_Bartolozzi_2018_Onychium14.pdf"
                        },
                        "size": 4908512,
                        "type": "pdf"
                    }
                ],
                "id": 1219135,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219135.svg",
                    "bucket": "https://zenodo.org/api/files/e52029eb-78af-4a86-802c-02b275ee5934",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1219134.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1219134",
                    "doi": "https://doi.org/10.5281/zenodo.1219135",
                    "html": "https://zenodo.org/record/1219135",
                    "latest": "https://zenodo.org/api/records/1219135",
                    "latest_html": "https://zenodo.org/record/1219135",
                    "self": "https://zenodo.org/api/records/1219135"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Functional and Evolutionary Entomology Unit, University of Liège, Gembloux, Belgium",
                            "name": "Tomasovic, Guy"
                        },
                        {
                            "affiliation": "Natural History Museum of the University of Florence, Florence, Italy",
                            "name": "Bartolozzi, Luca"
                        }
                    ],
                    "description": "<p>The study of a collection of 70 specimens of Asilidae from Vietnam, collected during the entomological expeditions organised in the period 2010-2017 by the Natural History Museum of the University of Florence and the Vietnam National Museum of Nature, revealed the presence of 24 species. Nine species are new for science and are described and illustrated: <em>Anacinaces lieni </em>sp. n.; <em>Cerdistus setaelongus</em> sp. n.; <em>Clephydroneura serrula </em>sp. n.; <em>Heligmonevra bambii </em>sp. n.; <em>Neoitamus laocaiensis </em>sp. n.; <em>Molobratia hoabinhensis</em> sp. n.; <em>Andrenosoma orbachi</em> sp. n.; <em>Choerades xuansonensis </em>sp. n.; <em>Merodontina vietnamensis</em> sp. n. Seven species are also quoted for the first time from Vietnam: <em>Astochia lancealata</em> Scarbrough &amp; Biglow, 2004, <em>Hoplopheromerus guangdongi</em> Tomasovic, 2006, <em>Pogonosoma cyanogaster </em>Bezzi, 1917, <em>Lagynogaster suensoni </em>Frey, 1937, <em>Laloides tigris</em> Tomasovic &amp; Grootaert, 2003, <em>Microstylum oberthurii </em>Wulp, 1896, and <em>Microstylum vulcan</em> Bromley, 1928.</p>",
                    "doi": "10.5281/zenodo.1219135",
                    "journal": {
                        "pages": "173-202",
                        "title": "Onychium",
                        "volume": "14"
                    },
                    "keywords": [
                        "Asilidae",
                        "Vietnam",
                        "new species",
                        "new records"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2018-04-20",
                    "references": [
                        "Tomasovic, Guy & Bartolozzi, Luca (2018). Contribution to the knowledge of the robber flies from Vietnam, with description of nine new species (Diptera: Asilidae). Onychium, 14: 173-202"
                    ],
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:36F280A8-FFC3-494E-905F-303BB2C3285A",
                            "relation": "isCitedBy",
                            "scheme": "lsid"
                        },
                        {
                            "identifier": "10.5281/zenodo.1219134",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1219135"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1219134"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Contribution to the knowledge of the robber flies from Vietnam, with description of nine new species (Diptera: Asilidae)"
                },
                "owners": [
                    29896
                ],
                "revision": 4,
                "stats": {
                    "downloads": 34,
                    "unique_downloads": 32,
                    "unique_views": 65,
                    "version_downloads": 34,
                    "version_unique_downloads": 32,
                    "version_unique_views": 65,
                    "version_views": 66,
                    "version_volume": 166889408,
                    "views": 66,
                    "volume": 166889408
                },
                "updated": "2020-01-20T15:50:07.776955+00:00"
            }
        ],
        "total": 33
    },
    "links": {
        "self": "https://zenodo.org/api/records/?sort=bestmatch&q=journal.title%3AOnychium&page=1&size=100"
    }
}';

$obj = json_decode($json);


foreach ($obj->hits->hits as $hit)
{
	$csl = new stdclass;
	
	$csl->type = 'article-journal';
	
	$csl->title = $hit->metadata->title;
	$csl->DOI = $hit->doi;
	$csl->DOIAgency = 'datacite';
	
	$csl->id = $hit->id;
	
	// container
	if (isset($hit->metadata->journal))
	{
		if (isset($hit->metadata->journal->title))
		{
			$csl->{'container-title'} = $hit->metadata->journal->title;
			
			switch ($csl->{'container-title'})
			{
				case 'Onychium':
					$csl->ISSN[] = '1824-2669';
					break;
					
				default:
					break;				
			}
		}
		if (isset($hit->metadata->journal->volume))
		{
			$csl->volume = $hit->metadata->journal->volume;
		}
		if (isset($hit->metadata->journal->title))
		{
			$csl->page = $hit->metadata->journal->pages;
		}
	}
	
	// authors
	if (isset($hit->metadata->creators))
	{
		foreach ($hit->metadata->creators as $creator)
		{
			$author = new stdclass;
			$author->literal = $creator->name;
			
			if (preg_match('/(.*),\s+(.*)/', $author->literal, $m))
			{
				$author->literal = $m[2] . ' ' . $m[1];
			}
			$csl->author[] = $author;
		}
	}
	
	// date
	if (isset($hit->metadata->publication_date))
	{
		$csl->issued = new stdclass;			
		$csl->issued->{'date-parts'} = array();
					   
	   if (preg_match("/(?<year>[0-9]{4})-(?<month>[0-9]{1,2})-(?<day>[0-9]{1,2})/", $hit->metadata->publication_date, $matches))
	   {   
			$csl->issued->{'date-parts'}[0] = array(
				(Integer)$matches['year'],
				(Integer)$matches['month'],
				(Integer)$matches['day']
				);             
	   }

	   if (preg_match("/^(?<year>[0-9]{4})$/", $hit->metadata->publication_date, $matches))
	   {   
			$csl->issued->{'date-parts'}[0] = array(
				(Integer)$matches['year']
				);             
	   }
	   
	}		   

	// license
	if (isset($hit->metadata->license))
	{
		switch ($hit->metadata->license->id)
		{
			case 'CC-BY-4.0':
				$license = new stdclass;
				$license->URL = 'https://creativecommons.org/licenses/by/4.0/legalcode';
				$csl->license[] = $license;
				break;
				
			default:
				break;
		}
	
	}
	
	// pdf
	
	// abstract
	if (isset($hit->metadata->description))
	{
		$csl->abstract = strip_tags($hit->metadata->description);
	}
	

	//print_r($csl);
	
	$obj = json_decode($json);
	$work = new stdclass;
	$work->message = $csl;		

	//print_r($work);
	

	if ($work)
	{
		//echo csl_to_sql($work->message);
		
		if (1)
		{
	
			$source = array();
		
			$source[] = 'S248';
			$source[] = 'Q22661177'; // Zenodo
						
			$source[] = 'S854';
			$source[] = '"https://zenodo.org/record/' . $work->message->id  . '"';
		
			
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
	}
	

}



?>
