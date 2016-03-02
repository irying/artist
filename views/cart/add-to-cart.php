<?php
$this->registerCssFile('@web/css/add-to-cart.css', ['depends' => app\assets\AppAsset::className()]);
$aid = Yii::$app->Request->get('id');
?>
<div id="wrapper">
    <div class="add_ok">
        <div class="tip"> 商品已成功加入购物车 </div>
        <div class="go"> <a class="back" href="<?= Yii::$app->urlManager->createUrl(['article/view', 'id' => $id]) ?>">&lt;&lt;继续购物</a> <a class="btn" href="<?= Yii::$app->urlManager->createUrl(['/cart']) ?>">去结算</a> </div>
    </div>
</div>