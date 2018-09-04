<?php
?>


<link rel="stylesheet" type="text/css" media="screen" href="asset/css/registration_StudentRegistration.css"></link>
<div id="results">Captured image will appear here.</div>
<div style="position:absolute:left:0px:top:100px" id="my_camera"></div>
<script src="asset/js/webcam.js" type="text/javascript"></script>	
<script language="JavaScript">
Webcam.set({
width: 554,
height: 372,
image_format: 'jpg',
jpeg_quality: 100
});
Webcam.attach( '#my_camera' );
</script>
<form>
<input type=button value="Take Snapshot" onClick="take_snapshot()">
</form>

<script src="asset/js/registration_StudentRegistration.js" type="text/javascript"></script>