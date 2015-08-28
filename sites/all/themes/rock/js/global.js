$(document).ready(function() {

/* RESPONSIVE VIDEO CAROUSEL HEIGHT */
	function resizeCarousel(){
		var $playerHeight = $("#video").height(); // get size of video player
		$playerHeight = $playerHeight-29; // adjust for padding
		$("ul#carousel").css("height", $playerHeight); // set carousel height to match
	}
	window.onresize = function() { // when window resizes on ipad and desktop
		if (window.innerWidth >= 650){
			resizeCarousel(); // resize carousel
		}
	}
	if (window.innerWidth >= 650){
		resizeCarousel(); // automatically, on page load
	}

/* COUNT VIDEOS IN CAROUSEL LIST, ADD COUNTER TO THUMBNAILS */
	$("#carousel li").each(function(i) {
        var $videoOrder = i+1;
        var $totalVideos = $("#carousel li").size();
        $(this).children('p.order').html($videoOrder+" of "+$totalVideos);
    });

/* CLICK THUMBNAIL, LOAD ASSOCIATED VIDEO CONTENT */
	var $videoId = $("#carousel li").first().attr('id'); // load default (first) video id
	var $videoTitle = $("#carousel li h3").first().text(); // load default (first) video title
	var $videoOrder = $("#carousel li p.order").first().text(); // load default (first) video count
	var $videoDescription = $("#carousel li p.description").first().text(); // load default (first) video description
	setVideo();

	function setVideo(){
		$("div#player").html("<iframe src='https://player.vimeo.com/video/"+$videoId+"?autoplay=1&portrait=0&byline=0&title=0' width='600' height='381' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>"); // dynamic vimeo
		// $("div#player.wistia").html("<iframe src='http://fast.wistia.net/embed/iframe/"+$videoId+"' allowtransparency='true' frameborder='0' scrolling='no' class='wistia_embed' name='wistia_embed' allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen width='640' height='360'></iframe><script src='//fast.wistia.net/assets/external/E-v1.js' async></script>"); // dynamic wistia 
		$("h2#video-title").html($videoTitle); // dynamic video code
		$("p#video-order").html("Clip "+$videoOrder); // dynamic video counter
		$("p#video-description").html($videoDescription); // dynamic video description
	};
	$("#carousel li").click(function(){ // when thumbnail is clicked
		$videoId = $(this).attr('id'); // change video id
		$videoTitle = $(this).children('h3').text(); // change video title
		$videoOrder = $(this).children('p.order').text(); // change order
		$videoDescription = $(this).children('p.description').text(); // change order
		$(this).addClass("hidden"); // hide thumbnail in carousel
		$(this).siblings().removeClass("hidden"); // show all other thumbnails in carousel
		setVideo();
	});

});