# Követelmény specifikáció

## Áttekintés
A fejlesztés célja egy vizuálisan részletes, átlátható weblap készítése, amely képes nyilvántartani egy autókereskedés autóit, alkalmazottait, vevőit és a tranzakciókat. Fontos a weboldal egyszerű áttekinthetősége, amely az alkalmazottak munkáját könnyíti. Lehetőség van új autók felvételére, törlésére valamint módosítására és vásárlására is. Ki lehet listázni az aktuálisan elérhető autókat, lehetőség van felhasználói regisztrációra és alkalmazottak felvételére. Három felhasználói kör: admin, alkalmazott és vásárló, mindegyik külön jogosultsági körrel.

## Jelenlegi helyzet

-Az autókereskedésnek szüksége van egy átlátható, könnyen kezelhető és korszerű weboldalra, ami a jelenlegi papír alapú megoldásokat kívánja helyettesíteni.
-Sok hibalehetőség a papír alapú kezelésben, emellett sokkal lassabb is, mint egy digitális rendszer.
-Nehezebb nyomon követni az aktív rendeléseket és státuszaikat papír alapon.


## Funkcionális követelmények
Az admin lehetőségei:
	-Alkalmazottakat tudjon felvenni, törölni és módosítani
	-Tudjon autókat hozzáadni, törölni és módosítani
	-Megrendeléseket tud törölni

Az alkalmazott lehetőségei:
	-Tudjon autókat hozzáadni és módosítani
	-Tudja a megrendelések státuszát módosítani (függőben lévő/összekészítés/szállítás alatt)

A vásárló lehetőségei:
	-Tudjon regisztrálni és belépni
-Tudjon vásárolni
-Tudjon jelszót módosítani
-Tudja nyomon követni a rendeléseinek státuszát

## Rendszerre vonatkozó törvények, szabványok, ajánlások
> AZ EURÓPAI PARLAMENT ÉS A TANÁCS 2016. április 27-i (EU) 2016/679 RENDELETE
> A természetes személyeknek a személyes adatok kezelése tekintetében történő védelméről és az ilyen adatok szabad áramlásáról, valamint a 95/46/EK irányelv hatályon kívül helyezéséről (általános adatvédelmi rendelet)

## Jelenlegi üzleti folyamatok modellje
A XXI. században sajnos még mindig sokan vannak, akik az ilyen jellegű megoldásokat papír alapon kezelik. Ezek a megoldások nem számítanak túl környezetbarátnak  a mai világban.
Az alkalmazott lassan és nehezen látja át a rendeléseket papír alapon, emellett nő a hibalehetőségek száma is.

## Igényelt üzleti folyamatok
Az alkalmazott exportálni tudja az aktív, illetve passzív rendeléseket, ezzel növelve a cég hatékonyságát és áttekinthetőségét.

| Követelmény sorszám| Követelmény megnevezése| Részletes leírás
|--|--|--|--|--|
|K00| Alkalmazottak hozzáadása | Alkalmazottak tetszőleges hozzáadása és törlése a rendszerből az admin számára
|K01|Autók kezelése |Tetszés szerint új autót lehet felvenni, törölni vagy éppen módosítani  a rendszerben, illetve lehetőség van a megvásárlásukra is
|K02| Rendelések követése | Legyen lehetőség a rendelések státuszának módosítására (3 státusz: függőben lévő, összekészítés, szállítás alatt), követésére és törlésére
|K03| Vásárlók adatainak tárolása | Lehetőség legyen a vásárlók személyes adatainak a biztonságos tárolására az ehhez kapcsolódó törvényeknek megfelelő módon

## Riportok

## Fogalomtár

