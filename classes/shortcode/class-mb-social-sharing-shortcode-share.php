<?php
class MB_Social_Share {

	public function __construct() {

	}

	/**
	 * Output the demo shortcode.
	 *
	 * @access public
	 * @param array $atts
	 * @return void
	 */
	public function output( $attr ) {
		global $MB_Social_Sharing;
		$MB_Social_Sharing->nocache();

		$social_share_settings = get_option('mb_mb_social_sharing_general_settings_name');

		$label = apply_filters( 'mb_social_share_label', $attr['label'] );
		$link = apply_filters( 'mb_social_share_link', $attr['link'] );
		$content = apply_filters( 'mb_social_share_content', $attr['content'] );

		
		
		if (!empty($attr['label'])) {
		echo '<div class="social"><div>'. $label . '</div>';
		}
		else {
		echo '<div class="social">';
		}
			if($social_share_settings['mb_enable_facebook'] == 1){ 	?>
				<!--Facebook-->
		        <a style="color: #fff;" class="facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $link; ?>&t=<?php echo $content; ?>" rel="nofollow" title="Share this post on Facebook!" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=400');return false;">Facebook</a>
			<?php }	
			
			if($social_share_settings['mb_enable_google'] == 1){	?>
			    <!--Google Plus-->
			        <a style="color: #fff;" class="google-plus" href="https://plus.google.com/share?url=<?php echo $link; ?>" rel="nofollow" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=400');return false;">Google+</a>
		   <?php  }
			
			if($social_share_settings['mb_enable_twitter'] == 1){	?>
				<!--Twitter-->
			        <a style="color: #fff;" class="twitter" href="https://twitter.com/intent/tweet?text=<?php echo $content; ?>&url=<?php echo $link; ?>" title="Share this post on Twitter!" rel="nofollow" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=400');return false;">Twitter</a>
		    <?php }

			if($social_share_settings['mb_enable_reddit'] == 1){	?>			
				<!--Reddit-->
					<a style="color: #fff;" class="reddit" href="http://reddit.com/submit?url=<?php echo $link; ?>&amp;title=<?php echo $content; ?>" rel="nofollow" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=400');return false;">Reddit</a>
			<?php }

			if($social_share_settings['mb_enable_digg'] == 1){	?>
				<!--Digg-->
					<a style="color: #fff;" class="digg" href="https://digg.com/submit?url=<?php echo $link; ?>&amp;title=<?php echo $content; ?>" rel="nofollow" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=400');return false;">&nbsp;&nbsp;Digg&nbsp;&nbsp;</a>
			<?php }
				
			if($social_share_settings['mb_enable_linkedin'] == 1){	?>
				<!--LinkedIn-->
					<a style="color: #fff;" class="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $link; ?>" rel="nofollow" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=400');return false;">LinkedIn</a>
			<?php }

			if($social_share_settings['mb_enable_pinterst'] == 1){	?>
				<!--Pinterst-->
					<a style="color: #fff;" class="pinterest" href="http://pinterest.com/pin/create/bookmarklet/?url=<?php echo $link; ?>&is_video=false&description=<?php echo $content; ?>" rel="nofollow" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=400');return false;">Pinterest</a>
			<?php }
		echo '</div>';


	}
}
