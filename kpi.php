<?php
	/**
	 *	Project name: ADC_KPI
	 *	file-name: index.php
	 * 	Author: Jacob Liscom
	 * 	Author: Zachary August
	 *	Version: 13.2.2
	**/
	
	include("header.php");
	//strip tags out of $_GET values
	foreach($_GET as $key => $val) {
		$_GET[$key] = stripslashes(strip_tags(htmlspecialchars($val, ENT_QUOTES)));
		$key = stripslashes(strip_tags(htmlspecialchars($val, ENT_QUOTES)));
	}
	
	$regEx='/\.png|.jpg|.svg|.gif|.php$/i'; //used to locate files
	$dynEx='/\.php$/i'; //dynamic file types
		
	/**
	 * generate size tag
	 * @param $image - the path to the image
	 * @param $whiteSpace - the white space percentage
	 * @return - a sting image tag
	 */
	function imgSizeTag($image,$whiteSpace){
		if(isset($_GET["w"],$_GET["h"])){ //http://yoururl.com/indexphp?w=1000&h=1000
			$screenWidth = $_GET["w"];
			$screenHeight = $_GET["h"];
		}
		else{
			$screenWidth = 960; //default values. Also TV screen size
			$screenHeight = 540;
		}
		
		$screenRatio=$screenWidth/$screenHeight;
		
		$imgWidth = 0; //used for kpi image
		$imgHeight = 0;
		$imgRatio = 0;
		list($imgWidth, $imgHeight) = getimagesize($image); //get the image width and height
		if($imgHeight==0)
			return "width=\"".floor($screenWidth*$whiteSpace*$whiteSpace)." px\"";;//make it full screen if we can't get the height. We double the whitespace just to make sure
		$imgRatio=$imgWidth/$imgHeight;//calc image ration
		
		if($screenRatio>=$imgRatio){
			$size = $screenHeight/$imgHeight;
		}
		else{
			$size = $screenWidth/$imgWidth;
		}
	
		return "width=\"".floor($size*$imgWidth*$whiteSpace)." px\" height=\"".floor($size*$imgHeight*$whiteSpace)." px\"";
	}
	
	//start script
		$idTag = "id=\"center\"";
		$path = "./kpis/";
		
		if(isset($_GET["folder"])){ //Did they specify a special KPI folder?
			$folder = $_GET["folder"]; //http://yoururl.com/kpi.php?folder=sales
			if(is_dir($path.$folder)) //Does the special folder exist?
				$path .=$folder."/";
		}
		
		$size;//used for calc image size
		$whiteSpace = .92;//8% white space
		
		//image finding code
			$dh = opendir($path);
			while (false !== ($file = readdir($dh))){
				if (preg_match($regEx, $file)){
					$filelist[] = $file; //in php this adds one item to the array
			 	}
			}
	
		//pick the random image
			$pic = $path.$filelist[rand(0, sizeof($filelist) - 1)];
			
		//live
			if (preg_match($dynEx, $pic))
				$updated = "";
			else
				$updated = "Updated: ".date("F d, Y.", filemtime($pic));
			
		//echo
			echo "	<body> 
						<div id=\"doc\">";
					
			echo "			<img src=\"$pic\" ".$idTag." ".imgSizeTag($pic,$whiteSpace).">";
			echo 			$updated;
			
			echo "		</div>
					</body>";
					
			closedir($dh);
			echo "</html>";
?>