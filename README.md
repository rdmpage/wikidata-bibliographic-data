# wikidata-bibliographic-data
Tools to upload bibliographic data to Wikidata

## Added

**IA** means there are PDFs of the articles in Internet Archive.

Journal | ISSN | Wikidata | Notes
--|--|--|--
A | | | 
Acta Botánica Venezuélica | | | JSTOR
Adansonia nouvelle série	 | 0001-804X | Q58814054 | No external identifiers
Allertonia | | | JSTOR
Annales Botanici Fennici | | | JSTOR
B | | | 
Basteria	| 0005-6219 | Q21069434 | IA
Beaufortia | | | IA
Bijdragen Tot de Dierkunde | | | IA, DOIs
Braueria | 1026-3632 | | IA
Bulletin of The British Arachnological Society | 0524-4994 | | IA
Bulletin of the Osaka Museum of Natural History | 0078-6675 | | IA
C | | | 
Cahiers de Biologie Marine | | | DataCite DOIs
D | | | 
E | | | 
Entonomotaxonomia | 1000-7482 | | CNKI
F | | | 
G | | | 
H | | | 
I | | | 
J | | | 
Journal of Arachnology | 0161-8202 | | JSTOR
Journal of The Malayan Branch of The Royal Asiatic Society | 2304-7550 | | JSTOR
J | | | 
K | | | 
Kirkia | | | JSTOR
L | | | 
Lindbergia | | | JSTOR
M | | | 
Memoirs of Museum Victoria | | | IA
Memoirs of the Museum of Victoria | | | IA
Memoirs of the National Museum of Victoria | | | IA
Memoirs of the National Museum, Melbourne | | | IA
Molluscan Research | | | CSIRO and Mapress
Mosquito Systematics | | | BHL parts IA
N | | | 
New Zealand Oceanographic Institute Memoir |0083-7903 |Q21385262 | IA
O | | |
Odonatologica | 0375-0183 |Q15758632 | IA
P | | | 
Pacific Insects | 0030-8714 | Q7122498 | IA
Peckhamia | 2161-8526 | Q7158750 | IA
Proceedings of the California Academy of Sciences | 0068-547X | | IA
Proceedings of the Malacological Society of London | | | CrossRef DOIs have journal as Journal of Molluscan Studies
Q | | | 
R | | |
Records of the Auckland Institute and Museum | 0067-0464 | Q15214730 | JSTOR
Records of the Auckland Museum | 1174-9202, 2422-8567 | 	Q15756170 | JSTOR
Records of the Indian Museum | 0375-099X | Q41394003 | IA
S | | |
Selbyana | | | JSTOR
Sida, Contributions To Botany | | | JSTOR
Studies on the Fauna of Suriname and other Guyanas | 0300-5488 | | IA
T | | |
Tettigonia : Memoirs of The Orthopterological Society of Japan : 日本直翅類学会会誌 | | | Handle
Transactions of the Royal Society of New Zealand. Zoology | 0372-1396 | Q28535616 | IA
Transactions of the Royal Society of New Zealand. Botany | 0372-1361 | Q21034224 | IA
Transactions and Proceedings of the Royal Society of New Zealand | 1176-6166 | Q21556862 | IA
Transactions of the Sapporo Natural History Society 札幌博物学会会報 | | | Handle
U | | | 
V | | | 
W | | | 
X | | | 
Y | | | 
Z | | | 
Zoologische Mededelingen | 0024-0672, 1876-2174 | Q2358748 | IA




Once added to Wikidata we should update local database to have Wikidata Q number.

## Duplicates

When adding in bulk we can end up with duplicates. Simplest way to fix this is do a SPARQL query, download results as TSV file, then run ```php fix-duplicates.php``` to generate quick statements to merge duplicates. For example:

```
SELECT * 
WHERE
{
 ?item wdt:P1433 wd:Q51522336 . 
 ?item wdt:P1476 ?title .
 ?item wdt:P724 ?ia .
}
ORDER BY ?title
```

Note that de-duping on PDFs or Internet Archive ids can be problematic if same pages (and same file) has multiple articles (e.g there has been a bit of a mess with Bulletin of the British Arachnological Society e.g. http://localhost/~rpage/alec/?id=Q90005688 )

## Notes

```Not sure what you don't know here, so some basic pointers first:
- to import by DOI//PMID/PMCID/ORCID/ISBN, use https://tools.wmflabs.org/sourcemd/  . This can also add authors to papers if both are in ORCID
1/n```
https://twitter.com/EvoMRI/status/1094299776181587968

## Danger

Some references are entered in ways that make their discovery problematic, e.g. https://www.wikidata.org/wiki/Q62024319 “A new Toxomerus species from Chile (Diptera: Syrpliidae)” which has bibliographic data as qualifiers for ```published in’’’.

- published in Studia dipterologica
	- publication date 2013
	- volume 13
	- page(s) 317-331


### Old sourcemd

https://tools.wmflabs.org/sourcemd/index_old.php


## JSON-LD

To add to project:
```
composer require digitalbazaar/json-ld
```

## Language detection

For some works we will have information on title in different language and can add those directly. For others we may have only a single title but it could be non-English. Use https://github.com/patrickschur/language-detection to detect language of title of work. If not English we add the title as if it was English so that we have a Wikidata label in English, we also add the title in the detected language. We also set the language of the work (P407) to the detected language, on the assumption that it's likely to be the same language as that of the title.

To add to project:
```
composer require patrickschur/language-detection
```



## Retrieve mapping

To get a copy of the mapping between identifiers (e.g., DOIs, JSTOR) and/or metadata (e.g., journal, volume, page number) and Wikidata items we run a SPARQL query using bigquery.php which returns as TSV file with enough information to update the lcoal database. Use parse-query-result.php to generate the SQL statements to update local database.

## Add cited works that lack a DOI

Adding cited works that have DOIs is easy if those works also occur in Wikidata. But what about works that lack DOIs and/or are not it Wikidata? Seems we can add cited works that lack Wikidata items by setting the value of “cites” to “unknown value”. To do this is Quickstatements is tricky, but it seems we can use https://www.wikidata.org/wiki/Q53569537 which is ```placeholder for <somevalue>```. Using this enables us to add qualifiers, such as series ordinal and stated as to the citation. 

```
Q42258926	P2860	Q53569537	P1545	"5"	P1932	"Kiew R (2014) Two new species and one new subspecies of Ridleyandra (Gesneriaceae) from Peninsular Malaysia. Gardens’ Bulletin Singapore 66: 125–135."
```

We should also look at adding a reference URL as well so users can see where the information came from.

Note also that can only run this one reference at a time, otherwise we get all the qualifiers attached to a single citation (the challenge here is how do we uniquely identify what is essentially a b-node?).


## Examples

**Recherches sur les Scorpions appartenant ou déposés au Muséum d'Histoire naturelle de Genève. II. - Contribution à la connaissance de l'ancienne espèce Scorpius banaticus C. L. Koch, 1841, Euscorpius carpathicus (Linné, 1767**)  http://biostor.org/reference/134722

This is in Wikidata https://www.wikidata.org/wiki/Q36839457 via PubMed (I suspect), doesn’t have either BioStor or DOI, so would only find via OpenURL-style search :(


## Wikidata in other languages

Append ?uselang= to view Wikidata item in other language, e.g. https://www.wikidata.org/wiki/Q2663799?uselang=zh to view ```Yi Li Keng``` in Chinese (```耿以礼```)

## IPNI queries

If we have IPNI names in a triple store we can get Wikidata ids for authors of a name:

```
PREFIX tm: <http://def.seegrid.csiro.au/isotc211/iso19108/2002/temporal#>
prefix tn: <http://rs.tdwg.org/ontology/voc/TaxonName#>
prefix tm: <http://rs.tdwg.org/ontology/voc/Team#>
PREFIX wdt: <http://www.wikidata.org/prop/direct/>
PREFIX wd: <http://www.wikidata.org/entity/>	
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
SELECT * 
where
{
   <urn:lsid:ipni.org:names:399612-1:1.2.2.3> tn:authorteam ?authorteam  .
   ?authorteam tm:hasMember ?member .
   ?member tm:index ?order.
   ?member tm:role ?role.
   
   BIND( REPLACE( STR(?member),"urn:lsid:ipni.org:authors:","" ) AS ?ipni). 
   SERVICE <https://query.wikidata.org/sparql> 
   {
    ?wikidata wdt:P586 ?ipni .
    ?wikidata rdfs:label ?label .   
   }
  
   FILTER (lang(?label) = 'en')   
}
```

So we could do some author name matching based on order and strings. Note that some names will be problematic, and may want to try multiple languages. For example, for urn:lsid:ipni.org:names:399612-1:1.2.2.3 the names of the authors of the paper http://www.plantsystematics.com/CN/abstract/abstract1135.shtml are Keng Yi-Li ;Keng Pai-Chieh (English) and 耿以礼;耿伯介 (Chinese). Wikidata has these names in English as “Yi Li Keng” and “Geng Bojie” (with “Pai Chieh Keng” as an alias). The Chinese names match those in the article  metadata.

### Match across IPNI, publication, and Wikidata

```
prefix tn: <http://rs.tdwg.org/ontology/voc/TaxonName#>
prefix tm: <http://rs.tdwg.org/ontology/voc/Team#>
prefix tcom: <http://rs.tdwg.org/ontology/voc/Common#>
PREFIX wdt: <http://www.wikidata.org/prop/direct/>
PREFIX wd: <http://www.wikidata.org/entity/>	
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX schema: <http://schema.org/>
SELECT ?taxonname ?memberRole ?order ?doi ?roleName ?name ?ipni ?label
where
{
  # ipni
   VALUES ?taxonname {<urn:lsid:ipni.org:names:77088053-1>}
   ?taxonname tn:authorteam ?authorteam  .
   ?authorteam tm:hasMember ?member .
   ?member tm:index ?order.
   ?member tm:role ?memberRole.
  
   # my mapping
   ?taxonname tcom:publishedInCitation ?doi .
  
   # publication
   ?role schema:creator ?creator .
   ?role schema:roleName ?roleName .
   ?creator schema:name ?name .
  
   # wikidata
   BIND( REPLACE( STR(?member),"urn:lsid:ipni.org:authors:","" ) AS ?ipni). 
   SERVICE <https://query.wikidata.org/sparql> 
   {
    ?wikidata wdt:P586 ?ipni .
    ?wikidata rdfs:label ?label .   
   }
  
   FILTER (?order = ?roleName)  
   FILTER (lang(?name) = lang(?label))   
}
```

## Notes on journal sources

[Journals Online project](https://www.inasp.info/project/journals-online-project)

## Google Scholar plugins

Renders a PDF tab, seems to be visible only in mobile, e.g. iPad, see e.g. https://cmr.asm.org/content/17/1/136

```
<script type="text/javascript" async="async" src="https://scholar.google.com/scholar_js/casa.js"></script>
```

Highwire has code to add Scholar links on the fly ```highwire_google_scholar_sprinkle.js```.