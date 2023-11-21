<?php
/**
 * Project: yii2-blog for internal using
 * Author: app\modules
 * Copyright (c) 2018.
 */

namespace app\modules\page\models;
use yii;
use app\modules\page\Module;
use app\modules\page\traits\ModuleTrait;
use app\modules\page\traits\StatusTrait;

/**
 * This is the model class for table "blog_tag".
 *
 * @property string $id
 * @property string $name
 * @property string $frequency
 */
class PageTag extends \yii\db\ActiveRecord
{
    use StatusTrait, ModuleTrait;

    private $_status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nxt_page_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','frequency'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('page', 'ID'),
            'name' => Yii::t('page', 'Name'),
            'frequency' => Yii::t('page', 'Frequency'),
        ];
    }

    public static function string2array($tags)
    {
        return preg_split('/\s*,\s*/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($tags)
    {
        return implode(',', $tags);
    }

    public static function updateFrequency($oldTags, $newTags)
    {
        $oldTags = self::string2array($oldTags);
        $newTags = self::string2array($newTags);
        self::addTags(array_values(array_diff($newTags, $oldTags)));
        self::removeTags(array_values(array_diff($oldTags, $newTags)));
    }

    public static function updateFrequencyOnDelete($oldTags)
    {
        $oldTags = self::string2array($oldTags);
        self::removeTags($oldTags);
    }

    public static function addTags($tags)
    {

        PageTag::updateAllCounters(['frequency' => 1], 'name in ("' . implode('"," ', $tags) . '")');

        foreach ($tags as $name) {
            if (!PageTag::findOne(['name' => $name,])) {
                $tag = new PageTag;
                $tag->name = $name;
                $tag->frequency = 1;
                $tag->save();
            }
        }
    }

    public static function removeTags($tags)
    {
        if (empty($tags)) {
            return;
        }

        PageTag::updateAllCounters(['frequency' => 1], 'name in ("' . implode('"," ', $tags) . '")');
        PageTag::deleteAll('frequency <= 0');
    }

    public static function findTagWeights($limit = 20)
    {
        $models = PageTag::find()->orderBy(['frequency' => SORT_DESC])->all();

        $total = 0;
        foreach ($models as $model) {
            $total += $model->frequency;
        }

        $tags = [];
        if ($total > 0) {
            foreach ($models as $model) {
                $tags[$model->name] = 8 + (int)(16 * $model->frequency / ($total + 10));
            }
            ksort($tags);
        }
        return $tags;
    }
}
