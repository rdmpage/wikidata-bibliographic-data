<?php

// Split DOIs by agency

require_once (dirname(__FILE__) . '/wikidata.php');



$dois=array(
'10.1002/ece3.8612',
'10.1002/fedr.202100021',
'10.1002/fedr.202100044',
'10.1002/fedr.202100050',
'10.1002/tax.12656',
'10.1002/tax.12660',
'10.1002/tax.12661',
'10.1002/tax.12662',
'10.1002/tax.12676',
'10.1002/tax.12677',
'10.1002/tax.12679',
'10.1007/978-981-16-2986-0_8',
'10.1007/978-981-16-7427-3',
'10.1007/s00203-021-02674-z',
'10.1007/s00203-021-02693-w',
'10.1007/s00203-021-02696-7',
'10.1007/s00203-022-02764-6',
'10.1007/s00203-022-02783-3',
'10.1007/s00253-022-11788-3',
'10.1007/s00284-022-02763-2',
'10.1007/s00284-022-02784-x',
'10.1007/s00284-022-02798-5',
'10.1007/s00300-022-03017-4',
'10.1007/s00606-021-01786-9',
'10.1007/s00606-021-01789-6',
'10.1007/s00606-021-01791-y',
'10.1007/s00606-021-01792-x',
'10.1007/s00606-021-01793-w',
'10.1007/s00606-021-01795-8',
'10.1007/s00606-021-01796-7',
'10.1007/s00606-021-01797-6',
'10.1007/s00606-021-01798-5',
'10.1007/s00606-021-01799-4',
'10.1007/s00606-021-01801-z',
'10.1007/s00705-022-05387-w',
'10.1007/s10228-022-00860-7',
'10.1007/s10482-021-01701-9',
'10.1007/s10482-021-01704-6',
'10.1007/s10482-021-01705-5',
'10.1007/s10482-022-01710-2',
'10.1007/s10482-022-01711-1',
'10.1007/s10482-022-01712-0',
'10.1007/s10482-022-01713-z',
'10.1007/s11230-022-10021-z',
'10.1007/s11230-022-10022-y',
'10.1007/s11230-022-10023-x',
'10.1007/s12228-021-09692-7',
'10.1007/s12228-021-09693-6',
'10.1007/s12526-021-01228-2',
'10.1007/s13127-022-00541-3',
'10.1007/s13127-022-00542-2',
'10.1007/s13744-022-00945-y',
'10.1016/j.actatropica.2022.106368',
'10.1016/j.biortech.2022.126754',
'10.1016/j.cretres.2022.105138',
'10.1016/j.cretres.2022.105164',
'10.1016/j.culher.2022.01.010',
'10.1016/j.ecolind.2022.108643',
'10.1016/j.egg.2022.100114',
'10.1016/j.ejop.2021.125827',
'10.1016/j.ejop.2022.125868',
'10.1016/j.ejop.2022.125875',
'10.1016/j.funbio.2021.11.001',
'10.1016/j.ijppaw.2022.01.006',
'10.1016/j.jcz.2022.02.001',
'10.1016/j.oooo.2021.12.002',
'10.1016/j.palaeo.2022.110878',
'10.1016/j.palwor.2022.01.009',
'10.1016/j.parint.2022.102549',
'10.1016/j.parint.2022.102550',
'10.1016/j.parint.2022.102551',
'10.1016/j.parint.2022.102552',
'10.1016/j.parint.2022.102553',
'10.1016/j.parint.2022.102554',
'10.1016/j.parint.2022.102555',
'10.1016/j.parint.2022.102556',
'10.1016/j.parint.2022.102557',
'10.1016/j.parint.2022.102558',
'10.1016/j.parint.2022.102559',
'10.1016/j.parint.2022.102560',
'10.1016/j.pld.2020.10.004',
'10.1016/j.pld.2020.11.003',
'10.1016/j.pld.2020.12.006',
'10.1016/j.pld.2021.01.001',
'10.1016/j.pld.2021.01.002',
'10.1016/j.pld.2021.01.003',
'10.1016/j.pld.2021.01.006',
'10.1016/j.pld.2021.01.008',
'10.1016/j.pld.2021.01.009',
'10.1016/j.pld.2021.04.002',
'10.1016/j.pld.2021.05.003',
'10.1016/j.pld.2021.05.005',
'10.1016/j.pld.2021.05.006',
'10.1016/j.pld.2021.06.001',
'10.1016/j.pld.2021.06.003',
'10.1016/j.pld.2021.07.004',
'10.1016/j.pld.2021.08.002',
'10.1016/j.pld.2021.08.003',
'10.1016/j.pld.2021.09.001',
'10.1016/j.pld.2021.09.003',
'10.1016/j.pld.2021.09.004',
'10.1016/j.pld.2021.09.005',
'10.1016/j.pld.2021.09.006',
'10.1016/j.pld.2021.10.001',
'10.1016/j.pld.2021.10.002',
'10.1016/j.pld.2021.10.003',
'10.1016/j.pld.2021.11.001',
'10.1016/j.pld.2021.11.002',
'10.1016/j.pld.2021.11.003',
'10.1016/j.pld.2021.11.004',
'10.1016/j.pld.2021.11.005',
'10.1016/j.pld.2021.11.006',
'10.1016/j.pld.2021.11.007',
'10.1016/j.pld.2021.11.008',
'10.1016/j.pld.2021.11.009',
'10.1016/j.pld.2021.11.010',
'10.1016/j.pld.2021.12.001',
'10.1016/j.pld.2021.12.002',
'10.1016/j.pld.2021.12.003',
'10.1016/j.pld.2021.12.004',
'10.1016/j.pld.2021.12.005',
'10.1016/j.pld.2021.12.006',
'10.1016/j.pld.2022.01.002',
'10.1016/j.pld.2022.01.003',
'10.1016/j.pld.2022.01.004',
'10.1016/j.pld.2022.01.005',
'10.1016/j.protis.2022.125858',
'10.1016/j.syapm.2022.126304',
'10.1016/j.ttbdis.2022.101907',
'10.1016/j.ympev.2022.107425',
'10.1016/j.ympev.2022.107426',
'10.1016/j.ympev.2022.107427',
'10.1016/j.ympev.2022.107428',
'10.1016/j.ympev.2022.107429',
'10.1016/j.ympev.2022.107430',
'10.1016/j.ympev.2022.107431',
'10.1016/j.ympev.2022.107432',
'10.1016/j.ympev.2022.107433',
'10.1016/j.ympev.2022.107434',
'10.1016/j.ympev.2022.107435',
'10.1016/j.ympev.2022.107436',
'10.1016/S0932-4739(22)00009-8',
'10.1016/S1055-7903(21)00318-3',
'10.1016/S1383-5769(21)00219-1',
'10.1016/S1383-5769(22)00010-1',
'10.1016/S1434-4610(21)00049-3',
'10.1016/S1434-4610(21)00059-6',
'10.1016/S1434-4610(22)00007-4',
'10.1016/S1434-4610(22)00010-4',
'10.1017/jpa.2021.2',
'10.1017/jpa.2021.52',
'10.1017/jpa.2022.2',
'10.1017/jpa.2022.3',
'10.1017/s0022336000042645',
'10.1038/s41467-022-28065-6',
'10.1038/s41467-022-28402-9',
'10.1071/IS21002',
'10.1071/IS21019',
'10.1071/IS21026',
'10.1080/00222933.2021.2009054',
'10.1080/00222933.2022.2033868',
'10.1080/0269249X.2021.2010808',
'10.1080/00275514.2021.1994815',
'10.1080/00275514.2021.2005985',
'10.1080/00275514.2021.2008765',
'10.1080/00275514.2021.2018889',
'10.1080/00305316.2020.1860148',
'10.1080/00305316.2021.1904022',
'10.1080/00305316.2021.1906344',
'10.1080/00305316.2021.1906778',
'10.1080/00305316.2021.1908188',
'10.1080/00305316.2021.1918592',
'10.1080/00305316.2021.1921632',
'10.1080/00305316.2021.1922319',
'10.1080/00305316.2021.1930229',
'10.1080/00305316.2021.1930604',
'10.1080/00305316.2021.1933638',
'10.1080/00305316.2021.1936256',
'10.1080/00305316.2021.1939807',
'10.1080/00305316.2021.1943558',
'10.1080/00305316.2021.1944931',
'10.1080/00305316.2021.1959462',
'10.1080/00305316.2021.1982043',
'10.1080/00305316.2021.1982787',
'10.1080/00305316.2021.1988744',
'10.1080/00305316.2021.1989074',
'10.1080/00305316.2021.1991853',
'10.1080/00305316.2021.1997831',
'10.1080/00305316.2021.2010617',
'10.1080/00305316.2021.2022546',
'10.1080/00305316.2021.2023056',
'10.1080/00305316.2021.2023679',
'10.1080/00305316.2021.2023680',
'10.1080/00305316.2021.2024464',
'10.1080/00305316.2021.2024465',
'10.1080/00305316.2022.2027828',
'10.1080/00305316.2022.2030290',
'10.1080/00305316.2022.2033335',
'10.1080/00305316.2022.2036259',
'10.1080/00379271.2021.2016484',
'10.1080/01647954.2021.2022758',
'10.1080/01647954.2022.2033319',
'10.1080/01650521.2021.1964902',
'10.1080/01650521.2021.2021013',
'10.1080/01650521.2021.2024054',
'10.1080/01650521.2021.2024055',
'10.1080/08912963.2021.2010192',
'10.1080/08912963.2021.2025364',
'10.1080/09397140.2022.2030525',
'10.1080/09397140.2022.2030527',
'10.1080/09397140.2022.2030528',
'10.1080/09397140.2022.2030531',
'10.1080/09397140.2022.2030533',
'10.1080/09397140.2022.2034305',
'10.1080/09397140.2022.2034306',
'10.1080/09397140.2022.2034307',
'10.1080/13887890.2020.1768157',
'10.1080/13887890.2020.1779826',
'10.1080/13887890.2020.1787237',
'10.1080/13887890.2020.1788999',
'10.1080/13887890.2020.1796831',
'10.1080/13887890.2020.1818639',
'10.1080/13887890.2020.1828194',
'10.1080/14772000.2021.2012296',
'10.1080/14772000.2021.2014597',
'10.1080/21505594.2022.2026037',
'10.1080/21564574.2021.1998233',
'10.1080/21564574.2021.1998234',
'10.1080/21564574.2021.2014989',
'10.1080/21564574.2021.2019838',
'10.1080/21564574.2021.2019839',
'10.1093/isd/ixab022',
'10.1093/isd/ixab023',
'10.1093/isd/ixab025',
'10.1093/isd/ixab026',
'10.1093/isd/ixab027',
'10.1093/isd/ixab029',
'10.1093/isd/ixab031',
'10.1093/isd/ixab032',
'10.1093/isd/ixac001',
'10.1093/jcbiol/ruab070',
'10.1093/zoolinnean/zlab086',
'10.1093/zoolinnean/zlab091',
'10.1094/PDIS-11-21-2444-RE',
'10.1099/ijsem.0.004477',
'10.1099/ijsem.0.004617',
'10.1099/ijsem.0.004619',
'10.1099/ijsem.0.004928',
'10.1099/ijsem.0.005153',
'10.1099/ijsem.0.005162',
'10.1099/ijsem.0.005181',
'10.1099/ijsem.0.005189',
'10.1099/ijsem.0.005190',
'10.1099/ijsem.0.005199',
'10.1099/ijsem.0.005200',
'10.1099/ijsem.0.005201',
'10.1099/ijsem.0.005202',
'10.1099/ijsem.0.005203',
'10.1099/ijsem.0.005204',
'10.1099/ijsem.0.005205',
'10.1099/ijsem.0.005206',
'10.1099/ijsem.0.005207',
'10.1099/ijsem.0.005208',
'10.1099/ijsem.0.005209',
'10.1099/ijsem.0.005210',
'10.1099/ijsem.0.005213',
'10.1099/ijsem.0.005214',
'10.1099/ijsem.0.005215',
'10.1099/ijsem.0.005216',
'10.1099/ijsem.0.005217',
'10.1099/ijsem.0.005218',
'10.1099/ijsem.0.005219',
'10.1099/ijsem.0.005220',
'10.1099/ijsem.0.005222',
'10.1099/ijsem.0.005223',
'10.1099/ijsem.0.005224',
'10.1099/ijsem.0.005225',
'10.1099/ijsem.0.005227',
'10.1099/ijsem.0.005228',
'10.1099/ijsem.0.005229',
'10.1099/ijsem.0.005232',
'10.1099/ijsem.0.005234',
'10.1099/ijsem.0.005235',
'10.1099/ijsem.0.005236',
'10.1099/ijsem.0.005237',
'10.1099/ijsem.0.005238',
'10.1099/ijsem.0.005239',
'10.1099/ijsem.0.005241',
'10.1099/ijsem.0.005245',
'10.1099/ijsem.0.005246',
'10.1099/ijsem.0.005248',
'10.1101/2022.01.26.477889',
'10.1101/2022.02.08.479620.full',
'10.1111/1755-0998.13591',
'10.1111/jfb.15011',
'10.1111/njb.03390',
'10.1111/njb.03412',
'10.1111/njb.03422',
'10.1111/tbed.14477',
'10.1111/zsc.12527',
'10.1139/cjes-2021-0105',
'10.1139/cjz-2021-0160',
'10.1163/1876312x-00002305',
'10.1163/15685403-bja10174',
'10.1163/15685403-bja10176',
'10.1177/09596836221074035',
'10.1177/11769343211071114',
'10.1186/s13002-022-00503-1',
'10.1186/s43008-022-00088-0',
'10.1206/3985.1',
'10.1371/journal.pone.0263084',
'10.1544 6/caldasia.v40n2.70870',
'10.1590/1519-6984.249008',
'10.1600/036364421X16335339545176',
'10.1655/Herpetologica-D-21-00026',
'10.2108/zs210090',
'10.2108/zs210106',
'10.2478/helm-2021-0028',
'10.3114/fuse.2021.08.01',
'10.3114/fuse.2021.08.02',
'10.3114/fuse.2021.08.03',
'10.3114/fuse.2021.08.04',
'10.3114/fuse.2021.08.05',
'10.3114/fuse.2021.08.06',
'10.3114/fuse.2021.08.10',
'10.3114/fuse.2021.08.11',
'10.3114/fuse.2022.09.03',
'10.3157/061.148.0101',
'10.3157/061.148.0102',
'10.3354/dao03641',
'10.3389/fgene.2021.807234',
'10.3389/fpls.2021.751230',
'10.3390/d14020119',
'10.3390/foods11030346',
'10.3390/ijms23031764',
'10.3390/insects13020119',
'10.3390/insects13020122',
'10.3390/insects13020171',
'10.3390/plants11030426',
'10.3767/blumea.2022.67.01.04',
'10.3897/afrinvertebr.58.20751',
'10.3897/asp.80.e76339',
'10.3897/BDJ.10.e75910',
'10.3897/BDJ.10.e77963',
'10.3897/compcytogen.v16.i1.76260',
'10.3897/dez.67.55985',
'10.3897/dez.67.56163',
'10.3897/dez.68.55732',
'10.3897/dez.68.58217',
'10.3897/dez.68.65540',
'10.3897/dez.68.68020',
'10.3897/dez.68.70497',
'10.3897/dez.68.70814',
'10.3897/dez.68.74174',
'10.3897/jhr.84.72212',
'10.3897/jor.26.14542',
'10.3897/jor.26.14552',
'10.3897/jor.26.15021',
'10.3897/jor.26.19891',
'10.3897/jor.26.20012',
'10.3897/jor.26.20119',
'10.3897/jor.26.20935',
'10.3897/jor.27.14963',
'10.3897/jor.27.15033',
'10.3897/jor.27.15036',
'10.3897/jor.27.19945',
'10.3897/jor.27.21064',
'10.3897/jor.27.21203',
'10.3897/jor.27.23700',
'10.3897/jor.27.23835',
'10.3897/jor.27.25183',
'10.3897/jor.27.25484',
'10.3897/jor.27.26327',
'10.3897/jor.27.27213',
'10.3897/jor.27.28385',
'10.3897/jor.27.28402',
'10.3897/jor.27.29067',
'10.3897/jor.27.29687',
'10.3897/jor.28.31380',
'10.3897/jor.28.33063',
'10.3897/jor.28.33370',
'10.3897/jor.28.33586',
'10.3897/jor.28.33781',
'10.3897/jor.28.34055',
'10.3897/jor.28.34092',
'10.3897/jor.28.34102',
'10.3897/jor.28.34115',
'10.3897/jor.28.34665',
'10.3897/jor.29.33373',
'10.3897/jor.29.33413',
'10.3897/jor.29.34452',
'10.3897/jor.29.34626',
'10.3897/jor.29.35664',
'10.3897/jor.29.37595',
'10.3897/jor.29.39228',
'10.3897/jor.29.39400',
'10.3897/jor.29.46371',
'10.3897/jor.29.46966',
'10.3897/jor.29.46967',
'10.3897/jor.29.48966',
'10.3897/jor.29.51900',
'10.3897/jor.29.53718',
'10.3897/jor.29.58469',
'10.3897/jor.30.47778',
'10.3897/jor.30.52079',
'10.3897/jor.30.52634',
'10.3897/jor.30.52816',
'10.3897/jor.30.55274',
'10.3897/jor.30.59153',
'10.3897/jor.30.59262',
'10.3897/jor.30.61605',
'10.3897/jor.30.62170',
'10.3897/jor.30.63405',
'10.3897/jor.30.63692',
'10.3897/jor.30.64266',
'10.3897/jor.30.65172',
'10.3897/jor.30.65971',
'10.3897/jor.30.70990',
'10.3897/jor.30.72513',
'10.3897/jor.31.70565',
'10.3897/mycokeys.80.64369',
'10.3897/mycokeys.86.73861',
'10.3897/mycokeys.86.76053',
'10.3897/mycokeys.86.77431',
'10.3897/mycokeys.86.78989',
'10.3897/mycokeys.87.72614',
'10.3897/mycokeys.87.72941',
'10.3897/mycokeys.87.73082',
'10.3897/mycokeys.87.79433',
'10.3897/phytokeys.180.67634',
'10.3897/phytokeys.183.71049',
'10.3897/phytokeys.189.49367',
'10.3897/phytokeys.189.73959',
'10.3897/phytokeys.189.75321',
'10.3897/phytokeys.189.76464',
'10.3897/phytokeys.189.77374',
'10.3897/phytokeys.189.77839',
'10.3897/phytokeys.189.77926',
'10.3897/phytokeys.189.78149',
'10.3897/phytokeys.189.79631',
'10.3897/phytokeys.189.80016',
'10.3897/subtbiol.42.73524',
'10.3897/subtbiol.42.78037',
'10.3897/vz.72.e76046',
'10.3897/vz.72.e76256',
'10.3897/vz.72.e77702',
'10.3897/vz.72.e78092',
'10.3897/zookeys.1070.66598',
'10.3897/zookeys.1083.69047',
'10.3897/zookeys.1083.72939',
'10.3897/zookeys.1083.75624',
'10.3897/zookeys.1083.76651',
'10.3897/zookeys.1083.76887',
'10.3897/zookeys.1083.78233',
'10.3897/zookeys.1084.69767',
'10.3897/zookeys.1084.71576',
'10.3897/zookeys.1084.72868',
'10.3897/zookeys.1084.77038',
'10.3897/zookeys.1084.77096',
'10.3897/zookeys.1084.78405',
'10.3897/zookeys.1084.78664',
'10.3897/zookeys.1084.78744',
'10.3897/zookeys.1084.78883',
'10.3897/zookeys.1084.79415',
'10.3897/zookeys.1085.72927',
'10.3897/zookeys.1085.75885',
'10.3897/zookeys.1085.76033',
'10.3897/zookeys.1085.76484',
'10.3897/zookeys.1085.76853',
'10.3897/zookeys.1085.76868',
'10.3897/zookeys.1085.77900',
'10.3897/zookeys.1085.77924',
'10.3897/zookeys.1085.77966',
'10.3897/zookeys.1085.79278',
'10.3897/zookeys.1086.68015',
'10.3897/zookeys.1086.77180',
'10.3897/zookeys.1086.77408',
'10.3956/2021-97.4.190',
'10.3969/j.issn.1005-9628.2021.01.001',
'10.3969/j.issn.1005-9628.2021.01.002',
'10.3969/j.issn.1005-9628.2021.01.003',
'10.3969/j.issn.1005-9628.2021.01.004',
'10.3969/j.issn.1005-9628.2021.01.005',
'10.3969/j.issn.1005-9628.2021.01.006',
'10.3969/j.issn.1005-9628.2021.01.007',
'10.3969/j.issn.1005-9628.2021.01.008',
'10.3969/j.issn.1005-9628.2021.01.009',
'10.3969/j.issn.1005-9628.2021.01.010',
'10.3969/j.issn.1005-9628.2021.01.011',
'10.3969/j.issn.1005-9628.2021.01.012',
'10.3969/j.issn.1005-9628.2021.01.013',
'10.3969/j.issn.1005-9628.2021.01.014',
'10.3969/j.issn.1005-9628.2021.02.01',
'10.3969/j.issn.1005-9628.2021.02.02',
'10.3969/j.issn.1005-9628.2021.02.03',
'10.3969/j.issn.1005-9628.2021.02.04',
'10.3969/j.issn.1005-9628.2021.02.05',
'10.3969/j.issn.1005-9628.2021.02.06',
'10.3969/j.issn.1005-9628.2021.02.07',
'10.3969/j.issn.1005-9628.2021.02.08',
'10.3969/j.issn.1005-9628.2021.02.09',
'10.3969/j.issn.1005-9628.2021.02.10',
'10.3969/j.issn.1005-9628.2021.02.11',
'10.3969/j.issn.1005-9628.2021.02.12',
'10.5194/fr-24-379-2021',
'10.5252/zoosystema2022v44a3',
'10.5281/zenodo.4535846',
'10.5281/zenodo.4588314',
'10.5281/zenodo.4588315',
'10.5281/zenodo.4661938',
'10.5281/zenodo.4661939',
'10.5281/zenodo.4682872',
'10.5281/zenodo.4682873',
'10.5281/zenodo.4718390',
'10.5281/zenodo.4718391',
'10.5281/zenodo.4719051',
'10.5281/zenodo.4719052',
'10.5281/zenodo.4730133',
'10.5281/zenodo.4730134',
'10.5281/zenodo.4730422',
'10.5281/zenodo.4730423',
'10.5281/zenodo.4736114',
'10.5281/zenodo.4736115',
'10.5281/zenodo.4745915',
'10.5281/zenodo.4745916',
'10.5281/zenodo.4817731',
'10.5281/zenodo.4817732',
'10.5281/zenodo.5063022',
'10.5281/zenodo.5063023',
'10.5281/zenodo.5084792',
'10.5281/zenodo.5084793',
'10.5281/zenodo.5089703',
'10.5281/zenodo.5089704',
'10.5281/zenodo.5589574',
'10.5281/zenodo.5596460',
'10.5281/zenodo.5749437',
'10.5281/zenodo.5749467',
'10.5281/zenodo.5749486',
'10.5281/zenodo.5749516',
'10.5281/zenodo.5749520',
'10.5281/zenodo.5749559',
'10.5281/zenodo.6090197',
'10.5852/cr-palevol2022v21a6',
'10.5852/ejt.2022.789.1631',
'10.5852/ejt.2022.789.1633',
'10.5852/ejt.2022.789.1635',
'10.5852/ejt.2022.789.1637',
'10.5852/ejt.2022.789.1639',
'10.5852/ejt.2022.790.1641',
'10.5852/ejt.2022.791.1645',
'10.5852/ejt.2022.792.1647',
'10.5852/ejt.2022.793.1643',
'10.5852/ejt.2022.794.1649',
'10.5852/ejt.2022.794.1651',
'10.5852/ejt.2022.794.1653',
'10.5852/ejt.2022.794.1655',
'10.6165/tai.2021.66.1',
'10.7717/peerj.12865',
'10.7717/peerj.12913',
'10.11158/saa.27.1.6',
'10.11158/saa.27.3.14',
'10.11158/saa.27.3.15',
'10.11158/saa.27.3.16',
'10.11158/saa.27.4.3',
'10.11158/saa.27.4.4',
'10.11158/saa.27.4.5',
'10.11158/saa.27.4.6',
'10.11609/jott.5942.14.1.20433-20443',
'10.11609/jott.5956.14.1.20526-20529',
'10.11609/jott.6377.14.1.20523-20525',
'10.11609/jott.6664.14.1.20311-20322',
'10.11609/jott.6762.14.1.20461-20468',
'10.11609/jott.6831.14.1.20530-20533',
'10.11609/jott.6970.14.1.20426-20432',
'10.11609/jott.6977.14.1.20387-20399',
'10.11609/jott.7048.14.1.20534-20536',
'10.11609/jott.7117.14.1.20400-20405',
'10.11609/jott.7208.14.1.20323-20345',
'10.11609/jott.7267.14.1.20413-20425',
'10.11609/jott.7437.14.1.20444-20460',
'10.11609/jott.7452.14.1.20371-20386',
'10.11609/jott.7477.14.1.20469-20477',
'10.11609/jott.7560.14.1.20478-20487',
'10.11609/jott.7578.14.1.20494-20499',
'10.11609/jott.7638.14.1.20503-20510',
'10.11609/jott.7652.14.1.20511-20516',
'10.11609/jott.7670.14.1.20488-20493',
'10.11609/jott.7711.14.1.20346-20370',
'10.11609/jott.7713.14.1.20517-20522',
'10.11609/jott.7719.14.1.20406-20412',
'10.11609/jott.7753.14.1.20500-20502',
'10.11609/jott.7849.14.1.20537-20538',
'10.11646/phytotaxa.532.1.1',
'10.11646/phytotaxa.532.1.2',
'10.11646/phytotaxa.532.1.3',
'10.11646/phytotaxa.532.1.4',
'10.11646/phytotaxa.532.1.5',
'10.11646/phytotaxa.532.1.6',
'10.11646/phytotaxa.532.1.7',
'10.11646/phytotaxa.532.1.8',
'10.11646/phytotaxa.532.1.9',
'10.11646/phytotaxa.532.1.10',
'10.11646/phytotaxa.532.2.1',
'10.11646/phytotaxa.532.2.2',
'10.11646/phytotaxa.532.2.3',
'10.11646/phytotaxa.532.2.4',
'10.11646/phytotaxa.532.2.5',
'10.11646/phytotaxa.532.2.6',
'10.11646/phytotaxa.532.2.7',
'10.11646/phytotaxa.532.2.8',
'10.11646/phytotaxa.532.3.1',
'10.11646/phytotaxa.532.3.3',
'10.11646/phytotaxa.533.1.3',
'10.11646/phytotaxa.533.2.2',
'10.11646/phytotaxa.533.2.4',
'10.11646/phytotaxa.533.3.1',
'10.11646/phytotaxa.533.3.2',
'10.11646/phytotaxa.533.3.3',
'10.11646/phytotaxa.533.4.1',
'10.11646/phytotaxa.533.4.2',
'10.11646/phytotaxa.533.4.3',
'10.11646/phytotaxa.533.4.4',
'10.11646/phytotaxa.533.4.5',
'10.11646/phytotaxa.533.4.6',
'10.11646/phytotaxa.533.4.7',
'10.11646/zootaxa.5093.2.2',
'10.11646/zootaxa.5093.2.4',
'10.11646/zootaxa.5093.2.6',
'10.11646/zootaxa.5093.3.1',
'10.11646/zootaxa.5093.3.2',
'10.11646/zootaxa.5093.3.3',
'10.11646/zootaxa.5093.3.4',
'10.11646/zootaxa.5093.3.5',
'10.11646/zootaxa.5093.3.6',
'10.11646/zootaxa.5093.3.7',
'10.11646/zootaxa.5093.3.8',
'10.11646/zootaxa.5093.4.2',
'10.11646/zootaxa.5093.4.3',
'10.11646/zootaxa.5093.4.4',
'10.11646/zootaxa.5093.4.5',
'10.11646/zootaxa.5093.4.6',
'10.11646/zootaxa.5093.4.7',
'10.11646/zootaxa.5094.3.5',
'10.11646/zootaxa.5099.2.1',
'10.11646/zootaxa.5099.2.2',
'10.11646/zootaxa.5099.2.3',
'10.11646/zootaxa.5099.2.4',
'10.11646/zootaxa.5099.2.5',
'10.11646/zootaxa.5099.2.6',
'10.11646/zootaxa.5099.2.7',
'10.11646/zootaxa.5099.2.8',
'10.11646/zootaxa.5099.2.9',
'10.11646/zootaxa.5099.5.1',
'10.11646/zootaxa.5099.5.2',
'10.11646/zootaxa.5099.5.3',
'10.11646/zootaxa.5099.5.4',
'10.11646/zootaxa.5099.5.5',
'10.11646/zootaxa.5099.5.6',
'10.11865/zs.2021105',
'10.11865/zs.2021201',
'10.11865/zs.2021202',
'10.11865/zs.2021203',
'10.11865/zs.2021204',
'10.11865/zs.2021205',
'10.11865/zs.2021301',
'10.11865/zs.2021302',
'10.11865/zs.2021303',
'10.11865/zs.2021304',
'10.11865/zs.2021305',
'10.11865/zs.2021306',
'10.11865/zs.2021307',
'10.11865/zs.2021308',
'10.11865/zs.2021309',
'10.11865/zs.2021401',
'10.11865/zs.2021402',
'10.11865/zs.2021403',
'10.11865/zs.2021404',
'10.11865/zs.2021405',
'10.11865/zs.2021406',
'10.11865/zs.2021407',
'10.11865/zs.2021408',
'10.12681/mms.27880',
'10.13130/2039-4942/16126',
'10.13130/2039-4942/16131',
'10.13130/2039-4942/16313',
'10.13130/2039-4942/16332',
'10.13130/2039-4942/16364',
'10.13130/2039-4942/16421',
'10.13130/2039-4942/16440',
'10.13130/2039-4942/16620',
'10.13130/2039-4942/16697',
'10.13130/2039-4942/16717',
'10.13130/2039-4942/16731',
'10.13133/2284-4880/563',
'10.13346/j.mycosystema.210131',
'10.13346/j.mycosystema.210190',
'10.13346/j.mycosystema.210218',
'10.13346/j.mycosystema.210224',
'10.13346/j.mycosystema.210239',
'10.13346/j.mycosystema.210242',
'10.13346/j.mycosystema.210257',
'10.13346/j.mycosystema.210284',
'10.13346/j.mycosystema.210310',
'10.13346/j.mycosystema.210313',
'10.13346/j.mycosystema.210314',
'10.13346/j.mycosystema.210315',
'10.13346/j.mycosystema.210317',
'10.13346/j.mycosystema.210323',
'10.13346/j.mycosystema.210329',
'10.13346/j.mycosystema.210331',
'10.13346/j.mycosystema.210336',
'10.13346/j.mycosystema.210342',
'10.13346/j.mycosystema.210343',
'10.13346/j.mycosystema.210344',
'10.13346/j.mycosystema.210345',
'10.13346/j.mycosystema.210346',
'10.13346/j.mycosystema.210347',
'10.13346/j.mycosystema.210348',
'10.13346/j.mycosystema.210349',
'10.13346/j.mycosystema.210361',
'10.13346/j.mycosystema.210362',
'10.13346/j.mycosystema.210463',
'10.16373/j.cnki.ahr.200025',
'10.16373/j.cnki.ahr.200044',
'10.16373/j.cnki.ahr.200061',
'10.16373/j.cnki.ahr.200069',
'10.16373/j.cnki.ahr.200075',
'10.16373/j.cnki.ahr.200080',
'10.16373/j.cnki.ahr.200084',
'10.16373/j.cnki.ahr.200090',
'10.16373/j.cnki.ahr.200100',
'10.16373/j.cnki.ahr.200102',
'10.16373/j.cnki.ahr.200106',
'10.16373/j.cnki.ahr.200107',
'10.16373/j.cnki.ahr.200108',
'10.16373/j.cnki.ahr.200114',
'10.16373/j.cnki.ahr.200118',
'10.16373/j.cnki.ahr.200122',
'10.16373/j.cnki.ahr.200123',
'10.16373/j.cnki.ahr.200124',
'10.16373/j.cnki.ahr.200129',
'10.16373/j.cnki.ahr.200134',
'10.16373/j.cnki.ahr.210016',
'10.16373/j.cnki.ahr.210017',
'10.16373/j.cnki.ahr.210018',
'10.16373/j.cnki.ahr.210023',
'10.16373/j.cnki.ahr.2000126',
'10.18348/opzool.2021.s1.3',
'10.21248/contrib.entomol.71.2.301-320',
'10.21307/jofnem-2021-100',
'10.21411/cbm.a.2d189cc3',
'10.21411/cbm.a.2dd0c169',
'10.21411/cbm.a.4c5833d8',
'10.21411/cbm.a.4d8612',
'10.21411/cbm.a.5b84f62b',
'10.21411/cbm.a.6b8915b2',
'10.21411/cbm.a.7e4c9557',
'10.21411/cbm.a.7f9d1bdb',
'10.21411/cbm.a.36d8209e',
'10.21411/cbm.a.46cb3b81',
'10.21411/cbm.a.46d03d27',
'10.21411/cbm.a.62bc33ab',
'10.21411/cbm.a.74c02653',
'10.21411/cbm.a.85d5292e',
'10.21411/cbm.a.95e3fad4',
'10.21411/cbm.a.182d0e48',
'10.21411/cbm.a.368db6f6',
'10.21411/cbm.a.892d372',
'10.21411/cbm.a.919d256e',
'10.21411/cbm.a.4670bba3',
'10.21411/cbm.a.678381b1',
'10.21411/cbm.a.6427875e',
'10.21411/cbm.a.48866486',
'10.21411/cbm.a.58164306',
'10.21411/cbm.a.60644194',
'10.21411/cbm.a.a3ee9fb',
'10.21411/cbm.a.a90d1ed2',
'10.21411/cbm.a.ab783916',
'10.21411/cbm.a.b0ea3c57',
'10.21411/cbm.a.bd3c4f5',
'10.21411/cbm.a.bea5e160',
'10.21411/cbm.a.c2fcc0b0',
'10.21411/cbm.a.c09c83ee',
'10.21411/cbm.a.c79d153b',
'10.21411/cbm.a.d0f17c4d',
'10.21411/cbm.a.d1f8dca4',
'10.21411/cbm.a.d5f01ab5',
'10.21411/cbm.a.d150cc09',
'10.21411/cbm.a.d87636d',
'10.21411/cbm.a.df8fa0b8',
'10.21411/cbm.a.df12db37',
'10.21411/cbm.a.df53e129',
'10.21411/cbm.a.dfe6b4f4',
'10.21411/cbm.a.e62ebb18',
'10.21411/cbm.a.e3082bdf',
'10.21411/cbm.a.e7499fa2',
'10.21411/cbm.a.ea15a5c4',
'10.21411/cbm.a.eccff55d',
'10.21411/cbm.a.ecd1343a',
'10.21411/cbm.a.ef0edcc3',
'10.21411/cbm.a.f5f29be0',
'10.21411/cbm.a.fca32802',
'10.21411/cbm.a.ff667c61',
'10.21411/cbm.i.1f1453b5',
'10.21411/cbm.i.90da860a',
'10.21411/cbm.i.96b43881',
'10.21411/cbm.i.915ec9e6',
'10.21411/cbm.i.b295dc1c',
'10.22073/pja.v11i1.72890',
'10.22092/botany.2021.351400.1213',
'10.22092/botany.2021.351715.1216',
'10.22092/botany.2021.353400.1235',
'10.22092/botany.2021.354169.1239',
'10.22092/botany.2021.354291.1240',
'10.22092/botany.2021.354470.1242',
'10.22092/botany.2021.354488.1243',
'10.22092/botany.2021.354494.1244',
'10.22092/botany.2021.354571.1246',
'10.22092/botany.2021.354631.1248',
'10.22092/botany.2021.354649.1249',
'10.22092/botany.2021.354988.1252',
'10.22092/botany.2021.355123.1254',
'10.22092/botany.2021.355304.1257',
'10.22092/botany.2021.355306.1258',
'10.22092/botany.2021.355307.1259',
'10.22092/botany.2021.355344.1260',
'10.22092/botany.2021.355379.1261',
'10.22092/botany.2021.355659.1267',
'10.22092/botany.2021.355753.1270',
'10.22092/botany.2021.355951.1273',
'10.22092/botany.2021.356376.1275',
'10.22092/botany.2022.356460.1277',
'10.22092/botany.2022.356551.1279',
'10.22092/botany.2022.356653.1280',
'10.22092/botany.2022.356773.1283',
'10.22092/botany.2022.357050.1286',
'10.22092/botany.2022.357453.1291',
'10.23797/2159-6719_24',
'10.23797/2159-6719_24_4',
'10.23797/2159-6719_24_11',
'10.23797/2159-6719_24_12',
'10.23797/2159-6719_24_16',
'10.23797/2159-6719_24_20',
'10.23797/2159-6719_24_21',
'10.23797/2159-6719_24_22',
'10.23885/181433262022181-38',
'10.24193/entomolrom.25',
'10.24349/0gr3-3a6b',
'10.24349/1dwx-x5h2',
'10.24349/7izc-dm2n',
'10.24349/38vh-n9rc',
'10.24823/ejb.2021.336',
'10.24823/ejb.2021.387',
'10.24823/ejb.2021.396',
'10.24823/ejb.2021.397',
'10.25664/art-0314',
'10.25664/art-0315',
'10.25664/art-0316',
'10.25664/art-0317',
'10.25664/art-0318',
'10.25664/art-0319',
'10.25664/art-0320',
'10.25664/art-0321',
'10.25664/art-0322',
'10.25664/art-0323',
'10.25664/art-0324',
'10.25664/art-0325',
'10.25664/art-0326',
'10.25664/art-0327',
'10.25664/art-0328',
'10.25664/art-0329',
'10.25664/art-0330',
'10.25664/art-0331',
'10.25664/art-0332',
'10.25664/art-0333',
'10.25664/art-0334',
'10.25664/art-0335',
'10.25664/art-0336',
'10.25664/art-0337',
'10.25664/art-0338',
'10.25664/art-0339',
'10.25664/art-0340',
'10.26107/rbz-2021-0015',
'10.26107/rbz-2021-0016',
'10.26107/rbz-2021-0017',
'10.26107/rbz-2021-0018',
'10.26107/rbz-2021-0019',
'10.26107/rbz-2021-0020',
'10.26107/rbz-2021-0021',
'10.26107/rbz-2021-0022',
'10.26107/rbz-2021-0023',
'10.26107/rbz-2021-0024',
'10.26107/rbz-2021-0025',
'10.26107/rbz-2021-0026',
'10.26107/rbz-2021-0027',
'10.26107/rbz-2021-0028',
'10.26107/rbz-2021-0029',
'10.26107/rbz-2021-0030',
'10.26107/rbz-2021-0031',
'10.26107/rbz-2021-0032',
'10.26107/rbz-2021-0033',
'10.26107/rbz-2021-0034',
'10.26107/rbz-2021-0035',
'10.26107/rbz-2021-0036',
'10.26107/rbz-2021-0037',
'10.26107/rbz-2021-0038',
'10.26107/rbz-2021-0039',
'10.26107/rbz-2021-0040',
'10.26107/rbz-2021-0041',
'10.26107/rbz-2021-0042',
'10.26107/rbz-2021-0043',
'10.26107/rbz-2021-0044',
'10.26107/rbz-2021-0045',
'10.26107/rbz-2021-0046',
'10.26107/rbz-2021-0047',
'10.26107/rbz-2021-0048',
'10.26107/rbz-2021-0049',
'10.26107/rbz-2021-0050',
'10.26107/rbz-2021-0051',
'10.26107/rbz-2021-0052',
'10.26107/rbz-2021-0053',
'10.26107/rbz-2021-0054',
'10.26107/rbz-2021-0055',
'10.26107/rbz-2021-0056',
'10.26107/rbz-2021-0057',
'10.26107/rbz-2021-0058',
'10.26107/rbz-2021-0059',
'10.26107/rbz-2021-0060',
'10.26107/rbz-2021-0061',
'10.26107/rbz-2021-0062',
'10.26107/rbz-2021-0063',
'10.26107/rbz-2021-0064',
'10.26107/rbz-2021-0065',
'10.26107/rbz-2021-0066',
'10.26107/rbz-2021-0067',
'10.26107/rbz-2021-0068',
'10.26107/rbz-2021-0069',
'10.26107/rbz-2021-0070',
'10.26107/rbz-2021-0071',
'10.26107/rbz-2021-0072',
'10.26107/rbz-2021-0073',
'10.26107/rbz-2022-0001',
'10.26107/rbz-2022-0002',
'10.26107/rbz-2022-0003',
'10.26686/wgtn.19119362',
'10.30796/angv.2022.15',
'10.31080/ecve.2022.07.00462',
'10.32870/dugesiana.v29i1.7240',
'10.32870/dugesiana.v29i1.7247',
'10.33256/31.3',
'10.35249/rche.47.4.21.17',
'10.35249/rche.47.4.21.18',
'10.35249/rche.47.4.21.19',
'10.35249/rche.47.4.21.20',
'10.35249/rche.47.4.21.21',
'10.36253/a_h-10079',
'10.36253/a_h-10229',
'10.36253/a_h-10306',
'10.36253/a_h-10402',
'10.36253/a_h-10742',
'10.36253/a_h-11339',
'10.36253/a_h-11502',
'10.37828/em.2022.50.9',
'10.37828/em.2022.50.10',
'10.37828/em.2022.51.1',
'10.37828/em.2022.51.2',
'10.37828/em.2022.51.3',
'10.37828/em.2022.51.4',
'10.37828/em.2022.51.5',
'10.37828/em.2022.51.6',
'10.37828/em.2022.51.7',
'10.47371/mycosci.2022.01.001',
'10.54896/00023272_2021_627_1',
'10.3390/d14020079',
'10.1007/s10228-021-00849-8',
'10.1016/j.ejop.2022.125866',
'10.1093/isd/ixab028',
'10.1093/zoolinnean/zlab035',
'10.24349/l06c-j0qm',
'10.25221/fee.443.1',
'10.25221/fee.443.2',
'10.25221/fee.443.3',
'10.35885/ruthenica.2022.32(1).4',
'10.35885/ruthenica.2022.32(1).5',
'10.15381/rpb.v28i4.20968',
);

/*
$dois=array(
'10.1002/ece3.8612',
'10.1002/fedr.202100021',
'10.26107/rbz-2021-0046',
'10.13346/j.mycosystema.210315',
'10.16373/j.cnki.ahr.200118',
);
*/

$dois=array_unique($dois);

$bad_dois = array();

$prefix = array();

$agency = array();

foreach ($dois as $doi)
{
	echo $doi . "\n";

	$parts = explode('/', $doi);
	
	if (!isset($prefix[$parts[0]]))
	{
		$prefix[$parts[0]] = array();
	}
	$prefix[$parts[0]][] = $doi;

}

$count = 1;

foreach ($prefix as $p)
{
	$doi = $p[0];
	
	$url = 'https://doi.org/ra/' . $doi;
	
	$json = get($url);
	
	//echo $json;
	
	$obj = json_decode($json);
	
	if ($obj)
	{
		if (isset($obj[0]->RA))
		{
			$a = $obj[0]->RA;
		
			if (!isset($agency[$a]))
			{
				$agency[$a] = array();
			}
			$agency[$a] = array_merge($agency[$a], $p);
		}
		
		if (isset($obj[0]->status))
		{
			if ($obj[0]->status == "DOI does not exist")
			{
				$bad_dois[] = $doi;
			}
		}
		
	}
	
	
	
	
	// Give server a break every 10 items
	if (($count++ % 10) == 0)
	{
		$rand = rand(1000000, 3000000);
		echo "\n- ...sleeping for " . round(($rand / 1000000),2) . ' seconds' . "\n\n";
		usleep($rand);
	}

}
	
//print_r($agency);

foreach ($agency as $a => $d)
{
	echo $a . "\n";
	
	echo "\n" . '$dois=array(' . "\n";
	
	sort($d);
	
	foreach ($d as $doi)
	{
		echo "'$doi',\n";
	}
	
	echo ");\n\n";


}

echo "\nBad DOIs\n";
print_r($bad_dois);


?>