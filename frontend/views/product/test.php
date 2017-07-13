<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 17/7/13
 * Time: 下午5:28
 */
$time = 1499939709 + 60*60;
?>
<div id="time">

</div>
<script type="text/javascript">
    //下面方法把相差的时间组合成倒计时的字符串，然后放到页面相应位置实现，实时刷新
    function CountDown(time){
        var max_time = time;//截止到的日期
        var now=parseInt((new Date().getTime())/1000);//获取当前的日期
        var cha_time = max_time - now;//中间所差的时间
        if(cha_time>=0){
            var day = Math.floor(cha_time/3600/24);
            var hour= Math.floor((cha_time/3600)%24);
            var minutes = Math.floor((cha_time/60)%60);
            var seconds = Math.floor(cha_time%60);
            msg = "离结束还有"+day+"天"+hour+"小时"+minutes+"分"+seconds+"秒";
            $("#time").html(msg);
            //--cha_time;
        }
        else{
            clearInterval(timer);
            alert("时间到，结束!");
        }
    }
    var time = <?=$time?>;
    setInterval("CountDown(time)",1000);
</script>
