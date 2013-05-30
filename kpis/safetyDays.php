<?php
	/**
	 *	file-name: safetyDays.php
	 * 	Author: Jacob Liscom
	 *	Version: 13.2.0
	**/
	$lastInjury = "2010-09-30"; //date of the last injury /y-m-d
	$text = "Days since last injury: ".daysSince();
	$size = 100; //font size
	
	$imgW = 1580;
	$imgH = 300;
	$font = 'fonts/arial.ttf';
	/**
	 * Returns the days since the last injury date
	 */
	function daysSince(){
		global $lastInjury;
		$now = time(); // or your date as well
	    $your_date = strtotime($lastInjury);
	    $datediff = $now - $your_date;
	    return floor($datediff/(60*60*24));
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