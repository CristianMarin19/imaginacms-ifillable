# imaginacms-ifillable

## Implementation with Modules

### In the Entity (Models/Entity)

- Add Events

```php
 public $dispatchesEventsWithBindings = [
        'created' => [
            ['path' => 'Modules\Ifillable\Events\CreateField']
        ],
        'creating' => [],
        'updated' => [
            ['path' => 'Modules\Ifillable\Events\CreateField']
        ],
        'updating' => [],
        'deleting' => [
            ['path' => 'Modules\Ifillable\Events\CreateField']
        ],
        'deleted' => []
    ];
```

- Add relation:

```php
public function fields()
    {
        if (isModuleEnabled('Ifillable')) {
            return app(\Modules\Ifillable\Relations\FillablesRelation::class)->resolve($this);
        }
        return new \Imagina\Icore\Relations\EmptyRelation();
    }
```

### In Transformer  (Transformers/EntityTransformer)


- Add relation with fields
- Instead of returning the full fields relationship as an array of objects, the transformer extracts each field's value and exposes it directly at the top level of the API response.
```php
public function modelAttributes($request):array
  {
      $attributes = [];

      if ($this->resource->relationLoaded('fields')) {
          $translations = [];
          $currentLocale = app()->getLocale();

          foreach ($this->resource->fields as $field) {
              $isMultilang = false;
              $fieldTitle = $field->title;

              foreach ($field->getAttributes() as $locale => $data) {
                  if (is_array($data) && isset($data['value'])) {
                      $translations[$locale][$fieldTitle] = $data['value'];
                      $isMultilang = true;
                  }
              }

              if ($isMultilang) {
                  $attributes[$fieldTitle] = $translations[$currentLocale][$fieldTitle] ?? null;
              } else {
                  $attributes[$fieldTitle] = $field->value;
              }
          }

          $attributes = array_merge($attributes, $translations);
      }

      return $attributes;
  }
```
- Even though the fields relationship is not shown in the final response, it must be loaded (->with('fields')) for this logic to work. Otherwise, the transformer cannot access the field data.
To hide the fields array from the output while still using its data, the transformer defines:
``` php
protected array $excludeRelations = ['fields'];
```
### Extra

- It is also necessary to create records for each entity and add the extra fields that they must handle so that the relationship can generate its relationship with its respective data.

``` php
class ModelFillable extends CoreModel
```
