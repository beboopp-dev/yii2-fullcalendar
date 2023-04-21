<?php
/**
 * @author Ricardo Grangeia Dias <ricardograngeia@gmail.com>
 * @profile PHP Developer
 */

namespace ricgrangeia\fullcalendar\Application\Assets;

use yii\jui\JuiAsset;
use yii\web\AssetBundle;

/**
 * Class ThemeAsset
 * @package ricgrangeia\fullcalendar
 */
class ThemeAsset extends AssetBundle
{
	/** @var array The dependencies for the ThemeAsset bundle */
	public $depends = [
		JuiAsset::class,
	];
}
