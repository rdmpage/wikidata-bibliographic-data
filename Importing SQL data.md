# Notes on exporting microcitation database to Wikidata

## List of DOIs to add via CrossRef

```
SELECT CONCAT("'", guid, "',") FROM publications WHERE issn = "0010-065X" AND doi IS NOT NULL;

```

## Checking JSTOR harvest for issue parsing problem

In some cases JSTOR parsing code failed for issue numbers, and every article in a volume got assigned to the same issue. We can detect these using SQL:

```
SELECT volume, COUNT(distinct issue) FROM publications WHERE issn='0161-8202' AND jstor IS NOT NULL group BY volume ORDER BY CAST(volume as SIGNED);

```

This tells us how many distinct issue numbers there are for each volume, if it’s only one, or inconsistent across volumes then we may have a problem.

Deleting bad issues in Wikidata:

```
SELECT CONCAT("-", wikidata, char(9),'P433', char(9), '"', issue, '"')  FROM publications WHERE issn='0018-0831' AND volume < 24 AND wikidata IS NOT NULL AND issue IS NOT NULL;
```

## Filtering out administrivia

If we have all parts in a journal we may have things like instructions for authors, etc. with DOIs or other identifiers. This probably isn’t useful, so we can try and filter these out when generating a list of identifiers to process.

Can try and identify administrivia by counting distinct titles:

```
SELECT COUNT(title) AS c, title FROM publications WHERE issn='0161-8202' AND jstor IS NOT NULL group BY title ORDER BY c DESC;
```

Then to generate a list of GUIDs:

```
SELECT guid FROM publications WHERE issn='0161-8202' AND jstor IS NOT NULL AND doi IS NULL AND NOT(title = 'Back Matter');
```


## Adding DOIs to existing Wikidata items

Discovered that Bijdragen tot de dierkunde now has DOIs, so load data from CrossRef, then do SQL query to generate Quickstatements:

```
SELECT CONCAT(wikidata, char(9),'P356', char(9), '"', doi, '"', char(9), 'S248', char(9), 'Q5188229', char(9), 'S854', char(9), '"https://api.crossref.org/v1/works/', doi, '"') FROM publications WHERE issn='0067-8546' AND wikidata IS NOT NULL AND doi IS NOT NULL;
```

Sequel Pro displays tabs as ⇥ so need to find and replace before uploading to Wikidata.

## Adding DOI registration agency to existing Wikidata items

CrossRef Q5188229
ISTIC	Q30262675
DataCite Q821542

```
-- CrossRef
SELECT CONCAT(wikidata, char(9),'P356', char(9), '"', UPPER(doi), '"', char(9), 'P2378', char(9), 'Q5188229') FROM publications WHERE issn='2095-0845' AND wikidata IS NOT NULL AND doi IS NOT NULL;
```



Sequel Pro displays tabs as ⇥ so need to find and replace before uploading to Wikidata.


## Adding Zoobank to existing Wikidata items


```
SELECT CONCAT(wikidata, char(9),'P2007', char(9), '"', zoobank, '"') FROM publications WHERE issn='0374-1036' AND wikidata IS NOT NULL AND zoobank IS NOT NULL;
```

Sequel Pro displays tabs as ⇥ so need to find and replace before uploading to Wikidata.

## Adding JSTOR ids to items with DOIs that also are in JSTOR

```
SELECT CONCAT(wikidata, char(9),'P888', char(9), '"', jstor, '"') FROM publications WHERE issn='0363-6445' AND Wikidata IS NOT NULL AND jstor IS NOT NULL AND doi IS NOT NULL AND guid NOT LIKE "http%";
```

Sequel Pro displays tabs as ⇥ so need to find and replace before uploading to Wikidata.


## Adding CiNii to existing Wikidata items

For example can use microcitation/harvest_cinii_ris_add.php to read a CiNii RIS file (~/DropBox/BibScrapper/cinii) and output SQL to add CiNii id to references.


```
SELECT CONCAT(wikidata, char(9),'P2409', char(9), '"', cinii, '"', char(9), 'S248', char(9), 'Q10726338', char(9), 'S854', char(9), '"https://ci.nii.ac.jp/naid/', cinii, '"') FROM publications WHERE issn='0385-2423' AND wikidata IS NOT NULL AND cinii IS NOT NULL;
```

## Adding BioStor to existing Wikidata items


```
SELECT CONCAT(wikidata, char(9),'P5315', char(9), '"', biostor, '"') FROM publications WHERE issn='0004-2625' AND wikidata IS NOT NULL AND biostor IS NOT NULL;
```

## Adding internet archive to existing Wikidata items

```
SELECT CONCAT(wikidata, char(9),'P724', char(9), '"', internetarchive, '"') FROM publications WHERE issn='1280-9551' AND wikidata IS NOT NULL AND internetarchive IS NOT NULL;
```

## Adding Handles to existing Wikidata items

```
SELECT CONCAT(wikidata, char(9),'P1184', char(9), '"', handle, '"') FROM publications WHERE issn='0037-2870' AND wikidata IS NOT NULL AND handle IS NOT NULL;
```

## Add “published in” (P1433) to articles missing that from Wikidata

Cases where articles already exists (e.g., has DOI in Wikidata) but it’s not linked to the journal.

```
SELECT CONCAT(wikidata, char(9),'P1433', char(9), 'Q96734475') FROM publications WHERE issn='0044-5096' AND  wikidata LIKE "Q5%";
```

## Adding PDF with wayback archive URL

If PDF is backed up in wayback machine, add qualifiers that say it’s a PDF and it’s backed up

```
SELECT CONCAT(wikidata, char(9),'P953', char(9), '"', pdf, '"', char(9), 'P2701', char(9), 'Q42332', char(9), 'P1065', char(9) , '"https://web.archive.org', waybackmachine , '"' ) FROM publications WHERE issn='0030-8714' AND wikidata IS NOT NULL AND pdf IS NOT NULL AND waybackmachine IS NOT NULL;
```

## Adding PDF only


```
SELECT CONCAT(wikidata, char(9),'P953', char(9), '"', pdf, '"', char(9), 'P2701', char(9), 'Q42332') FROM publications WHERE issn='0030-8714' AND wikidata IS NOT NULL AND pdf IS NOT NULL;
```


### Deleting PDF (if we make a mistake)

```
SELECT CONCAT('-', wikidata, char(9),'P953', char(9), '"', pdf, '"') FROM publications WHERE issn='2331-7515' AND wikidata IS NOT NULL AND pdf IS NOT NULL AND waybackmachine IS NOT NULL;
```

## Add missing language titles



## Add pages (P304) to articles missing that from Wikidata

Cases where articles already exists (e.g., has DOI in Wikidata) but it doesn’t have pages

### Just spage

```
SELECT CONCAT(wikidata, char(9),'P304', char(9), '"', spage, '"') FROM publications WHERE issn='0366-3469' AND  wikidata IS NOT NULL AND spage IS NOT NULL and epage IS NULL;
```

### spage and epage

```
SELECT CONCAT(wikidata, char(9),'P304', char(9), '"', spage, '-', epage, '"') FROM publications WHERE issn='0366-3469' AND  wikidata IS NOT NULL AND spage IS NOT NULL and epage IS NOT NULL;

```

### SEALS pages

### spage only

```
SELECT CONCAT(wikidata, char(9),'P304', char(9), '"', spage, '"',char(9),'S248',char(9),'Q45313801',char(9), 'S854', char(9), '"', url, '"') FROM publications WHERE issn='0253-1453' AND  wikidata IS NOT NULL AND spage IS NOT NULL and epage IS  NULL;
```



#### spage page

```
SELECT CONCAT(wikidata, char(9),'P304', char(9), '"', spage, '-', epage, '"',char(9),'S248',char(9),'Q45313801',char(9), 'S854', char(9), '"', url, '"') FROM publications WHERE issn='0253-1453' AND  wikidata IS NOT NULL AND spage IS NOT NULL and epage IS NOT NULL;
```


## Add missing publication date (e.g., year)

```
SELECT CONCAT(wikidata, char(9),'P577', char(9), '+', year, '-00-00T00:00:00Z/9') FROM publications WHERE issn='0311-4538';
```

## Add missing license

CC-BY 4.0

```
SELECT CONCAT(wikidata, char(9),'P275', char(9), 'Q20007257', char(9), 'S854', char(9), '"', url, '"') FROM publications WHERE issn='1570-3223';

```


## Adding AFD to existing Wikidata items

Use in afd database to link AFD to Wikidata

```
SELECT CONCAT(wikidata, char(9), 'P6982', char(9), '"', PUBLICATION_GUID, '"') FROM bibliography WHERE issn='0013-8819' AND wikidata IS NOT NULL;
```


## Add missing authors

## Deleting incorrect authors

```
SELECT CONCAT('-', wikidata, char(9),'P2093', char(9), '"Rsea Sea"') FROM publications WHERE issn='1851-7471' AND wikidata IS NOT NULL AND authors="Rsea Sea";
```

## Adding to my databases

### IPNI

DOI

SELECT CONCAT("UPDATE names SET wikidata='", wikidata, "' WHERE doi='", doi, "';") FROM publications WHERE issn='0366-3469' AND wikidata IS NOT NULL;




