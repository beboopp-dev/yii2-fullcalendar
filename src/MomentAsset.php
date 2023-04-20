<?php

namespace ricgrangeia\fullcalendar;

/**
 * Class MomentAsset
 * @package ricgrangeia\fullcalendar
 */
class MomentAsset extends \yii\web\AssetBundle
{
	/** @var  array  The javascript file for the Moment library */
	public $js = [
		'plugins/moment/moment.js',
	];
	/** @var  string  The location of the Moment.js library */
	public $sourcePath = '@vendor/ricgrangeia/yii2-fullcalendar/src/dist';
}
