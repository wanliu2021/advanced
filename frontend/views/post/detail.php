<?php

use common\models\Comment;
use frontend\components\RctReplyWidget;use frontend\components\TagsCloudWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model*/
//阅读量增加1
$model->readUp();

?>
<div class="container ">
    <div class="row">
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="<?= Yii::$app->homeUrl?>">首页</a> </li>
                <li><a href="<?= Yii::$app->homeUrl?>?r=post/index">文章列表</a> </li>
                <li class="active"><?=$model->title ?></li>
            </ol>
            <div class="article-item  article">
            <div class="post ">
                <div class="title">
                    <h2><a href="<?= $model->url;?>"><?=Html::encode($model->title); ?></a></h2>
                    <div class="author">
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span><em><?= date('Y-m-d H:i:s',$model->create_time)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span><em><?= Html::encode($model->author->nickname);?></em>
                    </div>
                </div>
            </div>

            <br>
            <div class="content ">
                <?= yii\helpers\HtmlPurifier::process($model->content)?>
            </div>

            <br>
            <div class="nav">
                <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                <?=implode(',',$model->tagLinks)?>
                <br>
                <?= Html::a("评论({$model->commentCount})",$model->url.'#comments');?>
                最后修改于<?= date('Y-m-d H:i:s',$model->update_time);?>
            </div>

            <div id="comments">
                <?php if($added){?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4>谢谢你的回复，我们会尽快审核后发布出来！ </h4>
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span><em><?= date('Y-m-d H:i:s',$model->create_time)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span><em><?= Html::encode($model->author->nickname);?></em>
                </div>
                <?php }?>

                <?php if($model->getCommentCount()>=1):?>
                <h5><?= $model->getCommentCount().'条评论';?></h5>
                <?= $this->render('_comment',array(
                        'post'=>$model,
                        'comments'=>$model->comments,
                ))?>
                <?php endif;?>
            </div>

            <h5>发表评论</h5>
            <?php
                $postComment=new Comment();
                echo $this->render('_guestform',array(
                        'id'=>$model->id,
                        'commentModel'=>$commentModel,
                ))

            ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="search-group">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>查找文章
                    </li>

                    <li class="list-group-item">
                        <form class="form-inline" action="index.php?r=post/index" id="w0" method="get">
                            <div class="form-group">
                                <input type="text" class="form-control" name="PostSearch[title]" id="w0input" placeholder="按标题">
                            </div>
                            <button type="submit" class="btn btn-default">搜索</button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="tagcloudbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>标签云
                    </li>

                    <li class="list-group-item">
                        <?= TagsCloudWidget::widget(['tags'=>$tags])?>
                    </li>
                </ul>
            </div>
            <div class="commentbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>最新回复
                    </li>

                    <li class="list-group-item">
                        <?= RctReplyWidget::widget(['recentComments'=>$recentComments])?>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>