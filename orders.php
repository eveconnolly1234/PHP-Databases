<!DOCTYPE html>
<html lang="en">

<head>
    <title>Assignment3</title>
    <meta name="viewport" content="width=device-width">
    <meta charset="UTF-8">

    <link rel=stylesheet type="text/css" href="style-sheet.css">

</head>

<body>

    <?php
     readfile("nav_bar.txt");   
    ?>
    <div id='moreInfo'>
    </div>
    <p>Please click Order Number for further information</p>
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

$sql1 = "SELECT orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber FROM orders WHERE status= 'In Process'";
$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<h3>All orders currently In Process</h3>";
    echo "<table><tr><th>Order Number</th><th>Order Date</th><th>Status</th></tr>";
    while($row = $result->fetch_assoc()) {
       echo "<tr><td><a id='orderNumber' href='javascript:void(0)' onclick='showMore(".$row["orderNumber"].")'>".$row["orderNumber"]."</a></td><td>".$row["orderDate"]."</td><td>".$row["status"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}




$sql2 = "SELECT orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber FROM orders WHERE status='Cancelled'";
$result = $conn->query($sql2);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<h3>All Cancelled Orders</h3>";
    echo "<table><tr><th>Order Number</th><th>Order Date</th><th>Status</th></tr>";
    while($row = $result->fetch_assoc()) {
       echo "<tr><td><a id='orderNumber' href='javascript:void(0)' onclick='showMore(".$row["orderNumber"].")'>".$row["orderNumber"]."</a></td><td>".$row["orderDate"]."</td><td>".$row["status"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}



$sql3 = "SELECT orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber FROM orders ORDER BY orderDate DESC limit 20";
$result = $conn->query($sql3);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<h3>The 20 most recent orders</h3>";
    echo "<table><tr><th>Order Number</th><th>Order Date</th><th>Status</th></tr>";
    while($row = $result->fetch_assoc()) {
       echo "<tr><td><a id='orderNumber' href='javascript:void(0)' onclick='showMore(".$row["orderNumber"].")'>".$row["orderNumber"]."</a></td><td>".$row["orderDate"]."</td><td>".$row["status"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


$conn->close();
?>

    <script>
        function showMore(orderNumberSelection) {

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("this: " + this.responseText)
                    document.getElementById("moreInfo").innerHTML = this.responseText;
                }
            };

            console.log('orderNumber', orderNumberSelection);

            xmlhttp.open("GET", "get2.php?orderNumber=" + orderNumberSelection, true);
            xmlhttp.send();
        }

    </script>


</body>
    
    <?php
     readfile("footer.txt");   
    ?>

</html>
