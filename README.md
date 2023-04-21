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

## Main Features and Changes

### Features
* Extension for Yii2 Framework [Yii2](https://www.yiiframework.com/)
* PHP 8.0 ready
* Show events in a calendar [Fullcalendar.io](https://fullcalendar.io/)
* Manual events add by drag and drop, also by clicking in the calendar
* Has translations (incomplete)
### Changes
* v1.4.0 - Stable, but unorganized

### Events can be added in three ways, PHP array, Javascript array or JSON feed

### View of the Calendar with draggable events
#### Php Header
```php
use ricgrangeia\fullcalendar\Domain\Entity\Event;
use ricgrangeia\fullcalendar\UI\Widget\Fullcalendar;
use ricgrangeia\fullcalendar\UI\Widget\DraggableEvents;
```
#### Html Body
```html
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="sticky-top mb-3">
                    <?= DraggableEvents::widget() ?>
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

<?= Fullcalendar::widget([
    'options' => [
        // id of the div that will be replaced with the calendar
        'id' => 'calendar',
        'language' => 'pt-pt',
        // Set Monday first day of the week, default is Sunday.
        'firstDay' => Fullcalendar::MONDAY_FIRST,
    ],
	'events' => $events,
    ]);
?>
```

