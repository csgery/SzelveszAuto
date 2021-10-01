# Rendszerterv

## A rendszer célja
- A rendszer célja a az autóvásárlás internetre történő implementálása
- A program egy web alapú felületen fut, ami egy adatbázishoz van kapcsolva
- Navigációs menün keresztül lehet egyes pontokba eljutni a rendszerben
- A program célja, hogy könnyen lehessen tájékozódni a felületen

## Projektterv
**Projekt szerepkörök, felelősségek**

-   szerepkörök
    -  product owner: Tajti Tibor
    -  scrum master: Bencsik Krisztián, Guti Adrián
    -  junior fejlesztők: Csépányi Gergely, Csomós Patrik, Zettisch Márk, Bögös Bálint
-   felelősségek:
    -   scrum master: A Scrum mester felügyeli és megkönnyíti a folyamat fenntartását, segíti a csapatot, ha problémába ütközik, illetve felügyeli, hogy mindenki betartja-e a Scrum alapvető szabályait.
    -   junior fejlesztő: A projekt elkészítése.

**Projekt munkások és felelősségeik**

-   Webfelület: Zettisch Márk, Bögös Bálint
-   Adatbázis: Csépányi Gergely, Csomós Patrik

## Üzleti folyamatok modellje
- Üzleti szereplők:
  - Alkalmazott
  
- Üzleti folyamatok:
  - Feladatok felvitele módosítása
  - Adatbázis hozzáférés

## Követelmények
 - Funkcionális
    - Webes környezetben való működés
    - A vásárlások és az ehhez tartozó adatok tárolása
 - Nem funkcionális
    - Gyors működés, vásárlások kilistázása
    - Egyszerű, egyértelmű kezelés
 - Törvényi előírások, szabványok
    - GDPR követelményeinek való megfelelés

## Funkcionális terv
- Rendszerszereplők
  - Admin
  - Alkalmazott
  - Vásárló
  
- Rendszerhasználati esetek és lefutásaik:
  - Admin
    * Autók megtekintése
    * Autók hozzáadása, törlése, módosítása
    * A rendszerhez való teljes hozzáférés

  - Alkalmazott
    * Autók megtekintése
    * Autók hozzáadása, módosítása
    * A rendszerhez való korlátozott hozzáférés

  - Vásárló
    * Autók megtekintése
    * Autók vásárlása

- Menü hierarchiák
  - Kezdőlap
    * Eladó autók
    * Bejelentkezés/regisztráció

## Fizikai környezet
Kliens:
   - Eszköz: Asztali számítógép, mobileszköz

  -  Operációs rendszer: Független

    - Szükséges applikációk: Web böngésző

    - Konfiguráció: Nem specifikus.

## Absztrakt domain modell
A program működése során az alkalmazott egy féle szerepkörben figyelhető meg. Az alkalmazott képes autót hozzáadni és módosítani és számlát kiállítani.

## Architekturális terv
A rendszerhez szükség van egy adatbázis szerverre, ebben az esetben MySql-t használunk. A webalkalmazás Visual Studio Code-ban és PHP Storm-ban készül el.

## Adatbázis terv
A weboldalhoz készült az adatbázis, ennek a tervét mutatja a mellékelt ábra.
![Adatbázis terv](https://github.com/csgery/SzelveszAuto/blob/main/Dokument%C3%A1ci%C3%B3/adatb%C3%A1zis_terv.jpg)

## Implementációs terv
A Webes felület főként HTML, CSS, és PHP nyelven fog készülni. Ezeket a technológiákat amennyire csak lehet külön fájlokba írva készítjük, és úgy fogjuk egymáshoz csatolni a jobb átláthatóság, könnyebb változtathatóság, és könnyebb bővítés érdekében.

## Tesztterv
PHP alapú weboldal, amit PHPStorm-ban, illetve Visual Studio Code-ban írtunk, XAMPP programcsomagot használva.

## Karbantartási terv
-Az alkalmazás folyamatos üzemeltetése és karbantartása, mely
magában foglalja a programhibák elhárítását, a belső igények változása miatti
módosításokat, valamint a környezeti feltételek változása miatt
megfogalmazott program-, illetve állomány módosítási igényeket.

