Detta är en webbtjänst tilltänkt att användas tillsammans med en applikation skapad med vue.js. 

Den innehåller modeller, controllers och routing för att hantera data in och ut från databastabeller för produkt, personal och user. 

Samtliga routes är skyddade av sanctum så användare måste registrera sig för att få token för tillträde till övriga Routes.

Konfigurerad för att användas tillsammans med en mysql-databas. för att använda detsamma: kör migrationsfilerna.