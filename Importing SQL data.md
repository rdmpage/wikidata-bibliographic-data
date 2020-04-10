# Notes on exporting microcitation database to Wikidata

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
