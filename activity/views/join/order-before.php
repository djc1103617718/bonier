<?php

use yii\helpers\Url;
?>
<!DOCTYPE HTML>
<html>
<head>
<title>信息提交</title>
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
	z-index: 5;
	bottom: 0px;
	background-color: rgba(0,0,0,0.5);
	text-align: center;
	}
</style>
<style>
    .image{width:50px;height:50px;border-radius:100px}
</style>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Custom Theme files -->
<link href="<?=Url::to('@web/css/style.css', true)?>"  rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="<?=Url::to('@web/css/jquery.countdown.css', true)?>" />
<!-- Custom Theme files -->
<!--webfont-->
<!--<link href='http://fonts.useso.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
--><script type="text/javascript" src="<?=Url::to('@web/js/jquery-1.11.1.min.js', true)?>" ></script>
<!-- dropdown -->
<script src="<?=Url::to('@web/js/jquery.easydropdown.js', true)?>" ></script>
<!-- start menu -->
<link href="<?=Url::to('@web/css/megamenu.css', true)?>" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript"  src="<?=Url::to('@web/js/megamenu.js', true)?>"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script src="<?=Url::to('@web/js/responsiveslides.min.js', true)?>"></script>
<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: false,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
</script>
<script src="<?=Url::to('@web/js/jquery.countdown.js', true)?>"></script>
<script src="<?=Url::to('@web/js/script.js', true)?>"></script>
</head>
<body onload="time_fun()" style="background:#217307">
	<div class="container"  style="padding-left:5px;padding-right:5px">
		<div class="index_slider">
			<ul class="rslides" id="slider">
				<?php
				$baseUrl = Yii::$app->params['frontend_host'] . '/';
				if ($mold && !empty($mold['top_carousels'])){
					foreach ($mold['top_carousels'] as $url) {
						echo "<li><img src=$baseUrl$url class='img-responsive' style='width:100%;height:30%' alt=''/></li>";
					}
				} else {?>
					<li><img src="<?=Url::to('@web/images/picture1.jpg', true)?>" class="img-responsive" style="width:100%;height:400px" alt=""/></li>
					<li><img src="<?=Url::to('@web/images/picture2.jpg', true)?>" class="img-responsive" style="width:100%;height:400px" alt=""/></li>
					<li><img src="<?=Url::to('@web/images/picture3.jpg', true)?>" class="img-responsive" style="width:100%;height:400px" alt=""/></li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div class="container" style="padding-left:5px;padding-right:5px">
		<marquee direction="up" behavior="scroll" scrollamount="1" scrolldelay="0" loop="-1" width=100% height="40" bgcolor="#2b9c4a" vspace="10"><font color="#ffffff">
				<?= $mold['announcement']?>
		</marquee>
	</div>

	<div class="content_top" style="margin-top:-30px">
		<div class="container" style="padding-left:5px;padding-right:5px;padding-bottom:5%">
			<div class="grid_2">
				<div class="col-md-3 span_6">
					<form  style="padding-bottom:23.5%" method="post" action="<?=Url::to(['join/order-before', 'id' => $mold['id'], 'product_id' => $mold['product']['id'] ])?>">
						<input type="hidden" name="_csrf-activity" value="<?=Yii::$app->request->getCsrfToken()?>"/>
						<div style="margin-top:20%">
							<span>姓名<label>*</label></span>
							<input type="text" name="OrderBefore[name]">
						</div>
						<div>
							<span>电话<label>*</label></span>
							<input type="text" name="OrderBefore[phone]">
						</div>
						<input type="submit" value="提交" style="float:right">
						<div></div>
					</form>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>

	<div class="footer">
		<div class="container">
			<p class="copy" style="margin-top:-20px">Copyright &copy; 2017.公司名字</p>
			<p class="copy">联系电话：0731-12345678 15515151234 </p>
			<p class="copy" style="margin-bottom:10px">技术支持：15773276075</p>
		</div>
	</div>
	<div id="bottom">
		<?php
		$my_product_url = \yii\helpers\Url::to(['join/my-product', 'id' => $mold['id']]);
		?>
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['site/index', 'id' => $mold['id']])?>" style="float:left;margin-left:20px;border-radius:100px">全部商品</a>
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['share/address', 'id' => $mold['id']])?>" style="border-radius:100px">领取地址</a>
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['join/my-product', 'id' => $mold['id'], 'ref' => $my_product_url])?>" style="float:right;margin-right:20px;border-radius:100px">我的商品</a>
	</div>
</body>
</html>		