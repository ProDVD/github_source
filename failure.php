<?
setcookie('uniqueID' , '');
setcookie('email' , '');
setcookie('flag' , '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
<script src="https://use.fontawesome.com/f1a5474be5.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
     <link rel="stylesheet" href="css/indexPage.css">
</head>
<body>
<div class="curtainN d-flex align-items-center justify-content-center">
<div class="centralArea">
<div class="header d-flex align-items-center justify-content-center">
	<div class="labelInfo">
	<p>Password recovery</p>
	</div>
</div>
<div class="formArea">
<form method="post" name="myForm" action="switcher.php" onsubmit="return validateForm();">
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Email" id="demo1" name="login">
  <div class="input-group-append">
    <!-- <span class="input-group-text">@example.com</span> -->
  </div>
</div> 
<div class="checkBox">
<input style="width: 20px;height:20px" type="checkbox" name="isChecked" >
I'm not a robot
</div>
<!-- <div class="g-recaptcha" data-sitekey="6LcCymMUAAAAAKYIzVbCeTA0BG9bNLA5XWUDFtt6"></div> -->
<p class="text-center x" style="color: red; font-weight: 700; font-size: 24px">Email validation failed</p>
<div class="buttonArea">
<button class="btn btn-primary btn22">OK</button>
</div>

</form> 
</div>
</div>
</div>

<script>
var a =document.getElementById('1000');
	function validateForm()
{
	var x=document.forms["myForm"]["login"].value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  window.location.href = "/failure.php";
  return false;
  }
}
	</script>
</body>
</html>