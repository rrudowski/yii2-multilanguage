<?php

/**
* @copyright Copyright &copy; Gogodigital Srls
* @company Gogodigital Srls - Wide ICT Solutions 
* @website http://www.gogodigital.it
* @github https://github.com/cinghie/yii2-multilanguage
* @license GNU GENERAL PUBLIC LICENSE VERSION 3
* @package yii2-multilanguage
* @version 2.0.0
*/

namespace cinghie\multilanguage\widgets;

use Yii;
use yii\base\Widget;

class MultiLanguageWidget extends Widget
{

    public $calling_controller;
    public $image_type;
    public $link_home;
    public $widget_type;
    public $width;

    public function init()
    {
	    parent::init();

	    // Exception IF params -> languages not defined
	    if (!isset(Yii::$app->urlManager->languages)) {
	   	    throw new \yii\base\InvalidConfigException("You must define Yii::\$app->urlManager->languages array like ['it', 'en', 'fr', 'de', 'es']");
	    }

        // Link Home
        if(!$this->link_home) {
            $this->link_home = false;
        }

	    // Widget Type
	    if(!$this->widget_type) {
	  	    $this->widget_type = 'classic';
	    }

	    // Image Type
	    if(!$this->image_type) {
	  	    $this->image_type = 'classic';
	    }

	    // Widget Type
	    if(!$this->width) {
	  	    $this->width = '24';
	    }
    }

    public function run($params = [])
    {
        $currentLang = Yii::$app->language;
        $languages   = Yii::$app->urlManager->languages;

	    switch($this->widget_type)
	    {
		    case "selector":
		 	    $renderView = 'languageSelector';
			    break;
		    default:
		 	    $renderView = 'languageClassic';
	    }

        return $this->render($renderView, [
		    'image_type'  => $this->image_type,
		    'width'       => $this->width,
            'currentLang' => $currentLang,
            'languages'   => $languages,
	  	    'controller'  => $this->calling_controller,
            'link_home'   => $this->link_home
        ]);
  }

}
