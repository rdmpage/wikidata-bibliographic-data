<?php

// take Zenodo search and update SQL records

$json = '{
    "aggregations": {
        "access_right": {
            "buckets": [
                {
                    "doc_count": 97,
                    "key": "open"
                }
            ],
            "doc_count_error_upper_bound": 0,
            "sum_other_doc_count": 0
        },
        "file_type": {
            "buckets": [
                {
                    "doc_count": 96,
                    "key": "pdf"
                },
                {
                    "doc_count": 1,
                    "key": "mp4"
                },
                {
                    "doc_count": 1,
                    "key": "srt"
                }
            ],
            "doc_count_error_upper_bound": 0,
            "sum_other_doc_count": 0
        },
        "keywords": {
            "buckets": [
                {
                    "doc_count": 1,
                    "key": "Acraeini, Andes, cloud forest, cryptic species, DNA barcoding, Peru, wing pattern"
                },
                {
                    "doc_count": 1,
                    "key": "Actinote, Asteraceae, Biology, Buenos Aires Province, Distribution"
                },
                {
                    "doc_count": 1,
                    "key": "Aggregation, aposematism, feeding facilitation, gregarious behavior"
                },
                {
                    "doc_count": 1,
                    "key": "Aligarh, distributional ranges, new records, systematic account"
                },
                {
                    "doc_count": 1,
                    "key": "Amazon Forest, butterfly, Mechanitina, Solanaceae."
                },
                {
                    "doc_count": 1,
                    "key": "Amazon, Andes, clearwing butterflies, cloudforest, Colombia, DNA barcode, Ecuador, morphology, Neotropical region, Peru, rainforest, Solanaceae, systematics, taxonomy."
                },
                {
                    "doc_count": 1,
                    "key": "Andean mountains, Brazilian Atlantic Forest, diurnal, Lacosoma subrufescens comb. n., taxonomy, Trogoptera"
                },
                {
                    "doc_count": 1,
                    "key": "Andes Mountains, Costa Rica, Mimallonoidea, Neotropical, Panama, Peru"
                },
                {
                    "doc_count": 1,
                    "key": "Andes, Chusquea, immature stages, inventory, mimicry, species description, taxonomy"
                },
                {
                    "doc_count": 1,
                    "key": "Andes; Bolivia; cloud forest; collections; Colombia; Ecuador; field work; Neotropics; new species; Peru; taxonomy"
                }
            ],
            "doc_count_error_upper_bound": 0,
            "sum_other_doc_count": 72
        },
        "type": {
            "buckets": [
                {
                    "doc_count": 96,
                    "key": "publication",
                    "subtype": {
                        "buckets": [
                            {
                                "doc_count": 96,
                                "key": "article"
                            }
                        ],
                        "doc_count_error_upper_bound": 0,
                        "sum_other_doc_count": 0
                    }
                },
                {
                    "doc_count": 1,
                    "key": "video",
                    "subtype": {
                        "buckets": [],
                        "doc_count_error_upper_bound": 0,
                        "sum_other_doc_count": 0
                    }
                }
            ],
            "doc_count_error_upper_bound": 0,
            "sum_other_doc_count": 0
        }
    },
    "hits": {
        "hits": [
            {
                "conceptdoi": "10.5281/zenodo.3765144",
                "conceptrecid": "3765144",
                "created": "2020-05-06T04:04:57.363132+00:00",
                "doi": "10.5281/zenodo.3765145",
                "files": [
                    {
                        "bucket": "a99d6be5-e240-47c4-95a6-9d234fd1b347",
                        "checksum": "md5:d729aaa4104e881eb9a2929aa3e5c200",
                        "key": "TropLepRes30-1_Sourakov_Suppl_Mat.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/a99d6be5-e240-47c4-95a6-9d234fd1b347/TropLepRes30-1_Sourakov_Suppl_Mat.pdf"
                        },
                        "size": 4566183,
                        "type": "pdf"
                    }
                ],
                "id": 3765145,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3765145.svg",
                    "bucket": "https://zenodo.org/api/files/a99d6be5-e240-47c4-95a6-9d234fd1b347",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3765144.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3765144",
                    "doi": "https://doi.org/10.5281/zenodo.3765145",
                    "html": "https://zenodo.org/record/3765145",
                    "latest": "https://zenodo.org/api/records/3765145",
                    "latest_html": "https://zenodo.org/record/3765145",
                    "self": "https://zenodo.org/api/records/3765145"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Sourakov, Andrei"
                        },
                        {
                            "name": "Shirai, Leila T."
                        }
                    ],
                    "description": "<p>Supplementary materials accompanying an article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3765145",
                    "journal": {
                        "issue": "1",
                        "pages": "Online only supplement.",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-05-05",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3765144",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3765145"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3765144"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Supplementary Materials for Sourakov, A. & L. T. Shirai. 2020. Pharmacological and surgical experiments on wing pattern development of Lepidoptera, with the focus on eyespots of saturniid moths. Tropical Lepidoptera Research, 30(1): 4-19."
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 16,
                    "unique_downloads": 14,
                    "unique_views": 21,
                    "version_downloads": 16,
                    "version_unique_downloads": 14,
                    "version_unique_views": 21,
                    "version_views": 21,
                    "version_volume": 73058928,
                    "views": 21,
                    "volume": 73058928
                },
                "updated": "2020-05-11T20:20:34.424627+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4317586",
                "conceptrecid": "4317586",
                "created": "2020-12-21T19:57:10.298156+00:00",
                "doi": "10.5281/zenodo.4317587",
                "files": [
                    {
                        "bucket": "2ac949fe-6a49-4d11-8358-79bc2d4bba76",
                        "checksum": "md5:a79ab9aae96e7b78206242c53a4af472",
                        "key": "TropLepRes30-2_Nunez.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/2ac949fe-6a49-4d11-8358-79bc2d4bba76/TropLepRes30-2_Nunez.pdf"
                        },
                        "size": 13884060,
                        "type": "pdf"
                    }
                ],
                "id": 4317587,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317587.svg",
                    "bucket": "https://zenodo.org/api/files/2ac949fe-6a49-4d11-8358-79bc2d4bba76",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317586.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4317586",
                    "doi": "https://doi.org/10.5281/zenodo.4317587",
                    "html": "https://zenodo.org/record/4317587",
                    "latest": "https://zenodo.org/api/records/4317587",
                    "latest_html": "https://zenodo.org/record/4317587",
                    "self": "https://zenodo.org/api/records/4317587"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Colección de Lepidoptera, Laboratorio Barcode, Museo Argentino de Ciencias Naturales \"Bernardino Rivadavia\", Av. Angel Gallardo 470 (1405) Ciudad Autónoma de Buenos Aires, Argentina",
                            "name": "Núñez Bustos, Ezequiel Osvaldo"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4317587",
                    "journal": {
                        "issue": "2",
                        "pages": "103-114",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Actinote, Asteraceae, Biology, Buenos Aires Province, Distribution"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-12-21",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4317586",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4317587"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4317586"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Aspectos de historia natural de las especies de Actinote Hübner (Lepidoptera: Nymphalidae: Heliconiinae: Acraeini) en la Provincia de Buenos Aires, Argentina"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 11,
                    "unique_views": 18,
                    "version_downloads": 12,
                    "version_unique_downloads": 11,
                    "version_unique_views": 18,
                    "version_views": 21,
                    "version_volume": 166608720,
                    "views": 21,
                    "volume": 166608720
                },
                "updated": "2020-12-23T00:27:12.220417+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4317554",
                "conceptrecid": "4317554",
                "created": "2020-12-21T19:53:03.187746+00:00",
                "doi": "10.5281/zenodo.4317555",
                "files": [
                    {
                        "bucket": "3920b2ea-5835-4901-87eb-bcc8ed5350dc",
                        "checksum": "md5:6753d261d588517435b48a6e7ff7ca1e",
                        "key": "TropLepRes30-2_Freitas.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/3920b2ea-5835-4901-87eb-bcc8ed5350dc/TropLepRes30-2_Freitas.pdf"
                        },
                        "size": 2123722,
                        "type": "pdf"
                    }
                ],
                "id": 4317555,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317555.svg",
                    "bucket": "https://zenodo.org/api/files/3920b2ea-5835-4901-87eb-bcc8ed5350dc",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317554.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4317554",
                    "doi": "https://doi.org/10.5281/zenodo.4317555",
                    "html": "https://zenodo.org/record/4317555",
                    "latest": "https://zenodo.org/api/records/4317555",
                    "latest_html": "https://zenodo.org/record/4317555",
                    "self": "https://zenodo.org/api/records/4317555"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Departamento de Biologia Animal and Museu da Biodiversidade, Instituto de Biologia, Universidade Estadual de Campinas, 13083-862 Campinas, São Paulo, Brazil",
                            "name": "Freitas, André V. L."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4317555",
                    "journal": {
                        "issue": "2",
                        "pages": "81-85",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Atlantic Forest, Calpodini, Heliconiaceae, Hesperiinae"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-12-21",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4317554",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4317555"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4317554"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages of the Neotropical skipper Saliana longirostris (Sepp, [1840]) (Lepidoptera: Hesperiidae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 15,
                    "unique_downloads": 14,
                    "unique_views": 13,
                    "version_downloads": 15,
                    "version_unique_downloads": 14,
                    "version_unique_views": 13,
                    "version_views": 13,
                    "version_volume": 31855830,
                    "views": 13,
                    "volume": 31855830
                },
                "updated": "2020-12-23T00:27:12.655047+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4317565",
                "conceptrecid": "4317565",
                "created": "2020-12-21T19:55:02.289462+00:00",
                "doi": "10.5281/zenodo.4317566",
                "files": [
                    {
                        "bucket": "e4250b77-63dc-4807-8380-901cfbdf9d74",
                        "checksum": "md5:ce35fdc04e222cfc8444965f7786ee77",
                        "key": "TropLepRes30-2_Hernandez.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/e4250b77-63dc-4807-8380-901cfbdf9d74/TropLepRes30-2_Hernandez.pdf"
                        },
                        "size": 442267,
                        "type": "pdf"
                    }
                ],
                "id": 4317566,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317566.svg",
                    "bucket": "https://zenodo.org/api/files/e4250b77-63dc-4807-8380-901cfbdf9d74",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317565.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4317565",
                    "doi": "https://doi.org/10.5281/zenodo.4317566",
                    "html": "https://zenodo.org/record/4317566",
                    "latest": "https://zenodo.org/api/records/4317566",
                    "latest_html": "https://zenodo.org/record/4317566",
                    "self": "https://zenodo.org/api/records/4317566"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Cambium, La Yagua, Espaillat, Dominican Republic",
                            "name": "Hernandez, Jason P."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4317566",
                    "journal": {
                        "issue": "2",
                        "pages": "90-92",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "notes": "Hyalurga, Erebidae",
                    "publication_date": "2020-12-21",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4317565",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4317566"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4317565"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: Observations on the life history of Hyalurga vinosa (Lepidoptera: Erebidae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 9,
                    "unique_downloads": 9,
                    "unique_views": 15,
                    "version_downloads": 9,
                    "version_unique_downloads": 9,
                    "version_unique_views": 15,
                    "version_views": 15,
                    "version_volume": 3980403,
                    "views": 15,
                    "volume": 3980403
                },
                "updated": "2020-12-23T00:27:12.221386+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4317557",
                "conceptrecid": "4317557",
                "created": "2020-12-21T19:53:53.411040+00:00",
                "doi": "10.5281/zenodo.4317558",
                "files": [
                    {
                        "bucket": "f0e3048a-9546-4c04-ac0b-2ef9305fbe02",
                        "checksum": "md5:a54e32df6693b175f4e06a353313d364",
                        "key": "TropLepRes30-2_Garcia.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/f0e3048a-9546-4c04-ac0b-2ef9305fbe02/TropLepRes30-2_Garcia.pdf"
                        },
                        "size": 3247288,
                        "type": "pdf"
                    }
                ],
                "id": 4317558,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317558.svg",
                    "bucket": "https://zenodo.org/api/files/f0e3048a-9546-4c04-ac0b-2ef9305fbe02",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317557.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4317557",
                    "doi": "https://doi.org/10.5281/zenodo.4317558",
                    "html": "https://zenodo.org/record/4317558",
                    "latest": "https://zenodo.org/api/records/4317558",
                    "latest_html": "https://zenodo.org/record/4317558",
                    "self": "https://zenodo.org/api/records/4317558"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "ociedad Mexicana de Lepidopterología A.C.",
                            "name": "García Díaz, José de Jesús"
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, P.O. Box 112710, Gainesville, FL 32611-2710, USA",
                            "name": "Miller, Jacqueline Y."
                        },
                        {
                            "affiliation": "Austin Achieve Public Schools, Austin, Texas, 78723, USA",
                            "name": "González, Jorge M."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4317558",
                    "journal": {
                        "issue": "2",
                        "pages": "86-89",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Athis, bionomics, Hechtia roseana, H. tehuacana, Lepidoptera"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-12-21",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4317557",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4317558"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4317557"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: Observations on the courtship and other biological aspects of Athis hechtiae (Dyar, 1910) (Castniidae) in Tehuacán, Puebla, Mexico"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 13,
                    "unique_downloads": 12,
                    "unique_views": 19,
                    "version_downloads": 13,
                    "version_unique_downloads": 12,
                    "version_unique_views": 19,
                    "version_views": 19,
                    "version_volume": 42214744,
                    "views": 19,
                    "volume": 42214744
                },
                "updated": "2020-12-23T00:27:11.945642+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4317574",
                "conceptrecid": "4317574",
                "created": "2020-12-21T19:56:03.849788+00:00",
                "doi": "10.5281/zenodo.4317575",
                "files": [
                    {
                        "bucket": "12093bb3-d21e-4b0d-be6c-4707006d266f",
                        "checksum": "md5:8a2e5e61c5e55bcf5e08cc92a0443fe9",
                        "key": "TropLepRes30-2_Landry.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/12093bb3-d21e-4b0d-be6c-4707006d266f/TropLepRes30-2_Landry.pdf"
                        },
                        "size": 5766230,
                        "type": "pdf"
                    }
                ],
                "id": 4317575,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317575.svg",
                    "bucket": "https://zenodo.org/api/files/12093bb3-d21e-4b0d-be6c-4707006d266f",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317574.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4317574",
                    "doi": "https://doi.org/10.5281/zenodo.4317575",
                    "html": "https://zenodo.org/record/4317575",
                    "latest": "https://zenodo.org/api/records/4317575",
                    "latest_html": "https://zenodo.org/record/4317575",
                    "self": "https://zenodo.org/api/records/4317575"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Muséum d\'histoire naturelle, Malagnou Road 1, 1208 Geneva, Switzerland",
                            "name": "Landry, Bernard"
                        },
                        {
                            "affiliation": "ForestGEO, Smithsonian Tropical Research Institute, Apartado 0843-03092, Balboa, Ancon, Panamá",
                            "name": "Basset, Yves"
                        },
                        {
                            "affiliation": "Centre for Biodiversity Genomics, University of Guelph, Ontario, N1G 2W1, Canada",
                            "name": "Hebert, Paul D. N."
                        },
                        {
                            "affiliation": "Museo Entomologico de León, A.P. 527, 21000 León, Nicaragua",
                            "name": "Maes, Jean-Michel"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4317575",
                    "journal": {
                        "issue": "2",
                        "pages": "93-102",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Crambidae, Pyralidae, rarefaction curves, seasonal and ecosystem effects on diversity, species richness"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-12-21",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4317574",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4317575"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4317574"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "On the Pyraloidea fauna of Nicaragua"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 25,
                    "unique_downloads": 24,
                    "unique_views": 29,
                    "version_downloads": 25,
                    "version_unique_downloads": 24,
                    "version_unique_views": 29,
                    "version_views": 37,
                    "version_volume": 144155750,
                    "views": 37,
                    "volume": 144155750
                },
                "updated": "2020-12-22T12:27:15.541997+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3990654",
                "conceptrecid": "3990654",
                "created": "2020-08-24T22:01:35.677872+00:00",
                "doi": "10.5281/zenodo.3990655",
                "files": [
                    {
                        "bucket": "36a8eb31-8046-4b84-8c51-41ecaf1faa72",
                        "checksum": "md5:dff0e599c2cf4290aec904b51e3f39a9",
                        "key": "TropLepRes30-2_Baidya.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/36a8eb31-8046-4b84-8c51-41ecaf1faa72/TropLepRes30-2_Baidya.pdf"
                        },
                        "size": 4708815,
                        "type": "pdf"
                    }
                ],
                "id": 3990655,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3990655.svg",
                    "bucket": "https://zenodo.org/api/files/36a8eb31-8046-4b84-8c51-41ecaf1faa72",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3990654.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3990654",
                    "doi": "https://doi.org/10.5281/zenodo.3990655",
                    "html": "https://zenodo.org/record/3990655",
                    "latest": "https://zenodo.org/api/records/3990655",
                    "latest_html": "https://zenodo.org/record/3990655",
                    "self": "https://zenodo.org/api/records/3990655"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Baidya, Sarika"
                        },
                        {
                            "name": "Roy, Souparno"
                        },
                        {
                            "name": "Roy, Arjan Basu"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.3990655",
                    "journal": {
                        "issue": "2",
                        "pages": "72-77",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Background mimicking; background selection; camouflaging; chromatophore; structural coloration"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-08-24",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3990654",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3990655"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3990654"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: Blending with the background: very unusual background-matching behavior of a caterpillar of Ariadne merione (Nymphalidae) in captivity"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 12,
                    "unique_views": 18,
                    "version_downloads": 12,
                    "version_unique_downloads": 12,
                    "version_unique_views": 18,
                    "version_views": 18,
                    "version_volume": 56505780,
                    "views": 18,
                    "volume": 56505780
                },
                "updated": "2020-08-25T00:59:24.644597+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3515362",
                "conceptrecid": "3515362",
                "created": "2019-10-28T16:53:23.132629+00:00",
                "doi": "10.5281/zenodo.3515363",
                "files": [
                    {
                        "bucket": "131f9085-e042-4c05-bd61-b997a943f399",
                        "checksum": "md5:e0a52d98a02552bd4e71933681481724",
                        "key": "TropLepRes29-2_Brown.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/131f9085-e042-4c05-bd61-b997a943f399/TropLepRes29-2_Brown.pdf"
                        },
                        "size": 2357841,
                        "type": "pdf"
                    }
                ],
                "id": 3515363,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3515363.svg",
                    "bucket": "https://zenodo.org/api/files/131f9085-e042-4c05-bd61-b997a943f399",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3515362.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3515362",
                    "doi": "https://doi.org/10.5281/zenodo.3515363",
                    "html": "https://zenodo.org/record/3515363",
                    "latest": "https://zenodo.org/api/records/3515363",
                    "latest_html": "https://zenodo.org/record/3515363",
                    "self": "https://zenodo.org/api/records/3515363"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Department of Entomology, National Museum of Natural History, Washington, DC",
                            "name": "Brown, John W."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.3515363",
                    "journal": {
                        "issue": "2",
                        "pages": "67-73",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "29"
                    },
                    "keywords": [
                        "Central America, Cochylini, Grapholitini, host plants, Polyorthini, seed-feeder"
                    ],
                    "license": {
                        "id": "CC-BY-ND-4.0"
                    },
                    "publication_date": "2019-10-28",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3515362",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3515363"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3515362"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Descriptions of four new species of fruit-feeding Tortricidae from Panama (Lepidoptera: Tortricidae)"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 16,
                    "unique_downloads": 15,
                    "unique_views": 35,
                    "version_downloads": 16,
                    "version_unique_downloads": 15,
                    "version_unique_views": 35,
                    "version_views": 38,
                    "version_volume": 37725456,
                    "views": 38,
                    "volume": 37725456
                },
                "updated": "2020-01-20T17:03:53.249756+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3515366",
                "conceptrecid": "3515366",
                "created": "2019-10-28T16:56:35.180518+00:00",
                "doi": "10.5281/zenodo.3515367",
                "files": [
                    {
                        "bucket": "543ff844-7213-42fb-9047-3b64ecbe8665",
                        "checksum": "md5:1922828d8b74fdccdf161ccf69acb214",
                        "key": "TropLepRes29-2_Baine.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/543ff844-7213-42fb-9047-3b64ecbe8665/TropLepRes29-2_Baine.pdf"
                        },
                        "size": 7657631,
                        "type": "pdf"
                    }
                ],
                "id": 3515367,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3515367.svg",
                    "bucket": "https://zenodo.org/api/files/543ff844-7213-42fb-9047-3b64ecbe8665",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3515366.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3515366",
                    "doi": "https://doi.org/10.5281/zenodo.3515367",
                    "html": "https://zenodo.org/record/3515367",
                    "latest": "https://zenodo.org/api/records/3515367",
                    "latest_html": "https://zenodo.org/record/3515367",
                    "self": "https://zenodo.org/api/records/3515367"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Washington State Department of Agriculture, Olympia, WA",
                            "name": "Baine, Quinlyn"
                        },
                        {
                            "affiliation": "Alliance for a Sustainable Amazon, Hanover, MD",
                            "name": "Polo Espinoza, Gabriela"
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL",
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "affiliation": "Alliance for a Sustainable Amazon, Hanover, MD",
                            "name": "Gallice, Geoffrey"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.3515367",
                    "journal": {
                        "issue": "2",
                        "pages": "79-86",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "29"
                    },
                    "keywords": [
                        "Euptychiina, host plant, larva, Lepidoptera, Madre de Dios, Peru"
                    ],
                    "license": {
                        "id": "CC-BY-ND-4.0"
                    },
                    "publication_date": "2019-10-28",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3515366",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3515367"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3515366"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages and new host record of Taygetis rufomarginata Staudinger, 1888 (Lepidoptera: Nymphalidae: Satyrinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 11,
                    "unique_downloads": 11,
                    "unique_views": 19,
                    "version_downloads": 11,
                    "version_unique_downloads": 11,
                    "version_unique_views": 19,
                    "version_views": 19,
                    "version_volume": 84233941,
                    "views": 19,
                    "volume": 84233941
                },
                "updated": "2020-01-20T17:23:25.271039+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2685489",
                "conceptrecid": "2685489",
                "created": "2019-05-17T22:27:19.465025+00:00",
                "doi": "10.5281/zenodo.2685490",
                "files": [
                    {
                        "bucket": "2043ce3d-deb6-4526-82b9-27cdae3851eb",
                        "checksum": "md5:74167967dad0c320a0aa165d1a316c8a",
                        "key": "TropLepRes29-2_Freitas.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/2043ce3d-deb6-4526-82b9-27cdae3851eb/TropLepRes29-2_Freitas.pdf"
                        },
                        "size": 6586793,
                        "type": "pdf"
                    }
                ],
                "id": 2685490,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2685490.svg",
                    "bucket": "https://zenodo.org/api/files/2043ce3d-deb6-4526-82b9-27cdae3851eb",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2685489.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2685489",
                    "doi": "https://doi.org/10.5281/zenodo.2685490",
                    "html": "https://zenodo.org/record/2685490",
                    "latest": "https://zenodo.org/api/records/2685490",
                    "latest_html": "https://zenodo.org/record/2685490",
                    "self": "https://zenodo.org/api/records/2685490"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Departamento de Biologia Animal and Museu de Zoologia, Instituto de Biologia, Universidade Estadual de Campinas. Caixa postal 6109, 13083-970 Campinas, São Paulo, Brazil",
                            "name": "Freitas, André V. L."
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, Florida, USA",
                            "name": "Woodbury, Maxwell S."
                        },
                        {
                            "affiliation": "Departamento de Biologia Animal and Museu de Zoologia, Instituto de Biologia, Universidade Estadual de Campinas. Caixa postal 6109, 13083-970 Campinas, São Paulo, Brazil",
                            "name": "Barbosa, Eduardo P."
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, Florida, USA",
                            "name": "Willmott, Keith R."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.2685490",
                    "journal": {
                        "issue": "2",
                        "pages": "62-66",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "29"
                    },
                    "keywords": [
                        "Atlantic forest; biodiversity; butterflies; conservation; Lepidoptera; natural history collections; new taxon; taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2019-05-17",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2685489",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2685490"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2685489"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new subspecies of Adelpha messana (C. Felder & R. Felder) from the Brazilian Atlantic forest (Nymphalidae: Limenitidinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 5,
                "stats": {
                    "downloads": 21,
                    "unique_downloads": 21,
                    "unique_views": 35,
                    "version_downloads": 21,
                    "version_unique_downloads": 21,
                    "version_unique_views": 35,
                    "version_views": 36,
                    "version_volume": 138322653,
                    "views": 36,
                    "volume": 138322653
                },
                "updated": "2020-01-20T13:03:58.573878+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4317595",
                "conceptrecid": "4317595",
                "created": "2020-12-21T19:58:29.168473+00:00",
                "doi": "10.5281/zenodo.4317596",
                "files": [
                    {
                        "bucket": "e4a69407-7072-4289-83f7-0c6e573cff5c",
                        "checksum": "md5:fbbcf546be03807006361b5efc91d24b",
                        "key": "TropLepRes30-2_Das.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/e4a69407-7072-4289-83f7-0c6e573cff5c/TropLepRes30-2_Das.pdf"
                        },
                        "size": 7557752,
                        "type": "pdf"
                    }
                ],
                "id": 4317596,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317596.svg",
                    "bucket": "https://zenodo.org/api/files/e4a69407-7072-4289-83f7-0c6e573cff5c",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317595.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4317595",
                    "doi": "https://doi.org/10.5281/zenodo.4317596",
                    "html": "https://zenodo.org/record/4317596",
                    "latest": "https://zenodo.org/api/records/4317596",
                    "latest_html": "https://zenodo.org/record/4317596",
                    "self": "https://zenodo.org/api/records/4317596"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Zoological Survey of India, New Alipore, Kolkata, West Bengal-700053, India",
                            "name": "Das, Gaurab Nandi"
                        },
                        {
                            "affiliation": "Zoological Survey of India, New Alipore, Kolkata, West Bengal-700053, India",
                            "name": "Singh, Navneet"
                        },
                        {
                            "affiliation": "Zoological Survey of India, New Alipore, Kolkata, West Bengal-700053, India",
                            "name": "Chandra, Kailash"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4317596",
                    "journal": {
                        "issue": "2",
                        "pages": "115-125",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "androconia, Cyllogenes, genitalia, morphology, taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-12-21",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4317595",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4317596"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4317595"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Notes on the genus Cyllogenes Butler, 1868 (Lepidoptera: Nymphalidae: Satyrinae) from India"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 8,
                    "unique_downloads": 7,
                    "unique_views": 15,
                    "version_downloads": 8,
                    "version_unique_downloads": 7,
                    "version_unique_views": 15,
                    "version_views": 16,
                    "version_volume": 60462016,
                    "views": 16,
                    "volume": 60462016
                },
                "updated": "2020-12-23T00:27:12.320429+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3877484",
                "conceptrecid": "3877484",
                "created": "2020-06-19T14:07:58.450658+00:00",
                "doi": "10.5281/zenodo.3877485",
                "files": [
                    {
                        "bucket": "e9df8bc6-078a-4d2b-a01a-4fd9f14aece4",
                        "checksum": "md5:b7e2fc1d61c426eae504bc50ccbaf330",
                        "key": "TropLepRes30-1_Warren.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/e9df8bc6-078a-4d2b-a01a-4fd9f14aece4/TropLepRes30-1_Warren.pdf"
                        },
                        "size": 3190304,
                        "type": "pdf"
                    }
                ],
                "id": 3877485,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3877485.svg",
                    "bucket": "https://zenodo.org/api/files/e9df8bc6-078a-4d2b-a01a-4fd9f14aece4",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3877484.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3877484",
                    "doi": "https://doi.org/10.5281/zenodo.3877485",
                    "html": "https://zenodo.org/record/3877485",
                    "latest": "https://zenodo.org/api/records/3877485",
                    "latest_html": "https://zenodo.org/record/3877485",
                    "self": "https://zenodo.org/api/records/3877485"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Warren, Andrew W."
                        },
                        {
                            "name": "Gott, Riley J."
                        },
                        {
                            "name": "Dorado, Oscar"
                        },
                        {
                            "name": "Legal, Luc"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3877485",
                    "journal": {
                        "issue": "1",
                        "pages": "46-51",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Bambuseae, biodiversity, butterfly, Chusquea circinata, skipper"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-06-19",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3877484",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3877485"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3877484"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new species of Dalla Mabille, 1904, from Morelos, Mexico  (Lepidoptera: Hesperiidae: Heteropterinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 10,
                    "unique_downloads": 10,
                    "unique_views": 19,
                    "version_downloads": 10,
                    "version_unique_downloads": 10,
                    "version_unique_views": 19,
                    "version_views": 20,
                    "version_volume": 31903040,
                    "views": 20,
                    "volume": 31903040
                },
                "updated": "2020-06-19T22:18:22.672980+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3561097",
                "conceptrecid": "3561097",
                "created": "2019-12-09T15:53:17.434147+00:00",
                "doi": "10.5281/zenodo.3561098",
                "files": [
                    {
                        "bucket": "2a95d792-da5f-4c36-a1ba-8b1a994b5240",
                        "checksum": "md5:253eb164d8bd8be8f45a47ea7ec52ad4",
                        "key": "TropLepRes29-2_Nakahara.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/2a95d792-da5f-4c36-a1ba-8b1a994b5240/TropLepRes29-2_Nakahara.pdf"
                        },
                        "size": 2641479,
                        "type": "pdf"
                    }
                ],
                "id": 3561098,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3561098.svg",
                    "bucket": "https://zenodo.org/api/files/2a95d792-da5f-4c36-a1ba-8b1a994b5240",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3561097.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3561097",
                    "doi": "https://doi.org/10.5281/zenodo.3561098",
                    "html": "https://zenodo.org/record/3561098",
                    "latest": "https://zenodo.org/api/records/3561098",
                    "latest_html": "https://zenodo.org/record/3561098",
                    "self": "https://zenodo.org/api/records/3561098"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL 32611, USA",
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "affiliation": "La Union Suyapa, Las Vegas, Santa Barbara, Honduras",
                            "name": "Gallardo, Robert"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3561098",
                    "journal": {
                        "issue": "2",
                        "pages": "111-114",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "29"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2019-12-09",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3561097",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3561098"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3561097"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: Reinstatement of Euptychia sericeella Bates, 1865: Amiga sericeella stat. rev., with corrigenda to Nakahara et al. (2019) (Lepidoptera: Nymphalidae: Satyrinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 7,
                    "unique_downloads": 7,
                    "unique_views": 15,
                    "version_downloads": 7,
                    "version_unique_downloads": 7,
                    "version_unique_views": 15,
                    "version_views": 15,
                    "version_volume": 18490353,
                    "views": 15,
                    "volume": 18490353
                },
                "updated": "2020-01-20T15:26:31.701437+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3538154",
                "conceptrecid": "3538154",
                "created": "2019-11-18T18:39:29.071041+00:00",
                "doi": "10.5281/zenodo.3538155",
                "files": [
                    {
                        "bucket": "c3b7409d-a44a-4dc3-a7ab-76d3d92e0cd5",
                        "checksum": "md5:17946e5e9b94250d4dceed51b5257b6c",
                        "key": "TropLepRes29-2_Basu.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/c3b7409d-a44a-4dc3-a7ab-76d3d92e0cd5/TropLepRes29-2_Basu.pdf"
                        },
                        "size": 25836417,
                        "type": "pdf"
                    }
                ],
                "id": 3538155,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3538155.svg",
                    "bucket": "https://zenodo.org/api/files/c3b7409d-a44a-4dc3-a7ab-76d3d92e0cd5",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3538154.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3538154",
                    "doi": "https://doi.org/10.5281/zenodo.3538155",
                    "html": "https://zenodo.org/record/3538155",
                    "latest": "https://zenodo.org/api/records/3538155",
                    "latest_html": "https://zenodo.org/record/3538155",
                    "self": "https://zenodo.org/api/records/3538155"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "National Centre for Biological Sciences, Tata Institute of Fundamental Research, GKVK Campus, Bellary Road, Bangalore 560 065, India",
                            "name": "Basu, Dipendra Nath"
                        },
                        {
                            "affiliation": "Indian Foundation for Butterflies, Bangalore 560 097, India",
                            "name": "Churi, Paresh"
                        },
                        {
                            "affiliation": "Indian Foundation for Butterflies, Bangalore 560 097, India",
                            "name": "Soman, Abhay"
                        },
                        {
                            "affiliation": "Indian Foundation for Butterflies, Bangalore 560 097, India",
                            "name": "Sengupta, Ashok"
                        },
                        {
                            "affiliation": "Indian Foundation for Butterflies, Bangalore 560 097, India",
                            "name": "Bhakare, Milind"
                        },
                        {
                            "affiliation": "Indian Foundation for Butterflies, Bangalore 560 097, India",
                            "name": "Lokhande, Swapnil"
                        },
                        {
                            "affiliation": "Indian Foundation for Butterflies, Bangalore 560 097, India",
                            "name": "Bhoite, Sunil"
                        },
                        {
                            "affiliation": "Natural History Museum, Cromwell Road, London SW7 5BD, UK",
                            "name": "Huertas, Blanca"
                        },
                        {
                            "affiliation": "National Centre for Biological Sciences, Tata Institute of Fundamental Research, GKVK Campus, Bellary Road, Bangalore 560 065, India",
                            "name": "Kunte, Krushnamegh"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3538155",
                    "journal": {
                        "issue": "2",
                        "pages": "87-110",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "29"
                    },
                    "keywords": [
                        "Indian butterflies; Polyommatinae; Type designation; Lectotypes; Faunal surveys; butterfly early stages"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2019-11-18",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3538154",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3538155"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3538154"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "The genus Tarucus Moore, [1881] (Lepidoptera: Lycaenidae) in the Indian Subcontinent"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 61,
                    "unique_downloads": 54,
                    "unique_views": 60,
                    "version_downloads": 61,
                    "version_unique_downloads": 54,
                    "version_unique_views": 60,
                    "version_views": 66,
                    "version_volume": 1576021437,
                    "views": 66,
                    "volume": 1576021437
                },
                "updated": "2020-01-20T17:31:56.962094+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3931774",
                "conceptrecid": "3931774",
                "created": "2020-07-15T16:57:58.774011+00:00",
                "doi": "10.5281/zenodo.3931775",
                "files": [
                    {
                        "bucket": "7a69e688-700a-47e1-9d42-30054b5a1714",
                        "checksum": "md5:0e082de2c9b3ec54f0f8813beca04e86",
                        "key": "TropLepRes30-2_Blandin.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/7a69e688-700a-47e1-9d42-30054b5a1714/TropLepRes30-2_Blandin.pdf"
                        },
                        "size": 8772241,
                        "type": "pdf"
                    }
                ],
                "id": 3931775,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3931775.svg",
                    "bucket": "https://zenodo.org/api/files/7a69e688-700a-47e1-9d42-30054b5a1714",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3931774.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3931774",
                    "doi": "https://doi.org/10.5281/zenodo.3931775",
                    "html": "https://zenodo.org/record/3931775",
                    "latest": "https://zenodo.org/api/records/3931775",
                    "latest_html": "https://zenodo.org/record/3931775",
                    "self": "https://zenodo.org/api/records/3931775"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Blandin, Patrick"
                        },
                        {
                            "name": "Johnson, Peter"
                        },
                        {
                            "name": "Garcia, Marcial"
                        },
                        {
                            "name": "Neild, Andrew F. E."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3931775",
                    "journal": {
                        "issue": "2",
                        "pages": "58-64",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Morpho menelaus, Morpho menelaus chantalae ssp. nov., Morpho menelaus orinocensis, Venezuela, Serranía de Turimiquire, Orinoco Delta."
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-07-15",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3931774",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3931775"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3931774"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Morpho menelaus (Linnaeus, 1758), in north-eastern Venezuela: description of a new subspecies"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 12,
                    "unique_views": 22,
                    "version_downloads": 12,
                    "version_unique_downloads": 12,
                    "version_unique_views": 22,
                    "version_views": 22,
                    "version_volume": 105266892,
                    "views": 22,
                    "volume": 105266892
                },
                "updated": "2020-07-16T00:59:19.899667+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3990650",
                "conceptrecid": "3990650",
                "created": "2020-08-24T21:57:37.683880+00:00",
                "doi": "10.5281/zenodo.3990651",
                "files": [
                    {
                        "bucket": "49e11736-2a5b-4d59-b175-595892cf59a3",
                        "checksum": "md5:51804cbd0e78be288beabb1a7a199b7d",
                        "key": "TropLepRes30-2_Padron.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/49e11736-2a5b-4d59-b175-595892cf59a3/TropLepRes30-2_Padron.pdf"
                        },
                        "size": 4729783,
                        "type": "pdf"
                    }
                ],
                "id": 3990651,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3990651.svg",
                    "bucket": "https://zenodo.org/api/files/49e11736-2a5b-4d59-b175-595892cf59a3",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3990650.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3990650",
                    "doi": "https://doi.org/10.5281/zenodo.3990651",
                    "html": "https://zenodo.org/record/3990651",
                    "latest": "https://zenodo.org/api/records/3990651",
                    "latest_html": "https://zenodo.org/record/3990651",
                    "self": "https://zenodo.org/api/records/3990651"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Padrón, Pablo Sebastián"
                        },
                        {
                            "name": "Vélez, Ariana"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.3990651",
                    "journal": {
                        "issue": "2",
                        "pages": "65-71",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Andes; Ecuador; host plant; mistletoe; Santalaceae"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-08-24",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3990650",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3990651"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3990650"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Description of the immature stages of the high Andean pierid butterfly Catasticta incerta incerta (Dognin, 1888) (Lepidoptera: Pieridae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 17,
                    "unique_downloads": 17,
                    "unique_views": 24,
                    "version_downloads": 17,
                    "version_unique_downloads": 17,
                    "version_unique_views": 24,
                    "version_views": 24,
                    "version_volume": 80406311,
                    "views": 24,
                    "volume": 80406311
                },
                "updated": "2020-08-25T00:59:24.742835+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3515364",
                "conceptrecid": "3515364",
                "created": "2019-10-28T16:55:06.686384+00:00",
                "doi": "10.5281/zenodo.3515365",
                "files": [
                    {
                        "bucket": "1d6155ce-3158-449c-8b1e-73ff8e067c69",
                        "checksum": "md5:5a9091f08e3dfbed74592062c6d8722d",
                        "key": "TropLepRes29-2_Anderson.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/1d6155ce-3158-449c-8b1e-73ff8e067c69/TropLepRes29-2_Anderson.pdf"
                        },
                        "size": 676111,
                        "type": "pdf"
                    }
                ],
                "id": 3515365,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3515365.svg",
                    "bucket": "https://zenodo.org/api/files/1d6155ce-3158-449c-8b1e-73ff8e067c69",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3515364.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3515364",
                    "doi": "https://doi.org/10.5281/zenodo.3515365",
                    "html": "https://zenodo.org/record/3515365",
                    "latest": "https://zenodo.org/api/records/3515365",
                    "latest_html": "https://zenodo.org/record/3515365",
                    "self": "https://zenodo.org/api/records/3515365"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, P.O. Box 112710, Gainesville, Florida 32611-2710,",
                            "name": "Anderson, Richard A."
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, Florida",
                            "name": "Nakamura, Ichiro"
                        },
                        {
                            "affiliation": "Department of Systematic Biology-Entomology, National Museum of Natural History, Smithsonian Institution, Washington, DC",
                            "name": "Harvey, Donald J."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.3515365",
                    "journal": {
                        "issue": "2",
                        "pages": "74-78",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "29"
                    },
                    "keywords": [
                        "Panama, cloud forest, neotropics, genitalia, Hesperiidae"
                    ],
                    "license": {
                        "id": "CC-BY-ND-4.0"
                    },
                    "publication_date": "2019-10-28",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3515364",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3515365"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3515364"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Description of a new species of the genus Psoralis Mabille, 1904 with a note on two other Panamanian species of the genus (Lepidoptera: Hesperiidae: Hesperiinae: Moncini)"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 8,
                    "unique_downloads": 8,
                    "unique_views": 17,
                    "version_downloads": 8,
                    "version_unique_downloads": 8,
                    "version_unique_views": 17,
                    "version_views": 17,
                    "version_volume": 5408888,
                    "views": 17,
                    "volume": 5408888
                },
                "updated": "2020-01-20T17:04:15.345038+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3877481",
                "conceptrecid": "3877481",
                "created": "2020-06-19T14:03:09.019370+00:00",
                "doi": "10.5281/zenodo.3877482",
                "files": [
                    {
                        "bucket": "b541e401-2851-470c-a58c-7019fd744a4c",
                        "checksum": "md5:b7cc2b6453b2b1e49f0eb632bb746283",
                        "key": "TropLepRes30-1_Turner.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/b541e401-2851-470c-a58c-7019fd744a4c/TropLepRes30-1_Turner.pdf"
                        },
                        "size": 3862584,
                        "type": "pdf"
                    }
                ],
                "id": 3877482,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3877482.svg",
                    "bucket": "https://zenodo.org/api/files/b541e401-2851-470c-a58c-7019fd744a4c",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3877481.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3877481",
                    "doi": "https://doi.org/10.5281/zenodo.3877482",
                    "html": "https://zenodo.org/record/3877482",
                    "latest": "https://zenodo.org/api/records/3877482",
                    "latest_html": "https://zenodo.org/record/3877482",
                    "self": "https://zenodo.org/api/records/3877482"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Turner, Thomas W."
                        },
                        {
                            "name": "Turland, Vaughan A."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3877482",
                    "journal": {
                        "issue": "1",
                        "pages": "42-45",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "black bar, bristles, forewing vein A3, ovate structure, pad and brush scales, wing coupling."
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-06-19",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3877481",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3877482"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3877481"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: Discovery of apparent wing coupling structures in Calpodes ethlius (Stoll 1782) (Hesperiidae: Hesperiinae: Calpodini) from Jamaica, West Indies"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 7,
                    "unique_downloads": 7,
                    "unique_views": 12,
                    "version_downloads": 7,
                    "version_unique_downloads": 7,
                    "version_unique_views": 12,
                    "version_views": 12,
                    "version_volume": 27038088,
                    "views": 12,
                    "volume": 27038088
                },
                "updated": "2020-06-19T22:18:22.696250+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3877477",
                "conceptrecid": "3877477",
                "created": "2020-06-19T13:55:23.493664+00:00",
                "doi": "10.5281/zenodo.3877478",
                "files": [
                    {
                        "bucket": "d8102ed1-f997-4ecf-b246-08c97b90a525",
                        "checksum": "md5:d59969334d52a493715d3c52dc834b35",
                        "key": "TropLepRes30-1_Nakahara.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/d8102ed1-f997-4ecf-b246-08c97b90a525/TropLepRes30-1_Nakahara.pdf"
                        },
                        "size": 2528394,
                        "type": "pdf"
                    }
                ],
                "id": 3877478,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3877478.svg",
                    "bucket": "https://zenodo.org/api/files/d8102ed1-f997-4ecf-b246-08c97b90a525",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3877477.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3877477",
                    "doi": "https://doi.org/10.5281/zenodo.3877478",
                    "html": "https://zenodo.org/record/3877478",
                    "latest": "https://zenodo.org/api/records/3877478",
                    "latest_html": "https://zenodo.org/record/3877478",
                    "self": "https://zenodo.org/api/records/3877478"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "name": "Hoffman, Fjella L. A."
                        },
                        {
                            "name": "Hoffman, Fabia L."
                        },
                        {
                            "name": "Gallice, Geoffey"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3877478",
                    "journal": {
                        "issue": "1",
                        "pages": "33-38",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Euptychiina, Lasiacis ligulata, Madre de Dios, Peru"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-06-19",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3877477",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3877478"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3877477"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages of Magneuptychia harpyia (C. Felder & R. Felder, 1867) (Lepidoptera: Nymphalidae: Satyrinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 8,
                    "unique_downloads": 8,
                    "unique_views": 18,
                    "version_downloads": 8,
                    "version_unique_downloads": 8,
                    "version_unique_views": 18,
                    "version_views": 18,
                    "version_volume": 20227152,
                    "views": 18,
                    "volume": 20227152
                },
                "updated": "2020-06-19T22:18:22.665332+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3877451",
                "conceptrecid": "3877451",
                "created": "2020-06-19T14:16:55.165442+00:00",
                "doi": "10.5281/zenodo.3877452",
                "files": [
                    {
                        "bucket": "302262ac-1e92-4b05-87d4-835760ef5081",
                        "checksum": "md5:2040b94727da9ff55cde94c35b2b6688",
                        "key": "TropLepRes30-1_Hall_Periplacis_Suppl_Mat.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/302262ac-1e92-4b05-87d4-835760ef5081/TropLepRes30-1_Hall_Periplacis_Suppl_Mat.pdf"
                        },
                        "size": 241374,
                        "type": "pdf"
                    }
                ],
                "id": 3877452,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3877452.svg",
                    "bucket": "https://zenodo.org/api/files/302262ac-1e92-4b05-87d4-835760ef5081",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3877451.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3877451",
                    "doi": "https://doi.org/10.5281/zenodo.3877452",
                    "html": "https://zenodo.org/record/3877452",
                    "latest": "https://zenodo.org/api/records/3877452",
                    "latest_html": "https://zenodo.org/record/3877452",
                    "self": "https://zenodo.org/api/records/3877452"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Hall, Jason P. W."
                        },
                        {
                            "name": "Ahrenholz, David H."
                        }
                    ],
                    "description": "<p>Supplementary materials accompanying an article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3877452",
                    "journal": {
                        "issue": "1",
                        "pages": "52-55",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-06-19",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3877451",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3877452"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3877451"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Supplementary Materials for Hall, J. P. W., Ahrenholz, D. A. 2020. A new mimetic species of Periplacis (Lepidoptera: Riodinidae: Nymphidiini) from the eastern Andes of Ecuador. Tropical Lepidoptera Research 30(1): 52-55."
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 8,
                    "unique_downloads": 8,
                    "unique_views": 16,
                    "version_downloads": 8,
                    "version_unique_downloads": 8,
                    "version_unique_views": 16,
                    "version_views": 16,
                    "version_volume": 1930992,
                    "views": 16,
                    "volume": 1930992
                },
                "updated": "2020-06-19T22:18:22.673293+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3877486",
                "conceptrecid": "3877486",
                "created": "2020-06-19T14:15:16.597131+00:00",
                "doi": "10.5281/zenodo.3877487",
                "files": [
                    {
                        "bucket": "3a9d754d-ac01-4fb3-bf94-561f110c1fef",
                        "checksum": "md5:3f0c1a647caf0b5eb8b662229b0878aa",
                        "key": "TropLepRes30-1_Hall_Periplacis.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/3a9d754d-ac01-4fb3-bf94-561f110c1fef/TropLepRes30-1_Hall_Periplacis.pdf"
                        },
                        "size": 1344577,
                        "type": "pdf"
                    }
                ],
                "id": 3877487,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3877487.svg",
                    "bucket": "https://zenodo.org/api/files/3a9d754d-ac01-4fb3-bf94-561f110c1fef",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3877486.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3877486",
                    "doi": "https://doi.org/10.5281/zenodo.3877487",
                    "html": "https://zenodo.org/record/3877487",
                    "latest": "https://zenodo.org/api/records/3877487",
                    "latest_html": "https://zenodo.org/record/3877487",
                    "self": "https://zenodo.org/api/records/3877487"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Hall, Jason P. W."
                        },
                        {
                            "name": "Ahrenholz, David H."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3877487",
                    "journal": {
                        "issue": "1",
                        "pages": "52-55",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "cloud forest, mimicry, species description, taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-06-19",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3877486",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3877487"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3877486"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new mimetic species of Periplacis (Lepidoptera: Riodinidae: Nymphidiini) from the eastern Andes of Ecuador"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 11,
                    "unique_downloads": 11,
                    "unique_views": 17,
                    "version_downloads": 11,
                    "version_unique_downloads": 11,
                    "version_unique_views": 17,
                    "version_views": 18,
                    "version_volume": 14790347,
                    "views": 18,
                    "volume": 14790347
                },
                "updated": "2020-06-19T22:18:22.741986+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2647559",
                "conceptrecid": "2647559",
                "created": "2019-05-03T21:40:25.104921+00:00",
                "doi": "10.5281/zenodo.2647560",
                "files": [
                    {
                        "bucket": "26799c87-d656-4e08-a316-cefff2ac8dd5",
                        "checksum": "md5:3dd1d449f6a2757dc5082c24d272edeb",
                        "key": "TropLepRes29-1_StLaurent.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/26799c87-d656-4e08-a316-cefff2ac8dd5/TropLepRes29-1_StLaurent.pdf"
                        },
                        "size": 15244807,
                        "type": "pdf"
                    }
                ],
                "id": 2647560,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2647560.svg",
                    "bucket": "https://zenodo.org/api/files/26799c87-d656-4e08-a316-cefff2ac8dd5",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2647559.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2647559",
                    "doi": "https://doi.org/10.5281/zenodo.2647560",
                    "html": "https://zenodo.org/record/2647560",
                    "latest": "https://zenodo.org/api/records/2647560",
                    "latest_html": "https://zenodo.org/record/2647560",
                    "self": "https://zenodo.org/api/records/2647560"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "University of Florida",
                            "name": "St Laurent, Ryan"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.2647560",
                    "journal": {
                        "issue": "1",
                        "pages": "1-11",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "29"
                    },
                    "keywords": [
                        "Andes Mountains, Costa Rica, Mimallonoidea, Neotropical, Panama, Peru"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2019-05-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2647559",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2647560"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2647559"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Three new species of Psychocampa Grote and Robinson (Mimallonidae, Cicinninae, Psychocampini) and the description of the female of P. kohlli Herbin"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 15,
                    "unique_downloads": 15,
                    "unique_views": 24,
                    "version_downloads": 15,
                    "version_unique_downloads": 15,
                    "version_unique_views": 24,
                    "version_views": 25,
                    "version_volume": 228672105,
                    "views": 25,
                    "volume": 228672105
                },
                "updated": "2020-01-20T15:27:46.890317+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2650481",
                "conceptrecid": "2650481",
                "created": "2019-05-03T21:45:00.295725+00:00",
                "doi": "10.5281/zenodo.2650482",
                "files": [
                    {
                        "bucket": "9fa30a14-86ce-40b9-872e-0647a894f49a",
                        "checksum": "md5:e2f11ec21ac49dc40d278bcd30e4c952",
                        "key": "TropLepRes29-1_Willmott.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/9fa30a14-86ce-40b9-872e-0647a894f49a/TropLepRes29-1_Willmott.pdf"
                        },
                        "size": 11161746,
                        "type": "pdf"
                    }
                ],
                "id": 2650482,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2650482.svg",
                    "bucket": "https://zenodo.org/api/files/9fa30a14-86ce-40b9-872e-0647a894f49a",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2650481.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2650481",
                    "doi": "https://doi.org/10.5281/zenodo.2650482",
                    "html": "https://zenodo.org/record/2650482",
                    "latest": "https://zenodo.org/api/records/2650482",
                    "latest_html": "https://zenodo.org/record/2650482",
                    "self": "https://zenodo.org/api/records/2650482"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL, USA",
                            "name": "Willmott, Keith R."
                        },
                        {
                            "affiliation": "Departamento de Biologia Animal and Museu de Zoologia, Instituto de Biologia, Universidade Estadual de Campinas, Campinas, São Paulo, Brazil",
                            "name": "Marín, Mario A."
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL, USA",
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL, USA",
                            "name": "Pomerantz, Tatiana"
                        },
                        {
                            "affiliation": "Museo de Historia Natural, Universidad Nacional Mayor de San Marcos, Lima, Peru",
                            "name": "Lamas, Gerardo"
                        },
                        {
                            "affiliation": "The Natural History Museum, Cromwell Road, London, United Kingdom",
                            "name": "Huertas, Blanca"
                        },
                        {
                            "affiliation": "Arthropoda Department, Zoological Research Museum Alexander Koenig, Germany",
                            "name": "Espeland, Marianne"
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL, USA",
                            "name": "Xiao, Lei"
                        },
                        {
                            "affiliation": "Department of Entomology, National Museum of Natural History, Smithsonian Institution, Washington, DC, USA",
                            "name": "Hall, Jason P. W."
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL, USA",
                            "name": "Robinson Willmott, James I."
                        },
                        {
                            "affiliation": "Departamento de Biologia Animal and Museu de Zoologia, Instituto de Biologia, Universidade Estadual de Campinas, Campinas, São Paulo, Brazil",
                            "name": "Freitas, André V. L."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.2650482",
                    "journal": {
                        "issue": "1",
                        "pages": "29-45",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "29"
                    },
                    "keywords": [
                        "Andes, Chusquea, immature stages, inventory, mimicry, species description, taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2019-05-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2650481",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2650482"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2650481"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A revision of the new Andean butterfly genus Optimandes Marín, Nakahara & Willmott, n. gen., with the description of a new species (Nymphalidae: Satyrinae: Euptychiina)"
                },
                "owners": [
                    36485
                ],
                "revision": 5,
                "stats": {
                    "downloads": 31,
                    "unique_downloads": 30,
                    "unique_views": 49,
                    "version_downloads": 31,
                    "version_unique_downloads": 30,
                    "version_unique_views": 49,
                    "version_views": 56,
                    "version_volume": 346014126,
                    "views": 56,
                    "volume": 346014126
                },
                "updated": "2020-01-20T12:52:32.928253+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2650361",
                "conceptrecid": "2650361",
                "created": "2019-05-03T21:43:02.867404+00:00",
                "doi": "10.5281/zenodo.2650362",
                "files": [
                    {
                        "bucket": "3aabd26f-57e2-4281-87dc-b19f29a6878b",
                        "checksum": "md5:c0b453f620d65c966f53e13eb304bb0d",
                        "key": "TropLepRes29-1_Torres.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/3aabd26f-57e2-4281-87dc-b19f29a6878b/TropLepRes29-1_Torres.pdf"
                        },
                        "size": 8431546,
                        "type": "pdf"
                    }
                ],
                "id": 2650362,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2650362.svg",
                    "bucket": "https://zenodo.org/api/files/3aabd26f-57e2-4281-87dc-b19f29a6878b",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2650361.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2650361",
                    "doi": "https://doi.org/10.5281/zenodo.2650362",
                    "html": "https://zenodo.org/record/2650362",
                    "latest": "https://zenodo.org/api/records/2650362",
                    "latest_html": "https://zenodo.org/record/2650362",
                    "self": "https://zenodo.org/api/records/2650362"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Department of Biological Sciences, University of the Pacific, Stockton, CA 95211, USA",
                            "name": "Torres, Karina P."
                        },
                        {
                            "affiliation": "Escuela de Ciencias Biológicas, Pontificia Universidad Católica del Ecuador, Pichincha, Quito, Ecuador",
                            "name": "Artieda, Nathalia"
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL, USA",
                            "name": "Salazar, Patricio"
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL, USA",
                            "name": "Willmott, Keith R."
                        },
                        {
                            "affiliation": "Department of Biological Sciences, University of the Pacific, Stockton, CA 95211, USA",
                            "name": "Hill, Ryan I."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.2650362",
                    "journal": {
                        "issue": "1",
                        "pages": "19-28",
                        "title": "Tropical Lepidoptera Research.",
                        "volume": "29"
                    },
                    "keywords": [
                        "Icacinaceae, Rubiaceae, mimicry, insect-plant interactions, mimetismo, interacciones insecto-planta"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2019-05-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2650361",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2650362"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2650361"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Life history descriptions of Adelpha attica attica, Adelpha epione agilla, and Adelpha jordani from an eastern Ecuador lowland forest"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 11,
                    "unique_downloads": 11,
                    "unique_views": 17,
                    "version_downloads": 11,
                    "version_unique_downloads": 11,
                    "version_unique_views": 17,
                    "version_views": 17,
                    "version_volume": 92747006,
                    "views": 17,
                    "volume": 92747006
                },
                "updated": "2020-01-20T14:22:15.761324+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1435814",
                "conceptrecid": "1435814",
                "created": "2018-10-03T14:39:29.731689+00:00",
                "doi": "10.5281/zenodo.1435815",
                "files": [
                    {
                        "bucket": "c5c426b6-0920-429a-9670-4f0e3f122d6b",
                        "checksum": "md5:effa67e5206d36815a2bf188301c2153",
                        "key": "TropLepRes28-2_Losada.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/c5c426b6-0920-429a-9670-4f0e3f122d6b/TropLepRes28-2_Losada.pdf"
                        },
                        "size": 2134353,
                        "type": "pdf"
                    }
                ],
                "id": 1435815,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1435815.svg",
                    "bucket": "https://zenodo.org/api/files/c5c426b6-0920-429a-9670-4f0e3f122d6b",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1435814.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1435814",
                    "doi": "https://doi.org/10.5281/zenodo.1435815",
                    "html": "https://zenodo.org/record/1435815",
                    "latest": "https://zenodo.org/api/records/1435815",
                    "latest_html": "https://zenodo.org/record/1435815",
                    "self": "https://zenodo.org/api/records/1435815"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Department of Entomology, PO Box 37012, NHB Stop 105, Smithsonian Institution, Washington, DC 20013-7012, USA",
                            "name": "Losada,María Eugenia"
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL 32611, USA",
                            "name": "Neild, Andrew F. E."
                        },
                        {
                            "affiliation": "Centro de Ecología, Instituto Venezolano de Investigaciones Científicas, Apartado 20632, Caracas 1020-A. Venezuela",
                            "name": "Viloria, Ángel L."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.1435815",
                    "journal": {
                        "issue": "2",
                        "pages": "54-60",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "Coenonymphina, Colombia, Cyperaceae, Cyperus, early stages, Euptychiina, host plant, life history, life tables, Satyrini, Venezuela"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-10-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1435814",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1435815"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1435814"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "The life cycle of Oressinoma typhla Doubleday, [1849]  (Lepidoptera: Nymphalidae: Satyrinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 27,
                    "unique_downloads": 25,
                    "unique_views": 36,
                    "version_downloads": 27,
                    "version_unique_downloads": 25,
                    "version_unique_views": 36,
                    "version_views": 38,
                    "version_volume": 57627531,
                    "views": 38,
                    "volume": 57627531
                },
                "updated": "2020-01-20T15:06:50.435726+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1248211",
                "conceptrecid": "1248211",
                "created": "2018-05-31T17:58:02.857039+00:00",
                "doi": "10.5281/zenodo.1248212",
                "files": [
                    {
                        "bucket": "64651ddb-fc99-4795-82cb-3fcd08005889",
                        "checksum": "md5:5c8f8402335cb6c2555567d64cac3f4d",
                        "key": "TropLepRes28-1_Sourakov.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/64651ddb-fc99-4795-82cb-3fcd08005889/TropLepRes28-1_Sourakov.pdf"
                        },
                        "size": 1734400,
                        "type": "pdf"
                    }
                ],
                "id": 1248212,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248212.svg",
                    "bucket": "https://zenodo.org/api/files/64651ddb-fc99-4795-82cb-3fcd08005889",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248211.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1248211",
                    "doi": "https://doi.org/10.5281/zenodo.1248212",
                    "html": "https://zenodo.org/record/1248212",
                    "latest": "https://zenodo.org/api/records/1248212",
                    "latest_html": "https://zenodo.org/record/1248212",
                    "self": "https://zenodo.org/api/records/1248212"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL 32611, USA",
                            "name": "Sourakov, Andrei"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.1248212",
                    "journal": {
                        "issue": "1",
                        "pages": "29-31",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-05-31",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1248211",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1248212"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1248211"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: The Emperor\'s new clothes: radical transformation of the wing pattern in Asterocampa clyton caused by heparin"
                },
                "owners": [
                    36485
                ],
                "revision": 6,
                "stats": {
                    "downloads": 31,
                    "unique_downloads": 28,
                    "unique_views": 46,
                    "version_downloads": 31,
                    "version_unique_downloads": 28,
                    "version_unique_views": 46,
                    "version_views": 49,
                    "version_volume": 53766400,
                    "views": 49,
                    "volume": 53766400
                },
                "updated": "2020-01-20T17:38:51.158444+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1421757",
                "conceptrecid": "1421757",
                "created": "2018-10-03T14:41:29.953671+00:00",
                "doi": "10.5281/zenodo.1421758",
                "files": [
                    {
                        "bucket": "2b35b968-ed79-4520-b960-62380fc83870",
                        "checksum": "md5:885185d44d55084480e30f766d1936d8",
                        "key": "TropLepRes28-2_Lewis.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/2b35b968-ed79-4520-b960-62380fc83870/TropLepRes28-2_Lewis.pdf"
                        },
                        "size": 1531982,
                        "type": "pdf"
                    }
                ],
                "id": 1421758,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1421758.svg",
                    "bucket": "https://zenodo.org/api/files/2b35b968-ed79-4520-b960-62380fc83870",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1421757.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1421757",
                    "doi": "https://doi.org/10.5281/zenodo.1421758",
                    "html": "https://zenodo.org/record/1421758",
                    "latest": "https://zenodo.org/api/records/1421758",
                    "latest_html": "https://zenodo.org/record/1421758",
                    "self": "https://zenodo.org/api/records/1421758"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "McGuire Centre for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL, USA",
                            "name": "Lewis, Delano S."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.1421758",
                    "journal": {
                        "issue": "2",
                        "pages": "47-48",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "license": {
                        "id": "CC-BY-SA-4.0"
                    },
                    "publication_date": "2018-10-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1421757",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1421758"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1421757"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Book review: Discovering Jamaican Butterflies and their relationships around the Caribbean, by Thomas Turner and Vaughan Turland (2017)"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 15,
                    "unique_downloads": 14,
                    "unique_views": 28,
                    "version_downloads": 15,
                    "version_unique_downloads": 14,
                    "version_unique_views": 28,
                    "version_views": 29,
                    "version_volume": 22979730,
                    "views": 29,
                    "volume": 22979730
                },
                "updated": "2020-01-20T14:59:59.068328+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1421751",
                "conceptrecid": "1421751",
                "created": "2018-09-28T14:53:10.055923+00:00",
                "doi": "10.5281/zenodo.1421752",
                "files": [
                    {
                        "bucket": "2e091cad-48fa-453b-8ade-7f4dbf51f0f6",
                        "checksum": "md5:b50b5ad43ad1d9d6fe764dc73782f040",
                        "key": "TropLepRes28-2_Turner.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/2e091cad-48fa-453b-8ade-7f4dbf51f0f6/TropLepRes28-2_Turner.pdf"
                        },
                        "size": 225078,
                        "type": "pdf"
                    }
                ],
                "id": 1421752,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1421752.svg",
                    "bucket": "https://zenodo.org/api/files/2e091cad-48fa-453b-8ade-7f4dbf51f0f6",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1421751.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1421751",
                    "doi": "https://doi.org/10.5281/zenodo.1421752",
                    "html": "https://zenodo.org/record/1421752",
                    "latest": "https://zenodo.org/api/records/1421752",
                    "latest_html": "https://zenodo.org/record/1421752",
                    "self": "https://zenodo.org/api/records/1421752"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "12 Kingfishers Cove, Safety Harbor, Florida, 34695",
                            "name": "Turner, Thomas W."
                        },
                        {
                            "affiliation": "Content Property, Santa Cruz, St. Elizabeth, Jamaica",
                            "name": "Turland, Vaughan A."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.1421752",
                    "journal": {
                        "issue": "2",
                        "pages": "46",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "license": {
                        "id": "CC-BY-SA-4.0"
                    },
                    "publication_date": "2018-09-28",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1421751",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1421752"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1421751"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Replacement name for Danaus cleophile jamaicensis Turner & Turland, 2018"
                },
                "owners": [
                    36485
                ],
                "revision": 51,
                "stats": {
                    "downloads": 18,
                    "unique_downloads": 17,
                    "unique_views": 28,
                    "version_downloads": 18,
                    "version_unique_downloads": 17,
                    "version_unique_views": 28,
                    "version_views": 28,
                    "version_volume": 4051404,
                    "views": 28,
                    "volume": 4051404
                },
                "updated": "2020-01-20T15:06:55.007934+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1421759",
                "conceptrecid": "1421759",
                "created": "2018-09-28T15:48:05.950580+00:00",
                "doi": "10.5281/zenodo.1421760",
                "files": [
                    {
                        "bucket": "aa0431e1-821b-42ae-ac62-97dad367f65d",
                        "checksum": "md5:c385ce2295d2abedefa8f63fd1a7be0a",
                        "key": "TropLepRes28-2_See.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/aa0431e1-821b-42ae-ac62-97dad367f65d/TropLepRes28-2_See.pdf"
                        },
                        "size": 5436721,
                        "type": "pdf"
                    }
                ],
                "id": 1421760,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1421760.svg",
                    "bucket": "https://zenodo.org/api/files/aa0431e1-821b-42ae-ac62-97dad367f65d",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1421759.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1421759",
                    "doi": "https://doi.org/10.5281/zenodo.1421760",
                    "html": "https://zenodo.org/record/1421760",
                    "latest": "https://zenodo.org/api/records/1421760",
                    "latest_html": "https://zenodo.org/record/1421760",
                    "self": "https://zenodo.org/api/records/1421760"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Alliance for a Sustainable Amazon, Hanover, MD 21076, USA",
                            "name": "See, Joseph"
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL 32611, USA",
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "affiliation": "Alliance for a Sustainable Amazon, Hanover, MD 21076, USA",
                            "name": "Gallice, Geoffrey"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.1421760",
                    "journal": {
                        "issue": "2",
                        "pages": "49-53",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "Euptychiina, life history, Madre de Dios"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-09-28",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1421759",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1421760"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1421759"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages of Splendeuptychia quadrina (Butler, 1869) (Lepidoptera: Nymphalidae: Satyrinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 50,
                "stats": {
                    "downloads": 14,
                    "unique_downloads": 13,
                    "unique_views": 25,
                    "version_downloads": 14,
                    "version_unique_downloads": 13,
                    "version_unique_views": 25,
                    "version_views": 25,
                    "version_volume": 76114094,
                    "views": 25,
                    "volume": 76114094
                },
                "updated": "2020-01-20T15:06:17.876807+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3764158",
                "conceptrecid": "3764158",
                "created": "2020-05-06T02:53:02.207836+00:00",
                "doi": "10.5281/zenodo.3764159",
                "files": [
                    {
                        "bucket": "6ecba99f-d34e-4c9c-8b3a-1588a835d7be",
                        "checksum": "md5:ef8d0a4d9783f7541ebdd115b5c5360e",
                        "key": "TropLepRes30-1_Galindo.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/6ecba99f-d34e-4c9c-8b3a-1588a835d7be/TropLepRes30-1_Galindo.pdf"
                        },
                        "size": 5087788,
                        "type": "pdf"
                    }
                ],
                "id": 3764159,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3764159.svg",
                    "bucket": "https://zenodo.org/api/files/6ecba99f-d34e-4c9c-8b3a-1588a835d7be",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3764158.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3764158",
                    "doi": "https://doi.org/10.5281/zenodo.3764159",
                    "html": "https://zenodo.org/record/3764159",
                    "latest": "https://zenodo.org/api/records/3764159",
                    "latest_html": "https://zenodo.org/record/3764159",
                    "self": "https://zenodo.org/api/records/3764159"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Galindo, Oscar"
                        },
                        {
                            "name": "Miller, Jacqueline Y."
                        },
                        {
                            "name": "González, Jorge M."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3764159",
                    "journal": {
                        "issue": "1",
                        "pages": "1-3",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Lepidoptera, bionomics, circinata bamboo, Chusquea circinata"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-05-05",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3764158",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3764159"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3764158"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: Courtship behavior and other observations on the biology of Escalantiana estherae (J. Y. Miller) (Castniidae: Castniinae) in Mexico"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 13,
                    "unique_downloads": 11,
                    "unique_views": 13,
                    "version_downloads": 13,
                    "version_unique_downloads": 11,
                    "version_unique_views": 13,
                    "version_views": 13,
                    "version_volume": 66141244,
                    "views": 13,
                    "volume": 66141244
                },
                "updated": "2020-05-09T20:20:28.300380+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1248194",
                "conceptrecid": "1248194",
                "created": "2018-05-31T17:54:04.729675+00:00",
                "doi": "10.5281/zenodo.1248195",
                "files": [
                    {
                        "bucket": "e4056a6a-5334-42dc-8adc-1733dd4ab3c8",
                        "checksum": "md5:fd8f16cef63c09a1c25b0b569047798a",
                        "key": "TropLepRes28-1_Turner.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/e4056a6a-5334-42dc-8adc-1733dd4ab3c8/TropLepRes28-1_Turner.pdf"
                        },
                        "size": 1908539,
                        "type": "pdf"
                    }
                ],
                "id": 1248195,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248195.svg",
                    "bucket": "https://zenodo.org/api/files/e4056a6a-5334-42dc-8adc-1733dd4ab3c8",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248194.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1248194",
                    "doi": "https://doi.org/10.5281/zenodo.1248195",
                    "html": "https://zenodo.org/record/1248195",
                    "latest": "https://zenodo.org/api/records/1248195",
                    "latest_html": "https://zenodo.org/record/1248195",
                    "self": "https://zenodo.org/api/records/1248195"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Research Associate, McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, Gainesville, FL 32611, USA",
                            "name": "Turner, T. W."
                        },
                        {
                            "name": "Turland, V. A."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.1248195",
                    "journal": {
                        "issue": "1",
                        "pages": "9-12",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "Caribbean, Hispaniola, Jamaica, Danainae, subspecies, cleophile"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-05-31",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1248194",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1248195"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1248194"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A newly recognized subspecies of Danaus Kluk; Danaus cleophile jamaicensis (Nymphalidae: Danainae) from Jamaica, West Indies"
                },
                "owners": [
                    36485
                ],
                "revision": 5,
                "stats": {
                    "downloads": 18,
                    "unique_downloads": 17,
                    "unique_views": 20,
                    "version_downloads": 18,
                    "version_unique_downloads": 17,
                    "version_unique_views": 20,
                    "version_views": 22,
                    "version_volume": 34353702,
                    "views": 22,
                    "volume": 34353702
                },
                "updated": "2020-01-20T16:35:35.403954+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1248158",
                "conceptrecid": "1248158",
                "created": "2018-05-31T17:43:49.809217+00:00",
                "doi": "10.5281/zenodo.1248159",
                "files": [
                    {
                        "bucket": "9703e83a-34f4-48ea-a5ee-52f5fa34fbd0",
                        "checksum": "md5:805116f4701400a895cd84482033e595",
                        "key": "TropLepRes28-1_Yoshimoto.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/9703e83a-34f4-48ea-a5ee-52f5fa34fbd0/TropLepRes28-1_Yoshimoto.pdf"
                        },
                        "size": 2598128,
                        "type": "pdf"
                    }
                ],
                "id": 1248159,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248159.svg",
                    "bucket": "https://zenodo.org/api/files/9703e83a-34f4-48ea-a5ee-52f5fa34fbd0",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248158.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1248158",
                    "doi": "https://doi.org/10.5281/zenodo.1248159",
                    "html": "https://zenodo.org/record/1248159",
                    "latest": "https://zenodo.org/api/records/1248159",
                    "latest_html": "https://zenodo.org/record/1248159",
                    "self": "https://zenodo.org/api/records/1248159"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Fundación de Defensa del Medio Ambiente de Baja Verapaz (FUNDEMABV), Salamá, Baja Verapaz, Guatemala",
                            "name": "Yoshimoto, Jiichiro"
                        },
                        {
                            "affiliation": "Museo de Zoología, Departamento de Biología Evolutiva, Facultad de Ciencias, Universidad Nacional Autónoma de México, Apartado Postal 70–399, México 04510 DF, México",
                            "name": "Salinas-Gutiérrez, José Luis"
                        },
                        {
                            "affiliation": "Centro de Estudios Conservacionistas (CECON), Universidad de San Carlos, Avenida La Reforma 0-53, Zona 10, Guatemala City, Guatemala",
                            "name": "Barrios, Mercedes"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.1248159",
                    "journal": {
                        "issue": "1",
                        "pages": "1-8",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "Central America, inventory, Neotropical, phenology, seasonal"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-05-31",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1248158",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1248159"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1248158"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Annotated list of butterflies (Lepidoptera: Papilionoidea) of a Guatemalan dry forest, with two first records for Guatemala"
                },
                "owners": [
                    36485
                ],
                "revision": 5,
                "stats": {
                    "downloads": 15,
                    "unique_downloads": 14,
                    "unique_views": 29,
                    "version_downloads": 15,
                    "version_unique_downloads": 14,
                    "version_unique_views": 30,
                    "version_views": 30,
                    "version_volume": 38971920,
                    "views": 29,
                    "volume": 38971920
                },
                "updated": "2020-01-20T14:56:58.852860+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1248207",
                "conceptrecid": "1248207",
                "created": "2018-05-31T17:56:23.631076+00:00",
                "doi": "10.5281/zenodo.1248208",
                "files": [
                    {
                        "bucket": "7c8b4e2a-6012-4c3a-a618-3eb766410c51",
                        "checksum": "md5:909b1ecb7c5c982e1b5b82d8433e4a17",
                        "key": "TropLepRes28-1_Freitas.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/7c8b4e2a-6012-4c3a-a618-3eb766410c51/TropLepRes28-1_Freitas.pdf"
                        },
                        "size": 3199091,
                        "type": "pdf"
                    }
                ],
                "id": 1248208,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248208.svg",
                    "bucket": "https://zenodo.org/api/files/7c8b4e2a-6012-4c3a-a618-3eb766410c51",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248207.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1248207",
                    "doi": "https://doi.org/10.5281/zenodo.1248208",
                    "html": "https://zenodo.org/record/1248208",
                    "latest": "https://zenodo.org/api/records/1248208",
                    "latest_html": "https://zenodo.org/record/1248208",
                    "self": "https://zenodo.org/api/records/1248208"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Departamento de Biologia Animal and Museu de Zoologia, Instituto de Biologia, Universidade Estadual de Campinas. Caixa postal 6109, 13083-970 Campinas, São Paulo, Brazil",
                            "name": "Freitas, André Victor Lucci"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.1248208",
                    "journal": {
                        "issue": "1",
                        "pages": "25-28",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "Atlantic Forest, Calpodini, Hesperiinae, Marantaceae, Mata Atlântica"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-05-31",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1248207",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1248208"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1248207"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages of the Neotropical skipper Lychnuchoides ozias ozias (Hewitson, 1878) (Lepidoptera: Hesperiidae)"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 31,
                    "unique_downloads": 30,
                    "unique_views": 41,
                    "version_downloads": 31,
                    "version_unique_downloads": 30,
                    "version_unique_views": 41,
                    "version_views": 41,
                    "version_volume": 99171821,
                    "views": 41,
                    "volume": 99171821
                },
                "updated": "2020-01-20T15:07:13.712979+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2211028",
                "conceptrecid": "2211028",
                "created": "2018-12-13T22:11:24.014727+00:00",
                "doi": "10.5281/zenodo.2211029",
                "files": [
                    {
                        "bucket": "2b5f8f7e-9765-4d9f-9ec8-589be8f2ac24",
                        "checksum": "md5:c70267c04a82a3612c30ec6d24883c16",
                        "key": "TropLepRes28-2_Sourakov_BookReview.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/2b5f8f7e-9765-4d9f-9ec8-589be8f2ac24/TropLepRes28-2_Sourakov_BookReview.pdf"
                        },
                        "size": 1095154,
                        "type": "pdf"
                    }
                ],
                "id": 2211029,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2211029.svg",
                    "bucket": "https://zenodo.org/api/files/2b5f8f7e-9765-4d9f-9ec8-589be8f2ac24",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2211028.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2211028",
                    "doi": "https://doi.org/10.5281/zenodo.2211029",
                    "html": "https://zenodo.org/record/2211029",
                    "latest": "https://zenodo.org/api/records/2211029",
                    "latest_html": "https://zenodo.org/record/2211029",
                    "self": "https://zenodo.org/api/records/2211029"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL, USA",
                            "name": "Sourakov, Andrei"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.2211029",
                    "journal": {
                        "issue": "2",
                        "pages": "99",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-12-13",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2211028",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2211029"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2211028"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Book Review: Native Hostplants for Texas Butterflies, a Field Guide, by Jim Weber, Lynne M. Weber, and Ronald H. Wauer (2018)"
                },
                "owners": [
                    36485
                ],
                "revision": 17,
                "stats": {
                    "downloads": 6,
                    "unique_downloads": 6,
                    "unique_views": 18,
                    "version_downloads": 6,
                    "version_unique_downloads": 6,
                    "version_unique_views": 17,
                    "version_views": 17,
                    "version_volume": 6570924,
                    "views": 18,
                    "volume": 6570924
                },
                "updated": "2020-01-20T12:58:41.073062+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2028615",
                "conceptrecid": "2028615",
                "created": "2018-12-13T22:05:01.507809+00:00",
                "doi": "10.5281/zenodo.2028616",
                "files": [
                    {
                        "bucket": "662d89be-e78f-4ecf-8789-571484ad0260",
                        "checksum": "md5:471b3abcecf2a0e04bd380e3f1b7fb1b",
                        "key": "TropLepRes28-2_Nunez.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/662d89be-e78f-4ecf-8789-571484ad0260/TropLepRes28-2_Nunez.pdf"
                        },
                        "size": 7945967,
                        "type": "pdf"
                    }
                ],
                "id": 2028616,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2028616.svg",
                    "bucket": "https://zenodo.org/api/files/662d89be-e78f-4ecf-8789-571484ad0260",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2028615.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2028615",
                    "doi": "https://doi.org/10.5281/zenodo.2028616",
                    "html": "https://zenodo.org/record/2028616",
                    "latest": "https://zenodo.org/api/records/2028616",
                    "latest_html": "https://zenodo.org/record/2028616",
                    "self": "https://zenodo.org/api/records/2028616"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Colección de Lepidoptera, Laboratorio Barcode, Museo Argentino de Ciencias Naturales \"Bernardino Rivadavia\" (MACN), Av. Angel Gallardo 470 (1405), Ciudad Autónoma de Buenos Aires, Argentina",
                            "name": "Núñez Bustos, Ezequiel"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.2028616",
                    "journal": {
                        "issue": "2",
                        "pages": "90-95",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "Sarmientoia, gregarismo estacional, hábitos nocturnos, distribución, Argentina, Bolivia, seasonal gregariousness, nocturnal habits, distribution"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-12-13",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2028615",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2028616"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2028615"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Observaciones sobre hábitos nocturnos en tres especies de Sarmientoia Berg (Lepidoptera: Hesperiidae: Eudaminae) de Argentina y Bolivia"
                },
                "owners": [
                    36485
                ],
                "revision": 16,
                "stats": {
                    "downloads": 16,
                    "unique_downloads": 16,
                    "unique_views": 28,
                    "version_downloads": 16,
                    "version_unique_downloads": 16,
                    "version_unique_views": 28,
                    "version_views": 28,
                    "version_volume": 127135472,
                    "views": 28,
                    "volume": 127135472
                },
                "updated": "2020-01-20T12:58:42.162480+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2027708",
                "conceptrecid": "2027708",
                "created": "2018-12-13T22:10:00.914726+00:00",
                "doi": "10.5281/zenodo.2027709",
                "files": [
                    {
                        "bucket": "7fec9c9b-bfd5-4ede-b3f2-bbb22f929e82",
                        "checksum": "md5:fd99fb004f8d3fd506e5796445306a9b",
                        "key": "TropLepRes28-2_Sondhi.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/7fec9c9b-bfd5-4ede-b3f2-bbb22f929e82/TropLepRes28-2_Sondhi.pdf"
                        },
                        "size": 19982291,
                        "type": "pdf"
                    }
                ],
                "id": 2027709,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2027709.svg",
                    "bucket": "https://zenodo.org/api/files/7fec9c9b-bfd5-4ede-b3f2-bbb22f929e82",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2027708.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2027708",
                    "doi": "https://doi.org/10.5281/zenodo.2027709",
                    "html": "https://zenodo.org/record/2027709",
                    "latest": "https://zenodo.org/api/records/2027709",
                    "latest_html": "https://zenodo.org/record/2027709",
                    "self": "https://zenodo.org/api/records/2027709"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Department of Biological Sciences, Florida International University, 11200 SW 8th St, Miami, FL 33199, USA",
                            "name": "Sondhi, Yash"
                        },
                        {
                            "affiliation": "Titli Trust, 49 Rajpur Road Enclave, Dhoran Khas, near IT Park, P.O. Gujrada, Dehradun 248001 Uttarakhand, India",
                            "name": "Sondhi, Sanjay"
                        },
                        {
                            "affiliation": "Division of Entomology, Indian Agricultural Research Institute, New Delhi 110012, India",
                            "name": "Pathour, Shashank Rajendra"
                        },
                        {
                            "affiliation": "Indian Foundation of Butterflies, C-703, Alpine Pyramid, Rajiv Gandhi Nagar, Bengaluru 560097, Karnataka, India",
                            "name": "Kunte, Krushnamegh"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.2027709",
                    "journal": {
                        "issue": "2",
                        "pages": "66-89",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "biodiversity assessment, biodiversity hotspots, Asian moths, range extensions, Western Ghats"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-12-13",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2027708",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2027709"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2027708"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Moth diversity (Lepidoptera: Heterocera) of Shendurney and Ponmudi in Agastyamalai Biosphere Reserve, Kerala, India, with notes on new records"
                },
                "owners": [
                    36485
                ],
                "revision": 16,
                "stats": {
                    "downloads": 47,
                    "unique_downloads": 41,
                    "unique_views": 90,
                    "version_downloads": 47,
                    "version_unique_downloads": 41,
                    "version_unique_views": 90,
                    "version_views": 97,
                    "version_volume": 939167677,
                    "views": 97,
                    "volume": 939167677
                },
                "updated": "2020-01-20T14:02:17.820144+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2027608",
                "conceptrecid": "2027608",
                "created": "2018-12-13T22:07:48.295444+00:00",
                "doi": "10.5281/zenodo.2027609",
                "files": [
                    {
                        "bucket": "192a8a66-1dc9-4f9c-8f75-9ce9c8efe8b2",
                        "checksum": "md5:50b1a70c5a7346b5013133bef9cad201",
                        "key": "TropLepRes28-2_Razowski.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/192a8a66-1dc9-4f9c-8f75-9ce9c8efe8b2/TropLepRes28-2_Razowski.pdf"
                        },
                        "size": 1670111,
                        "type": "pdf"
                    }
                ],
                "id": 2027609,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2027609.svg",
                    "bucket": "https://zenodo.org/api/files/192a8a66-1dc9-4f9c-8f75-9ce9c8efe8b2",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2027608.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2027608",
                    "doi": "https://doi.org/10.5281/zenodo.2027609",
                    "html": "https://zenodo.org/record/2027609",
                    "latest": "https://zenodo.org/api/records/2027609",
                    "latest_html": "https://zenodo.org/record/2027609",
                    "self": "https://zenodo.org/api/records/2027609"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Polish Academy of Sciences, Institute of Systematic Zoology, Slawkowska 17, Krakow, Poland",
                            "name": "Razowski, Józef"
                        },
                        {
                            "affiliation": "Department of Entomology, National Museum of Natural History, Smithsonian Institution, Washington, DC 20013-7012, USA",
                            "name": "Brown, John"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.2027609",
                    "journal": {
                        "issue": "2",
                        "pages": "61-65",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "Brazil, Costa Rica, Dominican Republic, food plant, Guatemala, Mexico, Neopotamia, Neotropical, Panama, Venezuela"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-12-13",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2027608",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2027609"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2027608"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new genus for Argyroploce streblopa Meyrick, 1936 (Lepidoptera: Tortricidae: Olethreutinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 16,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 12,
                    "unique_views": 32,
                    "version_downloads": 12,
                    "version_unique_downloads": 12,
                    "version_unique_views": 32,
                    "version_views": 33,
                    "version_volume": 20041332,
                    "views": 33,
                    "volume": 20041332
                },
                "updated": "2020-01-20T14:22:55.376722+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2027354",
                "conceptrecid": "2027354",
                "created": "2018-12-13T22:12:28.850557+00:00",
                "doi": "10.5281/zenodo.2027355",
                "files": [
                    {
                        "bucket": "ed27fc3b-6512-47ca-8261-5466e28d744f",
                        "checksum": "md5:8798413dd3ad534e6a0d01c73c96f342",
                        "key": "TropLepRes28-2_Sourakov_ZebraLongwing.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/ed27fc3b-6512-47ca-8261-5466e28d744f/TropLepRes28-2_Sourakov_ZebraLongwing.pdf"
                        },
                        "size": 2474784,
                        "type": "pdf"
                    }
                ],
                "id": 2027355,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2027355.svg",
                    "bucket": "https://zenodo.org/api/files/ed27fc3b-6512-47ca-8261-5466e28d744f",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2027354.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2027354",
                    "doi": "https://doi.org/10.5281/zenodo.2027355",
                    "html": "https://zenodo.org/record/2027355",
                    "latest": "https://zenodo.org/api/records/2027355",
                    "latest_html": "https://zenodo.org/record/2027355",
                    "self": "https://zenodo.org/api/records/2027355"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florid",
                            "name": "Sourakov, Andrei"
                        },
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florid",
                            "name": "Doll, Cassandra"
                        },
                        {
                            "affiliation": "Department of Entomology, University of Florida",
                            "name": "Maruniak, James"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.2027355",
                    "journal": {
                        "issue": "2",
                        "pages": "96-98",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "aberration, melanism, phenotypic plasticity, variation, wing coloration"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-12-13",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2027354",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2027355"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2027354"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: Baculovirus infection may affect wing color of the Zebra Longwing butterfly"
                },
                "owners": [
                    36485
                ],
                "revision": 16,
                "stats": {
                    "downloads": 17,
                    "unique_downloads": 17,
                    "unique_views": 29,
                    "version_downloads": 17,
                    "version_unique_downloads": 17,
                    "version_unique_views": 29,
                    "version_views": 32,
                    "version_volume": 42071328,
                    "views": 32,
                    "volume": 42071328
                },
                "updated": "2020-01-20T13:38:39.182779+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1040325",
                "conceptrecid": "1040325",
                "created": "2017-11-01T16:32:27.702821+00:00",
                "doi": "10.5281/zenodo.1040326",
                "files": [
                    {
                        "bucket": "813a23f6-500e-4bb0-908d-70cca4a6eed2",
                        "checksum": "md5:515f2e5a7d64ddd335b4a89e8fdb63ac",
                        "key": "LShirai Epityches eupompe cc.srt",
                        "links": {
                            "self": "https://zenodo.org/api/files/813a23f6-500e-4bb0-908d-70cca4a6eed2/LShirai%20Epityches%20eupompe%20cc.srt"
                        },
                        "size": 757,
                        "type": "srt"
                    },
                    {
                        "bucket": "813a23f6-500e-4bb0-908d-70cca4a6eed2",
                        "checksum": "md5:58c290370f52d4968089ee3a532ae4a7",
                        "key": "LShirai Epityches eupompe.mp4",
                        "links": {
                            "self": "https://zenodo.org/api/files/813a23f6-500e-4bb0-908d-70cca4a6eed2/LShirai%20Epityches%20eupompe.mp4"
                        },
                        "size": 217896445,
                        "type": "mp4"
                    }
                ],
                "id": 1040326,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1040326.svg",
                    "bucket": "https://zenodo.org/api/files/813a23f6-500e-4bb0-908d-70cca4a6eed2",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1040325.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1040325",
                    "doi": "https://doi.org/10.5281/zenodo.1040326",
                    "html": "https://zenodo.org/record/1040326",
                    "latest": "https://zenodo.org/api/records/1040326",
                    "latest_html": "https://zenodo.org/record/1040326",
                    "self": "https://zenodo.org/api/records/1040326"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Unicamp, Brazil",
                            "name": "Shirai, L. T."
                        }
                    ],
                    "description": "<p>This is the first time a butterfly aggregation of the ithomiine species <em>Epityches eupompe</em> was observed. It was seen in July 2017 at Intervales State Park, São Paulo state, Brazil in one of the last large remnants of the Atlantic Forest. Intervales is also known for its particularly high richness of birds and receives birdwatchers all year. A short scientific study was conducted - see \"More information\" at the end of the video. Visits to the butterfly aggregation are restricted and must always be followed by a park guide.</p>",
                    "doi": "10.5281/zenodo.1040326",
                    "journal": {
                        "title": "Tropical Lepidoptera Research"
                    },
                    "keywords": [
                        "Ithomiini, aggregation, Intervales, Atlantic Forest, citizen science"
                    ],
                    "language": "por",
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "notes": "A subtitle file is available, and the video can also be found at https://youtu.be/bUO4kpYS2uo",
                    "publication_date": "2017-11-01",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1040325",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1040326"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1040325"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "title": "Video/Audio",
                        "type": "video"
                    },
                    "title": "Epityches eupompe"
                },
                "owners": [
                    37909
                ],
                "revision": 1,
                "stats": {
                    "downloads": 11,
                    "unique_downloads": 8,
                    "unique_views": 24,
                    "version_downloads": 11,
                    "version_unique_downloads": 8,
                    "version_unique_views": 24,
                    "version_views": 24,
                    "version_volume": 1089486767,
                    "views": 24,
                    "volume": 1089486767
                },
                "updated": "2017-11-01T16:32:27.958550+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1092748",
                "conceptrecid": "1092748",
                "created": "2017-12-19T14:28:10.590450+00:00",
                "doi": "10.5281/zenodo.1092749",
                "files": [
                    {
                        "bucket": "7c9fac29-2364-4dbf-8079-3e950a277271",
                        "checksum": "md5:047e5b7ee77e1be7386d499ae50a84bf",
                        "key": "TropLepRes27_suppl1.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/7c9fac29-2364-4dbf-8079-3e950a277271/TropLepRes27_suppl1.pdf"
                        },
                        "size": 3905793,
                        "type": "pdf"
                    }
                ],
                "id": 1092749,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1092749.svg",
                    "bucket": "https://zenodo.org/api/files/7c9fac29-2364-4dbf-8079-3e950a277271",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1092748.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1092748",
                    "doi": "https://doi.org/10.5281/zenodo.1092749",
                    "html": "https://zenodo.org/record/1092749",
                    "latest": "https://zenodo.org/api/records/1092749",
                    "latest_html": "https://zenodo.org/record/1092749",
                    "self": "https://zenodo.org/api/records/1092749"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Departamento de Historia Natural, Museo Nacional de Costa Rica",
                            "name": "Espinoza, Bernardo"
                        },
                        {
                            "affiliation": "Department of Biology, University of Pennsylvania, Philadelphia, PA, USA",
                            "name": "Janzen, Daniel"
                        },
                        {
                            "affiliation": "Department of Biology, University of Pennsylvania, Philadelphia, PA",
                            "name": "Hallwachs, Winnie"
                        }
                    ],
                    "description": "<p>Journal article</p>",
                    "doi": "10.5281/zenodo.1092749",
                    "journal": {
                        "issue": "Supplement 1",
                        "pages": "1-29",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "27"
                    },
                    "keywords": [
                        "Moths, caterpillars, biodiversity inventory"
                    ],
                    "language": "eng",
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-12-19",
                    "related_identifiers": [
                        {
                            "identifier": "urn:lsid:zoobank.org:pub:3DC83269-6BFA-4EE4-82AA-FAC4E955419C",
                            "relation": "isIdenticalTo",
                            "scheme": "lsid"
                        },
                        {
                            "identifier": "10.5281/zenodo.1092748",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1092749"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1092748"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "17 new species hiding in 10 long-named gaudy tropical moths (Lepidoptera: Erebidae, Arctiinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 5,
                "stats": {
                    "downloads": 59,
                    "unique_downloads": 55,
                    "unique_views": 91,
                    "version_downloads": 59,
                    "version_unique_downloads": 55,
                    "version_unique_views": 91,
                    "version_views": 93,
                    "version_volume": 230441787,
                    "views": 93,
                    "volume": 230441787
                },
                "updated": "2020-01-20T17:31:57.207890+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1309676",
                "conceptrecid": "1309676",
                "created": "2018-07-13T14:12:35.219219+00:00",
                "doi": "10.5281/zenodo.1309677",
                "files": [
                    {
                        "bucket": "f762cf1b-24b4-4e9f-afc1-6132556909f6",
                        "checksum": "md5:0dca48443f8d54021cdaaeefb94bdd96",
                        "key": "TropLepRes28-1_Willmott.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/f762cf1b-24b4-4e9f-afc1-6132556909f6/TropLepRes28-1_Willmott.pdf"
                        },
                        "size": 2578959,
                        "type": "pdf"
                    }
                ],
                "id": 1309677,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1309677.svg",
                    "bucket": "https://zenodo.org/api/files/f762cf1b-24b4-4e9f-afc1-6132556909f6",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1309676.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1309676",
                    "doi": "https://doi.org/10.5281/zenodo.1309677",
                    "html": "https://zenodo.org/record/1309677",
                    "latest": "https://zenodo.org/api/records/1309677",
                    "latest_html": "https://zenodo.org/record/1309677",
                    "self": "https://zenodo.org/api/records/1309677"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "University of Florida",
                            "name": "Willmott, Keith"
                        },
                        {
                            "affiliation": "Museo de Historia Natural, Universidad Nacional Mayor de San Marcos",
                            "name": "Lamas, Gerardo"
                        },
                        {
                            "affiliation": "Cambridge, UK",
                            "name": "Radford, James"
                        },
                        {
                            "affiliation": "Universidade Estadual de Campinas",
                            "name": "Marín, Mario"
                        },
                        {
                            "affiliation": "University of Florida",
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "affiliation": "Zoological Research Museum Alexander Koenig",
                            "name": "Espeland, Marianne"
                        },
                        {
                            "affiliation": "University of Florida",
                            "name": "Xiao, Lei"
                        },
                        {
                            "affiliation": "National Museum of Natural History, Smithsonian Institution",
                            "name": "Hall, Jason"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.1309677",
                    "journal": {
                        "issue": "1",
                        "pages": "39-45",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "inventory, Andes, species description, taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-07-13",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1309676",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1309677"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1309676"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A distinctive new species of cloud forest Euptychiina (Lepidoptera: Nymphalidae: Satyrinae) from Ecuador and Peru"
                },
                "owners": [
                    36485
                ],
                "revision": 5,
                "stats": {
                    "downloads": 22,
                    "unique_downloads": 21,
                    "unique_views": 42,
                    "version_downloads": 22,
                    "version_unique_downloads": 21,
                    "version_unique_views": 42,
                    "version_views": 43,
                    "version_volume": 56737098,
                    "views": 43,
                    "volume": 56737098
                },
                "updated": "2020-01-20T13:38:54.605786+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1309643",
                "conceptrecid": "1309643",
                "created": "2018-07-13T14:08:55.545080+00:00",
                "doi": "10.5281/zenodo.1309644",
                "files": [
                    {
                        "bucket": "27f9326a-d1fe-49ef-ad04-e53eabe6724c",
                        "checksum": "md5:ad92eae36291fd2417457309e4c33563",
                        "key": "TropLepRes28-1_Sourakov.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/27f9326a-d1fe-49ef-ad04-e53eabe6724c/TropLepRes28-1_Sourakov.pdf"
                        },
                        "size": 6589181,
                        "type": "pdf"
                    }
                ],
                "id": 1309644,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1309644.svg",
                    "bucket": "https://zenodo.org/api/files/27f9326a-d1fe-49ef-ad04-e53eabe6724c",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1309643.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1309643",
                    "doi": "https://doi.org/10.5281/zenodo.1309644",
                    "html": "https://zenodo.org/record/1309644",
                    "latest": "https://zenodo.org/api/records/1309644",
                    "latest_html": "https://zenodo.org/record/1309644",
                    "self": "https://zenodo.org/api/records/1309644"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "University of Florida",
                            "name": "Sourakov, Andrei"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.1309644",
                    "journal": {
                        "issue": "1",
                        "pages": "35-38",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-07-13",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1309643",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1309644"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1309643"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Mass aggregations of Idia moths (Lepidoptera: Erebidae) inside hollow trees in Florida"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 90,
                    "unique_downloads": 81,
                    "unique_views": 466,
                    "version_downloads": 90,
                    "version_unique_downloads": 81,
                    "version_unique_views": 466,
                    "version_views": 883,
                    "version_volume": 593026290,
                    "views": 883,
                    "volume": 593026290
                },
                "updated": "2020-01-20T15:28:21.886430+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1248213",
                "conceptrecid": "1248213",
                "created": "2018-05-31T17:59:14.878663+00:00",
                "doi": "10.5281/zenodo.1248214",
                "files": [
                    {
                        "bucket": "d964a93f-d0d9-457d-860b-d0db36ef049c",
                        "checksum": "md5:58af5419e21f5972d43965d839e469cd",
                        "key": "TropLepRes28-1_Gaviria.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/d964a93f-d0d9-457d-860b-d0db36ef049c/TropLepRes28-1_Gaviria.pdf"
                        },
                        "size": 2086388,
                        "type": "pdf"
                    }
                ],
                "id": 1248214,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248214.svg",
                    "bucket": "https://zenodo.org/api/files/d964a93f-d0d9-457d-860b-d0db36ef049c",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248213.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1248213",
                    "doi": "https://doi.org/10.5281/zenodo.1248214",
                    "html": "https://zenodo.org/record/1248214",
                    "latest": "https://zenodo.org/api/records/1248214",
                    "latest_html": "https://zenodo.org/record/1248214",
                    "self": "https://zenodo.org/api/records/1248214"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Laboratório de Estudos de Lepidoptera Neotropical, Departamento de Zoologia, Universidade Federal do Paraná, Caixa Postal 19.020, 81.531-980, Curitiba, Paraná, Brazil",
                            "name": "Gaviria, Fabian G."
                        },
                        {
                            "affiliation": "Laboratório de Estudos de Lepidoptera Neotropical, Departamento de Zoologia, Universidade Federal do Paraná, Caixa Postal 19.020, 81.531-980, Curitiba, Paraná, Brazil",
                            "name": "Siewert, Ricardo R."
                        },
                        {
                            "affiliation": "Laboratório de Estudos de Lepidoptera Neotropical, Departamento de Zoologia, Universidade Federal do Paraná, Caixa Postal 19.020, 81.531-980, Curitiba, Paraná, Brazil",
                            "name": "Mielke, Olaf H. H."
                        },
                        {
                            "affiliation": "Laboratório de Estudos de Lepidoptera Neotropical, Departamento de Zoologia, Universidade Federal do Paraná, Caixa Postal 19.020, 81.531-980, Curitiba, Paraná, Brazil",
                            "name": "Casagrande, Mirna M."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.1248214",
                    "journal": {
                        "issue": "1",
                        "pages": "32-34",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "butterfly, Central America, morphology, stigma, skipper"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-05-31",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1248213",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1248214"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1248213"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new species of Psoralis Mabille, 1904 from Panama (Lepidoptera, Hesperiidae, Hesperiinae, Moncini)"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 22,
                    "unique_downloads": 22,
                    "unique_views": 35,
                    "version_downloads": 22,
                    "version_unique_downloads": 22,
                    "version_unique_views": 35,
                    "version_views": 35,
                    "version_volume": 45900536,
                    "views": 35,
                    "volume": 45900536
                },
                "updated": "2020-01-20T14:50:53.527082+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1248203",
                "conceptrecid": "1248203",
                "created": "2018-05-31T17:55:25.579700+00:00",
                "doi": "10.5281/zenodo.1248204",
                "files": [
                    {
                        "bucket": "13a6e181-2ff8-424a-b613-014f575d52b8",
                        "checksum": "md5:a1427d6ef4f8c959ccc88b9c5227f153",
                        "key": "TropLepRes28-1_StLaurent.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/13a6e181-2ff8-424a-b613-014f575d52b8/TropLepRes28-1_StLaurent.pdf"
                        },
                        "size": 5590372,
                        "type": "pdf"
                    }
                ],
                "id": 1248204,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248204.svg",
                    "bucket": "https://zenodo.org/api/files/13a6e181-2ff8-424a-b613-014f575d52b8",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248203.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1248203",
                    "doi": "https://doi.org/10.5281/zenodo.1248204",
                    "html": "https://zenodo.org/record/1248204",
                    "latest": "https://zenodo.org/api/records/1248204",
                    "latest_html": "https://zenodo.org/record/1248204",
                    "self": "https://zenodo.org/api/records/1248204"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, 3215 Hull Road, Gainesville, FL 32611-2710 USA",
                            "name": "St Laurent, Ryan A."
                        },
                        {
                            "affiliation": "Caixa Postal 1206, 84.145-000 Carambeí, Paraná, Brazil",
                            "name": "Mielke, Carlos G. C."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.1248204",
                    "journal": {
                        "issue": "1",
                        "pages": "19-24",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "Andean mountains, Brazilian Atlantic Forest, diurnal, Lacosoma subrufescens comb. n., taxonomy, Trogoptera"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-05-31",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1248203",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1248204"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1248203"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new species of Lacosoma (Lepidoptera, Mimallonoidea, Mimallonidae) from Southern Brazil, and a new combination"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 12,
                    "unique_views": 21,
                    "version_downloads": 12,
                    "version_unique_downloads": 12,
                    "version_unique_views": 21,
                    "version_views": 21,
                    "version_volume": 67084464,
                    "views": 21,
                    "volume": 67084464
                },
                "updated": "2020-01-20T14:41:22.319795+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5290344",
                "conceptrecid": "5290344",
                "created": "2021-08-29T14:13:34.861856+00:00",
                "doi": "10.5281/zenodo.5290345",
                "files": [
                    {
                        "bucket": "92551672-d6da-4e56-a9e9-f0e950c9699d",
                        "checksum": "md5:ba5840629b8e40a4ecd189abc5f65a43",
                        "key": "TropLepRes31-2_Warren-Hesperia.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/92551672-d6da-4e56-a9e9-f0e950c9699d/TropLepRes31-2_Warren-Hesperia.pdf"
                        },
                        "size": 5851829,
                        "type": "pdf"
                    }
                ],
                "id": 5290345,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5290345.svg",
                    "bucket": "https://zenodo.org/api/files/92551672-d6da-4e56-a9e9-f0e950c9699d",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5290344.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5290344",
                    "doi": "https://doi.org/10.5281/zenodo.5290345",
                    "html": "https://zenodo.org/record/5290345",
                    "latest": "https://zenodo.org/api/records/5290345",
                    "latest_html": "https://zenodo.org/record/5290345",
                    "self": "https://zenodo.org/api/records/5290345"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "University of Florida",
                            "name": "Warren, Andrew D."
                        },
                        {
                            "affiliation": "University of Florida",
                            "name": "Gott, Riley J."
                        },
                        {
                            "affiliation": "University of Florida",
                            "name": "McGuire, William W."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.5290345",
                    "journal": {
                        "issue": "2",
                        "pages": "70-79",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Biogeography, butterfly, distribution, Sierra Madre Oriental, skipper"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-08-29",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5290344",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5290345"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5290344"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A review of Hesperia uncas W. H. Edwards, 1863 in Mexico, with the description of a new subspecies (Lepidoptera: Hesperiidae: Hesperiinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 15,
                    "unique_downloads": 15,
                    "unique_views": 18,
                    "version_downloads": 15,
                    "version_unique_downloads": 15,
                    "version_unique_views": 18,
                    "version_views": 18,
                    "version_volume": 87777435,
                    "views": 18,
                    "volume": 87777435
                },
                "updated": "2021-08-30T01:48:30.100619+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4959932",
                "conceptrecid": "4959932",
                "created": "2021-06-18T17:00:17.788407+00:00",
                "doi": "10.5281/zenodo.4959933",
                "files": [
                    {
                        "bucket": "ae97b700-006d-4499-8790-92c539d2a13d",
                        "checksum": "md5:772ca35c06e55094d12918f325b02b11",
                        "key": "TropLepRes31_suppl1.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/ae97b700-006d-4499-8790-92c539d2a13d/TropLepRes31_suppl1.pdf"
                        },
                        "size": 27578998,
                        "type": "pdf"
                    }
                ],
                "id": 4959933,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4959933.svg",
                    "bucket": "https://zenodo.org/api/files/ae97b700-006d-4499-8790-92c539d2a13d",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4959932.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4959932",
                    "doi": "https://doi.org/10.5281/zenodo.4959933",
                    "html": "https://zenodo.org/record/4959933",
                    "latest": "https://zenodo.org/api/records/4959933",
                    "latest_html": "https://zenodo.org/record/4959933",
                    "self": "https://zenodo.org/api/records/4959933"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "González, Jorge M."
                        },
                        {
                            "name": "Terzenbach, Helga"
                        },
                        {
                            "name": "Orellana, Andrés"
                        },
                        {
                            "name": "Neild, Andrew F. E."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4959933",
                    "journal": {
                        "issue": "Supplement 1",
                        "pages": "1-32",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "biodiversity, lepidochromes, lepidochromy, Lepidoptera, Venezuela, wing prints."
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-06-18",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4959932",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4959933"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4959932"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "On the life of Théophile Raymond, his legacy and some of his lepidochromes (butterfly wing transfer prints)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 11,
                    "unique_views": 20,
                    "version_downloads": 12,
                    "version_unique_downloads": 11,
                    "version_unique_views": 20,
                    "version_views": 20,
                    "version_volume": 330947976,
                    "views": 20,
                    "volume": 330947976
                },
                "updated": "2021-06-19T01:48:17.779664+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5776999",
                "conceptrecid": "5776999",
                "created": "2021-12-17T15:35:06.134377+00:00",
                "doi": "10.5281/zenodo.5777000",
                "files": [
                    {
                        "bucket": "36d7cc19-56a5-459e-b29f-7842485fdbe4",
                        "checksum": "md5:7659387b92233325288c11304417d295",
                        "key": "TropLepRes31-3_Ccahuana.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/36d7cc19-56a5-459e-b29f-7842485fdbe4/TropLepRes31-3_Ccahuana.pdf"
                        },
                        "size": 4830016,
                        "type": "pdf"
                    }
                ],
                "id": 5777000,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5777000.svg",
                    "bucket": "https://zenodo.org/api/files/36d7cc19-56a5-459e-b29f-7842485fdbe4",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5776999.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5776999",
                    "doi": "https://doi.org/10.5281/zenodo.5777000",
                    "html": "https://zenodo.org/record/5777000",
                    "latest": "https://zenodo.org/api/records/5777000",
                    "latest_html": "https://zenodo.org/record/5777000",
                    "self": "https://zenodo.org/api/records/5777000"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Ccahuana, Rodrigo"
                        },
                        {
                            "name": "Corahua-Espinoza, Thalia"
                        },
                        {
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "name": "Tejeira, Rafael"
                        },
                        {
                            "name": "Rodríguez-Melgarejo, Maryzender"
                        },
                        {
                            "name": "Gallice, Geoffrey"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5777000",
                    "journal": {
                        "issue": "3",
                        "pages": "158-165",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "ant organs, host plant, Finca Las Piedras, life history, Madre de Dios"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-12-17",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5776999",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5777000"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5776999"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages and new host plant record for Leucochimona hyphea (Cramer, 1776) (Lepidoptera: Riodinidae: Riodininae) in the southern Peruvian Amazon"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 19,
                    "unique_downloads": 19,
                    "unique_views": 35,
                    "version_downloads": 19,
                    "version_unique_downloads": 19,
                    "version_unique_views": 35,
                    "version_views": 38,
                    "version_volume": 91770304,
                    "views": 38,
                    "volume": 91770304
                },
                "updated": "2021-12-18T01:48:38.171667+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5600361",
                "conceptrecid": "5600361",
                "created": "2021-10-29T15:29:05.120217+00:00",
                "doi": "10.5281/zenodo.5600362",
                "files": [
                    {
                        "bucket": "02cab228-9c44-4025-a16e-d8f94dfdd135",
                        "checksum": "md5:410369d5e3912453d56d3b6f5c5b2ffe",
                        "key": "TropLepRes31-2_Warren-Lindra.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/02cab228-9c44-4025-a16e-d8f94dfdd135/TropLepRes31-2_Warren-Lindra.pdf"
                        },
                        "size": 2284355,
                        "type": "pdf"
                    }
                ],
                "id": 5600362,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600362.svg",
                    "bucket": "https://zenodo.org/api/files/02cab228-9c44-4025-a16e-d8f94dfdd135",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600361.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5600361",
                    "doi": "https://doi.org/10.5281/zenodo.5600362",
                    "html": "https://zenodo.org/record/5600362",
                    "latest": "https://zenodo.org/api/records/5600362",
                    "latest_html": "https://zenodo.org/record/5600362",
                    "self": "https://zenodo.org/api/records/5600362"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Warren, Andrew D."
                        },
                        {
                            "name": "Gott, Riley J."
                        },
                        {
                            "name": "Dolibaina, Diego R."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research .</p>",
                    "doi": "10.5281/zenodo.5600362",
                    "journal": {
                        "issue": "2",
                        "pages": "86-89",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Butterfly, distribution, genitalia, morphology, skipper"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-10-29",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5600361",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5600362"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5600361"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new species of Lindra Evans, 1955 from Ecuador (Lepidoptera: Hesperiidae: Hesperiinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 24,
                    "unique_downloads": 23,
                    "unique_views": 39,
                    "version_downloads": 24,
                    "version_unique_downloads": 23,
                    "version_unique_views": 39,
                    "version_views": 44,
                    "version_volume": 54824520,
                    "views": 44,
                    "volume": 54824520
                },
                "updated": "2021-10-30T01:48:47.652797+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5600386",
                "conceptrecid": "5600386",
                "created": "2021-10-29T15:30:39.602394+00:00",
                "doi": "10.5281/zenodo.5600387",
                "files": [
                    {
                        "bucket": "f526a357-2300-44aa-9820-62099fac00d2",
                        "checksum": "md5:219bb6ce11e0ac1a0fc09b6488a25ebb",
                        "key": "TropLepRes31-2_Ccahuana.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/f526a357-2300-44aa-9820-62099fac00d2/TropLepRes31-2_Ccahuana.pdf"
                        },
                        "size": 2826843,
                        "type": "pdf"
                    }
                ],
                "id": 5600387,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600387.svg",
                    "bucket": "https://zenodo.org/api/files/f526a357-2300-44aa-9820-62099fac00d2",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600386.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5600386",
                    "doi": "https://doi.org/10.5281/zenodo.5600387",
                    "html": "https://zenodo.org/record/5600387",
                    "latest": "https://zenodo.org/api/records/5600387",
                    "latest_html": "https://zenodo.org/record/5600387",
                    "self": "https://zenodo.org/api/records/5600387"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Ccahuana, Rodrigo"
                        },
                        {
                            "name": "Tejeira, Rafael"
                        },
                        {
                            "name": "Hurtado, Thalia"
                        },
                        {
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "name": "Rodríguez-Melgarejo, Maryzender"
                        },
                        {
                            "name": "Gott, Riley J."
                        },
                        {
                            "name": "See, Joseph"
                        },
                        {
                            "name": "Gallice, Geoffrey"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research .</p>",
                    "doi": "10.5281/zenodo.5600387",
                    "journal": {
                        "issue": "2",
                        "pages": "90-95",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Finca Las Piedras, life history, lowland rainforest, Madre de Dios, skipp"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-10-29",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5600386",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5600387"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5600386"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages of Ebusus ebusus ebusus (Cramer, 1780) in the Peruvian Amazon (Lepidoptera: Hesperiidae: Hesperiinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 17,
                    "unique_downloads": 16,
                    "unique_views": 20,
                    "version_downloads": 17,
                    "version_unique_downloads": 16,
                    "version_unique_views": 20,
                    "version_views": 23,
                    "version_volume": 48056331,
                    "views": 23,
                    "volume": 48056331
                },
                "updated": "2021-10-30T01:48:57.849592+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5600436",
                "conceptrecid": "5600436",
                "created": "2021-10-29T15:36:06.596342+00:00",
                "doi": "10.5281/zenodo.5600437",
                "files": [
                    {
                        "bucket": "37b61405-24bf-4115-9458-6d24b08b04bb",
                        "checksum": "md5:e61c02f66e1dbdc82ebe3207c600b7bc",
                        "key": "TropLepRes31-2_Baidya.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/37b61405-24bf-4115-9458-6d24b08b04bb/TropLepRes31-2_Baidya.pdf"
                        },
                        "size": 2029174,
                        "type": "pdf"
                    }
                ],
                "id": 5600437,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600437.svg",
                    "bucket": "https://zenodo.org/api/files/37b61405-24bf-4115-9458-6d24b08b04bb",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600436.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5600436",
                    "doi": "https://doi.org/10.5281/zenodo.5600437",
                    "html": "https://zenodo.org/record/5600437",
                    "latest": "https://zenodo.org/api/records/5600437",
                    "latest_html": "https://zenodo.org/record/5600437",
                    "self": "https://zenodo.org/api/records/5600437"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Baidya, Sarika"
                        },
                        {
                            "name": "Roy, Souparno"
                        },
                        {
                            "name": "Roy, Arjan Basu"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5600437",
                    "journal": {
                        "issue": "2",
                        "pages": "124-126",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Aquatic, heterophylly, host plant, iridoid glycoside, Nymphalidae, spiracle"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-10-29",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5600436",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5600437"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5600436"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: A new aquatic host plant of Junonia atlites atlites (Lepidoptera: Nymphalidae) from India"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 11,
                    "unique_views": 15,
                    "version_downloads": 12,
                    "version_unique_downloads": 11,
                    "version_unique_views": 15,
                    "version_views": 18,
                    "version_volume": 24350088,
                    "views": 18,
                    "volume": 24350088
                },
                "updated": "2021-10-30T01:48:51.358135+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5600327",
                "conceptrecid": "5600327",
                "created": "2021-10-29T15:27:15.724186+00:00",
                "doi": "10.5281/zenodo.5600328",
                "files": [
                    {
                        "bucket": "d761242d-2722-4a08-84b1-d42801ff4006",
                        "checksum": "md5:470b345561836e9c66592f38d0fe8499",
                        "key": "TropLepRes31-2_Hernandez.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/d761242d-2722-4a08-84b1-d42801ff4006/TropLepRes31-2_Hernandez.pdf"
                        },
                        "size": 499375,
                        "type": "pdf"
                    }
                ],
                "id": 5600328,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600328.svg",
                    "bucket": "https://zenodo.org/api/files/d761242d-2722-4a08-84b1-d42801ff4006",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600327.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5600327",
                    "doi": "https://doi.org/10.5281/zenodo.5600328",
                    "html": "https://zenodo.org/record/5600328",
                    "latest": "https://zenodo.org/api/records/5600328",
                    "latest_html": "https://zenodo.org/record/5600328",
                    "self": "https://zenodo.org/api/records/5600328"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Hernandez, Jason P."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5600328",
                    "journal": {
                        "issue": "2",
                        "pages": "80-85",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Biodiversity, Coliadinae, Eurema lisa, Greater Antilles, meadow butterflies"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-10-29",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5600327",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5600328"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5600327"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Pyrisitia lisa and its guild in tropical meadows (Pieridae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 13,
                    "unique_downloads": 12,
                    "unique_views": 14,
                    "version_downloads": 13,
                    "version_unique_downloads": 12,
                    "version_unique_views": 14,
                    "version_views": 17,
                    "version_volume": 6491875,
                    "views": 17,
                    "volume": 6491875
                },
                "updated": "2021-10-30T01:48:47.873803+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.6360549",
                "conceptrecid": "6360549",
                "created": "2022-03-18T16:39:43.062813+00:00",
                "doi": "10.5281/zenodo.6360550",
                "files": [
                    {
                        "bucket": "80ac4883-0325-4e8c-914c-bd9bdaf8b426",
                        "checksum": "md5:389ba3cdd0615a12356124265fea687a",
                        "key": "TropLepRes32_1_Braby.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/80ac4883-0325-4e8c-914c-bd9bdaf8b426/TropLepRes32_1_Braby.pdf"
                        },
                        "size": 5774604,
                        "type": "pdf"
                    }
                ],
                "id": 6360550,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.6360550.svg",
                    "bucket": "https://zenodo.org/api/files/80ac4883-0325-4e8c-914c-bd9bdaf8b426",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.6360549.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.6360549",
                    "doi": "https://doi.org/10.5281/zenodo.6360550",
                    "html": "https://zenodo.org/record/6360550",
                    "latest": "https://zenodo.org/api/records/6360550",
                    "latest_html": "https://zenodo.org/record/6360550",
                    "self": "https://zenodo.org/api/records/6360550"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Division of Ecology and Evolution, Research School of Biology, RN Robertson Building, 46 Sullivans Creek Road, The Australian National University, Acton, ACT 2601, Australia",
                            "name": "Braby, Michael F."
                        },
                        {
                            "affiliation": "Australian Museum, 6 College Street, Sydney, NSW 2010, Australia",
                            "name": "Müller, Chris J."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.6360550",
                    "journal": {
                        "issue": "1",
                        "pages": "1-15",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "32"
                    },
                    "keywords": [
                        "Australian zoogeographic region, biosystematics, taxonomy, Theclinae, tropical forest, vicariance biogeography"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2022-03-18",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.6360549",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "6360550"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "6360549"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Pseudogyris gen. nov. (Lepidoptera: Lycaenidae), a new genus for two rare thecline butterflies from New Guinea, including the description of a new species"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 11,
                    "unique_downloads": 11,
                    "unique_views": 29,
                    "version_downloads": 11,
                    "version_unique_downloads": 11,
                    "version_unique_views": 29,
                    "version_views": 32,
                    "version_volume": 63520644,
                    "views": 32,
                    "volume": 63520644
                },
                "updated": "2022-03-19T01:49:25.888232+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.6588535",
                "conceptrecid": "6588535",
                "created": "2022-06-01T21:53:02.132815+00:00",
                "doi": "10.5281/zenodo.6588536",
                "files": [
                    {
                        "bucket": "41d2e152-bd06-4b9d-abae-b7542d4182d2",
                        "checksum": "md5:f66e33fe442b61d60772a777d47a1690",
                        "key": "TropLepRes32_1_Turner.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/41d2e152-bd06-4b9d-abae-b7542d4182d2/TropLepRes32_1_Turner.pdf"
                        },
                        "size": 1987625,
                        "type": "pdf"
                    }
                ],
                "id": 6588536,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.6588536.svg",
                    "bucket": "https://zenodo.org/api/files/41d2e152-bd06-4b9d-abae-b7542d4182d2",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.6588535.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.6588535",
                    "doi": "https://doi.org/10.5281/zenodo.6588536",
                    "html": "https://zenodo.org/record/6588536",
                    "latest": "https://zenodo.org/api/records/6588536",
                    "latest_html": "https://zenodo.org/record/6588536",
                    "self": "https://zenodo.org/api/records/6588536"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Turner, Thomas"
                        },
                        {
                            "name": "Turland, Vaughan A."
                        },
                        {
                            "name": "Haynes-Sutton, Ann M."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.6588536",
                    "journal": {
                        "issue": "1",
                        "pages": "59-62",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "32"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2022-06-01",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.6588535",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "6588536"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "6588535"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: The discovery of a second species of moth-butterfly (Lepidoptera: Hedylidae) in Jamaica, West Indies"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 11,
                    "unique_downloads": 11,
                    "unique_views": 18,
                    "version_downloads": 11,
                    "version_unique_downloads": 11,
                    "version_unique_views": 18,
                    "version_views": 18,
                    "version_volume": 21863875,
                    "views": 18,
                    "volume": 21863875
                },
                "updated": "2022-06-02T01:51:06.317892+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4721603",
                "conceptrecid": "4721603",
                "created": "2021-05-03T16:12:37.927772+00:00",
                "doi": "10.5281/zenodo.4721604",
                "files": [
                    {
                        "bucket": "ada06738-e62b-4b19-86c0-b19664c223a1",
                        "checksum": "md5:9ad6c259c55c0fdc3cdd0404bc8814e4",
                        "key": "TropLepRes31-1_Siewert.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/ada06738-e62b-4b19-86c0-b19664c223a1/TropLepRes31-1_Siewert.pdf"
                        },
                        "size": 1171798,
                        "type": "pdf"
                    }
                ],
                "id": 4721604,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721604.svg",
                    "bucket": "https://zenodo.org/api/files/ada06738-e62b-4b19-86c0-b19664c223a1",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721603.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4721603",
                    "doi": "https://doi.org/10.5281/zenodo.4721604",
                    "html": "https://zenodo.org/record/4721604",
                    "latest": "https://zenodo.org/api/records/4721604",
                    "latest_html": "https://zenodo.org/record/4721604",
                    "self": "https://zenodo.org/api/records/4721604"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Siewert, Ricardo Russo"
                        },
                        {
                            "name": "Mielke, Olaf Hermann Hendrik"
                        },
                        {
                            "name": "Casagrande, Mirna Martins"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4721604",
                    "journal": {
                        "issue": "1",
                        "pages": "7-10",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Butterfly, Eudaminae, Neotropical, skippers, taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-05-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4721603",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4721604"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4721603"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Description of a new species of Telemiades Hübner, [1819] (Lepidoptera: Hesperiidae) from Peru belonging to the \"centrites group\""
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 16,
                    "unique_downloads": 15,
                    "unique_views": 29,
                    "version_downloads": 16,
                    "version_unique_downloads": 15,
                    "version_unique_views": 29,
                    "version_views": 30,
                    "version_volume": 18748768,
                    "views": 30,
                    "volume": 18748768
                },
                "updated": "2021-05-04T01:48:12.032352+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2656747",
                "conceptrecid": "2656747",
                "created": "2019-05-08T17:35:45.273127+00:00",
                "doi": "10.5281/zenodo.2656748",
                "files": [
                    {
                        "bucket": "5f5fe599-49d5-4101-8e93-995451000508",
                        "checksum": "md5:7223b0b5a196c0e928127595fa4e3339",
                        "key": "TropLepRes29-1_Checa.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/5f5fe599-49d5-4101-8e93-995451000508/TropLepRes29-1_Checa.pdf"
                        },
                        "size": 4729288,
                        "type": "pdf"
                    }
                ],
                "id": 2656748,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2656748.svg",
                    "bucket": "https://zenodo.org/api/files/5f5fe599-49d5-4101-8e93-995451000508",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2656747.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2656747",
                    "doi": "https://doi.org/10.5281/zenodo.2656748",
                    "html": "https://zenodo.org/record/2656748",
                    "latest": "https://zenodo.org/api/records/2656748",
                    "latest_html": "https://zenodo.org/record/2656748",
                    "self": "https://zenodo.org/api/records/2656748"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Pontificia Universidad Católica del Ecuador. Museo QCAZ de Invertebrados, Apartado postal 17-01-21-84. Quito, Ecuador",
                            "name": "Checa, María F."
                        },
                        {
                            "affiliation": "Pontificia Universidad Católica del Ecuador. Museo QCAZ de Invertebrados, Apartado postal 17-01-21-84. Quito, Ecuador",
                            "name": "Torres, Karina"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.2656748",
                    "journal": {
                        "issue": "1",
                        "pages": "56-61",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "29"
                    },
                    "keywords": [
                        "dry forest, western Ecuador, Nymphalidae, natural history, Lepidoptera"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2019-05-08",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2656747",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2656748"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2656747"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Notes on the natural history of six nymphalid butterfly species from an Ecuadorian dry forest"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 35,
                    "unique_downloads": 33,
                    "unique_views": 48,
                    "version_downloads": 35,
                    "version_unique_downloads": 33,
                    "version_unique_views": 48,
                    "version_views": 49,
                    "version_volume": 165525080,
                    "views": 49,
                    "volume": 165525080
                },
                "updated": "2020-01-20T15:19:18.583473+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4317532",
                "conceptrecid": "4317532",
                "created": "2020-12-21T19:51:38.434782+00:00",
                "doi": "10.5281/zenodo.4317533",
                "files": [
                    {
                        "bucket": "0b0fb62d-4a39-4af8-b103-04e3a8d391d3",
                        "checksum": "md5:078106085f310fc7f08e8f7bdb2d63a2",
                        "key": "TropLepRes30-2_Arjun.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/0b0fb62d-4a39-4af8-b103-04e3a8d391d3/TropLepRes30-2_Arjun.pdf"
                        },
                        "size": 2018587,
                        "type": "pdf"
                    }
                ],
                "id": 4317533,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317533.svg",
                    "bucket": "https://zenodo.org/api/files/0b0fb62d-4a39-4af8-b103-04e3a8d391d3",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4317532.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4317532",
                    "doi": "https://doi.org/10.5281/zenodo.4317533",
                    "html": "https://zenodo.org/record/4317533",
                    "latest": "https://zenodo.org/api/records/4317533",
                    "latest_html": "https://zenodo.org/record/4317533",
                    "self": "https://zenodo.org/api/records/4317533"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Fraternity for One-Health Research and Conservation Education, Kerala, India",
                            "name": "Arjun, Charambilly Purushothaman"
                        },
                        {
                            "affiliation": "\"Sreyas\", Near S.R.O, Kadirur (P O), Thalassery, Kannur, Kerala, India",
                            "name": "Deepak, Chatoth Kooteri"
                        },
                        {
                            "affiliation": "Malabar Awareness and Rescue Center for Wildlife, Kerala, India/Department of Animal Sciences, School of Biological Sciences, Central University of Kerala, Kasargod, India",
                            "name": "Rajesh, Thazhathe Purakkal"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4317533",
                    "journal": {
                        "issue": "2",
                        "pages": "78-80",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-12-21",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4317532",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4317533"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4317532"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: Unusual aggregation of Macrobrochis gigas (Walker, 1854) in southern India (Lepidoptera, Erebidae, Arctiinae, Lithosiini)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 31,
                    "unique_downloads": 30,
                    "unique_views": 123,
                    "version_downloads": 31,
                    "version_unique_downloads": 30,
                    "version_unique_views": 123,
                    "version_views": 136,
                    "version_volume": 62576197,
                    "views": 136,
                    "volume": 62576197
                },
                "updated": "2020-12-23T00:27:12.627663+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1098238",
                "conceptrecid": "1098238",
                "created": "2017-12-08T14:31:56.641520+00:00",
                "doi": "10.5281/zenodo.1098239",
                "files": [
                    {
                        "bucket": "d4e5ab3a-d054-4ce4-9657-c492ee449b6c",
                        "checksum": "md5:ce791eddde77d3719c23c61411681aba",
                        "key": "2017_Willmott_TLR_Ajohncoulsoni.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/d4e5ab3a-d054-4ce4-9657-c492ee449b6c/2017_Willmott_TLR_Ajohncoulsoni.pdf"
                        },
                        "size": 2040130,
                        "type": "pdf"
                    }
                ],
                "id": 1098239,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1098239.svg",
                    "bucket": "https://zenodo.org/api/files/d4e5ab3a-d054-4ce4-9657-c492ee449b6c",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1098238.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1098238",
                    "doi": "https://doi.org/10.5281/zenodo.1098239",
                    "html": "https://zenodo.org/record/1098239",
                    "latest": "https://zenodo.org/api/records/1098239",
                    "latest_html": "https://zenodo.org/record/1098239",
                    "self": "https://zenodo.org/api/records/1098239"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "University of Florida",
                            "name": "Keith Richard Willmott"
                        },
                        {
                            "affiliation": "Universidad Nacional Mayor de San Marcos",
                            "name": "Lamas, Gerardo"
                        },
                        {
                            "affiliation": "National Museum of Natural History, Smithsonian Institution",
                            "name": "Hall, Jason P. W."
                        }
                    ],
                    "description": "<p>Journal article:</p>\n\n<p>Abstract: We review the taxonomy of Actinote intensa Jordan stat. rest. and describe a new sibling species, Actinote johncoulsoni Willmott, Lamas &amp; Hall, n. sp., from the east Andean slopes of central and southern Ecuador. The species are broadly sympatric, occur in the same sites throughout the more restricted range of the new species, and differ in a number of wing pattern characters, supported by a mean 2% pairwise divergence in their COI DNA barcodes.<br>\nResumen: Revisamos la taxonom&iacute;a de la especie Actinote intensa Jordan stat. rest. y describimos una nueva especie relacionada, Actinote johncoulsoni Willmott, Lamas &amp; Hall, n. sp., de las vertientes orientales de los Andes en el centro y sur del Ecuador. Las especies son simp&aacute;tridas y ocurren en los mismos sitios en el rango m&aacute;s restringido de la especie nueva, y tienen una variedad de caracteres diferentes en el patr&oacute;n del ala, apoyados por una divergencia promedio de 2% en sus codigos de barra del gen COI.</p>",
                    "doi": "10.5281/zenodo.1098239",
                    "journal": {
                        "issue": "1",
                        "pages": "6-15",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "27"
                    },
                    "keywords": [
                        "Acraeini, Andes, cloud forest, cryptic species, DNA barcoding, Peru, wing pattern"
                    ],
                    "license": {
                        "id": "CC-BY-4.0"
                    },
                    "publication_date": "2017-06-30",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1098238",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1098239"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1098238"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Notes on the taxonomy of Actinote intensa Jordan (Lepidoptera:  Nymphalidae: Heliconiinae) and the description of a new sibling species  from eastern Ecuador"
                },
                "owners": [
                    36485
                ],
                "revision": 5,
                "stats": {
                    "downloads": 15,
                    "unique_downloads": 15,
                    "unique_views": 35,
                    "version_downloads": 15,
                    "version_unique_downloads": 15,
                    "version_unique_views": 35,
                    "version_views": 37,
                    "version_volume": 30601950,
                    "views": 37,
                    "volume": 30601950
                },
                "updated": "2020-01-20T13:42:17.731941+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5600440",
                "conceptrecid": "5600440",
                "created": "2021-10-29T15:37:04.857063+00:00",
                "doi": "10.5281/zenodo.5600441",
                "files": [
                    {
                        "bucket": "8969591e-f0fc-4dda-87d6-99caea3ca73c",
                        "checksum": "md5:a44cc3cd57efbfa1169a6335a3023898",
                        "key": "TropLepRes31-2_Freitas.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/8969591e-f0fc-4dda-87d6-99caea3ca73c/TropLepRes31-2_Freitas.pdf"
                        },
                        "size": 5052727,
                        "type": "pdf"
                    }
                ],
                "id": 5600441,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600441.svg",
                    "bucket": "https://zenodo.org/api/files/8969591e-f0fc-4dda-87d6-99caea3ca73c",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600440.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5600440",
                    "doi": "https://doi.org/10.5281/zenodo.5600441",
                    "html": "https://zenodo.org/record/5600441",
                    "latest": "https://zenodo.org/api/records/5600441",
                    "latest_html": "https://zenodo.org/record/5600441",
                    "self": "https://zenodo.org/api/records/5600441"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Freitas, André V. L."
                        },
                        {
                            "name": "Rosa, Augusto H. B."
                        },
                        {
                            "name": "Kaminski, Lucas A."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5600441",
                    "journal": {
                        "issue": "2",
                        "pages": "127-133",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Atlantic Forest, Brazil, Campo de Altitude, Pampa, Satyrinae, Satyrini"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-10-29",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5600440",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5600441"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5600440"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages of Stegosatyrus ocelloides (Nymphalidae: Euptychiina), a grassland specialist butterfly"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 40,
                    "unique_downloads": 39,
                    "unique_views": 66,
                    "version_downloads": 40,
                    "version_unique_downloads": 39,
                    "version_unique_views": 66,
                    "version_views": 70,
                    "version_volume": 202109080,
                    "views": 70,
                    "volume": 202109080
                },
                "updated": "2021-10-30T01:48:52.809661+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3990662",
                "conceptrecid": "3990662",
                "created": "2020-08-24T21:53:28.495331+00:00",
                "doi": "10.5281/zenodo.3990663",
                "files": [
                    {
                        "bucket": "d6bcbaab-dd8a-4fcf-9ec0-750b28723e1d",
                        "checksum": "md5:f6e30654a0ca51bc733fa9c6e6c93954",
                        "key": "TropLepRes30_suppl1_Willmott.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/d6bcbaab-dd8a-4fcf-9ec0-750b28723e1d/TropLepRes30_suppl1_Willmott.pdf"
                        },
                        "size": 23252860,
                        "type": "pdf"
                    }
                ],
                "id": 3990663,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3990663.svg",
                    "bucket": "https://zenodo.org/api/files/d6bcbaab-dd8a-4fcf-9ec0-750b28723e1d",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3990662.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3990662",
                    "doi": "https://doi.org/10.5281/zenodo.3990663",
                    "html": "https://zenodo.org/record/3990663",
                    "latest": "https://zenodo.org/api/records/3990663",
                    "latest_html": "https://zenodo.org/record/3990663",
                    "self": "https://zenodo.org/api/records/3990663"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Willmott, Keith R."
                        },
                        {
                            "name": "Lamas, Gerardo"
                        },
                        {
                            "name": "Hall, Jason P. W."
                        },
                        {
                            "name": "Mota, Luísa L."
                        },
                        {
                            "name": "Kell, Timothy"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.3990663",
                    "journal": {
                        "issue": "Supplement 1",
                        "pages": "1-49",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Andes; Bolivia; cloud forest; collections; Colombia; Ecuador; field work; Neotropics; new species; Peru; taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-08-24",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3990662",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3990663"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3990662"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "The common, the rare, and the lost: Descriptions of twelve new species and three new subspecies of equatorial Ithomiini (Lepidoptera, Nymphalidae, Danainae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 181,
                    "unique_downloads": 170,
                    "unique_views": 265,
                    "version_downloads": 181,
                    "version_unique_downloads": 170,
                    "version_unique_views": 265,
                    "version_views": 281,
                    "version_volume": 4208767660,
                    "views": 281,
                    "volume": 4208767660
                },
                "updated": "2020-08-25T00:59:24.711468+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4721591",
                "conceptrecid": "4721591",
                "created": "2021-05-03T16:07:55.348998+00:00",
                "doi": "10.5281/zenodo.4721592",
                "files": [
                    {
                        "bucket": "ac1fc36d-7ede-4f95-8ba6-938353408f74",
                        "checksum": "md5:e7c08ec2f20824bfc9130cfbae73a986",
                        "key": "TropLepRes31-1_GarciaDiaz.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/ac1fc36d-7ede-4f95-8ba6-938353408f74/TropLepRes31-1_GarciaDiaz.pdf"
                        },
                        "size": 5171974,
                        "type": "pdf"
                    }
                ],
                "id": 4721592,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721592.svg",
                    "bucket": "https://zenodo.org/api/files/ac1fc36d-7ede-4f95-8ba6-938353408f74",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721591.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4721591",
                    "doi": "https://doi.org/10.5281/zenodo.4721592",
                    "html": "https://zenodo.org/record/4721592",
                    "latest": "https://zenodo.org/api/records/4721592",
                    "latest_html": "https://zenodo.org/record/4721592",
                    "self": "https://zenodo.org/api/records/4721592"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "García Díaz, José de Jesús"
                        },
                        {
                            "name": "Turrent Carriles, Alonso"
                        },
                        {
                            "name": "Warren, Andrew D."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4721592",
                    "journal": {
                        "issue": "1",
                        "pages": "1-6",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Distribution, Neotropical, Puebla, Tehuacán-Cuicatlán Valley, xeric shrubland"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-05-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4721591",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4721592"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4721591"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Panoquina luctuosa luctuosa (Herrich-Schäffer, 1869): a new record for Mexico (Lepidoptera: Hesperiidae: Hesperiinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 10,
                    "unique_downloads": 10,
                    "unique_views": 32,
                    "version_downloads": 10,
                    "version_unique_downloads": 10,
                    "version_unique_views": 32,
                    "version_views": 32,
                    "version_volume": 51719740,
                    "views": 32,
                    "volume": 51719740
                },
                "updated": "2021-05-04T01:48:12.508200+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.6588546",
                "conceptrecid": "6588546",
                "created": "2022-06-01T21:54:57.463651+00:00",
                "doi": "10.5281/zenodo.6588547",
                "files": [
                    {
                        "bucket": "23144e05-f659-40ef-b119-30e56b60b8e7",
                        "checksum": "md5:2c4216c00e85b4b4ebff7b6fe4598ba1",
                        "key": "TropLepRes32_1_Garcia.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/23144e05-f659-40ef-b119-30e56b60b8e7/TropLepRes32_1_Garcia.pdf"
                        },
                        "size": 4846303,
                        "type": "pdf"
                    }
                ],
                "id": 6588547,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.6588547.svg",
                    "bucket": "https://zenodo.org/api/files/23144e05-f659-40ef-b119-30e56b60b8e7",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.6588546.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.6588546",
                    "doi": "https://doi.org/10.5281/zenodo.6588547",
                    "html": "https://zenodo.org/record/6588547",
                    "latest": "https://zenodo.org/api/records/6588547",
                    "latest_html": "https://zenodo.org/record/6588547",
                    "self": "https://zenodo.org/api/records/6588547"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "García Díaz, José de Jesús"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.6588547",
                    "journal": {
                        "issue": "1",
                        "pages": "63-72",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "32"
                    },
                    "keywords": [
                        "aspectos bionómicos, biogeografía, distribución, Lepidoptera, México, variabilidad"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2022-06-01",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.6588546",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "6588547"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "6588546"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Distribution and observations on the biology of Telchin atymnius futilis (Walker, 1856) (Castniidae: Castniinae) in Mexico"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 9,
                    "unique_downloads": 9,
                    "unique_views": 8,
                    "version_downloads": 9,
                    "version_unique_downloads": 9,
                    "version_unique_views": 8,
                    "version_views": 9,
                    "version_volume": 43616727,
                    "views": 9,
                    "volume": 43616727
                },
                "updated": "2022-06-02T01:51:06.372940+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4966724",
                "conceptrecid": "4966724",
                "created": "2021-07-02T16:29:23.758066+00:00",
                "doi": "10.5281/zenodo.4966725",
                "files": [
                    {
                        "bucket": "03b223c1-0710-4f63-ac67-df7f2c9509d8",
                        "checksum": "md5:12ec5321524e9abb9d993c01dc4c3737",
                        "key": "TropLepRes31-1_Gallardo-Jonaspyge.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/03b223c1-0710-4f63-ac67-df7f2c9509d8/TropLepRes31-1_Gallardo-Jonaspyge.pdf"
                        },
                        "size": 5487242,
                        "type": "pdf"
                    }
                ],
                "id": 4966725,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4966725.svg",
                    "bucket": "https://zenodo.org/api/files/03b223c1-0710-4f63-ac67-df7f2c9509d8",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4966724.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4966724",
                    "doi": "https://doi.org/10.5281/zenodo.4966725",
                    "html": "https://zenodo.org/record/4966725",
                    "latest": "https://zenodo.org/api/records/4966725",
                    "latest_html": "https://zenodo.org/record/4966725",
                    "self": "https://zenodo.org/api/records/4966725"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Gallardo, Robert J."
                        },
                        {
                            "name": "Grishin, Nick V."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4966725",
                    "journal": {
                        "issue": "1",
                        "pages": "48-52",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "biodiversity, firetip skipper butterflies, genomics, Neotropics, taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-07-02",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4966724",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4966725"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4966724"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Orange fringes, crenulate hindwings and genomic DNA identify a new species of Jonaspyge from Honduras (Hesperiidae: Pyrrhopyginae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 20,
                    "unique_downloads": 19,
                    "unique_views": 55,
                    "version_downloads": 20,
                    "version_unique_downloads": 19,
                    "version_unique_views": 55,
                    "version_views": 59,
                    "version_volume": 109744840,
                    "views": 59,
                    "volume": 109744840
                },
                "updated": "2021-07-03T01:48:27.298674+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4721607",
                "conceptrecid": "4721607",
                "created": "2021-05-03T16:13:43.224265+00:00",
                "doi": "10.5281/zenodo.4721608",
                "files": [
                    {
                        "bucket": "f4563ca4-3005-48e7-8d9b-5dbb7029cf64",
                        "checksum": "md5:32b74ffe04192020ccd3e098d50e6359",
                        "key": "TropLepRes31-1_Warren.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/f4563ca4-3005-48e7-8d9b-5dbb7029cf64/TropLepRes31-1_Warren.pdf"
                        },
                        "size": 5929606,
                        "type": "pdf"
                    }
                ],
                "id": 4721608,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721608.svg",
                    "bucket": "https://zenodo.org/api/files/f4563ca4-3005-48e7-8d9b-5dbb7029cf64",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721607.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4721607",
                    "doi": "https://doi.org/10.5281/zenodo.4721608",
                    "html": "https://zenodo.org/record/4721608",
                    "latest": "https://zenodo.org/api/records/4721608",
                    "latest_html": "https://zenodo.org/record/4721608",
                    "self": "https://zenodo.org/api/records/4721608"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Warren, Andrew D."
                        },
                        {
                            "name": "Gott, Riley J."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4721608",
                    "journal": {
                        "issue": "1",
                        "pages": "11-21",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Biogeography, butterfly, distribution, ecology, morphology, skipper"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-05-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4721607",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4721608"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4721607"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A review of Polites rhesus (W. H. Edwards, 1878), with the description of a new subspecies from Mexico (Lepidoptera: Hesperiidae: Hesperiinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 14,
                    "unique_downloads": 13,
                    "unique_views": 34,
                    "version_downloads": 14,
                    "version_unique_downloads": 13,
                    "version_unique_views": 34,
                    "version_views": 35,
                    "version_volume": 83014484,
                    "views": 35,
                    "volume": 83014484
                },
                "updated": "2021-05-04T01:48:11.932342+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.6588499",
                "conceptrecid": "6588499",
                "created": "2022-06-01T15:00:00.144016+00:00",
                "doi": "10.5281/zenodo.6588500",
                "files": [
                    {
                        "bucket": "7d86c872-963a-46ef-ab28-9c2304dbc4f9",
                        "checksum": "md5:4200471e483f4b46df3bd2093ab5eb5a",
                        "key": "TropLepRes32_1_Renteria.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/7d86c872-963a-46ef-ab28-9c2304dbc4f9/TropLepRes32_1_Renteria.pdf"
                        },
                        "size": 2277552,
                        "type": "pdf"
                    }
                ],
                "id": 6588500,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.6588500.svg",
                    "bucket": "https://zenodo.org/api/files/7d86c872-963a-46ef-ab28-9c2304dbc4f9",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.6588499.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.6588499",
                    "doi": "https://doi.org/10.5281/zenodo.6588500",
                    "html": "https://zenodo.org/record/6588500",
                    "latest": "https://zenodo.org/api/records/6588500",
                    "latest_html": "https://zenodo.org/record/6588500",
                    "self": "https://zenodo.org/api/records/6588500"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Rentería, Janeth"
                        },
                        {
                            "name": "Despland, Emma"
                        },
                        {
                            "name": "Checa, María Fernanda"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.6588500",
                    "journal": {
                        "issue": "1",
                        "pages": "32-37",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "32"
                    },
                    "keywords": [
                        "Aggregation, aposematism, feeding facilitation, gregarious behavior"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2022-06-01",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.6588499",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "6588500"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "6588499"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Grouping as a strategy to mitigate top-down and bottom-up pressures for survival and growth in Methona confusa (Butler, 1873) (Nymphalidae, Ithomiini)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 9,
                    "unique_downloads": 9,
                    "unique_views": 11,
                    "version_downloads": 9,
                    "version_unique_downloads": 9,
                    "version_unique_views": 11,
                    "version_views": 11,
                    "version_volume": 20497968,
                    "views": 11,
                    "volume": 20497968
                },
                "updated": "2022-06-02T01:50:51.496204+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5776878",
                "conceptrecid": "5776878",
                "created": "2021-12-17T15:32:05.346576+00:00",
                "doi": "10.5281/zenodo.5776879",
                "files": [
                    {
                        "bucket": "48fef695-3316-4f3f-899c-e08531c39ec7",
                        "checksum": "md5:5419af43c6fc395e8739535a899c7a42",
                        "key": "TropLepRes31-3_Nakahara-Yphthimoides.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/48fef695-3316-4f3f-899c-e08531c39ec7/TropLepRes31-3_Nakahara-Yphthimoides.pdf"
                        },
                        "size": 3482935,
                        "type": "pdf"
                    }
                ],
                "id": 5776879,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5776879.svg",
                    "bucket": "https://zenodo.org/api/files/48fef695-3316-4f3f-899c-e08531c39ec7",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5776878.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5776878",
                    "doi": "https://doi.org/10.5281/zenodo.5776879",
                    "html": "https://zenodo.org/record/5776879",
                    "latest": "https://zenodo.org/api/records/5776879",
                    "latest_html": "https://zenodo.org/record/5776879",
                    "self": "https://zenodo.org/api/records/5776879"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "name": "Barbosa, Eduardo P."
                        },
                        {
                            "name": "Nakamura, Ichiro"
                        },
                        {
                            "name": "Lamas, Gerardo"
                        },
                        {
                            "name": "Freitas, André V. L."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5776879",
                    "journal": {
                        "issue": "3",
                        "pages": "138-144",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Cosñipata valley, Cuzco, Euptychiina, taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-12-17",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5776878",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5776879"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5776878"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Description of a new species of Yphthimoides Forster, 1964 from Peru (Lepidoptera: Nymphalidae: Satyrinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 62,
                    "unique_downloads": 61,
                    "unique_views": 93,
                    "version_downloads": 62,
                    "version_unique_downloads": 61,
                    "version_unique_views": 93,
                    "version_views": 96,
                    "version_volume": 215941970,
                    "views": 96,
                    "volume": 215941970
                },
                "updated": "2021-12-18T01:48:40.477814+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4721636",
                "conceptrecid": "4721636",
                "created": "2021-05-03T16:06:17.211673+00:00",
                "doi": "10.5281/zenodo.4721637",
                "files": [
                    {
                        "bucket": "74e40f0e-c8f8-481c-8982-bfe0699fccd8",
                        "checksum": "md5:39c550279e398ace4459d340c5f70249",
                        "key": "TropLepRes31-1_Freitas.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/74e40f0e-c8f8-481c-8982-bfe0699fccd8/TropLepRes31-1_Freitas.pdf"
                        },
                        "size": 3134303,
                        "type": "pdf"
                    }
                ],
                "id": 4721637,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721637.svg",
                    "bucket": "https://zenodo.org/api/files/74e40f0e-c8f8-481c-8982-bfe0699fccd8",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721636.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4721636",
                    "doi": "https://doi.org/10.5281/zenodo.4721637",
                    "html": "https://zenodo.org/record/4721637",
                    "latest": "https://zenodo.org/api/records/4721637",
                    "latest_html": "https://zenodo.org/record/4721637",
                    "self": "https://zenodo.org/api/records/4721637"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Freitas, André Victor Lucci"
                        },
                        {
                            "name": "Barbosa, Eduardo Proença"
                        },
                        {
                            "name": "Carreira,Junia Yasmin Oliveira"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4721637",
                    "journal": {
                        "issue": "1",
                        "pages": "42-47",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Atlantic Forest, life cycle, Satyrinae, Satyrini"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-05-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4721636",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4721637"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4721636"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages and natural history of Yphthimoides borasta (Nymphalidae: Euptychiina)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 21,
                    "unique_downloads": 21,
                    "unique_views": 29,
                    "version_downloads": 21,
                    "version_unique_downloads": 21,
                    "version_unique_views": 29,
                    "version_views": 31,
                    "version_volume": 65820363,
                    "views": 31,
                    "volume": 65820363
                },
                "updated": "2021-05-04T01:48:12.522552+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5777168",
                "conceptrecid": "5777168",
                "created": "2021-12-17T15:36:24.071984+00:00",
                "doi": "10.5281/zenodo.5777169",
                "files": [
                    {
                        "bucket": "c9f5344f-ee20-4d5b-a9cb-503c68673adf",
                        "checksum": "md5:6c5ed8111f1587831b34b5fa28cfa071",
                        "key": "TropLepRes31-3_Hurtado.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/c9f5344f-ee20-4d5b-a9cb-503c68673adf/TropLepRes31-3_Hurtado.pdf"
                        },
                        "size": 4294125,
                        "type": "pdf"
                    }
                ],
                "id": 5777169,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5777169.svg",
                    "bucket": "https://zenodo.org/api/files/c9f5344f-ee20-4d5b-a9cb-503c68673adf",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5777168.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5777168",
                    "doi": "https://doi.org/10.5281/zenodo.5777169",
                    "html": "https://zenodo.org/record/5777169",
                    "latest": "https://zenodo.org/api/records/5777169",
                    "latest_html": "https://zenodo.org/record/5777169",
                    "self": "https://zenodo.org/api/records/5777169"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Hurtado, Thalia"
                        },
                        {
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "name": "Rodríguez-Melgarejo, Maryzender"
                        },
                        {
                            "name": "Tejeira, Rafael"
                        },
                        {
                            "name": "See, Joseph"
                        },
                        {
                            "name": "Ccahuana, Rodrigo"
                        },
                        {
                            "name": "Gallice, Geoffrey"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5777169",
                    "journal": {
                        "issue": "3",
                        "pages": "179-185",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Euptychiina, hostplant, immature stages, natural history, Poaceae"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-12-17",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5777168",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5777169"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5777168"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Complete immature stages of the euptychiine butterfly Taygetis cleopatra (C. Felder & R. Felder, 1862) (Lepidoptera: Nymphalidae: Satyrinae) in southeastern Peru"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 19,
                    "unique_downloads": 19,
                    "unique_views": 40,
                    "version_downloads": 19,
                    "version_unique_downloads": 19,
                    "version_unique_views": 40,
                    "version_views": 45,
                    "version_volume": 81588375,
                    "views": 45,
                    "volume": 81588375
                },
                "updated": "2021-12-18T01:48:37.563563+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5600415",
                "conceptrecid": "5600415",
                "created": "2021-10-29T15:33:17.268681+00:00",
                "doi": "10.5281/zenodo.5600416",
                "files": [
                    {
                        "bucket": "bd35dde0-1b8a-4f5f-8e08-797224c2242b",
                        "checksum": "md5:7a68d9bcb7256fc6e940fb45faa8356a",
                        "key": "TropLepRes31-2_Warren-Piruna.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/bd35dde0-1b8a-4f5f-8e08-797224c2242b/TropLepRes31-2_Warren-Piruna.pdf"
                        },
                        "size": 12256598,
                        "type": "pdf"
                    }
                ],
                "id": 5600416,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600416.svg",
                    "bucket": "https://zenodo.org/api/files/bd35dde0-1b8a-4f5f-8e08-797224c2242b",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600415.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5600415",
                    "doi": "https://doi.org/10.5281/zenodo.5600416",
                    "html": "https://zenodo.org/record/5600416",
                    "latest": "https://zenodo.org/api/records/5600416",
                    "latest_html": "https://zenodo.org/record/5600416",
                    "self": "https://zenodo.org/api/records/5600416"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Warren, Andrew D."
                        },
                        {
                            "name": "Gott, Riley J."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5600416",
                    "journal": {
                        "issue": "2",
                        "pages": "101-117",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Biogeography, butterfly, distribution, ecology, morphology, skipper."
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-10-29",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5600415",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5600416"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5600415"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Four new species of Piruna Evans, 1955 from western Mexico (Lepidoptera: Hesperiidae: Heteropterinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 19,
                    "unique_downloads": 18,
                    "unique_views": 55,
                    "version_downloads": 19,
                    "version_unique_downloads": 18,
                    "version_unique_views": 55,
                    "version_views": 60,
                    "version_volume": 232875362,
                    "views": 60,
                    "volume": 232875362
                },
                "updated": "2021-10-30T01:48:47.478710+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5776917",
                "conceptrecid": "5776917",
                "created": "2021-12-17T15:33:33.391305+00:00",
                "doi": "10.5281/zenodo.5776918",
                "files": [
                    {
                        "bucket": "098e2f06-6990-4669-afb0-ce0b13ecf579",
                        "checksum": "md5:306de693b183983bf18e4b09c7af3254",
                        "key": "TropLepRes31-3_Nakahara-Chloreuptychia.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/098e2f06-6990-4669-afb0-ce0b13ecf579/TropLepRes31-3_Nakahara-Chloreuptychia.pdf"
                        },
                        "size": 4879732,
                        "type": "pdf"
                    }
                ],
                "id": 5776918,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5776918.svg",
                    "bucket": "https://zenodo.org/api/files/098e2f06-6990-4669-afb0-ce0b13ecf579",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5776917.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5776917",
                    "doi": "https://doi.org/10.5281/zenodo.5776918",
                    "html": "https://zenodo.org/record/5776918",
                    "latest": "https://zenodo.org/api/records/5776918",
                    "latest_html": "https://zenodo.org/record/5776918",
                    "self": "https://zenodo.org/api/records/5776918"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "name": "Willmott, Keith R."
                        },
                        {
                            "name": "MacDonald, John R."
                        },
                        {
                            "name": "Thurman, Albert"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5776918",
                    "journal": {
                        "issue": "3",
                        "pages": "145-150",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Euptychiina, Gordon B. Small, taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-12-17",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5776917",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5776918"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5776917"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Description of an enigmatic new species of Chloreuptychia Forster, 1964 from Panama (Lepidoptera: Nymphalidae: Satyrinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 14,
                    "unique_downloads": 14,
                    "unique_views": 37,
                    "version_downloads": 14,
                    "version_unique_downloads": 14,
                    "version_unique_views": 37,
                    "version_views": 42,
                    "version_volume": 68316248,
                    "views": 42,
                    "volume": 68316248
                },
                "updated": "2021-12-18T01:48:38.077250+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4721618",
                "conceptrecid": "4721618",
                "created": "2021-05-03T16:05:06.622325+00:00",
                "doi": "10.5281/zenodo.4721619",
                "files": [
                    {
                        "bucket": "7c25aaf2-910b-43bc-8f51-bee0c8895213",
                        "checksum": "md5:c9c0628ea9e6316d35d7f01f200ea5c8",
                        "key": "TropLepRes31-1_Badon.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/7c25aaf2-910b-43bc-8f51-bee0c8895213/TropLepRes31-1_Badon.pdf"
                        },
                        "size": 1998340,
                        "type": "pdf"
                    }
                ],
                "id": 4721619,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721619.svg",
                    "bucket": "https://zenodo.org/api/files/7c25aaf2-910b-43bc-8f51-bee0c8895213",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721618.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4721618",
                    "doi": "https://doi.org/10.5281/zenodo.4721619",
                    "html": "https://zenodo.org/record/4721619",
                    "latest": "https://zenodo.org/api/records/4721619",
                    "latest_html": "https://zenodo.org/record/4721619",
                    "self": "https://zenodo.org/api/records/4721619"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Badon, Jade Aster T."
                        },
                        {
                            "name": "Wolfe, Keith V."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4721619",
                    "journal": {
                        "issue": "1",
                        "pages": "32-34",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "immature stages, larva, Oriental, ovum, pupa, Rubiaceae, Uncaria"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-05-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4721618",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4721619"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4721618"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "The biology and life history of Athyma gutama canlaonensis Okano & Okano, 1986 (Lepidoptera: Nymphalidae: Limenitidinae) from Negros island, Philippines"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 25,
                    "unique_downloads": 24,
                    "unique_views": 35,
                    "version_downloads": 25,
                    "version_unique_downloads": 24,
                    "version_unique_views": 35,
                    "version_views": 38,
                    "version_volume": 49958500,
                    "views": 38,
                    "volume": 49958500
                },
                "updated": "2021-05-04T01:48:11.991763+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5776932",
                "conceptrecid": "5776932",
                "created": "2021-12-17T15:34:34.624098+00:00",
                "doi": "10.5281/zenodo.5776933",
                "files": [
                    {
                        "bucket": "c04dfd9f-f727-4232-a822-018a8adcc00a",
                        "checksum": "md5:36246120f242a81e9f010b83f5a1cc1a",
                        "key": "TropLepRes31-3_Moore.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/c04dfd9f-f727-4232-a822-018a8adcc00a/TropLepRes31-3_Moore.pdf"
                        },
                        "size": 1960469,
                        "type": "pdf"
                    }
                ],
                "id": 5776933,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5776933.svg",
                    "bucket": "https://zenodo.org/api/files/c04dfd9f-f727-4232-a822-018a8adcc00a",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5776932.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5776932",
                    "doi": "https://doi.org/10.5281/zenodo.5776933",
                    "html": "https://zenodo.org/record/5776933",
                    "latest": "https://zenodo.org/api/records/5776933",
                    "latest_html": "https://zenodo.org/record/5776933",
                    "self": "https://zenodo.org/api/records/5776933"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Moore, Tiffany"
                        },
                        {
                            "name": "Ridgley, Frank"
                        },
                        {
                            "name": "Whitfield, Steven"
                        },
                        {
                            "name": "Sayre, Summer"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5776933",
                    "journal": {
                        "issue": "3",
                        "pages": "151-157",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Composia fidelissima vagrans, developmental duration, natural history."
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-12-17",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5776932",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5776933"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5776932"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Life history, taxonomy and ecology of the Faithful Beauty Moth Composia fidelissima vagrans (Lepidoptera, Erebidae, Pericopina) in the Pine Rocklands of South Florida"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 34,
                    "unique_downloads": 34,
                    "unique_views": 95,
                    "version_downloads": 34,
                    "version_unique_downloads": 34,
                    "version_unique_views": 95,
                    "version_views": 101,
                    "version_volume": 66655946,
                    "views": 101,
                    "volume": 66655946
                },
                "updated": "2021-12-18T01:48:38.169922+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3764162",
                "conceptrecid": "3764162",
                "created": "2020-05-06T03:41:54.600279+00:00",
                "doi": "10.5281/zenodo.3764163",
                "files": [
                    {
                        "bucket": "55b7fd82-443d-4c02-a366-d970c1434590",
                        "checksum": "md5:5d0d8981096f0705b1c1629d9c58e85b",
                        "key": "TropLepRes30-1_Sourakov.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/55b7fd82-443d-4c02-a366-d970c1434590/TropLepRes30-1_Sourakov.pdf"
                        },
                        "size": 13160467,
                        "type": "pdf"
                    }
                ],
                "id": 3764163,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3764163.svg",
                    "bucket": "https://zenodo.org/api/files/55b7fd82-443d-4c02-a366-d970c1434590",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3764162.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3764162",
                    "doi": "https://doi.org/10.5281/zenodo.3764163",
                    "html": "https://zenodo.org/record/3764163",
                    "latest": "https://zenodo.org/api/records/3764163",
                    "latest_html": "https://zenodo.org/record/3764163",
                    "self": "https://zenodo.org/api/records/3764163"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Sourakov, Andrei"
                        },
                        {
                            "name": "Shirai, Leila T."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3764163",
                    "journal": {
                        "issue": "1",
                        "pages": "4-19",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "evo-devo, HS-GAGs, insect physiology, metamorphosis, positional information, Saturniidae, wound-induced responses"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-05-05",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3764162",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3764163"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3764162"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Pharmacological and surgical experiments on wing pattern development of Lepidoptera, with a focus on the eyespots of saturniid moths"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 435,
                    "unique_downloads": 369,
                    "unique_views": 794,
                    "version_downloads": 435,
                    "version_unique_downloads": 369,
                    "version_unique_views": 795,
                    "version_views": 862,
                    "version_volume": 5724803145,
                    "views": 861,
                    "volume": 5724803145
                },
                "updated": "2020-05-13T20:20:37.485456+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3899539",
                "conceptrecid": "3899539",
                "created": "2020-06-30T13:41:59.585151+00:00",
                "doi": "10.5281/zenodo.3899540",
                "files": [
                    {
                        "bucket": "f6a78f14-20d8-440f-8b82-05fdd4f7028e",
                        "checksum": "md5:2aa1f42bba1233783557dd41c02c4ce8",
                        "key": "TropLepRes30-1_Houlihan.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/f6a78f14-20d8-440f-8b82-05fdd4f7028e/TropLepRes30-1_Houlihan.pdf"
                        },
                        "size": 1649647,
                        "type": "pdf"
                    }
                ],
                "id": 3899540,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3899540.svg",
                    "bucket": "https://zenodo.org/api/files/f6a78f14-20d8-440f-8b82-05fdd4f7028e",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3899539.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3899539",
                    "doi": "https://doi.org/10.5281/zenodo.3899540",
                    "html": "https://zenodo.org/record/3899540",
                    "latest": "https://zenodo.org/api/records/3899540",
                    "latest_html": "https://zenodo.org/record/3899540",
                    "self": "https://zenodo.org/api/records/3899540"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Houlihan, Peter"
                        },
                        {
                            "name": "Sourakov, Andrei"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3899540",
                    "journal": {
                        "issue": "1",
                        "pages": "56-57",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-06-30",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3899539",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3899540"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3899539"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: Capturing a green Morpho: In polarized low light in the tropical rainforest, Morpho wing iridescence may contribute to camouflage"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 11,
                    "unique_views": 16,
                    "version_downloads": 12,
                    "version_unique_downloads": 11,
                    "version_unique_views": 16,
                    "version_views": 16,
                    "version_volume": 19795764,
                    "views": 16,
                    "volume": 19795764
                },
                "updated": "2020-07-01T00:59:18.879759+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5777145",
                "conceptrecid": "5777145",
                "created": "2021-12-17T15:35:45.488944+00:00",
                "doi": "10.5281/zenodo.5777146",
                "files": [
                    {
                        "bucket": "ef257672-eb3c-47df-9bdb-d2864f686321",
                        "checksum": "md5:d56e496b486132398786b73195091bda",
                        "key": "TropLepRes31-3_Sondhi.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/ef257672-eb3c-47df-9bdb-d2864f686321/TropLepRes31-3_Sondhi.pdf"
                        },
                        "size": 5946222,
                        "type": "pdf"
                    }
                ],
                "id": 5777146,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5777146.svg",
                    "bucket": "https://zenodo.org/api/files/ef257672-eb3c-47df-9bdb-d2864f686321",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5777145.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5777145",
                    "doi": "https://doi.org/10.5281/zenodo.5777146",
                    "html": "https://zenodo.org/record/5777146",
                    "latest": "https://zenodo.org/api/records/5777146",
                    "latest_html": "https://zenodo.org/record/5777146",
                    "self": "https://zenodo.org/api/records/5777146"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Sondhi, Sanjay"
                        },
                        {
                            "name": "Sondhi, Yash"
                        },
                        {
                            "name": "Karmakar, Tarun"
                        },
                        {
                            "name": "Kunte, Krushnamegh"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5777146",
                    "journal": {
                        "issue": "3",
                        "pages": "166-178",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "biodiversity assessment, biodiversity hotspots, Asian moths, range extensions, Western Ghats."
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-12-17",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5777145",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5777146"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5777145"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Moth diversity (Lepidoptera) of Shendurney and Ponmudi in Agastyamalai Biosphere Reserve, Kerala, India: an update"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 25,
                    "unique_downloads": 24,
                    "unique_views": 42,
                    "version_downloads": 25,
                    "version_unique_downloads": 24,
                    "version_unique_views": 42,
                    "version_views": 44,
                    "version_volume": 148655550,
                    "views": 44,
                    "volume": 148655550
                },
                "updated": "2021-12-18T01:48:38.100887+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.6588512",
                "conceptrecid": "6588512",
                "created": "2022-06-01T21:29:29.641944+00:00",
                "doi": "10.5281/zenodo.6588513",
                "files": [
                    {
                        "bucket": "78164bb5-e52c-43f4-ad34-d304cdad394a",
                        "checksum": "md5:90b109636fae445724978b68f9d1ab02",
                        "key": "TropLepRes32_1_Corahua.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/78164bb5-e52c-43f4-ad34-d304cdad394a/TropLepRes32_1_Corahua.pdf"
                        },
                        "size": 9129111,
                        "type": "pdf"
                    }
                ],
                "id": 6588513,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.6588513.svg",
                    "bucket": "https://zenodo.org/api/files/78164bb5-e52c-43f4-ad34-d304cdad394a",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.6588512.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.6588512",
                    "doi": "https://doi.org/10.5281/zenodo.6588513",
                    "html": "https://zenodo.org/record/6588513",
                    "latest": "https://zenodo.org/api/records/6588513",
                    "latest_html": "https://zenodo.org/record/6588513",
                    "self": "https://zenodo.org/api/records/6588513"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Corahua-Espinoza, Thalia"
                        },
                        {
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "name": "Shellman, Brooke"
                        },
                        {
                            "name": "Baine, Quinlyn"
                        },
                        {
                            "name": "Tejeira, Rafael"
                        },
                        {
                            "name": "Ccahuana, Rodrigo"
                        },
                        {
                            "name": "Gallice, Geoffrey"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.6588513",
                    "journal": {
                        "issue": "1",
                        "pages": "38-46",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "32"
                    },
                    "keywords": [
                        "Euptychiina, Finca Las Piedras, host plant, life history, Madre de Dios"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2022-06-01",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.6588512",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "6588513"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "6588512"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Early stage biology of two euptychiine butterfly species in the Peruvian Amazon (Lepidoptera: Nymphalidae: Satyrinae: Satyrini)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 10,
                    "unique_downloads": 10,
                    "unique_views": 14,
                    "version_downloads": 10,
                    "version_unique_downloads": 10,
                    "version_unique_views": 14,
                    "version_views": 14,
                    "version_volume": 91291110,
                    "views": 14,
                    "volume": 91291110
                },
                "updated": "2022-06-02T01:50:55.788791+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.1248199",
                "conceptrecid": "1248199",
                "created": "2018-05-31T17:46:36.935707+00:00",
                "doi": "10.5281/zenodo.1248200",
                "files": [
                    {
                        "bucket": "39bb8508-de20-4ebe-a6bf-f04b533814fa",
                        "checksum": "md5:9ab51e15f0961d5e4d516f90cfbd1f42",
                        "key": "TropLepRes28-1_Seidel.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/39bb8508-de20-4ebe-a6bf-f04b533814fa/TropLepRes28-1_Seidel.pdf"
                        },
                        "size": 4824866,
                        "type": "pdf"
                    }
                ],
                "id": 1248200,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248200.svg",
                    "bucket": "https://zenodo.org/api/files/39bb8508-de20-4ebe-a6bf-f04b533814fa",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.1248199.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.1248199",
                    "doi": "https://doi.org/10.5281/zenodo.1248200",
                    "html": "https://zenodo.org/record/1248200",
                    "latest": "https://zenodo.org/api/records/1248200",
                    "latest_html": "https://zenodo.org/record/1248200",
                    "self": "https://zenodo.org/api/records/1248200"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "H-E-B School of Business & Administration, University of the Incarnate Word, 4301 Broadway, San Antonio, Texas 78209-6397 USA",
                            "name": "Seidel, Cody Lane"
                        },
                        {
                            "affiliation": "Department of Biology, University of the Incarnate Word, 4301 Broadway, San Antonio, Texas 78209-6397 USA",
                            "name": "Peigler, Richard S."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.1248200",
                    "journal": {
                        "issue": "1",
                        "pages": "13-18",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "avian predators, eri silk, Lauraceae, muga silk, parasitoids, peace silk, wild silks"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-05-31",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.1248199",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "1248200"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "1248199"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Review: entomological aspects of sericulture based on Antheraea assamensis and Samia ricini (Saturniidae) in Assam and Meghalaya"
                },
                "owners": [
                    36485
                ],
                "revision": 5,
                "stats": {
                    "downloads": 44,
                    "unique_downloads": 34,
                    "unique_views": 36,
                    "version_downloads": 44,
                    "version_unique_downloads": 34,
                    "version_unique_views": 36,
                    "version_views": 36,
                    "version_volume": 212294104,
                    "views": 36,
                    "volume": 212294104
                },
                "updated": "2020-01-20T14:30:24.439068+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2653729",
                "conceptrecid": "2653729",
                "created": "2019-05-17T22:20:03.582121+00:00",
                "doi": "10.5281/zenodo.2847700",
                "files": [
                    {
                        "bucket": "031bb807-b935-4b6a-ba93-5c0f2a963f8e",
                        "checksum": "md5:50ddca2ad2558909d5e97017972bbfe9",
                        "key": "TropLepRes29-1_Subramoniam_corrig.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/031bb807-b935-4b6a-ba93-5c0f2a963f8e/TropLepRes29-1_Subramoniam_corrig.pdf"
                        },
                        "size": 5761869,
                        "type": "pdf"
                    }
                ],
                "id": 2847700,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2847700.svg",
                    "bucket": "https://zenodo.org/api/files/031bb807-b935-4b6a-ba93-5c0f2a963f8e",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2653729.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2653729",
                    "doi": "https://doi.org/10.5281/zenodo.2847700",
                    "html": "https://zenodo.org/record/2847700",
                    "latest": "https://zenodo.org/api/records/2847700",
                    "latest_html": "https://zenodo.org/record/2847700",
                    "self": "https://zenodo.org/api/records/2847700"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Department of Agricultural Entomology, Tamil Nadu Agricultural University, Coimbatore-641003, India",
                            "name": "Subramoniam, Anjana"
                        },
                        {
                            "affiliation": "Department of Agricultural Entomology, Tamil Nadu Agricultural University, Coimbatore-641003, India",
                            "name": "Chitra, N."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.2847700",
                    "journal": {
                        "issue": "1",
                        "pages": "45-51",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "29"
                    },
                    "keywords": [
                        "Noorda blitealis, Moringa oleifera, egg, larval chaetotaxy, pupa, crochets, scanning electron microscopy, stereozoom microscopy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2019-05-17",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2653729",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 2,
                                "index": 1,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2847700"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2653729"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Morphology and chaetotaxy of Noorda blitealis Walker, 1859 (Crambidae: Glaphyriinae) immatures"
                },
                "owners": [
                    36485
                ],
                "revision": 5,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 12,
                    "unique_views": 25,
                    "version_downloads": 65,
                    "version_unique_downloads": 59,
                    "version_unique_views": 50,
                    "version_views": 59,
                    "version_volume": 370746295,
                    "views": 25,
                    "volume": 69142428
                },
                "updated": "2020-01-20T12:59:50.430681+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5600407",
                "conceptrecid": "5600407",
                "created": "2021-10-29T15:31:36.225150+00:00",
                "doi": "10.5281/zenodo.5600408",
                "files": [
                    {
                        "bucket": "3aa1bb1f-95a6-4a3d-9d5e-60f88aa3253c",
                        "checksum": "md5:1dda4bd156c6697c0b98d69b55234c71",
                        "key": "TropLepRes31-2_Tejeira.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/3aa1bb1f-95a6-4a3d-9d5e-60f88aa3253c/TropLepRes31-2_Tejeira.pdf"
                        },
                        "size": 1956314,
                        "type": "pdf"
                    }
                ],
                "id": 5600408,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600408.svg",
                    "bucket": "https://zenodo.org/api/files/3aa1bb1f-95a6-4a3d-9d5e-60f88aa3253c",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600407.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5600407",
                    "doi": "https://doi.org/10.5281/zenodo.5600408",
                    "html": "https://zenodo.org/record/5600408",
                    "latest": "https://zenodo.org/api/records/5600408",
                    "latest_html": "https://zenodo.org/record/5600408",
                    "self": "https://zenodo.org/api/records/5600408"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Tejeira, Rafael"
                        },
                        {
                            "name": "Ccahuana, Rodrigo"
                        },
                        {
                            "name": "Hurtado, Thalia"
                        },
                        {
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "name": "See, Joseph"
                        },
                        {
                            "name": "Rodríguez-Melgarejo, Maryzender"
                        },
                        {
                            "name": "Corahua-Espinoza, Thalia"
                        },
                        {
                            "name": "Gallice, Geoffrey"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5600408",
                    "journal": {
                        "issue": "2",
                        "pages": "96-100",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Euptychiina, life history, Madre de Dios, Peru"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-10-29",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5600407",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5600408"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5600407"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages of Chloreuptychia marica (Weymer, 1911) (Lepidoptera: Nymphalidae: Satyrinae: Satyrini)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 22,
                    "unique_downloads": 21,
                    "unique_views": 55,
                    "version_downloads": 22,
                    "version_unique_downloads": 21,
                    "version_unique_views": 55,
                    "version_views": 59,
                    "version_volume": 43038908,
                    "views": 59,
                    "volume": 43038908
                },
                "updated": "2021-10-30T01:48:57.715257+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.6588531",
                "conceptrecid": "6588531",
                "created": "2022-06-01T21:51:14.810698+00:00",
                "doi": "10.5281/zenodo.6588532",
                "files": [
                    {
                        "bucket": "d2772b24-8631-4a2b-bef9-a846ad484e95",
                        "checksum": "md5:77e1884265ff9f56dfcc1d07fab5d7c2",
                        "key": "TropLepRes32_1_Freitas.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/d2772b24-8631-4a2b-bef9-a846ad484e95/TropLepRes32_1_Freitas.pdf"
                        },
                        "size": 5178294,
                        "type": "pdf"
                    }
                ],
                "id": 6588532,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.6588532.svg",
                    "bucket": "https://zenodo.org/api/files/d2772b24-8631-4a2b-bef9-a846ad484e95",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.6588531.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.6588531",
                    "doi": "https://doi.org/10.5281/zenodo.6588532",
                    "html": "https://zenodo.org/record/6588532",
                    "latest": "https://zenodo.org/api/records/6588532",
                    "latest_html": "https://zenodo.org/record/6588532",
                    "self": "https://zenodo.org/api/records/6588532"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Freitas, André V. L."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.6588532",
                    "journal": {
                        "issue": "1",
                        "pages": "52-58",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "32"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2022-06-01",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.6588531",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "6588532"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "6588531"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages of Splendeuptychia ambra (Nymphalidae: Euptychiina) and the diversity of immature morphology within Splendeuptychia"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 8,
                    "unique_downloads": 8,
                    "unique_views": 13,
                    "version_downloads": 8,
                    "version_unique_downloads": 8,
                    "version_unique_views": 13,
                    "version_views": 14,
                    "version_volume": 41426352,
                    "views": 14,
                    "volume": 41426352
                },
                "updated": "2022-06-02T01:50:58.410467+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3764166",
                "conceptrecid": "3764166",
                "created": "2020-05-06T02:45:21.674686+00:00",
                "doi": "10.5281/zenodo.3764167",
                "files": [
                    {
                        "bucket": "607953bf-1d92-408f-898f-9192ab06ab52",
                        "checksum": "md5:742a3c76d1eb8349a1ed14bf12053a49",
                        "key": "TropLepRes30-1_Freitas.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/607953bf-1d92-408f-898f-9192ab06ab52/TropLepRes30-1_Freitas.pdf"
                        },
                        "size": 3463523,
                        "type": "pdf"
                    }
                ],
                "id": 3764167,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3764167.svg",
                    "bucket": "https://zenodo.org/api/files/607953bf-1d92-408f-898f-9192ab06ab52",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3764166.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3764166",
                    "doi": "https://doi.org/10.5281/zenodo.3764167",
                    "html": "https://zenodo.org/record/3764167",
                    "latest": "https://zenodo.org/api/records/3764167",
                    "latest_html": "https://zenodo.org/record/3764167",
                    "self": "https://zenodo.org/api/records/3764167"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Freitas, André V. L."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.3764167",
                    "journal": {
                        "issue": "1",
                        "pages": "28-32",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Atlantic Forest, Ithomiini, Napeogenes, Solanaceae"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-05-05",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3764166",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3764167"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3764166"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new clearwing butterfly from northeastern Brazil (Nymphalidae: Danainae: Ithomiini)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 29,
                    "unique_downloads": 29,
                    "unique_views": 43,
                    "version_downloads": 29,
                    "version_unique_downloads": 29,
                    "version_unique_views": 43,
                    "version_views": 43,
                    "version_volume": 100442167,
                    "views": 43,
                    "volume": 100442167
                },
                "updated": "2020-05-06T20:20:28.398340+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4966750",
                "conceptrecid": "4966750",
                "created": "2021-07-02T16:31:44.146890+00:00",
                "doi": "10.5281/zenodo.4966751",
                "files": [
                    {
                        "bucket": "55af2002-f54c-4e82-9e52-8df2252f983d",
                        "checksum": "md5:fa28211164cf42879fdd6fb9f36b67bc",
                        "key": "TropLepRes31-1_Gallardo-Emesis.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/55af2002-f54c-4e82-9e52-8df2252f983d/TropLepRes31-1_Gallardo-Emesis.pdf"
                        },
                        "size": 7695303,
                        "type": "pdf"
                    }
                ],
                "id": 4966751,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4966751.svg",
                    "bucket": "https://zenodo.org/api/files/55af2002-f54c-4e82-9e52-8df2252f983d",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4966750.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4966750",
                    "doi": "https://doi.org/10.5281/zenodo.4966751",
                    "html": "https://zenodo.org/record/4966751",
                    "latest": "https://zenodo.org/api/records/4966751",
                    "latest_html": "https://zenodo.org/record/4966751",
                    "self": "https://zenodo.org/api/records/4966751"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Gallardo, Robert J."
                        },
                        {
                            "name": "Zhang, Jing"
                        },
                        {
                            "name": "Cong, Qian"
                        },
                        {
                            "name": "Shen, Jinhui"
                        },
                        {
                            "name": "Grishin, Nick V."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4966751",
                    "journal": {
                        "issue": "1",
                        "pages": "53-59",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Biodiversity, Emerald Valley, genomics, Neotropics, metalmark butterflies, taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-07-02",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4966750",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4966751"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4966750"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A uniquely patterned new species of Emesis from Honduras (Riodinidae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 30,
                    "unique_downloads": 27,
                    "unique_views": 68,
                    "version_downloads": 30,
                    "version_unique_downloads": 27,
                    "version_unique_views": 68,
                    "version_views": 72,
                    "version_volume": 230859090,
                    "views": 72,
                    "volume": 230859090
                },
                "updated": "2021-07-03T01:48:27.302945+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3764164",
                "conceptrecid": "3764164",
                "created": "2020-05-06T03:04:06.112319+00:00",
                "doi": "10.5281/zenodo.3764165",
                "files": [
                    {
                        "bucket": "62068c78-f070-414f-ba6a-521b0cc01ba0",
                        "checksum": "md5:002b1b851017be0403cf6cd574a816a3",
                        "key": "TropLepRes30-1_Jain.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/62068c78-f070-414f-ba6a-521b0cc01ba0/TropLepRes30-1_Jain.pdf"
                        },
                        "size": 12712532,
                        "type": "pdf"
                    }
                ],
                "id": 3764165,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3764165.svg",
                    "bucket": "https://zenodo.org/api/files/62068c78-f070-414f-ba6a-521b0cc01ba0",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3764164.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3764164",
                    "doi": "https://doi.org/10.5281/zenodo.3764165",
                    "html": "https://zenodo.org/record/3764165",
                    "latest": "https://zenodo.org/api/records/3764165",
                    "latest_html": "https://zenodo.org/record/3764165",
                    "self": "https://zenodo.org/api/records/3764165"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Jain, Anuj"
                        },
                        {
                            "name": "Tea, Yi-Kai"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3764165",
                    "journal": {
                        "issue": "1",
                        "pages": "20-27",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-05-05",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3764164",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3764165"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3764164"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Mass emergence of the tropical swallowtail moth Lyssa zampa (Lepidoptera: Uraniidae: Uraniinae) in Singapore, with notes on its partial life history"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 68,
                    "unique_downloads": 58,
                    "unique_views": 152,
                    "version_downloads": 68,
                    "version_unique_downloads": 58,
                    "version_unique_views": 152,
                    "version_views": 163,
                    "version_volume": 864452176,
                    "views": 163,
                    "volume": 864452176
                },
                "updated": "2020-05-11T08:20:31.718387+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5062571",
                "conceptrecid": "5062571",
                "created": "2021-07-12T21:48:28.338504+00:00",
                "doi": "10.5281/zenodo.5062572",
                "files": [
                    {
                        "bucket": "7fe294c9-9248-404f-9c44-fd1774a8f0c3",
                        "checksum": "md5:9ea4820ff282c9aa97d659948b231c5d",
                        "key": "TropLepRes31_suppl2.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/7fe294c9-9248-404f-9c44-fd1774a8f0c3/TropLepRes31_suppl2.pdf"
                        },
                        "size": 110281225,
                        "type": "pdf"
                    }
                ],
                "id": 5062572,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5062572.svg",
                    "bucket": "https://zenodo.org/api/files/7fe294c9-9248-404f-9c44-fd1774a8f0c3",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5062571.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5062571",
                    "doi": "https://doi.org/10.5281/zenodo.5062572",
                    "html": "https://zenodo.org/record/5062572",
                    "latest": "https://zenodo.org/api/records/5062572",
                    "latest_html": "https://zenodo.org/record/5062572",
                    "self": "https://zenodo.org/api/records/5062572"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Sondhi, Sanjay"
                        },
                        {
                            "name": "Karmakar, Tarun"
                        },
                        {
                            "name": "Sondhi, Yash"
                        },
                        {
                            "name": "Kunte, Krushnamegh"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5062572",
                    "journal": {
                        "issue": "Supplement 2",
                        "pages": "1-53",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "biodiversity, eastern Himalaya, range extension, Subansiri"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-07-12",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5062571",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5062572"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5062571"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Moths of Tale Wildlife Sanctuary, Arunachal Pradesh, India with seventeen additions to the moth fauna of India (Lepidoptera: Heterocera)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 45,
                    "unique_downloads": 36,
                    "unique_views": 64,
                    "version_downloads": 45,
                    "version_unique_downloads": 36,
                    "version_unique_views": 64,
                    "version_views": 69,
                    "version_volume": 4962655125,
                    "views": 69,
                    "volume": 4962655125
                },
                "updated": "2021-07-13T01:48:24.762336+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.3877479",
                "conceptrecid": "3877479",
                "created": "2020-06-19T13:59:43.780891+00:00",
                "doi": "10.5281/zenodo.3877480",
                "files": [
                    {
                        "bucket": "7ae71355-c598-4530-963d-8964d92207b6",
                        "checksum": "md5:7833610366e4a8135de7cce98a3e6635",
                        "key": "TropLepRes30-1_Hall_Calospila.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/7ae71355-c598-4530-963d-8964d92207b6/TropLepRes30-1_Hall_Calospila.pdf"
                        },
                        "size": 1143533,
                        "type": "pdf"
                    }
                ],
                "id": 3877480,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.3877480.svg",
                    "bucket": "https://zenodo.org/api/files/7ae71355-c598-4530-963d-8964d92207b6",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.3877479.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.3877479",
                    "doi": "https://doi.org/10.5281/zenodo.3877480",
                    "html": "https://zenodo.org/record/3877480",
                    "latest": "https://zenodo.org/api/records/3877480",
                    "latest_html": "https://zenodo.org/record/3877480",
                    "self": "https://zenodo.org/api/records/3877480"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Hall, Jason P. W."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.3877480",
                    "journal": {
                        "issue": "1",
                        "pages": "39-41",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "30"
                    },
                    "keywords": [
                        "Argyraspila, Neotropics, species description, taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2020-06-04",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.3877479",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "3877480"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "3877479"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new species of Calospila (Lepidoptera: Riodinidae: Nymphidiini)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 9,
                    "unique_downloads": 9,
                    "unique_views": 23,
                    "version_downloads": 9,
                    "version_unique_downloads": 9,
                    "version_unique_views": 23,
                    "version_views": 24,
                    "version_volume": 10291797,
                    "views": 24,
                    "volume": 10291797
                },
                "updated": "2020-06-19T22:18:22.669818+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.6360555",
                "conceptrecid": "6360555",
                "created": "2022-03-18T16:41:26.658726+00:00",
                "doi": "10.5281/zenodo.6360556",
                "files": [
                    {
                        "bucket": "5d336451-07ce-4bac-b7a0-c437c8c62c2a",
                        "checksum": "md5:75f5097e50e70edff1711d12c77ee2e8",
                        "key": "TropLepRes32_1_Burlace.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/5d336451-07ce-4bac-b7a0-c437c8c62c2a/TropLepRes32_1_Burlace.pdf"
                        },
                        "size": 3889606,
                        "type": "pdf"
                    }
                ],
                "id": 6360556,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.6360556.svg",
                    "bucket": "https://zenodo.org/api/files/5d336451-07ce-4bac-b7a0-c437c8c62c2a",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.6360555.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.6360555",
                    "doi": "https://doi.org/10.5281/zenodo.6360556",
                    "html": "https://zenodo.org/record/6360556",
                    "latest": "https://zenodo.org/api/records/6360556",
                    "latest_html": "https://zenodo.org/record/6360556",
                    "self": "https://zenodo.org/api/records/6360556"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Burlace, Cristy"
                        },
                        {
                            "name": "Wolfe, Keith V."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.6360556",
                    "journal": {
                        "issue": "1",
                        "pages": "16-23",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "32"
                    },
                    "keywords": [
                        "Arecaceae, Asia, Asparagaceae, biogeography, Drino, Heliconiaceae, Isosturmia, Odonata, Pandanaceae"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2022-03-18",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.6360555",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "6360556"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "6360555"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Life history of the Philippine endemic butterfly Faunis sappho (Nymphalidae, Satyrinae, Amathusiini) on Bohol island, with the first record of a dipteran parasitoid (Tachinidae, Exoristinae, Eryciini) for the genus and a listing of hostplant families utilized by the tribe"
                },
                "owners": [
                    36485
                ],
                "revision": 3,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 12,
                    "unique_views": 26,
                    "version_downloads": 12,
                    "version_unique_downloads": 12,
                    "version_unique_views": 26,
                    "version_views": 28,
                    "version_volume": 46675272,
                    "views": 28,
                    "volume": 46675272
                },
                "updated": "2022-03-20T01:49:23.527005+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4721626",
                "conceptrecid": "4721626",
                "created": "2021-05-03T16:11:02.201976+00:00",
                "doi": "10.5281/zenodo.4721627",
                "files": [
                    {
                        "bucket": "87a28d97-b43d-40f1-a95f-d99fd159b6d7",
                        "checksum": "md5:30c3899512a4628e4b02ad486a37a8f3",
                        "key": "TropLepRes31-1_Nakahara.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/87a28d97-b43d-40f1-a95f-d99fd159b6d7/TropLepRes31-1_Nakahara.pdf"
                        },
                        "size": 5904111,
                        "type": "pdf"
                    }
                ],
                "id": 4721627,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721627.svg",
                    "bucket": "https://zenodo.org/api/files/87a28d97-b43d-40f1-a95f-d99fd159b6d7",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721626.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4721626",
                    "doi": "https://doi.org/10.5281/zenodo.4721627",
                    "html": "https://zenodo.org/record/4721627",
                    "latest": "https://zenodo.org/api/records/4721627",
                    "latest_html": "https://zenodo.org/record/4721627",
                    "self": "https://zenodo.org/api/records/4721627"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Nakahara, Shinichi"
                        },
                        {
                            "name": "Matos-Maraví, Pável"
                        },
                        {
                            "name": "Willmott, Keith R."
                        },
                        {
                            "name": "Nakamura, Ichiro"
                        },
                        {
                            "name": "MacDonald, John R."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4721627",
                    "journal": {
                        "issue": "1",
                        "pages": "35-41",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Costa Rica, Euptychiina, Panama, species description, taxonomy"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-05-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4721626",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4721627"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4721626"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Description of a new species of Pseudodebis Forster, 1964 from Central America (Lepidoptera: Nymphalidae: Satyrinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 14,
                    "unique_downloads": 14,
                    "unique_views": 35,
                    "version_downloads": 14,
                    "version_unique_downloads": 14,
                    "version_unique_views": 35,
                    "version_views": 38,
                    "version_volume": 82657554,
                    "views": 38,
                    "volume": 82657554
                },
                "updated": "2021-05-04T01:48:12.032181+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2650299",
                "conceptrecid": "2650299",
                "created": "2019-05-03T21:41:42.452794+00:00",
                "doi": "10.5281/zenodo.2650300",
                "files": [
                    {
                        "bucket": "6dd59d31-d248-49a3-a5ed-cb02bcb24b6f",
                        "checksum": "md5:721d8767044a32114bdb67eed2e887e0",
                        "key": "TropLepRes29-1_Carvalho.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/6dd59d31-d248-49a3-a5ed-cb02bcb24b6f/TropLepRes29-1_Carvalho.pdf"
                        },
                        "size": 6952284,
                        "type": "pdf"
                    }
                ],
                "id": 2650300,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2650300.svg",
                    "bucket": "https://zenodo.org/api/files/6dd59d31-d248-49a3-a5ed-cb02bcb24b6f",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2650299.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2650299",
                    "doi": "https://doi.org/10.5281/zenodo.2650300",
                    "html": "https://zenodo.org/record/2650300",
                    "latest": "https://zenodo.org/api/records/2650300",
                    "latest_html": "https://zenodo.org/record/2650300",
                    "self": "https://zenodo.org/api/records/2650300"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Departamento de Biologia Animal, Instituto de Biologia, Universidade Estadual de Campinas, SP, Brazil",
                            "name": "Carvalho, Márcio Romero Marques"
                        },
                        {
                            "affiliation": "Departamento de Biologia Animal, Instituto de Biologia, Universidade Estadual de Campinas, SP, Brazil",
                            "name": "Barbosa, Eduardo Proença"
                        },
                        {
                            "affiliation": "Departamento de Biologia Animal, Instituto de Biologia, Universidade Estadual de Campinas, SP, Brazil",
                            "name": "Freitas, André Victor Lucci"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.2650300",
                    "journal": {
                        "issue": "1",
                        "pages": "12-18",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "29"
                    },
                    "keywords": [
                        "Early stages, Ithomiini, life cycle, Mechanitina, Solanaceae"
                    ],
                    "language": "eng",
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2019-05-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2650299",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2650300"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2650299"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages of Mechanitis polymnia casabranca (Nymphalidae, Danainae)"
                },
                "owners": [
                    36485
                ],
                "revision": 5,
                "stats": {
                    "downloads": 36,
                    "unique_downloads": 31,
                    "unique_views": 62,
                    "version_downloads": 36,
                    "version_unique_downloads": 31,
                    "version_unique_views": 62,
                    "version_views": 64,
                    "version_volume": 250282224,
                    "views": 64,
                    "volume": 250282224
                },
                "updated": "2020-01-20T13:19:44.557111+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4966790",
                "conceptrecid": "4966790",
                "created": "2021-07-02T16:33:59.113617+00:00",
                "doi": "10.5281/zenodo.4966791",
                "files": [
                    {
                        "bucket": "6a31dead-d842-4113-9aed-408e00d2760b",
                        "checksum": "md5:b917dd92cbebb05839eeed12c0a39668",
                        "key": "TropLepRes31-1_Neild.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/6a31dead-d842-4113-9aed-408e00d2760b/TropLepRes31-1_Neild.pdf"
                        },
                        "size": 2227446,
                        "type": "pdf"
                    }
                ],
                "id": 4966791,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4966791.svg",
                    "bucket": "https://zenodo.org/api/files/6a31dead-d842-4113-9aed-408e00d2760b",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4966790.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4966790",
                    "doi": "https://doi.org/10.5281/zenodo.4966791",
                    "html": "https://zenodo.org/record/4966791",
                    "latest": "https://zenodo.org/api/records/4966791",
                    "latest_html": "https://zenodo.org/record/4966791",
                    "self": "https://zenodo.org/api/records/4966791"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Neild, Andrew F. E."
                        },
                        {
                            "name": "Losada, María Eugenia"
                        },
                        {
                            "name": "Willmott, Keith R."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4966791",
                    "journal": {
                        "issue": "1",
                        "pages": "60-67",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Batesian mimicry, flooded forest, Dismorphiinae, Müllerian mimicry, Orinoco Delta, Pieridae, Venezuela"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-07-02",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4966790",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4966791"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4966790"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A distinctive new subspecies of Moschoneura pinthous (Linnaeus, 1758) (Lepidoptera: Pieridae: Dismorphiinae) from the Orinoco Delta, Venezuela, with comments on the species-level taxonomy"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 11,
                    "unique_views": 24,
                    "version_downloads": 12,
                    "version_unique_downloads": 11,
                    "version_unique_views": 24,
                    "version_views": 26,
                    "version_volume": 26729352,
                    "views": 26,
                    "volume": 26729352
                },
                "updated": "2021-07-03T01:48:27.168080+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5526836",
                "conceptrecid": "5526836",
                "created": "2021-09-30T20:00:46.230798+00:00",
                "doi": "10.5281/zenodo.5526837",
                "files": [
                    {
                        "bucket": "39c5c156-06bb-421d-b9a0-12497edbf399",
                        "checksum": "md5:3af643be2afaac20a6925b5133956e55",
                        "key": "TropLepRes31_suppl3.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/39c5c156-06bb-421d-b9a0-12497edbf399/TropLepRes31_suppl3.pdf"
                        },
                        "size": 28365923,
                        "type": "pdf"
                    }
                ],
                "id": 5526837,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5526837.svg",
                    "bucket": "https://zenodo.org/api/files/39c5c156-06bb-421d-b9a0-12497edbf399",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5526836.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5526836",
                    "doi": "https://doi.org/10.5281/zenodo.5526837",
                    "html": "https://zenodo.org/record/5526837",
                    "latest": "https://zenodo.org/api/records/5526837",
                    "latest_html": "https://zenodo.org/record/5526837",
                    "self": "https://zenodo.org/api/records/5526837"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Willmott, Keith R."
                        },
                        {
                            "name": "Lamas, Gerardo"
                        },
                        {
                            "name": "Hall, Jason P. W."
                        },
                        {
                            "name": "Vitale, Fabio"
                        },
                        {
                            "name": "Boyer, Pierre"
                        },
                        {
                            "name": "Petit, Jean-Claude"
                        },
                        {
                            "name": "Radford, Jamie"
                        },
                        {
                            "name": "Elias, Marianne"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5526837",
                    "journal": {
                        "issue": "Supplement 3",
                        "pages": "1-80",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Amazon, Andes, clearwing butterflies, cloudforest, Colombia, DNA barcode, Ecuador, morphology, Neotropical region, Peru, rainforest, Solanaceae, systematics, taxonomy."
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-09-30",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5526836",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5526837"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5526836"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new species and thirty-eight new subspecies of equatorial Ithomiini (Lepidoptera, Nymphalidae, Danainae)"
                },
                "owners": [
                    36485
                ],
                "revision": 3,
                "stats": {
                    "downloads": 75,
                    "unique_downloads": 69,
                    "unique_views": 122,
                    "version_downloads": 75,
                    "version_unique_downloads": 69,
                    "version_unique_views": 122,
                    "version_views": 132,
                    "version_volume": 2127444225,
                    "views": 132,
                    "volume": 2127444225
                },
                "updated": "2021-10-01T13:48:37.847769+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2224764",
                "conceptrecid": "2224764",
                "created": "2018-12-17T16:31:21.310390+00:00",
                "doi": "10.5281/zenodo.2224765",
                "files": [
                    {
                        "bucket": "babca457-cbe9-44fa-9056-5752bd9ecd9d",
                        "checksum": "md5:361fa9593108cc370a7c21c1f7f25f87",
                        "key": "TropLepRes28-2_Freitas.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/babca457-cbe9-44fa-9056-5752bd9ecd9d/TropLepRes28-2_Freitas.pdf"
                        },
                        "size": 5598468,
                        "type": "pdf"
                    }
                ],
                "id": 2224765,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2224765.svg",
                    "bucket": "https://zenodo.org/api/files/babca457-cbe9-44fa-9056-5752bd9ecd9d",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2224764.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2224764",
                    "doi": "https://doi.org/10.5281/zenodo.2224765",
                    "html": "https://zenodo.org/record/2224765",
                    "latest": "https://zenodo.org/api/records/2224765",
                    "latest_html": "https://zenodo.org/record/2224765",
                    "self": "https://zenodo.org/api/records/2224765"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "Departamento de Biologia Animal, Instituto de Biologia, Universidade Estadual de Campinas, Campinas, SP, Brazil",
                            "name": "Freitas, André V. L."
                        },
                        {
                            "affiliation": "Departamento de Biologia Animal, Instituto de Biologia, Universidade Estadual de Campinas, Campinas, SP, Brazil",
                            "name": "Batista Rosa, Augusto H."
                        },
                        {
                            "affiliation": "Departamento de Biologia Animal, Instituto de Biologia, Universidade Estadual de Campinas, Campinas, SP, Brazil",
                            "name": "Oliveira Carreira, Junia Y."
                        },
                        {
                            "affiliation": "Departamento de Biologia Animal, Instituto de Biologia, Universidade Estadual de Campinas, Campinas, SP, Brazil",
                            "name": "Eyng Guerrato, Patricia"
                        },
                        {
                            "affiliation": "Departamento de Biologia Animal, Instituto de Biologia, Universidade Estadual de Campinas, Campinas, SP, Brazil",
                            "name": "Pereira Santos, Jessie"
                        },
                        {
                            "affiliation": "Departamento de Biologia Animal, Instituto de Biologia, Universidade Estadual de Campinas, Campinas, SP, Brazil",
                            "name": "Tacioli, André"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.2224765",
                    "journal": {
                        "issue": "2",
                        "pages": "100-105",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "28"
                    },
                    "keywords": [
                        "Atlantic Forest, Satyrinae, Satyrini, Natural history"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2018-12-17",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2224764",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2224765"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2224764"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Immature stages of two Moneuptychia from southeastern Brazil (Nymphalidae: Euptychiina)"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 24,
                    "unique_downloads": 21,
                    "unique_views": 53,
                    "version_downloads": 24,
                    "version_unique_downloads": 21,
                    "version_unique_views": 52,
                    "version_views": 52,
                    "version_volume": 134363232,
                    "views": 53,
                    "volume": 134363232
                },
                "updated": "2020-01-20T12:03:52.372523+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.6543681",
                "conceptrecid": "6543681",
                "created": "2022-05-19T02:24:42.579198+00:00",
                "doi": "10.5281/zenodo.6543682",
                "files": [
                    {
                        "bucket": "62edc6b4-9380-4500-9760-80dcf10da1f4",
                        "checksum": "md5:a78cc0b629ad242dca849c166bdeb431",
                        "key": "TropLepRes32_suppl1_Farooqui.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/62edc6b4-9380-4500-9760-80dcf10da1f4/TropLepRes32_suppl1_Farooqui.pdf"
                        },
                        "size": 46008035,
                        "type": "pdf"
                    }
                ],
                "id": 6543682,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.6543682.svg",
                    "bucket": "https://zenodo.org/api/files/62edc6b4-9380-4500-9760-80dcf10da1f4",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.6543681.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.6543681",
                    "doi": "https://doi.org/10.5281/zenodo.6543682",
                    "html": "https://zenodo.org/record/6543682",
                    "latest": "https://zenodo.org/api/records/6543682",
                    "latest_html": "https://zenodo.org/record/6543682",
                    "self": "https://zenodo.org/api/records/6543682"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Farooqui, Shahabab Ahmad"
                        },
                        {
                            "name": "Parwez, Hina"
                        }
                    ],
                    "description": "<p>Supplement published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.6543682",
                    "journal": {
                        "issue": "Supplement 1",
                        "pages": "1-47",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "32"
                    },
                    "keywords": [
                        "Aligarh, distributional ranges, new records, systematic account"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2022-05-18",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.6543681",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "6543682"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "6543681"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Moths of Uttar Pradesh, India (Lepidoptera)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 14,
                    "unique_downloads": 14,
                    "unique_views": 12,
                    "version_downloads": 14,
                    "version_unique_downloads": 14,
                    "version_unique_views": 12,
                    "version_views": 12,
                    "version_volume": 644112490,
                    "views": 12,
                    "volume": 644112490
                },
                "updated": "2022-05-20T01:49:25.670724+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5600446",
                "conceptrecid": "5600446",
                "created": "2021-10-29T15:43:51.608219+00:00",
                "doi": "10.5281/zenodo.5600447",
                "files": [
                    {
                        "bucket": "e073d0ce-905c-40fc-b8a9-803ad8307d98",
                        "checksum": "md5:904bf17f8d590ed9f1b14c456bda06f7",
                        "key": "TropLepRes31-2_Suenia-Bastos.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/e073d0ce-905c-40fc-b8a9-803ad8307d98/TropLepRes31-2_Suenia-Bastos.pdf"
                        },
                        "size": 2055015,
                        "type": "pdf"
                    }
                ],
                "id": 5600447,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600447.svg",
                    "bucket": "https://zenodo.org/api/files/e073d0ce-905c-40fc-b8a9-803ad8307d98",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600446.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5600446",
                    "doi": "https://doi.org/10.5281/zenodo.5600447",
                    "html": "https://zenodo.org/record/5600447",
                    "latest": "https://zenodo.org/api/records/5600447",
                    "latest_html": "https://zenodo.org/record/5600447",
                    "self": "https://zenodo.org/api/records/5600447"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Suênia-Bastos, Ayane"
                        },
                        {
                            "name": "Zahiri, Reza"
                        },
                        {
                            "name": "Lima, Iracilda Maria de Moura"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5600447",
                    "journal": {
                        "issue": "2",
                        "pages": "134-137",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "food plant, immature stages, life history"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-10-29",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5600446",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5600447"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5600446"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: Ficus benjamina L. (Moraceae): a new exotic food plant for the Eucereon sylvius group (Lepidoptera: Erebidae) in Alagoas, Brazil"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 28,
                    "unique_downloads": 26,
                    "unique_views": 48,
                    "version_downloads": 28,
                    "version_unique_downloads": 26,
                    "version_unique_views": 48,
                    "version_views": 54,
                    "version_volume": 57540420,
                    "views": 54,
                    "volume": 57540420
                },
                "updated": "2021-10-30T01:48:50.709882+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.6588459",
                "conceptrecid": "6588459",
                "created": "2022-06-01T14:57:58.046206+00:00",
                "doi": "10.5281/zenodo.6588460",
                "files": [
                    {
                        "bucket": "99e9d4b7-cfd2-4ac0-a451-b0fce44588a1",
                        "checksum": "md5:ebc46267be4c1b9411c495785d748228",
                        "key": "TropLepRes32_1_Martinez.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/99e9d4b7-cfd2-4ac0-a451-b0fce44588a1/TropLepRes32_1_Martinez.pdf"
                        },
                        "size": 5621432,
                        "type": "pdf"
                    }
                ],
                "id": 6588460,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.6588460.svg",
                    "bucket": "https://zenodo.org/api/files/99e9d4b7-cfd2-4ac0-a451-b0fce44588a1",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.6588459.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.6588459",
                    "doi": "https://doi.org/10.5281/zenodo.6588460",
                    "html": "https://zenodo.org/record/6588460",
                    "latest": "https://zenodo.org/api/records/6588460",
                    "latest_html": "https://zenodo.org/record/6588460",
                    "self": "https://zenodo.org/api/records/6588460"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Martinez, Jose I."
                        },
                        {
                            "name": "Kasiske, Toni"
                        },
                        {
                            "name": "Cotrina, Douglas"
                        },
                        {
                            "name": "Miller, Jacqueline Y."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.6588460",
                    "journal": {
                        "issue": "1",
                        "pages": "24-31",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "32"
                    },
                    "keywords": [
                        "Host plant, immatures, Neotropics, Noctuoidea, UV reflective"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2022-06-01",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.6588459",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "6588460"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "6588459"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Life history of the jaguar moth Cicadomorphus falkasiska Martinez (Noctuidae: Pantheinae) with notes on behavior"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 10,
                    "unique_downloads": 10,
                    "unique_views": 11,
                    "version_downloads": 10,
                    "version_unique_downloads": 10,
                    "version_unique_views": 11,
                    "version_views": 11,
                    "version_volume": 56214320,
                    "views": 11,
                    "volume": 56214320
                },
                "updated": "2022-06-02T01:50:51.536966+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.6604682",
                "conceptrecid": "6604682",
                "created": "2022-06-01T21:49:04.741361+00:00",
                "doi": "10.5281/zenodo.6604683",
                "files": [
                    {
                        "bucket": "0e0805e8-1a42-4be9-8fe4-bb5c7583418c",
                        "checksum": "md5:9d1bf671c53726307b6941ca5163d410",
                        "key": "TropLepRes32_1_Mota.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/0e0805e8-1a42-4be9-8fe4-bb5c7583418c/TropLepRes32_1_Mota.pdf"
                        },
                        "size": 4441797,
                        "type": "pdf"
                    }
                ],
                "id": 6604683,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.6604683.svg",
                    "bucket": "https://zenodo.org/api/files/0e0805e8-1a42-4be9-8fe4-bb5c7583418c",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.6604682.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.6604682",
                    "doi": "https://doi.org/10.5281/zenodo.6604683",
                    "html": "https://zenodo.org/record/6604683",
                    "latest": "https://zenodo.org/api/records/6604683",
                    "latest_html": "https://zenodo.org/record/6604683",
                    "self": "https://zenodo.org/api/records/6604683"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Mota, Luísa L."
                        },
                        {
                            "name": "Rosa, Augusto H. B."
                        },
                        {
                            "name": "Vasconcellos, Lucius R."
                        },
                        {
                            "name": "Willmott, Keith R."
                        },
                        {
                            "name": "Freitas, André V. L."
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.6604683",
                    "journal": {
                        "issue": "1",
                        "pages": "47-51",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "32"
                    },
                    "keywords": [
                        "Amazon Forest, butterfly, Mechanitina, Solanaceae."
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2022-06-01",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.6604682",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "6604683"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "6604682"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "A new subspecies of Mechanitis lysimnia from southern Amazonia (Nymphalidae: Danainae: Ithomiini)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 12,
                    "unique_downloads": 12,
                    "unique_views": 22,
                    "version_downloads": 12,
                    "version_unique_downloads": 12,
                    "version_unique_views": 22,
                    "version_views": 24,
                    "version_volume": 53301564,
                    "views": 24,
                    "volume": 53301564
                },
                "updated": "2022-06-02T01:50:56.526808+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.4721611",
                "conceptrecid": "4721611",
                "created": "2021-05-03T16:09:21.041806+00:00",
                "doi": "10.5281/zenodo.4721612",
                "files": [
                    {
                        "bucket": "707f0c51-1ae9-4b57-a9df-0b1330323c10",
                        "checksum": "md5:de34206baf7c8ed59bec307afefad83d",
                        "key": "TropLepRes31-1_Kong.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/707f0c51-1ae9-4b57-a9df-0b1330323c10/TropLepRes31-1_Kong.pdf"
                        },
                        "size": 1393440,
                        "type": "pdf"
                    }
                ],
                "id": 4721612,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721612.svg",
                    "bucket": "https://zenodo.org/api/files/707f0c51-1ae9-4b57-a9df-0b1330323c10",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.4721611.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.4721611",
                    "doi": "https://doi.org/10.5281/zenodo.4721612",
                    "html": "https://zenodo.org/record/4721612",
                    "latest": "https://zenodo.org/api/records/4721612",
                    "latest_html": "https://zenodo.org/record/4721612",
                    "self": "https://zenodo.org/api/records/4721612"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "Kong, Eunice"
                        },
                        {
                            "name": "Khoo, Max"
                        },
                        {
                            "name": "Wei, Wong Jun"
                        },
                        {
                            "name": "Wong, Sherilyn"
                        },
                        {
                            "name": "Wen, Low Bing"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research</p>",
                    "doi": "10.5281/zenodo.4721612",
                    "journal": {
                        "issue": "1",
                        "pages": "22-31",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "behavior, diet, Lepidoptera, Riodinidae, Singapore, Taxila haquinus haquinus"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-05-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.4721611",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "4721612"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "4721611"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Observations on the behavior and diet of the Harlequin Taxila haquinus haquinus Fabricius 1793 (Lepidoptera: Riodinidae) in Singapore"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 95,
                    "unique_downloads": 95,
                    "unique_views": 160,
                    "version_downloads": 95,
                    "version_unique_downloads": 95,
                    "version_unique_views": 160,
                    "version_views": 161,
                    "version_volume": 132376800,
                    "views": 161,
                    "volume": 132376800
                },
                "updated": "2021-05-04T01:48:11.886877+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.5600424",
                "conceptrecid": "5600424",
                "created": "2021-10-29T15:34:17.362797+00:00",
                "doi": "10.5281/zenodo.5600425",
                "files": [
                    {
                        "bucket": "91c77883-fa4f-41d0-8958-f6e6ff84d045",
                        "checksum": "md5:be6b77bb87879d48d17e6b445f9a8635",
                        "key": "TropLepRes31-2_Garcia.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/91c77883-fa4f-41d0-8958-f6e6ff84d045/TropLepRes31-2_Garcia.pdf"
                        },
                        "size": 4371624,
                        "type": "pdf"
                    }
                ],
                "id": 5600425,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600425.svg",
                    "bucket": "https://zenodo.org/api/files/91c77883-fa4f-41d0-8958-f6e6ff84d045",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.5600424.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.5600424",
                    "doi": "https://doi.org/10.5281/zenodo.5600425",
                    "html": "https://zenodo.org/record/5600425",
                    "latest": "https://zenodo.org/api/records/5600425",
                    "latest_html": "https://zenodo.org/record/5600425",
                    "self": "https://zenodo.org/api/records/5600425"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "name": "García Díaz, José de Jesús"
                        },
                        {
                            "name": "Haghenbeck Fraga, Francisco G."
                        },
                        {
                            "name": "Faynel, Christophe"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.5600425",
                    "journal": {
                        "issue": "2",
                        "pages": "118-123",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "31"
                    },
                    "keywords": [
                        "Chiapas, distribution, Eumaeini, Lacandon Jungle, Neotropical, tropical forest"
                    ],
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2021-10-29",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.5600424",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "5600425"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "5600424"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Nota científica: Primer registro de Nicolaea viceta (Hewitson, 1868) en México (Lepidoptera: Lycaenidae: Theclinae)"
                },
                "owners": [
                    36485
                ],
                "revision": 2,
                "stats": {
                    "downloads": 19,
                    "unique_downloads": 18,
                    "unique_views": 46,
                    "version_downloads": 19,
                    "version_unique_downloads": 18,
                    "version_unique_views": 46,
                    "version_views": 50,
                    "version_volume": 83060856,
                    "views": 50,
                    "volume": 83060856
                },
                "updated": "2021-10-30T01:48:46.184896+00:00"
            },
            {
                "conceptdoi": "10.5281/zenodo.2654977",
                "conceptrecid": "2654977",
                "created": "2019-05-03T21:46:19.687232+00:00",
                "doi": "10.5281/zenodo.2654978",
                "files": [
                    {
                        "bucket": "58044895-789f-4499-8b2e-e3c0982dad57",
                        "checksum": "md5:3b133f20bc0a1584ff5cf6f42dedf4b7",
                        "key": "TropLepRes29-1_Sourakov.pdf",
                        "links": {
                            "self": "https://zenodo.org/api/files/58044895-789f-4499-8b2e-e3c0982dad57/TropLepRes29-1_Sourakov.pdf"
                        },
                        "size": 4548722,
                        "type": "pdf"
                    }
                ],
                "id": 2654978,
                "links": {
                    "badge": "https://zenodo.org/badge/doi/10.5281/zenodo.2654978.svg",
                    "bucket": "https://zenodo.org/api/files/58044895-789f-4499-8b2e-e3c0982dad57",
                    "conceptbadge": "https://zenodo.org/badge/doi/10.5281/zenodo.2654977.svg",
                    "conceptdoi": "https://doi.org/10.5281/zenodo.2654977",
                    "doi": "https://doi.org/10.5281/zenodo.2654978",
                    "html": "https://zenodo.org/record/2654978",
                    "latest": "https://zenodo.org/api/records/2654978",
                    "latest_html": "https://zenodo.org/record/2654978",
                    "self": "https://zenodo.org/api/records/2654978"
                },
                "metadata": {
                    "access_right": "open",
                    "access_right_category": "success",
                    "creators": [
                        {
                            "affiliation": "McGuire Center for Lepidoptera and Biodiversity, Florida Museum of Natural History, University of Florida, Gainesville, FL 32611, USA",
                            "name": "Sourakov, Andrei"
                        }
                    ],
                    "description": "<p>Article published in the journal Tropical Lepidoptera Research.</p>",
                    "doi": "10.5281/zenodo.2654978",
                    "journal": {
                        "issue": "1",
                        "pages": "52-55",
                        "title": "Tropical Lepidoptera Research",
                        "volume": "29"
                    },
                    "license": {
                        "id": "CC-BY-NC-4.0"
                    },
                    "publication_date": "2019-05-03",
                    "related_identifiers": [
                        {
                            "identifier": "10.5281/zenodo.2654977",
                            "relation": "isVersionOf",
                            "scheme": "doi"
                        }
                    ],
                    "relations": {
                        "version": [
                            {
                                "count": 1,
                                "index": 0,
                                "is_last": true,
                                "last_child": {
                                    "pid_type": "recid",
                                    "pid_value": "2654978"
                                },
                                "parent": {
                                    "pid_type": "recid",
                                    "pid_value": "2654977"
                                }
                            }
                        ]
                    },
                    "resource_type": {
                        "subtype": "article",
                        "title": "Journal article",
                        "type": "publication"
                    },
                    "title": "Scientific Note: Evaluating potential aposematic signals in caterpillars using a fluorescent microscope and spectrometer"
                },
                "owners": [
                    36485
                ],
                "revision": 4,
                "stats": {
                    "downloads": 20,
                    "unique_downloads": 19,
                    "unique_views": 30,
                    "version_downloads": 20,
                    "version_unique_downloads": 19,
                    "version_unique_views": 30,
                    "version_views": 32,
                    "version_volume": 90974440,
                    "views": 32,
                    "volume": 90974440
                },
                "updated": "2020-01-20T14:40:05.022068+00:00"
            }
        ],
        "total": 97
    },
    "links": {
        "self": "https://zenodo.org/api/records/?sort=bestmatch&q=journal.title%3A%22Tropical+Lepidoptera+Research%22&page=1&size=100"
    }
}';



$obj = json_decode($json);


foreach ($obj->hits->hits as $hit)
{
	//print_r($hit->metadata);
	
	$terms = array();
	
	if (isset($hit->metadata->journal->volume))
	{
		$terms[] = 'volume="' . $hit->metadata->journal->volume . '"';	
	}

	if (isset($hit->metadata->journal->issue))
	{
		$terms[] = 'issue="' . $hit->metadata->journal->issue . '"';	
	}
	
	/*
	if (isset($hit->metadata->journal->pages))
	{
		$parts = explode('-', $hit->metadata->journal->pages);
		$terms[] = 'spage="' . $parts[0] . '"';		
		$terms[] = 'epage="' . $parts[1] . '"';		
		
	}
	*/
	
	if (isset($hit->metadata->journal->title))
	{
		$terms[] = 'journal="' . $hit->metadata->journal->title . '"';		
	}
	
	if (isset($hit->metadata->title))
	{
		$terms[] = 'title="' . $hit->metadata->title . '"';		
	}
	
	/*
	if (count($terms) == 4 && ($hit->metadata->journal->volume == 28))
	{
		$sql = 'UPDATE publications SET doi="' . $hit->metadata->doi . '" WHERE ' . join(' AND ', $terms) . ';';
		
		echo "-- " . $hit->metadata->title . "\n";
		echo $sql . "\n\n";
	
	}
	*/
	echo $hit->metadata->doi  . "\n";
	


}

?>
