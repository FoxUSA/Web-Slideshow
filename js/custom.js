/**
 *	Project name: ADC_KPI
 *	file-name: custom.js
 * 	Author: Jacob Liscom
 *	Version: 13.2.0
**/
$(document).ready(function() {
	
	$("#doc").css("display", "none");

    $("#doc").fadeIn(2000);//2 sec fade in
	
	setTimeout( function(){ 
		$("#doc").fadeOut(1000, reloadPage);//1 sec fade out
	}, 25011);//reload time 15 sec
		
	/**
	 * Reload the page
	 */
	function reloadPage() {
		//location.reload(); //old way
		window.location = location.protocol + '//' + location.host + location.pathname+"?w="+$(window).width()+"&h="+$(window).height()+getFolder();//pass the screen dimensions
	}
	
	/**
	 * @return - return the folder tag if exists
	 */
	function getFolder(){
		var temp = getUrlVars()["folder"];
		if(temp != undefined){
			return "&folder="+temp;
		}
		else
			return "";
	}
	
	/**
	 * @return - returns an array of values in the GET section of the url
	 */
	function getUrlVars(){
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
		});
		
		return vars;
	}
});


