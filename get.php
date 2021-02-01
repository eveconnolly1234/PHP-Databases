
<?php
$host = 'localhost';
$dbname= 'classicmodels';
$username = 'root';
$password='';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$prodLine = $_GET["productLine"];
echo "<h2>More Information:</h2>";

$sql = "SELECT productCode, productName, productLine, productScale, productVendor, productDescription, quantityInStock, buyPrice, MSRP FROM products WHERE productLine='$prodLine'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>"."Product Code"."</th><th>"."Product Name"."</th><th>"."Product Line"."</th><th>"."Product Scale"."</th><th>"."Product Vendor"."</th><th>"."Product Description"."</th><th>"."Quantity in Stock"."</th><th>"."Buy Price"."</th><th>"."MSRP"."</th>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row["productCode"]."</td><td>". $row["productName"]."</td><td>". $row["productLine"]."</td><td>". $row["productScale"]."</td><td>". $row["productVendor"]."</td><td>". $row["productDescription"]."</td><td>". $row["quantityInStock"]."</td><td>". $row["buyPrice"]."</td><td>". $row["MSRP"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Zero results";
}

?>
