<?php
$this->registerCssFile('@web/css/contentList.css', ['depends' => app\assets\AppAsset::className()]);
$this->registerCssFile('@web/js/contentList.js', ['depends' => app\assets\AppAsset::className()]);

?>

<!--距离1-->
<div class="blank">
</div>
<!--内容-->
<div class="con">
	<ul>
    	<li>
            <div class="left">
                 <a href="#"><img src="<?= Yii::$app->request->baseUrl?>/images/content_list/vol.127.jpg" alt="" /></a>
                 <div class="word">
                    <a href="#">vol.127 万物生长(最新期刊)</a>
                 </div>
            </div>
        </li>
        <li>
            <div class="left">
                 <a href="#"><img src="<?= Yii::$app->request->baseUrl?>/images/content_list/vol.126.jpg" alt="" /></a>
                 <div class="word">
                    <a href="#">vol.126 游荡自如</a>
                 </div>
            </div>
        </li>
        <li>
            <div class="left">
                 <a href="#"><img src="<?= Yii::$app->request->baseUrl?>/images/content_list/vol.124.jpg" alt="" /></a>
                 <div class="word">
                    <a href="#">vol.125 如你所愿</a>
                 </div>
            </div>
        </li>
        <li>
            <div class="left">
                 <a href="#"><img src="<?= Yii::$app->request->baseUrl?>/images/content_list/vol.123.jpg" alt="" /></a>
                 <div class="word">
                    <a href="#">vol.124 阿卡贝拉</a>
                 </div>
            </div>
        </li>
        <li>
            <div class="left">
                 <a href="#"><img src="<?= Yii::$app->request->baseUrl?>/images/content_list/vol.119.jpg" alt="" /></a>
                 <div class="word">
                    <a href="#">vol.123 西北偏北</a>
                 </div>
            </div>
        </li>
         <li>
            <div class="left">
                 <a href="#"><img src="<?= Yii::$app->request->baseUrl?>/images/content_list/vol.118.jpg" alt="" /></a>
                 <div class="word">
                    <a href="#">vol.122 萍水相逢</a>
                 </div>
            </div>
        </li>
    </ul>
     <div class="con_right">
       	<h4 style="border-bottom:1px solid #2d2d2d;">热门期刊</h4>
        <ul>
        	<li>
                <div class="right_img"> 
                    <a href="#>"><img src="<?= Yii::$app->request->baseUrl?>/images/story_list/vol.118.jpg" /></a>
                    <div class="right_word">
                        <h6 style="text-align:left; color:#333;">且听风吟</h6>
                        <h6 style="text-align:left; color:#999;">已有10276人点击</h6>
                    </div>
                </div>
            </li>
            <li>
                <div class="right_img"> 
                    <a href="#>"><img src="<?= Yii::$app->request->baseUrl?>/images/story_list/vol.119.jpg" /></a>
                    <div class="right_word">
                        <h6 style="text-align:left; color:#333;">伦敦</h6>
                        <h6 style="text-align:left;  color:#999;">已有20527人点击</h6>
                    </div>
                </div>
            </li>
            <li>
                <div class="right_img"> 
                    <a href="#>"><img src="<?= Yii::$app->request->baseUrl?>/images/story_list/vol.126.jpg" /></a>
                    <div class="right_word">
                        <h6 style="text-align:left; color:#333;">简单</h6>
                        <h6 style="text-align:left;  color:#999;">已有23246人点击</h6>
                    </div>
                </div>
            </li>
            <li>
                <div class="right_img"> 
                    <a href="#>"><img src="<?= Yii::$app->request->baseUrl?>/images/story_list/vol.123.jpg" /></a>
                    <div class="right_word">
                        <h6 style="text-align:left; color:#333;">羽化成风</h6>
                        <h6 style="text-align:left;  color:#999;">已有11235人点击</h6>
                    </div>
                </div>
            </li>
            <li>
                <div class="right_img"> 
                    <a href="#>"><img src="<?= Yii::$app->request->baseUrl?>/images/story_list/vol.125.jpg" /></a>
                    <div class="right_word">
                        <h6 style="text-align:left; color:#333;">东逝水</h6>
                        <h6 style="text-align:left; color:#999;" >已有9906人点击</h6>
                    </div>
                </div>
            </li>
            <li>
                <div class="right_img"> 
                    <a href="<?= Yii::$app->urlManager->createUrl(['article/view/2']);?>" ><img src="<?= Yii::$app->request->baseUrl?>/images/story_list/vol.66.jpg" /></a>
                    <div class="right_word">
                        <h6 style="text-align:left; color:#333;">了不起的盖茨比</h6>
                        <h6 style="text-align:left; color:#999;" >已有18904人点击</h6>
                    </div>
                </div>
            </li>
        </ul>
   	 	</div>
</div>
<div class="page">
	<a href="#" class="prev_page">上一页</a>
	<ul>
        <li><a class="current" href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>...</li>
        <li><a href="#">20</a></li>
        <li><a href="#">21</a></li>
    </ul>
    <a href="#" class="next_page">下一页</a>
</div>
<!--距离3-->
<div class="blank3">
</div>