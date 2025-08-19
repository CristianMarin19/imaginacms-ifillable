<?php

namespace Modules\Ifillable\Repositories\Cache;

use Modules\Ifillable\Repositories\FieldRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheFieldDecorator extends CoreCacheDecorator implements FieldRepository
{
    public function __construct(FieldRepository $field)
    {
        parent::__construct();
        $this->entityName = 'ifillable.fields';
        $this->repository = $field;
    }
}
