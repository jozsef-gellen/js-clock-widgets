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
    <div id="englishTime"></div>
  </div>
  <script>
    function englishTimeDescription() {
  const date = new Date();
  let hour = date.getHours();
  const minute = date.getMinutes();

  let period = ""; // in the morning / afternoon / evening
  if (hour < 12) {
    period = "in the morning";
  } else if (hour < 18) {
    period = "in the afternoon";
  } else {
    period = "in the evening";
  }

  // Convert to 12-hour format
  let hour12 = hour % 12;
  if (hour12 === 0) hour12 = 12;
  let nextHour12 = (hour12 % 12) + 1;

  let description = "";

  if (minute === 0) {
    description = `${hour12} o'clock ${period}`;
  } else if (minute === 15) {
    description = `quarter past ${hour12} ${period}`;
  } else if (minute === 30) {
    description = `half past ${hour12} ${period}`;
  } else if (minute === 45) {
    description = `quarter to ${nextHour12} ${period}`;
  } else if (minute < 30) {
    description = `${minute} past ${hour12} ${period}`;
  } else {
    description = `${60 - minute} to ${nextHour12} ${period}`;
  }

  return description;
}
function updateEnglishTime() {
    document.getElementById("englishTime").innerText = englishTimeDescription();
  }

  updateEnglishTime(); 
  setInterval(updateEnglishTime, 60000); // percenként frissít
  </script>
</body>
</html>

