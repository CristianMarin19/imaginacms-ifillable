<?php

namespace Modules\Ifillable\Events;


class CreateField
{
    public $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
