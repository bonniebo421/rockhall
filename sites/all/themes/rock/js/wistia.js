$(document).ready(function() {
/* HIDE/SHOW SEARCH BAR ON MOBILE */
	$("#search-icon").click(function(){
		if ($("#search").is(":hidden")){
			$("#search").slideDown();
		}
		else{
			$("#search").slideUp();
		}
	});
/* HIDE/SHOW MENU BAR ON MOBILE */
	$("#menu-icon").click(function(){
		if ($("nav").is(":hidden")){
			$("nav").slideDown();
		}
		else{
			$("nav").slideUp();
		}
	});
/* HIDE/SHOW FULL BIOGRAPHY */
	$("#read-more").click(function(){
		$("#bio-full").show();
		$("#read-more").hide();
		$("#elipses").hide();
		return false;
	});

/* RESPONSIVE VIDEO CAROUSEL HEIGHT */
	function resizeCarousel(){
		var $playerHeight = $("#video").height(); // get size of video player
		// $playerHeight = $playerHeight-29; // adjust for padding
		$("ul#carousel").css("height", $playerHeight); // set carousel height to match
	}
	window.onresize = function() { // when window resizes on ipad and desktop
		if (window.innerWidth >= 700){
			resizeCarousel(); // resize carousel
		}
		else{
			$("ul#carousel").css("height", "125px");
		}
	}
	if (window.innerWidth >= 700){
		resizeCarousel(); // automatically, on page load
	}

/* COUNT VIDEOS IN CAROUSEL LIST, ADD COUNTER TO THUMBNAILS */
	$("#carousel li").each(function(i) {
        var $videoOrder = i+1;
        var $totalVideos = $("#carousel li").size();
        $(this).children('p.order').html($videoOrder+" of "+$totalVideos);
    });

/* LOAD DEFAULT CONTENT */
	var $videoId = $("#carousel li").first().attr('id'); // load default (first) video id
	$("#carousel li").first().addClass("current"); // highlight first in carousel
	var $videoTitle = $("#carousel li h3").first().text(); // load default (first) video title
	var $videoOrder = $("#carousel li p.order").first().text(); // load default (first) video count
	var $videoDescription = $("#carousel li p.description").first().text(); // load default (first) video description
	var $nextVideoId = $("#"+$videoId).next().attr('id'); // find next video id for end play
	setVideo();
	function setVideo(){
		$("div#player").html("<div id='wistia_"+$videoId+"' class='wistia_embed' style='width:640px;height:360px;' data-video-width='900' data-video-height='360'>&nbsp;</div>");
		// wistia controls
		wistiaEmbed = Wistia.embed($videoId, {
			version: "v1",
			playerColor: "141414",
			videoFoam: true,
			autoPlay: true,
			videoQuality:  "hd-only",
			controlsVisibleOnLoad: false,
			videoOptions: {
				volumeControl: true,
			    videoWidth: 640,
			    videoHeight: 360
			}

		});
		// wistia end video, trigger next
		wistiaEmbed.bind("end", function () {
			$videoTitle = $("#"+$videoId).next().children('h3').text(); // change video title
			$videoOrder = $("#"+$videoId).next().children('p.order').text(); // change order
			$videoDescription = $("#"+$videoId).next().children('p.description').text(); // change order
			$("#"+$videoId).next().addClass("current"); // highlight thumbnail in carousel
			$("#"+$videoId).next().siblings().removeClass("current"); // unhighlight all other thumbnails in carousel
			nextVideo();
		});
		// dynamic wistia 
		$("h2#video-title").html($videoTitle); // dynamic video code
		$("p#video-order").html("Clip "+$videoOrder); // dynamic video counter
		$("p#video-description").html($videoDescription); // dynamic video description
	};

	/* LOAD NEXT VIDEO UPON PLAY COMPLETION */
	function nextVideo(){
		$("div#player").html("<div id='wistia_"+$nextVideoId+"' class='wistia_embed' style='width:640px;height:360px;'' data-video-width='640' data-video-height='360'>&nbsp;</div>");
		// wistia controls
		wistiaEmbed = Wistia.embed($nextVideoId, {
			version: "v1",
			playerColor: "141414",
			videoFoam: true,
			autoPlay: true,
			videoQuality:  "hd-only",
			controlsVisibleOnLoad: false,
			videoOptions: {
				volumeControl: true,
			    videoWidth: 640,
			    videoHeight: 360,
			}
		});
		// wistia end video, trigger next
		wistiaEmbed.bind("end", function () {
			var $newVideoId = $nextVideoId;
			if ($("#"+$newVideoId).next().length == 0){
				// if last video in list
				$("#"+$newVideoId).addClass("current"); // highlight thumbnail in carousel
				$("#"+$newVideoId).siblings().removeClass("current"); // unhighlight all other thumbnails in carousel
			}
			// otherwise load the next video
			else{
				$nextVideoId = $("#"+$newVideoId).next().attr('id');
				$videoTitle = $("#"+$newVideoId).next().children('h3').text(); // change video title
				$videoOrder = $("#"+$newVideoId).next().children('p.order').text(); // change order
				$videoDescription = $("#"+$newVideoId).next().children('p.description').text(); // change order
				$("#"+$newVideoId).next().addClass("current"); // highlight thumbnail in carousel
				$("#"+$newVideoId).next().siblings().removeClass("current"); // unhighlight all other thumbnails in carousel
				nextVideo();
			}
		});
		// dynamic wistia 
		$("h2#video-title").html($videoTitle); // dynamic video code
		$("p#video-order").html("Clip "+$videoOrder); // dynamic video counter
		$("p#video-description").html($videoDescription); // dynamic video description
	};

	/* CLICK THUMBNAIL, LOAD ASSOCIATED VIDEO CONTENT */
	$("#carousel li").click(function(){ // when thumbnail is clicked
		$videoId = $(this).attr('id'); // change video id
		$videoTitle = $(this).children('h3').text(); // change video title
		$videoOrder = $(this).children('p.order').text(); // change order
		$videoDescription = $(this).children('p.description').text(); // change order
		$(this).addClass("current"); // highlight thumbnail in carousel
		$(this).siblings().removeClass("current"); // show all other thumbnails in carousel
		$nextVideoId = $(this).next().attr('id'); // find next video id for end play
		setVideo();
	});

});