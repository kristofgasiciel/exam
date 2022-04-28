<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = 'INSERT INTO author (first_name, last_name, date_of_birth, email) VALUES (?, ?, ?, ?)';
require('vendor/autoload.php');

$faker = Faker\Factory::create();

function camel_to_snake($input)
{
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
}
function limit_words($text, $limit) {
  $words = explode(" ",$text);
  return implode(" ",array_splice($words,0,$limit));
}

for ($i=0; $i < 20; $i++){
$name = limit_words($faker->name(),2);
$picsum_id = rand(1, 1000);
$url = "https://picsum.photos/id/" . $picsum_id . "/info";
$metas = file_get_contents($url);
$metas = json_decode($metas, true);
$author = $metas['author'];
$width = $metas['width'];
$height = $metas['height'];
$imagefile = camel_to_snake($name).".jpg";
$img = $metas['download_url'];
$path = "images/". $imagefile;
file_put_contents($path, file_get_contents($img));
$added_at = date("Y-m-d h:i:sa");
/*echo "<pre>"; print_r($metas); echo "</pre>";*/
$sql = "INSERT INTO images (name, picsum_id, imagefile, author, width, height, added_at)VALUES ('$name', '$picsum_id', '$imagefile', '$author', '$width', '$height', '$added_at')";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>