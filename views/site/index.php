<?php
    $this->registerCssFile('@web/css/index.css', ['depends' => app\assets\AppAsset::className()]);
?>
<div class="menu">
    <h3>前线期刊</h3>
</div>

<div class="blank2">
</div>

<div class="main">
    <div class="left">
         <a href="#"><img src="images/vol.127.jpg" alt="" /></a>
         <div class="title">
            <a href="#">vol.127 万物生长</a>
         </div>
    </div>
    <div class="right">
        <div class="box1">
            <a href="<?= Yii::$app->urlManager->createUrl(['article/view', 'id' => '2']); ?>"><img src="images/vol.99.jpg" alt="" /></a>
            <div class="word">
               <a href="<?= Yii::$app->urlManager->createUrl(['article/view', 'id' => '2']); ?>">vol.99 盛夏光年</a>
            </div>
        </div>
        <div class="box2">
            <a href="<?= Yii::$app->urlManager->createUrl(['article/view', 'id' => '1']); ?>"><img src="images/vol.66.jpg" alt="" /></a>
            <div class="word">
               <a href="<?= Yii::$app->urlManager->createUrl(['article/view', 'id' => '1']); ?>">vol.66 了不起的盖茨比</a>
            </div>
        </div>
    </div>
</div>

<div class="blank">
</div>

<div class="menu">
    <h3>她的故事</h3>
</div>

<div class="blank2">
</div>

<div class="story">
    <div class="story_left">
        <div class="story_top">
            <a href="#"><img src="images/vol.83.1.jpg" /></a>
            <div class="story_title">
                <h3>香泽粉黛</h3>
                <p>The Best or Nothing</p>
            </div>
        </div>
        <div class="story_bottom">
            <span><img src="images/left.png" />
            <span>83岁高龄、全球最老的职业模特——卡门·戴尔·奥利菲斯。这位“冰山女王”以无人可敌的气场惊艳了我们。银发是她特有的标签，优雅是她独有的特质，这个连时间都拿她无可奈何的女人告诉我们：年龄不是美丽的敌人!</span>
            <span><img src="images/right.png" /></span>
        </div>
    </div>
    <div class="story_right">
        <div class="img1">
            <a href="#"><img src="images/vol.41.jpg" alt="" /></a>
            <div class="word">
               <a href="#" style="text-align:center;">朴信惠的荧幕</a>
            </div>
        </div>
        <div class="img2">
            <a href="#"><img src="images/vol.16.jpg" alt="" /></a>
            <div class="word">
               <a href="#" style="text-align:center;">欧文，及他的签名鞋</a>
            </div>
        </div>
    </div>
</div>
<div class="blank">
</div>

<div class="menu">
    <h3>精彩推荐</h3>
</div>

<div class="blank2">
</div>

<div class="wrapper">
    <ul>
        <li>
            <a href="#">
                <img src="images/15.1.jpg" />
                <i class="mask zero"></i>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="images/17.1.jpg" />
                <i class="mask one"></i>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="images/18.1.jpg" />
                <i class="mask second"></i>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="images/20.1.jpg" />
                <i class="mask third"></i>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="images/20.1.jpg" />
                <i class="mask third"></i>
            </a>
        </li>
    </ul>
</div>