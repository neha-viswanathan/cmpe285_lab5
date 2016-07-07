<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
</head>
<body>
<form action="/confirmorder" method="post">
<? php
//create a database connection.
$link = mysqli_connect("swmonkcom.ipagemysql.com", "swmonk", "cmpe285", "sportshop");
if($link === false){
    die("ERROR: Could not connect to database <br><br> " . mysqli_connect_error());
}
if(isset($_SESSION['b_id'])) {
      echo 'Hi ' . $_SESSION['b_id'];
      echo '<br><br><h3>Are you ready to start shopping?</h3>';
} else {
      echo 'Session problem! Please login again!';
      echo '<br><br><a href="/buyerlogin">Login Again</a>';
}

//echo 'Connected to DB';
$sql1 = "SELECT * FROM product";
$sql2 = "SELECT * FROM seller";
if($result1 = mysqli_query($link, $sql1)){
    if(mysqli_num_rows($result1) > 0){
        echo "<table>";
        echo "<tr>";
        echo "<th>Product Name</th>";
        echo "<th>Product Description</th>";
        echo "<th>Price in $</th>";
        echo "<th>Image</th>";
        echo "<th>Seller</th>";
        echo "<th>Add to Cart</th>";
        echo "</tr>";
        while($row1 = mysqli_fetch_array($result1)) {
            echo "<tr>";
            echo "<td>" . $row1['prod_name'] . "</td>";
            echo "<td>" . $row1['prod_desc'] . "</td>";
            echo "<td>" . $row1['price'] . "</td>";
            echo '<td><img src="data:image/jpeg;base64,'. base64_encode($row1['image']) .'"/></td>';    
            //$sql2 = "SELECT seller_name FROM seller WHERE seller_id = $row1['seller_id']";    
            if($result2 = mysqli_query($link, $sql2)) {
                if(mysqli_num_rows($result2) > 0) {
                    while($row2 = mysqli_fetch_array($result2)) {
                        if($row1['seller_id'] === $row2['seller_id']) {
                            echo "<td>" . $row2['seller_name'] . "</td>";
                        }
                    }
                } else {
                    echo "No sellers were found.";
                }
            } else {
                echo '<font color="red"> ERROR: Unable to execute $sql. </font>' . mysqli_error($link);
            }
            echo '<td><input type="checkbox" name="Buy[]" value="' . $row1['prod_id'] .'">Buy<br>';
            echo '<input type="text" name="Quantity[]" placeholder="0"/></td>';
            echo "</tr>";
        }
        echo "</table>";
        // Close result set
        mysqli_free_result($result1);
        mysqli_free_result($result2);
    } else {
        echo "No products were found.";
    }
} else {
    echo '<font color="red"> ERROR: Unable to execute $sql. </font>' . mysqli_error($link);
}
echo '<p>Note: Images have been used for representational purpose <strong><em><u>ONLY</u></em></strong>. Actual size and/or color may vary.</p>';  
echo '<br><br><input type="submit" value="Place Order"/>';
?>
</form>
<br><br>
</body>
</html>
