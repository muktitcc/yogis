$(function() { 
$( "#tabs" ).tabs(); 
});

$(function() { 
$('aa').tooltip();
});




$(document).ready(function() {
$(".studentImages").fancybox({
fitToView	: true,
autoSize	: false,
closeClick	: false,
openEffect	: 'none',
closeEffect	: 'none',
scrolling:'no'

});


$(".studentDetail").fancybox({
maxWidth	: 1150,
maxHeight	: 800,
fitToView	: false,
width		: '100%',
height		: '100%',
autoSize	: false,
closeClick	: false,
openEffect	: 'none',
closeEffect	: 'none',
closeClick  : false, // prevents closing when clicking INSIDE fancybox
helpers: { 
overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox
},
scrolling:'no'
});

});

$(document).ready(function() { 
$('.fancybox').fancybox(); 
}); 


function take_snapshot() {
Webcam.snap( function(data_uri) {
document.getElementById('results').innerHTML = '<h2>Processing:</h2>';
Webcam.upload(data_uri, 'registration_StudentRegistration_SaveImageFromWebCam.php', function(code, text) {
document.getElementById('results').innerHTML ='Captured Image:<br>' + '<img src="'+text+'" width="450" height="350"/>';
} );	
} );
}

