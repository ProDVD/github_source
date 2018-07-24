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
    <style>
        body
        {
            background: url(../image/romb.png);
        }
        .curtainN
        {
            height: 100vh;
        }
        .centralArea
        {
            width:500px;
            height: auto;
            border:9px solid #E8E8E8;
            border-radius: 8px;
        }
        .header
        {
            font-size:38px;
            font-weight: 600;
            background: #f3f3f3;
            height:75px;
            margin:auto;
            border-bottom:2px solid grey;
        }
        .input-group
        {
            width:95%;
            margin:auto;
        }
        .input-group-text
        {
            border-radius: 5px;
        }
        .formArea
        {
            padding:15px 0 15px 0 ;
            background: #FFFFFF;
        }
        .buttonArea
        {
            width: 95%;
            margin: auto;
        }
        .btn22
        {
            width:100%;
            font-size: 22px;
            font-weight: 600;
        }
        .g-recaptcha {
            margin: 12px;
        }
        .forgotPass {
            display: flex;
            justify-content: flex-end;
            width: 100%;
            padding: 10px 25px 10px 25px;
            margin: 10px;
        }
        .login input[type=text], .login input[type=password] {
            height: 40px;
            width: 100%;
            font-size: 20px;
        }
        :-moz-placeholder {
            color: #c9c9c9 !important;
            font-size: 13px;
        }

        ::-webkit-input-placeholder {
            color: #ccc;
            font-size: 13px;
        }

        .input-group {
            font-family: 'Lucida Grande', Tahoma, Verdana, sans-serif;
            font-size: 14px;
        }

        .input-group[type=text], .input-group[type=password] {
            margin: 5px;
            padding: 0 10px;
            width: 200px;
            height: 34px;
            color: #404040;
            background: white;
            border: 1px solid;
            border-color: #c4c4c4 #d1d1d1 #d4d4d4;
            border-radius: 2px;
            outline: 5px solid #eff4f7;
            -moz-outline-radius: 3px;
            -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
        }
        .input-group[type=text]:focus, .input-group[type=password]:focus {
            border-color: #7dc9e2;
            outline-color: #dceefc;
            outline-offset: 0;
        }

        .input-group[type=submit] {
            padding: 0 18px;
            height: 29px;
            font-size: 12px;
            font-weight: bold;
            color: #527881;
            text-shadow: 0 1px #e3f1f1;
            background: #cde5ef;
            border: 1px solid;
            border-color: #b4ccce #b3c0c8 #9eb9c2;
            border-radius: 16px;
            outline: 0;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            background-image: -webkit-linear-gradient(top, #edf5f8, #cde5ef);
            background-image: -moz-linear-gradient(top, #edf5f8, #cde5ef);
            background-image: -o-linear-gradient(top, #edf5f8, #cde5ef);
            background-image: linear-gradient(to bottom, #edf5f8, #cde5ef);
            -webkit-box-shadow: inset 0 1px white, 0 1px 2px rgba(0, 0, 0, 0.15);
            box-shadow: inset 0 1px white, 0 1px 2px rgba(0, 0, 0, 0.15);
        }
        .input-group[type=submit]:active {
            background: #cde5ef;
            border-color: #9eb9c2 #b3c0c8 #b4ccce;
            -webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
            box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
        }
        .checkBox {
            margin: 15px;
            padding: 5px;
        }
        #demo1, #demo2 {
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="curtainN d-flex align-items-center justify-content-center">
    <div class="centralArea">
        <div class="header d-flex align-items-center justify-content-center">
            <div class="labelInfo">
                <p>Enter login info</p>
            </div>
        </div>
        <div class="formArea">
            <form method="post" name="myForm" action="/switcher" onsubmit="validateForm();">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Email" id="demo1" name="email" >
                    <div class="input-group-append">
                    <!-- <span class="input-group-text">@example.com</span> -->
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="demo2" name="password" >
                    <div class="input-group-append">
                    </div>
                </div>
                <div class="forgotPass">
                    <a href="/password.php">Forgot your password?</a>
                </div>
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
            window.location.href = "http://"+ a.innerHTML +"/error.php";
            return false;
        }
    }
</script>
</body>
</html>