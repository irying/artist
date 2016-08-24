<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Comment;
use app\models\Product;
use app\models\Article;
use yii\helpers\ArrayHelper;
$this->registerCssFile('@web/css/article.css', ['depends' => app\assets\AppAsset::className()]);

$aid = Yii::$app->Request->get('id');
// echo \Yii::$app->request->baseUrl;
// var_dump(Yii::$app->request->getCsrfToken());
// die;
// 全局数组
$GLOBALS['arr'] = array('','');
showAllComment($aid);

// 展示所有评论
function showAllComment($aid, $pid=0, $lastId=0)
{
    $list = Comment::find()->where(['article_id' => $aid, 'pid' => $pid])->asArray()->orderBy('created_at DESC')->all();
    $len = count($list)-1; 

    if ($len<0) {
        return;
    }else{
        
        while(isset($list[$len])) {
            $id = $list[$len]['id'];
            $uid = $list[$len]['user_id'];
            $username = $list[$len]['username'];
            $content = $list[$len]['content'];
            $comment_time = $list[$len]['created_at'];

            $GLOBALS['arr'][0] .= 'aCommentList.push('.$id.');'."\n";
            $styleClass = ($pid==0?'comment':'comment sub');

            $GLOBALS['arr'][1] .='<div class="'.$styleClass.'" id="comment_id_'.$id.'">';
            $GLOBALS['arr'][1] .= '<div class=control><span>删除</span> <span>回复</span></div>';
            if ($lastId !=0) {
                $replyTo = '回复';
                $last_uid = Comment::find()->where(['user_id' => $pid])->one()->pid;
                $last_name = Comment::find()->where(['user_id' => $pid])->one()->username;               
                $replyTo .='<a href="user.php?uid='.$last_uid.'">'.$last_name. '</a> ';
            }else {
                $replyTo = '';
            }

            $GLOBALS['arr'][1] .= '<p>[#'.$id.'楼]<a href="usr.php?uid='.$uid.'">'.$username.'</a>'.$replyTo.date('Y-m-d H:i:s', $comment_time);
            $GLOBALS['arr'][1] .=  ':</p>';
            $GLOBALS['arr'][1] .= $content;
            $GLOBALS['arr'][1] .= '</div>'  . "\n\n";
            showAllComment(1,$id,$id);
            $len--;
        }
    }
}
$script = '<script> aCommentList=[];'."\n\n".$GLOBALS['arr'][0];
$script .= '</script>';

$product = Product::findAll(['aid'=> $aid]);
$sizes = ArrayHelper::map($product, 'id', 'size');
foreach ($sizes as $k=>$v) {
    if(!is_array($v))
        $sizes[$k] = explode(',', $v);
}
$colors = ArrayHelper::map($product, 'id', 'color');
foreach ($colors as $ke=>$cv) {
    if(!is_array($cv))
        $colors[$ke] = explode('，', $cv);
}

$alia = str_replace('\\', '/', \Yii::getAlias('@app'));
// var_dump(basename($alia));
?>
<!--内容-->
<div class="con">
	<div class="top">
    	<span class="top_vol"><?php if(1 == $aid) echo "99";else echo "66";?></span>
        <span class="top_title"><?= Article::find()->where(['id' => $aid])->one()->title;?></span>
    </div>
    <div class="blank2">
    </div>
    <div id="container">
        <div id="list" style="left: -620px;">
            <?=Html::img("@web/images/".$aid."_first.jpg")?>
            <?=Html::img("@web/images/".$aid."_fifth.jpg")?>
            <?=Html::img("@web/images/".$aid."_second.jpg")?>
            <?=Html::img("@web/images/".$aid."_third.jpg")?>
            <?=Html::img("@web/images/".$aid."_forth.jpg")?>
            <?=Html::img("@web/images/".$aid."_first.jpg")?>
            <?=Html::img("@web/images/".$aid."_fifth.jpg")?>
        </div>
        <div id="buttons">
            <span index="1" class="on"></span>
            <span index="2"></span>
            <span index="3"></span>
            <span index="4"></span>
            <span index="5"></span>
        </div>
        <a href="javascript:;" id="prev" class="arrow">&lt;</a>
        <a href="javascript:;" id="next" class="arrow">&gt;</a>
	</div>
    <div class="blank">
    </div>
    <!--观点-->
    <div class="middle">
        <p><?= Article::find()->where(['id' => $aid])->one()->con_head;?></p>
        <br />
        <p><?= Article::find()->where(['id' => $aid])->one()->con_middle;?></p>
        <br />
        <p><?= Article::find()->where(['id' => $aid])->one()->con_foot;?></p>
        <div class="middle_word">
        	<h5>Comment from Jack</h5>
            <h6>2016-04-25</h6>
        </div>
    </div>
    <div class="blank">
    </div>
    <div class="goods">
        <ul>
        <?php foreach ($product as $val) :?>
            <li class="good">
                <div class="pic">
                    <div class="det">
                        <img class="img" src="<?= 'http://localhost/artist'.$val->front ?>" />
                        <div class="info" id="info">
                             <h4 style="text-align:center; margin:15px 0; color:#333;"><?= $val->name ?></h4>
                             <form>
                               <div class="size" id="size"> 
                                     <p>
                                        &nbsp;
                                        <select id='size<?= $val->id?>'>
                                            <option value =''>尺码</option>
                                            <?php foreach ($sizes[$val->id] as $size) :?>
                                                <option value = <?= $size?>><?= $size?></option>
                                            <?php endforeach;?>
                                        </select>
                                        &nbsp;
                                        <select id='color<?= $val->id?>'>
                                            <option value =''>颜色</option>
                                            <?php foreach ($colors[$val->id] as $color) :?>
                                                <option value = <?= $color?>><?= $color?></option>
                                            <?php endforeach;?>
                                        </select>
                                       <!--  <a class="size_num num1" href="javaScript:;">
                                            M
                                            <img class="picon" src="images/picon.gif" />
                                        </a> -->
                                        <!-- <a class="size_num num2" href="javaScript:;">
                                            L
                                            <img class="picon" src="images/picon.gif" />
                                        </a>
                                        <a class="size_num num3" href="javaScript:;">
                                            XL
                                            <img class="picon" src="images/picon.gif" />
                                        </a> -->
                                     </p>
                                </div>
                                <div class="count" id="count">     	
                                     <p>&nbsp;&nbsp;数量：&nbsp;<span class="reduce">-</span>
                                            <input class="count-input" type="text" id="coun<?= $val->id?>" value="1"/>
                                            <span class="add">+</span>
                                     </p>
                                     <button  class="collect" id="sub<?= $val->id?>" type='button' onclick="proAdd(<?= $val->id?>)">加入购物车</button>
                                </div>
                             </form>
                        </div>
                    </div>
                    <div class="mes">
                        <h3 style="color:#C03; font-size:16px; margin:20px 0;"><?= $val->keywords?></h3>
                        <p class="txt"><?= $val->description?></p>
                    </div>
                </div>
            </li>
            <?php endforeach;?>
       </ul>

	</div>
    <div class="blank">
    </div>
    <div id="idea" class="idea">
        <div class="box">
        <!--发表看法-->
        <?php $form = ActiveForm::begin(['id' => '']); ?>
        <?= Html::activeHiddenInput($model, 'user_id', ['value' => Yii::$app->user->id]) ?>
        <?= Html::activeHiddenInput($model, 'username', ['value' => Yii::$app->user->identity->username]) ?>
        <?= Html::activeHiddenInput($model, 'article_id', ['value' => Yii::$app->Request->get('id')]) ?>
        <?= Html::activeHiddenInput($model, 'pid', ['value' => 0]) ?>
            <div class="text-box">
                <!-- <textarea class="express" autocomplete="off">你怎么看？</textarea> -->
                <!-- <button class="btn1">发 布</button> -->
                <?= $form->field($model, 'content')->textarea(['rows' => 3])?>
                <?= Html::submitButton( '发布', ['class' => 'btn1',]) ?>
            </div>
        <?php ActiveForm::end(); ?>
            <!--距离2-->
            <div class="blank3">
            </div>
            <div class="after_blank3">
            	<h4>评论 <span>▼</span></h4>
            </div>
            <div class="line">
            </div>
            <!--评论列表-->
            <div class="comment-list">
                <div class="comment-box" user="self">
                    <img class="myhead" src='<?=Yii::$app->request->baseUrl?>/images/touxiang.jpg' alt="" />
                    <div class="comment-content" id="comment-content">
                        <p class="comment-txt"><span class="user">我:</span>土豪的世界...</p>
                        <p class="comment-time">
                            2015-04-25 00:00
                            <a href="javascript:;" class="comment-praise" total="1" my="0" style="display:none;">赞</a>
                            <a href="javascript:;" class="comment-operate" style="display:none;">删除</a>
                        </p>
                    </div>
                </div>
                <div>
                    <?php echo $GLOBALS['arr'][1];?>
                    <?php echo $script; ?>
                </div>
            </div>
        </div>
	</div>
</div>

<?php
$theUserid = Yii::$app->user->id;
$theUsername = Yii::$app->user->identity->username;
$url = Yii::$app->urlManager->createUrl(['article/view','id'=> $aid]);
$delUrl = Yii::$app->urlManager->createUrl(['article/del']);
$this->registerJsFile('@web/js/one_by_one.js',['depends' => app\assets\AppAsset::className()]);
$js = <<<JS

function $(s){
        if(typeof s=='object') return s;
        return document.getElementById(s);
    }

var html = "<form id action=$url method='post'>";
    html += "<input type='hidden' id='comment-user_id' name='Comment[user_id]' value=$theUserid>";
    html +="<input type='hidden' id='comment-username' name='Comment[username]' value=$theUsername>";
    html +="<input type='hidden' id='comment-article_id' name='Comment[article_id]' value=$aid>";
    html +="<input type='hidden' id='comment-pid' name='Comment[pid]' value='0'>";            
    html +="<div class='form-group field-comment-content required'>";
    html +="<textarea id='comment-content' class='form-control' name='Comment[content]' rows='3'>";
    html +="</textarea>";
    html +="<div class='help-block'>";
    html +="</div>";
    html +="</div>";                
    html +="<button type='submit' class='btn1'>确定</button></form>";
        
    //alert(html);

    //为删除 和 回复 按钮绑定事件
    for(var i in aCommentList){

        // oComment=$('comment_id_'+aCommentList[i]);
        oComment=document.getElementById('comment_id_'+aCommentList[i]);
        aBtns=oComment.getElementsByTagName('span');
        oBtnDel=aBtns[0];       
        oBtnDel.id=aCommentList[i];
        oBtnReply=aBtns[1];     
        oBtnReply.id=aCommentList[i];
        
        
        //为回复按钮 绑定事件
        oBtnReply.onclick=function(){
            //定位到评论框
            //window.location='#addComment';
            //给定父评论的id
            var pid=this.id;
            var before = $('comment_id_'+pid);
            before.insertAdjacentHTML('beforeEnd',html);
            // alert($('comment_id_'+pid).innerHTML);
            //提示正在回复第几楼
            $('commentTo').innerHTML='回复#'+ pid + '楼: ';
        }

        // 删除
        oBtnDel.onclick=function(){

            if(confirm('你确定要删除#'+this.id+'楼的留言吗？(包括此后的回复)')){
                window.location= "{$delUrl}&id="+ this.id;
            }
        }
    }
   

JS;
$this->registerJs($js);
$ajaxAdd = Yii::$app->urlManager->createUrl(['cart/ajax-add']);
$other = <<<other
<script type='text/javascript'>
function proAdd(i){
        // alert(i);
        // alert($('#coun'+i).val());
    var size = $('#size'+i).val();
    var color = $('#color'+i).val();
    var num = $('#coun'+i).val();
    if(size == '')
        alert('请选择尺码');
    else if(color == '')
        alert('请选择颜色');
    else
        $.get("{$ajaxAdd}?id=" + i +"&color=" + color +"&size=" + size +"&num=" + num, function(data, status) {
            if (status == "success") {
                if (data.status) {
                    $("#sub"+i).html('已加入购物车');
                    // $("#sub"+i).attr('disabled',true);
                }
            }
        }, "json");

}
</script>
other;

echo $other;
?>