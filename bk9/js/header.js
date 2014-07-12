document.write('<div id="header">\
        <div id="logo"><a href="index.html" title="Bookworm Library"><img src="images/home/logo.gif" width="100px" alt="logo" border="0"></a></div> \
		<br clear="all"/> \
		<div id="header_text"><a href="index.html" title="Bookworm Library"><img src="images/home/bookworktext.png"  width="350px" alt="logo" border="0"></a></div> \
      <div id="header_search"> \
	<form id="searchbox" action="search_result.php"> \
												<div> \
	<label><input height="35px" type="text" value="search library:" class="input" name="keyword" onblur="search_blur(this)" onfocus="search_onfocus(this)" size="30px" style="margin-top: 5px; padding-top: 0px; height: 26px; float: left;"></label> \
<input height="25" width="30" type="image" src="images/book_review/search_icon.png" style="padding-left: 5px; margin-top: 10px;"> \
<input type="hidden" value="1" name="page"> \
												</div> \
											</form> \
		</div> \
</div>');




function search_blur(obj)
{

if(obj.value=="") obj.value="search library:";
}

function search_onfocus(obj)
{
//alert(obj.value);
if(obj.value =="search library:" ) obj.value="";
}	