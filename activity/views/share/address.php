<?php
use yii\helpers\Url;
?>
<!DOCTYPE HTML>
<html>
<head>
<title>领取地址</title>
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
	.image{width:50px;height:50px;border-radius:100px}
</style>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Custom Theme files -->
<link href="<?=Url::to('@web/css/style.css', true)?>" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="<?=Url::to('@web/css/jquery.countdown.css', true)?>" />
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
<script src="<?=Url::to('@web/js/responsiveslides.min.js', true)?>"></script>

<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
</head>
<body style="background:#FFFFFF">
	<div class="men">
		<div class="container">
			<div class="wishlist">
			  	<h4 class="title" align="center">门店地址</h4>
				<?php $address_url = Yii::$app->params['frontend_host'] . '/' . $address['media_img'];?>
				<img src=<?=$address_url?> style="float:left;margin-right:10px" height="100px" width="100px" />
				<h5><strong><?=$shop_name?></strong></h5>
				<p><font size="1" face="Verdana">电话：<?=$address['Landline']. ' ' . $address['phone']?></font></p>
				<p><font size="1" face="Verdana">地址：<?=$address['address']?></font></p>
				<h4 class="title" style="margin-top:30px"></h4>
			 </div>
		 </div>
	</div>
	<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
	<div id="bottom">
		<?php
		$my_product_url = \yii\helpers\Url::to(['join/my-product', 'id' => $act_id]);
		?>
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['site/index', 'id' => $act_id])?>" style="float:left;margin-left:20px;border-radius:100px">全部商品</a>
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['share/address', 'id' => $act_id])?>" style="border-radius:100px">领取地址</a>
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['join/my-product', 'id' => $act_id, 'ref' => $my_product_url])?>" style="float:right;margin-right:20px;border-radius:100px">我的商品</a>
	</div>
</body>
</html>