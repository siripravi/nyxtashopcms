<?php

namespace app\models;

use app\models\File;
use app\models\Image;
use app\behaviors\LanguageBehavior;
//use common\modules\sortable\behaviors\SortableBehavior;
use omgdef\multilingual\MultilingualQuery;
use voskobovich\linker\LinkerBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $slug
 * @property integer $brand_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $position
 * @property boolean $enabled
 * @property boolean $price_from
 * @property string $view
 *
 * @property string $name
 * @property string $h1
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $text
 * @property string $text_tips
 * @property string $text_features
 * @property string text_process
 * @property string text_use
 * @property string text_storage
 * @property string text_short
 * @property string text_top
 *
 * @property array $category_ids
 * @property array $option_ids
 * @property array $complect_ids
 * @property array $status_ids
 * @property integer $price
 * @property Currency $currency
 * @property integer $priceDef
 * @property Currency $currencyDef
 *
 * @property Brand $brand
 * @property Category[] $categories
 * @property Variant[] $variants
 * @property Product[] $options
 * @property Status[] $statuses
 * @property Complect[] $complects
 * @property Image $image
 * @property File[] $files
 * @property File[] $filesAll
 * @property array $fileEnabled
 * @property array $fileName
 */
class Product extends ActiveRecord
{
    private $_fileEnabled = null;
    private $_fileName = null;
    private $_price;
    private $_currency;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => LanguageBehavior::class,
                'attributes' => [
                    'name','h1',
                    'title','keywords','description',
                    'text',  //'seo'
                    'text_tips','text_features',
                    'text_use','text_process','text_storage','text_top'
                ],
                'languages' => Language::nameList(),
                'languageField' => 'lang_id',
                'tableName' => "{{%product_lang}}",
                'langForeignKey' => 'product_id',
            ],    
            TimestampBehavior::class,
            //SortableBehavior::class,
            'slug' => [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'ensureUnique' => true
            ],
            [
                'class' => LinkerBehavior::class,
                'relations' => [
                    'category_ids' => ['categories'],
                    'option_ids' => ['options'],
                    'complect_ids' => ['complects'],
                    'status_ids' => ['statuses'],
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
                                'name' => function($updater, $relatedPk, $rowCondition) {
                                    $primaryModel = $updater->getBehavior()->owner;
                                    return $primaryModel->fileName[$relatedPk];
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
            [['name', 'h1', 'title', 'category_ids', 'slug'], 'required'],
            [['brand_id', 'position'], 'integer'],
            [['slug', 'name', 'h1', 'title', 'keywords', 'view'], 'string', 'max' => 255],
            [['description', 'text', 'text_tips', 'text_features', 'text_process', 'text_use', 'text_storage', 'text_short', 'text_top'], 'string'],
            [['slug', 'name', 'h1', 'title', 'keywords', 'description', 'text', 'text_tips', 'text_features', 'text_process', 'text_use', 'text_storage', 'text_short', 'text_top'], 'trim'],
            [['enabled', 'price_from'], 'boolean'],
            [['enabled'], 'default', 'value' => true],
            [['category_ids', 'option_ids', 'complect_ids', 'status_ids', 'file_ids', 'fileEnabled'], 'each', 'rule' => ['integer']],
            [['fileName'], 'each', 'rule' => ['string']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::class, 'targetAttribute' => ['brand_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => Yii::t('app', 'Slug'),
            'brand_id' => Yii::t('app', 'Brand'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated'),
            'position' => Yii::t('app', 'Position'),
            'enabled' => Yii::t('app', 'Enabled'),
            'name' => Yii::t('app', 'Name'),
            'h1' => Yii::t('app', 'H1'),
            'title' => Yii::t('app', 'META Title'),
            'keywords' => Yii::t('app', 'META Keywords'),
            'description' => Yii::t('app', 'META Description'),
            'text_short' => Yii::t('app', 'Short description'),
            'text' => Yii::t('app', 'Description'),
            'text_tips' => Yii::t('app', 'Tips for use'),
            'text_features' => Yii::t('app', 'Features'),
            'text_process' => Yii::t('app', 'Process of polymerization'),
            'text_use' => Yii::t('app', 'Scope of application'),
            'text_storage' => Yii::t('app', 'Storage conditions'),
            'text_top' => Yii::t('app', 'Description (top)'),
            'price_from' => Yii::t('app', 'from'),
            'view' => Yii::t('app', 'View template'),
            'category_ids' => Yii::t('app', 'Categories'),
            'status_ids' => Yii::t('app', 'Statuses'),
            'complect_ids' => Yii::t('app', 'Complectation'),
            'option_ids' => Yii::t('app', 'Related products'),
            'price' => Yii::t('app', 'Price'),
            'currency' => Yii::t('app', 'Currency'),
            'priceDef' => Yii::t('app', 'Price'),
            'currencyDef' => Yii::t('app', 'Currency'),
        ];
    }

    public static function viewPage($id)
    {
        if (is_numeric($id)) {
            $page = self::find()->where(['slug'=>$id])->one();
        } else {
            $page = Product::find()->where(['slug'=>$id])->one();
          //echo $page->id; die;  //->createCommand()->getRawSql(); die;
        }
        if ($page === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        Yii::$app->view->params['page'] = $page;
        Yii::$app->view->title = $page->title;
        if ($page->description) {
            Yii::$app->view->registerMetaTag([
                'name' => 'description',
                'content' => $page->description
            ]);
        }
        if ($page->keywords) {
            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $page->keywords
            ]);
        }
        return $page;
    }

    /**
     * @return MultilingualQuery|\yii\db\ActiveQuery
     */
    public static function find()
    {
       
        return new MultilingualQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->viaTable('{{%product_category}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Product::class, ['id' => 'option_id'])->viaTable('{{%product_option}}', ['product_id' => 'id']);
    }

    /**
     * @param boolean $enabled
     * @return \yii\db\ActiveQuery
     */
    public function getVariants()
    {
        return $this->hasMany(Variant::class, ['product_id' => 'id'])->orderBy(['position' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplects()
    {
        return $this->hasMany(Complect::class, ['id' => 'complect_id'])->viaTable('{{%product_complect}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatuses()
    {
        return $this->hasMany(Status::class, ['id' => 'status_id'])->viaTable('{{%product_status}}', ['product_id' => 'id']);
    }

    /**
     * @return Image
     */
    public function getImage()
    {
        if ($variant = current($this->variants)) {
            return $variant->image;
        }

        return null;
    }

    /**
     * @param boolean|null $enabled
     * @return array
     */
    public static function getList($enabled)
    {
        return ArrayHelper::map(self::find()->andFilterWhere(['enabled' => $enabled])->orderBy('position')->all(), 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        $name = str_replace(['{{','%','}}'],'',$this->tableName());
		$prefix = Yii::$app->db->tablePrefix;
        $fullName = $prefix.$name;	
        return $this->hasMany(File::class, ['id' => 'file_id'])
            ->viaTable($fullName . '_file', [$name . '_id' => 'id'])
            ->leftJoin($fullName . '_file', 'id=file_id')
            ->where([$fullName . '_file.' . $name . '_id' => $this->id])
            ->andFilterWhere([$fullName . '_file.enabled' => true])
            ->orderBy([$fullName . '_file.position' => SORT_ASC])
            ->indexBy('id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilesAll()
    {
        $name = $this->tableName();
		$prefix = Yii::$app->db->tablePrefix;
        return $this->hasMany(File::class, ['id' => 'file_id'])
            ->viaTable($name . '_file', [str_replace($prefix,"",$name) . '_id' => 'id'])
            ->leftJoin($name . '_file', 'id=file_id')
            ->where([$name . '_file.' . str_replace($prefix,"",$name) . '_id' => $this->id])
            ->orderBy([$name . '_file.position' => SORT_ASC])
            ->indexBy('id');
    }

    public function getFileEnabled()
    {
        if ($this->_fileEnabled != null) {
            return $this->_fileEnabled;
        }
        $name = $this->tableName();
		$prefix = Yii::$app->db->tablePrefix;
        return $this->_fileEnabled = (new \yii\db\Query())
            ->select(['enabled'])
            ->from($name . '_file')
            ->where([str_replace($prefix,"",$name) . '_id' => $this->id])
            ->indexBy('file_id')
            ->column();
    }

    public function getFileName()
    {
        if ($this->_fileName != null) {
            return $this->_fileName;
        }
        $name = $this->tableName();
		$prefix = Yii::$app->db->tablePrefix;
        return $this->_fileName = (new \yii\db\Query())
            ->select(['name'])
            ->from($name . '_file')
            ->where([str_replace($prefix,"",$name) . '_id' => $this->id])
            ->indexBy('file_id')
            ->column();
    }

    public function setFileName($value)
    {
        $this->_fileName = $value;
    }

    public function setFileEnabled($value)
    {
        $this->_fileEnabled = $value;
    }

    public function getPrice()
    {
        if (!empty($this->variants[0]->price)) {
            return $this->variants[0]->price;
        }

        return null;
    }

    public function getPriceDef()
    {
        if (empty($this->_currency)) {
            $this->_currency = Currency::findOne(Yii::$app->params['currency_id']);
        }

        if (empty($this->_currency)) {
            return $this->variants[0]->price;
        } else {
            return round($this->variants[0]->price * $this->_currency->rate);
        }
    }

    public function getCurrency()
    {   
        if (!empty($this->variants[0]->currency)) {
            return $this->variants[0]->currency;
        }

        return null;
    }

    public function getCurrencyDef()
    {
        if (empty($this->_currency)) {
            $this->_currency = Currency::findOne(Yii::$app->params['currency_id']);
        }

        if (empty($this->_currency)) {
            return $this->variants[0]->currency;
        } else {
            return $this->_currency;
        }
    }
}
