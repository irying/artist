<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Comment;
use app\models\Product;
use yii\helpers\ArrayHelper;
$this->registerCssFile('@web/css/cart.css', ['depends' => app\assets\AppAsset::className()]);
$this->registerJsFile('@web/js/cart.js', ['depends' => app\assets\AppAsset::className()]);

?>
<div class="blank3">
</div>

<table id="card">
    <thead>
        <tr>
            <th><label><input class="check-all check" type="checkbox"/>&nbsp;全选</label></th>
            <th>商品</th>
            <th>单价</th>
            <th>数量</th>
            <th>小计</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="checkbox"><input class="check-one check" type="checkbox" /></td>
            <td class="goods"><img src="images/1.1.jpg" alt="" /><span>羊皮板鞋/纯白色 42</span></td>
            <td class="price">286.00</td>
            <td class="count">
                <span class="reduce"></span>
                <input class="count-input" type="text" value="1"/>
                <span class="add">+</span>
            </td>
            <td class="subtotal">286.00</td>
            <td class="operation"><span class="delete">删除</span></td>
        </tr>
        <tr>
            <td class="checkbox"><input class="check-one check" type="checkbox" /></td>
            <td class="goods"><img src="images/2.1.jpg" alt="" /><span>弯刀裤/卡其色 L</span></td>
            <td class="price">78.00</td>
            <td class="count">
                <span class="reduce"></span>
                <input class="count-input" type="text" value="1"/>
                <span class="add">+</span>
            </td>
            <td class="subtotal">78.00</td>
            <td class="operation"><span class="delete">删除</span></td>
        </tr>
    </tbody>
</table>
<div id="foot" class="foot">
    <label class="fl select-all"><input type="checkbox" class="check-all check" />&nbsp;全选</label>
    <a class="fl delete" id="deleteAll" href="javascript:;">删除</a>
    <div class="fr closing">结算</div>
    <div class="fr total">合计：￥<span id="priceTotal">0.00</span></div>
    <div class="fr selected" id="selected">已选商品
        <span id="selectedTotal">0</span>件
    </div>
</div>
<div class="blank3">
</div>