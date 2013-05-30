<?php
	/**
	 *	file-name: safetyDays.php
	 * 	Author: Jacob Liscom
	 *	Version: 13.2.0
	**/
	$text = "vserver5 uptime: ".uptime();
	$size = 100; //font size
	
	$imgW = 1600;
	$imgH = 300;
	$font = 'fonts/arial.ttf';
	
	/**
	 * Returns the uptime
	 */
	function uptime(){
		$data = shell_exec('uptime');
		$uptime = explode(' up ', $data);
		$uptime = explode(',', $uptime[1]);
		$uptime = $uptime[0];
		
		return $uptime;
	}
	
	//image code
		$textX = 10;
		$textY = 200;
		$img = imagecreate( $imgW, $imgH );
		$black = imagecolorallocate( $img, 0, 0, 0 );
		$white = imagecolorallocate( $img, 255, 255, 255 );
		$grey = imagecolorallocate($img, 128, 128, 128);
		
		// Add some shadow to the text
			imagettftext($img, $size, 0, $textX+1, $textY+1, $grey, $font, $text);
		// Add the text
			imagettftext($img, $size, 0, $textX, $textY, $white, $font, $text);
			
		//display the image
			header( "Content-type: image/png" );
			imagepng($img);
			imagedestroy($img);
?>