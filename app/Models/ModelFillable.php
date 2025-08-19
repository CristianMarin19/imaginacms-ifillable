<?php

namespace Modules\Ifillable\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class ModelFillable extends CoreModel
{

  protected $table = 'ifillable__modelfillables';
  public string $transformer = 'Modules\Ifillable\Transformers\ModelFillableTransformer';
  public string $repository = 'Modules\Ifillable\Repositories\ModelFillableRepository';
  public array $requestValidation = [
      'create' => 'Modules\Ifillable\Http\Requests\CreateModelFillableRequest',
      'update' => 'Modules\Ifillable\Http\Requests\UpdateModelFillableRequest',
    ];
  //Instance external/internal events to dispatch with extraData
  public array $dispatchesEventsWithBindings = [
    //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
    'created' => [],
    'creating' => [],
    'updated' => [],
    'updating' => [],
    'deleting' => [],
    'deleted' => []
  ];
  protected $fillable = [
      'entity_type',
      'fillables',
      'translatables_fillables'
  ];

    protected $casts = [
        'fillables' => 'json',
        'translatables_fillables' => 'json',
    ];

}
