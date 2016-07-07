[insert_php]
session_start();

//create a database connection.
$link = mysqli_connect("swmonkcom.ipagemysql.com", "swmonk", "cmpe285", "sportshop");
if($link === false){
    die("ERROR: Could not connect to database <br><br> " . mysqli_connect_error());
}

date_default_timezone_set('America/Los_Angeles');
$dateVal = date('Y-m-d');

$id = $_SESSION['b_id'];
 echo $id; 

foreach($_SESSION['prod'] as $key=>$value) {
  $sql1 = "SELECT * FROM product WHERE prod_id = $value";
  if($result1 = mysqli_query($link, $sql1)) { 
    if(mysqli_num_rows($result1) > 0) {
      while($row = mysqli_fetch_array($result1)) {
        foreach($_SESSION['quantity'] as $k=>$v) {
          if($v != 0 || $v!= NULL) {
            $name = $row['prod_name'];
            echo $name . '&nbsp;&nbsp;' . $v . '<br>';
            $sql3 = "INSERT INTO purchase_history (userid, purchase_date, quantity, prod_name) VALUES ('$id','$dateVal', '$v', '$name')";
            if(mysqli_query($link, $sql3)) { 
              echo 'Hi ' . $_SESSION['b_id'] . '<br><font color="green"><strong> Your order is placed successfully!<br> You will receive an email from us shortly</strong></font>';
            } else {
              echo '<font color="red"><strong>ERROR: Could not execute the query' . mysqli_error($link) . '</strong></font>';
            }
            break;
          } else {
              echo '<font color="red"><strong>Quantity cannot be empty! Please go back and try again with valid quantity!</strong></font>';
          }
        }
      } 
      //free the result set
      mysqli_free_result($result1);
    } else {
        echo '<font color="red"><strong>No  matching records were found.</strong></font>';
    }
  } else {
              echo '<font color="red"><strong>ERROR: Could not execute the query' . mysqli_error($link) . '</strong></font>';
  }
}


//close the database connection
mysqli_close($link);

echo '<br><br><a href="/logout">Logout</a>';



[/insert_php]