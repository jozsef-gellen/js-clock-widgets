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
      text-align: left;
      padding: 1rem;
    }
    body {
       background:transparent;
      font-family: sans-serif;
   
    }

    .clock {
      width: 500px;
    }

    .bar-container {
      display: flex;
      align-items: left;
      margin: 15px 0;
      text-align:left;
    }

    .label {
      width: 30px;
      text-align: right;
      margin-right: 10px;
      font-size: 1.2em;
    }

    .bar {
      height: 30px;
      background-color: #444;
      border-radius: 5px;
      position: relative;
      flex-grow: 1;
    }

    .fill {
      height: 100%;
      background-color: #00bcd4;
      width: 0;
      border-radius: 5px;
      transition: width 0.5s ease;
    }

    .bar.hours .fill {
      background-color: #ff9800;
    }

    .bar.minutes .fill {
      background-color: #4caf50;
    }

    .bar.seconds .fill {
      background-color: #f44336;
    }

  </style>
</head>
<body>
  <div class="content">
  <div class="clock">
    <div class="bar-container">
      <div class="label" id="hour-label">00</div>
      <div class="bar hours"><div class="fill" id="hour-bar"></div></div>
    </div>
    <div class="bar-container">
      <div class="label" id="minute-label">00</div>
      <div class="bar minutes"><div class="fill" id="minute-bar"></div></div>
    </div>
    <div class="bar-container">
      <div class="label" id="second-label">00</div>
      <div class="bar seconds"><div class="fill" id="second-bar"></div></div>
    </div>
  </div>

  </div>
  <script>
    function updateClock() {
      const now = new Date();

      const hours = now.getHours();     // 0–23
      const minutes = now.getMinutes(); // 0–59
      const seconds = now.getSeconds(); // 0–59

      const hourRatio = hours / 24;
      const minuteRatio = minutes / 60;
      const secondRatio = seconds / 60;

      const maxWidth = 470;

      document.getElementById("hour-label").textContent = hours.toString().padStart(2, "0");
      document.getElementById("minute-label").textContent = minutes.toString().padStart(2, "0");
      document.getElementById("second-label").textContent = seconds.toString().padStart(2, "0");

      document.getElementById("hour-bar").style.width = `${hourRatio * maxWidth}px`;
      document.getElementById("minute-bar").style.width = `${minuteRatio * maxWidth}px`;
      document.getElementById("second-bar").style.width = `${secondRatio * maxWidth}px`;
    }

    setInterval(updateClock, 1000);
    updateClock(); // első futtatás
  </script>
    
</body>
</html>




