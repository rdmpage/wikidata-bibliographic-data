<?php

/**
 * @file ris.php
 *
 */

// Parse RIS file and try and find first page of article in BHL

require_once (dirname(__FILE__) . '/nameparse.php');

$debug = false;
//$debug = true;

$logfile;

$key_map = array(
	'ID' => 'publisher_id',
	'T1' => 'title',
	'TI' => 'title',
	'SN' => 'issn',
	'JO' => 'secondary_title',
	'JF' => 'secondary_title',
	'BT' => 'secondary_title', // To handle TROPICS fuckup
	'VL' => 'volume',
	'IS' => 'issue',
	'SP' => 'spage',
	'EP' => 'epage',
	
	'N2' => 'abstract',
	'AB' => 'abstract',
	
	'UR' => 'url',
	'AV' => 'availability',
	
	'PB' => 'publisher',
	'CY' => 'city',
	
	'Y1' => 'year',
	'KW' => 'keyword',
	'L1' => 'pdf', 
	'N1' => 'notes',
	'L2' => 'fulltext', // check this, we want to have a link to the PDF...
	'DO' => 'doi' // Mendeley 0.9.9.2
	);
	
//--------------------------------------------------------------------------------------------------
function process_ris_key($key, $value, &$obj)
{
	global $debug;
	
	//echo "key=$key\n";
	
	switch ($key)
	{
	/*
		case 'PB':
			if (!isset($obj->publisher))
			{
				$obj->publisher = new stdclass;
			}
			$obj->publisher->name = $value;
			break;

		case 'CY':
			if (!isset($obj->publisher))
			{
				$obj->publisher = new stdclass;
			}
			$obj->publisher->address = $value;
			break;
	*/
	
		case 'AU':
		case 'A1':					
			// Interpret author names
			
			// Trim trailing periods and other junk
			//$value = preg_replace("/\.$/", "", $value);
			$value = preg_replace("/&nbsp;$/", "", $value);
			$value = preg_replace("/,([^\s])/", ", $1", $value);
			
			// Handle case where initials aren't spaced
			$value = preg_replace("/, ([A-Z])([A-Z])$/", ", $1 $2", $value);

			// Clean Ingenta crap						
			$value = preg_replace("/\[[0-9]\]/", "", $value);
			
			// Space initials nicely
			$value = preg_replace("/\.([A-Z])/", ". $1", $value);
			
			// Make nice
			$value = mb_convert_case($value, 
				MB_CASE_TITLE, mb_detect_encoding($value));
				
			$author = new stdClass();
				
			if (1)
			{							
				// Get parts of name
				$parts = parse_name($value);
				
				if (isset($parts['last']))
				{
					$author->family = $parts['last'];
				}
				/*
				if (isset($parts['suffix']))
				{
					$author->suffix = $parts['suffix'];
				}
				*/
				if (isset($parts['first']))
				{
					$author->given = $parts['first'];
					
					if (array_key_exists('middle', $parts))
					{
						$author->given .= ' ' . $parts['middle'];
					}
				}
				$author->given = preg_replace('/\./Uu', '', $author->given);
				$author->literal = $author->given . ' ' . $author->family;
			}
			else
			{
				$author->literal = $value;
			}
			$obj->author[] = $author;
			break;	
	
		case 'JF':
		case 'JO':
			$value = mb_convert_case($value, 
				MB_CASE_TITLE, mb_detect_encoding($value));
				
			$value = preg_replace('/ Of /', ' of ', $value);	
			$value = preg_replace('/ the /', ' the ', $value);	
			$value = preg_replace('/ and /', ' and ', $value);	
			$value = preg_replace('/ De /', ' de ', $value);	
			$value = preg_replace('/ Du /', ' du ', $value);	
			$value = preg_replace('/ La /', ' la ', $value);	
			
			$obj->{'container-title'} = $value;
			break;
			
		case 'VL':
			$obj->volume = $value;
			break;

		case 'IS':
			$obj->issue = $value;
			break;
			
		case 'SN':
			if ($obj->type == 'book')
			{
				$obj->ISBN = $value;
			}
			else
			{
				$obj->ISSN = array();
				$obj->ISSN[] = $value;
			}	
			break;

		case 'N2':
		case 'AB':
			$obj->abstract = $value;			
			break;
			
		case 'T1':
		case 'TI':
			$value = preg_replace('/([^\s])\(/', '$1 (', $value);	
			$value = str_replace("\ü", "ü", $value);
			$value = str_replace("\ö", "ö", $value);

			$value = str_replace("“", "\"", $value);
			$value = str_replace("”", "\"", $value);
						
			$obj->title = $value;
			break;
				
		// Handle cases where both pages SP and EP are in this field
		case 'SP':
			if (preg_match('/^(?<spage>[0-9]+)\s*[-|–|—]\s*(?<epage>[0-9]+)$/u', trim($value), $matches))
			{
				$obj->page 				= $matches['spage'] . '-' . $matches['epage'];
				$obj->{'page-first'} 	= $matches['spage'];
			}
			else
			{
				$obj->page 				= $value;
				$obj->{'page-first'} 	= $value;
			}				
			break;

		case 'EP':
			if (preg_match('/^(?<spage>[0-9]+)\s*[-|–|—]\s*(?<epage>[0-9]+)$/u', trim($value), $matches))
			{
				$obj->page 				= $matches['spage'] . '-' . $matches['epage'];
				$obj->{'page-first'} 	= $matches['spage'];
			}
			else
			{
				$obj->page 				.= '-' . $value;
			}							
			break;
			
		case 'PY': // used by Ingenta, and others
		case 'Y1':
			$obj->issued = new stdclass;			
			$obj->issued->{'date-parts'} = array();
			
			$date = $value;
		   
		   // PY  - 2002-02-01T00:00:00///
		   if (preg_match("/(?<year>[0-9]{4})-(?<month>[0-9]{1,2})-(?<day>[0-9]{1,2})/", $date, $matches))
		   {      
		   		$obj->issued->{'date-parts'}[0] = array(
		   			(Integer)$matches['year'],
		   			(Integer)$matches['month'],
		   			(Integer)$matches['day']
		   			);             
		   }
		   
		   if (preg_match("/(?<year>[0-9]{4})\/(?<month>[0-9]{1,2})\/(?<day>[0-9]{1,2})/", $date, $matches))
		   {   
		   		$obj->issued->{'date-parts'}[0] = array(
		   			(Integer)$matches['year'],
		   			(Integer)$matches['month'],
		   			(Integer)$matches['day']
		   			);             
		   }		   

		   if (preg_match("/^(?<year>[0-9]{4})\/(?<month>[0-9]{1,2})\/(\/)?$/", $date, $matches))
		   {                       
		   		$$obj->issued->{'date-parts'}[0] = array(
		   			(Integer)$matches['year'],
		   			(Integer)$matches['month']
		   			);             
		   }

		   if (preg_match("/^(?<year>[0-9]{4})\/(?<month>[0-9]{1,2})$/", $date, $matches))
		   {                       
		   		$obj->issued->{'date-parts'}[0] = array(
		   			(Integer)$matches['year'],
		   			(Integer)$matches['month']
		   			);             
		   }

		   if (preg_match("/[0-9]{4}\/\/\//", $date))
		   {                       
			   $year = trim(preg_replace("/\/\/\//", "", $date));
			   if ($year != '')
			   {
		   			$obj->issued->{'date-parts'}[0] = array(
		   				(Integer)$year
		   			);             
			   }
		   }

		   if (preg_match("/^[0-9]{4}$/", $date))
		   {                
		   		$obj->issued->{'date-parts'}[0] = array(
		   				(Integer)$date
		   			);         
		   }		   
		   
		   if (preg_match("/^(?<year>[0-9]{4})\-[0-9]{2}\-[0-9]{2}$/", $date, $matches))
		   {
		   		$obj->issued->{'date-parts'}[0] = explode('-', $date);
		   }
		   break;
		   
		case 'KW':
			$obj->keyword[] = $value;
			break;
	
		// Mendeley 0.9.9.2
		case 'DO':
			$obj->DOI = $value;
			break;			
			
		case 'L1':			
			$link = new stdclass;
			$link->{'content-type'} = 'application/pdf';			
			$link->URL = $value;
			$obj->link[] = $link;
			break;

		case 'UR':
			if (preg_match('/https?:\/\/hdl.handle.net\/(?<id>.*)/', $value, $m))
			{
				$obj->HANDLE = $m['id'];				
			}

			if (preg_match('/https?:\/\/www.jstor.org\/stable\/(?<id>.*)/', $value, $m))
			{
				$obj->JSTOR = $m['id'];				
			}
			
			break;			

		case 'ID':
			$obj->id = $value;
			break;			
			
		default:
			break;
	}
}



//--------------------------------------------------------------------------------------------------
function import_ris($ris, $callback_func = '')
{
	global $debug;
	
	$volumes = array();
	
	$rows = explode("\n", $ris);
	
	$state = 1;	
		
	foreach ($rows as $r)
	{
		$parts = explode ("  - ", $r);
		
		$key = '';
		if (isset($parts[1]))
		{
			$key = trim($parts[0]);
			$value = trim($parts[1]); // clean up any leading and trailing spaces
		}
				
		if (isset($key) && ($key == 'TY'))
		{
			$state = 1;
			$obj = new stdClass();
			$obj->authors = array();
			
			if ('JOUR' == $value)
			{
				$obj->type = 'article-journal';
			}
			if ('BOOK' == $value)
			{
				$obj->type = 'book';
			}
			if ('ABST' == $value)
			{
				$obj->type = 'article-journal';
			}
			if ('THES' == $value)
			{
				$obj->type = 'thesis';
			}
		}
		if (isset($key) && ($key == 'ER'))
		{
			$state = 0;
			
						
			// Cleaning...						
			if ($debug)
			{
				print_r($obj);
			}	
			
			if ($callback_func != '')
			{
				$callback_func($obj);
			}
			
		}
		
		if ($state == 1)
		{
			if (isset($value))
			{
				process_ris_key($key, $value, $obj);
			}
		}
	}
	
	
}


//--------------------------------------------------------------------------------------------------
// Use this function to handle very large RIS files
function import_ris_file($filename, $callback_func = '')
{
	global $debug;
	$debug = false;
	//$debug = true;
	
	$file_handle = fopen($filename, "r");
			
	$state = 1;	
	
	while (!feof($file_handle)) 
	{
		$r = fgets($file_handle);
//		$parts = explode ("  - ", $r);
		$parts = preg_split ('/  -\s+/', $r);
		
		//print_r($parts);
		//echo $r . "\n";
		
		$key = '';
		if (isset($parts[1]))
		{
			$key = trim($parts[0]);
			$value = trim($parts[1]); // clean up any leading and trailing spaces
		}
				
		if (isset($key) && ($key == 'TY'))
		{
			$state = 1;
			$obj = new stdClass();
			
			if ('JOUR' == $value)
			{
				$obj->type = 'article-journal';
			}
			// Ingenta
			if ('ABST' == $value)
			{
				$obj->type = 'article-journal';
			}
			
			if ('BOOK' == $value)
			{
				$obj->type = 'book';
			}
			if ('THES' == $value)
			{
				$obj->type = 'thesis';
			}
		}
		if (isset($key) && ($key == 'ER'))
		{
			$state = 0;
						
			// Cleaning...						
			if ($debug)
			{
				print_r($obj);
			}	
			
			if ($callback_func != '')
			{
				
				$callback_func($obj);
			}
			
		}
		
		if ($state == 1)
		{
			if (isset($value))
			{
				process_ris_key($key, $value, $obj);
			}
		}
	}
	
	
}


?>