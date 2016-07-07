<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
</head>
<body>

<? php
//extract Form data
extract($_POST);

//create a database connection.
$link = mysqli_connect("swmonkcom.ipagemysql.com", "swmonk", "cmpe285", "sportshop");
if($link === false){
    die("ERROR: Could not connect to database <br><br> " . mysqli_connect_error());
}
//echo 'Connected to DB';

$seller_id =mysqli_real_escape_string($link, $_SESSION['s_id']);
$prod_name =mysqli_real_escape_string($link, $_POST['prod_name']);
$prod_desc =mysqli_real_escape_string($link, $_POST['prod_desc']);
$price = mysqli_real_escape_string($link,$_POST['price']);
if (isset($_FILES["uploadFile"]))
{
    $file = $_FILES["uploadFile"]["tmp_name"];
    if (!isset($file)) {
        echo '<font color="red">Please select a file to upload!</font>';
    } else {
        $image = $_FILES['uploadFile']['tmp_name'];
        $uploadOk = 1;
    }
}
    
$check = getimagesize($_FILES["uploadFile"]["tmp_name"]);
if($check !== false) {
    $uploadOk = 1;
} else {
    $uploadmsg = '<font color="red">File is not an image.</font>';
	$uploadOk = 0;
}

// Check file size
if ($_FILES["uploadFile"]["size"] > 500000) {
    $uploadmsg = '<font color="red">Sorry, your Image is too large.</font>';
	$uploadOk = 0;
}

if($uploadOK == 0) {
    echo '<font color="red"><strong>Sorry, your file was not uploaded.</strong></font>';
    echo '<br><br><a href="http://www.swmonk.com/sellerlogin/">Login again to upload</a>';
} else {
    $image = addslashes(file_get_contents($image));

    $sql1 = "SELECT * FROM seller WHERE seller_id = '$seller_id'";
    if($result1 = mysqli_query($link, $sql1)) {
        if(mysqli_num_rows($result1) > 0) {
    	   echo '<br><br>';
    	   $sql2 = "INSERT INTO product (prod_name, seller_id, image, price, prod_desc ) 
    		  VALUES ('$prod_name', '$seller_id', '$image', '$price', '$prod_desc')";
    	   $result2 = mysqli_query($link, $sql2);
    	   if($result2) {
                echo $seller_id . '<font color="green"><strong> Your product has been uploaded successfully!</strong></font><br><br>';
		   }
		  else {
		      	echo '<font color="red"><strong>Oops! Looks like there is a problem at this time. Please try again later!</strong></font> <br><br>' ;
		    }
	   }
	   else {
		  echo '<font color="red"><strong>Only a registered seller can sell products! <em><u>' . $seller_id . '</u></em> </strong></font> is not a registered user<br><br>' . mysqli_error($link);
        }
    }
    mysqli_free_result($result1);
}

//close the database connection
mysqli_close($link);

?>
</script>
</body>
</html>