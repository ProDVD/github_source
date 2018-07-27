<!DOCTYPE html>
<head lang="en">
    <meta charset="UTF-8">
    <title>ProDVD Cloud</title>
    <meta name="csrf-token" content="jiEtF7Kld6xOlzoj8M5eaZMR9f2U4r7FHGGk3xSAbRA">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=1366px,scale=0.4, user-scalable=yes">
    <script src="https://use.fontawesome.com/f1a5474be5.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <? switch( $browserAnalyzer) : case 0 : ?>
    <link rel="stylesheet" href="/css/userDoc.css">
    <script defer src="/js/Index.js"></script>
    <? break; case 1 : ?>
    <link rel="stylesheet" href="/css/userDoc.css">
    <script defer src="/js/IndexForIOS.js"></script>
    <? break; case 2 : ?>
    <link rel="stylesheet" href="/css/all-ie-only.css">
    <script defer src="/js/Index.js"></script>
    <? break; endswitch; ?>
</head>
<body>
<div class="curtain">
    <span class="fa fa-undo rotateSpan" style="font-size: 350px"></span>
    <span style="font-size: 40px">PLEASE ROTATE DEVICE TO LANDSCAPE MODE </span>
</div>
<div class="generalBox">
    <div class="topPanel">
        <a class="logo">ProDVD Cloud</a>
        <div class="logOutUs">
            <div class="emailUser text-lowercase">
                <?//= $_COOKIE['email']?>
            </div>
            <a href="/" id="logOutUser" class="logOut">Log Out
                <span class=" fa fa-sign-out"></span>
            </a>
        </div>
    </div>
    <div class="twoLineBox">
        <div class="label">
            <!-- <span class="fa fa-bars"></span> -->
            <span>My sessions:</span>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active show" id="home-tab" data-toggle="tab" href="#all" role="tab" aria-controls="home" aria-selected="true">
                    <span class=" fa fa-folder-open"></span> All files</a>
                <a class="nav-item nav-link" id="contact-tab" data-toggle="tab" href="#video" role="tab" aria-controls="contact" aria-selected="false">
                    <span class="fa fa-play-circle"></span> Video</a>
                <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#photo" role="tab" aria-controls="profile" aria-selected="false">
                    <span class=" fa fa-camera"></span> Photo</a>

            </div>
        </nav>
    </div>
    @yield('content')
</div>
<div id="modalphoto" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" id="mylinkImg" class="btn btn-info">
                    <span class="fa fa-download"></span> Download
                </a>
                <button class="btn btn-info fullPhoto " onclick="fullscreenPhotoFun()">
                    <span class="fa fa-arrows-alt"></span> Full screen
                </button>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="backGround" id="backGround">
                    <button class="btn btn-info backFullScreen" id="backFullScreen" onclick="fullscreenPhotoFun()">
                        <span class="fa fa-angle-double-left"></span> Back
                    </button>
                </div>
                <img id="modalPhoto" width="100%" src="" alt="photo">
            </div>
        </div>
    </div>
</div>

<div id="modalvideo" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modalButCont">
                    <div class="buttonModal">
                        <a href="#" id="mylinkVid" class="btn btn-info downloadVideo">
                            <span class="fa fa-download"></span> Download</a>
                        <button class="btn btn-info fullscreenVideo" onclick="fullscreen()">
                            <span class="fa fa-arrows-alt"></span> Full Screen
                        </button>
                        <button class="btn btn-info playPauseVideo" onclick="playPauseFunction()">
                            <span class="fa fa-pause-circle" id="10000"></span> Play/Pause
                        </button>
                        <button class="btn btn-info" onclick="goBack(-10)">
                            <span class="fa fa-undo"></span> Back
                        </button>
                        <button class="btn btn-info" onclick="goBack(10)">Forward
                            <span class="fa fa-repeat"></span>
                        </button>
                    </div>
                    <div class="modalclosed">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <!-- <div class="goThere">
                    <div class="blockBack"><span class="fa fa-angle-double-left"></span></div>
                    <div class="blockGo"><span class="fa fa-angle-double-right"></span></div>
                </div> -->
                <div class="modalVideoCont">
                    <video id="modalVideo" controls controlsList="nodownload" autoplay width="100%" src=""></video>
                </div>
            </div>
            <!-- <div class="modal-header">
                <a href="#" id="mylinkVid" class="btn btn-success">
                    <span class="fa fa-download"></span> Download </a>
                    <button onclick="fullscreen()">Click</button>
                    <button onclick="playPauseFunction()">play/pause</button>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <video id="modalVideo" controls controlsList="nodownload" autoplay=true width="100%" src=""></video>
            </div> -->
        </div>
    </div>
</div>
<script>
    function onLoad(str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    document.getElementById("eugeneajax").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "/ajax/" + str);
            xmlhttp.send();
    }
    function loadProp(type, link, downLink, delLink) {

        if (type == 'photo') {
            var a = document.getElementById("modalPhoto");
            a.src = link;
            document.getElementById("mylinkImg").href = downLink;
            document.getElementById("mylinkImgDel").href = delLink;
        }
        else {
            var a = document.getElementById("modalVideo");
            a.src = link;
            document.getElementById("mylinkVid").href = downLink;
        }
    }
</script>
</body>

</html>

