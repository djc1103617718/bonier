<?php
use yii\helpers\Url;
?>
<!DOCTYPE HTML>
<html>
<head>
<title>所有商品</title>
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
<body onload="time_fun()" style="background:#FF7575">
	<div class="container">
		<div class="index_slider" name="头部轮播图">
			<ul class="rslides" id="slider">
				<?php if ($mold && !empty($mold['top_carousels'])){
					$baseUrl = 'http://localhost:8081/bonier/frontend/web/';
					foreach ($mold['top_carousels'] as $url) {
						echo "<li><img src=$baseUrl$url class='img-responsive' alt=''/></li>";
					}
				} else {?>
					<li><img src="<?=Url::to('@web/images/picture1.jpg', true)?>" class="img-responsive" alt=""/></li>
					<li><img src="<?=Url::to('@web/images/picture2.jpg', true)?>" class="img-responsive" alt=""/></li>
					<li><img src="<?=Url::to('@web/images/picture3.jpg', true)?>" class="img-responsive" alt=""/></li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div class="container">
		<marquee direction="up" behavior="scroll" scrollamount="1" scrolldelay="0" loop="-1" width=100% height="70" bgcolor="#CE0000" vspace="10">
			央视网消息（新闻联播）：国家主席习近平19日在人民大会堂集体会见来华出席金砖国家外长会晤的俄罗斯外长拉夫罗夫、南非外长马沙巴内、巴西外长努内斯、印度外交国务部长辛格。
		</marquee>
	</div>

	<div class="container">
		<div align="center" style="background:#CE0000">
			<h3> 活动结束时间: </h3>
			<ul id="countdown">
			</ul>
			<ul class="navigation">
				<li>
					<p class="timeRefDays">DAYS</p>
				</li>
				<li>
					<p class="timeRefHours">HOURS</p>
				</li>
				<li>
					<p class="timeRefMinutes">MINUTES</p>
				</li>
				<li>
					<p class="timeRefSeconds">SECONDS</p>
				</li>
			</ul>
			<h3> <?=$mold['pageviews']?> </h3>
		</div>
	</div>

	<div class="content_top">
		<div class="container">
			<div class="grid_2">
				<?php if (empty($mold['products'])) { ?>
				<!--<div class="col-md-3 span_6">
				  <div class="box_inner">
					<img src="images/picture8.jpg" class="img-responsive" alt=""/>
					 <div class="sale-box"> </div>
					 <div class="desc">
						<p>0参与，剩0件</p>
						<p>零售价：xxx元</p>
						<ul class="list2">
						  <li class="list2_right"><span class="m_1"><a href="<?/*=Url::to('@web/js/script.js', true)*/?>" class="link">我要参与</a></span></li>
						  <li class="list2_left"><span class="m_2"><a class="link1">底价0元</a></span></li>
						  <div class="clearfix"> </div>
						</ul>
					 </div>
				   </div>
				</div>-->
				<?php } else {
					$i = 0;
					foreach ($mold['products'] as $index => $product) {
						if ($i >5) {
							break;
						}
						$url = isset($userProductImgList[$product['media_id']]) ? $userProductImgList[$product['media_id']]:null;
						echo '<div class="col-md-3 span_6">';
						echo '<div class="box_inner">';
						echo "<img src='$baseUrl$url' class='img-responsive' alt=''/>";
						echo '<div class="sale-box"> </div>';
						echo '<div class="desc">';
						echo "<p>{$product['participants']}人参与，剩{$product['lave_num']}件</p>";
						$start_price = $product['start_price']/100;
						$reserve_price = $product['reserve_price']/100;
						echo "<p>零售价：{$start_price}元</p>";
						echo '<ul class="list2">';
						$join_url = \yii\helpers\Url::to(['join/index', 'id' => $mold['id'], 'product_id' => $product['id']]);
						echo "<li class='list2_right'><span class='m_1'><a href='{$join_url}' class='link'>我要参与</a></span></li>";
						echo "<li class='list2_left'><span class='m_2'><a class='ink1'>底价{$reserve_price}元</a></span></li>";
						$i++;
						echo '<div class="clearfix"> </div></ul></div></div></div>';
					}
				}?>

				<div class="clearfix"> </div>
			</div>

		</div>
	</div>
	<div class="content_middle">
		<div class="container">
			<ul class="promote">
				<i class="promote_icon"> </i>
				<li class="promote_head"><h3>Promotion</h3></li>
			</ul>
			 <ul id="flexiselDemo3">
				 <?php
				 if (count($mold['products']) > 6) {
					 $i = 6;
					 foreach ($mold['products'] as $index => $product) {
						 $url = isset($userProductImgList[$product['media_id']]) ? $userProductImgList[$product['media_id']]:null;

						 echo "<li><img src='$baseUrl$url'  class='img-responsive' />";
						 echo '<div class="grid-flex">';
						 $start_price = $product['start_price']/100;
						 $reserve_price = $product['reserve_price']/100;
						 $join_url = \yii\helpers\Url::to(['join/index']);
						 echo "<h4>{$product['participants']}人参与，剩{$product['lave_num']}件，零售价：{$start_price}元 </h4><p>底价：{$reserve_price}元</p>";
						 echo "<div class='m_3'><a href='{$join_url}' class='link2'>我要参与</a></div>";
						 echo '<div class="ticket"> </div>';
						 echo '</div>';
						 echo '</li>';
					 }

				 }?>
<!--				<li><img src="images/n5.jpg"  class="img-responsive" />-->
<!--					<div class="grid-flex">-->
<!--						<h4>1525人参与，剩41件，零售价：99元 </h4><p>底价：8元</p>-->
<!--					<div class="m_3"><a href="bargain_page.html" class="link2">我要参与</a></div>-->
<!--					<div class="ticket"> </div>-->
<!--					</div>-->
<!--				</li>-->



			 </ul>
			<script type="text/javascript">
				 $(window).load(function() {
					$("#flexiselDemo3").flexisel({
						visibleItems: 6,
						animationSpeed: 1000,
						autoPlay:true,
						autoPlaySpeed: 3000,
						pauseOnHover: true,
						enableResponsiveBreakpoints: true,
						responsiveBreakpoints: {
							portrait: {
								changePoint:480,
								visibleItems: 1
							},
							landscape: {
								changePoint:640,
								visibleItems: 2
							},
							tablet: {
								changePoint:768,
								visibleItems: 3
							}
						}
					});

				});
			</script>
			<script type="text/javascript" src="<?=Url::to('@web/js/jquery.flexisel.js', true)?>"></script>
		</div>
	</div>

	<div class="footer">
		<div class="container">
			<p class="copy" style="margin-top:-20px">Copyright &copy; 2017.公司名字</p>
			<p class="copy">联系电话：0731-12345678 15515151234 </p>
			<p class="copy" style="margin-bottom:10px">技术支持：15773276075</p>
		</div>
	</div>
	<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
	<div id="bottom">
		<a class="acount-btn" href="<?=$allProductUrl?>" style="float:left;margin-left:20px;border-radius:100px">全部商品</a>
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['share/address', 'id' => $mold['id']]);?>" style="border-radius:100px">领取地址</a>
		<a class="acount-btn" href="<?=\yii\helpers\Url::to(['join/my-product', 'id' => $mold['id']])?>" style="float:right;margin-right:20px;border-radius:100px">我的商品</a>
	</div>
</body>
</html>		