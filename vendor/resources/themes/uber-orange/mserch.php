<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html>

<style>

.word { font-weight:bold; color:#000000; }
#search_box { padding:4px; border:solid 1px #666666; width:300px; height:30px; font-size:18px;-moz-border-radius: 6px;-webkit-border-radius: 6px; }
.search_button { border:#000000 solid 1px; padding: 6px; color:#000; font-weight:bold; font-size:16px;-moz-border-radius: 6px;-webkit-border-radius: 6px; }

</style>
<head>
    <title>MH::Bhutan</title>
    <link rel="shortcut icon" href="<?php echo THEMEPATH; ?>/images/favicona.png" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/rebase-min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/style.css" />
    <?php echo $gallery->getColorboxStyles(1); ?>
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript" src="resources/colorbox/jquery.colorbox.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("a[rel='colorbox']").colorbox({maxWidth: "90%", maxHeight: "90%", opacity: ".5"});
        });
    </script>
    
    <?php file_exists('googleAnalytics.inc') ? include('googleAnalytics.inc') : false; ?>

<script type="text/javascript">
 
$(function() {
 
    $(".search_button").click(function() {
        // getting the value that user typed
        var searchString    = $("#search_box").val();
		if(!searchString){
		searchString='All';	
		}
        // forming the queryString
        var data            = 'mySearch='+ searchString;
       // alert(data); 
        // if searchString is not empty
        //if(searchString) {
            // ajax call
            $.ajax({
                type: "POST",
                url: "imagesearch.php",
                data: data,
                beforeSend: function(html) { // this happens before actual call
                    $("#results").html(''); 
                    $("#searchresults").show();
                    $(".word").html(searchString);
               },
               success: function(html){ // this happens after we get results
                    $("#results").show();
                    $("#results").append(html);
              }
            });    
        //}
        return false;
    });
});

</script>
 
</head>
<body>
<div id="container">
<div style="margin:20px auto; text-align: center;">
<form method="post" action="imagesearch.php">
    <input type="text" name="search" id="search_box" class='search_box'/>
    <input type="submit" value="Search" class="search_button" /><br />
</form>
</div>      
<div>
 
<div id="searchresults"></div>
<ul id="results" class="update">
</ul>
 
</div>
</div>
   
</body>
</html>