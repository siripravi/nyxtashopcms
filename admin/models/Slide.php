<?php

namespace app\admin\models;

use app\modules\sortable\behaviors\SortableBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%slide}}".
 *
 * @property integer $id
 * @property integer $position
 * @property string $title
 * @property string $body
 */
class Slide extends ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile file attribute
     */
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nxt_slide';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['position'], 'integer'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'image', 'mimeTypes' => ['image/png','image/jpeg']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
           /* [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ],*/
            SortableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' =>  'ID',
            'position' =>  'Sort Order',
            'image' =>  'Image',
            'title' =>  'Title',
            'body' =>  'Body',
        ];
    }
}
