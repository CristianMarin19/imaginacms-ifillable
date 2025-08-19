<?php

namespace Modules\Ifillable\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class Field extends CoreModel
{
  use Translatable;

  protected $table = 'ifillable__fields';
  public string $transformer = 'Modules\Ifillable\Transformers\FieldTransformer';
  public string $repository = 'Modules\Ifillable\Repositories\FieldRepository';
  public array $requestValidation = [
      'create' => 'Modules\Ifillable\Http\Requests\CreateFieldRequest',
      'update' => 'Modules\Ifillable\Http\Requests\UpdateFieldRequest',
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
  public array $translatedAttributes = [
      'value',
  ];
  protected $fillable = [
      'title',
      'type',
      'entity_id',
      'entity_type',
  ];
}
