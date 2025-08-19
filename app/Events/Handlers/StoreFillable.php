<?php

namespace Modules\Ifillable\Events\Handlers;

use Illuminate\Database\Eloquent\Model;
use Modules\Ifillable\Models\Field;

class StoreFillable
{
    public function handle($event)
    {

        $params = $event->params;
        $dataFromRequest = $params['data'];
        $model = $params['model'];

        $this->syncExtraFillable($dataFromRequest, $model);
    }

    /**
     * Create schedule to entity
     */
    public function syncExtraFillable($params, $model)
    {

        //Validate data fields
        $dataFields = $this->validateExtraFillable($params, $model);

        if (empty($dataFields['base']) && empty($dataFields['translated'])) {
            return;
        }

        //Insert New fields
        foreach ($this->formatFillableToDataBase($dataFields, $model) as $field) {
            Field::updateOrCreate(
                ['title' => $field['name'], 'entity_id' => $field['entity_id'], 'entity_type' => $field['entity_type']],
                $field
            );
        }
    }

    /**
     * Return available site locales
     */
    public function getAvailableLocales()
    {
        return array_keys(getSupportedLocales());
    }

    /**
     * Validate data to keep only fields to sync
     *
     * @param array $extraFields
     * @return array
     */
    public function validateExtraFillable($extraFields = [], $model)
    {
        $modelFillableRepository = app('Modules\Ifillable\Repositories\ModelFillableRepository');

        $params = json_decode(json_encode([
            "filter" => [
                "entity_type" => get_class($model)
            ]
        ]));

        $entityFields = $modelFillableRepository->getItemsBy($params)->first();

        if (!$entityFields) {
            return [];
        }

        $fillableFields = $entityFields->fillables ?? [];
        $translatableFields = $entityFields->translatables_fillables ?? [];

        $baseFields = array_filter(
            $extraFields,
            fn($value, $key) => in_array($key, $fillableFields), ARRAY_FILTER_USE_BOTH
        );

        $locales = $this->getAvailableLocales();
        $translatedFields = [];

        foreach ($locales as $locale) {
            if (!isset($extraFields[$locale]) || !is_array($extraFields[$locale])) {
                continue;
            }

            $translatedLocaleFields = array_filter(
                $extraFields[$locale],
                fn($value, $key) => in_array($key, $translatableFields),ARRAY_FILTER_USE_BOTH
            );

            if (!empty($translatedLocaleFields)) {
                $translatedFields[$locale] = $translatedLocaleFields;
            }
        }

        return [
            'base' => $baseFields,
            'translated' => $translatedFields,
        ];
    }

    public function formatFillableToDataBase($dataFields, $model)
    {
        $results = [];

        foreach ($dataFields['base'] as $name => $value) {
            $results[] = [
                'name' => $name,
                'value' => $value,
                'entity_id' => $model->id,
                'entity_type' => get_class($model),
            ];
        }

        $translatedGrouped = [];

        foreach ($dataFields['translated'] as $locale => $fields) {
            foreach ($fields as $name => $value) {
                if (!isset($translatedGrouped[$name])) {
                    $translatedGrouped[$name] = [
                        'name' => $name,
                        'entity_id' => $model->id,
                        'entity_type' => get_class($model),
                    ];
                }

                $translatedGrouped[$name][$locale] = [
                    'value' => $value,
                ];
            }
        }

        return array_merge($results, array_values($translatedGrouped));
    }

}
