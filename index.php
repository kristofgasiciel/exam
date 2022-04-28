<!DOCTYPE html>
<html lang="en">
<head>
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
$sql = "Select imagefile, name, author from images";
$result = $conn->query($sql);
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="utf-8">
    <title> KRZYSZTOF CONSTRUCTION </title>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1>W trakcie tworzenia</h1>
    <?php
    echo "Teraz mamy: " . date("Y-m-d h:i:sa");
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo 'name: ' . $row["name"]. ' author:' . $row["author"] . '<br>' . '<img src="images/' . $row["imagefile"] . '">' . '<br>';
        }
      } else {
        echo "0 results";
      }
    ?>
</body>
</html>