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
        if (a != true) {
            fullscreenPhotoFun();
        }
        exitFullScreenPhoto();
    });

});

function goBack(value) {
    var video = document.getElementById('modalVideo');
    video.currentTime += value;
}


window.onload = function () {
    document.querySelectorAll('.sessionLink')[0].click();
    document.querySelectorAll('.oneSession')[0].classList.add('checked');
};


$(function () {
    $(".sessionLink").on('click', function () {
        $(".sessionLink .oneSession").removeClass("checked");
        $(this).find('.oneSession').addClass("checked");
        $("#home-tab").removeClass("active show");
        $("#home-tab").addClass("active show");
        $("#profile-tab").removeClass("active show");
        $("#contact-tab").removeClass("active show");
        // $("div" + $(this).attr("href")).show();
        return false;
    });
});

$(function () {
    $("div.oneSessionDoc").on('click', function () {
        $("div.oneSessionDoc").removeClass("checked");
        $(this).addClass("checked");
        $("#home-tab").removeClass("active show");
        $("#home-tab").addClass("active show");
        $("#profile-tab").removeClass("active show");
        $("#contact-tab").removeClass("active show");
        // $("div" + $(this).attr("href")).show();
        return false;
    });
});


// $(function () {
//     $("#modalLhoto").css("opacity", "0");
//     $(".fullScreenPhoto").click(function () {
//         // $('#modalPhoto').css({ "position": "absolute", 
//         //                        "width": "150%", 
//         //                        "left": "-25%", 
//         //                        "top":"-300%" });
//         $(".modal-content").css("opacity", "0"); 
//         $("#modalLhoto").css("opacity", "1");
//         return false;
//     });

//     $("#modalLhoto").click(function () {
//         // $('#modalPhoto').css({ "position": "absolute", 
//         //                        "width": "150%", 
//         //                        "left": "-25%", 
//         //                        "top":"-300%" });
//         $(".modal-content").css("opacity", "1");
//         $("#modalLhoto").css("opacity", "0");
//         $("#modalLhoto").addClass("close");
//         return false;
//     });


//     // $('#modalPhoto').click(function () {
//     //     $('#modalPhoto').css({
//     //         "position": "relative",
//     //         "width": "100%",
//     //         "left": "0",
//     //         "top": "0"
//     //     });
//     //     return false;
//     // });
// });


// $(function () {
//     $("div.blockBack").click(function () {
//     }).dblclick(function () {
//         alert("'Dblclick'");
//     });

// });


// $(document).ready(function() {
//     $(".btn-info").click(function(){ 
//         var img = $(this); 
//         var src = img.attr('src'); 
//         $("body").append("<div class='popup'>" + "<div class='popup_bg'></div>" + "<img src='" + src +  "' class='popup_img' />" + "</div>");
//         $(".popup").fadeIn(800); 
//         $(".popup_bg").click(function(){
//             $(".popup").fadeOut(800); 
//             setTimeout(function() {
//                 $(".popup").remove();
//             }, 800);
//     });
// }); 
// }); 

//время


// var sec = 59798/1000;
// var h = sec / 3600  ^ 0;
// var m = (sec - h * 3600) / 60  ^ 0;
// var s = sec - h * 3600 - m * 60;
// alert(h);
// alert(m);
// alert(s);
// alert((h < 10 ? "0" + h : h) + " ч. " + (m < 10 ? "0" + m : m) + " мин. " + (s < 10 ? "0" + s : s) + " сек.");


// var duration = 59834;

// var aa = duration/1000;
// var hourse = aa / 3600;
// var min = aa/60;
// var secMin = min*60;
// var sec = min - secMin;
// alert(parseInt(hourse) + ":" + parseInt(min) + ":" + parseInt(secMin));

