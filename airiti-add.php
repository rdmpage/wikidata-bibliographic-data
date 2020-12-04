<?php



// Add records to Wikidata from Airiti DOI
// Need to scrape HTML FFS

error_reporting(E_ALL);

require_once (dirname(__FILE__) . '/wikidata.php');
require_once (dirname(__FILE__) . '/vendor/autoload.php');

use Sunra\PhpSimple\HtmlDomParser;



$dois=array();


$dois=array(
'10.6119/JMST-013-1219-14', 
//'10.6165/tai.2011.56(1).62',
//'10.6842/NCTU.2014.00758', // thesis, need to figure out how to process
);



// True to update existing record, false to skip
$update = false;
//$update = true;

$check = true; // set to false if we are sure that record will exist with DOI


$detect_languages = array('en', 'zh');


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
	//if ($go)
	{
		$url = 'http://www.airitischolar.com/doi/search/search-doi-by-edited-reference.jsp?reference=' . urlencode($doi);	
		
		
		if (1)
		{
			$html = get($url);
		}
		else
		{
		
			$html = '	<tr class=\'alt\'>
			<td align="center" width="2%">(1)</td>
			<td class="querytext">
				<table>
					<tr>
						<td><span class=\'doi\'>10.6119/JMST-013-1219-14</span></td>
					</tr>
					<tr style="display: none;text-align:center;">
						<td><textarea rows="4" cols="80">10.6119/JMST-013-1219-14</textarea></td>
					</tr>
				</table>
			
				<div>
					<button type="button" onclick="modify(\'edit\', 0);">編輯<br />(Edit)</button>
					<button style="display: none;" type="button" onclick="modify(\'cancel\', 0);">取消<br />(Cancel)</button>
					<button style="display: none;" type="button" onclick="modify(\'submit\', 0);">重新查詢<br />(Query)</button>
				</div>
			</td>
			<td>
				<table style="width:100%">

					<tr  onmouseover="setbgcolor(this);" onmouseout="clearbgcolor(this);">
						<td width="1%">
							<input type="radio" name="rgroup0" value="10.6119/JMST-013-1219-14" checked  onclick="changeText(this, 0);">
							<span style="display: none"><span class=\'doi\'>10.6119/JMST-013-1219-14</span></span>
						</td>
						<td>
							<table>
								<tr>
									<td>DOI:</td><td><a href="http://doi.org/10.6119/JMST-013-1219-14" target="_blank">10.6119/JMST-013-1219-14</a></td>
								</tr>
								<tr>
									<td>Title:</td><td> <font color=\'red\'>Two New Species of Vanderhorstia Smith, 1949 (Teleostei: Gobiidae) from the Ryukyus, Japan </font></td>
								</tr>
								<tr>
									<td>Author:</td>
									<td> <font color=\'blue\'>
									 
										Toshiyuki Suzuki, I-Shiung Chen
									</font></td>
								</tr>
								<tr>
									<td>Publication:</td>
									<td>
										<font color=\'green\'>
											Journal of Marine Science and Technology

										</font>,

										<font color=\'purple\'>21(無), </font>
										<font color=\'brown\'>207 - 212, </font>
										<font color=\'orange\'>2013</font>
									</td>
								</tr>

							</table>
						</td>
					</tr>

					<tr style="display: none;" onmouseover="setbgcolor(this);" onmouseout="clearbgcolor(this);">
						<td width="1%">
							<input type="radio" name="rgroup0" value="" onclick="changeText(this, 0);">
							<span style="display: none">10.6119/JMST-013-1219-14</span>
						</td>
						<td>
							沒有符合的資料<br />
							(No DOI found.)
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<button type="button" onclick="flip(\'+\', 0, this);">+ 顯示其他選項 +<br />(See more options)</button>
							<button type="button" style="display:none" onclick="flip(\'-\', 0, this);">- 隱藏其他選項 -<br />(Hide the options)</button>
						</td>
					</tr>
				</table>
			</td>
		</tr>';
		}
		
		// echo $html;
		
		$dom = HtmlDomParser::str_get_html($html);
		
		$csl = new stdclass;
		

		foreach ($dom->find('td table tr') as $tr)
		{
			//echo "x";
			
			foreach ($tr->find('td[1]') as $td)
			{
				// echo $td->plaintext . "\n";
				
				$key = $td->plaintext;
				
				$n = $td->next_sibling();
				if ($n)
				{
					switch ($key)
					{
						case 'DOI:':
							$csl->DOI = $n->plaintext;
							break;
							
						case 'Title:':
							$csl->title = trim($n->plaintext);
							break;

						case 'Author:':
							$authorstring = trim($n->plaintext);
							$authors = explode(", ", $authorstring);
							
							$csl->author = array();
							foreach ($authors as $a)
							{
								$author = new stdclass;
								$author->literal = $a;
								$csl->author[] = $author;
							}
							break;

							
						case 'Publication:':
							// $csl->unstructured = trim($n->plaintext);
							
							foreach ($n->find('font[color=green]') as $v)
							{
								$csl->{'container-title'} = trim($v->plaintext);
							}

							foreach ($n->find('font[color=purple]') as $v)
							{
								$csl->volume = trim($v->plaintext);
								
								if (preg_match('/(?<volume>.*)\((?<issue>.*)\)/', $csl->volume, $m))
								{
									$csl->volume = $m['volume'];
									$csl->issue = $m['issue'];
									
								}
							}

							foreach ($n->find('font[color=brown]') as $v)
							{
								$csl->page = trim($v->plaintext);
								
								$csl->page = str_replace(" - ", "-", $csl->page);
								$csl->page = preg_replace('/,\s*$/', '', $csl->page);
							}

							foreach ($n->find('font[color=orange]') as $v)
							{
								$csl->issued = new stdclass;
								$csl->issued->{'date-parts'} = array();
								$csl->issued->{'date-parts'}[0] = array();
								$csl->issued->{'date-parts'}[0][] = trim($v->plaintext);
							}
							
							
							break;
							
						default:
							break;
					
					}
				
				
					// echo $n->plaintext . "\n";
				}
			}
		}	
		
		
		// print_r($csl);
		
		if (isset($csl->title))
		{
			$work = new stdclass;
			$work->message = $csl;		
	
			/* Can we map journal to ISSN? */
			
			if (isset($work->message->{'container-title'}))
			{
				switch ($work->message->{'container-title'})
				{
					case 'Journal of Marine Science and Technology':
						$work->message->type = 'journal-article';
						$work->message->ISSN[] = '1023-2796';
						break;

					case 'Taiwania':
					case 'TAIWANIA':
						$work->message->type = 'journal-article';
						$work->message->ISSN[] = '0372-333X';
						break;
						
					default:
						break;
				}
			
			}
		
			print_r($work);
		
			if ($work)
			{
				$source = array();
			
				$source[] = 'S248';
				$source[] = 'Q4698727'; // Airiti
							
				$source[] = 'S854';
				$source[] = '"' . $url . '"';
			
			
				// post processing...
			
				$q = csljson_to_wikidata(
					$work, 
					$check,	// check if already exists
					$update, // true to update an existing record, false to skip an existing record
					$detect_languages,
					$source,
					false // don't add English label if title not English (we can add these later)
					);
		
				echo $q;
				echo "\n";
			}
		}
		
	}	


}


?>
