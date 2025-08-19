<?php

namespace Modules\Ifillable\Events;


class UpdateField
{
    public $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
