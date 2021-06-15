<?php

	global $facebook, $twitter, $instagram;

	$facebook = get_field('facebook', 'option');
	$twitter = get_field('twitter', 'option');
	$instagram = get_field('instagram', 'option');
?>

<div class="social-media flexbox">

<?php if($facebook){ ?>
	<a target="_blank" class="flexbox sm_facebook" href="<?php echo $facebook; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
<?php } ?>

<?php if($twitter){ ?>
	<a target="_blank" class="flexbox sm_twitter" href="<?php echo $twitter; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
<?php } ?>

<?php if($instagram){ ?>
	<a target="_blank" class="flexbox sm_instagram" href="<?php echo $instagram; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
<?php } ?>

</div>