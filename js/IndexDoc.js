var a = false;
$('#modalphoto').on('hide.bs.modal', function (e) {
    var a = document.getElementById("modalPhoto");
    a.src = '';
})
$('#modalvideo').on('hide.bs.modal', function (e) {
    var a = document.getElementById("modalVideo");
    a.src = '';
})
$('#modalvideo').on('shown.bs.modal', function (e) {
    var a = document.getElementById("modalVideo");
    if (a.src != null) {
        a.play();
    }
})

var elem = document.getElementById("modalVideo");
var ppp = document.getElementById("1000");
function playPauseFunction() {
    if (elem.paused) {
        elem.play();
        ppp.classList.remove("fa-play-circle");
        ppp.classList.add("fa-pause-circle");
    }
    else {
        elem.pause();
        ppp.classList.remove("fa-pause-circle");
        ppp.classList.add("fa-play-circle");
    }
}
function fullscreen() {

    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.mozRequestFullScreen) {
        elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {

        elem.webkitRequestFullscreen();
    }
 
}

var elemPhoto = document.getElementById("modalPhoto");
var elemPhotoBG = document.getElementById("backGround");
var backFullScreen = document.getElementById("backFullScreen");
function fullscreenPhotoFun() {
    if (elemPhoto.requestFullscreen) {
        elemPhoto.requestFullscreen();
    } else if (elemPhoto.mozRequestFullScreen) {
        elemPhoto.mozRequestFullScreen();
    } else if (elemPhoto.webkitRequestFullscreen) {
        elemPhoto.webkitRequestFullscreen();
    }
  
 
}
function exitFullScreenPhoto() {
    // exit full-screen
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    }
}

$(function () {
    $("#modalPhoto").dblclick(function () {
        if (a!= true) {
            fullscreenPhotoFun();
        }
        exitFullScreenPhoto();  
    });

});
 
function goBack(value) {
    var video = document.getElementById('modalVideo');
    video.currentTime += value;
}


var act = document.querySelectorAll('.oneSessionDoc');
var us = act[0];
window.onload = function () {
    us.click();
    us.classList.add('checked');
}



$(function () {
    $("div.oneSessionDoc").click(function () {
        $("div.oneSessionDoc").removeClass("checked");
        $(this).addClass("checked");
        $("#home-tab").removeClass("active show");
        $("#home-tab").addClass("active show");
        $("#profile-tab").removeClass("active show");
        $("#contact-tab").removeClass("active show");
        $("div#" + $(this).attr("href")).show();
        return false;
    });
});
