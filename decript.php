<!DOCTYPE html>
<html>
<title>Skripsi</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item">Menu</h3>
  <a href="index.php" class="w3-bar-item w3-button">Encryption</a>
  <a href="decript.php" class="w3-bar-item w3-button">Decryption</a>
</div>
<div style="margin-left:25%">
<div class="w3-container ">
  <h1>Decryption</h1>
</div>
<form  action="decryption.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="image" id="image">
  </br>
  </br>
    Number Of Iteration:
    <input type="number" name="IterMax" id="IterMax">

    </br>
  </br>
    First Key:
    <input type="number" name="Key1" id="Key1">

    </br>
  </br>
    Second Key:
    <input type="number" name="Key2" id="Key2">

    <input type="submit" value="Encrypt" name="submit">
</form>
</div>
</body>
</html>

