<?php
/**
 * Project: yii2-blog for internal using
 * Author: admin\modules
 * Copyright (c) 2018.
 */

namespace admin\modules\page\models;
use yii;
use admin\modules\page\Module;
use admin\modules\page\traits\IActiveStatus;
use admin\modules\page\traits\ModuleTrait;
use admin\modules\page\traits\StatusTrait;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "blog_comment".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $content
 * @property string $author
 * @property string $email
 * @property string $url
 * @property string $captcha
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Page $post
 */
class PageComment extends \yii\db\ActiveRecord
{
    use StatusTrait, ModuleTrait;

    const SCENARIO_ADMIN = 'admin';
    const SCENARIO_USER = 'user';

    public $captcha;

    private $_status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nxt_page_comment';
    }

    /**
     * created_at, updated_at to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ADMIN] = ['post_id', 'content', 'author', 'email', 'status', 'url'];
        $scenarios[self::SCENARIO_USER] = ['content', 'author', 'email', 'captcha'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'content', 'author', 'email'], 'required'],
            ['email', 'email'],
            [['author', 'content'], 'filter', 'filter' => 'strip_tags'],
            [['author', 'captcha', 'email'], 'trim'],
            [['post_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['author', 'email', 'url'], 'string', 'max' => 128],
            ['captcha', 'captcha', 'captchaAction' => Url::to('/page/default/captcha'), 'on' => self::SCENARIO_USER],
            ['captcha', 'required', 'on' => self::SCENARIO_USER]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('page', 'ID'),
            'post_id' => Yii::t('page', 'Post ID'),
            'content' => Yii::t('page', 'Content'),
            'author' => Yii::t('page', 'Author'),
            'email' => Yii::t('page', 'Email'),
            'url' => Yii::t('page', 'Url'),
            'status' => Yii::t('page', 'Status'),
            'created_at' => Yii::t('page', 'Created At'),
            'updated_at' => Yii::t('page', 'Updated At'),
            'captcha' => Yii::t('page', 'Verify code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   /* public function getPost()
    {
        return $this->hasOne(Page::className(), ['id' => 'post_id']);
    }  */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'post_id']);
    }

    /**
     * @return string
     */
    public function getAuthorLink()
    {
        if (!empty($this->url)) {
            return Html::a(Html::encode($this->author), $this->url);
        } else {
            return Html::encode($this->author);
        }
    }

    /**
     * @param null $post
     * @return string
     */
    public function getUrl($post = null)
    {
        if ($post === null) {
            $post = $this->post;
        }
        return $post->url . '#c' . $this->id;
    }

    /**
     * @param int $limit
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findRecentComments($limit = 10)
    {
        return self::find()->joinWith('Page')->where([
            'nxt_page_comment.status' => IActiveStatus::STATUS_ACTIVE,
            'nxt_page.status' => IActiveStatus::STATUS_ACTIVE,
        ])->orderBy([
            'created_at' => SORT_DESC
        ])->limit($limit)->all();
    }

    /**
     * @return string
     */
    public function getMaskedEmail()
    {
        list($email_username, $email_domain) = explode('@', $this->email);
        $masked_email_username = preg_replace('/(.)./', "$1*", $email_username);
        return implode('@', array($masked_email_username, $email_domain));
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return ($this->status == IActiveStatus::STATUS_ACTIVE) ? $this->content : StringHelper::truncate($this->content, 15);
    }
}
