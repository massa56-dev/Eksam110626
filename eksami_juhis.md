Töökäik ja commitid
Loo kohe alguses Giti hoidla. Kaks esimest commitit on kõigil samad:

Commit 1 – tööplaan. README, mis sisaldab:

eksamikoodi (Kood: EX-2026-E3BM) ning genereeritud ettevõtte nime (Tark Käsi OÜ) ja tegevusala (Tegevusala: )käsitööpagar 

millise CMS-i valisid ja miks (2–3 lauset)
tööplaani: millised sammud kavatsed teha ja mis järjekorras, koos umbkaudse ajahinnanguga
Commit 2 – arenduskeskkond. Seadista arenduskeskkond ja selgita commitis, milliseid tööriistu kasutad (nt Node.js versioon, Local, Docker) ja miks need sobivad sinu valitud CMS-iga.

Edasine on sinu kavandada. Ülejäänud sammud jupitad ise loogilisteks etappideks – see ongi osa ülesandest. Iga sisuline etapp saab oma commiti. Näiteks võivad eraldi commitid olla: CMS-i paigaldus, seadistuse muudatus, sisutüübi loomine, väljade lisamine, sisu sisestamine, vaate loomine, päise või jaluse kohandamine, stiilimuudatus. Täpne jaotus sõltub sinu valitud CMS-ist ja plaanist.

Miinimumnõuded:

commitid loevad
iga commit on üks loogiline samm – mitte „kogu CMS valmis" ega ka kümme commitit kirjavahemärkide parandamiseks
kui plaan töö käigus muutub, kajasta seda commitis – plaani muutmine ei ole viga, vaid normaalne arendus
Hea commiti tunnused
Commiti kvaliteeti hinnatakse eraldi. Commit-sõnumid kirjuta inglise keeles ja järgi üldtunnustatud parimaid praktikaid:

Pealkiri (subject) on käskivas kõneviisis (imperative mood): Add recipe collection, mitte Added recipes ega adding stuff. Rusikareegel: pealkiri peab sobima lausesse „If applied, this commit will ".
Pealkiri on lühike (kuni umbes 50 tähemärki), algab suure tähega ja lõpus ei ole punkti.
Kirjeldus (body) selgitab, miks ja kuidas – millise valiku tegid, millist abi kasutasid, mis probleemi lahendasid. Pealkiri ütleb mis, body ütleb miks.
Üks commit = üks loogiline muudatus. Mitte „kogu CMS valmis" ühes commitis ega ka seosetud asjad koos.
Soovituslik lisaboonus: Conventional Commits eesliited (feat:, fix:, chore:, docs:), nt feat: add image upload field to recipe collection.
Näited heast ja halvast:

Hea:   Set up Payload with blank template
Hea:   Add recipe collection with 4 fields
Hea:   feat: render recipe list on homepage
Halb:  update
Halb:  fixed stuff
Halb:  Final version!!!
Mitmerealine commit käsurealt:

git commit -m "Add recipe collection with 4 fields" -m "Chose an upload field for the image because the site theme is a food blog. Asked AI about slug field config and adapted the answer to my field names."
Tehnilised nõuded lõpptulemusele
CMS on paigaldatud ja käivitub.
Loodud on sinu genereeritud ettevõtte koduleht, mis sisaldab:
esilehte
uudiste lehte (uudiste loend)
ühe uudise vaadet
kontaktilehte
Eksamikood on README failis ja saidi jaluses.
Wordpressi puhul lisapunktid kui lisasisutüüp eraldi väljadega (CPT + ACF) vähemalt 3 väljaga.
Arvestan, et aega on vähe ja kõik ei tarvitse valmis jõuda.

Vahekontroll
90 minuti möödudes näitad õppejõule oma hetkeseisu ja git log väljundit.

Demonstratsioon
Eksami lõpus näitad oma tööd (umbes 5 minutit):

git log – käid oma töökäigu commitide kaupa läbi ja selgitad otsuseid.
Näitad CMS-i halduskeskkonda ja töötavat lehte brauseris.
Täidad õppejõu antud väikese kohapealse muudatuse (nt lisad sisukirje või muudad ühte välja).
Hindamine
Kogu töö peab olema githubis eraldi repos kättesaadav.
Nimeks – sisuhalduse-eksam.

Kriteerium	Osakaal
Tööplaan ja CMS-i valiku põhjendus (commit 1)	10 %
Arenduskeskkonna seadistus ja selgitus (commit 2)	15 %
Töö jupitamine: loogilised etapid, commitid tehtud jooksvalt	15 %
Commitide kvaliteet: pealkirjad, selgitused, üks samm korraga	15 %
Tehniline tulemus: CMS töötab, sisutüüp, sisu, vaade	25 %
Demo: selgitused ja kohapealne muudatus	20 %
Lisapunktid: GitHubi üleslaadimine, juurutamine, lisafunktsionaalsus	kuni +10 %