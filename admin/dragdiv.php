<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
#sidebar {
	width: 260px;
	padding: 10px;
	float: left;
	margin-top: 5px;
	margin-right: 0px;
	margin-bottom: auto;
	margin-left: auto;
	border: thin solid blue;
	background-color: #FFF;
}
.sidebar_a1  {
	width: 254px;
	height: 254px;
	margin-left: auto;
	margin-right: auto;
	/*margin-top: 10px;*/
	border: 1px solid red;
}
.sidebar_a2  {
	width: 254px;
	height: 254px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 10px;
	border: 1px solid red;
}
.sidebar_sub_a  {
	width: 125px;
	height: 125px;
	border: 1px solid green;
	float: left;
}
.sidebar_sub_b  {
	width: 125px;
	height: 125px;
	border: 1px solid green;
	float: right;
}
-->
</style>
<script type="text/javascript" src="/js/mootools.js"></script>
</head>
<body>
<div id="sidebar">
  <div id="item_list" class="sidebar_a2">

    <!--These are the top two left and right-->                            
        <div id="item_1" class="sidebar_sub_a">
  			<img src="adverts/images/smallad/test_125.jpg" width="125" height="125" />
        </div>
        <div id="item_2" class="sidebar_sub_b">
            <img src="adverts/images/smallad/test2_125.png" width="125" height="125" />
        </div>
    
    <!--These are the bottom two left and right-->               
        <div id="item_3" class="sidebar_sub_a">
            <img src="adverts/images/smallad/test3_125.jpg" width="125" height="125" />
        </div>
        <div id="item_4" class="sidebar_sub_b">
            <img src="adverts/images/smallad/test4_125.jpg" width="125" height="125" />
        </div>
	</div>
</div>
<script type="text/javascript">
new Sortables($('item_list'), {
onComplete: function() {
new Ajax("reorder.php?order="+this.serialize(function(el) {
return el.id.replace("item_","");
})).request();
}
});
</script>
</body>
</html>