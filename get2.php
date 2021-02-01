
<?php
$host = 'localhost';
$dbname= 'classicmodels';
$username = 'root';
$password='';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ordNum = $_GET["orderNumber"];
echo "<h2>Further information Order Number:".$ordNum."</h2>";
 

$sql = "SELECT orders.orderNumber, orders.orderDate, products.productCode, products.productLine, orders.status, orders.comments, products.productName FROM orders, products, orderdetails WHERE orders.orderNumber='$ordNum' and orders.orderNumber=orderdetails.orderNumber and products.productCode=orderdetails.productCode";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>"."Order Number"."</th><th>"."Order Date"."</th><th>"."Product Code"."</th><th>"."Product Line"."</th><th>"."Status"."</th><th>"."Comments"."</th><th>"."Product Name"."</th>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["orderNumber"]."</a></td><td>".$row["orderDate"]."</td><td>".$row["productCode"]."</td><td>".$row["productLine"]."</td><td>".$row["status"]."</td><td>".$row["comments"]."</td><td>".$row["productName"]."</td></tr>";

    }
    echo "</table>";
} else {
    echo "Zero results";
}

?>
