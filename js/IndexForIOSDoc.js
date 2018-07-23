var a = false;
$('#modalphoto').on('hide.bs.modal', function (e) {
    var a = document.getElementById("modalPhoto");
    a.src = '';
    elemPhoto.style.width = "100%";
    elemPhoto.style.position = " relative";
    elemPhoto.style.left = "0";
    elemPhoto.style.transition = "0.5s";
    elemPhotoBG.style.display= "none";
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

var elemPhoto = document.getElementById("modalPhoto");
var elemPhotoBG = document.getElementById("backGround");
var backFullScreen = document.getElementById("backFullScreen");
function fullscreenPhotoFun() {
        if (elemPhoto.style.width != "100vw" && elemPhoto.style.position != "absolute" && elemPhoto.style.left != "-35.5%") {
            elemPhoto.style.width = "100vw";
            elemPhoto.style.position = "absolute";
            elemPhoto.style.left = "-35.5%";
            elemPhoto.style.transition = "0.5s";
            elemPhotoBG.style.display= "block";
            elemPhotoBG.style.position = "absolute";
            elemPhotoBG.style.top = "-310%";
            elemPhotoBG.style.left = "-35.5%";
            elemPhotoBG.style.height = "100vh";
            elemPhotoBG.style.width = "100vw";
            elemPhotoBG.style.background = "white";
            backFullScreen.style.position = " relative";
            backFullScreen.style.zIndex ="1";
            backFullScreen.style.opacity = "1";
        }
        else {
            elemPhoto.style.width = "100%";
            elemPhoto.style.position = " relative";
            elemPhoto.style.left = "0";
            elemPhoto.style.transition = "0.5s";
        }
 
}


 
function goBack(value) {
    var video = document.getElementById('modalVideo');
    video.currentTime += value;
}


var act = document.querySelectorAll('.oneSessionDoc');
var a = act[0];

window.onload = function () {
    a.click();
    a.classList.add('checked');
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


// fullscreen for VIDEO
var enableInlineVideo = (function () {
	'use strict';


	var iOS8or9 = typeof document === 'object' && 'object-fit' in document.head.style && !matchMedia('(-webkit-video-playable-inline)').matches;
	function enableInlineVideo(video, opts) {

		if (!opts.everywhere) {
			if (!iOS8or9) {
				return;
			}
			if (!(opts.iPad || opts.ipad ? /iPhone|iPod|iPad/ : /iPhone|iPod/).test(navigator.userAgent)) {
				return;
			}
		}
	}
	return enableInlineVideo;

}());

var videos = document.querySelectorAll('video');
if (location.search === '?enabled=true') {
	enableVideos(true);
} else {
	enableVideos();
}

function enableButtons(video) {
	var fullscreenButton = document.querySelector('.fullscreenVideo');

		fullscreenButton.addEventListener('click', function () {
			video.webkitEnterFullScreen();
		});
}

// debug events
function debugEvents(video) {
	[
		'webkitbeginfullscreen',
		'webkitendfullscreen',
	].forEach(function (event) {
		video.addEventListener(event, function () {
			console.info('@', event);
		});
	});
}

function enableVideos(everywhere) {
	for (var i = 0; i < videos.length; i++) {
		window.enableInlineVideo(videos[i], { everywhere: everywhere });
		enableButtons(videos[i]);
		debugEvents(videos[i]);
	}
}

