<?php

namespace admin\modules\page;

use Yii;

/**
 * Class Module
 *
 * @package common\modules\page
 */
class Module extends \yii\base\Module
{
    /** @var linked user (for example, 'common\models\User::class' */
    public $userModel;// = \common\models\User::class;

    /** @var string Primary Key for user table, by default 'id' */
    public $userPK = 'id';

    /** @var string username uses in view (may be field `username` or `email` or `login`) */
    public $userName = 'username';
    public $enableComments = true;
    /**
     * @var string the namespace that controller classes are in
     */
    public $controllerNamespace = 'admin\modules\page\controllers';
    protected $_isBackend;
	
    public function init()
    {
        parent::init();

        Yii::$app->i18n->translations['page'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@admin/modules/page/messages',
        ];
		
		/*if ($this->getIsBackend() === true) { 
		  $this->viewPath = '@common/modules/page/views/backend';
		  
        } else {
			
            $this->setViewPath('@common/modules/page/views/frontend');	
            $this->layout = '@app/modules/main/views/layouts/base';		
        }*/
       
    }
	
	/**
     * Check if module is used for backend application.
     *
     * @return boolean true if it's used for backend application
     */
    public function getIsBackend()
    {
        if ($this->_isBackend === null) {
            $this->_isBackend = strpos($this->controllerNamespace, 'backend') === false ? false : true;
        }
       
        return $this->_isBackend;
    }
}