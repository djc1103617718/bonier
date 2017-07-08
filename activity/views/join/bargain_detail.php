<?php

use yii\helpers\Url;
?>
<!DOCTYPE HTML>
<html>
<head>
<title>帮助列表</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Gifty Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?=Url::to('@web/css/bootstrap.css', true)?>" rel='stylesheet' type='text/css' />
<style type="text/css">
	#bottom
	{
	position: fixed;
	width: 100%;
	height: 40px;
	background: #eee;
	bottom: 0px;
	background-color: rgba(0,0,0,0.5);
	text-align: center;
	}
</style>
<style>
    .image{width:30px;height:30px;border-radius:100px}
</style>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Custom Theme files -->
<link href="<?=Url::to('@web/css/style.css', true)?>" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<!--webfont-->
<!--<link href='http://fonts.useso.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
--><script type="text/javascript" src="<?=Url::to('@web/js/jquery-1.11.1.min.js', true)?>"></script>
<!-- dropdown -->
<script src="<?=Url::to('@web/js/jquery.easydropdown.js', true)?>"></script>
<!-- start menu -->
<link href="<?=Url::to('@web/css/megamenu.css', true)?>" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="<?=Url::to('@web/js/megamenu.js', true)?>"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
</head>
<body style="background:#217307">
	<div class="men" style="padding-bottom:23%">
		<div class="container" style="padding-left:5px;padding-right:5px">
			<div class="wishlist">
				<?php
				if ($bargainPartner) {
					foreach ($bargainPartner as $item) {
						echo "<h4 class='title' style='padding-bottom:7px'><img class='image' src='{$item["avatar"]}' />{$item['nickname']}<p style='float:right;margin-top:4px'>减了{$item['decrease_price']}元</p></h4>";
					}
				}
				?>
			 </div>
		 </div>
	</div>
	<div id="bottom">
		<a class="acount-btn" href="bargain_page_mine.html" style="border-radius:100px;padding-left:50px;padding-right:50px;margin-top:2px"> 返回</a>
	</div>
</body>
</html>		