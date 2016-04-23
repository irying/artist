<?php

$this->registerCssFile('@web/css/own.css', ['depends' => app\assets\AppAsset::className()]);
// $this->registerCssFile('@web/js/own.js', ['depends' => app\assets\AppAsset::className()]);

?>

<div class="blank3">
</div>
<div class="con">
	<div class="self">
    	<img src="images/touxiang.jpg" />
        <div class="self_word">
        	<br />
        	<h3><?= Yii::$app->user->identity->username ?></h3>
            <br />
            <p class="sign">To be or not to be.</p>
        </div>
    </div>
    <div class="blank2">
	</div>
	<div class="line">
    </div>
    <div class="online">
    	<br />
        <p style="font-size:14px; color:#666; margin-top:20px;">已经在潮人志在线127小时。</p>
        <br />
    </div>
</div>
<div class="self_shop">
	<ul>
    	<li><a href="#">收藏</a></li>
        <li><a href="#">积分</a></li>
        <li><a href="#">订单</a></li>
    </ul>
    <div class="shopbus">
    	<a href="<?= Yii::$app->urlManager->createUrl(['cart/shop']) ?>">我的购物车</a>
    </div>
    <div class="shopbus_img">
    	<img src="images/shopbus.png" />
    </div>
</div>
<div class="blank3">
</div>