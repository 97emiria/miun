# Moment 2
av Emilia Holmström - sep 2021


## Vad automatiserings-processens syfte är
Några fördelar är:
- Man kan enekelt och smidigt få tidskrävande arbete att bli gjort på några få sekunder
- Workspace kan vidgas genom att använda fler filer av samma typ (js, css) som gör det enklare att strukturera upp arbetet för att sedan
- så ihop filerna till en och samtidigt komprimera dem, vilket spar både plats och går fortare att ladda in sidan.  
- Med Gulp så behöver man inte skicka med alla filer som kommer med tillägen utan de sparas i filen packege.json, som sedan kan användas till att ladda ner tillägen på en annan dator (vilket är toppen)


## Anger om vilka paket och verktyg du använt, och varför du valt just dessa
Till moment 2 har ett git repository skapas till Github. Bra sätt att säkra sina filer om något skulle hända lokalt eller med filerna. 

För att underlätta och spara tid har Gulp används med passande npm-paket. Dessa är:
- Concat        | Slår ihop liknande filer
- Terser        | Komprimerar JavaScript filer
- Cssnano       | Komprimerar Css filer
- imagemin      | Komprimerar bilder 
- broweserSync  | En live server med Gulp
- sourcemaps    | Genom att CSS och JavaScript filerna komprimeras ihop används detta plugin för att kartlägga vart olika funktioner/koder ligger ursprungligen. 



## Beskriv systemet du skapat, hur man startar upp det och de tasks som ingår
Jag har valt att göra såhär:

1. Först skapar jag en mapp avsett till projekter/uppgiften. Där lägger jag en README.md fil med lämplig information 
2. Sedan skapar jag en git repository som jag kopplar med GitHub direkt, pushar readme filen så jag ser att det gått rätt till
3. Därefter strukturerar jag upp mitt arbete, genom att skapa lämpliga mappar och de filer som tänk att användas (index, css, js, bilder). Alla filer läggs numera direkt i en src-mapp. Detta blir mitt workspace. 
4. Installering av npm och de paket som är tänkt att använda kommer härnäst. Fixar också allt som ska finnas med i gulpfile-filen samt en gitignore-fil (för node_modules) skapas
5. Sedan så pushar jag allt detta till github 
6. Sedan är det bara börja skapa magi 🧙


## Ta även med om du lagt till något extra
### gulp-cwebp
Jag valde att testa ett npm-paketet gulp-cwebp. Smidigt sätt att kunna få bra kvalite bilder utan att själv behöva hålla på konvertera mellan filerna. 

### gulp-dwebp
Såg också att det fanns paket om man hade en webp bild och man ville ha det i png format, gulp-dwebp. Det innebär att man kan spara sitt projekts bilder direkt i webp och spara plats själv bland sina filer. För att paketet sedan ser till att de som inte kan se webp ser filerna ändå. (Ett liknande paket som konverterar alla filer till exemple png hade också varit bra, då behöver man själv inte komma ihåg vilket format alla bilder har (med förutsättningar att filerna blir okej i storlek) utan man kan alltid köra webp och png). 

### autoprefixer
Använde ett tillägg som anpassar css koden så den fungerar till flera webbläsare