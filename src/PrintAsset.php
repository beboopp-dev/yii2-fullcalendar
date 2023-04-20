<?php

namespace ricgrangeia\fullcalendar;

/**
 * Class PrintAsset
 * @package ricgrangeia\fullcalendar
 */
class PrintAsset extends \yii\web\AssetBundle
{
	/** @var  array The CSS file for the print style */
	public $css = [
		'fullcalendar.print.css',
	];
	/** @var  array The CSS options */
	public $cssOptions = [
		'media' => 'print',
	];
	/** @var  string Bower path for the print settings */
	public $sourcePath = '@npm/fullcalendar/dist';
}

