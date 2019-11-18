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


function showHide(value){

var accounttype=$("#accounttype").val();
var isfullpayment=$("#isfullpayment").val();
    
if(accounttype==='Fee_Income'){

$("#tr_isfullpayment").show();


if(isfullpayment==='No'){
$("#tr_notificationdate").show();    
    
}else{
 $("#tr_notificationdate").hide();    
    
}



}else{
$("#tr_isfullpayment").hide();

} 




   
    
}


function showHideOnEdit(accounttype,isfullpayment){

if(accounttype==='Fee_Income'){

$("#tr_isfullpayment").show();


if(isfullpayment==='No'){
$("#tr_notificationdate").show();    
    
}else{
 $("#tr_notificationdate").hide();    
    
}

}else{
$("#tr_isfullpayment").hide();
$("#tr_notificationdate").hide();
} 




   
    
}



function do_onload(ids){
	
var grid = $("#listTransaction");

credit = grid.jqGrid('getCol', 'credit', false, 'sum');
grid.jqGrid('footerData','set', {credit:''});
grid.jqGrid('footerData','set', {credit:credit.toLocaleString()});

debit = grid.jqGrid('getCol', 'debit', false, 'sum');
grid.jqGrid('footerData','set', {debit:''});
grid.jqGrid('footerData','set', {debit:debit.toLocaleString()});

}

