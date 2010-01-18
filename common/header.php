<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
$curpage = $_SERVER['PHP_SELF'];
?>
	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Respect Alumni - Tau Nu Alpha</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="keywords" content="Tau Nu Alpha, TNA, Respect Alumni, Auburn University, University of Georgia, Auburn, UGA" />
	<meta name="description" content="The phrase &ldquo;Respect Alumni&rdquo; has been adopted by Tau Nu Alpha as its chief slogan.  The phrase was first used by Georgia Alum and TNA member John Boren.  Its original use was to remind an underclassman to have respect for those who had come before her.  A lesson was learned, and a catchphrase was born." />
	<meta name="rating" content="General" />
	<meta name="robots" content="index,follow" /> 
	<meta name="URL" content="http://www.respectalumni.com" /> 
	<meta name="author" content="Travis Roberts" />
	
	<link rel="stylesheet" type="text/css" href="/common/respectalumni.css" />
	<link rel="stylesheet" type="text/css" href="/common/transmenu.css" />
	<? if($_SERVER['HTTP_HOST'] == 'www.respectalumni.com' && $curpage == '/tna_members.php') { ?>
	<script type="text/javascript" src="http://maps.google.com/maps?file=api&v=1&key=ABQIAAAAOUW5hiUMmLnsZCHyOu6J1BSbqO3AUOqiNAJvy7DtjwXoKaLQRhQo7Kl066d88-dNr_OfN-G2GRNbfQ"></script>
	<? } else if($_SERVER['HTTP_HOST'] == 'www.taunualpha.com' && $curpage == '/tna_members.php') { ?>
	<script src="http://maps.google.com/maps?file=api&v=1&key=ABQIAAAAU2hdZ44Zw8kXxclbJl-BaxRFODu6O26sEVokHjUSpc-aLKXnKhTcjxJh1L2g7r_vmHP1GVUeSWIrow" type="text/javascript"></script>
	<? } ?>
	<script type="text/javascript" src="/common/transmenu.js"></script>

	<script type="text/javascript">
	//<![CDATA[
		function showMap() {
		var map = new GMap(document.getElementById("map"));
		var point = new GPoint(-84.386826,33.766506);
		map.addControl(new GLargeMapControl());
		map.centerAndZoom(point, 9);
		
		function createMarker(point, info) {
			var marker = new GMarker(point);
	      
			GEvent.addListener(marker, "click", function() {
				marker.openInfoWindowXslt(info, "tna.xsl");
			});
	      
			return marker;
		}
		
		var request = GXmlHttp.create();
		request.open('GET', 'tna.xml', true);
		request.onreadystatechange = function() {
		  	if (request.readyState == 4) {
				var xmlDoc = request.responseXML;
				var points = xmlDoc.documentElement.getElementsByTagName("point");
				var info = xmlDoc.documentElement.getElementsByTagName("info");
		
				for (var i = 0; i < points.length; i++) {
					var point = new GPoint(parseFloat(points[i].getAttribute("lng")), parseFloat(points[i].getAttribute("lat")));
					var marker = createMarker(point, info[i]);
					map.addOverlay(marker);
				}
		  	}
		}
		request.send(null);
		}
	
	function init() {
		//==========================================================================================
		// if supported, initialize TransMenus
		//==========================================================================================
		// Check isSupported() so that menus aren't accidentally sent to non-supporting browsers.
		// This is better than server-side checking because it will also catch browsers which would
		// normally support the menus but have javascript disabled.
		//
		// If supported, call initialize() and then hook whatever image rollover code you need to do
		// to the .onactivate and .ondeactivate events for each menu.
		//==========================================================================================
		if (TransMenu.isSupported()) {
			TransMenu.initialize();

			// hook all the highlight swapping of the main toolbar to menu activation/deactivation
			// instead of simple rollover to get the effect where the button stays hightlit until
			// the menu is closed.
			menu1.onactivate = function() { document.getElementById("tna").className = "hover"; };
			menu1.ondeactivate = function() { document.getElementById("tna").className = ""; };
		}
	}
	//]]>
	</script>
	
</head>

<body onload="init()">

<div id="wrapper">
	
	<div id="header">
		<div id="logolink" onclick="window.location='/';"></div>
	</div><!-- end header -->
	<div id="nav">
		<p style="margin-top:8px;"><a href="/">Home</a></p>
		<p><a id="tna" href="/tna.php">Tau Nu Alpha</a></p>
		<p><a href="/shirt.php">The Shirt</a></p>
		<p><a href="/request_colors.php">Request School Colors</a></p>
		<p><a href="/contact.php">Contact</a></p>
	</div><!-- end nav -->
	
	<div id="content">
	<div class="padding">
	
		<div id="quoteBox">
			<div id="boxTop"></div>
			<div id="boxMid">
				<script type="text/javascript" src="/common/quotes.js"></script>
			</div><!-- end boxMid div -->
			<div id="boxBottom"></div>
		</div><!-- end quoteBox div -->
