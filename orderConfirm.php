<? php

extract($_POST);

//create a database connection.
$link = mysqli_connect("swmonkcom.ipagemysql.com", "swmonk", "cmpe285", "sportshop");
if($link === false){
    die("ERROR: Could not connect to database <br><br> " . mysqli_connect_error());
}
//echo 'Connected to DB';
$total = 0;


$txt = (array) $_POST['Quantity'];
if(!empty($_POST['Buy']) && $txt) {
    $check = (array) $_POST['Buy'];
    foreach($check as $b) {
        $sql1 = "SELECT * FROM product where prod_id = $b";
        if($result1 = mysqli_query($link, $sql1)) {      
            if(mysqli_num_rows($result1) > 0) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Product Name</th>';
                echo '<th>Quantity</th>';
                echo '<th>Price</th>';
                echo '<tr>';
                while($row = mysqli_fetch_array($result1)) {
                    foreach($txt as $t) {
                        if($t != 0) {
                            echo '<tr>';
                            echo '<td>' . $row['prod_name'] . '</td>';
                            echo '<td>' . $t . '</td>';
                            $var = $row['price'] * $t;
                            echo '<td>' . $var . '</td>';
                            echo '</tr>';
                            $total += $var;
                            break;
                        }
                    }
                }  
                echo '</table>'; 
                // Close result set
                mysqli_free_result($result);
            } else {
                echo "No records matching your query were found.";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
    echo '<br>Total Price :: ' . $total; 
} 

mysqli_close($link);

echo '<br><br><input type="submit" value="Confirm Order"/>';

?>