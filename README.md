# wikidata-bibliographic-data
Tools to upload bibliographic data to Wikidata

## Language detection

For some works we will have information on title in different language and can add those directly. For others we may have only a single title but it could be non-English. Use https://github.com/patrickschur/language-detection to detect language of title of work. If not English we add the title as if it was English so that we have a Wikidata label in English, we also add the title in the detected language. We also set the language of the work (P407) to the detected language, on the assumption that it's likely to be the same langauge as that of the title.

## Retrieve mapping

To get a copy of the mapping between identifiers (e.g., DOIs, JSTOR) and/or metadata (e.g., journal, volume, page number) and Wikidata items we run a SPARQL query using bigquery.php which returns as TSV file with enough information to update the lcoal database. Use parse-query-result.php to generate the SQL statements to update local database.


## Examples

**Recherches sur les Scorpions appartenant ou déposés au Muséum d'Histoire naturelle de Genève. II. - Contribution à la connaissance de l'ancienne espèce Scorpius banaticus C. L. Koch, 1841, Euscorpius carpathicus (Linné, 1767**)  http://biostor.org/reference/134722

This is in Wikidata https://www.wikidata.org/wiki/Q36839457 via PubMed (I suspect), doesn’t have either BioStor or DOI, so would only find via OpenURL-style search :(
