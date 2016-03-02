<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

// AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '口袋后台',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItemsMain = [
        [ 
            'label' => '期刊',
            'url' => ['#'],
            'active' => false,
            'items' => [
                [
                    'label' => '文章',
                    'url' => ['/admin/article'],
                ],
                [
                    'label' => '图片',
                    'url' => ['/admin/images'],
                ],
                [
                    'label' => '评论',
                    'url' => ['/admin/comment'],
                ],
            ],
        ],
        [ 
            'label' => '故事',
            'url' => ['#'],
            'active' => false,
            'items' => [
                [
                    'label' => '文章',
                    'url' => ['/admin/article'],
                ],
                [
                    'label' => '图片',
                    'url' => ['/admin/images'],
                ],
                [
                    'label' => '评论',
                    'url' => ['/admin/comment'],
                ],
            ],
        ],
        [ 
            'label' => '商品',
            'url' => ['#'],
            'active' => false,
            'items' => [
                [
                    'label' => '文章',
                    'url' => ['/admin/article'],
                ],
                [
                    'label' => '图片',
                    'url' => ['/admin/images'],
                ],
                [
                    'label' => '评论',
                    'url' => ['/admin/comment'],
                ],
            ],
        ],
        [ 
            'label' => '系统  ',
            'url' => ['#'],
            'active' => false,
            'items' => [
                [
                    'label' => '文章',
                    'url' => ['/admin/article'],
                ],
                [
                    'label' => '图片',
                    'url' => ['/admin/images'],
                ],
                [
                    'label' => '评论',
                    'url' => ['/admin/comment'],
                ],
            ],
        ],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $menuItemsMain,
        'encodeLabels' => true,
        ]);

    $menuItems = [
        [
            'label' => Yii::t('app', 'Change Password'),
            'url' => ['site/change-password'],
        ],
        ['label' => Yii::t('app', 'Home'), 'url' => ['/']],
    ];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
} else {
    $menuItems[] = [
        'label' => Yii::t('app', 'Logout') . '(' . Yii::$app->user->identity->username . ')',
        'url' => ['/site/logout'],
        'linkOptions' => ['data-method' => 'post']
    ];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
    // 'encodeLabels' => true,
]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
