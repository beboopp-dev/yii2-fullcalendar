<?php
/**
 * @author Ricardo Grangeia Dias <ricardograngeia@gmail.com>
 * @profile PHP Developer
 */

namespace ricgrangeia\fullcalendar\Application\Assets;

use yii\web\AssetBundle;

/**
 * Class MomentAsset
 * @package ricgrangeia\fullcalendar
 */
class MomentAsset extends AssetBundle
{
	/** @var  array  The javascript file for the Moment library */
	public $js = [
		'plugins/moment/moment.js',
	];
	/** @var  string  The location of the Moment.js library */
	public $sourcePath = '@vendor/ricgrangeia/yii2-fullcalendar/src/UI/Assets';
}
