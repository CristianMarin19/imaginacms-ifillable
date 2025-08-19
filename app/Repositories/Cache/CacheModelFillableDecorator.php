<?php

namespace Modules\Ifillable\Repositories\Cache;

use Modules\Ifillable\Repositories\ModelFillableRepository;
use Imagina\Icore\Repositories\Cache\CoreCacheDecorator;

class CacheModelFillableDecorator extends CoreCacheDecorator implements ModelFillableRepository
{
    public function __construct(ModelFillableRepository $modelfillable)
    {
        parent::__construct();
        $this->entityName = 'ifillable.modelfillables';
        $this->repository = $modelfillable;
    }
}
