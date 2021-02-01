<!DOCTYPE html>
<html lang="en">
<head>
	<title>Assignment3</title>
<meta name="viewport" content="width=device-width">
<meta charset="UTF-8">


    <link rel = stylesheet type = "text/css"
          href = "style-sheet.css">
</head>
    <body>

    <?php
     readfile("nav_bar.txt");   
    ?>
<?php
$host = 'localhost';
$dbname= 'classicmodels';
$username = 'root';
$password='';
// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT customerName, country, city, phone FROM customers ORDER BY country";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<h2>Customer Information</h2>";
    echo "<table><tr><th>Name</th><th>City</th><th>Country</th><th>Phone</th></tr>";
    while($row = $result->fetch_assoc()) {
        
       echo "<tr><td>".$row["customerName"]."</td><td>".$row["city"]."</td><td>".$row["country"]."</td><td>".$row["phone"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();

?>
        
    </body>

    <?php
     readfile("footer.txt");   
    ?>
</html>