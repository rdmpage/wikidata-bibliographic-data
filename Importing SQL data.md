# Notes on exporting microcitation database to Wikidata

## List of DOIs to add via CrossRef

```
SELECT CONCAT("'", guid, "',") FROM publications WHERE issn = "0010-065X" AND doi IS NOT NULL;

```

## Checking JSTOR harvest for issue parsing problem

In some cases JSTOR parsing code failed for issue numbers, and every article in a volume got assigned to the same volume. We can detect these using SQL:

```
SELECT volume, COUNT(distinct issue) FROM publications WHERE issn='0161-8202' AND jstor IS NOT NULL group BY volume ORDER BY CAST(volume as SIGNED);

```

This tells us how many distinct issue numbers there are for each volume, if it’s only one, or inconsistent across volumes than we may have a problem.

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

## Adding CiNii to existing Wikidata items

For example can use microcitation/harvest_cinii_ris_add.php to read a CiNii RIS file (~/DropBox/BibScrapper/cinii) and output SQL to add CiNii id to references.


```
SELECT CONCAT(wikidata, char(9),'P2409', char(9), '"', cinii, '"', char(9), 'S248', char(9), 'Q10726338', char(9), 'S854', char(9), '"https://ci.nii.ac.jp/naid/', cinii, '"') FROM publications WHERE issn='0385-2423' AND wikidata IS NOT NULL AND cinii IS NOT NULL;
```

## Adding internet archive to existing Wikidata items

```
SELECT CONCAT(wikidata, char(9),'P724', char(9), '"', internetarchive, '"') FROM publications WHERE issn='1280-9551' AND wikidata IS NOT NULL AND internetarchive IS NOT NULL;
```


