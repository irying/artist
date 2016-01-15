<!--头部-->
<div class="header">
	<!--导航栏-->
	<div class="nav">
    	<ul>
        	<li><a href="content_list.html">期刊</a></li>
            <li><a href="story_list.html">故事</a></li>
            <li><a href="own.html">专属</a></li>
            <li><a href="shop.html">订制</a></li>
        </ul>
		 <!--导航栏右上角-->
		<div class="nav_r" >
            <div id="navR">
            <?php if (Yii::$app->user->isGuest) { ?>
            	<a href="<?= Yii::$app->urlManager->createUrl(['site/login']);?>">登录</a><a href="<?= Yii::$app->urlManager->createUrl(['site/signup']);?>">/注册</a>
            <?php }else { ?>
                <a class="" href="<?= Yii::$app->urlManager->createUrl(['/user']) ?>"><?= Yii::$app->user->identity->username ?></a>&nbsp;(<a href="<?= Yii::$app->urlManager->createUrl(['site/logout']) ?>">退出</a>)
            <?php }?>
    	    </div>
    	</div>
    </div>
    <!--网站名字-->
    <div class="net">
    	<p class="net_name">style</p>
    </div>
    <div class="blank">
    </div>
</div>