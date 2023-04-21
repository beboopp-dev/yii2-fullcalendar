<?php
/**
 * @author Ricardo Grangeia Dias <ricardograngeia@gmail.com>
 * @profile PHP Developer
 */

namespace ricgrangeia\fullcalendar\Application\Assets;

use Yii;
use yii\web\AssetBundle;
use yii\i18n\PhpMessageSource;
use yii\web\YiiAsset;

/**
 * Class CoreAsset
 * @package ricgrangeia\fullcalendar
 */
class CoreAsset extends AssetBundle
{
	/**
	 * @var  boolean
	 * Whether to automatically generate the needed language js files.
	 * If this is true, the language js files will be determined based on the actual usage of [[DatePicker]]
	 * and its language settings. If this is false, you should explicitly specify the language js files via [[js]].
	 */
	public $autoGenerate = true;
	/** @var  array Required CSS files for the fullcalendar */
	public $css = [
		'css/fullcalendar.css',
	];
	/** @var  array List of the dependencies this assets bundle requires */
	public $depends = [
		YiiAsset::class,
		MomentAsset::class

	];
	/**
	 * @var  boolean
	 * FullCalendar can display events from a public Google Calendar. Google Calendar can serve as a backend that manages and persistently stores event data (a feature that FullCalendar currently lacks).
	 * Please read http://fullcalendar.io/docs/google_calendar/ for more information
	 */
	public $googleCalendar = false;
	/** @var  array Required JS files for the fullcalendar */
	public $js = [
		'plugins/fullcalendar/index.global.min.js',

	];
	/** @var  string Language for the fullcalendar */
	public $language = 'en';
	/** @var  string Location of the fullcalendar distribution */
	public $sourcePath = '@vendor/ricgrangeia/yii2-fullcalendar/src/UI/Assets';


	public function init() {


		parent::init();

		if (!isset(Yii::$app->i18n->translations['yii2fullcalendar']))
		{
			Yii::$app->i18n->translations['yii2fullcalendar'] = [
				'class' => PhpMessageSource::class,
				'basePath' => '@ricgrangeia/fullcalendar/UI/messages',
				'sourceLanguage' => 'en',
			];
		}
	}

	/**
	 * @inheritdoc
	 */
	public function registerAssetFiles($view)
	{
		$language = empty($this->language) ? \Yii::$app->language : $this->language;
		if (file_exists($this->sourcePath . "plugins/fullcalendar/locale/$language.js")) {
			$this->js[] = "locale/$language.js";
		}

		if ($this->googleCalendar) {
			$this->js[] = 'gcal.js';
		}
		
		// We need to return the parent implementation otherwise the scripts are not loaded
		return parent::registerAssetFiles($view);
	}
}
