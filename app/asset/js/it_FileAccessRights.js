function grid_onload(ids){
if(ids.rows)
jQuery.each(ids.rows,function(i)
{
if (this.madd.toLowerCase() == 'yes' || this.medit.toLowerCase()=='yes')
{
jQuery('#list tr.jqgrow:eq('+i+')').css('background-image','inherit');
jQuery('#list tr.jqgrow:eq('+i+') td[aria-describedby=list_displayname]').css('background','inherit').css({'background-color':'#58FA58', 'color':'black'});
}
});
}
