<?php
namespace frontend\components;

use Yii;
use yii\base\Widget;

class TagsCloudWidget extends Widget{
    public $tags;
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        $tagString='';
        $fontStyle=array(
            "6"=>"danger",
            "5"=>"info",
            "4"=>"warning",
            "3"=>"primary",
            "2"=>"success",
        );
        foreach ($this->tags as $tag=>$weight)
        {
            $url = Yii::$app->urlManager->createUrl(['post/index','PostSearch[tags]'=>$tag]);
            $tagString.='<a href="'.$url.'">'.
                ' <h'.$weight.' style="display:inline-block;"><span class="label label-'
                .$fontStyle[$weight].'">'.$tag.'</span></h'.$weight.'></a>';
        }
        return $tagString;
    }
}