<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
</head>
<body>
<p style="color:#CC0099; align:center">Upload Product Information</p>   
<form action="http://www.swmonk.com/upload/" method="POST" enctype="multipart/form-data" accept="image/gif, image/jpeg">
<br><br><br><br>
<label for="seller_id">Seller ID</label>&nbsp;&nbsp;&nbsp;&nbsp;
<?
if(isset($_SESSION['s_id'])) {
      echo "<input type='text' id='id' value='" . htmlspecialchars($_SESSION['s_id']) . "'/>";
} else {
      echo 'Session problem! Please login again!';
      echo '<br><br><a href="/sellerlogin">Login Again</a>';
}
?>
<br><br>
<label for="prod_name">Product Name</label>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" id="prod_name" name="prod_name" autofocus required/>
<br><br>
<label for="prod_desc">Product Description</label>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" id="prod_desc" name="prod_desc" autofocus required/>
<br><br>
<label for="price">Price in $</label>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" id="price" name="price" autofocus required/>
<br><br>
<label for="uploadFile">Select product image to upload</label>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="file" name="uploadFile" id="uploadFile">
<br><br>
<input type="submit" value="Upload" />
<br><br><br><br>
</form>

</body>
</html>