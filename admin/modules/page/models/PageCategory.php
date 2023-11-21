<?php
/**
 * Project: yii2-page for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace admin\modules\page\models;

use admin\modules\page\Module;
use admin\modules\page\traits\ModuleTrait;
use admin\modules\page\traits\StatusTrait;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yiidreamteam\upload\ImageUploadBehavior;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "page_category".
 *
 * Это досталось от китайского модуля, еще не рефакторил
 *
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $slug
 * @property string $banner
 * @property integer $is_nav
 * @property integer $sort_order
 * @property integer $page_size
 * @property string $template
 * @property string $redirect_url
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property pagePost[] $pagePosts
 */
class PageCategory extends \yii\db\ActiveRecord
{
    use StatusTrait, ModuleTrait;

    const IS_NAV_YES = 1;
    const IS_NAV_NO = 0;
    const PAGE_TYPE_LIST = 'list';
    const PAGE_TYPE_PAGE = 'page';

    private $_isNavLabel;
    private $_status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nxt_page_category';
    }

    /**
     * @inheritdoc
     */
    public static function getOneIsNavLabel($isNav = null)
    {
        if ($isNav) {
            $arrayIsNav = self::getArrayIsNav();
            return $arrayIsNav[$isNav];
        }

        return;
    }

    /**
     * @inheritdoc
     */
    public static function getArrayIsNav()
    {
        return [
            self::IS_NAV_YES => Yii::t('page', 'YES'),
            self::IS_NAV_NO => Yii::t('page', 'NO'),
        ];
    }

    /**
     * Это досталось от китайского модуля, еще не рефакторил
     *
     * @param int $parentId parent category id
     * @param array $array category array list
     * @param int $level category level, will affect $repeat
     * @param int $add times of $repeat
     * @param string $repeat symbols or spaces to be added for sub category
     * @return array  category collections
     */

    static public function get($parentId = 0, $array = array(), $level = 0, $add = 2, $repeat = '　')
    {
        $strRepeat = '';
        // add some spaces or symbols for non top level categories
        if ($level > 1) {
            for ($j = 0; $j < $level; $j++) {
                $strRepeat .= $repeat;
            }
        }

        // i feel this is useless
        if ($level > 0) {
            $strRepeat .= '';
        }

        $newArray = array();
        $tempArray = array();

        //performance is not very good here
        foreach (( array )$array as $v) {
            if ($v['parent_id'] == $parentId) {
                $newArray [] = array(
                    'id' => $v['id'],
                    'title' => $v['title'],
                    'parent_id' => $v['parent_id'],
                    'sort_order' => $v['sort_order'],
                    'banner' => $v->getThumbFileUrl('banner', 'thumb'), //'postsCount'=>$v['postsCount'],
                    'is_nav' => $v['is_nav'],
                    'template' => $v['template'],
                    'status' => $v->getStatus(),
                    'created_at' => $v['created_at'],
                    'updated_at' => $v['updated_at'],
                    'redirect_url' => $v['redirect_url'],
                    'str_repeat' => $strRepeat,
                    'str_label' => $strRepeat . $v['title'],
                );

                $tempArray = self::get($v['id'], $array, ($level + $add), $add, $repeat);
                if ($tempArray) {
                    $newArray = array_merge($newArray, $tempArray);
                }
            }
        }
        return $newArray;
    }

    /**
     * Это досталось от китайского модуля, еще не рефакторил
     * капец тут страшно всё непонятно
     *
     * return all sub categorys of a parent category
     * @param int $parentId
     * @param array $array
     * @return array
     */

    static public function getCategory($parentId = 0, $array = array())
    {
        $newArray = array();
        foreach ((array)$array as $v) {
            if ($v['parent_id'] == $parentId) {
                $newArray[$v['id']] = array(
                    'text' => $v['title'] . ' 导航[' . ($v['is_nav'] ? Yii::t('page', 'CONSTANT_YES') : Yii::t('page', 'CONSTANT_NO')) . '] 排序[' . $v['sort_order'] .
                        '] 类型[' . ($v['page_type'] == 'list' ? Yii::t('page', 'PAGE_TYPE_LIST') : Yii::t('page', 'PAGE_TYPE_PAGE')) . '] 状态[' .
                        F::getStatus2($v['status']) . '] [<a href="' . Yii::app()->createUrl('/admin/page/page-category/update', array('id' => $v['id'])) . '">修改</a>][<a href="'
                        . Yii::app()->createUrl('/admin/page/page-category/create', array('id' => $v['id'])) . '">增加子菜单</a>]&nbsp;&nbsp[<a href="' .
                        Yii::app()->createUrl('/admin/page/page-category/delete', array('id' => $v['id'])) . '">删除</a>]',
                    //'children'=>array(),
                );

                $tempArray = self::getCategory($v['id'], $array);
                if ($tempArray) {
                    $newArray[$v['id']]['children'] = $tempArray;
                }
            }
        }
        return $newArray;
    }

    /**
     * @param int $parentId
     * @param array $array
     * @return int|string
     */
    static public function getCategoryIdStr($parentId = 0, $array = array())
    {
        $str = $parentId;
        foreach ((array)$array as $v) {
            if ($v['parent_id'] == $parentId) {

                $tempStr = self::getCategoryIdStr($v['id'], $array);
                if ($tempStr) {
                    $str .= ',' . $tempStr;
                }
            }
        }
        return $str;
    }

    /**
     * @param int $id
     * @param array $array
     * @return array|int
     */
    static public function getCategorySub2($id = 0, $array = array())
    {
        if (0 == $id) {
            return 0;
        }

        $arrayResult = array();
        $rootId = self::getRootCategoryId($id, $array);
        foreach ((array)$array as $v) {
            if ($v['parent_id'] == $rootId) {
                array_push($arrayResult, $v);
            }
        }

        return $arrayResult;
    }

    /**
     * @param int $id
     * @param array $array
     * @return int
     */
    static public function getRootCategoryId($id = 0, $array = [])
    {
        if (0 == $id) {
            return 0;
        }

        foreach ((array)$array as $v) {
            if ($v['id'] == $id) {
                $parentId = $v['parent_id'];
                if (0 == $parentId) {
                    return $id;
                } else {
                    return self::getRootCategoryId($parentId, $array);
                }
            }
        }
    }

    /**
     * @param int $id
     * @param array $array
     * @return array|void
     */
    static public function getBreadcrumbs($id = 0, $array = array())
    {
        if (0 == $id) {
            return;
        }

        $arrayResult = self::getPathToRoot($id, $array);

        return array_reverse($arrayResult);
    }

    /**
     * @param int $id
     * @param array $array
     * @return array|void
     */
    static public function getPathToRoot($id = 0, $array = array())
    {
        if (0 == $id) {
            return array();
        }

        $arrayResult = array();
        $parent_id = 0;
        foreach ((array)$array as $v) {
            if ($v['id'] == $id) {
                $parent_id = $v['parent_id'];
                if (self::PAGE_TYPE_LIST == $v['page_type']) {
                    $arrayResult = array($v['title'] => array('list', id => $v['id']));
                } elseif (self::PAGE_TYPE_PAGE == $v['page_type']) {
                    $arrayResult = array($v['title'] => array('page', id => $v['id']));
                }
            }
        }

        if (0 < $parent_id) {
            $arrayTemp = self::getPathToRoot($parent_id, $array);

            if (!empty($arrayTemp)) {
                $arrayResult += $arrayTemp;
            }
        }

        if (!empty($arrayResult)) {
            return $arrayResult;
        } else {
            return;
        }
    }

    /**
     * created_at, updated_at to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
		    //LanguageBehavior::className(),
            TimestampBehavior::class,
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'banner',
                'thumbs' => [
                    'thumb' => ['width' => 400, 'height' => 300]
                ],
               'filePath' => Yii::$app->params['page']['imgFilePath'] . '[[model]]/[[pk]].[[extension]]',
                'fileUrl' => Yii::$app->params['page']['imgFileUrl'] . '[[model]]/[[pk]].[[extension]]',
              'thumbPath' => Yii::$app->params['page']['imgFilePath'] . '[[model]]/[[profile]]_[[pk]].[[extension]]',
               'thumbUrl' => Yii::$app->params['page']['imgFileUrl'] . '[[model]]/[[profile]]_[[pk]].[[extension]]',
             //  'filePath' => '@webroot/images/[[pk]].[[extension]]',
              // 'fileUrl' => '/images/[[pk]].[[extension]]',
              // 'thumbPath' => '@webroot/images/[[profile]]_[[pk]].[[extension]]',
              //  'thumbUrl' => '/images/[[profile]]_[[pk]].[[extension]]',
            
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_nav', 'sort_order', 'page_size', 'status', 'position'], 'integer'],
            [['title'], 'required'],
            [['sort_order', 'page_size'], 'default', 'value' => 0],
            [['title', 'template', 'redirect_url', 'slug'], 'string', 'max' => 255],
            [['banner'], 'file', 'extensions' => 'jpg, png, webp', 'mimeTypes' => 'image/jpeg, image/png, image/webp',],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('page', 'ID'),
            'parent_id' => Yii::t('page', 'Parent ID'),
            'title' => Yii::t('page', 'Title'),
            'slug' => Yii::t('page', 'Slug'),
            'banner' => Yii::t('page', 'Banner'),
            'is_nav' => Yii::t('page', 'Is Nav'),
            'sort_order' => Yii::t('page', 'Sort Order'),
			'position' => Yii::t('page', 'Sort Order'),
            'page_size' => Yii::t('page', 'Page Size'),
            'template' => Yii::t('page', 'Template'),
            'redirect_url' => Yii::t('page', 'Redirect Url'),
            'status' => Yii::t('page', 'Status'),
            'created_at' => Yii::t('page', 'Created At'),
            'updated_at' => Yii::t('page', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::class, ['category_id' => 'id']);
    }

    /**
     * @return integer
     */
    public function getPostsCount()
    {
        return $this->count(Page::class, ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(PageCategory::class, ['id' => 'parent_id']);
    }

    /**
     * @return mixed
     */
    public function getIsNavLabel()
    {
        if ($this->_isNavLabel === null) {
            $arrayIsNav = self::getArrayIsNav();
            $this->_isNavLabel = $arrayIsNav[$this->is_nav];
        }
        return $this->_isNavLabel;
    }

    public static function findBySlug($slug){
        return self::findOne(['slug'=>$slug]);
    }

    public static function findSiteCatId(){
        $slug = Yii::$app->params['sitePageSlug'] ?? "site-pages";
        $category = self::findBySlug($slug);
        return $category->id;
    }
  
}
