$(".mpopup").fancybox({
		maxWidth	: 500,
		maxHeight	: 300,
		fitToView	: false,
		width		: '50%',
		height		: '50%',
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
