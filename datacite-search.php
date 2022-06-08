<?php

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

//----------------------------------------------------------------------------------------

$json = '{
    "data": [
        {
            "id": "10.20363/bzb-2021.70.1.063",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.1.063",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Jablonski, Daniel",
                        "nameType": "Personal",
                        "givenName": "Daniel",
                        "familyName": "Jablonski",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Masroor, Rafaqat",
                        "nameType": "Personal",
                        "givenName": "Rafaqat",
                        "familyName": "Masroor",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "First record of Eremias kakari Masroor et al., 2020 (Squamata: Lacertidae) for Afghanistan"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-02-26",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:C63D4510-C397-46D3-A3C9-FF57B6C9E0C9",
                        "relatedIdentifierType": "URN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "https://doi.org/10.20363/BZB-2020.70.1.001",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The presented paper reports on the first record of Eremias kakari Masroor, Khisroon, Khan, Jablonski, 2020 for Afghanistan based on morphological data obtained from one specimen stored for 49 years in the Zoological Research Museum Alexander Koenig, Bonn, Germany. Up to now, the species was known only from the type locality in Pakistani Balochistan.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/063_jablonski_masroor_20210226.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-12T11:58:30Z",
                "registered": "2021-08-12T11:58:43Z",
                "published": null,
                "updated": "2021-08-12T11:58:43Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2020.70.1.063",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2020.70.1.063",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Jablonski, Daniel",
                        "nameType": "Personal",
                        "givenName": "Daniel",
                        "familyName": "Jablonski",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Masroor, Rafaqat",
                        "nameType": "Personal",
                        "givenName": "Rafaqat",
                        "familyName": "Masroor",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "First record of Eremias kakari Masroor et al., 2020 (Squamata: Lacertidae) for Afghanistan"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-02-26",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:C63D4510-C397-46D3-A3C9-FF57B6C9E0C9",
                        "relatedIdentifierType": "URN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "https://doi.org/10.20363/BZB-2021.70.1.001",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The presented paper reports on the first record of Eremias kakari Masroor, Khisroon, Khan, Jablonski, 2020 for Afghanistan based on morphological data obtained from one specimen stored for 49 years in the Zoological Research Museum Alexander Koenig, Bonn, Germany. Up to now, the species was known only from the type locality in Pakistani Balochistan.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/063_jablonski_masroor_20210226.pdf",
                "contentUrl": null,
                "metadataVersion": 2,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-03-14T18:23:58Z",
                "registered": "2021-03-14T18:35:02Z",
                "published": null,
                "updated": "2021-08-12T11:57:32Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.1.051",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.1.051",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Saigusa, Toyohei",
                        "nameType": "Personal",
                        "givenName": "Toyohei",
                        "familyName": "Saigusa",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Sinclair, Bradley J.",
                        "nameType": "Personal",
                        "givenName": "Bradley J.",
                        "familyName": "Sinclair",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Revision of the Trichoclinocera yixianensis species-group from eastern Asia (Diptera: Empididae: Clinocerinae)"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:37C79C19-FAF6-4900-BB9B-7D43EC1AE371",
                        "relatedIdentifierType": "URN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "https://doi.org/10.20363/BZB-2020.70.1.001",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The Trichoclinocerayixianensis species-group from eastern Asia is revised and includes five species: T. emotoisp. nov., T. maculata sp. nov., T. nakanishii sp. nov., T. pakistanensis sp. nov. and T. yixianensis Li Yang, 2009. A key to all five species is provided and their distributions mapped.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/051_saigusa_sinclair_20210218.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-12T11:56:20Z",
                "registered": "2021-08-12T11:56:31Z",
                "published": null,
                "updated": "2021-08-12T11:56:31Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2020.70.1.051",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2020.70.1.051",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Saigusa, Toyohei",
                        "nameType": "Personal",
                        "givenName": "Toyohei",
                        "familyName": "Saigusa",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Sinclair, Bradley J.",
                        "nameType": "Personal",
                        "givenName": "Bradley J.",
                        "familyName": "Sinclair",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Revision of the Trichoclinocera yixianensis species-group from eastern Asia (Diptera: Empididae: Clinocerinae)"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:37C79C19-FAF6-4900-BB9B-7D43EC1AE371",
                        "relatedIdentifierType": "URN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "https://doi.org/10.20363/BZB-2021.70.1.001",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The Trichoclinocerayixianensis species-group from eastern Asia is revised and includes five species: T. emotoisp. nov., T. maculata sp. nov., T. nakanishii sp. nov., T. pakistanensis sp. nov. and T. yixianensis Li Yang, 2009. A key to all five species is provided and their distributions mapped.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/051_saigusa_sinclair_20210218.pdf",
                "contentUrl": null,
                "metadataVersion": 2,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-03-14T18:19:07Z",
                "registered": "2021-03-14T18:35:50Z",
                "published": null,
                "updated": "2021-08-12T11:55:22Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.1.001",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.1.001",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Ghiraldi1, Luca",
                        "nameType": "Personal",
                        "givenName": "Luca",
                        "familyName": "Ghiraldi1",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Carmignotto, Ana Paula",
                        "nameType": "Personal",
                        "givenName": "Ana Paula",
                        "familyName": "Carmignotto",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Tosetto, Vera",
                        "nameType": "Personal",
                        "givenName": "Vera",
                        "familyName": "Tosetto",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Ingleby, Sandy",
                        "nameType": "Personal",
                        "givenName": "Sandy",
                        "familyName": "Ingleby",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Eldridge, Mark D.B.",
                        "nameType": "Personal",
                        "givenName": "Mark D.B.",
                        "familyName": "Eldridge",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Revised catalogue of monotremes and marsupials in the historic mammal collection housed at Museo Regionale di Scienze Naturali of Torino, Italy"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [
                    {
                        "subject": "Ameridelphia"
                    },
                    {
                        "subject": "Australidelphia"
                    },
                    {
                        "subject": "Monotremata"
                    },
                    {
                        "subject": "Natural History Collections"
                    },
                    {
                        "subject": "Biodiversity"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-28",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:67213318-C4D5-4D11-A0F4-AEF7B416CA39",
                        "relatedIdentifierType": "URN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "https://doi.org/10.20363/BZB-2020.70.1.001",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The historic collection of the Museo di Zoologia and of the Museo di Anatomia Comparata of Torino University (Italy), now hosted at Museo Regionale di Scienze Naturali of Torino, contains almost 3000 mammal specimens, in addi-tion to 200 almost complete skeletons and an undefined number of skeletal units. The present work, which is part of a larg-er project whose aim is to make a complete revision of the specimens still present in the historic collection, was focused on the 135 specimens of monotremes and marsupials, mainly represented by mounted skins, flat skins, and osteological material composed of 12 skeletons and 32 skulls. The study allowed in addition to the implementation of a new revised catalogue, the update of the taxonomic nomenclature and a new determination of 32 specimens and 18 skeletal units. Overall, the monotremes and marsupials in the collection represent 58 species, with some of high scientific value; this is the case of some extinct species such as: Thylacine (Thylacinus cynocephalus Harris, 1808), Eastern Hare-Wallaby (La-gorchestes leporides (Gould, 1841)) and the Crescent Nailtail Wallaby (Onycogalea lunata (Gould, 1841)). Unfortunately, it was not possible to reach the species level with certainty for 28 specimens due to their bad state of preservation, the loss of the original labels, the lack of detailed collecting data or because of the juvenile or immature stage of development.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/001_ghiraldi_et_al_20210128.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-12T11:52:52Z",
                "registered": "2021-08-12T11:53:17Z",
                "published": null,
                "updated": "2021-08-12T11:53:17Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2020.70.1.001",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2020.70.1.001",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Ghiraldi1, Luca",
                        "nameType": "Personal",
                        "givenName": "Luca",
                        "familyName": "Ghiraldi1",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Carmignotto, Ana Paula",
                        "nameType": "Personal",
                        "givenName": "Ana Paula",
                        "familyName": "Carmignotto",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Tosetto, Vera",
                        "nameType": "Personal",
                        "givenName": "Vera",
                        "familyName": "Tosetto",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Ingleby, Sandy",
                        "nameType": "Personal",
                        "givenName": "Sandy",
                        "familyName": "Ingleby",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Eldridge, Mark D.B.",
                        "nameType": "Personal",
                        "givenName": "Mark D.B.",
                        "familyName": "Eldridge",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Revised catalogue of monotremes and marsupials in the historic mammal collection housed at Museo Regionale di Scienze Naturali of Torino, Italy"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [
                    {
                        "subject": "Ameridelphia"
                    },
                    {
                        "subject": "Australidelphia"
                    },
                    {
                        "subject": "Monotremata"
                    },
                    {
                        "subject": "Natural History Collections"
                    },
                    {
                        "subject": "Biodiversity"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-28",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:67213318-C4D5-4D11-A0F4-AEF7B416CA39",
                        "relatedIdentifierType": "URN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "https://doi.org/10.20363/BZB-2021.70.1.001",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The historic collection of the Museo di Zoologia and of the Museo di Anatomia Comparata of Torino University (Italy), now hosted at Museo Regionale di Scienze Naturali of Torino, contains almost 3000 mammal specimens, in addi-tion to 200 almost complete skeletons and an undefined number of skeletal units. The present work, which is part of a larg-er project whose aim is to make a complete revision of the specimens still present in the historic collection, was focused on the 135 specimens of monotremes and marsupials, mainly represented by mounted skins, flat skins, and osteological material composed of 12 skeletons and 32 skulls. The study allowed in addition to the implementation of a new revised catalogue, the update of the taxonomic nomenclature and a new determination of 32 specimens and 18 skeletal units. Overall, the monotremes and marsupials in the collection represent 58 species, with some of high scientific value; this is the case of some extinct species such as: Thylacine (Thylacinus cynocephalus Harris, 1808), Eastern Hare-Wallaby (La-gorchestes leporides (Gould, 1841)) and the Crescent Nailtail Wallaby (Onycogalea lunata (Gould, 1841)). Unfortunately, it was not possible to reach the species level with certainty for 28 specimens due to their bad state of preservation, the loss of the original labels, the lack of detailed collecting data or because of the juvenile or immature stage of development.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/001_ghiraldi_et_al_20210128.pdf",
                "contentUrl": null,
                "metadataVersion": 3,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-03-14T18:09:06Z",
                "registered": "2021-03-14T18:38:23Z",
                "published": null,
                "updated": "2021-08-12T07:30:20Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.1.221",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.1.221",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Mengual, Ximo",
                        "nameType": "Personal",
                        "givenName": "Ximo",
                        "familyName": "Mengual",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Ssymank, Axel",
                        "nameType": "Personal",
                        "givenName": "Axel",
                        "familyName": "Ssymank",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Psilota exilistyla Smit Vujić, 2008 (Diptera: Syrphidae), a new species for the German fauna"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "A new flower fly species for Germany is reported. Psilota exilistyla Smit Vujić, 2008 (Diptera: Syrphidae) is recorded from the Black Forest (Schwarzwald, Baden-Württemberg, south-west Germany). Published records of P. exilistyla are given in a distribution map.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/221_mengual_20210522.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T19:04:08Z",
                "registered": "2021-08-12T07:22:18Z",
                "published": null,
                "updated": "2021-08-12T07:22:18Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.1.201",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.1.201",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Le, Dzung Trung",
                        "nameType": "Personal",
                        "givenName": "Dzung Trung",
                        "familyName": "Le",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Luong, Anh Mai",
                        "nameType": "Personal",
                        "givenName": "Anh Mai",
                        "familyName": "Luong",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Pham, Cuong The",
                        "nameType": "Personal",
                        "givenName": "Cuong The",
                        "familyName": "Pham",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Phan, Tien Quang",
                        "nameType": "Personal",
                        "givenName": "Tien Quang",
                        "familyName": "Phan",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Nguyen, Son Lan Hung",
                        "nameType": "Personal",
                        "givenName": "Son Lan Hung",
                        "familyName": "Nguyen",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Ziegler, Thomas",
                        "nameType": "Personal",
                        "givenName": "Thomas",
                        "familyName": "Ziegler",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Nguyen, Truong Quang",
                        "nameType": "Personal",
                        "givenName": "Truong Quang",
                        "familyName": "Nguyen",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "New records and an updated checklist of amphibians and snakes from Tuyen Quang Province, Vietnam"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "We provide a checklist of 57 species of amphibians and 42 species of snakes from Tuyen Quang Province, northern Vietnam. Ten species of amphibians and five species of snakes were recorded for the first time from Tuyen Quang Province. Based on the new herpetological collection from this province we provide the descriptions of newly recorded species. The herpetofauna of Tuyen Quang Province contains a high level of conservation concern with four species endemic to Vietnam, eight species listed in the IUCN Red List, 16 species listed in the Red Data Book of Vietnam, three species listed in the Vietnam Governmental Decree No 06/2019/ND-CP, and three species listed in the CITES appendices.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/201_Le_et_al_20210526.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T19:07:21Z",
                "registered": "2021-08-12T07:21:56Z",
                "published": null,
                "updated": "2021-08-12T07:21:56Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.1.173",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.1.173",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Handfield, Louis",
                        "nameType": "Personal",
                        "givenName": "Louis",
                        "familyName": "Handfield",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Handfield, Daniel",
                        "nameType": "Personal",
                        "givenName": "Daniel",
                        "familyName": "Handfield",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "A revision of the Canadian species of the Genus Herpetogramma Lederer, 1863 (Lepidoptera: Crambidae: Spilomelinae: Herpetogrammatini), with descriptions of three new species"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The genus Herpetogramma Lederer in Canada is revised to include ten species of which three are new: H. aqui- lonalis sp. n., H. fraxinalis sp. n., and H. nymphalis sp. n. Keys to the Canadian species of Herpetogramma are includ-ed as well as descriptions, distribution, biology and illustrations of adults and genitalia. Herpetogramma abdominalis (Zell.,1872) syn. n. and H. fissalis (Grt., 1881) syn. n. are synonymized with H. thestealis (Walker, 1859) here.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/173_handfield_20210513.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T19:08:51Z",
                "registered": "2021-08-12T07:21:15Z",
                "published": null,
                "updated": "2021-08-12T07:21:15Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.1.141",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.1.141",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Wagner, Philipp",
                        "nameType": "Personal",
                        "givenName": "Philipp",
                        "familyName": "Wagner",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Ihlow, Flora",
                        "nameType": "Personal",
                        "givenName": "Flora",
                        "familyName": "Ihlow",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Hartmann, Timo",
                        "nameType": "Personal",
                        "givenName": "Timo",
                        "familyName": "Hartmann",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "FleMorriscks, Morris",
                        "nameType": "Personal",
                        "givenName": "Morris",
                        "familyName": "FleMorriscks",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Schmitz, Andreas",
                        "nameType": "Personal",
                        "givenName": "Andreas",
                        "familyName": "Schmitz",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Böhme, Wolfgang",
                        "nameType": "Personal",
                        "givenName": "Wolfgang",
                        "familyName": "Böhme",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Integrative approach to resolve the Calotes mystaceus Duméril Bibron, 1837 species complex (Squamata: Agamidae)"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The genus Calotes Cuvier, 1816 “1817” currently contains 25 species, which are widely distributed in Asia and have been introduced in Africa and America. The genus includes several species complexes, for example, Calotes versicolor and Calotes mystaceus. The latter was partly resolved by describing Calotes bachae as a distinct species, but it became obvious that C. mystaceus still consists of several lineages. This study was done to resolve those lineages and we herein restrict Calotes mystaceus to southern coastal Myanmar, while describing three new species occurring in Cambo-dia, China, Laos, Myanmar, Thailand, and India. The new species are distinguishable from each other by male coloration with C. goetzi sp. n. having prominent dark brown dorsolateral blotches, C. geissleri sp. n. having orange to light brown blotches and a whitish stripe from snout-tip to hind limb insertion and C. vindumbarbatus sp. n. having a whitish stripe from tip of snout continuing to beyond limb insertion. Mean uncorrected p-distances for COI between C. mystaceus and other taxa are: C. goetzi sp. n. (=0.0603); C. vindumbarbatus sp. n. (=0.0656) and C. bachae (=0.1415). Mean uncorrec-ted p-distances for 12S between C. mystaceus and other taxa are: C. goetzi sp. n. (=0.0291), C. vindumbarbatus sp. n. (=0.0375), C. bachae (=0.0548) and C. geissleri sp. n. (=0.0457).",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/141_wagner_et_al_20210507.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T19:10:22Z",
                "registered": "2021-08-12T07:20:52Z",
                "published": null,
                "updated": "2021-08-12T07:20:52Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.1.115",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.1.115",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Przybycień, Maja",
                        "nameType": "Personal",
                        "givenName": "Maja",
                        "familyName": "Przybycień",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Lachowska-Cierlik, Dorota",
                        "nameType": "Personal",
                        "givenName": "Dorota",
                        "familyName": "Lachowska-Cierlik",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Wacławik, Beniamin",
                        "nameType": "Personal",
                        "givenName": "Beniamin",
                        "familyName": "Wacławik",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Sprick, Peter",
                        "nameType": "Personal",
                        "givenName": "Peter",
                        "familyName": "Sprick",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Stanisław, Knutelsk",
                        "nameType": "Personal",
                        "givenName": "Knutelsk",
                        "familyName": "Stanisław",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "The species status of the Otiorhynchus clavipes(Bonsdorff, 1785) species group (Coleoptera: Curculionidae): an integrative approach using molecular, morphological, ecological, and biogeographical data"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The species of the Otiorhynchus clavipes (Bonsdorff, 1785) group (Coleoptera: Curculionidae) treated here, are characterized by their unusually high phenotypical variation, which often caused taxonomic problems and controversies. Molecular markers COI and EF1-α, karyological analysis, as well as morphological, biogeographical and ecological data are used to study weevils collected in the Alps, Carpathians, Sudetes and different areas of Germany. In the investigated populations of the flightless species O. fagi Gyllenhal, 1834 and O. clavipes, we detected an interspecific genetic distance of 11.3–15.8% (COI) and 3.1–3.7% (EF1-α) depending on geographical distance. The phylogenetic trees indicate that both species are monophyletic and that they were correctly delimited from each other. Both species have also separate geographical ranges in Central Europe. Male specimens differ in the morphology of the aedeagus and the last abdominal sternite. Our study supports the legitimacy of species delimitation of O. fagi and O. clavipes as separate species, which can be treated as stable taxonomic hypotheses. The determination of the species status required the re-examination of spe-cies ranges and allowed together with data on biology and altitudinal preferences a better biogeographical and ecological characterization of the species.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/115_knutelski_et_al_20210408.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T19:11:48Z",
                "registered": "2021-08-12T07:20:20Z",
                "published": null,
                "updated": "2021-08-12T07:20:20Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.1.097",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.1.097",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Gębicki, Cezary",
                        "nameType": "Personal",
                        "givenName": "Cezary",
                        "familyName": "Gębicki",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Walczak, Marcin",
                        "nameType": "Personal",
                        "givenName": "Marcin",
                        "familyName": "Walczak",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Krupa, Piotr",
                        "nameType": "Personal",
                        "givenName": "Piotr",
                        "familyName": "Krupa",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Kalandyk-Kołodziejczyk, Małgorzata",
                        "nameType": "Personal",
                        "givenName": "Małgorzata",
                        "familyName": "Kalandyk-Kołodziejczyk",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Ugyopini of New Caledonia (Hemiptera: Fulgoromorpha: Delphacidae: Asiracinae) with a description of Notuchus linnavuoriisp. nov."
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The paper presents information about species of Ugyopini, Fennah, 1979 from New Caledonia. One new spe-cies from New Caledonia is described, Notuchus linnavuorii sp. nov., with notes on the morphological details of selected external structures. An identification key to all of the species of Notuchus Fennah, 1969 and a checklist of the species of this genus are also provided. The male terminalia of three species of the genus Ugyops Guérin-Méneville, 1834 (U. inermis Distant, 1920, U. nemestrinus Fennah, 1969 and U. taranis Fennah, 1964) are described and illustrated for the first time.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/097_gebicki_et_al_20210408.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T19:13:10Z",
                "registered": "2021-08-12T07:19:57Z",
                "published": null,
                "updated": "2021-08-12T07:19:57Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.1.085",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.1.085",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Stuke, Jens-Hermann",
                        "nameType": "Personal",
                        "givenName": "Jens-Hermann",
                        "familyName": "Stuke",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "New European species of Athyroglossa Loew, 1860 (Diptera: Ephydridae) from Finland and the Republic of Georgia"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "Athyroglossa (Athyroglossa) fennica spec. nov. (Finland) and Athyroglossa (Athyroglossa) kuraensis spec. nov. (Georgia) are described. A key to European species of Athyroglossa is presented. The male terminalia and sternites 3–5 of all European species are illustrated.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/085_stuke_20210408.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T19:14:34Z",
                "registered": "2021-08-12T07:19:27Z",
                "published": null,
                "updated": "2021-08-12T07:19:27Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.1.067",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.1.067",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Barták, Miroslav",
                        "nameType": "Personal",
                        "givenName": "Miroslav",
                        "familyName": "Barták",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Akbar, Shahid Ali",
                        "nameType": "Personal",
                        "givenName": "Shahid Ali",
                        "familyName": "Akbar",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Kanturski, Mariusz",
                        "nameType": "Personal",
                        "givenName": "Mariusz",
                        "familyName": "Kanturski",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Wachkoo, Aijaz Ahmad",
                        "nameType": "Personal",
                        "givenName": "Aijaz Ahmad",
                        "familyName": "Wachkoo",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Maqbool, Amir",
                        "nameType": "Personal",
                        "givenName": "Amir",
                        "familyName": "Maqbool",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "SEM morphology and courtship rituals of a new species of Rhamphomyia (Diptera: Empididae: Empidinae) from the Kashmir Himalayas (India)"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "Rhamphomyia bhagati Barták, Akbar, Kanturski, Wachkoo Maqbool sp. nov. (Diptera: Empididae) is described and illustrated based on male and female specimens. The discovery marks the first record of the genus Rhamphomyia from the Kashmir Valley. Scanning Electron Microscopy (SEM) analysis was carried out to elucidate the general morphology and sensilla of the male and female specimens. The species is most prevalent during April and early May. The male provides female with a nutritious prey, as a courtship gift through a series of rituals discussed herewith.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/067_bartak_20210408.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T19:16:20Z",
                "registered": "2021-08-12T07:19:08Z",
                "published": null,
                "updated": "2021-08-12T07:19:08Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.2.227",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.2.227",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Wachkoo, Aijaz Ahmad",
                        "nameType": "Personal",
                        "givenName": "Aijaz Ahmad",
                        "familyName": "Wachkoo",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Bharti, Himender",
                        "nameType": "Personal",
                        "givenName": "Himender",
                        "familyName": "Bharti",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Akbar, Shahid Ali",
                        "nameType": "Personal",
                        "givenName": "Shahid Ali",
                        "familyName": "Akbar",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Taxonomic review of the ant genus Lepisiota Santschi, 1926 (Hymenoptera: Formicidae: Formicinae) from India"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The species-rank taxonomy of the genus Lepisiota Santschi, 1926 in India is revised. Thirteen species are re-cognized, with two described as new: L. layla sp. n. and L. mayri sp. n. The three previously infraspecific taxa L. integra stat. nov., L. pulchella stat. rev. and L. wroughtonii stat. rev. are elevated to species rank. Four species or subspecies are excluded from the Indian Lepisiota fauna: L. capensis (Mayr, 1862), L. frauenfeldi (Mayr, 1855), L. rothneyi watsonii (Forel, 1894), and L. simplex (Forel, 1892) for issues related to previous doubtful distribution or species misidentifcation. An identification key to the worker caste of Indian Lepisiota species is provided.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_2/227_wachkoo_20210625.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T20:40:46Z",
                "registered": "2021-08-12T07:17:23Z",
                "published": null,
                "updated": "2021-08-12T07:17:23Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.2.247",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.2.247",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Pham, Phu Van",
                        "nameType": "Personal",
                        "givenName": "Phu Van",
                        "familyName": "Pham",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Kon, Masahiro",
                        "nameType": "Personal",
                        "givenName": "Masahiro",
                        "familyName": "Kon",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Pham, Nhi Thi",
                        "nameType": "Personal",
                        "givenName": "Nhi Thi",
                        "familyName": "Pham",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Cao, Nga Quynh Thi",
                        "nameType": "Personal",
                        "givenName": "Nga Quynh Thi",
                        "familyName": "Cao",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Vu, Tru Hoang",
                        "nameType": "Personal",
                        "givenName": "Tru Hoang",
                        "familyName": "Vu",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "A review of the genus Leptaulax Kaup, 1868 (Coleoptera: Passalidae) from Vietnam, with the first record of L. loebli Kon, Johki Araya, 2003"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "This overview of the passalid genus Leptaulax Kaup, 1868 in Vietnam is based on literature and examined specimens. A total of six species is recorded, of which Leptaulax loebli Kon, Johki Araya, 2003 is recorded for the first time for the fauna of Vietnam. An identification key to all Vietnamese Leptaulax species is provided.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_2/247_pham_et_al_20210625.pdf",
                "contentUrl": null,
                "metadataVersion": 2,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T20:45:10Z",
                "registered": "2021-08-12T07:16:58Z",
                "published": null,
                "updated": "2021-08-12T07:16:58Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.2.253",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.2.253",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Amr, Zuhair S.",
                        "nameType": "Personal",
                        "givenName": "Zuhair S.",
                        "familyName": "Amr",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Alenezi, Abdulrahman Al-Sirhan",
                        "nameType": "Personal",
                        "givenName": "Abdulrahman Al-Sirhan",
                        "familyName": "Alenezi",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Al-Sayegh, Mohammed T.",
                        "nameType": "Personal",
                        "givenName": "Mohammed T.",
                        "familyName": "Al-Sayegh",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Abu Baker, Mohammad",
                        "nameType": "Personal",
                        "givenName": "Mohammad",
                        "familyName": "Abu Baker",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Reptiles and amphibians of the State of Kuwait"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "In this study, we identified the diversity of the freshwater, marine and terrestrial herpetofauna of the State of Kuwait. It consists of a total of 45 extant species; 44 species of reptiles and a single species of amphibian according to recent updated taxonomic studies. All specimens of reptiles collected and held in American and European natural history museums are documented. Four species are added to the herpetofauna of Kuwait: Chalcides ocellatus, Hydrophis lapemoides, Hydrophis viperina, and Trapelus agnetae.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_2/253_amr_et_al_20210625.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T20:49:30Z",
                "registered": "2021-08-12T07:15:59Z",
                "published": null,
                "updated": "2021-08-12T07:15:59Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.2.273",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.2.273",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Mabrouki, Youness",
                        "nameType": "Personal",
                        "givenName": "Youness",
                        "familyName": "Mabrouki",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Taybi, Abdelkhaleq Fouzi",
                        "nameType": "Personal",
                        "givenName": "Abdelkhaleq Fouzi",
                        "familyName": "Taybi",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Glöer, Peter",
                        "nameType": "Personal",
                        "givenName": "Peter",
                        "familyName": "Glöer",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Further records of freshwater Gastropods (Mollusca: Hydrobiidae, Lymnaeidae, Planorbidae) from Morocco"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "Galba oblonga (Puton, 1847), Stagnicola fuscus (Pfeiffer, 1821) and Ancylus striatus Quoy Gaimard, 1834 are reported for the first time in North Africa, while Mercuria globulina (Letourneux Bourguignat, 1887) is new to Morocco. In addition, we provide new distributional data on the two Moroccan endemic and recently described species Aghbalia aghbalensis Glöer, Mabrouki Taybi, 2020 and Mercuria bakeri Glöer, Boeters Walther, 2015 known previ-ously from the type localities only, which is a key element in promoting their conservation.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_2/273_mabroucki_et_al_20210705.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T21:25:43Z",
                "registered": "2021-08-12T07:15:25Z",
                "published": null,
                "updated": "2021-08-12T07:15:25Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.2.281",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.2.281",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Bugaj-Nawrocka, Agnieszka",
                        "nameType": "Personal",
                        "givenName": "Agnieszka",
                        "familyName": "Bugaj-Nawrocka",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Junkiert, Łukasz",
                        "nameType": "Personal",
                        "givenName": "Łukasz",
                        "familyName": "Junkiert",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Kalandyk-Kołodziejczyk, Małgorzata",
                        "nameType": "Personal",
                        "givenName": "Małgorzata",
                        "familyName": "Kalandyk-Kołodziejczyk",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Wieczorek, Karina",
                        "nameType": "Personal",
                        "givenName": "Karina",
                        "familyName": "Wieczorek",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Scale insects (Hemiptera: Coccomorpha) in the entomological collection of the Zoology Research Group, University of Silesia in Katowice (DZUS), Poland"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "Information about the scientific collections is made available more and more often. The digitisation of such resources allows us to verify their value and share these records with other scientists – and they are usually rich in taxa and unique in the world. Moreover, such information significantly enriches local and global knowledge about biodiversi-ty. The digitisation of the resources of the Zoology Research Group, University of Silesia in Katowice (Poland) allowed presenting a substantial collection of scale insects (Hemiptera: Coccomorpha). The collection counts 9369 slide-mounted specimens, about 200 alcohol-preserved samples, close to 2500 dry specimens stored in glass vials and 1319 amber inclusions representing 343 taxa (289 identified to species level), 158 genera and 36 families (29 extant and seven extinct). A significant part is the collection of an outstanding Polish coccidologist, Professor Jan Koteja. The geographical analysis of the scale insects collected shows mainly Eurasian areas, but there is also material from North America, South America, as well as Africa and New Zealand.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_2/281_bugaj-nawrocka_et_al_20210705.pdf",
                "contentUrl": null,
                "metadataVersion": 2,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T21:29:43Z",
                "registered": "2021-08-12T07:14:43Z",
                "published": null,
                "updated": "2021-08-12T07:14:43Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.2.317",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.2.317",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Volynkin, Anton V.",
                        "nameType": "Personal",
                        "givenName": "Anton V.",
                        "familyName": "Volynkin",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Contribution to the knowledge of the genus Thumatha Walker, 1866 (Lepidoptera: Erebidae: Arctiinae) from Africa with descriptions of four new species"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:8B4F0351-C374-41D2-BC14-CAE2CDCE4ECF",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The present paper contains descriptions of four new species of the genus Thumatha Walker, 1866: T. ngewo sp. n. (Liberia, Guinea and Ivory Coast), T. smithi sp. n. (Zambia), T. kuehnei sp. n. (Zambia) and T. jiwundu sp. n. (Zam-bia). The hitherto unknown female of T. punctata Kühne, 2010 is illustrated and described. Thumatha punctata is reported for the first time from Zambia and T. lunaris Durante, 2007 is reported for the first time from Cameroon and South Sudan. Adults together with male and female genitalia of the new and similar species are illustrated.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_2/317_volynkin_20210717.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T21:33:41Z",
                "registered": "2021-08-12T07:14:01Z",
                "published": null,
                "updated": "2021-08-12T07:14:01Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.2.333",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.2.333",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Volynkin, Anton",
                        "nameType": "Personal",
                        "givenName": "Anton",
                        "familyName": "Volynkin",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Gyula, M. László",
                        "nameType": "Personal",
                        "givenName": "M. László",
                        "familyName": "Gyula",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Kruegerilema, a new genus for a new species endemic to São Tomé Island (Lepidoptera: Erebidae: Arctiinae: Lithosiini)"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub::CE2FA6EF-F33B-4542-844D-992169C85D2E",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The present paper contains a description of the new genus Kruegerilema gen. nov. which is erected for the new species Kruegerilema smithi sp. nov. endemic to São Tomé Island. The diagnostic comparison is made with the genus Brunia Moore, 1878. Adults together with male and female genitalia of the new and similar genus are illustrated.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_2/333_volynkin_laszlo_20210717.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-08-11T21:37:31Z",
                "registered": "2021-08-12T07:13:15Z",
                "published": null,
                "updated": "2021-08-12T07:13:15Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2020.70.1.015",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2020.70.1.015",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Junkiert, Łukasz",
                        "nameType": "Personal",
                        "givenName": "Łukasz",
                        "familyName": "Junkiert",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Walczak, Marcin",
                        "nameType": "Personal",
                        "givenName": "Marcin",
                        "familyName": "Walczak",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Bugaj-Nawrocka, Agnieszka",
                        "nameType": "Personal",
                        "givenName": "Agnieszka",
                        "familyName": "Bugaj-Nawrocka",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Four new species of the Madagascan genus Exphora Signoret, 1860 (Auchenorrhyncha: Fulgoromorpha: Tropiduchidae: Elicini) with comments on some hitherto undescribed ultrastructural characters"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "https://doi.org/10.20363/bzb-2021.70.1.015",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "Four new species of the Madagascan genus Exphora Signoret, 1860 (Hemiptera: Fulgoromorpha: Tropiduchi-dae) are described: E. bourgoini sp. nov., E. kalalaoensis sp. nov., E. angustivenosa sp. nov. and E. robusta sp. nov. Also, a new, green colour form of E. linnavuorii Junkiert, Walczak Bourgoin, 2017 is presented. The male and female geni-talia of the new species are illustrated. SEM photos of the head, antennae and their sensilla, legs, as well as the fore and hind wings are given. A number of structures, which were previously unknown or undescribed, are discussed, including the compound eye with trichoid sensilla, the sensory plate organ on the antennal pedicel surface, the fore and hind wings hamuli, the area of microtrichia at the costa posterior of the fore wing, the tegula, the postcubitus bulla, the third coxa with coxal protrusion and the spines of tibia. A distribution map of the newly described species and an illustrated key to all Exphora species are provided",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/015_junkiert_et_al_20210128.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-03-14T18:47:41Z",
                "registered": "2021-03-14T18:47:59Z",
                "published": null,
                "updated": "2021-03-14T18:47:59Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2021.70.1.015",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2021.70.1.015",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Junkiert, Łukasz",
                        "nameType": "Personal",
                        "givenName": "Łukasz",
                        "familyName": "Junkiert",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Walczak, Marcin",
                        "nameType": "Personal",
                        "givenName": "Marcin",
                        "familyName": "Walczak",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Bugaj-Nawrocka, Agnieszka",
                        "nameType": "Personal",
                        "givenName": "Agnieszka",
                        "familyName": "Bugaj-Nawrocka",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Four new species of the Madagascan genus Exphora Signoret, 1860 (Auchenorrhyncha: Fulgoromorpha: Tropiduchidae: Elicini) with comments on some hitherto undescribed ultrastructural characters"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2021,
                "subjects": [],
                "contributors": [],
                "dates": [
                    {
                        "date": "2021-01-29",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F935124B-7308-4734-94A3-22CEA19942E2",
                        "relatedIdentifierType": "URN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "https://doi.org/10.20363/bzb-2020.70.1.015",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "Four new species of the Madagascan genus Exphora Signoret, 1860 (Hemiptera: Fulgoromorpha: Tropiduchi-dae) are described: E. bourgoini sp. nov., E. kalalaoensis sp. nov., E. angustivenosa sp. nov. and E. robusta sp. nov. Also, a new, green colour form of E. linnavuorii Junkiert, Walczak Bourgoin, 2017 is presented. The male and female geni-talia of the new species are illustrated. SEM photos of the head, antennae and their sensilla, legs, as well as the fore and hind wings are given. A number of structures, which were previously unknown or undescribed, are discussed, including the compound eye with trichoid sensilla, the sensory plate organ on the antennal pedicel surface, the fore and hind wings hamuli, the area of microtrichia at the costa posterior of the fore wing, the tegula, the postcubitus bulla, the third coxa with coxal protrusion and the spines of tibia. A distribution map of the newly described species and an illustrated key to all Exphora species are provided",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_70_1/015_junkiert_et_al_20210128.pdf",
                "contentUrl": null,
                "metadataVersion": 2,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2021-03-14T18:14:10Z",
                "registered": "2021-03-14T18:41:03Z",
                "published": null,
                "updated": "2021-03-14T18:46:29Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2019.68.2.183",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2019.68.2.183",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Breitling, Rainer",
                        "nameType": "Personal",
                        "givenName": "Rainer",
                        "familyName": "Breitling",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    }
                ],
                "titles": [
                    {
                        "title": "Euophrys petrensis C. L. Koch, 1837, is a genuine member of the genus Talavera (Araneae: Salticidae)"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2019,
                "subjects": [
                    {
                        "subject": "Araneae"
                    },
                    {
                        "subject": "DNA barcoding"
                    },
                    {
                        "subject": "phylogenetic systematics"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-01-28",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:F0246630-F65F-4FF1-BF4E-008D483BDA2C",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "lang": null,
                        "description": "The small jumping spider Euophrys petrensis C. L. Koch, 1837, combines morphological characters of both Euophrys s. str. and Talavera, and its generic placement has consequently been contentious. After many years of being placed in Talavera, the species has recently been transferred back to Euophrys. Here, public DNA barcoding data are used to confirm that the species should be placed in the genus Talavera, as T. petrensis, stat. rev., as is also indicated by several putative morphological synapomorphies identified earlier.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "http://zoologicalbulletin.de/BzB_Volumes/Volume_68_2/183_breitling_20190902.pdf",
                "contentUrl": null,
                "metadataVersion": 2,
                "schemaVersion": null,
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2019-09-05T08:16:06.000Z",
                "registered": "2019-09-05T08:16:41.000Z",
                "published": "2019",
                "updated": "2020-07-29T23:59:38.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2019.68.1.167",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2019.68.1.167",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Mey, Eberhard",
                        "nameType": "Personal",
                        "givenName": "Eberhard",
                        "familyName": "Mey",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Parasitic on bird or mammal? Echinopon monounguiculatum gen. nov., spec. nov, representative of a new family (Echinoponidae fam. nov.) in the Amblycera (Insecta: Psocodea: Phthiraptera)"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2019,
                "subjects": [
                    {
                        "subject": "Amblycera"
                    },
                    {
                        "subject": "morphology"
                    },
                    {
                        "subject": "taxonomy"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-09-02",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:839E82AA-0807-47C1-B21E-C5DE2098C146",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "lang": null,
                        "description": "On the study skin of a Bornean Black Magpie Platysmurus aterrimus (Passeriformes, Corvidae) collected in 1888, stored in the collection of the Museum für Tierkunde [Zoological Museum] Dresden, a female specimen of a pha-rate amblyceran third instar larva was found. The possibility that the larva originally lived on this bird can be definitively excluded, therefore it can only be considered as a straggler from an unknown host species. Its morphology showed a com-bination of unusual characters that differentiates the specimen from all other known Amblycera, but that does place it close to the Menoponidae sensu lato. The insect, measuring only 1.32 mm in length, is characterized dorsally by stiff spine-like setae on thorax and abdomen, and can be placed close to a menoponoid-style habitus by the following autapomorphies that form the basis for the erection of Echinoponidae fam. nov.: 1. A blunt, curved cutaneous bulge on both sides of the labrum equipped with three sturdy setae on each side, whose function (apart from possible movement coordination) is unknown. – 2. A respiration system with tiny stigmata and tracheae, apparently without a post-spiracular setal complex at each end of the central abdominal tergites. – 3. Coxa I is rounded, not elongated anteroposteriorly as in all avian Amblycera. – 4. All three pairs of legs have only a single long apically curved, basally humped claw. A small euplantula sits apically opposite the second, only slightly smaller, first tarsal segment while the tarsus sole is equipped with two rows of adhesive pads (?) and two setae pairs. Single-clawed Amblycera are only known from Neotropical mammals. – 5. Dorsally and ventrally, head, thorax, and abdomen setae depart in many details from previously known chaetotaxies, (e.g.) ventral femur III has setal combs (ctenidia) with three rows, on each side of abdominal segment II they have two rows, and on segments III to VIII one row on each (ctenidia are absent in all mammal-infesting Amblycera and in avian Amblycera are unknown in such an excessive development); abdominal macrochaetae present only ventrally with one pair on each side of segment II and two pairs on segments VIII and IX. – 6. The female probably lacks the anal corona of setae typical of Menoponidae.These characters, and the circumstances of the discovery of the specimen (with a record of a goniodoid ischnoceran, also a straggler, on the same skin), allow us to make the simple decision as to whether the enigmatic Single-clawed Spiny Amblyceran Echinopon monounguiculatum gen. nov., spec. nov. is an avian or a mammalian amblyceran.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "http://www.zoologicalbulletin.de/BzB_Volumes/Volume_68_1/167_mey_20190718.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": null,
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2019-09-02T21:36:47.000Z",
                "registered": "2019-09-02T21:37:02.000Z",
                "published": "2019",
                "updated": "2020-07-29T23:50:11.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2019.68.1.163",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2019.68.1.163",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Sinclair, Bradley J.",
                        "nameType": "Personal",
                        "givenName": "Bradley J.",
                        "familyName": "Sinclair",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Shamshev, Igor V.",
                        "nameType": "Personal",
                        "givenName": "Igor V.",
                        "familyName": "Shamshev",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Atlanta astigmatica Stackelberg, a new synonym of Wiedemannia lota Walker (Diptera: Empididae: Clinocerinae)"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2019,
                "subjects": [
                    {
                        "subject": "Turkmenistan"
                    },
                    {
                        "subject": "dance flies"
                    },
                    {
                        "subject": "Palaearctic"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-09-02",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:839E82AA-0807-47C1-B21E-C5DE2098C146",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "lang": null,
                        "description": "An uncatalogued species of Empididae, Atalanta (Philolutra) astigmatica Stackelberg, 1937 was recently dis-covered. This species is a new synonym of Wiedemannia lota Walker, 1851.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "http://www.zoologicalbulletin.de/BzB_Volumes/Volume_68_1/163_sinclair_20190701.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": null,
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2019-09-02T21:33:17.000Z",
                "registered": "2019-09-02T21:34:09.000Z",
                "published": "2019",
                "updated": "2020-07-29T23:50:11.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2019.68.1.125",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2019.68.1.125",
                "identifiers": [],
                "creators": [
                    {
                        "name": "van Steenis, Jeroen van",
                        "nameType": "Personal",
                        "givenName": "Jeroen van",
                        "familyName": "van Steenis",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "van Zuijen, Menno P.",
                        "nameType": "Personal",
                        "givenName": "Menno P.",
                        "familyName": "van Zuijen",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "van Steenis, Wouter",
                        "nameType": "Personal",
                        "givenName": "Wouter",
                        "familyName": "van Steenis",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Makris, Christodoulos",
                        "nameType": "Personal",
                        "givenName": "Christodoulos",
                        "familyName": "Makris",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "van Eck, André",
                        "nameType": "Personal",
                        "givenName": "André",
                        "familyName": "van Eck",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Mengual, Ximo",
                        "nameType": "Personal",
                        "givenName": "Ximo",
                        "familyName": "Mengual",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "Hoverflies (Diptera: Syrphidae) of Cyprus: results from a collecting trip in October 2017"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2019,
                "subjects": [
                    {
                        "subject": "Hoverfly"
                    },
                    {
                        "subject": "Cyprus"
                    },
                    {
                        "subject": "faun. nov."
                    },
                    {
                        "subject": "DNA"
                    },
                    {
                        "subject": "ecology"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-09-02",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:839E82AA-0807-47C1-B21E-C5DE2098C146",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "lang": null,
                        "description": "In October 2017 an international expedition to Cyprus was made in order to collect hoverflies (Diptera: Syrphidae) and to improve knowledge of the local fauna. In twelve days, numerous localities were visited in a wide range of habitats, where Syrphidae were collected by hand net. Malaise and pan traps were placed in some sam-pling localities around the Troodos Mountains. In total, 52 Syrphidae species were collected, 23 of which represent new species records for the island and another three belong to undescribed taxa. Newly obtained DNA data from the genera Merodon and Ceriana indicate a large interspecific morphological variation within Merodon sp. nov. 1 and support the recent split of C. glaebosa Van Steenis Ricarte, 2016 from C. vespiformis (Latreille, 1809).",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "http://www.zoologicalbulletin.de/BzB_Volumes/Volume_68_1/125_steenis_20190701.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": null,
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2019-09-02T21:27:56.000Z",
                "registered": "2019-09-02T21:28:41.000Z",
                "published": "2019",
                "updated": "2020-07-29T23:50:10.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2019.68.1.147",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2019.68.1.147",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Sharma, Bhushan Kumar",
                        "nameType": "Personal",
                        "givenName": "Bhushan Kumar",
                        "familyName": "Sharma",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Sharma, Sumita",
                        "nameType": "Personal",
                        "givenName": "Sumita",
                        "familyName": "Sharma",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "The biodiverse rotifers (Rotifera: Eurotatoria) of Northeast India: faunal heterogeneity, biogeography, richness in diverse ecosystems and interesting species assemblages"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2019,
                "subjects": [
                    {
                        "subject": "Biodiversity"
                    },
                    {
                        "subject": "distribution"
                    },
                    {
                        "subject": "important taxa"
                    },
                    {
                        "subject": "species assemblages"
                    },
                    {
                        "subject": "Rotifera paradox"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-09-02",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:839E82AA-0807-47C1-B21E-C5DE2098C146",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "lang": null,
                        "description": "The biodiverse Rotifera of northeast India (NEI) revealed 303 species belonging to 53 genera and 24 families; ~96% of these species examined from seven states of NEI affirm the rotifer heterogeneity of our plankton and semi-plank-ton collections. This study documents the record number of species of global and regional biogeographic interest, high-lights affinity with Southeast Asian and Australian faunas, and indicates notable heterogeneity in richness and composition amongst the seven northeastern states. The speciose rotifers of small lentic biotopes of Arunachal Pradesh, Mizoram, Nagaland, Meghalaya, Manipur and Tripura, the floodplain lakes (beels) and small wetlands (dobas and dubies) of the Brahmaputra and the Barak floodplains of Assam, and the floodplain lakes (pats) of Manipur are noteworthy. Deepor Beel and Loktak Lake (two Ramsar sites) are the globally rich rotifer `hotspots’. Interesting assemblages per sample of 80+ species in certain beels and pats, and up to 50 species in dobas and dubies depict the `Rotifera paradox’. The most diverse and interesting Rotifera of NEI, than any other region of India, is attributed to habitat and ecosystem heterogeneity of wa-ter bodies spread over varied ecological regimes, the location of the region in the Himalayan and Indo-Burma Biodiversity hotspots, vital biogeographic corridor of \'the Assam gateway\', \'the rotiferologist effect and the sampling intensity. Our study marks a valuable contribution to biodiversity and biogeography of the Indian, Asian and Oriental Rotifera.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "http://www.zoologicalbulletin.de/BzB_Volumes/Volume_68_1/147_sharma_sharma_20190701.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": null,
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2019-09-02T21:20:46.000Z",
                "registered": "2019-09-02T21:21:06.000Z",
                "published": "2019",
                "updated": "2020-07-29T23:50:07.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2019.68.1.097",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2019.68.1.097",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Bouarakia, Oussama",
                        "nameType": "Personal",
                        "givenName": "Oussama",
                        "familyName": "Bouarakia",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Denys, Christiane",
                        "nameType": "Personal",
                        "givenName": "Christiane",
                        "familyName": "Denys",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Nicolas, Violaine",
                        "nameType": "Personal",
                        "givenName": "Violaine",
                        "familyName": "Nicolas",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Benazzou, Touria",
                        "nameType": "Personal",
                        "givenName": "Touria",
                        "familyName": "Benazzou",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Benhoussa, Abdelaziz",
                        "nameType": "Personal",
                        "givenName": "Abdelaziz",
                        "familyName": "Benhoussa",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    }
                ],
                "titles": [
                    {
                        "title": "Biogeographic history of Gerbillus campestris (Rodentia, Muridae) in Morocco as revealed by morphometric and genetic data"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2019,
                "subjects": [
                    {
                        "subject": "North Africa"
                    },
                    {
                        "subject": "cytochrome b gene"
                    },
                    {
                        "subject": "craniometry"
                    },
                    {
                        "subject": "populations"
                    },
                    {
                        "subject": "Gerbillinae"
                    },
                    {
                        "subject": "agriculture"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-06-13",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:B119E34D-9E27-47EF-99A0-051ABA0E8268",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "lang": null,
                        "description": "Gerbillus campestris is a widely distributed small rodent that lives in various habitats in North Africa and can be a potential agricultural pest. We conducted a biogeographic study of this species with an integrative approach using mor-phometric data from body and craniomandibular distances and molecular genetic data from the cytochrome b gene of the mitochondrial DNA. We collected 96 individuals in six localities from central, northern and eastern Morocco. Data from 18 morphological characters were used in multivariate statistical analyses and molecular data were analysed using maxi-mum likelihood and median-joining networks. Our analyses confirmed the high morphological variability in this species and allowed to discriminate four groups containing the studied populations. We found that a few craniomandibular measu-rements had the highest contribution in the differences between populations, and that this variability reflected a spatial and environmental differentiation. In the genetic analyses, we placed our six populations and six individuals from four other countries in nine previously identified phylogenetic lineages in this species, and we also added a tenth lineage. Limited gene flow, isolation by distance and biogeographic barriers were further explored to explain this genetic structuration. We also jointly examined morphometric and genetic variability and found that the morphological groups were congruent with the genetic lineages and the geographic distribution. A better knowledge of the phenotypic plasticity and genetic diversity of this gerbil can be used to comprehend the micro-evolutionary processes in other small mammals in North Africa.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "http://www.zoologicalbulletin.de/BzB_Volumes/Volume_68_1/097_bouarakia_et_al_20190613.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": null,
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2019-06-14T08:38:59.000Z",
                "registered": "2019-06-14T08:39:11.000Z",
                "published": "2019",
                "updated": "2020-07-29T15:45:30.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2019.68.1.093",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2019.68.1.093",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Landgref Filho, Paulo",
                        "nameType": "Personal",
                        "givenName": "Paulo",
                        "familyName": "Landgref Filho",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Oda, Fabricio H.",
                        "nameType": "Personal",
                        "givenName": "Fabricio H.",
                        "familyName": "Oda",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Mise, Fabio T.",
                        "nameType": "Personal",
                        "givenName": "Fabio T.",
                        "familyName": "Mise",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "de Rodrigues, Domigos J.",
                        "nameType": "Personal",
                        "givenName": "Domigos J.",
                        "familyName": "de Rodrigues",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Uetanabaro, Masao",
                        "nameType": "Personal",
                        "givenName": "Masao",
                        "familyName": "Uetanabaro",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    }
                ],
                "titles": [
                    {
                        "title": "Diet composition of Ameerega pitta (Tschudi, 1838) from the Serra da Bodoquena region in central Brazil, with a summary of dietary studies on species of the genus Ameerega (Anura: Dendrobatidae)"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2019,
                "subjects": [
                    {
                        "subject": "Cerrado"
                    },
                    {
                        "subject": "dendrobatid frog"
                    },
                    {
                        "subject": "feeding habits"
                    },
                    {
                        "subject": "trophic ecology"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-06-13",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:CBA156F4-E9AA-401C-B036-77C362CE1E89",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "lang": null,
                        "description": "We provide data on the diet composition of Ameerega picta from the region of Serra da Bodoquena in the state of Mato Grosso do Sul, central Brazil. We also provide a summary of dietary studies on species of the genus Ameerega.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "http://www.zoologicalbulletin.de/BzB_Volumes/Volume_68_1/093_landgref_20190613.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": null,
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2019-06-14T08:33:18.000Z",
                "registered": "2019-06-14T08:35:29.000Z",
                "published": "2019",
                "updated": "2020-07-29T15:45:28.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2019.68.1.061",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2019.68.1.061",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Trape, Jean-François",
                        "nameType": "Personal",
                        "givenName": "Jean-François",
                        "familyName": "Trape",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Crochet, Pierre-André",
                        "nameType": "Personal",
                        "givenName": "Pierre-André",
                        "familyName": "Crochet",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Broadley, Donald G.",
                        "nameType": "Personal",
                        "givenName": "Donald G.",
                        "familyName": "Broadley",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Sourouille, Patricia",
                        "nameType": "Personal",
                        "givenName": "Patricia",
                        "familyName": "Sourouille",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Mané, Youssouph",
                        "nameType": "Personal",
                        "givenName": "Youssouph",
                        "familyName": "Mané",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Burger, Marius",
                        "nameType": "Personal",
                        "givenName": "Marius",
                        "familyName": "Burger",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Böhme, Wolfgang",
                        "nameType": "Personal",
                        "givenName": "Wolfgang",
                        "familyName": "Böhme",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Saleh, Mostafa",
                        "nameType": "Personal",
                        "givenName": "Mostafa",
                        "familyName": "Saleh",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Karan, Anna",
                        "nameType": "Personal",
                        "givenName": "Anna",
                        "familyName": "Karan",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Lanza, Benedetto",
                        "nameType": "Personal",
                        "givenName": "Benedetto",
                        "familyName": "Lanza",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Mediannikov, Oleg",
                        "nameType": "Personal",
                        "givenName": "Oleg",
                        "familyName": "Mediannikov",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    }
                ],
                "titles": [
                    {
                        "title": "On the Psammophis sibilans group (Serpentes, Lamprophiidae, Psammophiinae) north of 12°S, with the description of a new species from West Africa"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2019,
                "subjects": [
                    {
                        "subject": "Reptilia"
                    },
                    {
                        "subject": "Ophidia"
                    },
                    {
                        "subject": "Psammophiinae"
                    },
                    {
                        "subject": "Psammophis sibilans"
                    },
                    {
                        "subject": "Psammophis afroccidentalis sp. nov."
                    },
                    {
                        "subject": "new species"
                    },
                    {
                        "subject": "taxonomy"
                    },
                    {
                        "subject": "biogeography"
                    },
                    {
                        "subject": "Africa"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-06-13",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:0F40DD1A-D80F-49BA-B6DF-FF8F27E487E7",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "lang": null,
                        "description": "Based on molecular, morphological and field data, the status and zoogeography of the taxa of the Psammophissibilans group north of 12°S are reviewed. Molecular data including sequences from 20 of the 22 described species known to occur north of 12°S suggest that P. sibilans distribution is restricted to northeastern Africa, from Egypt to Ethiopia. Po-pulations from West Africa are described as a new species, P. afroccidentalis sp. nov., and those from Chad, Cameroon and Central African Republic are assigned to P. rukwae which is also distributed from Tanzania to Ethiopia. Molecular data indicate the occurrence within this complex of three additional cryptic species in the Horn of Africa. Populations previous-ly assigned to P. phillipsi in Central Africa north, south and east of the Congo forest block are assigned to P. mossambicus and the status of P. occidentalis is discussed. P. phillipsi is restricted to West Africa, with P. irregularis as junior synonym.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "http://www.zoologicalbulletin.de/BzB_Volumes/Volume_68_1/061_trape_et_al_20190613.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": null,
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2019-06-14T08:26:00.000Z",
                "registered": "2019-06-14T08:26:19.000Z",
                "published": "2019",
                "updated": "2020-07-29T15:45:25.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2019.68.1.031",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2019.68.1.031",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Kehlmaier, Christian",
                        "nameType": "Personal",
                        "givenName": "Christian",
                        "familyName": "Kehlmaier",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Gibbs, David J.",
                        "nameType": "Personal",
                        "givenName": "David J.",
                        "familyName": "Gibbs",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Withers, Phil",
                        "nameType": "Personal",
                        "givenName": "Phil",
                        "familyName": "Withers",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    }
                ],
                "titles": [
                    {
                        "title": "New records of big-headed flies (Diptera: Pipunculidae) from the Mediterranean Basin"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2019,
                "subjects": [
                    {
                        "subject": "Diptera"
                    },
                    {
                        "subject": "Pipunculidae"
                    },
                    {
                        "subject": "Mediterranean Basin"
                    },
                    {
                        "subject": "taxonomy"
                    },
                    {
                        "subject": "faunistics"
                    },
                    {
                        "subject": "new species"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-06-13",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:DC3BA949-188E-465C-92C8-AB61B4EABC3A\n\n",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "lang": null,
                        "description": "Despite great progress in Pipunculidae (Insecta: Diptera) systematics during the past decades, the Mediterrane-an fauna of big-headed flies remains largely unknown. Here, we present new faunistic and taxonomic data for 98 named species from Cyprus, Egypt, France, Greece, Italy, Malta, Morocco, Portugal, Spain, Tunisia, and Turkey, based on our own collecting efforts and museum specimens. Besides 56 first national records, the paper includes the description of Cephalops(Semicephalops)  brachium  Kehlmaier    Withers  sp.  n.  from  France  and  Spain,  and  of  TomosvaryellaositoKehlmaier,  Gibbs    Withers  sp.  n.  and  Tomosvaryella  pugiunculus  Kehlmaier    Gibbs  sp.  n.  from  the  Balear  Islands  (Spain). Furthermore, two new synonymies are proposed: Tomosvaryella lyneborgi (Coe, 1969) = Tomosvaryella cilitar-sis (Strobl, 1910); and Tomosvaryella glabrum (Adams, 1905) = Tomosvaryella pilosiventris (Becker, 1900). Lectotypes are designated for Tomosvaryella pilosiventris (Becker, 1900) and Tomosvaryella vicina (Becker, 1900). The following species need to be deleted from the Spanish checklist due to misidentifications: Cephalops subultimus Collin, 1956, Eu-dorylas montium (Becker, 1897), and Tomosvaryella nigronitida Collin, 1958.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "http://www.zoologicalbulletin.de/BzB_Volumes/Volume_68_1/031_kehlmaier_20190602.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": null,
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 1,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2019-06-14T08:12:52.000Z",
                "registered": "2019-06-14T08:13:22.000Z",
                "published": "2019",
                "updated": "2020-07-29T15:45:20.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2019.68.1.021",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2019.68.1.021",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Ahrens, Dirk",
                        "nameType": "Personal",
                        "givenName": "Dirk",
                        "familyName": "Ahrens",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Fabrizi, Silvia",
                        "nameType": "Personal",
                        "givenName": "Silvia",
                        "familyName": "Fabrizi",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Nikolaev, Katharina",
                        "nameType": "Personal",
                        "givenName": "Katharina",
                        "familyName": "Nikolaev",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Knechtges, Lisa",
                        "nameType": "Personal",
                        "givenName": "Lisa",
                        "familyName": "Knechtges",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Eberle, Jonas",
                        "nameType": "Personal",
                        "givenName": "Jonas",
                        "familyName": "Eberle",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    }
                ],
                "titles": [
                    {
                        "title": "On the identity of some taxa of Sericinae described by C. P. Thunberg and L. Gyllenhal (Coleoptera, Scarabaeidae)"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2019,
                "subjects": [
                    {
                        "subject": "Sericini"
                    },
                    {
                        "subject": "Ablaberini"
                    },
                    {
                        "subject": "species taxonomy"
                    },
                    {
                        "subject": "South Africa"
                    },
                    {
                        "subject": "Indonesia"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-03-31",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:0A3BF492-C1ED-4241-A1D9-68D9E63AAAD7",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The type specimens of a number of species of Sericinae described by C.P. Thunberg and L. Gyllenhal wererevised. The study of the type material of the Zoological Museum of the Uppsala University revealed the identity of theseforgotten species and resulted in five new combinations and four new synonymies: Ablaberoides fuliginosus (Thunberg,1818) comb. n., Ablabera haemorrhoa (Thunberg, 1818) comb. n.; Camenta caffra (Thunberg, 1818) comb. n., Maladerasetifera (Gyllenhal, 1817) comb. n., and Microserica pusilla (Thunberg, 1818) comb. n. [= Microserica compressipes(Wiedemann, 1823) syn. n.; Microserica brenskei Reitter, 1896 syn. n.; Microserica pulchella Brenske, 1899 syn. n.; Microserica leopoldiana Balthasar, 1932 syn. n.]. Melolontha fuliginosa Thunberg, 1818 resulted to be a senior primaryhomonym of Melolontha fuliginosa Fairmaire, 1889 (now Exolontha fuliginosa) for which a replacement name is pro-posed, Exolontha neofuliginosa Ahrens, nom. nov. Ablabera clypeata (Gyllenhal, 1817) and Ablabera totta (Thunberg,1818) were removed from synonymy with Ablabera splendida (Fabricius, 1781). We designated lectotypes for Melo-lontha setifera Gyllenhal, 1817, Trichius pusillus Thunberg, 1818, Melolontha fuliginosa Thunberg, 1818, Melolonthaanalis Thunberg, 1818, Melolontha haemorrhoa Thunberg, 1818, Melolontha clypeata Gyllenhal, 1817, Melolontha tottaThunberg, 1818, and Melolontha caffra Thunberg, 1818.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_68_1/021_Thunberg_20190402.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": null,
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2019-04-01T14:14:11.000Z",
                "registered": "2019-04-03T06:47:58.000Z",
                "published": "2019",
                "updated": "2020-07-29T07:10:06.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2019.68.1.013",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2019.68.1.013",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Ntoungwa Ebague, Guy Martial",
                        "nameType": "Personal",
                        "givenName": "Guy Martial",
                        "familyName": "Ntoungwa Ebague",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Missoup, Alain Didier",
                        "nameType": "Personal",
                        "givenName": "Alain Didier",
                        "familyName": "Missoup",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Chung, Ernest Keming",
                        "nameType": "Personal",
                        "givenName": "Ernest Keming",
                        "familyName": "Chung",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Tindo, Maurice",
                        "nameType": "Personal",
                        "givenName": "Maurice",
                        "familyName": "Tindo",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Denys, Christiane",
                        "nameType": "Personal",
                        "givenName": "Christiane",
                        "familyName": "Denys",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    }
                ],
                "titles": [
                    {
                        "title": "Terrestrial small mammal assemblage from pellets of three sympatric owl species in the Mount Oku area (Northwest Cameroon), with implications for conservation"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2019,
                "subjects": [
                    {
                        "subject": "Mount Oku"
                    },
                    {
                        "subject": "owl pellets"
                    },
                    {
                        "subject": "rodents"
                    },
                    {
                        "subject": "shrews"
                    },
                    {
                        "subject": "owls"
                    },
                    {
                        "subject": "conservation"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-01-28",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:D8C8DAAF-4F7A-4BB4-97A1-384C6E3D889D",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "Mount Oku is well known for its exceptional species diversity for both animals and plants. A total number of 27 species of rodents and six species of shrews are reported from the area. Ten of these species are endemic at local or regional level and are considered as endangered or vulnerable, with a decreasing population trend. They are thus conside-red as having a high conservation importance. We sampled terrestrial small mammals from owl pellets during a period of 22 months in different areas near the village Oku, in order to assess the importance of these taxa in the diet of owl species present in the area. The 236 pellets attributed to three sympatric owl species (Barn owl, Tyto alba, the African wood owl, Strix woodfordii, Northern white-faced owl, Ptilopsis leucotis), yielded a total number of 543 specimens of rodents and shrews, belonging to 22 species (16 species of rodents and six species of shrews). They represented respectively 69.06% and 30.94% of the total assemblage, the species Dasymys sp.,   with    a  final    score    of  18.23%, having the   highest relative abundance.  Of  the  ten  species  with  a  high  conservation  importance,  only  Lemniscomys mittendorfi  was  missing.  All  constituted about 27.62% of all specimens collected, with a relative abundance of 4.23% for species strictly restricted to Mount Oku.    This    study    confirms the   position of  Mount Oku   as  an  important conservation area   for   rodents and   shrews, and highlights the evidence that terrestrial small mammal predation by owls cannot be considered a threat to species of conservation concern at Mount Oku.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "http://www.zoologicalbulletin.de/BzB_Volumes/Volume_68_1/013_ntoungwa_20190130.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": null,
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2019-03-07T09:36:00.000Z",
                "registered": "2019-03-07T09:37:43.000Z",
                "published": "2019",
                "updated": "2020-07-29T06:16:10.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2019.68.1.001",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2019.68.1.001",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Sharma, Bhushan Kumar",
                        "nameType": "Personal",
                        "givenName": "Bhushan Kumar",
                        "familyName": "Sharma",
                        "affiliation": [],
                        "nameIdentifiers": []
                    },
                    {
                        "name": "Sharma, Sumita",
                        "nameType": "Personal",
                        "givenName": "Sumita",
                        "familyName": "Sharma",
                        "affiliation": [],
                        "nameIdentifiers": []
                    }
                ],
                "titles": [
                    {
                        "title": "The biodiverse rotifer assemblages (Rotifera: Eurotatoria) of Arunachal Pradesh, the eastern Himalayas: alpha diversity, distribution and interesting features"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2019,
                "subjects": [
                    {
                        "subject": "Biodiversity"
                    },
                    {
                        "subject": "biogeography"
                    },
                    {
                        "subject": "habitat heterogeneity"
                    },
                    {
                        "subject": "Himalayan hot-spot"
                    },
                    {
                        "subject": "interesting species"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-01-28",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:839E82AA-0807-47C1-B21E-C5DE2098C146",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [
                    "PDF"
                ],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The present assessment of Rotifera biodiversity of the eastern Himalayas reveals a total of 172 species belonging to 39 genera and 19 families from Arunachal Pradesh, the northeastern-most state of India. The richness forms ~59% and ~40% of the rotifer species known till date from northeast India (NEI) and India, respectively. Three species are new to the Indian sub-region, four species are new to NEI and 89 species are new to Arunachal Pradesh; 27 species indicate global distribution importance and 25 species reported exclusively from NEI merit regional interest. The rich and diverse alpha di- versity and biogeographic interest of Rotifera of this Himalayan biodiversity hot-spot is noteworthy in light of predominance of the small lentic ecosystems. Lecanidae &gt; Brachionidae &gt; Lepadellidae &gt; Trichocercidae collectively comprise ~71% of total rotifer species. Brachionidae records the highest richness known from any state of India. This study indicates the role of thermophiles with overall importance of ‘tropic-centered’ genera Lecane and Brachionus, and particularly at lower altitudes; species of ‘temperate-centered’ genera Keratella, Notholca and Synchaeta are notable in our collections at middle and higher altitudes, while Trichocerca and Lepadella are other species-rich genera. The rotifer fauna shows a mixture of ‘tropical’ and ‘cold-water’ elements, depicts the littoral-periphytonic character, and records a large component of cosmopolitan species. The study of more collections from middle and higher altitudes of Arunachal Pradesh are desired for an update on Rotifera from the eastern Himalayas.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://www.zoologicalbulletin.de/BzB_Volumes/Volume_68_1/001_sharma_sharma_20190128.pdf",
                "contentUrl": null,
                "metadataVersion": 2,
                "schemaVersion": null,
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2019-01-30T10:05:13.000Z",
                "registered": "2019-03-07T08:55:19.000Z",
                "published": "2019",
                "updated": "2020-07-28T12:08:27.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2020.69.2.157",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2020.69.2.157",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Ambekar, Mayuresh",
                        "nameType": "Personal",
                        "givenName": "Mayuresh",
                        "familyName": "Ambekar",
                        "affiliation": [],
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ]
                    },
                    {
                        "name": "Murthy, Arya",
                        "nameType": "Personal",
                        "givenName": "Arya",
                        "familyName": "Murthy",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Mirza, Zeeshan A.",
                        "nameType": "Personal",
                        "givenName": "Zeeshan A.",
                        "familyName": "Mirza",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    }
                ],
                "titles": [
                    {
                        "title": "A new species of fan-throated lizard of the genus Sitana Cuvier, 1829 (Squamata: Agamidae) from northern Karnataka, India"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2020,
                "subjects": [
                    {
                        "subject": "Reptilia"
                    },
                    {
                        "subject": "mtDNA"
                    },
                    {
                        "subject": "molecular phylogeny"
                    },
                    {
                        "subject": "micro-CT scan"
                    },
                    {
                        "subject": "taxonomy"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2020-07-02",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:9202B13C-4294-4049-8DEB-42534205BDF5",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "A new species of fan-throated lizard of the genus Sitana Cuvier, 1829 is described from northern Karnataka, India. The new species is similar to members of the clade of Sitanaspinaecephalus Deepak et al., 2016, however, can be distinguished based on morphological as well as molecular data. Sitana dharwarensissp. nov. differs from its sister species, S. laticeps Deepak Giri, 2016 in bearing a much larger dewlap. Data from micro-CT scan of the cranium and jaws further add support to the distinctness of the new species. The rivers, namely Krishna and Tungabhadra, likely act as a biogeographic barrier for terrestrial lizard species.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://zoologicalbulletin.de/BzB_Volumes/Volume_69_2/157_ambekar_et_al_20200701.pdf",
                "contentUrl": null,
                "metadataVersion": 2,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2020-07-03T09:59:09.000Z",
                "registered": "2020-07-03T09:59:23.000Z",
                "published": "2020",
                "updated": "2020-07-03T14:56:33.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2020.69.1.141",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2020.69.1.141",
                "identifiers": [],
                "creators": [
                    {
                        "name": "van Steenis, Jeroen",
                        "nameType": "Personal",
                        "givenName": "Jeroen",
                        "familyName": "van Steenis",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Zuijen, Menno P. Van",
                        "nameType": "Personal",
                        "givenName": "Menno P. Van",
                        "familyName": "Zuijen",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Ricarte, Antonio",
                        "nameType": "Personal",
                        "givenName": "Antonio",
                        "familyName": "Ricarte",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Marcos-García, M. Ángeles",
                        "nameType": "Personal",
                        "givenName": "M. Ángeles",
                        "familyName": "Marcos-García",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Doczkal, Dieter",
                        "nameType": "Personal",
                        "givenName": "Dieter",
                        "familyName": "Doczkal",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Ssymank, A.",
                        "nameType": "Personal",
                        "givenName": "A.",
                        "familyName": "Ssymank",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Mengual, Ximo",
                        "nameType": "Personal",
                        "givenName": "Ximo",
                        "familyName": "Mengual",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    }
                ],
                "titles": [
                    {
                        "title": "First records of Chrysotoxum volaticum Séguy, 1961 from Europe and Platycheirus marokkanus Kassebeer, 1998 from Spain (Diptera: Syrphidae) together with additional records of Spanish Chrysotoxum Meigen, 1803"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2020,
                "subjects": [
                    {
                        "subject": "Ibero-Maghreb fauna"
                    },
                    {
                        "subject": "new species records"
                    },
                    {
                        "subject": "France"
                    },
                    {
                        "subject": "Spain"
                    },
                    {
                        "subject": "diagnosis"
                    },
                    {
                        "subject": "DNA barcoding"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2020-06-01",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:787328A5-4082-4677-858C-867962B56395",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The first European records of Chrysotoxum volaticum Séguy, 1961 from Spain and France, and Platycheirus marokkanus Kassebeer, 1998 from Spain are provided. These are further examples of North African species also present in the Iberian Peninsula. Diagnostic characters are given to separate C. volaticum and the similar Chrysotoxum bicinctum (Linnaeus, 1758), and additional records of other Chrysotoxum Meigen, 1803 hoverflies from Spain are also reported. We also provide DNA barcodes for C. volaticum and discuss the utility of DNA barcoding to identify species in the genus Chrysotoxum.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://zoologicalbulletin.de/BzB_Volumes/Volume_69_1/141_van_steenis_et_al_20200604.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2020-06-15T14:51:09.000Z",
                "registered": "2020-06-15T14:51:20.000Z",
                "published": "2020",
                "updated": "2020-06-15T14:51:20.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2020.69.1.131",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2020.69.1.131",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Chandramouli, S.R.",
                        "nameType": "Personal",
                        "givenName": "S.R.",
                        "familyName": "Chandramouli",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Gokulakrishnan, G.",
                        "nameType": "Personal",
                        "givenName": "G.",
                        "familyName": "Gokulakrishnan",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Sivaperuman, C.",
                        "nameType": "Personal",
                        "givenName": "C.",
                        "familyName": "Sivaperuman",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    }
                ],
                "titles": [
                    {
                        "title": "Status and distribution of the little-known and elusive Nicobarese worm lizard Dibamus nicobaricum (Fitzinger in Steindachner, 1867) (Squamata: Dibamidae)"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2020,
                "subjects": [
                    {
                        "subject": "Nicobar worm-lizard"
                    },
                    {
                        "subject": "Dibamus nicobaricum"
                    },
                    {
                        "subject": "distribution"
                    },
                    {
                        "subject": "status"
                    },
                    {
                        "subject": "MAXENT model"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2020-06-01",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:34DFDE32-0BD3-4C49-8B25-87A82FA918A9",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "Field surveys were carried out to record the elusive and little-known fossorial Nicobarese worm lizard Dibamus nicobaricum (Fitzinger in Steindachner, 1867) on seven of the 23 islands of the Nicobar archipelago. It was recorded from three new localities, two in Great Nicobar and the other from Teressa Island, extending the northern and southern boundaries of its distribution significantly. One of the individuals, a subadult male recorded during this study happens to be the smallest one ever recorded, measuring just 70 mm SVL. A predictive distribution model was developed based on the geo-coordinates of its occurrence with a reliable prediction of 25–100% probability on islands of the central and southern group of the Nicobar archipelago, diminishing to 12–25% on Car Nicobar, situated to the north. The Area Under the Curve (AUC) of the model was 0.907, indicating a reliable prediction. Status of D. nicobaricum was assessed for the first time as per the IUCN guidelines which reveal that it has to be considered as an endangered species based on its narrow distribution range.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://zoologicalbulletin.de/BzB_Volumes/Volume_69_1/131_chandramouli_20200604.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2020-06-15T14:44:13.000Z",
                "registered": "2020-06-15T14:44:25.000Z",
                "published": "2020",
                "updated": "2020-06-15T14:44:25.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2020.69.1.123",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2020.69.1.123",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Gorczyca, Jacek",
                        "nameType": "Personal",
                        "givenName": "Jacek",
                        "familyName": "Gorczyca",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Wolski, Andrzej",
                        "nameType": "Personal",
                        "givenName": "Andrzej",
                        "familyName": "Wolski",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Taszakowski, Artur",
                        "nameType": "Personal",
                        "givenName": "Artur",
                        "familyName": "Taszakowski",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    }
                ],
                "titles": [
                    {
                        "title": "The first record of the genus Fulvius Stål, 1862 (Heteroptera: Miridae: Cylapinae) from continental China with description of a new species"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2020,
                "subjects": [
                    {
                        "subject": "Asia"
                    },
                    {
                        "subject": "biodiversity"
                    },
                    {
                        "subject": "new species"
                    },
                    {
                        "subject": "plant bugs"
                    },
                    {
                        "subject": "taxonomy"
                    },
                    {
                        "subject": "true bugs"
                    },
                    {
                        "subject": "Yunnan Province"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2020-06-01",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:8840C9B5-072C-4E04-B9F5-604AFD149E76",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "A new species of the genus Fulvius Stål, 1862 (Heteroptera: Miridae: Cylapinae: Fulviini) is described based on a couple of specimens collected in Yunnan Province in SW China. The genus is also reported from continental China for the first time. Detailed illustrations of the tarsi, the distribution of trichobothria on the metafemur and male genitalia are given, and an image of the dorsal habitus is presented.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://zoologicalbulletin.de/BzB_Volumes/Volume_69_1/123_gorczyca_20200604.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2020-06-15T14:39:45.000Z",
                "registered": "2020-06-15T14:39:56.000Z",
                "published": "2020",
                "updated": "2020-06-15T14:39:56.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2020.69.1.117",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2020.69.1.117",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Gokulakrishnan, G.",
                        "nameType": "Personal",
                        "givenName": "G.",
                        "familyName": "Gokulakrishnan",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Sivaperuman, C.",
                        "nameType": "Personal",
                        "givenName": "C.",
                        "familyName": "Sivaperuman",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Chandramouli, S.R.",
                        "nameType": "Personal",
                        "givenName": "S.R.",
                        "familyName": "Chandramouli",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    }
                ],
                "titles": [
                    {
                        "title": "Further records of a poorly-known insular endemic skink Lipinia macrotympanum (Stoliczka, 1873) (Squamata: Scincidae) Brazil"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2020,
                "subjects": [
                    {
                        "subject": "Lipinia macrotympanum"
                    },
                    {
                        "subject": "new locality records"
                    },
                    {
                        "subject": "distribution map"
                    },
                    {
                        "subject": "Nicobar archipelago"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2020-06-01",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:BCC5BF79-B2F4-40A2-AD92-55D3AC977FCB",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The little-known, insular endemic skink Lipinia macrotympanum (Stoliczka, 1873) was recorded recently from two new localities in Great Nicobar Biosphere Reserve (GNBR) further south of the previously known localities. Based on these observations, new data on morphology, natural history and distribution are presented and it is suggested to be considered as an endangered species based on the IUCN assessment criteria",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://zoologicalbulletin.de/BzB_Volumes/Volume_69_1/117_gokulakrishnan_et_al_20200419.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2020-06-15T14:33:21.000Z",
                "registered": "2020-06-15T14:33:32.000Z",
                "published": "2020",
                "updated": "2020-06-15T14:33:32.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2020.69.1.111",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2020.69.1.111",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Gippoliti, Spartaco",
                        "nameType": "Personal",
                        "givenName": "Spartaco",
                        "familyName": "Gippoliti",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Lupi, Luca",
                        "nameType": "Personal",
                        "givenName": "Luca",
                        "familyName": "Lupi",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    }
                ],
                "titles": [
                    {
                        "title": "A note on the wild canids (Carnivora: Canidae) of the Horn of Africa, with the first evidence of a new – forgotten – species for Ethiopia Canis mengesi Noack, 1897"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2020,
                "subjects": [
                    {
                        "subject": "Canis mengesi"
                    },
                    {
                        "subject": "Canis riparius"
                    },
                    {
                        "subject": "Danakil"
                    },
                    {
                        "subject": "geomorphology"
                    },
                    {
                        "subject": "taxonomy"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2020-06-01",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:925DF201-A926-4633-B830-14B111BDEF4C",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The first ever reported observation ofa member of the genus Canis well in the interior of the Danakil area (Ethi-opia) offers the opportunity to revise available evidence about the existence of a neglected species of small-sized ‘jackal’ in the Horn of Africa. A review of historical zoological literature led to assign this small-sized, reddish jackal to Canis mengesi Noack, 1897, originally described from inner Somaliland. Geological and geomorphological considerations sup-port the distinctiveness of the Red Sea coastal jackal Canis anthus riparius Hemprich Ehrenberg, 1832, typical of the narrow alluvial, sandy coast, while Canis mengesi is found in the volcanic rocky habitat prevailing over most northern Afar (Danakil, Ethiopia).",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://zoologicalbulletin.de/BzB_Volumes/Volume_69_1/111_gippoliti_lupi_20200419.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2020-06-15T14:28:16.000Z",
                "registered": "2020-06-15T14:28:31.000Z",
                "published": "2020",
                "updated": "2020-06-15T14:28:31.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2020.69.1.105",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2020.69.1.105",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Al-Aheikhly, Omar F.",
                        "nameType": "Personal",
                        "givenName": "Omar F.",
                        "familyName": "Al-Aheikhly",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Haba, Mukhtar K.",
                        "nameType": "Personal",
                        "givenName": "Mukhtar K.",
                        "familyName": "Haba",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Al-Barazengy, Ali N.",
                        "nameType": "Personal",
                        "givenName": "Ali N.",
                        "familyName": "Al-Barazengy",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Faza’a, Nadheer A.",
                        "nameType": "Personal",
                        "givenName": "Nadheer A.",
                        "familyName": "Faza’a",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    }
                ],
                "titles": [
                    {
                        "title": "New distribution range of the vulnerable wild goat (Capra aegagrus Erxleben, 1777) (Artiodactyla: Bovidae) to the south of its known extant in Iraq, with notes on its conservation"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2020,
                "subjects": [
                    {
                        "subject": "Bovidae"
                    },
                    {
                        "subject": "Capra aegagrus"
                    },
                    {
                        "subject": "protected areas"
                    },
                    {
                        "subject": "ungulates"
                    },
                    {
                        "subject": "wild mammals of Iraq"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2020-06-01",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:CD09EF99-49F6-48DD-B132-5567EBF50815",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "The wild goat (Capra aegagrus Erxleben, 1777) is a vulnerable ungulate confined to the rocky slopes of the Zagros Mountains forest steppes ecoregion in northern and northeastern Iraq (Kurdistan Region). Scattered populations had been reported from 31 sites distributed mainly in four Iraqi northern provinces; however, the species’ current zoogeo-graphical distribution and population trends are enigmatic. From August 2017 to April 2018, four new sightings of the wild goat were obtained from the foothills of the Zagros Mountains along the eastern and southeastern Iraq-Iran internati-onal borders. These new localities represent a new distribution range to the southernmost of the species’ known extantin Iraq. Moreover, the newly discovered wild goat populations in eastern and southeastern Iraq almost certainly originated from the western Iranian populations assigned to the Capra a. aegagrus subspecies. Besides poaching, newly documented threats such as trapping and young capturing which severely affect the wild goat populations in Iraq are discussed.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://zoologicalbulletin.de/BzB_Volumes/Volume_69_1/105_ALSheikhly_et_al_20200419.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2020-06-15T14:22:35.000Z",
                "registered": "2020-06-15T14:23:02.000Z",
                "published": "2020",
                "updated": "2020-06-15T14:23:02.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        },
        {
            "id": "10.20363/bzb-2020.69.1.095",
            "type": "dois",
            "attributes": {
                "doi": "10.20363/bzb-2020.69.1.095",
                "identifiers": [],
                "creators": [
                    {
                        "name": "Trela, Joanna",
                        "nameType": "Personal",
                        "givenName": "Joanna",
                        "familyName": "Trela",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Junkiert, Łukasz",
                        "nameType": "Personal",
                        "givenName": "Łukasz",
                        "familyName": "Junkiert",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    },
                    {
                        "name": "Wieczorek, Karina",
                        "nameType": "Personal",
                        "givenName": "Karina",
                        "familyName": "Wieczorek",
                        "nameIdentifiers": [
                            {
                                "schemeUri": "https://orcid.org",
                                "nameIdentifierScheme": "ORCID"
                            }
                        ],
                        "affiliation": []
                    }
                ],
                "titles": [
                    {
                        "title": "Sexual morphs of the three native Nearctic species of the genus Periphyllus van der Hoeven, 1863 (Insecta: Hemiptera: Aphididae), with identification keys including introduced species"
                    }
                ],
                "publisher": "Zoological Research Museum Alexander Koenig",
                "container": {
                    "type": "Series",
                    "identifier": "2190–7307",
                    "identifierType": "ISSN"
                },
                "publicationYear": 2020,
                "subjects": [
                    {
                        "subject": "Aphids"
                    },
                    {
                        "subject": "distribution"
                    },
                    {
                        "subject": "maple"
                    },
                    {
                        "subject": "sexuales"
                    }
                ],
                "contributors": [],
                "dates": [
                    {
                        "date": "2019-06-13",
                        "dateType": "Issued"
                    }
                ],
                "language": null,
                "types": {
                    "ris": "RPRT",
                    "bibtex": "article",
                    "citeproc": "article-journal",
                    "schemaOrg": "ScholarlyArticle",
                    "resourceType": "CreativeWork",
                    "resourceTypeGeneral": "Text"
                },
                "relatedIdentifiers": [
                    {
                        "relationType": "IsPartOf",
                        "relatedIdentifier": "2190–7307",
                        "relatedIdentifierType": "ISSN"
                    },
                    {
                        "relationType": "IsIdenticalTo",
                        "relatedIdentifier": "urn:lsid:zoobank.org:pub:D8219FBF-35E6-4791-9EC5-519120C3B543",
                        "relatedIdentifierType": "URN"
                    }
                ],
                "sizes": [],
                "formats": [],
                "version": null,
                "rightsList": [
                    {
                        "rights": "Open Access",
                        "rightsUri": "info:eu-repo/semantics/openAccess"
                    }
                ],
                "descriptions": [
                    {
                        "description": "Abstract.Periphyllus van der Hoeven, 1863 (Hemiptera: Aphididae: Chaitophorinae) is a Holarctic genus, with just three species native to Nearctic: Periphyllus americanus (Baker, 1917), P. brevispinosus Gillette Palmer, 1930, and P. negun-dinis (Thomas, 1878). Males and oviparous females of P. brevispinosus and P. negundinis and males of P. americanus are described. Original keys to the identification of the known native and non-native sexual morphs of this genus, associated with maples in the Nearctic Region, are given.",
                        "descriptionType": "Abstract"
                    }
                ],
                "geoLocations": [],
                "fundingReferences": [],
                "url": "https://zoologicalbulletin.de/BzB_Volumes/Volume_69_1/095_trela_et_al_20200419.pdf",
                "contentUrl": null,
                "metadataVersion": 1,
                "schemaVersion": "http://datacite.org/schema/kernel-4",
                "source": "fabrica",
                "isActive": true,
                "state": "findable",
                "reason": null,
                "viewCount": 0,
                "downloadCount": 0,
                "referenceCount": 0,
                "citationCount": 0,
                "partCount": 0,
                "partOfCount": 0,
                "versionCount": 0,
                "versionOfCount": 0,
                "created": "2020-06-15T14:14:14.000Z",
                "registered": "2020-06-15T14:15:14.000Z",
                "published": "2020",
                "updated": "2020-06-15T14:15:14.000Z"
            },
            "relationships": {
                "client": {
                    "data": {
                        "id": "zbmed.zfmk",
                        "type": "clients"
                    }
                }
            }
        }
    ],
    "meta": {
        "total": 43,
        "totalPages": 1,
        "page": 1,
        "states": [
            {
                "id": "findable",
                "title": "Findable",
                "count": 43
            }
        ],
        "resourceTypes": [
            {
                "id": "text",
                "title": "Text",
                "count": 43
            }
        ],
        "created": [
            {
                "id": "2021",
                "title": "2021",
                "count": 23
            },
            {
                "id": "2020",
                "title": "2020",
                "count": 8
            },
            {
                "id": "2019",
                "title": "2019",
                "count": 12
            }
        ],
        "published": [
            {
                "id": "2021",
                "title": "2021",
                "count": 23
            },
            {
                "id": "2020",
                "title": "2020",
                "count": 8
            },
            {
                "id": "2019",
                "title": "2019",
                "count": 12
            }
        ],
        "registered": [
            {
                "id": "2021",
                "title": "2021",
                "count": 23
            },
            {
                "id": "2020",
                "title": "2020",
                "count": 8
            },
            {
                "id": "2019",
                "title": "2019",
                "count": 12
            }
        ],
        "providers": [
            {
                "id": "wfnq",
                "title": "ZB MED Bucket",
                "count": 43
            }
        ],
        "clients": [
            {
                "id": "zbmed.zfmk",
                "title": "Zoologisches Forschungsmuseum Alexander Koenig - Leibniz-Institut für Biodiversität der Tiere",
                "count": 43
            }
        ],
        "affiliations": [],
        "prefixes": [
            {
                "id": "10.20363",
                "title": "10.20363",
                "count": 43
            }
        ],
        "certificates": [],
        "licenses": [],
        "schemaVersions": [
            {
                "id": "4",
                "title": "Schema 4",
                "count": 31
            }
        ],
        "linkChecksStatus": [
            {
                "id": "200",
                "title": "200",
                "count": 12
            }
        ],
        "subjects": [
            {
                "id": "taxonomy",
                "title": "Taxonomy",
                "count": 6
            },
            {
                "id": "Biodiversity",
                "title": "Biodiversity",
                "count": 4
            },
            {
                "id": "distribution",
                "title": "Distribution",
                "count": 3
            },
            {
                "id": "Ameridelphia",
                "title": "Ameridelphia",
                "count": 2
            },
            {
                "id": "Australidelphia",
                "title": "Australidelphia",
                "count": 2
            },
            {
                "id": "DNA barcoding",
                "title": "Dna Barcoding",
                "count": 2
            },
            {
                "id": "Monotremata",
                "title": "Monotremata",
                "count": 2
            },
            {
                "id": "Natural History Collections",
                "title": "Natural History Collections",
                "count": 2
            },
            {
                "id": "Reptilia",
                "title": "Reptilia",
                "count": 2
            },
            {
                "id": "biogeography",
                "title": "Biogeography",
                "count": 2
            }
        ],
        "fieldsOfScience": [],
        "citations": [
            {
                "id": "2019",
                "title": "2019",
                "count": 1
            }
        ],
        "views": [],
        "downloads": []
    },
    "links": {
        "self": "https://api.datacite.org/dois?query=relatedIdentifiers.relatedIdentifier%3A2190%E2%80%937307&page%5Bsize%5D=1000"
    }
}';

$obj = json_decode($json);

print_r($obj);

$dois = array();

foreach ($obj->data as $data)
{
	$dois[] = $data->id;
}

$dois = array_unique($dois);

print_r($dois);


// Wikidata
if (0)
{
	// True to update existing record, false to skip
	$update = false;
	//$update = true;

	$check = true; // set to false if we are sure that record will exist with DOI
	//$check = false;

	$detect_languages = array('en');
	$detect_languages = array('en', 'de');

	$count = 1;

	foreach ($dois as $doi)
	{
		$go = true;
	
		$item = wikidata_item_from_doi($doi);
	
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
			$url = 'https://data.datacite.org/application/vnd.citationstyles.csl+json/' . urlencode($doi);
			$json = get($url);
						
			$obj = json_decode($json);
			$work = new stdclass;
			$work->message = $obj;	
		
			if (!isset($work->message->DOIagency))	
			{
				$work->message->DOIAgency = 'datacite';
			}
	
					
	
			if ($work)
			{
		
				// parse URL
			
			
				// parse DOI for metadata
				if (preg_match('/BZB-[0-9]{4}.(?<volume>\d+)\.(?<issue>\d+)\.0*(?<spage>\d+)/', $work->message->DOI, $m))
				{
					$work->message->{'container-title'} = 'Bonn zoological Bulletin';
					$work->message->ISSN[] = '2190-7307';
					$work->message->volume = $m['volume'];
					$work->message->issue = $m['issue'];
					$work->message->page = $m['spage'];
				}
			
				if (preg_match('/\.pdf/', $work->message->URL))
				{
					$link = new stdclass;
					$link->{'content-type'} = 'application/pdf';
					$link->URL = $work->message->URL;
					$work->message->link[] = $link;
				
					unset($work->message->URL);
				}
			
		
				print_r($work);	
		
				$source = array();
			
				$source[] = 'S248';
				$source[] = 'Q821542'; // DataCite
							
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
}

if (1)
{
	// generate SQL
	
	$sql = array();
	
	$count = 1;

	foreach ($dois as $doi)
	{
		$url = 'https://data.datacite.org/application/vnd.citationstyles.csl+json/' . urlencode($doi);
		$json = get($url);
					
		$obj = json_decode($json);
		$work = new stdclass;
		$work->message = $obj;	
	
		if (!isset($work->message->DOIagency))	
		{
			$work->message->DOIAgency = 'datacite';
		}
	
		if ($work)
		{
	
			// parse URL
		
		
			// parse DOI for metadata
			if (preg_match('/BZB-[0-9]{4}.(?<volume>\d+)\.(?<issue>\d+)\.0*(?<spage>\d+)/', $work->message->DOI, $m))
			{
				$work->message->{'container-title'} = 'Bonn zoological Bulletin';
				$work->message->ISSN[] = '2190-7307';
				$work->message->volume = $m['volume'];
				$work->message->issue = $m['issue'];
				$work->message->page = $m['spage'];
			}
		
			if (preg_match('/\.pdf/', $work->message->URL))
			{
				$link = new stdclass;
				$link->{'content-type'} = 'application/pdf';
				$link->URL = $work->message->URL;
				$work->message->link[] = $link;
			
				unset($work->message->URL);
			}
		
	
			//print_r($work);	
			
			$sql[$doi] = csl_to_sql($work->message);
			
			
		}
		
		
		// Give server a break every 10 items
		if (($count++ % 10) == 0)
		{
			$rand = rand(1000000, 3000000);
			usleep($rand);
			
			//print_r($sql);
		}

	


	}
	
	foreach ($sql as $doi => $s)
	{
		echo $s . "\n";
	
	}
}



?>
