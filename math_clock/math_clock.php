<?php
// Alapértelmezett értékek
$bgColor = '#ffffff'; // fehér
$textColor = '#000000'; // fekete
$font_size = 10;


?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title>NetRobot Widget</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      background-color: <?= htmlspecialchars($bgColor) ?>;
      color: <?= htmlspecialchars($textColor) ?>;
      font-family: sans-serif;
      font-size: <?= $font_size."px"?>;

      display: flex;
      align-items: center;
      justify-content: center;
      box-sizing: border-box;
    }

    .content {
      text-align: center;
      padding: 1rem;
    }

  </style>
</head>
<body>
  <div class="content">
    <div id="oraSzoveg">Betöltés...</div>
  </div>
  <script>
     const minutes_text=[
      "",
      "hatvanad",
      "harmincad",
      "huszad",
      "tizenötöd",
      "tizenketted",
      "tized",
      "héthatvanad",
      "kéttizenötöd",
      "háromhuszad",
      "hatod",
      "tizenegy-hatvanad",
      "ötöd",
      "tizenhárom-hatvanad",
      "hétharmincad",
      "negyed",
      "négy-tizenötöd",
      "tizenhét-hatvanad",
      "kilenc-harmincad",
      "tizenkilenc-hatvanad",
      "harmad",
      "héthuszad",
      "tizenegyharmincad",
      "huszonhárom-hatvanad",
      "nyolctizenötöd",
      "öttizenketted",
      "tizenháromharmincad",
      "kilenchuszad",
      "héttizenötöd",
      "huszonkilenc-hatvanad",
      "fél",
      "harmincegy-hatvanad",
      "nyolctizenötöd",
      "tizenegyhuszad",
      "tizenhétharmincad",
      "héttizenketted",
      "háromötöd",
      "harminchét-hatvanad",
      "tizenkilencharmincad",
      "tizenháromhuszad",
      "kétharmad",
      "negyvenegy-hatvanad",
      "héttized",
      "negyvenhárom-hatvanad",
      "tizenegytizenötöd",
      "háromnegyed",
      "huszonháromharmincad",
      "negyvenhét-hatvanad",
      "tizenkettőtizenötöd",
      "negyvenkilenc-hatvanad",
      "öthatod",
      "tizenhéthuszad",
      "tizenháromtizenötöd",
      "ötvenhárom-hatvanad",
      "tizenhétharmincad",
      "tizenegytizenketted",
      "tizennégytizenötöd",
      "tizenkilenc-harmincad",
      "huszonkilenc-harmincad",
      "ötvenkilenc-hatvanad",
    ]
  
  
    function matematikusOra() {
      const date = new Date();
      let ora = date.getHours();
      const perc = date.getMinutes();

      const napszak = ora < 12 ? "délelőtt " : "délután ";
      let ora12 = ora % 12 + 1;
      
      const oraSzamok = ["", "egy", "kettő", "három", "négy", "öt", "hat", "hét", "nyolc", "kilenc", "tíz", "tizenegy", "tizenkettő"];
      const percSzoveg = minutes_text[perc];

      const szoveg = perc === 0
        ? `${napszak} ${oraSzamok[ora12]} óra`
        : `${napszak} ${percSzoveg} ${oraSzamok[ora12]}`;

      return szoveg;
    }

    function frissit() {
      document.getElementById("oraSzoveg").innerText = matematikusOra();
    }

    frissit();
    setInterval(frissit, 60000);
  </script>
</body>
</html>

