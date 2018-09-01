$('a').tooltip();
$('#grid-mhv-tabs a').click(function (e) {
e.preventDefault();
$(this).tab('show');
})
function iframeLoaded(iFrameID,stop) 
{
if(iFrameID) 
{
iFrameID.height = "";
if(iFrameID.contentDocument){
iFrameID.height = iFrameID.contentDocument.body.offsetHeight + 35;
} else {
iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + 45 + "px";
}
}
if (!stop)
setTimeout(function(){iframeLoaded(iFrameID,1);},1000);
}

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-328064-23', 'auto');
ga('send', 'pageview');