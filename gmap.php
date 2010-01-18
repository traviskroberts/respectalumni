<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <script src="http://maps.google.com/maps?file=api&v=1&key=ABQIAAAAOUW5hiUMmLnsZCHyOu6J1BSbqO3AUOqiNAJvy7DtjwXoKaLQRhQo7Kl066d88-dNr_OfN-G2GRNbfQ" type="text/javascript"></script>
	</head>
	
	<body>
	  <div id="map" style="width: 500px; height: 500px"></div>
	  <script type="text/javascript">
	  //<![CDATA[
	  
		var map = new GMap(document.getElementById("map"));
		map.addControl(new GLargeMapControl());
		map.centerAndZoom(new GPoint(-83.377530, 33.963997), 5);
	  
		function createMarker(lat, lng, info) {
			
			var point = new GPoint(lat, lng);
			var marker = new GMarker(point);
	      
			GEvent.addListener(marker, "click", function() {
				marker.openInfoWindowXslt(info, "tna.xsl");
			});
			
			return marker;
		}
		
		var info = "<p>TEST</p>";
		var marker = createMarker(-83.377530, 33.963997, info);
		map.addOverlay(marker);
	  
	  //]]>
	  </script>
	</body>
	</html>