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
  
  html, body{background:transparent;}
  .clock {
    position: relative;
    width: 280px;
    height: 280px;
    background: <?= htmlspecialchars($bgColor) ?>;
    border-radius: 50%;
    box-shadow: 0 0 30px #000 inset;
  }

  /* Számlap számok */
  .number {
    position: absolute;
    color: <?= htmlspecialchars($textColor) ?>;
    font-weight: bold;
    font-family: monospace;
    font-size:<?= htmlspecialchars($font_size) ?>;
    user-select: none;
  }
  .num0   { top: 12px; left: 50%; transform: translateX(-50%); }
  .num6   { top: 50%; right: 12px; transform: translateY(-50%); }
  .num12  { bottom: 12px; left: 50%; transform: translateX(-50%); }
  .num18  { top: 50%; left: 12px; transform: translateY(-50%); }

  /* Középpont */
  .center-dot {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 14px;
    height: 14px;
    background: #ff4400;
    border-radius: 50%;
    transform: translate(-50%, -50%);
    box-shadow: 0 0 10px #ff4400;
  }

.dot {
  position: absolute;
  width: 7px;
  height: 7px;
  background: <?= htmlspecialchars($textColor) ?>;
  border-radius: 50%;
  box-shadow: 0 0 8px #fff;
  top: 50%;
  left: 50%;
  transform-origin: center center;
}
  /* Mutató konténerek - ezek forognak */
  .hand-container {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    transform-origin: center center;
  }

  /* Mutatók */
  .hand {
    position: absolute;
    bottom: 0;       /* mutató alja a konténer tetejével egy vonalban */
    left: 50%;
    transform: translateX(-50%);
    border-radius: 4px;
  }

  .hour-hand {
    width: 6px;
    height: 70px;
    background: #ff4400;
  }
  .minute-hand {
    width: 4px;
    height: 100px;
    background: #ff9966;
  }
  .second-hand {
    width: 2px;
    height: 115px;
    background: #ffcc99;
  }
</style>

</head>
<body>
  <div class="content">
    <div class="clock" id="clock">
  <!-- Számok -->
  <div class="number num0">0</div>
  <div class="number num6">6</div>
  <div class="number num12">12</div>
  <div class="number num18">18</div>

  <!-- Mutatók konténerei -->
  <div class="hand-container" id="hour-container">
    <div class="hand hour-hand"></div>
  </div>
  <div class="hand-container" id="minute-container">
    <div class="hand minute-hand"></div>
  </div>
  <div class="hand-container" id="second-container">
    <div class="hand second-hand"></div>
  </div>

  <div class="center-dot"></div>
</div>
  </div>
<script>
  function updateClock() {
    const now = new Date();
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const seconds = now.getSeconds();

    // 24 órás óra: 360 fok / 24 = 15 fok óránként
    // Óra fok: óra + perc + mp arányosan
    const hourDeg = ((hours % 24) + minutes / 60 + seconds / 3600) * 15;
    const minuteDeg = (minutes + seconds / 60) * 6;  // 360/60
    const secondDeg = seconds * 6;                   // 360/60

    document.getElementById('hour-container').style.transform = `translate(-50%, -50%) rotate(${hourDeg}deg)`;
    document.getElementById('minute-container').style.transform = `translate(-50%, -50%) rotate(${minuteDeg}deg)`;
    document.getElementById('second-container').style.transform = `translate(-50%, -50%) rotate(${secondDeg}deg)`;
  }

  function createDots() {
  const clock = document.getElementById('clock');
  const skipHours = [0, 6, 12, 18];

  for (let i = 0; i < 24; i++) {
    if (skipHours.includes(i)) continue;

    const dot = document.createElement('div');
    dot.classList.add('dot');

    // Szög fokban
    const angle = (i * 15) - 90; // -90 fokkal eltolva, hogy 0 fent legyen

    // Sugár (kb. a kör sugara minusz fél pötty méret)
    const radius = 130;

    // Számítsuk ki x, y-t körön
    const x = radius * Math.cos(angle * Math.PI / 180);
    const y = radius * Math.sin(angle * Math.PI / 180);

    dot.style.transform = `translate(${x}px, ${y}px)`;

    clock.appendChild(dot);
  }
}

createDots();

  setInterval(updateClock, 1000);
  updateClock();
</script>
</body>
</html>





