<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cars</title>
<meta name="viewport" content="width=device-width">
<meta charset="UTF-8">

    <link rel = stylesheet type = "text/css"
          href = "style-sheet.css">


</head>
   
    <body>

    <?php
     readfile("nav_bar.txt");   
    ?>
        
  <div id='form'>
   <form>   
    <select name="productLine" id="productLine" onchange=OnSelectionChange()>
        <option value="" disabled selected>--select--</option>
        <option value="Classic\ Cars">Classic Cars</option>
        <option value="Motorcycles">Motorcycles</option>
        <option value="Planes">Planes</option>
        <option value="Ships">Ships</option>
        <option value="Trains">Trains</option>
        <option value="Trucks\ and\ Buses">Trucks and Buses</option>
        <option value="Vintage\ Cars">Vintage Cars</option>
    </select>

</form>
      </div>      


        <div id="results"></div>
        
<h2>Product Lines Available</h2>        
<?php
//CREATES TABLE OF ALL PRODUCTS 
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

$sql = "SELECT productLine, textDescription FROM productlines";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
echo "<table><tr><th>"."Product"."</th><th>"."Decsription"."</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row["productLine"]."</td><td>". $row["textDescription"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();

?>  
        
<script>
function OnSelectionChange(){
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         //console.log("this: "+this.responseText)   
document.getElementById("results").innerHTML=this.responseText;
      }
    };
    
    var productLineSelection = document.getElementById('productLine').value;
    //console.log("productLineSelection: "+productLineSelection);
    xmlhttp.open("GET", "get.php?productLine=" + productLineSelection, true);
    xmlhttp.send();
  }
     

</script>

   
</body>
    
    <?php
     readfile("footer.txt");   
    ?>
</html>