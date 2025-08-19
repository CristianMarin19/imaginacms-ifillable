<?php

namespace Modules\Ifillable\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Ifillable\Models\ModelFillable;
use Modules\Ifillable\Repositories\ModelFillableRepository;

class ModelFillableApiController extends CoreApiController
{
  public function __construct(ModelFillable $model, ModelFillableRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }
}
