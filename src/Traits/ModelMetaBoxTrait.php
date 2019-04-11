<?php

namespace lao9s\ModelMetaBox\Traits;

use lao9s\ModelMetaBox\Models\MetaBox;

trait ModelMetaBoxTrait
{
    /**
     * Setting relationship
     *
     * @return mixed
     */
    public function metaBoxes()
    {
        return $this->morphMany(MetaBox::class, 'model');
    }

    /**
     * Add meta box to current model
     *
     * @throws
     *
     * @param $key
     * @param $value
     * @param $json
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addMetaBox($key, $value, $json = false)
    {
        $needEncodeToJson = is_array($value) || is_object($value) || $json;

        return MetaBox::updateOrCreate(
            [
                'model_id' => $this->id,
                'model_type' => (new \ReflectionClass($this))->getName(),
                'meta_key' => $key
            ],
            [
                'meta_value' => $needEncodeToJson ? json_encode($value) : $value,
                'json' => $needEncodeToJson
            ]
        );
    }

    /**
     * Detach meta box from current model
     *
     * @param $key
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function removeMetaBox($key)
    {
        return $this->metaBoxes()->where('meta_key', $key)->delete();
    }

    /**
     * Detach all meta boxes from current model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function removeAllMetaBoxes()
    {
        return $this->metaBoxes()->delete();
    }

    /**
     * Return meta box by specific key
     *
     * @param $key
     * @param $withValue
     *
     * @return mixed
     */
    public function getMetaBox($key, $withValue = false)
    {
        $metaBox = $this->metaBoxes()->where('meta_key', $key)->first();

        return $withValue && $metaBox ? $metaBox->getValue() : $metaBox;
    }

    /**
     * Return all meta boxes
     *
     * @param $withValue
     *
     * @return mixed
     */
    public function getAllMetaBoxes($withValue = false)
    {
        $metaBoxes = $this->metaBoxes()->get();

        if($withValue){
            $metaBoxes = $metaBoxes->map(function($item){
                return (object)[
                   'key' => $item->getKey(),
                   'value' => $item->getValue()
                ];
            });
        }

        return $metaBoxes;
    }

    /**
     * Override the delete method in the model to delete meta boxes before the model is deleted.
     */
    public function delete()
    {
        if(config('modelmetabox.override_the_delete_method')){
            $this->metaBoxes()->delete();
        }

        parent::delete();
    }
}
