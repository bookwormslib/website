<?php
Header("content-type: application/x-javascript");
require_once("db.php");
$query = "select title,inventory_no from inventory order by inventory_id desc limit 10";
$res = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error(mysqli_query));
?>


                                     
Article = new Array;
i=0;

<?php
while ($line = mysql_fetch_array($res, MYSQL_ASSOC))
{
?>

Article[i] = new Array ("<?php echo $line['title'];?>", "bdetail.php?invno=<?php echo $line['inventory_no'];?>", "_self");i++  

<?php
}
?> 

function buildScroller()
{
          scrolltext ='<div><p><br>';
      for (x=0; x<(Article.length); x++)
      {       
         scrolltext+='<a href="' + Article[x][1] + '">' + Article[x][0] + '</a><br><br>';
      }
          scrolltext+='</ul></div>';
    document.writeln(scrolltext);
}

	var slideTimeBetweenSteps = 30;	// General speed variable (Lower = slower)
	var scrollingContainer = false;
	var scrollingContent = false;
	var containerHeight;
	var contentHeight;	
	
	var contentObjects = new Array();
	var originalslideSpeed = false;
	function slideContent(containerId)
	{
		var topPos = contentObjects[containerId]['objRef'].style.top.replace(/[^\-0-9]/g,'');
		topPos = topPos - contentObjects[containerId]['slideSpeed'];
		if(topPos/1 + contentObjects[containerId]['contentHeight']/1<0)topPos = contentObjects[containerId]['containerHeight'];
		contentObjects[containerId]['objRef'].style.top = topPos + 'px';
		setTimeout('slideContent("' + containerId + '")',slideTimeBetweenSteps);
		
	}
	
	function stopSliding()
	{
		var containerId = this.id;
		contentObjects[containerId]['slideSpeed'] = 0;	
	}
	
	function restartSliding()
	{
		var containerId = this.id;
		contentObjects[containerId]['slideSpeed'] = contentObjects[containerId]['originalSpeed'];
		
	}
	function initSlidingContent(containerId,slideSpeed)
	{
		scrollingContainer = document.getElementById(containerId);
		scrollingContent = scrollingContainer.getElementsByTagName('DIV')[0];
		
		scrollingContainer.style.position = 'relative';
		scrollingContainer.style.overflow = 'hidden';
		scrollingContent.style.position = 'relative';
		
		scrollingContainer.onmouseover = stopSliding;
		scrollingContainer.onmouseout = restartSliding;
		
		originalslideSpeed = slideSpeed;
		
		scrollingContent.style.top = '0px';
		
		contentObjects[containerId] = new Array();
		contentObjects[containerId]['objRef'] = scrollingContent;
		contentObjects[containerId]['contentHeight'] = scrollingContent.offsetHeight;
		contentObjects[containerId]['containerHeight'] = scrollingContainer.clientHeight;
		contentObjects[containerId]['slideSpeed'] = slideSpeed;
		contentObjects[containerId]['originalSpeed'] = slideSpeed;
		
		slideContent(containerId);
		
	}
	

