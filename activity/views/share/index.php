<?php
use yii\helpers\Url;
?>
<!DOCTYPE HTML>
<html>
<head>
<title> <?=$wechat->nickname . '在参与[' . $mold['name'] . ']砍价活动, 您也试试!!!'; ?></title>
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
<?php $baseUrl = Yii::$app->params['frontend_host'] . '/';?>
<!--<audio id="audio1">
	<source src="<?/*=$baseUrl . $mold['music']*/?>">
</audio>-->
	<div class="container" style="padding-left:5px;padding-right:5px">
		<div class="index_slider">
			<ul class="rslides" id="slider">
				<?php
				if ($mold && !empty($mold['top_carousels'])){
					foreach ($mold['top_carousels'] as $url) {
						echo "<li><img src=$baseUrl$url class='img-responsive' style='width:100%;height:30%' alt=''/></li>";
					}
				} else {?>
					<li><img src="<?=Url::to('@web/images/picture1.jpg', true)?>" class="img-responsive" style="width:100%;height:30%" alt=""/></li>
					<li><img src="<?=Url::to('@web/images/picture2.jpg', true)?>" class="img-responsive" style="width:100%;height:30%" alt=""/></li>
					<li><img src="<?=Url::to('@web/images/picture3.jpg', true)?>" class="img-responsive" style="width:100%;height:30%" alt=""/></li>
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
		<div class="container">
			<div class="grid_2">
				<div class="col-md-3 span_6">
				  <div class="box_inner">
					  <?php
					  $url = isset($userProductImgList[$mold['product']['media_id']]) ? $userProductImgList[$mold['product']['media_id']]:null;
					  ?>
					<img src="<?=$baseUrl.$url?>" class="img-responsive" style="height:320px;width:100%" alt=""/>
					 <div class="sale-box"> </div>
				  	 <img class="image" src="<?=$wechat['avatar']?>" style="margin-top:10px" />
				  	 <p><font size="1" face="Verdana"><?=$wechat['nickname']?></font></p>
					  <p>已减价<?=$order->bargained_num?>次，还需减价<?=$mold['product']['bargain_num']-$order->bargained_num?>次</p>
					  <p>当前<a style="background:#CE0000"><?=$order->price/100?></a>元，可降至<?=$mold['product']['reserve_price']/100?>元</p>
					 <div class="desc">
						<ul class="list2">
							<?php
							$join_url = \yii\helpers\Url::to(['site/index', 'id' => $order->act_id]);
							$help_bargain_url = \yii\helpers\Url::to(['join/help-bargain', 'id' => $order->order_number]);
							$help_bargain_url = \yii\helpers\Url::to(['join/help-bargain', 'id' => $order->order_number, $help_bargain_url]);
							?>
						    <li class="list2_right"><span class="m_1"><a href="<?=\yii\helpers\Url::to(['site/index', 'id' => $order->act_id])?>" class="link">我要参与活动</a></span></li>
						    <li class="list2_left"><span class="m_2"><a href="<?=\yii\helpers\Url::to(['join/help-bargain', 'id' => $order->order_number])?>" class="link1">帮他砍价</a></span></li>
						    <div class="clearfix"> </div>
						</ul>
					 </div>
				   </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<div style="padding:20px;color: #ffffff"> 打开微信客户端的<span style="font-weight: bold;color: #ac2925"> [分享给朋友] </span>就可以邀请好友帮忙砍价了</div>

	<img src="<?=$baseUrl.$mold['bottom_img']?>" style="margin-top:10px;width:100%">
	<div class="footer">
		<div class="container">
			<p class="copy" style="margin-top:-20px">Copyright &copy; 2017.<?=$shop_name?></p>
			<p class="copy">联系电话：<?=$address['Landline'] . ' ' . $address['phone']?> </p>
			<p class="copy" style="margin-bottom:10px">技术支持：15773276075</p>
		</div>
	</div>
	<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
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