<?php

namespace Modules\Ifillable\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Ifillable\Events\CreateField;
use Modules\Ifillable\Events\DeleteField;
use Modules\Ifillable\Events\Handlers\DeleteFillable;
use Modules\Ifillable\Events\Handlers\StoreFillable;
use Modules\Ifillable\Events\UpdateField;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        CreateField::class => [
            StoreFillable::class,
        ],
        UpdateField::class => [
            StoreFillable::class,
        ],
        DeleteField::class => [
            DeleteFillable::class,
        ],
    ];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
    protected function configureEmailVerification(): void {}
}
