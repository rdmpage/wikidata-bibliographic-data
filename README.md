# wikidata-bibliographic-data
Tools to upload bibliographic data to Wikidata

## Language detection

For some works we will have information on title in different language and can add those directly. For others we may have only a single title but it could be non-English. Use https://github.com/patrickschur/language-detection to detect language of title of work. If not English we add the title as if it was English so that we have a Wikidata label in English, we also add the title in the detected language. We also set the language of the work (P407) to the detected language, on the assumption that it's likely to be the same langauge as that of the title.

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


## Notes on journal sources

[Journals Online project](https://www.inasp.info/project/journals-online-project)
