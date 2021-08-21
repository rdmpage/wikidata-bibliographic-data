<?php

//----------------------------------------------------------------------------------------
function compare($old, $new)
{
	$diff = array();

	// labels
	//------
	$labels1 = array();
	foreach ($old->labels as $k => $v)
	{
		$labels1[] = $k;
	}

	//------
	$labels2 = array();
	foreach ($new->labels as $k => $v)
	{
		$labels2[] = $k;
	}
	
	$diff['labels'] = array_merge(array_diff($labels1, $labels2), array_diff($labels2, $labels1));

	// descriptions
	//------
	$labels1 = array();
	foreach ($old->descriptions as $k => $v)
	{
		$descriptions1[] = $k;
	}

	//------
	$descriptions2 = array();
	foreach ($new->descriptions as $k => $v)
	{
		$descriptions2[] = $k;
	}
	
	$diff['descriptions'] = array_merge(array_diff($descriptions1, $descriptions2), array_diff($descriptions2, $descriptions1));

	
	// claims
	
	// get list of claims in old and new edit
	$claims1 = array();
	foreach ($old->claims as $k => $v)
	{
		$claims1[$k] = count($v);
	}

	$claims2 = array();
	foreach ($new->claims as $k => $v)
	{
		$claims2[$k] = count($v);
	}


	// compare
	//print_r($claims1);
	//print_r($claims2);
	
	// get list of all property keys in the two edits
	$properties1 = array_keys($claims1);
	$properties2 = array_keys($claims2);
	
	// print_r($properties1);
	// print_r($properties2);
	
	$p = array_merge($properties1, $properties2);
	$p = array_unique($p);
	// print_r($p);
	

	// Go through properties and compare number of claims, we are only interested
	// in major edits, i.e., adding or deleteing a claim
	
	foreach($p as $prop)
	{
		// both edits have this property, do they differ in number?
		if (isset($claims1[$prop]) && isset($claims2[$prop]))
		{
			if ($claims1[$prop] == $claims2[$prop])
			{
				
			}
			else
			{
				if (!isset($diff[$prop]))
				{
					$diff[$prop] = 0;
				}
			
				$diff[$prop] = abs($claims1[$prop] - $claims2[$prop]);
			}
		}
		else
		{
			// only one edit has this property
			if (isset($claims1[$prop]))
			{
				if (!isset($diff[$prop]))
				{
					$diff[$prop] = 0;
				}			
				$diff[$prop] = $claims1[$prop];
			}
			else
			{
				if (!isset($diff[$prop]))
				{
					$diff[$prop] = 0;
				}			
				$diff[$prop] = $claims2[$prop];
			}
		}
	
	}
	
	print_r($diff);

	echo "-----------------------\n";
	
	
	return $diff;
}

//----------------------------------------------------------------------------------------
// Common point of failure is an updated wiki namespace
function xml_edits($xml, $limit = 0)
{
	// detect namespace
	
	
	$namespace = 'http://www.mediawiki.org/xml/export-0.10/';
	
	if (preg_match('/xmlns="(?<namespace>http:\/\/www.mediawiki.org\/xml\/export-(\d+(\.\d+))\/)"/U', $xml, $m))
	{
		$namespace = $m['namespace'];
	}

	$dom= new DOMDocument;
	$dom->loadXML($xml);
	$xpath = new DOMXPath($dom);
	// Add namespaces to XPath to ensure our queries work
	$xpath->registerNamespace("wiki", $namespace);
	$xpath->registerNamespace("xsi", "http://www.w3.org/2001/XMLSchema-instance");
	
	
	$result = new stdclass;
	$result->id = '';
	$result->user_id_list = array();
	$result->user_name_list = array();	
	
	// edits that add or remove data
	$result->property_edits = array();
	$result->label_edits = 0;
	$result->description_edits = 0;
	
	// relative time of edit
	$result->creation = 0;
	$result->time_since = array();
	
	$result->edits = array();
	
	$revision_count = 0;
	
	foreach($xpath->query ("//wiki:page/wiki:title") as $node)
	{
		$result->id = $node->firstChild->nodeValue;
	}
	
	$nodeCollection = $xpath->query ("//wiki:revision");
	foreach($nodeCollection as $node)
	{
		$edit = new stdclass;
	
		$nc = $xpath->query ("wiki:id", $node);
		foreach ($nc as $n)
		{
			$edit->id = $n->firstChild->nodeValue;
		}
		$nc = $xpath->query ("wiki:timestamp", $node);
		foreach ($nc as $n)
		{
			$edit->time = $n->firstChild->nodeValue;
			$edit->timestamp = strtotime($n->firstChild->nodeValue);
			
			if ($result->creation == 0)
			{
				$result->creation = $edit->timestamp;
			}
			else
			{
				$result->time_since[] = $edit->timestamp - $result->creation;
			}
		}
	
		// user id
		$nc = $xpath->query ("wiki:contributor/wiki:id", $node);
		foreach ($nc as $n)
		{
			$edit->userid = $n->firstChild->nodeValue;
			if (!in_array($edit->userid, $result->user_id_list))
			{
				array_push($result->user_id_list, $edit->userid);
			}
		}
		// IP address
		$nc = $xpath->query ("wiki:contributor/wiki:ip", $node);
		foreach ($nc as $n)
		{
			$edit->userid = $n->firstChild->nodeValue;
			if (!in_array($edit->userid, $result->user_id_list))
			{
				array_push($result->user_id_list, $edit->userid);
			}
		}
		
		// name
		$nc = $xpath->query ("wiki:contributor/wiki:username", $node);
		foreach ($nc as $n)
		{
			$edit->username = $n->firstChild->nodeValue;
			$result->user_name_list[$edit->userid] = $edit->username;
		}
		
		// text
		$nc = $xpath->query ("wiki:text", $node);
		foreach ($nc as $n)
		{
			$edit->text = $n->firstChild->nodeValue;
		}
		
		
		// text is JSON, so we should process that here...
		
		
		$num_edits = count($result->edits);
		if ($num_edits > 1)
		{
		
			$previous_edit = json_decode($result->edits[$num_edits - 1]->text);
			$this_edit = json_decode($edit->text);
			
			$diff = compare($previous_edit, $this_edit);
			
			foreach ($diff as $k => $v)
			{
				switch ($k)
				{
					case 'descriptions':
						$result->description_edits += count($v);
						break;

					case 'labels':
						$result->label_edits += count($v);
						break;
						
					default:
						if (!isset($result->property_edits[$k]))
						{
							$result->property_edits[$k] = 0;
						}
						$result->property_edits[$k] += 1;
						break;
				
				}
			}
	
		
			// print_r($this_edit);
		}
		
		
		
		if (($limit == 0) or ($revision_count < $limit))
		{
			array_push($result->edits, $edit);
		}
		else
		{
			break;
		}
		$revision_count++;
		
	}
	
	// clean
	unset($result->edits);
	
	print_r($result);
	
	return $result;
	
}



$filename = 'Q104428910.xml';

$filename = 'Q28300019.xml';

$filename = 'Q99838137.xml';


$xml = file_get_contents($filename);

$result = xml_edits($xml);

//print_r($result);

/*
$x = array('en', 'de');
$y = array('en', 'de', 'ast');

print_r($x);
print_r($y);

$z = array_merge(array_diff($x, $y), array_diff($y, $x));

print_r($z);
*/

//print_r($result);



/*
$json1 = '{"type":"item","id":"Q104428910","labels":{"en":{"language":"en","value":"Ceratosphinctes (Ammonitina, Kimmeridgian) in\u00a0Mexico: from rare but\u00a0typical inhabitant of\u00a0west-Tethyan epioceanic and\u00a0epicontinental waters to\u00a0a\u00a0geographically widespread ammonite genus"},"nl":{"language":"nl","value":"Ceratosphinctes (Ammonitina, Kimmeridgian) in\u00a0Mexico: from rare but\u00a0typical inhabitant of\u00a0west-Tethyan epioceanic and\u00a0epicontinental waters to\u00a0a\u00a0geographically widespread ammonite genus"}},"descriptions":{"nl":{"language":"nl","value":"wetenschappelijk artikel"},"es":{"language":"es","value":"art\u00edculo cient\u00edfico publicado en 2006"},"zh-my":{"language":"zh-my","value":"2006\u5e74\u5b66\u672f\u6587\u7ae0"},"vi":{"language":"vi","value":"b\u00e0i b\u00e1o khoa h\u1ecdc"},"zh-tw":{"language":"zh-tw","value":"2006\u5e74\u5b78\u8853\u6587\u7ae0"},"he":{"language":"he","value":"\u05de\u05d0\u05de\u05e8 \u05de\u05d3\u05e2\u05d9"},"en":{"language":"en","value":"scientific article published in March 2006"},"tg-cyrl":{"language":"tg-cyrl","value":"\u043c\u0430\u049b\u043e\u043b\u0430\u0438 \u0438\u043b\u043c\u04e3"},"tl":{"language":"tl","value":"artikulong pang-agham"},"uk":{"language":"uk","value":"\u043d\u0430\u0443\u043a\u043e\u0432\u0430 \u0441\u0442\u0430\u0442\u0442\u044f, \u043e\u043f\u0443\u0431\u043b\u0456\u043a\u043e\u0432\u0430\u043d\u0430 \u0432 \u0431\u0435\u0440\u0435\u0437\u043d\u0456 2006"},"sv":{"language":"sv","value":"vetenskaplig artikel"},"oc":{"language":"oc","value":"article scientific"},"sr":{"language":"sr","value":"\u043d\u0430\u0443\u0447\u043d\u0438 \u0447\u043b\u0430\u043d\u0430\u043a"},"zh-hant":{"language":"zh-hant","value":"2006\u5e74\u5b78\u8853\u6587\u7ae0"},"zh-hk":{"language":"zh-hk","value":"2006\u5e74\u5b78\u8853\u6587\u7ae0"},"wuu":{"language":"wuu","value":"2006\u5e74\u5b66\u672f\u6587\u7ae0"},"bg":{"language":"bg","value":"\u043d\u0430\u0443\u0447\u043d\u0430 \u0441\u0442\u0430\u0442\u0438\u044f"},"ar":{"language":"ar","value":"\u0645\u0642\u0627\u0644\u0629 \u0639\u0644\u0645\u064a\u0629 \u0646\u0634\u0631\u062a \u0641\u064a \u0645\u0627\u0631\u0633 2006"},"ro":{"language":"ro","value":"articol \u0219tiin\u021bific"},"fr":{"language":"fr","value":"article scientifique"},"ca":{"language":"ca","value":"article cient\u00edfic"},"eo":{"language":"eo","value":"scienca artikolo"},"pt-br":{"language":"pt-br","value":"artigo cient\u00edfico"},"zh-mo":{"language":"zh-mo","value":"2006\u5e74\u5b78\u8853\u6587\u7ae0"},"sr-el":{"language":"sr-el","value":"nau\u010dni \u010dlanak"},"hu":{"language":"hu","value":"tudom\u00e1nyos cikk"},"sk":{"language":"sk","value":"vedeck\u00fd \u010dl\u00e1nok"},"nb":{"language":"nb","value":"vitenskapelig artikkel"},"et":{"language":"et","value":"teaduslik artikkel"},"nn":{"language":"nn","value":"vitskapeleg artikkel"},"zh":{"language":"zh","value":"2006\u5e74\u5b66\u672f\u6587\u7ae0"},"sq":{"language":"sq","value":"artikull shkencor"},"yue":{"language":"yue","value":"2006\u5e74\u5b78\u8853\u6587\u7ae0"},"it":{"language":"it","value":"articolo scientifico"},"cs":{"language":"cs","value":"v\u011bdeck\u00fd \u010dl\u00e1nek"},"fi":{"language":"fi","value":"tieteellinen artikkeli"},"da":{"language":"da","value":"videnskabelig artikel udgivet marts 2006"},"pt":{"language":"pt","value":"artigo cient\u00edfico"},"bn":{"language":"bn","value":"\u09ae\u09be\u09b0\u09cd\u099a \u09e8\u09e6\u09e6\u09ec-\u098f \u09aa\u09cd\u09b0\u0995\u09be\u09b6\u09bf\u09a4 \u09ac\u09c8\u099c\u09cd\u099e\u09be\u09a8\u09bf\u0995 \u09a8\u09bf\u09ac\u09a8\u09cd\u09a7"},"de":{"language":"de","value":"wissenschaftlicher Artikel"},"ru":{"language":"ru","value":"\u043d\u0430\u0443\u0447\u043d\u0430\u044f \u0441\u0442\u0430\u0442\u044c\u044f"},"ka":{"language":"ka","value":"\u10e1\u10d0\u10db\u10d4\u10ea\u10dc\u10d8\u10d4\u10e0\u10dd \u10e1\u10e2\u10d0\u10e2\u10d8\u10d0"},"tr":{"language":"tr","value":"bilimsel makale"},"ast":{"language":"ast","value":"art\u00edculu cient\u00edficu"},"gl":{"language":"gl","value":"artigo cient\u00edfico"},"pl":{"language":"pl","value":"artyku\u0142 naukowy"},"el":{"language":"el","value":"\u03b5\u03c0\u03b9\u03c3\u03c4\u03b7\u03bc\u03bf\u03bd\u03b9\u03ba\u03cc \u03ac\u03c1\u03b8\u03c1\u03bf"},"nan":{"language":"nan","value":"2006 n\u00ee l\u016bn-b\u00fbn"},"sr-ec":{"language":"sr-ec","value":"\u043d\u0430\u0443\u0447\u043d\u0438 \u0447\u043b\u0430\u043d\u0430\u043a"},"en-ca":{"language":"en-ca","value":"scientific article published in March 2006"},"zh-hans":{"language":"zh-hans","value":"2006\u5e74\u5b66\u672f\u6587\u7ae0"},"en-gb":{"language":"en-gb","value":"scientific article published in March 2006"},"ja":{"language":"ja","value":"2006\u5e74\u306e\u8ad6\u6587"},"zh-cn":{"language":"zh-cn","value":"2006\u5e74\u5b66\u672f\u6587\u7ae0"},"zh-sg":{"language":"zh-sg","value":"2006\u5e74\u5b66\u672f\u6587\u7ae0"},"th":{"language":"th","value":"\u0e1a\u0e17\u0e04\u0e27\u0e32\u0e21\u0e17\u0e32\u0e07\u0e27\u0e34\u0e17\u0e22\u0e32\u0e28\u0e32\u0e2a\u0e15\u0e23\u0e4c"},"id":{"language":"id","value":"artikel ilmiah"},"ko":{"language":"ko","value":"2006\ub144 \ub17c\ubb38"}},"aliases":[],"claims":{"P433":[{"mainsnak":{"snaktype":"value","property":"P433","hash":"69d52212d282a400dfd773d3aea95b8e4f7c9e2f","datavalue":{"value":"2","type":"string"}},"type":"statement","id":"Q104428910$A75FD99D-A388-4725-9022-449ACD5615D6","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P356":[{"mainsnak":{"snaktype":"value","property":"P356","hash":"75e6be75b74cf0dffe73a88f2102894c81a0085a","datavalue":{"value":"10.1016\/J.GEOBIOS.2004.11.006","type":"string"}},"type":"statement","id":"Q104428910$1090E2D3-5FB9-443D-96F7-0EE5D79275D5","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P31":[{"mainsnak":{"snaktype":"value","property":"P31","hash":"29465f78f13add11b617f0de4ade56cd1122c19c","datavalue":{"value":{"entity-type":"item","numeric-id":13442814,"id":"Q13442814"},"type":"wikibase-entityid"}},"type":"statement","id":"Q104428910$BFBAAFB7-786B-4A8A-95FA-98B8FDFE38C2","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P304":[{"mainsnak":{"snaktype":"value","property":"P304","hash":"2e02c6d957553a26c54d7365c4a6dc72203b69d1","datavalue":{"value":"255-266","type":"string"}},"type":"statement","id":"Q104428910$B1F73265-53E0-49E8-9C17-F9D8BBE0055C","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P407":[{"mainsnak":{"snaktype":"value","property":"P407","hash":"daf1c4fcb58181b02dff9cc89deb084004ddae4b","datavalue":{"value":{"entity-type":"item","numeric-id":1860,"id":"Q1860"},"type":"wikibase-entityid"}},"type":"statement","id":"Q104428910$7073676D-C46E-41D5-901A-5F823EC0B5A4","rank":"normal"}],"P1476":[{"mainsnak":{"snaktype":"value","property":"P1476","hash":"5e50137ea86f88d9ac577d21b5223e5e45c2bf5a","datavalue":{"value":{"text":"Ceratosphinctes (Ammonitina, Kimmeridgian) in\u00a0Mexico: from rare but\u00a0typical inhabitant of\u00a0west-Tethyan epioceanic and\u00a0epicontinental waters to\u00a0a\u00a0geographically widespread ammonite genus","language":"en"},"type":"monolingualtext"}},"type":"statement","id":"Q104428910$F24AF4FD-9BC6-4406-A1D5-775D37667473","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P478":[{"mainsnak":{"snaktype":"value","property":"P478","hash":"ee2a72d9d049166e74fd246e7dc8ac8357bc420d","datavalue":{"value":"39","type":"string"}},"type":"statement","id":"Q104428910$D7861BAF-838D-4C81-8A01-6E59D0CF3399","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P2093":[{"mainsnak":{"snaktype":"value","property":"P2093","hash":"0aefb4b00dbbe2ffaa5a60765caeb8db7bcb474e","datavalue":{"value":"Federico Ol\u00f3riz","type":"string"}},"type":"statement","qualifiers":{"P1545":[{"snaktype":"value","property":"P1545","hash":"2a1ced1dca90648ea7e306acbadd74fc81a10722","datavalue":{"value":"1","type":"string"}}]},"qualifiers-order":["P1545"],"id":"Q104428910$20C2778D-13E7-4973-9DB7-86C977D6A08B","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]},{"mainsnak":{"snaktype":"value","property":"P2093","hash":"0e6f65b8e8805dc01e2d3ebe76684cf964dfda55","datavalue":{"value":"Ana Bertha Villase\u00f1or","type":"string"}},"type":"statement","qualifiers":{"P1545":[{"snaktype":"value","property":"P1545","hash":"7241753c62a310cf84895620ea82250dcea65835","datavalue":{"value":"2","type":"string"}}]},"qualifiers-order":["P1545"],"id":"Q104428910$F72B23E0-05E7-4732-8A44-E3B0AFFA37D5","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P1433":[{"mainsnak":{"snaktype":"value","property":"P1433","hash":"a5f1112048f14fb470e21a1f452e48c6efebda82","datavalue":{"value":{"entity-type":"item","numeric-id":210015,"id":"Q210015"},"type":"wikibase-entityid"}},"type":"statement","id":"Q104428910$6698A545-E781-40B7-BB90-E2762323781A","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P577":[{"mainsnak":{"snaktype":"value","property":"P577","hash":"cf971f82c154c6e597346f6b50ace27af83c5da9","datavalue":{"value":{"time":"+2006-03-00T00:00:00Z","timezone":0,"before":0,"after":0,"precision":10,"calendarmodel":"http:\/\/www.wikidata.org\/entity\/Q1985727"},"type":"time"}},"type":"statement","id":"Q104428910$893EE06C-78B8-42B0-AC54-FB31AE19251A","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P953":[{"mainsnak":{"snaktype":"value","property":"P953","hash":"8f1c11aacbf5dc02ad125c1e4b1c66e4658704bf","datavalue":{"value":"http:\/\/dx.doi.org\/10.1016\/j.geobios.2004.11.006","type":"string"}},"type":"statement","id":"Q104428910$62C5630B-C86D-4F16-BA63-3AF012041383","rank":"normal"}],"P50":[{"mainsnak":{"snaktype":"value","property":"P50","hash":"eff3320ec87451d61b0e824fa22f301c5c897240","datavalue":{"value":{"entity-type":"item","numeric-id":55946619,"id":"Q55946619"},"type":"wikibase-entityid"}},"type":"statement","qualifiers":{"P1545":[{"snaktype":"value","property":"P1545","hash":"2a1ced1dca90648ea7e306acbadd74fc81a10722","datavalue":{"value":"1","type":"string"}}],"P1932":[{"snaktype":"value","property":"P1932","hash":"ab49093283aa47e0e4f70582c56c86931adbd448","datavalue":{"value":"Federico Ol\u00f3riz","type":"string"}}]},"qualifiers-order":["P1545","P1932"],"id":"Q104428910$c90fb2ab-43d2-86aa-1082-47ef7cc46b70","rank":"normal"}]},"sitelinks":[]}';


 


$json2 = '{"type":"item","id":"Q104428910","labels":{"en":{"language":"en","value":"Ceratosphinctes (Ammonitina, Kimmeridgian) in\u00a0Mexico: from rare but\u00a0typical inhabitant of\u00a0west-Tethyan epioceanic and\u00a0epicontinental waters to\u00a0a\u00a0geographically widespread ammonite genus"},"nl":{"language":"nl","value":"Ceratosphinctes (Ammonitina, Kimmeridgian) in\u00a0Mexico: from rare but\u00a0typical inhabitant of\u00a0west-Tethyan epioceanic and\u00a0epicontinental waters to\u00a0a\u00a0geographically widespread ammonite genus"}},"descriptions":{"nl":{"language":"nl","value":"wetenschappelijk artikel"},"es":{"language":"es","value":"art\u00edculo cient\u00edfico publicado en 2006"},"zh-my":{"language":"zh-my","value":"2006\u5e74\u5b66\u672f\u6587\u7ae0"},"vi":{"language":"vi","value":"b\u00e0i b\u00e1o khoa h\u1ecdc"},"zh-tw":{"language":"zh-tw","value":"2006\u5e74\u5b78\u8853\u6587\u7ae0"},"he":{"language":"he","value":"\u05de\u05d0\u05de\u05e8 \u05de\u05d3\u05e2\u05d9"},"en":{"language":"en","value":"scientific article published in March 2006"},"tg-cyrl":{"language":"tg-cyrl","value":"\u043c\u0430\u049b\u043e\u043b\u0430\u0438 \u0438\u043b\u043c\u04e3"},"tl":{"language":"tl","value":"artikulong pang-agham"},"uk":{"language":"uk","value":"\u043d\u0430\u0443\u043a\u043e\u0432\u0430 \u0441\u0442\u0430\u0442\u0442\u044f, \u043e\u043f\u0443\u0431\u043b\u0456\u043a\u043e\u0432\u0430\u043d\u0430 \u0432 \u0431\u0435\u0440\u0435\u0437\u043d\u0456 2006"},"sv":{"language":"sv","value":"vetenskaplig artikel"},"oc":{"language":"oc","value":"article scientific"},"sr":{"language":"sr","value":"\u043d\u0430\u0443\u0447\u043d\u0438 \u0447\u043b\u0430\u043d\u0430\u043a"},"zh-hant":{"language":"zh-hant","value":"2006\u5e74\u5b78\u8853\u6587\u7ae0"},"zh-hk":{"language":"zh-hk","value":"2006\u5e74\u5b78\u8853\u6587\u7ae0"},"wuu":{"language":"wuu","value":"2006\u5e74\u5b66\u672f\u6587\u7ae0"},"bg":{"language":"bg","value":"\u043d\u0430\u0443\u0447\u043d\u0430 \u0441\u0442\u0430\u0442\u0438\u044f"},"ar":{"language":"ar","value":"\u0645\u0642\u0627\u0644\u0629 \u0639\u0644\u0645\u064a\u0629 \u0646\u0634\u0631\u062a \u0641\u064a \u0645\u0627\u0631\u0633 2006"},"ro":{"language":"ro","value":"articol \u0219tiin\u021bific"},"fr":{"language":"fr","value":"article scientifique"},"ca":{"language":"ca","value":"article cient\u00edfic"},"eo":{"language":"eo","value":"scienca artikolo"},"pt-br":{"language":"pt-br","value":"artigo cient\u00edfico"},"zh-mo":{"language":"zh-mo","value":"2006\u5e74\u5b78\u8853\u6587\u7ae0"},"sr-el":{"language":"sr-el","value":"nau\u010dni \u010dlanak"},"hu":{"language":"hu","value":"tudom\u00e1nyos cikk"},"sk":{"language":"sk","value":"vedeck\u00fd \u010dl\u00e1nok"},"nb":{"language":"nb","value":"vitenskapelig artikkel"},"et":{"language":"et","value":"teaduslik artikkel"},"nn":{"language":"nn","value":"vitskapeleg artikkel"},"zh":{"language":"zh","value":"2006\u5e74\u5b66\u672f\u6587\u7ae0"},"sq":{"language":"sq","value":"artikull shkencor"},"yue":{"language":"yue","value":"2006\u5e74\u5b78\u8853\u6587\u7ae0"},"it":{"language":"it","value":"articolo scientifico"},"cs":{"language":"cs","value":"v\u011bdeck\u00fd \u010dl\u00e1nek"},"fi":{"language":"fi","value":"tieteellinen artikkeli"},"da":{"language":"da","value":"videnskabelig artikel udgivet marts 2006"},"pt":{"language":"pt","value":"artigo cient\u00edfico"},"bn":{"language":"bn","value":"\u09ae\u09be\u09b0\u09cd\u099a \u09e8\u09e6\u09e6\u09ec-\u098f \u09aa\u09cd\u09b0\u0995\u09be\u09b6\u09bf\u09a4 \u09ac\u09c8\u099c\u09cd\u099e\u09be\u09a8\u09bf\u0995 \u09a8\u09bf\u09ac\u09a8\u09cd\u09a7"},"de":{"language":"de","value":"wissenschaftlicher Artikel"},"ru":{"language":"ru","value":"\u043d\u0430\u0443\u0447\u043d\u0430\u044f \u0441\u0442\u0430\u0442\u044c\u044f"},"ka":{"language":"ka","value":"\u10e1\u10d0\u10db\u10d4\u10ea\u10dc\u10d8\u10d4\u10e0\u10dd \u10e1\u10e2\u10d0\u10e2\u10d8\u10d0"},"tr":{"language":"tr","value":"bilimsel makale"},"ast":{"language":"ast","value":"art\u00edculu cient\u00edficu"},"gl":{"language":"gl","value":"artigo cient\u00edfico"},"pl":{"language":"pl","value":"artyku\u0142 naukowy"},"el":{"language":"el","value":"\u03b5\u03c0\u03b9\u03c3\u03c4\u03b7\u03bc\u03bf\u03bd\u03b9\u03ba\u03cc \u03ac\u03c1\u03b8\u03c1\u03bf"},"nan":{"language":"nan","value":"2006 n\u00ee l\u016bn-b\u00fbn"},"sr-ec":{"language":"sr-ec","value":"\u043d\u0430\u0443\u0447\u043d\u0438 \u0447\u043b\u0430\u043d\u0430\u043a"},"en-ca":{"language":"en-ca","value":"scientific article published in March 2006"},"zh-hans":{"language":"zh-hans","value":"2006\u5e74\u5b66\u672f\u6587\u7ae0"},"en-gb":{"language":"en-gb","value":"scientific article published in March 2006"},"ja":{"language":"ja","value":"2006\u5e74\u306e\u8ad6\u6587"},"zh-cn":{"language":"zh-cn","value":"2006\u5e74\u5b66\u672f\u6587\u7ae0"},"zh-sg":{"language":"zh-sg","value":"2006\u5e74\u5b66\u672f\u6587\u7ae0"},"th":{"language":"th","value":"\u0e1a\u0e17\u0e04\u0e27\u0e32\u0e21\u0e17\u0e32\u0e07\u0e27\u0e34\u0e17\u0e22\u0e32\u0e28\u0e32\u0e2a\u0e15\u0e23\u0e4c"},"id":{"language":"id","value":"artikel ilmiah"},"ko":{"language":"ko","value":"2006\ub144 \ub17c\ubb38"}},"aliases":[],"claims":{"P433":[{"mainsnak":{"snaktype":"value","property":"P433","hash":"69d52212d282a400dfd773d3aea95b8e4f7c9e2f","datavalue":{"value":"2","type":"string"}},"type":"statement","id":"Q104428910$A75FD99D-A388-4725-9022-449ACD5615D6","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P356":[{"mainsnak":{"snaktype":"value","property":"P356","hash":"75e6be75b74cf0dffe73a88f2102894c81a0085a","datavalue":{"value":"10.1016\/J.GEOBIOS.2004.11.006","type":"string"}},"type":"statement","id":"Q104428910$1090E2D3-5FB9-443D-96F7-0EE5D79275D5","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P31":[{"mainsnak":{"snaktype":"value","property":"P31","hash":"29465f78f13add11b617f0de4ade56cd1122c19c","datavalue":{"value":{"entity-type":"item","numeric-id":13442814,"id":"Q13442814"},"type":"wikibase-entityid"}},"type":"statement","id":"Q104428910$BFBAAFB7-786B-4A8A-95FA-98B8FDFE38C2","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P304":[{"mainsnak":{"snaktype":"value","property":"P304","hash":"2e02c6d957553a26c54d7365c4a6dc72203b69d1","datavalue":{"value":"255-266","type":"string"}},"type":"statement","id":"Q104428910$B1F73265-53E0-49E8-9C17-F9D8BBE0055C","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P407":[{"mainsnak":{"snaktype":"value","property":"P407","hash":"daf1c4fcb58181b02dff9cc89deb084004ddae4b","datavalue":{"value":{"entity-type":"item","numeric-id":1860,"id":"Q1860"},"type":"wikibase-entityid"}},"type":"statement","id":"Q104428910$7073676D-C46E-41D5-901A-5F823EC0B5A4","rank":"normal"}],"P1476":[{"mainsnak":{"snaktype":"value","property":"P1476","hash":"5e50137ea86f88d9ac577d21b5223e5e45c2bf5a","datavalue":{"value":{"text":"Ceratosphinctes (Ammonitina, Kimmeridgian) in\u00a0Mexico: from rare but\u00a0typical inhabitant of\u00a0west-Tethyan epioceanic and\u00a0epicontinental waters to\u00a0a\u00a0geographically widespread ammonite genus","language":"en"},"type":"monolingualtext"}},"type":"statement","id":"Q104428910$F24AF4FD-9BC6-4406-A1D5-775D37667473","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P478":[{"mainsnak":{"snaktype":"value","property":"P478","hash":"ee2a72d9d049166e74fd246e7dc8ac8357bc420d","datavalue":{"value":"39","type":"string"}},"type":"statement","id":"Q104428910$D7861BAF-838D-4C81-8A01-6E59D0CF3399","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P2093":[{"mainsnak":{"snaktype":"value","property":"P2093","hash":"0e6f65b8e8805dc01e2d3ebe76684cf964dfda55","datavalue":{"value":"Ana Bertha Villase\u00f1or","type":"string"}},"type":"statement","qualifiers":{"P1545":[{"snaktype":"value","property":"P1545","hash":"7241753c62a310cf84895620ea82250dcea65835","datavalue":{"value":"2","type":"string"}}]},"qualifiers-order":["P1545"],"id":"Q104428910$F72B23E0-05E7-4732-8A44-E3B0AFFA37D5","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P1433":[{"mainsnak":{"snaktype":"value","property":"P1433","hash":"a5f1112048f14fb470e21a1f452e48c6efebda82","datavalue":{"value":{"entity-type":"item","numeric-id":210015,"id":"Q210015"},"type":"wikibase-entityid"}},"type":"statement","id":"Q104428910$6698A545-E781-40B7-BB90-E2762323781A","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P577":[{"mainsnak":{"snaktype":"value","property":"P577","hash":"cf971f82c154c6e597346f6b50ace27af83c5da9","datavalue":{"value":{"time":"+2006-03-00T00:00:00Z","timezone":0,"before":0,"after":0,"precision":10,"calendarmodel":"http:\/\/www.wikidata.org\/entity\/Q1985727"},"type":"time"}},"type":"statement","id":"Q104428910$893EE06C-78B8-42B0-AC54-FB31AE19251A","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P953":[{"mainsnak":{"snaktype":"value","property":"P953","hash":"8f1c11aacbf5dc02ad125c1e4b1c66e4658704bf","datavalue":{"value":"http:\/\/dx.doi.org\/10.1016\/j.geobios.2004.11.006","type":"string"}},"type":"statement","id":"Q104428910$62C5630B-C86D-4F16-BA63-3AF012041383","rank":"normal"}],"P50":[{"mainsnak":{"snaktype":"value","property":"P50","hash":"eff3320ec87451d61b0e824fa22f301c5c897240","datavalue":{"value":{"entity-type":"item","numeric-id":55946619,"id":"Q55946619"},"type":"wikibase-entityid"}},"type":"statement","qualifiers":{"P1545":[{"snaktype":"value","property":"P1545","hash":"2a1ced1dca90648ea7e306acbadd74fc81a10722","datavalue":{"value":"1","type":"string"}}],"P1932":[{"snaktype":"value","property":"P1932","hash":"ab49093283aa47e0e4f70582c56c86931adbd448","datavalue":{"value":"Federico Ol\u00f3riz","type":"string"}}]},"qualifiers-order":["P1545","P1932"],"id":"Q104428910$c90fb2ab-43d2-86aa-1082-47ef7cc46b70","rank":"normal"}]},"sitelinks":[]}';


$json1 = '{"type":"item","id":"Q104428910","labels":{"en":{"language":"en","value":"Ceratosphinctes (Ammonitina, Kimmeridgian) in\u00a0Mexico: from rare but\u00a0typical inhabitant of\u00a0west-Tethyan epioceanic and\u00a0epicontinental waters to\u00a0a\u00a0geographically widespread ammonite genus"}},"descriptions":[],"aliases":[],"claims":{"P433":[{"mainsnak":{"snaktype":"value","property":"P433","hash":"69d52212d282a400dfd773d3aea95b8e4f7c9e2f","datavalue":{"value":"2","type":"string"}},"type":"statement","id":"Q104428910$A75FD99D-A388-4725-9022-449ACD5615D6","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P356":[{"mainsnak":{"snaktype":"value","property":"P356","hash":"75e6be75b74cf0dffe73a88f2102894c81a0085a","datavalue":{"value":"10.1016\/J.GEOBIOS.2004.11.006","type":"string"}},"type":"statement","id":"Q104428910$1090E2D3-5FB9-443D-96F7-0EE5D79275D5","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P31":[{"mainsnak":{"snaktype":"value","property":"P31","hash":"29465f78f13add11b617f0de4ade56cd1122c19c","datavalue":{"value":{"entity-type":"item","numeric-id":13442814,"id":"Q13442814"},"type":"wikibase-entityid"}},"type":"statement","id":"Q104428910$BFBAAFB7-786B-4A8A-95FA-98B8FDFE38C2","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P304":[{"mainsnak":{"snaktype":"value","property":"P304","hash":"2e02c6d957553a26c54d7365c4a6dc72203b69d1","datavalue":{"value":"255-266","type":"string"}},"type":"statement","id":"Q104428910$B1F73265-53E0-49E8-9C17-F9D8BBE0055C","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P407":[{"mainsnak":{"snaktype":"value","property":"P407","hash":"daf1c4fcb58181b02dff9cc89deb084004ddae4b","datavalue":{"value":{"entity-type":"item","numeric-id":1860,"id":"Q1860"},"type":"wikibase-entityid"}},"type":"statement","id":"Q104428910$7073676D-C46E-41D5-901A-5F823EC0B5A4","rank":"normal"}],"P1476":[{"mainsnak":{"snaktype":"value","property":"P1476","hash":"5e50137ea86f88d9ac577d21b5223e5e45c2bf5a","datavalue":{"value":{"text":"Ceratosphinctes (Ammonitina, Kimmeridgian) in\u00a0Mexico: from rare but\u00a0typical inhabitant of\u00a0west-Tethyan epioceanic and\u00a0epicontinental waters to\u00a0a\u00a0geographically widespread ammonite genus","language":"en"},"type":"monolingualtext"}},"type":"statement","id":"Q104428910$F24AF4FD-9BC6-4406-A1D5-775D37667473","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P478":[{"mainsnak":{"snaktype":"value","property":"P478","hash":"ee2a72d9d049166e74fd246e7dc8ac8357bc420d","datavalue":{"value":"39","type":"string"}},"type":"statement","id":"Q104428910$D7861BAF-838D-4C81-8A01-6E59D0CF3399","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P2093":[{"mainsnak":{"snaktype":"value","property":"P2093","hash":"0aefb4b00dbbe2ffaa5a60765caeb8db7bcb474e","datavalue":{"value":"Federico Ol\u00f3riz","type":"string"}},"type":"statement","qualifiers":{"P1545":[{"snaktype":"value","property":"P1545","hash":"2a1ced1dca90648ea7e306acbadd74fc81a10722","datavalue":{"value":"1","type":"string"}}]},"qualifiers-order":["P1545"],"id":"Q104428910$20C2778D-13E7-4973-9DB7-86C977D6A08B","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]},{"mainsnak":{"snaktype":"value","property":"P2093","hash":"0e6f65b8e8805dc01e2d3ebe76684cf964dfda55","datavalue":{"value":"Ana Bertha Villase\u00f1or","type":"string"}},"type":"statement","qualifiers":{"P1545":[{"snaktype":"value","property":"P1545","hash":"7241753c62a310cf84895620ea82250dcea65835","datavalue":{"value":"2","type":"string"}}]},"qualifiers-order":["P1545"],"id":"Q104428910$F72B23E0-05E7-4732-8A44-E3B0AFFA37D5","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P1433":[{"mainsnak":{"snaktype":"value","property":"P1433","hash":"a5f1112048f14fb470e21a1f452e48c6efebda82","datavalue":{"value":{"entity-type":"item","numeric-id":210015,"id":"Q210015"},"type":"wikibase-entityid"}},"type":"statement","id":"Q104428910$6698A545-E781-40B7-BB90-E2762323781A","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P577":[{"mainsnak":{"snaktype":"value","property":"P577","hash":"cf971f82c154c6e597346f6b50ace27af83c5da9","datavalue":{"value":{"time":"+2006-03-00T00:00:00Z","timezone":0,"before":0,"after":0,"precision":10,"calendarmodel":"http:\/\/www.wikidata.org\/entity\/Q1985727"},"type":"time"}},"type":"statement","id":"Q104428910$893EE06C-78B8-42B0-AC54-FB31AE19251A","rank":"normal","references":[{"hash":"76fb25758417766ed483ac3cf4e06b38d2324155","snaks":{"P248":[{"snaktype":"value","property":"P248","hash":"a185ae64d472c92d128e6bcb1de168a4b46a2019","datavalue":{"value":{"entity-type":"item","numeric-id":5188229,"id":"Q5188229"},"type":"wikibase-entityid"}}],"P854":[{"snaktype":"value","property":"P854","hash":"c51c34d51b391f04d9ae9911bf56c38c4051d2ff","datavalue":{"value":"https:\/\/api.crossref.org\/v1\/works\/10.1016\/j.geobios.2004.11.006","type":"string"}}]},"snaks-order":["P248","P854"]}]}],"P953":[{"mainsnak":{"snaktype":"value","property":"P953","hash":"8f1c11aacbf5dc02ad125c1e4b1c66e4658704bf","datavalue":{"value":"http:\/\/dx.doi.org\/10.1016\/j.geobios.2004.11.006","type":"string"}},"type":"statement","id":"Q104428910$62C5630B-C86D-4F16-BA63-3AF012041383","rank":"normal"}]},"sitelinks":[]}';


$obj1 = json_decode($json1);

$obj2 = json_decode($json2);

print_r($obj1);

// simplyfy
$labels1 = array();
foreach ($obj1->labels as $k => $v)
{
	$labels1[] = $k;
}

$claims1 = array();

foreach ($obj1->claims as $k => $v)
{
	$claims1[$k] = count($v);
}

//------
$labels2 = array();
foreach ($obj2->labels as $k => $v)
{
	$labels2[] = $k;
}

$claims2 = array();

foreach ($obj2->claims as $k => $v)
{
	$claims2[$k] = count($v);
}

print_r($labels1);
print_r($labels2);


print_r($claims1);
print_r($claims2);

// what things get edited?
// list of properties that are changed


// timing of edits


// connectivity, what connects to the items added?


*/







