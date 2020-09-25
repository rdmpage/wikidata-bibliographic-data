# Zootaxa merge

There is fairly massive duplication of Zootaxa in Wikidata. The main reseaon for the duplication seems to be bots adding using either DOIs or PMIDs, and not checking that a record with the other identifier already existed.


To identify the duplications I’ve grabbed all Zootaxa from CrossRef, and all records from Wikidata. I’ve also mapped CrossRef to Pubmed, using both DOIs and bibliographic metadata for those Pubmed records that were unaware of the DOIs.

Merging will create complicated records as things like titles may differ slight (e.g., punctuation), and pages will be separated by different characters.

## Examples

The type specimens of Tachinidae (Diptera) housed in the Museo Argentino de Ciencias Naturales “Bernardino Rivadavia”, Buenos Aires

Q29469527 11:09, 18 April 2017‎ added by SuccuBot 
Q35800184 11:26, 10 August 2017‎ added by Research Bot

### title

The type specimens of Tachinidae (Diptera) housed in the Museo Argentino de Ciencias Naturales “Bernardino Rivadavia”, Buenos Aires

The type specimens of Tachinidae (Diptera) housed in the Museo Argentino de Ciencias Naturales "Bernardino Rivadavia", Buenos Aires.

Note different style of quotes, and period or not.

### pages

Q29469527 157–176 (EN DASH) DOI:10.11646/ZOOTAXA.3670.2.3
Q35800184 157-176 (HYPHEN-MINUS) PMID:26438932

### authors
Q29469527	James E. O’hara
Q35800184 James E O'Hara

### citations

**Q29469527** cited by 1 Q35950285
**Q35800184** cited by 2 Q35627002 and Q35950285

After merge Q35950285 has links to both **Q35800184** and **Q29469527**, with **Q35800184** flagged because it no longer has a title

Q29469527 cites **Q35800184**


MERGE source	destination
MERGE	Q35800184	Q29469527

Question: what happens to the citation links when merged?
Answer: they don’t seem to change…


