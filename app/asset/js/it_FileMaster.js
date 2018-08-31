
function grid_onload(ids){
if(ids.rows)
jQuery.each(ids.rows,function(i)
{
if (this.isinternal.toLowerCase() == 'yes')
{
jQuery('#list tr.jqgrow:eq('+i+')').css('background-image','inherit');
jQuery('#list tr.jqgrow:eq('+i+') td[aria-describedby=list_displayname]').css('background','inherit').css({'background-color':'#F3F781', 'color':'black'});
}
});
}

function do_onload(id){


}

$(document).ready(function() {
$(".various").fancybox({
maxWidth	: 800,
maxHeight	: 600,
fitToView	: false,
width		: '70%',
height		: '70%',
autoSize	: false,
closeClick	: false,
openEffect	: 'none',
closeEffect	: 'none'
});
});

function grid_select(id) { 
var grid = $('#list'); 
var rowid = grid.getGridParam('selrow'); 
var data = grid.getRowData(rowid); 
if (data.isinternal.toLowerCase() == 'yes') 
{      
jQuery("#edit_list").addClass("ui-state-disabled"); 
} 
else 
{ 
jQuery("#edit_list").removeClass("ui-state-disabled"); 
} 
}

$(document).ready(function() { 
$('.fancybox').fancybox(); 
}); 




