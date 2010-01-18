<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Irving City Parks</title>
    <script src="http://maps.google.com/maps?file=api&v=1&key=ABQIAAAAOUW5hiUMmLnsZCHyOu6J1BSbqO3AUOqiNAJvy7DtjwXoKaLQRhQo7Kl066d88-dNr_OfN-G2GRNbfQ" type="text/javascript"></script>

 <script type="text/javascript">
    //<![CDATA[
function load(){
	var map = new GMap(document.getElementById("map"));
	var point = new GPoint(-96.926791,32.863917);
	map.addControl(new GLargeMapControl());
	map.addControl(new GMapTypeControl());
	map.centerAndZoom(point, 5);
	var baseIcon = new GIcon();
	baseIcon.shadow = "http://www.google.com/mapfiles/shadow50.png";
	baseIcon.iconSize = new GSize(20, 34);
	baseIcon.shadowSize = new GSize(37, 34);
	baseIcon.iconAnchor = new GPoint(9, 34);
	baseIcon.infoWindowAnchor = new GPoint(9, 2);
	baseIcon.infoShadowAnchor = new GPoint(18, 25);
	
	function createMarker(point, iconname, info) {
		var icon = new GIcon(baseIcon);
		icon.image = iconname.getAttribute("image");
		var marker = new GMarker(point, icon);
      
		GEvent.addListener(marker, "click", function() {
			marker.openInfoWindowXslt(info, "parks.xsl");
		});
      
		return marker;
	}
	
	var request = GXmlHttp.create();
	request.open("GET", "parks.xml", true);
	request.onreadystatechange = function() {
  	if (request.readyState == 4) {
		var xmlDoc = request.responseXML;
		var points = xmlDoc.documentElement.getElementsByTagName("point");
		var icons = xmlDoc.documentElement.getElementsByTagName("icon");
		var info = xmlDoc.documentElement.getElementsByTagName("info");

		for (var i = 0; i < points.length; i++) {
			var point = new GPoint(parseFloat(points[i].getAttribute("lng")), parseFloat(points[i].getAttribute("lat")));
			var marker = createMarker(point, icons[i], info[i]);
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