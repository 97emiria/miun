<!-- This page have all the rules for post posts. Includes on postAdd and postUpdate --> 

<h2>Regler</h2>

    <div>
        <h3>Rubrik</h3>
    <ul>
        <li>Minst 1 ord</li>
        <li>Max 64 tecken </li>
        <li> Antal ord: <?=str_word_count($title)?></li>
        <li> Antal tecken: <?=strlen($title)?> </li>
    </ul>
    </div>

    <div class="">
         <h3>Bild</h3>
    <ul>
        <li>Max filstorlek 500kb</li>
        <li>Tillåtna filer: jpg, jpeg, png, gif</li>
        <li>Tyvärr försvinner bilden om något är fel i formuläret, men det är bara att välja samma bild igen</li>
    </ul>
    </div>
    
    <div>
        <h3>Bildtext</h3>
        <ul>
            <li>Minst 1 ord</li>
            <li>Max 15 ord med max 100 tecken</li>
            <li>Nuvarande:</li>
            <li> Antal ord: <?=str_word_count($imgText)?></li>
            <li> Antal tecken: <?=strlen($imgText)?> </li>
        </ul>
    </div>
   
    <div>
        <h3>Innehåll</h3>
        <ul>
            <li>Minst 3 ord</li>
            <li>Max 500 ord med max 3000 tecken </li>
            <li>Nuvarande:</li>
            <li> Antal ord: <?=str_word_count($content)?></li>
            <li> Antal> tecken: <?=strlen($content)?> </li>
        </ul>
    </div>

    
    
    <p>Psssh! Tyvärr måste du posta inlägget eller uppdatera inlägget för att kunna se nya antal tecken </p>