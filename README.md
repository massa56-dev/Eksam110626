# Tark Käsi OÜ koduleht

**Eksamikood:** EX-2026-E3BM  
**Ettevõte:** Tark Käsi OÜ  
**Tegevusala:** käsitööpagar

---

## CMS-i valik

Valisin **WordPressi**, kuna see on maailma enimkasutatav CMS, millel on ulatuslik pistikprogrammide ökosüsteem (nt ACF kohandatud väljade jaoks) ning suur kogukond ja dokumentatsioon. WordPress sobib väikeettevõtte kodulehele hästi: haldusliidesesse sisenemine on intuitiivne, teemade kohandamine paindlik ja kohandatud sisutüüpide (CPT) loomine koos ACF-iga kiire. Lisaks on juhendis just WordPressi kasutajale lisapunktide saamise võimalus CPT + ACF eest.

---

## Tööplaan

| # | Samm | Kirjeldus | Aeg |
|---|------|-----------|-----|
| 1 | Git + README | Hoidla loomine, tööplaan | 5 min |
| 2 | Arenduskeskkond | Docker Compose (WP + MySQL), selgitus | 10 min |
| 3 | WP paigaldus | setup.sh WP-CLI skript, algseadistus | 15 min |
| 4 | Kohandatud teema | tark-kasi teema (header, footer, CSS) | 20 min |
| 5 | CPT + ACF | Tooted sisutüüp, 3 ACF välja | 15 min |
| 6 | Lehed | Esileht, Uudised, Kontakt | 10 min |
| 7 | Uudiste sisu | 3+ uudistepostitust | 10 min |
| 8 | Toodete sisu | 3 toodet koos ACF väljadega | 10 min |
| 9 | Navigatsioon + jalus | Menüü, eksamikood jaluses | 5 min |
| 10 | Testimine + demo | Lõpptestid, demo ettevalmistus | 10 min |

**Kokku:** ~110 minutit

---

## Arenduskeskkond

- Docker Desktop + Docker Compose
- WordPress 6.7 (ametlik `wordpress:latest` image)
- MySQL 8.0
- WP-CLI (`wordpress:cli` image automatiseerimiseks)

## Käivitamine

```bash
# Käivita konteinerid
docker-compose up -d

# Oodake ~30 sekundit, seejärel sea üles WordPress
docker-compose run --rm wpcli bash /setup.sh

# Leht: http://localhost:8080
# Admin: http://localhost:8080/wp-admin  (admin / admin123)
```

---

## Tehniline struktuur

```
eksam110626/
├── README.md
├── docker-compose.yml
├── setup.sh
├── themes/
│   └── tark-kasi/          # kohandatud teema
│       ├── style.css
│       ├── functions.php
│       ├── header.php
│       ├── footer.php
│       ├── front-page.php
│       ├── page.php
│       ├── page-kontakt.php
│       ├── archive.php
│       ├── single.php
│       ├── archive-toode.php
│       └── single-toode.php
└── plugins/
    └── tark-kasi-cpt/      # CPT + ACF väljad
        └── tark-kasi-cpt.php
```
