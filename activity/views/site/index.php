<?php
use yii\helpers\Url;
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?=$shop_name?></title>
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
	.stamp {
	  position: absolute;
	  display: inline-block;
	  padding: 10px;
	  position: relative;
	  background: radial-gradient( transparent 0px, transparent 4px, white 4px, white );
	  background-size: 20px 20px;
	  background-position: -10px -10px;
	}
	.stamp:after {
	  content: '';
	  position: absolute;
	  left: 5px;
	  top: 5px;
	  right: 5px;
	  bottom: 5px;
	  box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.5);
	  z-index: -1;
	}
	#audio1 {
	border-style:ridge;
    border-color:#c3eefd;
    border-width:15px;
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
<script>
function playmusic() {
document.getElementById("audio1").play();
}
</script>
<script src="<?=Url::to('@web/js/jquery.countdown.js', true)?>"></script>
<script src="<?=Url::to('@web/js/script.js', true)?>"></script>
</head>
<body onload="playmusic();" style="background:#217307">
    <audio id="audio1">
	    <source src="Kalimba.mp3">
    </audio>
<?php $baseUrl = Yii::$app->params['frontend_host'] . '/';?>
	<div class="container" style="padding-left:5px;padding-right:5px">
		<div class="index_slider" name="头部轮播图">
			<ul class="rslides" id="slider">
				<?php
				if ($mold && !empty($mold['top_carousels'])){
					foreach ($mold['top_carousels'] as $url) {
						echo "<li><img src=$baseUrl$url class='img-responsive' style='width:100%;height:30%' alt=''/></li>";
					}
				} else {?>
					<li><img src="<?=Url::to('@web/images/picture1.jpg', true)?>" style="width:100%;height:30%" class="img-responsive" alt=""/></li>
					<li><img src="<?=Url::to('@web/images/picture2.jpg', true)?>" style="width:100%;height:30%" class="img-responsive" alt=""/></li>
					<li><img src="<?=Url::to('@web/images/picture3.jpg', true)?>" style="width:100%;height:30%" class="img-responsive" alt=""/></li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div class="container" style="padding-left:5px;padding-right:5px">
		<marquee direction="up" behavior="scroll" scrollamount="1" scrolldelay="0" loop="-1" width=100% height="70" bgcolor="#2b9c4a" vspace="10"><font color="#ffffff">
		<?= $mold['announcement']?>
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

	<div class="container" style="margin-top:10px;padding-left:5px;padding-right:5px">
		<div align="center" style="background: #2b9c4a"><font color="#ffffff">
			<h3 > 访问量:<?=$mold['pageviews']?>  </h3>
		</div>
	</div>

	<?php if (empty($mold['products'])) { ?>
	<?php } else {
		foreach ($mold['products'] as $index => $product) {
			$url = isset($userProductImgList[$product['media_id']]) ? $userProductImgList[$product['media_id']]:null;
			echo '<div class="container stamp" style="margin-top:10px;padding-left:5px;padding-right:5px;width:100%">';
			echo '<div style="background:#ffffff;padding-top:5px;padding-bottom:5px;margin-top:3px;">';
			echo "<img src='$baseUrl$url' style='float:left;margin-left:5px' height='100px' width='100px'>";
			echo "<p style='padding-left:115px;color:#000'>{$product['name']}</p>";
			echo "<p style='padding-left:115px;color:#000;font-size:10px;margin-top:10px'>{$product['participants']}人参与，剩{$product['lave_num']}件</p>";
			$start_price = $product['start_price']/100;
			$reserve_price = $product['reserve_price']/100;
			echo "<p style='padding-left:115px;color:#000;font-size:10px'>零售价：{$start_price}元</p>";
			echo '<ul class="list2" style="margin-top:10px;padding-right:10px">';
			$jUrl = \yii\helpers\Url::to(['join/order-before', 'id' => $mold['id'], 'product_id' => $product['id']]);
			$join_url = \yii\helpers\Url::to(['join/order-before', 'id' => $mold['id'], 'product_id' => $product['id'], 'ref' => $jUrl]);
			echo "<li class='list2_left'><a class='acount-btn' style='margin-left:20px;border-radius:100px;font-size:15px;padding:0.1em 1.0em;background:#f71b1b'>底价{$reserve_price}元</a></li>";
			echo "<li class='list2_right'><a class='acount-btn' href='{$join_url}' style='margin-left:20px;border-radius:100px;font-size:15px;padding:0.1em 1.0em'>我要参与</a></li>";
			echo '<div class="clearfix"> </div></ul></div></div>';
		}
	}?>

	<img src="images/picture10.jpg" style="margin-top:10px;width:100%">

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
		<a class="acount-btn" href="<?=$allProductUrl?>" style="float:left;margin-left:20px;border-radius:100px">全部商品</a>
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['share/address', 'id' => $mold['id']]);?>" style="border-radius:100px">领取地址</a>
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['join/my-product', 'id' => $mold['id'], 'ref' => $my_product_url])?>" style="float:right;margin-right:20px;border-radius:100px">我的商品</a>
	</div>
</body>
</html>