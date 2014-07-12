
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Multi-page template</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css">
	<link rel="shortcut icon" href="../book.gif">
	
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>

	


<style>
@media all and (max-width: 50em) {
  .my-breakpoint .ui-block-a,
  .my-breakpoint .ui-block-b,
  .my-breakpoint .ui-block-c,
  .my-breakpoint .ui-block-d,
  .my-breakpoint .ui-block-e {
    width: 100%;
    float:none;
  }
}
</style>

</head>

<body>

<div data-role="page">

	<div data-role="header">
		<h1><img src="../book.gif" alt="Low resolution logo" class="align-left" width="15%" />bookworms'<sup>2001</sup></h1>
	</div>

	<div data-role="header">
		<form action="search.php" method="post" data-ajax="false">
		     <input type="search" name="query" id="search-1" value="" placeholder="Search Titles, Authors, Subject">
		</form>
	</div>

	<div role="main" class="ui-content">


	<ul id="listview" data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true">
    <li><a href="#">
        <img src="../_assets/img/album-bb.jpg">
    <h2>Broken Bells</h2>
    <p>Broken Bells</p></a>
        <a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop">Purchase album</a>
    </li>
    <li><a href="#">
        <img src="../_assets/img/album-hc.jpg">
    <h2>Warning</h2>
    <p>Hot Chip</p></a>
        <a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop">Purchase album</a>
    </li>
    <li><a href="#">
        <img src="../_assets/img/album-p.jpg">
    <h2>Wolfgang Amadeus Phoenix</h2>
    <p>Phoenix</p></a>
        <a href="#purchase" data-icon="plus" data-rel="popup" data-position-to="window" data-transition="pop">Purchase album</a>
    </li>
</ul>

<div data-role="popup" id="purchase" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
    <h3>Purchase Album?</h3>
<p>Your download will begin immediately on your mobile device when you purchase.</p>
    <a href="index.html" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check ui-btn-icon-left ui-btn-inline ui-mini">Buy: $10.99</a>
    <a href="index.html" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-mini">Cancel</a>
</div>

<input type="button" value="Show More" onclick="loadmore()" data-icon="delete" data-theme="a">

	</div><!-- /content -->

	<div data-role="footer">
		<h4>&copy; 2012-2014 bookworms' library</h4>
	</div><!-- /footer -->

</div><!-- /page -->


<script language>

var q = "<?=$_POST['query']?>";

function loadmore()
{


  // Send the data using post
  var posting = $.post( "services/searchService.php", { query: q } );
 
  // Put the results in a div
  posting.done(function( data ) {
    	alert(data);
  });



$("#listview").append("<li class='ui-li-has-alt ui-li-has-thumb ui-first-child'> <a class='ui-btn' href='#'>  <img src='../_assets/img/album-p.jpg'><h2>Wolfgang Amadeus Phoenix</h2><p>Phoenix</p> </a> <a href='#purchase' data-icon='plus' data-rel='popup' data-position-to='window' data-transition='pop' class='ui-btn ui-btn-icon-notext ui-icon-plus ui-btn-a'  >Purchase album</a></li>");

$("#listview").append("<li class='ui-li-has-alt ui-li-has-thumb'> <a class='ui-btn' href='#'>  <img src='../_assets/img/album-p.jpg'><h2>Wolfgang Amadeus Phoenix</h2><p>Phoenix</p> </a> <a href='#purchase' data-icon='plus' data-rel='popup' data-position-to='window' data-transition='pop' class='ui-btn ui-btn-icon-notext ui-icon-plus ui-btn-a'  >Purchase album</a></li>");

$("#listview").append("<li class='ui-li-has-alt ui-li-has-thumb ui-last-child'> <a class='ui-btn' href='#'>  <img src='../_assets/img/album-p.jpg'><h2>Wolfgang Amadeus Phoenix</h2><p>Phoenix</p> </a> <a href='#purchase' data-icon='plus' data-rel='popup' data-position-to='window' data-transition='pop' class='ui-btn ui-btn-icon-notext ui-icon-plus ui-btn-a'  >Purchase album</a></li>");


} 


$(document).ready(function(){

$("#search-1").val(q);

    });



</script>


</body>
</html>
