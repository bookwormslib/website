
load = function() {
  load.getScript("js/jquery-1.6.1.min.js");
  load.getScript("js/jquery.prettyPhoto.js");
  load.getCSS("css/prettyPhoto.css");
  load.tryReady(0); // We will write this function later. It's responsible for waiting until jQuery loads before using it.
}

load.getScript = function(filename) {
  var script = document.createElement('script')
  script.setAttribute("type","text/javascript")
  script.setAttribute("src", filename)
  if (typeof script!="undefined")
  document.getElementsByTagName("head")[0].appendChild(script)
}


load.getCSS = function(filename) {

var css = document.createElement('link');
css.setAttribute("rel","stylesheet");
css.setAttribute("href",filename);
css.setAttribute("type","text/css");
css.setAttribute("charset","utf-8");

  if (typeof css !="undefined")
  document.getElementsByTagName("head")[0].appendChild(css)


}


load.tryReady = function(time_elapsed) {
  // Continually polls to see if jQuery is loaded.
  if (typeof $ == "undefined") { // if jQuery isn't loaded yet...
    if (time_elapsed <= 75000) { // and we havn't given up trying...
      setTimeout("load.tryReady(" + (time_elapsed + 200) + ")", 200); // set a timer to check again in 200 ms.
    } else {
      alert("Timed out while loading jQuery.")
    }
  } else {
    // Any code to run after jQuery loads goes here!
    // for example:
    
				$("area[rel^='prettyPhoto']").prettyPhoto();				
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
				$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});								
  }
}


function ld()
{
document.getElementById("lightbox").innerHTML = '<div id="contact" style="display:none;"> <p style="text-align:justify;">	<FONT SIZE="4">CONTACT US</FONT><br/> <img align="left" width="100" height="150"  src="images/contactus.jpg" /> <div style="float:left;padding-left:10px"> <b>Phone:</b> 044-24899779 / 044-42698327<br/><br/> <b>Email:</b> <a href mailto: "info@bookwormslib.com"> info@bookwormslib.com </a><br/><br/> <b>Postal Address</b><br/> Bookworms&#39; Library<br/> 334/B, Lakshmanaswamy Salai,<br/> KK Nagar<br/> Chennai-600078<br/> </div> </p></div>		<div id="corporate" style="display:none;"> <p style="text-align:justify;">	<FONT SIZE="4">CORPORATE</FONT><br/> <img align="left" width="100" height="150"  src="images/corporate.jpg" /> <div style="float:left;padding-left:10px">"For availing special corporate discounts,<br/> group memberships and for setting up<br/> personalised libraries, contact us!"<br/> </div> </p>';

}



