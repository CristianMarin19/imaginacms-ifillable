<?php

namespace Modules\Ifillable\Models;

use Illuminate\Database\Eloquent\Model;

class FieldTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'value',
    ];
    protected $table = 'ifillable__field_translations';
}
