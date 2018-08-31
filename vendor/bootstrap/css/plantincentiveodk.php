<?php
require_once( "common.inc_.php" );
session_start();
checkLogin();
if(!in_array($_SESSION["member"]->getValue( "id" ),unserialize($_SESSION['allowaccess']))){
displayPageHeader( "Error" ,false);
  ?>
  
       <div style="position:absolute;left:0px;top:0px;margin:10px;width:600px;"> 
	   <?php
	 echo '<p class="error">You are not authorized to access this page</p>';
	
	 ?>
	</div>
	<?php
include 'mhvFooter.php';
exit;
}

include("inc-new/jqgrid_dist.php");

$g = new jqgrid();


$col = array();
$col["title"] = "uri";
$col["name"] = "_URI";
$col["width"] = "150";
$col["sortable"] = false; 
$col["search"] = false;
$col["editable"] = false;
$col["hidden"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "Farmer";
$col["name"] = "FARMERBARCODE";
$col["width"] = "200";
$col["sortable"] = false;
$col["search"] = true; 
$col["editable"] = false;
$col["editrules"] = array("required"=>true);
$col["edittype"] = "select";
$col["stype"] = "select";
$str = $g->get_dropdown_values("select IDFARMER as k, concat(IDFARMER,' ',FARMERNAME) as v from mhv.tblfarmer where IDFARMER in(select substring(FARMERBARCODE,1,14) from odk_prodlocal.tblplantincentiveprogram_core)"); 
$col["editoptions"] = array("value"=>$str);
$col["searchoptions"] = array("value"=>$str);
$col["formatter"] = "select";
$cols[] = $col;



$col = array();
$col["title"] = "Field";
$col["name"] = "FDCODE";
$col["frozen"] = true; 
$col["width"] = "50";
$col["sortable"] = false; 
$col["search"] = true; 
$col["editable"] = false;
$col["align"] = "left"; 
$cols[] = $col;
$col = array();


/*
$col = array();
$col["title"] = "Dzongkhag";
$col["name"] = "DCODE";
//$col["dbname"] = "odk_prodlocal.tblfieldqc_core";
$col["width"] = "155";
$col["sortable"] = false;
$col["search"] = true; 
$col["editable"] = false; 
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select  DzongkhagCode as k, DzongkhagName as v from mhv.tbldzongkhag"); 
$col["editoptions"] = array("value"=>$str,
  "onchange" => array(    "sql"=>"select distinct mainid as k, GewogName as v from mhv.tblgewog where DzongkhagId='{DCODE}'", 
                                    "update_field" => "GCODE") 
); 
$col["searchoptions"] = array("value"=>':;'.$str);
$col["stype"] = "select";
$col["formatter"] = "select";
$cols[] = $col;

$col = array();
$col["title"] = "Gewog";
$col["name"] = "GCODE";
$col["width"] = "155";
//$col["dbname"] = "odk_prodlocal.tblfieldqc_core";
$col["sortable"] = false;
$col["search"] = true; 
$col["editable"] = false; 
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select  mainid as k, GewogName as v from mhv.tblgewog"); 
$col["editoptions"] = array("value"=>$str,
  "onchange" => array(    "sql"=>"select distinct tmainid as k, TshewogName as v from mhv.tbltshewog where gid='{GCODE}'", 
                                    "update_field" => "TCODE") 
); 
$col["searchoptions"] = array("value"=>':;'.$str);
$col["stype"] = "select";
$col["formatter"] = "select";
$cols[] = $col;

$col = array();
$col["title"] = "Tshowog";
$col["name"] = "TCODE";
$col["width"] = "155";
//$col["dbname"] = "odk_prodlocal.tblfieldqc_core";
$col["sortable"] = false;
$col["search"] = true; 
$col["editable"] = false; 
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select  tmainid as k, TshewogName as v from mhv.tbltshewog"); 
$col["editoptions"] = array("value"=>$str); 
$col["searchoptions"] = array("value"=>':;'.$str);
$col["stype"] = "select";
$col["formatter"] = "select";

$cols[] = $col;
*/
$col = array();
$col["title"] = "Start<br> Date";
$col["name"] = "START"; 
$col["width"] = "80";
$col["editable"] = true; 
$col["editoptions"] = array("size"=>20); 
$col["editrules"] = array("required"=>true, "edithidden"=>true); 
$col["hidden"] = false;
$col["formatter"] = "date"; 
$col["sortable"] =false;
$col["search"] = true;
$cols[] = $col;
/*
$col = array();
$col["title"] = "End <br>Date";
$col["name"] = "END"; 
$col["width"] = "80";
$col["editable"] = true; 
$col["editoptions"] = array("size"=>20); 
$col["editrules"] = array("required"=>true, "edithidden"=>true);
$col["hidden"] = false;
$col["formatter"] = "date";
$col["sortable"] =false;
$col["search"] = true;
$cols[] = $col;
*/
$col = array();
$col["title"] = "Monitor";
$col["name"] = "STAFFID";
$col["width"] = "155";
$col["sortable"] = false; 
$col["search"] = true; 
$col["editable"] = false;
$col["align"] = "left";
$col["stype"] = "select";  
$str = $g->get_dropdown_values("select staffcode as k, concat(staffcode,' ',staffname) as v from mhv.tblmhvstaff where dept='106'"); 
$col["editoptions"] = array("value"=>$str); 
$col["searchoptions"]["value"] = $str;
$col["formatter"] = "select"; 
$cols[] = $col;







/*
$col = array();
$col["title"] = "Visit detail";
$col["name"] = "vd";
$col["width"] = "80";
$col["sortable"] = true; 
$col["search"] = false; 
$col["editable"] = false;
$col["default"]="<a target='_blank' class='various' data-fancybox-type='iframe'  href='storagevisitdetail.php?dgtid={FARMERBARCODE1}' title='Visit  detail of {FARMERBARCODE}'  style='text-decoration:none; white-space:none; border:1px solid gray; padding:2px; position:relative; width:25px; color:green'>Visit detail</a>";
$cols[] = $col;

*/




$col = array();
$col["title"] = "Field";
$col["name"] = "PLANTCOUNT_TREESALIVEINFIELD";
$col["width"] = "80";
$col["hidden"] = false;
$col["sortable"] = false; 
$col["search"] = false; 
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["title"] = "Storage";
$col["name"] = "PLANTCOUNT_TREESALIVEINSTORAGE";
$col["width"] = "80";
$col["hidden"] = false;
$col["sortable"] = false; 
$col["search"] = false; 
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["title"] = "Empty bags";
$col["name"] = "PLANTCOUNT_EMPTYBAG";
$col["width"] = "80";
$col["hidden"] = false;
$col["sortable"] = false; 
$col["search"] = false; 
$col["editable"] = false;
$cols[] = $col;



$col = array();
$col["title"] = "Monitor Comment";
$col["name"] = "MONITORCOMMENTS";
$col["width"] = "445";
$col["hidden"] = false;
$col["sortable"] = false; 
$col["search"] = false; 
$col["editable"] = false;
$cols[] = $col;

$grid["rowList"] = array();
//$grid["pgbuttons"] = false;
$grid["pgtext"] = null;
//$grid["viewrecords"] = false;
$grid["rownumbers"] = true; 
$grid["width"] = 3;
$grid["rowNum"] = 20;
$grid["sortname"] = 'FARMERBARCODE';
$grid["sortorder"] = "desc"; 
$grid["caption"] = "Plant Incentive Farmers";
$grid["autowidth"] = false; 
$grid["multiselect"] = false; 
$grid["footerrow"] = false;
$grid["toolbar"] = "top";


$e["js_on_select_row"] = "grid_select";  
$g->set_events($e);	

$e["js_on_load_complete"] = "do_onload"; 
$g->set_events($e);



 $grid["export"] = array("format"=>"xls",  
                        "filename"=>date('ymd') . "farmerPlantIncentive",  
                        "heading"=>"muk excel",  
                        "range"=>"filtered"); 

$grid["auto_width"] = false;
$grid["shrinkToFit"] = false;
$grid["width"] = 1260;
$grid["height"] = 350;
$g->navgrid["param"]["edit"] = false; 
$g->navgrid["param"]["add"] = false; 
$g->navgrid["param"]["del"] = false; 
$g->navgrid["param"]["search"] = false; 
$g->navgrid["param"]["refresh"] = true; 
$g->navgrid["param"]["view"] = false; 
$g->navgrid["param"]["addtext"] = "Add";
$g->navgrid["param"]["edittext"] = "Edit";
$g->navgrid["param"]["refreshtext"] = "Refresh";
$g->set_conditional_css($f_conditions);
$g->set_options($grid);
$g->set_actions(array(	
						"add"=>false, 
						"edit"=>false, 
						"rowactions"=>false,
						"delete"=>false, 
						"export"=>true, 

					) 
				);
				
					$g->set_group_header( array(
		    "useColSpanStyle"=>true,
		    "groupHeaders"=>array(
		        array(
		            "startColumnName"=>'PLANTCOUNT_TREESALIVEINFIELD', 
		            "numberOfColumns"=>3, 
		            "titleText"=>'#Trees(field survey)'
		        ),
		       			
				array(
		            "startColumnName"=>'PLANTHEALTH_YELLOWLEAF',
		            "numberOfColumns"=>5,
		            "titleText"=>'PLANT HEALTH' 
		        ),   
					array(
		            "startColumnName"=>'PHENOLOGYCALDATA_TREEWITHNUT', 
		            "numberOfColumns"=>3, 
		            "titleText"=>'PHENOLOGY' 
		        ),   
				
				
					
				
				
		    )
		)
	);		
	

 

$g->select_command = "select n.* from odk_prodlocal.tblplantincentiveprogram_core n INNER JOIN
 (SELECT farmerbarcode,fdcode, MAX(START)      lastEdit FROM odk_prodlocal.tblplantincentiveprogram_core GROUP BY farmerbarcode,fdcode)x ON  n.farmerbarcode = x.farmerbarcode AND n.START = x.LastEdit     AND STATUS <>  'BAD' GROUP BY n.farmerbarcode, n.fdcode";
//$g->table = "odk_prodlocal.tblfieldqc_core";

$g->set_columns($cols);
$out = $g->render("list");

?>
<?php
displayPageHeader("");
?>
    <link href="incliveupdate/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="incliveupdate/css/custom.css" rel="stylesheet" type="text/css">
	<script src="lib/js/jquery.min.js"></script> 
	<script src="incliveupdate/js/bootstrap.min.js"></script> 
    <script src="incliveupdate/js/bootstrap-editable.js" type="text/javascript"></script>
	
	
<script src="libnew/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>     
<script src="libnew/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>





<div id="tabs" style="width:1300px;height:550px;top:-10px;">  
<ul> 
<li><a href="#tabs-1">Plant Incentive Farmer</a></li> 
<li><a href="#tabs-3">Field Visit History</a></li> 
<li><a href="#tabs-7">Storage Visit History</a></li> 
<li><a href="#tabs-8">Registration & Distribution</a></li>
<li><a href="#tabs-9">Error Checklist</a></li>
</ul> 
<div id="tabs-1"> 
<?php echo $out?>
</div>


<div id="tabs-3"> 
<div id="fieldvisit"></div>
</div> 
 
<div id="tabs-7">
<div id="storagevisit"></div>
</div>
 
<div id="tabs-8">
<div id="reginfo"></div>
</div>

<div id="tabs-9">

<div id="errorchecklist"></div>




	


	



</div>
 
</div>
	


	
 <script> 
$(function() { 
$( "#tabs" ).tabs(); 
}); 

</script> 	
 <script>
$(document).ready(function() {
	$(".various").fancybox({
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
</script> 	
	
	
	

		

<style>.ui-th-column-header {text-align:center;}</style>	
<style>
.ui-jqgrid tr.jqgrow td {
    text-overflow: ellipsis;-o-text-overflow: ellipsis;
}
.ui-jqgrid tr.jqgrow.ui-state-highlight td {
    word-wrap: break-word; /* IE 5.5+ and CSS3 */
    white-space: pre-wrap; /* CSS3 */
    white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
    white-space: -pre-wrap; /* Opera 4-6 */
    white-space: -o-pre-wrap; /* Opera 7 */
    overflow: hidden;
    height: auto;
    vertical-align: middle;
    padding-top: 2px;
    padding-bottom: 2px
}
</style>
<script>

function do_onload(id){

document.getElementById('errorchecklist').innerHTML='';
document.getElementById('fieldvisit').innerHTML='<b>Select farmer to view his/her field visit history</b>'; 
document.getElementById('storagevisit').innerHTML='<b>Select farmer to view his/her field visit history</b>'; 
document.getElementById('reginfo').innerHTML='<b>Select farmer to view his/her registration,land and distribution information.</b>';
getErrorChecklist();


}

function getErrorChecklist(){
	
setTimeout(function(){          
var myurl='getplantincentiveerrorlist.php';
var ret = $.ajax({
url: myurl,
async:false,
}).responseText
document.getElementById('errorchecklist').innerHTML=ret; },1000)
	
}

function loadPhenologicalData(){
	
 document.getElementById('phenologicaldata').innerHTML='<div style="position:absolute;width:200px;left:250px;top:150px"><img height="20" width="20" src="loading.gif">'; 

	
setTimeout(function(){          
var myurl='getplantphenologydetail.php';
var ret = $.ajax({
url: myurl,
async:false,
}).responseText
document.getElementById('phenologicaldata').innerHTML=ret; },5000)
	
}


function loadPhenologicalDataDetail(mData){
	//alert(mData);
	
 document.getElementById('phenologicaldatanutdetail').innerHTML='<div style="position:absolute;width:200px;left:950px;top:300px"><img height="20" width="20" src="loading.gif">'; 

	
setTimeout(function(){  
if(mData=='N'){    
var myurl='getplantphenologytreedetail.php?dataField=PHENOLOGYCALDATA_TREEWITHNUT&colName=Nut';
}else if(mData=='F'){
var myurl='getplantphenologytreedetail.php?dataField=PHENOLOGYCALDATA_TREEWITHFLOWER&colName=Flower';	
}else{
var myurl='getplantphenologytreedetail.php?dataField=PHENOLOGYCALDATA_TREEWITHCATKIN&colName=Catkin';	
}


var ret = $.ajax({
url: myurl,
async:false,
}).responseText
document.getElementById('phenologicaldatanutdetail').innerHTML=ret; },5000)
	
}

function loadEmptyHoleDetail(){
	
 document.getElementById('emptyholedetail').innerHTML='<div style="position:absolute;width:200px;left:250px;top:150px"><img height="20" width="20" src="loading.gif">'; 

	
setTimeout(function(){          
var myurl='getemptyholedetail.php';
var ret = $.ajax({
url: myurl,
async:false,
}).responseText
document.getElementById('emptyholedetail').innerHTML=ret; },5000)
	
}

function loadSummary(){
	
 document.getElementById('overallinfo').innerHTML='<div style="position:absolute;width:200px;left:250px;top:150px"><img height="20" width="20" src="loading.gif">'; 
  document.getElementById('phenologicaldatanutdetail').innerHTML=''; 
document.getElementById('mbutton').value='Refresh';
	
setTimeout(function(){          
var myurl='getoverallfieldinfo.php';
var ret = $.ajax({
url: myurl,
async:false,
}).responseText
document.getElementById('overallinfo').innerHTML=ret; },5000)	
	
}

function showChart(){
	
$.fancybox([
        {
             'href'  : 'plantPhenologyChartDisplay.php',
            'title' : 'Plant Phenology Chart'
        }
    ], {
     'autoDimensions':false,
	 'height':'100%',
	 'width':'100%',
	 'top':'0',
    'type':'iframe',
    'autoSize':false,
			'closeClick'  : false, // prevents closing when clicking INSIDE fancybox
    'helpers': { 
        'overlay' : {'closeClick': false} // prevents closing when clicking OUTSIDE fancybox
    },
	'scrolling':'no'

    });		
	
	
}

</script>

<script type="text/javascript">

</script>
<script> 

   function grid_select(id) 
    { 
var grid = $('#list'); 
var rowid = grid.getGridParam('selrow'); 
var data = grid.getRowData(rowid);
 document.getElementById('fieldvisit').innerHTML='<div style="position:absolute;width:200px;left:500px;top:300px"><img height="20" width="20" src="loading.gif">'; 
  document.getElementById('storagevisit').innerHTML='<div style="position:absolute;width:200px;left:500px;top:300px"><img height="20" width="20" src="loading.gif">'; 
 document.getElementById('reginfo').innerHTML='<div style="position:absolute;width:200px;left:500px;top:300px"><img height="20" width="20" src="loading.gif">'; 
	
setTimeout(function(){          
var myurl='getfarmerinfo.php?farmercode='+data.FARMERBARCODE.substring(0, 14)+'&fieldcode='+data.FDCODE;
var ret = $.ajax({
url: myurl,
async:false,
}).responseText
document.getElementById('fieldvisit').innerHTML=ret; },3000)


setTimeout(function(){          
var myurl='getfarmerinfostorage.php?farmercode='+data.FARMERBARCODE.substring(0, 14)+'&fieldcode='+data.FDCODE;
var ret = $.ajax({
url: myurl,
async:false,
}).responseText
document.getElementById('storagevisit').innerHTML=ret; },3000)

setTimeout(function(){          
var myurl='getfermerreginfo.php?farmercode='+data.FARMERBARCODE.substring(0, 14);
var ret = $.ajax({
url: myurl,
async:false,
}).responseText
document.getElementById('reginfo').innerHTML=ret; },1000)






	}
	
   
	
</script>

<style>
.vr {
    width:5px;
    background-color:#000;
    position:absolute;
    top:50px;
    bottom:0;
    left:530px;
}
</style>

<?php
function intercroping($data){
$uri=$data["_URI"];
$mval='';	
$sqlUser = "SELECT * from odk_prodlocal.tblfieldqc_intercroppingdetails_plants where _PARENT_AURI='$uri'";
$resultUser = mysql_query($sqlUser);
$row = mysql_fetch_array($resultUser);
$mval =$row['VALUE'];	


$sqlUser = "SELECT * from odk_prodlocal.tblfieldchoices where name='$mval'";
$resultUser = mysql_query($sqlUser);
$row = mysql_fetch_array($resultUser);
return $row['label'];

}


function gapchecklist($data){
$uri=$data["_URI"];	
$mval='';	
$sqlUser = "SELECT * from odk_prodlocal.tblfieldqc_gapchecklist_checklist where _PARENT_AURI='$uri'";
$resultUser = mysql_query($sqlUser);
$row = mysql_fetch_array($resultUser);
$mval =$row['VALUE'];	


$sqlUser = "SELECT * from odk_prodlocal.tblfieldchoices where name='$mval'";
$resultUser = mysql_query($sqlUser);
$row = mysql_fetch_array($resultUser);
return $row['label'];

}
						function getFarmer($farmerCode){
$num_rows=0;
$farmerName='';
$mSql = "SELECT * from mhv.tblfarmer where IDFARMER='$farmerCode'";
$result = mysql_query($mSql);
$num_rows = mysql_num_rows($result);
if($num_rows>0){
$row = mysql_fetch_array($result);
$farmerName=$row['IDFARMER'].' '.$row['FARMERNAME'] ;

return "<a target='_blank' class='various' data-fancybox-type='iframe'  href='farmerdetailforagreement.php?dgtid=".$farmerCode."' title='More detail of ".$farmerName."'  style='text-decoration:none; white-space:none; border:1px solid gray; padding:2px; position:relative; width:25px; color:green'>".$farmerName."</a>";

}else{
return '<b><font color="red"><span class= "xedit" id="'.$uri.'">'.$farmerCode.'</span></font></b>';		
}	
}


function getMonitor($id){
$mSql = "SELECT * from mhv.tblmhvstaff where staffcode='$id'";
$result = mysql_query($mSql);
$row = mysql_fetch_array($result);
return $row['staffcode'].' ' . $row["staffname"];	
}
?>



  <script type="text/javascript">
        var tableToExcel = (function () {
            var uri = 'data:application/vnd.ms-excel;base64,'
                , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
                , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
                , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
            return function (table, name) {
                if (!table.nodeType) table = document.getElementById(table)
                var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
                window.location.href = uri + base64(format(template, ctx))
            }
        })()
		
		
		</script>
		
	
		
		
<style type="text/css">

 #map { width: 1200px; 
		height:480px; 
		border: 0px; 
		padding-top: 10px; 
		padding-right: 10px; 
		padding-left: 10px; 
		margin-right: 10px;
		box-shadow: 0px 0px 5px #888;
	  }
	

	

.content {
	min-height: 10%;
	position: relative;
	z-index: 0; 
	margin: 5;
	padding: 5;
	}

.background {
	position: absolute;
	z-index: -1;
	top: 0;
	bottom: 0;
	margin: 0;
	padding: 0;
}

.top_block {
	width: 100%;
	display: block; 
}

.bottom_block {
	position: absolute;
	width: 100%;
	display: block;
	bottom: 0; 
}

.left_block {
	display: block;
	float: left; 
}

.right_block {
	display: block;
	float: right; 
}

.center_block {
	display: block;
	width: auto; 
}

.background.right {
	height: auto !important;
	padding-bottom: 0;
	right: 0;
	width: 290px;
	background-color: #ffffff; 
}

.right {
	height: auto;
	width: 290px;
	padding-bottom: 0px;
}
<style>
.tooltip {
  outline: none; position: absolute;
  min-width: 120px; max-width: 255px;
}

.tooltip .tool-content {
  opacity: 0; visibility: hidden;
  position: absolute;
}

.tooltip:hover .tool-content {
  background: #999; border: 1px solid #555; color: #000000;

  /* general styling */
  position: absolute; left: 1.3em; top: 2.6em; z-index: 99;
  visibility: visible; opacity: 1;
}
</style>

</style>