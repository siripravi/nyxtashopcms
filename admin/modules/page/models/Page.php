<?php

namespace admin\modules\page\models;
use admin\modules\image\models\File;
use Yii;
use admin\modules\image\models\Image;
use admin\modules\sortable\behaviors\SortableBehavior;
use admin\modules\language\behaviors\LanguageBehavior;
use omgdef\multilingual\MultilingualQuery;
use voskobovich\linker\LinkerBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use admin\modules\page\traits\IActiveStatus;
use admin\modules\page\traits\StatusTrait;
use admin\modules\page\traits\ModuleTrait;
use yiidreamteam\upload\ImageUploadBehavior;
use yii\helpers\Html;
/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $position
 * @property integer $enabled
 * @property integer $image_id
 * @property string $tags
 * @property string $banner
 * @property integer $click
 * @property integer $user_id
 * @property integer $status
 
 *
 * Language
 *
 * @property string $title
 * @property string $title
 * @property string $name
 * @property string $keywords
 * @property string $description
 * @property string $text
 * @property string $short
 *
 * Relations
 *
 * @property Page $parent
 * @property Page[] $parents
 * @property Page[] $childs
 * @property Image[] $images
 * @property Image[] $imagesAll
 * @property Image $image
 * @property array $imageEnabled
 * @property array $image_ids
 * @property File[] $files
 * @property File[] $filesAll
 * @property array $fileEnabled
 * @property array $filename
 * @property array $file_ids
 */
class Page extends ActiveRecord
{
	use StatusTrait, ModuleTrait;

    private $_oldTags;

    private $_status;
    const DISABLED = 0;
    const ENABLED = 1;

    const TYPE_PAGE = 0;
    const TYPE_CATEGORY = 1;

    private $_imageEnabled = null;
    private $_fileEnabled = null;
    private $_filename = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
          /*  [
                'class' =>LanguageBehavior::className(),
                'languages' => [
                    'en' => 'English',
                ],
                'defaultLanguage' => 'en'
            ],*/
            TimestampBehavior::class,
            SortableBehavior::class,
			[
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id'
                ],
                'value' => function ($event) {
                    return Yii::$app->user->getId();
                },
            ],
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true
            ],
			[
                'class' => ImageUploadBehavior::class,
                'attribute' => 'banner',
                'thumbs' => [
                    'thumb' => ['width' => 400, 'height' => 300]
                ],
                'filePath' => Yii::$app->params['page']['imgFilePath'] . '[[model]]/[[pk]].[[extension]]',
                'fileUrl' =>  Yii::$app->params['page']['imgFileUrl'] . '[[model]]/[[pk]].[[extension]]',
                'thumbPath' => Yii::$app->urlManager->getHostInfo().Yii::$app->params['page']['imgFilePath'] . '[[model]]/[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => Yii::$app->params['page']['imgFileUrl'] . '[[model]]/[[profile]]_[[pk]].[[extension]]',
            ],
            [
                'class' => LinkerBehavior::className(),
                'relations' => [
                    'parent_ids' => ['parents'],                   
                    'image_ids' => [
                        'images',
                        'updater' => [
                            'viaTableAttributesValue' => [
                                'position' => function($updater, $relatedPk, $rowCondition) {
                                    $primaryModel = $updater->getBehavior()->owner;
                                    $image_ids = array_values($primaryModel->image_ids);
                                    return array_search($relatedPk, $image_ids);
                                },
                                'enabled' => function($updater, $relatedPk, $rowCondition) {
                                    $primaryModel = $updater->getBehavior()->owner;
                                    return !empty($primaryModel->imageEnabled[$relatedPk]) ? 1 : 0;
                                },
                            ],
                        ],
                    ],
                    'file_ids' => [
                        'files',
                        'updater' => [
                            'viaTableAttributesValue' => [
                                'position' => function($updater, $relatedPk, $rowCondition) {
                                    $primaryModel = $updater->getBehavior()->owner;
                                    $file_ids = array_values($primaryModel->file_ids);
                                    return array_search($relatedPk, $file_ids);
                                },
                                'enabled' => function($updater, $relatedPk, $rowCondition) {
                                    $primaryModel = $updater->getBehavior()->owner;
                                    return !empty($primaryModel->fileEnabled[$relatedPk]) ? 1 : 0;
                                },
                                'title' => function($updater, $relatedPk, $rowCondition) {
                                    $primaryModel = $updater->getBehavior()->owner;
                                    return $primaryModel->filename[$relatedPk];
                                },
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'name','category_id'], 'required'],
            [['slug', 'title', 'name', 'title', 'keywords'], 'string', 'max' => 255],
            [['description', 'text','tags', 'short'], 'string'],
            [['slug', 'title', 'name', 'title', 'keywords', 'description', 'text', 'short'], 'trim'],
			 ['click', 'default', 'value' => 0],
			 [['banner'], 'file', 'extensions' => 'jpg, png, webp', 'mimeTypes' => 'image/jpeg, image/png, image/webp',],
			
            [['position', 'status','image_id','category_id','user_id'], 'integer'],
            [['enabled', 'type'], 'boolean'],
            [['enabled'], 'default', 'value' => self::ENABLED],
            [['enabled'], 'in', 'range' => [self::ENABLED, self::DISABLED]],
            [['type'], 'in', 'range' => [self::TYPE_PAGE, self::TYPE_CATEGORY]],
            [['image_ids', 'parent_ids', 'imageEnabled', 'file_ids','fileEnabled'], 'each', 'rule' => ['integer']],
            [['filename'], 'each', 'rule' => ['string']],
            //[['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => Yii::t('page', 'Slug'),
            'created_at' => Yii::t('page', 'Created'),
            'updated_at' => Yii::t('page', 'Updated'),
            'enabled' => Yii::t('page', 'Enabled'),
            'title' => Yii::t('page', 'title'),
            'name' => Yii::t('page', 'name'),            
            'keywords' => Yii::t('page', 'Keywords'),
            'description' => Yii::t('page', 'Description'),
            'text' => Yii::t('page', 'Full text'),
            'short' => Yii::t('page', 'Short text'),
            'position' => Yii::t('page', 'Position'),
            'type' => Yii::t('page', 'Type'),
            'parent_ids' => Yii::t('page', 'Parent category'),			
            'banner' => Yii::t('page', 'Banner'),
            'click' => Yii::t('page', 'Click'),
            'user_id' => Yii::t('page', 'User ID'),
            'status' => Yii::t('page', 'Status'),           
			'tags' => Yii::t('page', 'Tags'),
        ];
    }

    public static function viewPage($id,$site = false)
    {
        $page = null;
        if(!$site){
            if (is_numeric($id)) {
                $page = self::findOne($id);
            }
            else {
                $page = self::findOne(['slug'=>$id]);
            } 
        }
        else{
            $id = PageCategory::findSiteCatId();           
            $page = self::findOne(['category_id' => $id]) ?? null;
        }

        if($page === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        Yii::$app->view->params['page'] = $page;
        Yii::$app->view->title = $page->title;
        if ($page->description) {
            Yii::$app->view->registerMetaTag([
                'title' => 'description',
                'content' => $page->description
            ]);
        }
        if ($page->keywords) {
            Yii::$app->view->registerMetaTag([
                'title' => 'keywords',
                'content' => $page->keywords
            ]);
        }
        return $page;
    }

    public static function getList($enabled)
    {
        return ArrayHelper::map(self::find()->andFilterWhere(['enabled' => $enabled])->orderBy('position')->all(), 'id', 'title');
    }

    /**
     * @return MultilingualQuery|\yii\db\ActiveQuery
     */
    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if ($this->id == 1) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id'])->viaTable('nxt_page_parent', ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(self::className(), ['id' => 'parent_id'])->viaTable('nxt_page_parent', ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChilds()
    {
        return $this->hasMany(self::className(), ['id' => 'page_id'])->viaTable('nxt_page_parent', ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        $title = $this->tableName();
        $prefix = Yii::$app->db->tablePrefix;
        return $this->hasMany(Image::className(), ['id' => 'image_id'])
            ->viaTable($title . '_image', [str_replace($prefix,"",$title) . '_id' => 'id'])
            ->leftJoin($title . '_image', 'id=image_id')
            ->where([$title . '_image.' . str_replace($prefix,"",$title) . '_id' => $this->id])
            ->andFilterWhere([$title . '_image.enabled' => true])
            ->orderBy([$title . '_image.position' => SORT_ASC])
            ->indexBy('id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagesAll()
    {
        $title = $this->tableName();
        $prefix = Yii::$app->db->tablePrefix;
        return $this->hasMany(Image::className(), ['id' => 'image_id'])
            ->viaTable($title . '_image', [str_replace($prefix,"",$title) . '_id' => 'id'])
            ->leftJoin($title . '_image', 'id=image_id')
            ->where([$title . '_image.' . str_replace($prefix,"",$title) . '_id' => $this->id])
            ->orderBy([$title . '_image.position' => SORT_ASC])
            ->indexBy('id');
    }

    public function getImageEnabled()
    {
        if ($this->_imageEnabled != null) {
            return $this->_imageEnabled;
        }

        $name = $this->className();
        $prefix = Yii::$app->db->tablePrefix;
        return $this->_imageEnabled = (new \yii\db\Query())
            ->select(['enabled'])
            ->from('nxt_page_image')
            ->where(['page_id' => $this->id])
            ->indexBy('image_id')
            ->column();
    }

    public function setImageEnabled($value)
    {
        $this->_imageEnabled = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        $table = $this->tableName();
		$prefix = Yii::$app->db->tablePrefix;
        return $this->hasMany(File::className(), ['id' => 'file_id'])
            ->viaTable($table . '_file', [str_replace($prefix,"",$table) . '_id' => 'id'])
            ->leftJoin('nxt_page_file', 'id=file_id')
            ->where([$table . '_file.' . str_replace($prefix,"",$table) . '_id' => $this->id])
            ->andFilterWhere([$table . '_file.enabled' => true])
            ->orderBy([$table . '_file.position' => SORT_ASC])
            ->indexBy('id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilesAll()
    {
        $title = $this->tableName();
		$prefix = Yii::$app->db->tablePrefix;
        return $this->hasMany(File::className(), ['id' => 'file_id'])
            ->viaTable($title . '_file', [str_replace($prefix,"",$title) . '_id' => 'id'])
            ->leftJoin($title . '_file', 'id=file_id')
            ->where([$title . '_file.' . str_replace($prefix,"",$title) . '_id' => $this->id])
            ->orderBy([$title . '_file.position' => SORT_ASC])
            ->indexBy('id');
    }

    public function getFileEnabled()
    {
        if ($this->_fileEnabled != null) {
            return $this->_fileEnabled;
        }
        $table = $this->tableName();
		$prefix = Yii::$app->db->tablePrefix;
        return $this->_fileEnabled = (new \yii\db\Query())
            ->select(['enabled'])
            ->from($table . '_file')
            ->where(['page_id' => $this->id])
            ->indexBy('file_id')
            ->column();
    }

    public function getFileName()
    {
        if ($this->_filename != null) {
            return $this->_filename;
        }
        $table = $this->tableName();
		$prefix = Yii::$app->db->tablePrefix;
        return $this->_filename = (new \yii\db\Query())
            ->select(['name'])
            ->from($table . '_file')
            ->where(['page_id' => $this->id])
            ->indexBy('file_id')
            ->column();
    }

    public function setFileName($value)
    {
        $this->_filename = $value;
    }

    public function setFileEnabled($value)
    {
        $this->_fileEnabled = $value;
    }

    public function afterSave($insert, $changedAttributes)
    {
        Yii::$app->cache->delete('page_content-' . $this->id . '-' . Yii::$app->language);

        Yii::$app->cache->delete('page_card-' . $this->id . '-' . Yii::$app->language);
        PageTag::updateFrequency($this->_oldTags, $this->tags);
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        Yii::$app->cache->delete('page_content-' . $this->id . '-' . Yii::$app->language);

        Yii::$app->cache->delete('page_card-' . $this->id . '-' . Yii::$app->language);
        PageTag::updateFrequencyOnDelete($this->_oldTags);
        parent::afterDelete();
    }
	
	/******NEW METHS ***/
	 /**
     * Normalizes the user-entered tags.
     */
    public static function getArrayCategory()
    {
        return ArrayHelper::map(PageCategory::find()->all(), 'id', 'title');
    }

    /**
     * Normalizes the user-entered tags.
     */
    public function normalizeTags($attribute, $params)
    {
        $this->tags = PageTag::array2string(array_unique(array_map('trim', PageTag::string2array($this->tags))));
    }

    /**
     *
     */
    public function getUrl()
    {
        return Yii::$app->getUrlManager()->createUrl(['/admin/page/default/view', 'id' => $this->id, 'slug' => $this->slug]);
    }

    public function getAbsoluteUrl()
    {
        return Yii::$app->getUrlManager()->createAbsoluteUrl(['/admin/page/default/view', 'id' => $this->id, 'slug' => $this->slug]);
    }

    /**
     *
     */
    public function getTagLinks()
    {
        $links = [];
        foreach (PageTag::string2array($this->tags) as $tag) {
            $links[] = Html::a($tag, Yii::$app->getUrlManager()->createUrl(['/admin/page/default/index', 'tag' => $tag]));
        }

        return $links;
    }

    /**
     * comment need approval
     */
    public function addComment($comment)
    {
        $comment->status = IActiveStatus::STATUS_INACTIVE;
        $comment->post_id = $this->id;
        return $comment->save();
    }
	
	/**
     * This is invoked when a record is populated with data from a find() call.
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTags = $this->tags;
    }
	 public function getCommentsCount()
    {
        return $this->hasMany(PageComment::className(), ['post_id' => 'id'])->count('post_id');
    }
	 public function getComments()
    {
        return $this->hasMany(PageComment::className(), ['post_id' => 'id']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PageCategory::className(), ['id' => 'category_id']);
    }

	/**
     * @return \yii\db\ActiveQuery
     */
   /* public function getUser()
    {
        if (Yii::$app->params['page']['userModel']) {
            return $this->hasOne(Yii::$app->params['page']['userModel']::className(), [Yii::$app->params['page']['userPk'] => 'user_id']);
        }
        return null;
    }*/
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        if ($this->getModule()->userModel) {
            return $this->hasOne($this->getModule()->userModel::className(), [$this->getModule()->userPK => 'user_id']);
        }
        return null;
    }
}