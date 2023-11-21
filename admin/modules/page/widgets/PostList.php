<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace common\modules\page\widgets;

use common\modules\page\models\page;
use common\modules\page\models\Status;
use common\modules\page\Module;
use common\modules\page\traits\IActiveStatus;
use yii\base\Widget;
use yii\db\Expression;

class PostList extends Widget
{
    const TYPE_RANDOM = 'random';
    const TYPE_POPULAR = 'hot';
    const TYPE_RECENT = 'recent';

    public $title;
    public $maxPosts = 6;
    public $type;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = Yii::t('blog', 'Blog Posts');
        }
    }

    public function run()
    {
        $posts = page::find()->where(['status' => IActiveStatus::STATUS_ACTIVE])->orderBy($this->getOrderFromType())->limit($this->maxPosts)->all();

        return $this->render('post-list', [
            'title' => $this->title,
            'posts' => $posts,
        ]);
    }

    protected function getOrderFromType()
    {
        switch ($this->type) {
            case self::TYPE_RANDOM:
                return new Expression('rand()');
            case self::TYPE_RECENT:
                return ['created_at' => SORT_DESC];
            case self::TYPE_POPULAR:
                return ['click' => SORT_DESC];
            default:
                return [];
        }
    }
}