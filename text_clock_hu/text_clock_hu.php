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
    <div id="idoSzoveg"></div>
  </div>
  <script>

  const  minutes_text= [
      "",
      "1 perccel múlt",
      "2 perccel múlt",
      "3 perccel múlt",
      "4 perccel múlt",
      "5 perccel múlt",
      "6 perccel múlt",
      "7 perccel múlt",
      "7 perc múlva negyed",
      "6 perc múlva negyed",
      "5 perc múlva negyed",
      "4 perc múlva negyed",
      "3 perc múlva negyed",
      "2 perc múlva negyed",
      "1 perc múlva negyed",
      "negyed",
      "1 perccel múlt negyed",
      "2 perccel múlt negyed",
      "3 perccel múlt negyed",
      "4 perccel múlt negyed",
      "5 perccel múlt negyed",
      "6 perccel múlt negyed",
      "7 perccel múlt negyed",
      "7 perc múlva fél",
      "6 perc múlva fél",
      "5 perc múlva fél",
      "4 perc múlva fél",
      "3 perc múlva fél",
      "2 perc múlva fél",
      "1 perc múlva fél",
      "fél",
      "1 perccel múlt fél",
      "2 perccel múlt fél",
      "3 perccel múlt fél",
      "4 perccel múlt fél",
      "5 perccel múlt fél",
      "6 perccel múlt fél",
      "7 perccel múlt fél",
      "7 perc múlva háromnegyed",
      "6 perc múlva háromnegyed",
      "5 perc múlva háromnegyed",
      "4 perc múlva háromnegyed",
      "3 perc múlva háromnegyed",
      "2 perc múlva háromnegyed",
      "1 perc múlva háromnegyed",
      "háromnegyed",
      "1 perccel múlt háromnegyed",
      "2 perccel múlt háromnegyed",
      "3 perccel múlt háromnegyed",
      "4 perccel múlt háromnegyed",
      "5 perccel múlt háromnegyed",
      "6 perccel múlt háromnegyed",
      "7 perccel múlt háromnegyed",
      "7 perc múlva",
      "6 perc múlva",
      "5 perc múlva",
      "4 perc múlva",
      "3 perc múlva",
      "2 perc múlva",
      "1 perc múlva",
    ]
    function magyarIdoKiiras() {
  const date = new Date();
  let ora = date.getHours();
  const perc = date.getMinutes();
  
  let ora12 = ora % 12;
  let ora12_kov = ora +1 % 12;
  if (ora12 === 0) ora12 = 12;
  if (ora12_kov === 0) ora12_kov = 12;
  

  let napszak = ora < 12 ? "délelőtt" : "délután";
  
  const szamNevek = ["", "egy", "kettő", "három", "négy", "öt", "hat", "hét", "nyolc", "kilenc", "tíz", "tizenegy", "tizenkettő"];
  
  let kiiras = perc==0 ? `${napszak} ${szamNevek[ora12]}` : `${napszak}, ${minutes_text[perc]} ${szamNevek[ora12_kov]}`;


  return kiiras;
}

console.log(magyarIdoKiiras());

  function frissitIdot() {
    document.getElementById("idoSzoveg").innerText = magyarIdoKiiras();
  }

  frissitIdot();
  setInterval(frissitIdot, 60000); // percenként frissít
</script>
</body>
</html>

