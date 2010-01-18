<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <script src="http://maps.google.com/maps?file=api&v=1&key=ABQIAAAAOUW5hiUMmLnsZCHyOu6J1BSbqO3AUOqiNAJvy7DtjwXoKaLQRhQo7Kl066d88-dNr_OfN-G2GRNbfQ" type="text/javascript"></script>
	</head>

 <script type="text/javascript">
    //<![CDATA[
function load(){
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
	request.open("GET", "tna.xml", true);
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
//]]>
    </script>
  </head>
  <body onload="load()">
    <div id="map"  style="width: 800px; height:500px;"></div>
   
  </body>

</html>