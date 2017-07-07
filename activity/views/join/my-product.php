<?php
use yii\helpers\Url;
?>
<!DOCTYPE HTML>
<html>
<head>
<title>我的商品列表</title>
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
	<div class="container" style="padding-left:5px;padding-right:5px">
		<div class="index_slider">
			<ul class="rslides" id="slider">
				<?php
				$baseUrl = Yii::$app->params['frontend_host'] . '/';
				if ($topCarousels){
					foreach ($topCarousels as $url) {
						echo "<li><img src=$baseUrl$url class='img-responsive' style='width:100%;height:400px' alt=''/></li>";
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
		<marquee direction="up" behavior="scroll" scrollamount="1" scrolldelay="0" loop="-1" width=100% height="70" bgcolor="#2b9c4a" vspace="10"><font color="#ffffff">
			<?= $activity['announcement']?>
		</marquee>
	</div>

	<div class="container" style="padding-left:5px;padding-right:5px">
		<div align="center" style="background: #2b9c4a"><font color="#ffffff">
			<h3> 活动结束时间: </h3>
			<ul id="countdown">
			</ul>
			<ul class="navigation" style="margin-top:-10px">
				<li>
					<p class="timeRefDays"  style="color:#ffffff">DAYS</p>
				</li>
				<li>
					<p class="timeRefHours" style="color:#ffffff">HOURS</p>
				</li>
				<li>
					<p class="timeRefMinutes" style="color:#ffffff">MINUTES</p>
				</li>
				<li>
					<p class="timeRefSeconds" style="color:#ffffff">SECONDS</p>
				</li>
			</ul>
		</div>
	</div>

	<div class="content_top">
		<div class="container">
			<div class="grid_2">
				<?php
				$base_url = Yii::$app->params['frontend_host'];
				if (!empty($myProducts)) {
					foreach ($myProducts as $myProduct) {
						$product_img = isset($userProductImgList[$myProduct['media_id']])?$userProductImgList[$myProduct['media_id']]:null;
						echo '<div class="col-md-3 span_6">';
						echo '<div class="box_inner">';
						echo "<img src='$base_url/$product_img' class='img-responsive' style='height:320px;width:100%' alt=''/>";
						echo '<div class="sale-box"> </div>';
						echo '<div class="desc">';
						$bargained_num = $orders[$myProduct['id']]['bargained_num'];
						$remained_bargain_num = $myProduct['bargain_num']-$orders[$myProduct['id']]['bargained_num'];
						$current_price = $orders[$myProduct['id']]['price']/100;
						echo "<p>已还价{$bargained_num}次，还可还价{$remained_bargain_num}次</p>";
						echo "<p>应付：{$current_price}元</p>";
						echo '<ul class="list2">';
						echo "<li class='list2_right'><span class='m_1'><a href='bargain_page.html' class='link'>立即查看</a></span></li>";
						echo '<div class="clearfix"></div>';
						echo '</ul>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
					}
				}
				?>
				<!--<div class="col-md-3 span_6">
				  <div class="box_inner">
					<img src='images/picture6.jpg' class='img-responsive' alt=''/>
					 <div class="sale-box"> </div>
					 <div class="desc">
						<p>已还价5次，还可还价15次</p>
						<p>应付：66.1元</p>
						<ul class="list2">
						  <li class="list2_right"><span class="m_1"><a href="bargain_page.html" class="link">立即查看</a></span></li>
						  <div class="clearfix"> </div>
						</ul>
					 </div>
				   </div>
				</div>-->

				<div class="clearfix"> </div>
			</div>
		</div>
	</div>

	<div class="footer">
		<div class="container">
			<p class="copy" style="margin-top:-20px">Copyright &copy; 2017.<?=$shop_name?></p>
			<p class="copy">联系电话：<?=$address['Landline'] . ' ' . $address['phone']?> </p>
			<p class="copy" style="margin-bottom:10px">技术支持：15773276075</p>
		</div>
	</div>
	<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
	<?php
	$myProduct_url = \yii\helpers\Url::to(['join/my-product', 'id' => $activity['id']]);
	?>
	<div id="bottom">
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['site/index', 'id' => $activity['id']])?>" style="float:left;margin-left:20px;border-radius:100px">全部商品</a>
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['share/address', 'id' => $activity['id']])?>" style="border-radius:100px">领取地址</a>
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['join/my-product', 'id' => $activity['id'], 'ref' => $myProduct_url])?>" style="float:right;margin-right:20px;border-radius:100px">我的商品</a>
	</div>
</body>
</html>