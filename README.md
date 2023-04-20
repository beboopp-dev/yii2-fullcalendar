# Yii2 fullcalendar component

[![Latest Stable Version](https://poser.pugx.org/ricgrangeia/yii2-fullcalendar/v/stable)](https://packagist.org/packages/ricgrangeia/yii2-fullcalendar)
[![Total Downloads](https://poser.pugx.org/ricgrangeia/yii2-fullcalendar/downloads)](https://packagist.org/packages/ricgrangeia/yii2-fullcalendar)
[![Latest Unstable Version](https://poser.pugx.org/ricgrangeia/yii2-fullcalendar/v/unstable)](https://packagist.org/packages/ricgrangeia/yii2-fullcalendar)
[![License](https://poser.pugx.org/ricgrangeia/yii2-fullcalendar/license)](https://packagist.org/packages/ricgrangeia/yii2-fullcalendar)
[![composer.lock](https://poser.pugx.org/ricgrangeia/yii2-fullcalendar/composerlock)](https://packagist.org/packages/ricgrangeia/yii2-fullcalendar)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install, either run

```
$ php composer.phar require ricgrangeia/yii2-fullcalendar
```

or add

```
"ricgrangeia/yii2-fullcalendar": "*"
```

[//]: # (to the ```require``` section of your `composer.json` file.)

[//]: # ()
[//]: # (## Usage)

[//]: # (### Fullcalendar can be created as following, all options are optional, below is just an example of most options)

[//]: # (```php)

[//]: # (<?= ricgrangeia\fullcalendar\Fullcalendar::widget&#40;[)

[//]: # (        'options'       => [)

[//]: # (            'id'       => 'calendar',)

[//]: # (            'language' => 'nl',)

[//]: # (        ],)

[//]: # (        'clientOptions' => [)

[//]: # (            'weekNumbers' => true,)

[//]: # (            'selectable'  => true,)

[//]: # (            'defaultView' => 'agendaWeek',)

[//]: # (            'eventResize' => new JsExpression&#40;")

[//]: # (                function&#40;event, delta, revertFunc, jsEvent, ui, view&#41; {)

[//]: # (                    console.log&#40;event&#41;;)

[//]: # (                })

[//]: # (            "&#41;,)

[//]: # ()
[//]: # (        ],)

[//]: # (        'events'        => Url::to&#40;['calendar/events', 'id' => $uniqid]&#41;,)

[//]: # (    ]&#41;;)

[//]: # (?>)

[//]: # (```)

### Events can be added in three ways, PHP array, Javascript array or JSON feed

#### HTML with draggable events
```html
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="sticky-top mb-3">
                    <?= ricgrangeia\fullcalendar\DraggableEvents::widget() ?>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
```

#### PHP
```php
<?php
    $events = [
        new Event([
            'title' => 'Appointment #' . rand(1, 999),
            'start' => '2016-03-18T14:00:00',
        ]),
        // Everything editable
        new Event([
            'id'               => uniqid(),
            'title'            => 'Appointment #' . rand(1, 999),
            'start'            => '2016-03-17T12:30:00',
            'end'              => '2016-03-17T13:30:00',
            'editable'         => true,
            'startEditable'    => true,
            'durationEditable' => true,
        ]),
        // No overlap
        new Event([
            'id'               => uniqid(),
            'title'            => 'Appointment #' . rand(1, 999),
            'start'            => '2016-03-17T15:30:00',
            'end'              => '2016-03-17T19:30:00',
            'overlap'          => false, // Overlap is default true
            'editable'         => true,
            'startEditable'    => true,
            'durationEditable' => true,
        ]),
        // Only duration editable
        new Event([
            'id'               => uniqid(),
            'title'            => 'Appointment #' . rand(1, 999),
            'start'            => '2016-03-16T11:00:00',
            'end'              => '2016-03-16T11:30:00',
            'startEditable'    => false,
            'durationEditable' => true,
        ]),
        // Only start editable
        new Event([
            'id'               => uniqid(),
            'title'            => 'Appointment #' . rand(1, 999),
            'start'            => '2016-03-15T14:00:00',
            'end'              => '2016-03-15T15:30:00',
            'startEditable'    => true,
            'durationEditable' => false,
        ]),
    ];
?>

<?= ricgrangeia\fullcalendar\Fullcalendar::widget([
    'options' => [
		'id' => 'calendar',
		'language' => 'pt-PT',
	],
	'events' => $events,
    ]);
?>
```

[//]: # ()
[//]: # (#### Javascript array)

[//]: # (```php)

[//]: # (<?= ricgrangeia\fullcalendar\Fullcalendar::widget&#40;[)

[//]: # (       'events'        => new JsExpression&#40;'[)

[//]: # (            {)

[//]: # (                "id":null,)

[//]: # (                "title":"Appointment #776",)

[//]: # (                "allDay":false,)

[//]: # (                "start":"2016-03-18T14:00:00",)

[//]: # (                "end":null,)

[//]: # (                "url":null,)

[//]: # (                "className":null,)

[//]: # (                "editable":false,)

[//]: # (                "startEditable":false,)

[//]: # (                "durationEditable":false,)

[//]: # (                "rendering":null,)

[//]: # (                "overlap":true,)

[//]: # (                "constraint":null,)

[//]: # (                "source":null,)

[//]: # (                "color":null,)

[//]: # (                "backgroundColor":"grey",)

[//]: # (                "borderColor":"black",)

[//]: # (                "textColor":null)

[//]: # (            },)

[//]: # (            {)

[//]: # (                "id":"56e74da126014",)

[//]: # (                "title":"Appointment #928",)

[//]: # (                "allDay":false,)

[//]: # (                "start":"2016-03-17T12:30:00",)

[//]: # (                "end":"2016-03-17T13:30:00",)

[//]: # (                "url":null,)

[//]: # (                "className":null,)

[//]: # (                "editable":true,)

[//]: # (                "startEditable":true,)

[//]: # (                "durationEditable":true,)

[//]: # (                "rendering":null,)

[//]: # (                "overlap":true,)

[//]: # (                "constraint":null,)

[//]: # (                "source":null,)

[//]: # (                "color":null,)

[//]: # (                "backgroundColor":"grey",)

[//]: # (                "borderColor":"black",)

[//]: # (                "textColor":null)

[//]: # (            },)

[//]: # (            {)

[//]: # (                "id":"56e74da126050",)

[//]: # (                "title":"Appointment #197",)

[//]: # (                "allDay":false,)

[//]: # (                "start":"2016-03-17T15:30:00",)

[//]: # (                "end":"2016-03-17T19:30:00",)

[//]: # (                "url":null,)

[//]: # (                "className":null,)

[//]: # (                "editable":true,)

[//]: # (                "startEditable":true,)

[//]: # (                "durationEditable":true,)

[//]: # (                "rendering":null,)

[//]: # (                "overlap":false,)

[//]: # (                "constraint":null,)

[//]: # (                "source":null,)

[//]: # (                "color":null,)

[//]: # (                "backgroundColor":"grey",)

[//]: # (                "borderColor":"black",)

[//]: # (                "textColor":null)

[//]: # (            },)

[//]: # (            {)

[//]: # (                "id":"56e74da126080",)

[//]: # (                "title":"Appointment #537",)

[//]: # (                "allDay":false,)

[//]: # (                "start":"2016-03-16T11:00:00",)

[//]: # (                "end":"2016-03-16T11:30:00",)

[//]: # (                "url":null,)

[//]: # (                "className":null,)

[//]: # (                "editable":false,)

[//]: # (                "startEditable":false,)

[//]: # (                "durationEditable":true,)

[//]: # (                "rendering":null,)

[//]: # (                "overlap":true,)

[//]: # (                "constraint":null,)

[//]: # (                "source":null,)

[//]: # (                "color":null,)

[//]: # (                "backgroundColor":"grey",)

[//]: # (                "borderColor":"black",)

[//]: # (                "textColor":null)

[//]: # (            },)

[//]: # (            {)

[//]: # (                "id":"56e74da1260a7",)

[//]: # (                "title":"Appointment #465",)

[//]: # (                "allDay":false,)

[//]: # (                "start":"2016-03-15T14:00:00",)

[//]: # (                "end":"2016-03-15T15:30:00",)

[//]: # (                "url":null,)

[//]: # (                "className":null,)

[//]: # (                "editable":false,)

[//]: # (                "startEditable":true,)

[//]: # (                "durationEditable":false,)

[//]: # (                "rendering":null,)

[//]: # (                "overlap":true,)

[//]: # (                "constraint":null,)

[//]: # (                "source":null,)

[//]: # (                "color":null,)

[//]: # (                "backgroundColor":"grey",)

[//]: # (                "borderColor":"black",)

[//]: # (                "textColor":null)

[//]: # (            },)

[//]: # (        ]'&#41;,)

[//]: # (    ]&#41;;)

[//]: # (?>)

[//]: # (```)

[//]: # ()
[//]: # (#### JSON feed)

[//]: # (```php)

[//]: # (<?= ricgrangeia\fullcalendar\Fullcalendar::widget&#40;[)

[//]: # (        'events'        => Url::to&#40;['calendar/events', 'id' => $uniqid]&#41;,)

[//]: # (    ]&#41;;)

[//]: # (?>)

[//]: # (```)

[//]: # ()
[//]: # (Your controller action would then return an array as following)

[//]: # (```php)

[//]: # (    /**)

[//]: # (	 * @param $id)

[//]: # (	 * @param $start)

[//]: # (	 * @param $end)

[//]: # (	 * @return array)

[//]: # (	 */)

[//]: # (	public function actionEvents&#40;$id, $start, $end&#41;)

[//]: # (	{)

[//]: # (		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;)

[//]: # ()
[//]: # (		return [)

[//]: # (			// minimum)

[//]: # (			new Event&#40;[)

[//]: # (				'title' => 'Appointment #' . rand&#40;1, 999&#41;,)

[//]: # (				'start' => '2016-03-18T14:00:00',)

[//]: # (			]&#41;,)

[//]: # (			// Everything editable)

[//]: # (			new Event&#40;[)

[//]: # (				'id'               => uniqid&#40;&#41;,)

[//]: # (				'title'            => 'Appointment #' . rand&#40;1, 999&#41;,)

[//]: # (				'start'            => '2016-03-17T12:30:00',)

[//]: # (				'end'              => '2016-03-17T13:30:00',)

[//]: # (				'editable'         => true,)

[//]: # (				'startEditable'    => true,)

[//]: # (				'durationEditable' => true,)

[//]: # (			]&#41;,)

[//]: # (			// No overlap)

[//]: # (			new Event&#40;[)

[//]: # (				'id'               => uniqid&#40;&#41;,)

[//]: # (				'title'            => 'Appointment #' . rand&#40;1, 999&#41;,)

[//]: # (				'start'            => '2016-03-17T15:30:00',)

[//]: # (				'end'              => '2016-03-17T19:30:00',)

[//]: # (				'overlap'          => false, // Overlap is default true)

[//]: # (				'editable'         => true,)

[//]: # (				'startEditable'    => true,)

[//]: # (				'durationEditable' => true,)

[//]: # (			]&#41;,)

[//]: # (			// Only duration editable)

[//]: # (			new Event&#40;[)

[//]: # (				'id'               => uniqid&#40;&#41;,)

[//]: # (				'title'            => 'Appointment #' . rand&#40;1, 999&#41;,)

[//]: # (				'start'            => '2016-03-16T11:00:00',)

[//]: # (				'end'              => '2016-03-16T11:30:00',)

[//]: # (				'startEditable'    => false,)

[//]: # (				'durationEditable' => true,)

[//]: # (			]&#41;,)

[//]: # (			// Only start editable)

[//]: # (			new Event&#40;[)

[//]: # (				'id'               => uniqid&#40;&#41;,)

[//]: # (				'title'            => 'Appointment #' . rand&#40;1, 999&#41;,)

[//]: # (				'start'            => '2016-03-15T14:00:00',)

[//]: # (				'end'              => '2016-03-15T15:30:00',)

[//]: # (				'startEditable'    => true,)

[//]: # (				'durationEditable' => false,)

[//]: # (			]&#41;,)

[//]: # (		];)

[//]: # (	})

[//]: # (```)

[//]: # ()
[//]: # (### Callbacks)

[//]: # ()
[//]: # (Callbacks have to be wrapped in a JsExpression&#40;&#41; object. For example if you want to use the eventResize you would add the following to the fullcalendar clientOptions)

[//]: # (```php)

[//]: # (<?= ricgrangeia\fullcalendar\Fullcalendar::widget&#40;[)

[//]: # (        'clientOptions' => [)

[//]: # (            'eventResize' => new JsExpression&#40;")

[//]: # (                function&#40;event, delta, revertFunc, jsEvent, ui, view&#41; {)

[//]: # (                    console.log&#40;event.id&#41;;)

[//]: # (                    console.log&#40;delta&#41;;)

[//]: # (                })

[//]: # (            "&#41;,)

[//]: # (        ],)

[//]: # (    ]&#41;;)

[//]: # (?>)

[//]: # (```)
