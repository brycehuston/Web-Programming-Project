
<!--- Name: Bryce Huston
      ID: 30003673
      Date: 19-09-2019
      Task: Final Project
--->

<?php

// Initialize the image object and some colours
$im        = imagecreate(900, 600);
$red       = imagecolorallocate ($im,255,0,0);
$black 	   = imagecolorallocate ($im,0,0,0);
$gray_dark = imagecolorallocate ($im,169,169,169);
$white     = imagecolorallocate ($im,255,255,255);

// Make the image white
imagefilledrectangle($im, 0, 0, 900, 600, $white);
$colour = imagecolorallocate($im, 0, 0, 0);
// Setup PDO injection
require"connect.php";
$query = "SELECT * FROM `movies` ORDER BY `movies`.`searches` DESC";
try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    // Draw the graphs onto the image
    for ($i=0;$i<10;$i++) {
        $row = $stmt->fetch();
        $column_height = (600 / 100) * (( $row['searches'] / 100) *100);
        $x1 = $i*90;
        $y1 = 600-$column_height;
        $x2 = (($i+1)*90)-5;
        $y2 = 600;
        imagefilledrectangle($im, $x1, $y1, $x2, $y2, $red);
        imagestring($im, 1, $x1, $y1, $row['Title'], $colour);
    }
} catch (Exception $e) {
    echo "No results were found.";
    echo "<p><a href='index.html'>Go Back</a></p>";
    return;
}
header("Content-type: image/png");
imagepng($im);
?>
