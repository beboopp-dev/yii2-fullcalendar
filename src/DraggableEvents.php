<?php
/*
 * @author Ricardo Grangeia Dias <ricardograngeia@gmail.com>
 * @profile PHP Developer
 */

namespace ricgrangeia\fullcalendar;

class DraggableEvents extends \yii\base\Widget {


	public function init() {

		//if ( !isset( $this->options['id'] ) ) {
		//	$this->options['id'] = $this->getId();
		//}
		//if ( !isset( $this->options['class'] ) ) {
		//	$this->options['class'] = 'fullcalendar';
		//}

		parent::init();
	}

	/**
	 * Load the options and start the widget
	 */
	public function run() {

		$assets = CoreAsset::register( $this->view );

		//if ( $this->theme === true ) { // Register the theme
		//	ThemeAsset::register( $this->view );
		//}

		echo $this->showHtml();

		$this->registerJs();

	}


	private function registerJs(): void {

		$this->view->registerJs( <<< JS
			
			$(function () {
				
				var containerEl = document.getElementById('external-events');
				
				var Draggable = FullCalendar.Draggable;
				
				new Draggable(containerEl, {
					itemSelector: '.external-event',
					eventData: function(eventEl) {
						return {
							title: eventEl.innerText,
							backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
							borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
							textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
						};
					}
				});
			})
			
		JS, \yii\web\View::POS_READY );

	}

	private function showHtml(): string {

		$draggableTitle = Yii::t( 'yii2fullcalendar', 'Draggable Events' );
		$removeAfterDrop = Yii::t( 'yii2fullcalendar', 'Remove after drop' );
		$createTitle = Yii::t( 'yii2fullcalendar', 'Create Event' );
		$addButton = Yii::t( 'yii2fullcalendar', 'Add' );

		$lunch = Yii::t( 'yii2fullcalendar', 'Lunch' );
		$goHome = Yii::t( 'yii2fullcalendar', 'Go home' );
		$doHomework = Yii::t( 'yii2fullcalendar', 'Do homework' );
		$workOnUIDesign = Yii::t( 'yii2fullcalendar', 'Work on UI design' );
		$sleep = Yii::t( 'yii2fullcalendar', 'Sleep tight' );

		return <<< HTML

			<div class="card">
				<div class="card-header">
					<h4 class="card-title">{$draggableTitle}</h4>
				</div>
				<div class="card-body">

					<div id="external-events">
						<div class="external-event bg-success ui-draggable ui-draggable-handle" style="position: relative; z-index: auto; left: 0px; top: 0px;">{$lunch}</div>
						<div class="external-event bg-warning ui-draggable ui-draggable-handle" style="position: relative;">{$goHome}</div>
						<div class="external-event bg-info ui-draggable ui-draggable-handle" style="position: relative;">{$doHomework}</div>
						<div class="external-event bg-primary ui-draggable ui-draggable-handle" style="position: relative;">{$workOnUIDesign}</div>
						<div class="external-event bg-danger ui-draggable ui-draggable-handle" style="position: relative;">{$sleep}</div>
						<div class="checkbox">
							<label for="drop-remove">
								<input type="checkbox" id="drop-remove">
								{$removeAfterDrop}
							</label>
						</div>
					</div>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{$createTitle}</h3>
				</div>
				<div class="card-body">
					<div class="btn-group" style="width: 100%; margin-bottom: 10px;">
						<ul class="fc-color-picker" id="color-chooser">
							<li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
							<li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
							<li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
							<li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
							<li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
						</ul>
					</div>
					<!-- /btn-group -->
					<div class="input-group">
						<input id="new-event" type="text" class="form-control" placeholder="Event Title">

						<div class="input-group-append">
							<button id="add-new-event" type="button" class="btn btn-primary">{$addButton}</button>
						</div>
						<!-- /btn-group -->
					</div>
					<!-- /input-group -->
				</div>
			</div>
		HTML;
	}


	private function defaultColor(): string {

		return <<< TEXT
			//Color for the event
			currColor = '#3c8dbc' //Red by default
		TEXT;
	}


	private function registerColorChooserClick(): void {

		$this->view->registerJs( <<< JS
		
			$(function () {
				{$this->defaultColor()}
			
				$('#color-chooser > li > a').click(function (e) {
					e.preventDefault()
					// Save color
					currColor = $(this).css('color')
					// Add color effect to button
					$('#add-new-event').css({
						'background-color': currColor,
						'border-color'    : currColor
					})
				})
			})
		JS, \yii\web\View::POS_READY );
	}


	private function registerEventClick(): void {

		$this->view->registerJs( <<< JS
			$(function () {
				{$this->defaultColor()}
				
				$('#add-new-event').click(function (e) {
					e.preventDefault()
					// Get value and make sure it is not null
					var val = $('#new-event').val()
					if (val.length == 0) {
						return
					}
					
					// Create events
					var event = $('<div />')
					event.css({
						'background-color': currColor,
						'border-color'    : currColor,
						'color'           : '#fff'
					}).addClass('external-event')
					event.text(val)
					$('#external-events').prepend(event)
					
					// Add draggable funtionality
					ini_events(event)
					
					// Remove event from text input
					$('#new-event').val('')
				})
			})
		JS, \yii\web\View::POS_READY );

	}


}