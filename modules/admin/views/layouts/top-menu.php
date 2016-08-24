<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

NavBar::begin([
    'brandLabel' => '后台管理',
    'brandUrl' => Yii::$app->urlManager->createUrl(['/admin/order']),
    'options' => [
        'class' => 'navbar navbar-inverse navbar-fixed-top',
    ],
]);
$menuItemsMain = [
    [ 
        'label' => '订单',
        'url' => ['#'],
        'active' => false,
        'items' => [
            [
                'label' => '订单',
                'url' => ['/admin/order'],
            ],
            [
                'label' => '订单详情',
                'url' => ['/admin/order-product'],
            ],
        ],
    ],
    [ 
        'label' => '运营',
        'url' => ['#'],
        'active' => false,
        'items' => [
            [
                'label' => '商品',
                'url' => ['/admin/product'],
            ],
            [
                'label' => '话题',
                'url' => ['/admin/images'],
            ],
            [
                'label' => '原创',
                'url' => ['/admin/article'],
            ],
        ],
    ],
    [ 
        'label' => '评论',
        'url' => ['#'],
        'active' => false,
        'items' => [
            [
                'label' => '商品',
                'url' => ['/admin/comment'],
            ],
            [
                'label' => '原创',
                'url' => ['/admin/comment'],
            ],
        ],
    ],
    [ 
        'label' => '用户',
        'url' => ['#'],
        'active' => false,
        'items' => [
            [
                'label' => '用户',
                'url' => ['/admin/user/index'],
            ],
            [
                'label' => '地址',    
                'url' => ['/admin/address/index'],
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