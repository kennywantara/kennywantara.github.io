
<?php

function getPixelIterator2($key1,$key2,$iterMax,$imagePath)
{
    $inverseH = reverse_integer($key1);
    $inverseH2 = reverse_integer($key2);
    $im = imagecreatefrompng($imagePath);
    $temp2 = imagecreatefrompng($imagePath);
    $tempt = imagecreatefrompng($imagePath);
    $height = imagesx($im);
    $width = imagesy($im);

    for($iter = 0; $iter < $iterMax; $iter++){
         $temp = 0;
   $totalelementperrow = array();
   $totalelementpercolumn = array();
   for($x = 0; $x < $height;$x++){
        for ($y = 0; $y < $width/2; $y++)
        {
            $newX = 2 * $y  - 1;
            if($newX < 0){
                $newX++;
            }
            $newX2 =  2 * $y;
            $rgb = imagecolorat($temp2, $x, $newX);
            $rgb2 = imagecolorat($temp2, $x, $newX2);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $a = $rgb & 0xFF000000;

            $r2 = ($rgb2 >> 16) & 0xFF;
            $g2 = ($rgb2 >> 8) & 0xFF;
            $b2 = $rgb2 & 0xFF;
            $a2 = $rgb2 & 0xFF000000;

            $myRed = $r ^ $key2;
            $myGreen =  $g ^$key2;
            $myBlue =  $b ^ $key2;
            $myRed2 = $r2 ^$inverseH2;
            $myGreen2 =  $g2 ^$inverseH2;
            $myBlue2 =  $b2 ^ $inverseH2;
            $newColor2 =  $myRed2 << 16 | $myGreen2 << 8 | $myBlue2; 
            $newColor =  $myRed << 16 | $myGreen << 8 | $myBlue;
            imagesetpixel($temp2, $x, $newX, $newColor );
            imagesetpixel($temp2, $x, $newX2, $newColor2 );
            imagesetpixel($tempt, $x, $newX, $newColor );
            imagesetpixel($tempt, $x, $newX2, $newColor2 );
        }
     }
     //imagepng($temp2,"decript.png");
    for($x = 0; $x < $height;$x++){
        for ($y = 0; $y < $width/2; $y++)
        {
            $newX = 2 * $y  - 1;
            if($newX < 0){
                $newX++;
            }
            $newX2 =  2 * $y;
            $rgb = imagecolorat($temp2, $newX, $x);
            $rgb2 = imagecolorat($temp2, $newX2, $x);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $a = $rgb & 0xFF000000;

            $r2 = ($rgb2 >> 16) & 0xFF;
            $g2 = ($rgb2 >> 8) & 0xFF;
            $b2 = $rgb2 & 0xFF;
            $a2 = $rgb2 & 0xFF000000;

            $myRed = $r ^ $key1;
            $myGreen =  $g ^$key1;
            $myBlue =  $b ^ $key1;
            $myRed2 = $r2 ^$inverseH;
            $myGreen2 =  $g2 ^$inverseH;
            $myBlue2 =  $b2 ^ $inverseH;
            $newColor2 =  $myRed2 << 16 | $myGreen2 << 8 | $myBlue2; 
            $newColor =  $myRed << 16 | $myGreen << 8 | $myBlue;
            imagesetpixel($temp2, $newX, $x, $newColor );
            imagesetpixel($temp2, $newX2, $x, $newColor2 );
            imagesetpixel($tempt, $x, $newX, $newColor );
            imagesetpixel($tempt, $x, $newX2, $newColor2 );
        }
    }
    //imagepng($temp2,"decript1.png");
    $temp = 0;
    for ($x = 0; $x < $height; $x++)
    {
        for ($y = 0; $y < $width; $y++)
        {
             $rgb = imagecolorat($temp2, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $temp = $temp + $r+$g+$b;
        }
        $totalelementpercolumn[] = $temp;
        $temp = 0 ;
    }
    //var_dump("yey");
    // var_dump($totalelementpercolumn);

    for ( $x = 0; $x < $height; $x++)
    {
        for ($y = 0; $y < $width; $y++)
        {
            $tempY = 0;
            if($totalelementpercolumn[$x]%2 == 0 ){
                if($key2>$y){
                    $tempY = $y + 512 - $key2;
                }
                else{
                    $tempY = $y - $key2;
                }
            }
            else {
                $tempY = $y + $key2;
            }
            if($tempY > 511){
                    $tempY = $tempY-512;
            }
            $c = imagecolorat($temp2, $x, $tempY);
            imagesetpixel($tempt, $x, $y, $c );
        }
    }
       //imagepng($tempt,"decript2.png");
    $temp = 0;
    for ($x = 0; $x < $height; $x++)
    {
        for ($y = 0; $y < $width; $y++)
        {
             $rgb = imagecolorat($tempt, $y, $x);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $temp = $temp + $r+$g+$b;
        }
        $totalelementperrow[] = $temp;
        $temp = 0;
    }
    for ($x = 0; $x < $height; $x++){
        for ($y = 0; $y < $width; $y++)
        {
            $tempY = 0;
            if($totalelementperrow[$x]%2 != 0 ){
                $tempY = $y +$key1;
            }
            else if($key1>$y){
                $tempY = $y + 512 - $key1;
            }
            else{
                $tempY = $y - $key1;
            }
            if($tempY > 511){
                    $tempY = $tempY-512;
                 }
             $c = imagecolorat($tempt, $tempY, $x);
            imagesetpixel($im, $y, $x, $c );
        }
    }
    imagepng($im,"DecryptedImage.png");
    $imagePath = __DIR__ . DIRECTORY_SEPARATOR ."DecryptedImage.png";
    $im = imagecreatefrompng($imagePath);
    $temp2 = imagecreatefrompng($imagePath);
    $tempt = imagecreatefrompng($imagePath);
    }
   
}

    
    // $imagick = new \Imagick(realpath($imagePath));
    // $imageIterator = $imagick->getPixelIterator();

    // foreach ($imageIterator as $row => $pixels) { /* Loop through pixel rows */
    //     foreach ($pixels as $column => $pixel) { /* Loop through the pixels in the row (columns) */
    //         * @var $pixel \ImagickPixel 
    //         if ($row % 2) {
    //             $pixel->setColor("rgba(0, 0, 0, 0)"); /* Paint every second pixel black*/
    //         }
    //     }
       
    //     $imageIterator->syncIterator(); /* Sync the iterator, this is important to do on each iteration */
    // }


    // header("Content-Type: image/jpg");
    // echo $imagick;

function reverse_integer($n)
{
    $result = 0;
    for($i= 0; $i<8; $i++)
        {
            $result <<= 1;
            $result|= ($n & 1);
            $n >>= 1;
        }
        return $result;

} 

if(isset($_POST["submit"])){
       if($imageFileType != "png"){
        $message = " Image Must Be In PNG Format";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    // else if($_POST["IterMax"] < 1){
    //     $message = " The number must be bigger than 0'";
    //     echo "<script type='text/javascript'>alert('$message');</script>";
    // }
    // else if(( $_POST["Key1"] > 255) || ($_POST["Key2"] > 255)){
    //     $message = " The number must be between 0 and 255'";
    //     echo "<script type='text/javascript'>alert('$message');</script>";
    // }
    else{
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"],$target_file);
    getPixelIterator2($_POST["Key1"],$_POST["Key2"],$_POST["IterMax"],__DIR__ . DIRECTORY_SEPARATOR ."upload/".basename( $_FILES["image"]["name"]));  
    }  
}
?>

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
  <h1>Decryption Result</h1>
</div>
    Decrypted Image
    <img src="<?php echo 'DecryptedImage.png' ?>" style="width:300px;height:300px;"/>
  </br>
  </br>
  <a href="DecryptedImage.png" download>Download </a>
</div>
</body>
</html>
