<!-- WISTIA -->
<script charset="ISO-8859-1" src="http://fast.wistia.com/assets/external/E-v1.js"></script>
<!-- PROVIDED FACEBOOK/TWITTER SHARE FUNCTIONS -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1580545598900759";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>


<div id="social-share">
	<div class="fb-share-button" data-layout="button"></div>
	<div class="tweet"><a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Share</a></div>
</div>
<?php print render($content['field_h1_title']); ?>

<?php print render($content['field_video_clip']); ?>

<div id="biography">
	<h3>Biography</h3>
	<span id="bio-trimmed">
	<?php 
		$bio = render($content['field_artist_biography']);
		print substr(strip_tags($bio), 0, 700).'<span id="elipses">... </span>';
	?>
	</span><a href="" id="read-more">Read More</a>
	<span id="bio-full">
	<?php
		print substr(strip_tags($bio), 700);
	?>
	</span>
</div>