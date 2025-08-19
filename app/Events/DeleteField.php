<?php

namespace Modules\Ifillable\Events;


class DeleteField
{
    public $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
