<?php

namespace Modules\Ifillable\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Ifillable\Models\Field;
use Modules\Ifillable\Repositories\FieldRepository;

class FieldApiController extends CoreApiController
{
  public function __construct(Field $model, FieldRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
