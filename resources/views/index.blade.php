<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://use.fontawesome.com/f1a5474be5.js"></script>
    <meta name="csrf-token" content="jiEtF7Kld6xOlzoj8M5eaZMR9f2U4r7FHGGk3xSAbRA">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/indexPage.css">
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
                {{ csrf_field() }}
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
    {{--function validateForm()--}}
    {{--{--}}
        {{--var x=document.forms["myForm"]["login"].value;--}}
        {{--var atpos=x.indexOf("@");--}}
        {{--var dotpos=x.lastIndexOf(".");--}}
        {{--if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)--}}
        {{--{--}}
            {{--window.location.href = "http://"+ a.innerHTML +"/error.php";--}}
            {{--return false;--}}
        {{--}--}}
    {{--}--}}
</script>
</body>
</html>