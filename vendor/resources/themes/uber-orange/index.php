<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>MH::Bhutan</title>
    <link rel="shortcut icon" href="<?php echo THEMEPATH; ?>/images/favicona.png" />
     <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/rebase-min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/style.css" />
    <?php echo $gallery->getColorboxStyles(1); ?>
   <script type="text/javascript" src="nhpup_1.1.js"></script> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript" src="../vendor/resources/colorbox/jquery.colorbox.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("a[rel='colorbox']").colorbox({maxWidth: "90%", maxHeight: "90%", opacity: ".5"});
        });
	
		
    </script>
    
    <?php file_exists('googleAnalytics.inc') ? include('googleAnalytics.inc') : false; ?>
<style>
#mdiv {
    display: none;
    border:0px solid #000;
    height:30px;
    width:80px;
    margin-left:10px;
}

#tid:hover + #mdiv{
    display: block;
}
#mdiv {
  position:absolute;
  z-index:200; /* aaaalways on top*/
  padding: 3px;

  width: auto;
  height: auto;

  background-color: #777;
  color: white;
  font-size: 0.95em;
}

.imagewrap {display:inline-block;padding: 0;position:relative;}
#label2 { position:absolute;left:10px;top:3px;height:10px;width:15px;border:0;}
#label1 {position:absolute;left:25px;top:3px;height:15px;width:15px;border:0;}
</style>


</head>
<div id="galleryWrapper" style="width:900px">
    <h1>MH Gallery</h1>
    
    <?php if($gallery->getSystemMessages()): ?>
        <ul id="systemMessages">
            <?php foreach($gallery->getSystemMessages() as $message): ?>
                <li class="<?php echo $message['type']; ?>">
                    <?php echo $message['text']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    
    <div id="galleryListWrapper">
        <ul id="galleryList" class="clearfix">
            <?php foreach ($galleryArray['images'] as $image): ?>
               <div class="imagewrap"> <li>
			   <a href="<?php echo $image['file_path']; ?>"  title="<?php echo $image['file_title']; ?>" rel="colorbox"><img id="tid" src="<?php echo $image['thumb_path']; ?>" alt="<?php echo $image['file_title']; ?>"/> <div id="mdiv"><?php echo $image['file_info']; ?> </div></a>
			    
			   <a style="border:0;background-color: transparent" id="label2"  data-fancybox-href="imagereport.php?filename=<?php echo $image['file_path']; ?>&tfilename=<?php echo $image['thumb_path']; ?>" href="#" class="various" title="Report administrator about this image."><img  src="asset/images/email1.png" height="15" width="15"/></a>
			   <a style="border:0;background-color: transparent" id="label1"  href="imagedownload.php?filename=<?php echo $image['download_path']; ?>" title="Download this image."><img  src="asset/images/download.png" height="15" width="15"/></a>
			  
			   </li></div>
			   
			   
            <?php endforeach; ?>
        </ul>
    </div>
   
    <div id="galleryFooter" class="clearfix">
    
        <?php if ($galleryArray['stats']['total_pages'] > 1): ?>
        <ul id="galleryPagination">
            
            <?php foreach ($galleryArray['paginator'] as $item): ?>
                
                <li class="<?php echo $item['class']; ?>">
				
                    <?php if (!empty($item['href'])): 
					
										$user_input = substr($item['href'], strrpos($item['href'], '=') + 1);
										//echo $item['class'];
					?>
                        <a href="#" data-page="<?php echo $user_input;?>" ><?php echo $item['text']; ?></a>
                    <?php else: ?><?php echo $item['text']; ?><?php endif; ?>
                </li>
            
            <?php endforeach; ?>
            
        </ul>
        <?php endif; ?>
        
   
    </div>
</div>
 

</body>
</html>
