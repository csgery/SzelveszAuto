| Sorszám |Név | Dátum| Funkció leírása| Vizsgálat módja/eszköze, részletes leírása | Elvárt eredmény| Eredmény |Verzió |
|--|--|--|--|--|--|--|--|
|T1| Zettisch Márk | 2021. 10. 03. 9:50 | Felhasználó regisztrálása | A regisztrációs formban felvettük az adatokat. Az adatbázist PDO-ban kérdezzük le.| Adatbázisban való megjelenés| Szintaktikai hiba a registration.php fájlban, ami fatal errort dobott. | Beta 1.1 |
|T2| Zettisch Márk| 2021.10.03. 10:02 | Felhasználó regisztrálása | A regisztrációs formban felvettük az adatokat. Az adatbázist PDO-ban kérdezzük le.| Adatbázisban való megjelenés | Az ID-t automatikus generálja. email és név adatait bekerültek az adatbázisba | Beta 1.2 |
|T3| Zettisch Márk| 2021.10.03. 10:11 | Bejelentkezés |A bejelentkezés formban összehasonlításra kerülnek a megadott adatok az adatbázisban lévőkkel.| Sikeres bejelentkezés után tudnak vásárolni | A program sikeresen összehasonlította a megadott adatokat az adatbázisban lévőkkel és megtörtént a bejelentkezés | Beta 1.2 |


# Szélsőérték funkcionális teszt
| Sorszám |Név | Dátum| Funkció leírása| Vizsgálat módja/eszköze, részletes leírása | Elvárt eredmény| Eredmény |Verzió |
|--|--|--|--|--|--|--|--|
|T1| Zettisch Márk| 2021.10.03 10:23 | Regisztráció ellenőrzése |Leellenőrizöm, hogy egyik mező se lehet üres, névnek legalább 6, a jelszónak legalább 8 karakteresnek kell lennie, és az emailban nem lehet speciális karakter .|Ha valamit rosszul adunk meg, akkor egy hibaüzenetet kell dobnia.| Hibás érték megadására azonnal hibaüznettel tér vissza a honlap.| Beta 1.2 |
