<?php
/**
 * @author Ricardo Grangeia Dias <ricardograngeia@gmail.com>
 * @profile PHP Developer
 *
 * @company Sabores do Futuro
 * Copyright All rights reserved.
 */

namespace ricgrangeia\fullcalendar\Domain\Entity;

/**
 * Class CalendarModel
 * @package ricgrangeia\fullcalendar\models
 */
class CalendarModel extends \yii\base\Model
{
    /**
     * @return array
     */
    public function fields()
    {
        $fields = parent::fields();
        foreach ($fields as $field) {
            // If the attribute is not set don't return it in the response
            if (is_null($this->$field)) {
                unset($fields[$field]);
            }
        }
        return $fields;
    }
}
