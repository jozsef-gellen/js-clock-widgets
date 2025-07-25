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
  <style>
  /* Special css */
  body {
    font-family: monospace;
  }

  #clock {
    display: flex; gap: 0.4em;
    flex-wrap: nowrap;
  }

  .digit {
    position: relative;
    width: 6vw;
    max-width: 80px;
    aspect-ratio: 0.6 / 1; /* magasság = kb 1.67x a szélesség */
  }

  /* Szegmensek alapja */
  .segment {
    position: absolute;
    background: <?= htmlspecialchars($bgColor) ?>;
    border-radius: 4px;
    transition: background-color 0.2s ease;
  }

  /* Aktív szegmens */
  .on {
    background: <?= htmlspecialchars($textColor) ?>;
    box-shadow: 0 0 10px <?= htmlspecialchars($textColor) ?>;
  }

  /* 7 szegmens pozíciói és méretei */

  /* a - felső vízszintes */
  .segment.a {
    top: 0;
    left: 10%;
    width: 80%;
    height: 15%;
  }

  /* b - jobb felső függőleges */
  .segment.b {
    top: 7.5%;
    right: 0;
    width: 15%;
    height: 40%;
  }

  /* c - jobb alsó függőleges */
  .segment.c {
    bottom: 7.5%;
    right: 0;
    width: 15%;
    height: 40%;
  }

  /* d - alsó vízszintes */
  .segment.d {
    bottom: 0;
    left: 10%;
    width: 80%;
    height: 15%;
  }

  /* e - bal alsó függőleges */
  .segment.e {
    bottom: 7.5%;
    left: 0;
    width: 15%;
    height: 40%;
  }

  /* f - bal felső függőleges */
  .segment.f {
    top: 7.5%;
    left: 0;
    width: 15%;
    height: 40%;
  }

  /* g - középső vízszintes */
  .segment.g {
    top: 42.5%;
    left: 10%;
    width: 80%;
    height: 15%;
  }

  /* Pont (kettőspont) */
  .colon {
    position: relative;
    width: 2vw;
    max-width: 30px;
    aspect-ratio: 0.4 / 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 0.3em;
    padding-left:10px;
  }

  .colon-dot {
    width: 30%;
    aspect-ratio: 1 / 1;
    background: <?= htmlspecialchars($textColor) ?>;
    border-radius: 50%;
    filter: drop-shadow(0 0 6px <?= htmlspecialchars($textColor) ?>);
    animation: blink 1s infinite;
  }

  @keyframes blink {
    0%, 50%, 100% { opacity: 1; }
    25%, 75% { opacity: 0.3; }
  }

  /* Reszponzív */
  @media (max-width: 400px) {
    .digit {
      width: 12vw;
    }
    .colon {
      width: 4vw;
    }
  }
</style>

</head>
<body>
  <div class="content">
      <div id="clock">
    <!-- 2 számjegy óra -->
    <div class="digit" id="h1">
      <div class="segment a"></div>
      <div class="segment b"></div>
      <div class="segment c"></div>
      <div class="segment d"></div>
      <div class="segment e"></div>
      <div class="segment f"></div>
      <div class="segment g"></div>
    </div>
    <div class="digit" id="h2">
      <div class="segment a"></div>
      <div class="segment b"></div>
      <div class="segment c"></div>
      <div class="segment d"></div>
      <div class="segment e"></div>
      <div class="segment f"></div>
      <div class="segment g"></div>
    </div>

    <!-- kettőspont -->
    <div class="colon">
      <div class="colon-dot"></div>
      <div class="colon-dot"></div>
    </div>

    <!-- 2 számjegy perc -->
    <div class="digit" id="m1">
      <div class="segment a"></div>
      <div class="segment b"></div>
      <div class="segment c"></div>
      <div class="segment d"></div>
      <div class="segment e"></div>
      <div class="segment f"></div>
      <div class="segment g"></div>
    </div>
    <div class="digit" id="m2">
      <div class="segment a"></div>
      <div class="segment b"></div>
      <div class="segment c"></div>
      <div class="segment d"></div>
      <div class="segment e"></div>
      <div class="segment f"></div>
      <div class="segment g"></div>
    </div>

    <!-- kettőspont másodperchez -->
    <div class="colon">
      <div class="colon-dot"></div>
      <div class="colon-dot"></div>
    </div>

    <!-- 2 számjegy másodperc -->
    <div class="digit" id="s1">
      <div class="segment a"></div>
      <div class="segment b"></div>
      <div class="segment c"></div>
      <div class="segment d"></div>
      <div class="segment e"></div>
      <div class="segment f"></div>
      <div class="segment g"></div>
    </div>
    <div class="digit" id="s2">
      <div class="segment a"></div>
      <div class="segment b"></div>
      <div class="segment c"></div>
      <div class="segment d"></div>
      <div class="segment e"></div>
      <div class="segment f"></div>
      <div class="segment g"></div>
    </div>
  </div>

  </div>
<script>
  // Számjegyekhez szegmensek kapcsolási térképe
  // a,b,c,d,e,f,g -> true = szegmens bekapcsolva
  // Pl.: 0 = a,b,c,d,e,f (g kikapcsolva)
  const digits = {
    '0': ['a','b','c','d','e','f'],
    '1': ['b','c'],
    '2': ['a','b','g','e','d'],
    '3': ['a','b','c','d','g'],
    '4': ['f','g','b','c'],
    '5': ['a','f','g','c','d'],
    '6': ['a','f','e','d','c','g'],
    '7': ['a','b','c'],
    '8': ['a','b','c','d','e','f','g'],
    '9': ['a','b','c','d','f','g']
  };

  // frissíti egy adott digit szegmenseit egy számjegy alapján
  function setDigit(digitDiv, number) {
    const segments = digitDiv.querySelectorAll('.segment');
    const onSegments = digits[number];
    segments.forEach(s => {
      if(onSegments.includes(s.classList[1])) {
        s.classList.add('on');
      } else {
        s.classList.remove('on');
      }
    });
  }

  function updateClock() {
    const now = new Date();
    const h = now.getHours().toString().padStart(2,'0');
    const m = now.getMinutes().toString().padStart(2,'0');
    const s = now.getSeconds().toString().padStart(2,'0');

    setDigit(document.getElementById('h1'), h[0]);
    setDigit(document.getElementById('h2'), h[1]);
    setDigit(document.getElementById('m1'), m[0]);
    setDigit(document.getElementById('m2'), m[1]);
    setDigit(document.getElementById('s1'), s[0]);
    setDigit(document.getElementById('s2'), s[1]);
  }

  // Induláskor és minden másodpercben frissít
  updateClock();
  setInterval(updateClock, 1000);
</script>
</body>
</html>





