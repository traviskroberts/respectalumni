<?php
require ($_SERVER["DOCUMENT_ROOT"]."/common/header.php");
?>

<h1>Tau Nu Alpha Members</h1>

<p>The map below shows the location of the members of Tau Nu Alpha.</p>
<p>Click on a pin to see more information about each member.</p>
<!-- <p>Choose a city name from below to zoom closer and see all members who live in that city.</p>

<p><a href="javascript:map.recenterOrPanToLatLng(new GPoint(-122.1419, 37.4419));">Atlanta, GA</a><br />
<a href="">Athens, GA</a></p> -->

<div style="clear:both;"></div>

<div id="map"  style="width:500px; height:300px;"></div>




<?php
require ($_SERVER["DOCUMENT_ROOT"]."/common/footer.php");
?>