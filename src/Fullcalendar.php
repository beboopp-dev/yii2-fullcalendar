<?php

namespace ricgrangeia\fullcalendar;


use Yii;

/**
 * Class Fullcalendar
 * @package ricgrangeia\fullcalendar
 */
class Fullcalendar extends \yii\base\Widget {
	/**
	 * @var array  The fullcalendar options, for all available options check http://fullcalendar.io/docs/
	 */
	public $clientOptions = [
		'weekends' => true,
		'default' => 'agendaDay',
		'editable' => false,
	];
	/**
	 * @var array  Array containing the events, can be JSON array, PHP array or URL that returns an array containing JSON events
	 */
	public $events = [];
	/** @var boolean  Determines whether or not to include the gcal.js */
	public $googleCalendar = false;
	/**
	 * @var array
	 * Possible header keys
	 * - center
	 * - left
	 * - right
	 * Possible options:
	 * - title
	 * - prevYear
	 * - nextYear
	 * - prev
	 * - next
	 * - today
	 * - basicDay
	 * - agendaDay
	 * - basicWeek
	 * - agendaWeek
	 * - month
	 */
	public $header = [
		'center' => 'title',
		'left' => 'prev,next, today',
		'right' => 'agendaDay,agendaWeek,month',
	];
	/** @var string  Text to display while the calendar is loading */
	public $loading = 'Please wait, calendar is loading';
	/**
	 * @var array  Default options for the id and class HTML attributes
	 */
	public $options = [
		'id' => 'calendar',
		'class' => 'fullcalendar',
	];
	/**
	 * @var boolean  Whether or not we need to include the ThemeAsset bundle
	 */
	public $theme = false;

	/**
	 * Always make sure we have a valid id and class for the Fullcalendar widget
	 */
	public function init() {

		if ( !isset( $this->options['id'] ) ) {
			$this->options['id'] = $this->getId();
		}
		if ( !isset( $this->options['class'] ) ) {
			$this->options['class'] = 'fullcalendar';
		}

		parent::init();
	}

	/**
	 * Load the options and start the widget
	 */
	public function run() {

		$this->echoLoadingTags();

		$assets = CoreAsset::register( $this->view );

		if ( $this->theme === true ) { // Register the theme
			ThemeAsset::register( $this->view );
		}

		if (isset($this->options['language'])) {
			$assets->language = $this->options['language'];
		}


		$this->view->registerJs( <<<JS
				$(function () {
			
					/* initialize the external events
					 -----------------------------------------------------------------*/
					function ini_events(ele) {
						ele.each(function () {
			
							// create an Event Object (https://fullcalendar.io/docs/event-object)
							// it doesn't need to have a start or end
							var eventObject = {
								title: $.trim($(this).text()) // use the element's text as the event title
							}
			
							// store the Event Object in the DOM element so we can get to it later
							$(this).data('eventObject', eventObject)
			
							// make the event draggable using jQuery UI
							// $(this).draggable({
							//     zIndex        : 1070,
							//     revert        : true, // will cause the event to go back to its
							//     revertDuration: 0  //  original position after the drag
							// })
			
						})
					}
			
					ini_events($('#external-events div.external-event'))
			
					/* initialize the calendar
					 -----------------------------------------------------------------*/
					//Date for the calendar events (dummy data)
					var date = new Date()
					var d    = date.getDate(),
						m    = date.getMonth(),
						y    = date.getFullYear()
			
					var Calendar = FullCalendar.Calendar;
					
			
					var containerEl = document.getElementById('external-events');
					var checkbox = document.getElementById('drop-remove');
					var calendarEl = document.getElementById('calendar');
			
					// initialize the external events
					// -----------------------------------------------------------------
			
				
			
			
					var calendar = new Calendar(calendarEl, {
						locale: 'pt-pt',
						weekNumbers: true,
						initialView: 'dayGridMonth',
						multiMonthMaxColumns: 1, // force a single column
						{$this->echoButtonTranslation()}
						{$this->echoHeaderToolbar()}
						themeSystem: 'bootstrap',
						
						{$this->getEvents()}
						
						editable: true,
						//Random default events
						// events: 'https://fullcalendar.io/api/demo-feeds/events.json'
						
						editable  : true,
						droppable : true, // this allows things to be dropped onto the calendar !!!
						drop      : function(info) {
							// is the "remove after drop" checkbox checked?
							if (checkbox.checked) {
								// if so, remove the element from the "Draggable Events" list
								info.draggedEl.parentNode.removeChild(info.draggedEl);
							}
						}
					});
			
					calendar.render();
					// $('#calendar').fullCalendar()
			
					
				})

		JS, \yii\web\View::POS_READY );

	}

	/**
	 * Echo the tags to show the loading state for the calendar
	 */
	private function echoLoadingTags() {

		echo \yii\helpers\Html::beginTag( 'div', $this->options ) . "\n";
		echo \yii\helpers\Html::beginTag( 'div', [ 'class' => 'fc-loading', 'style' => 'display:none;' ] );
		echo \yii\helpers\Html::encode( $this->loading );
		echo \yii\helpers\Html::endTag( 'div' ) . "\n";
		echo \yii\helpers\Html::endTag( 'div' ) . "\n";
	}

	private function echoHeaderToolbar(): string {

		return <<< TEXT
			headerToolbar: {
				left  :	'prev,next today',
				center: 'title',
				right : 'multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay'
			},
		TEXT;
	}

	private function echoButtonTranslation(): string {

		$buttonText = "buttonText: {";
		$buttonText .= "	today:	'" . Yii::t( 'yii2fullcalendar', 'Today' ) . "',";
		$buttonText .= "	year:	'" . Yii::t( 'yii2fullcalendar', 'Year' ) . "',";
		$buttonText .= "	month:	'" . Yii::t( 'yii2fullcalendar', 'Month' ) . "',";
		$buttonText .= "	week:	'" . Yii::t( 'yii2fullcalendar', 'Week' ) . "',";
		$buttonText .= "	day:	'" . Yii::t( 'yii2fullcalendar', 'Day' ) . "',";
		$buttonText .= "	list:	'" . Yii::t( 'yii2fullcalendar', 'List' ) . "',";
		$buttonText .= "},";

		return $buttonText;
	}


	private function getEvents() {

		return <<< TEXT

			events: [
				{
					title          : 'All Day Event',
					start          : new Date(y, m, 1),
					backgroundColor: '#f56954', //red
					borderColor    : '#f56954', //red
					allDay         : true
				},
				{
					title          : 'Long Event',
					start          : new Date(y, m, d - 5),
					end            : new Date(y, m, d - 2),
					backgroundColor: '#f39c12', //yellow
					borderColor    : '#f39c12' //yellow
				},
				{
					title          : 'Meeting',
					start          : new Date(y, m, d, 10, 30),
					allDay         : false,
					backgroundColor: '#0073b7', //Blue
					borderColor    : '#0073b7' //Blue
				},
				{
					title          : 'Lunch',
					start          : new Date(y, m, d, 12, 0),
					end            : new Date(y, m, d, 14, 0),
					allDay         : false,
					backgroundColor: '#00c0ef', //Info (aqua)
					borderColor    : '#00c0ef' //Info (aqua)
				},
				{
					title          : 'Birthday Party',
					start          : new Date(y, m, d + 1, 19, 0),
					end            : new Date(y, m, d + 1, 22, 30),
					allDay         : false,
					backgroundColor: '#00a65a', //Success (green)
					borderColor    : '#00a65a' //Success (green)
				},
				{
					title          : 'Click for Google',
					start          : new Date(y, m, 28),
					end            : new Date(y, m, 29),
					url            : 'https://www.google.com/',
					backgroundColor: '#3c8dbc', //Primary (light-blue)
					borderColor    : '#3c8dbc' //Primary (light-blue)
				}
			],

		TEXT;

	}


	/**
	 * @return string
	 * Returns an JSON array containing the fullcalendar options,
	 * all available callbacks will be wrapped in JsExpressions objects if they're set
	 */
	private function getClientOptions() {

		$options['loading'] = new \yii\web\JsExpression( "function(isLoading, view ) {
			jQuery('#{$this->options['id']}').find('.fc-loading').toggle(isLoading);
        }" );

		$options['events'] = $this->events;
		$options = array_merge( $options, $this->clientOptions );

		return \yii\helpers\Json::encode( $options );
	}
}
