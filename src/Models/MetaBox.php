<?php

namespace lao9s\ModelMetaBox\Models;

use Illuminate\Database\Eloquent\Model;

class MetaBox extends Model
{
    protected $table = 'metaboxes';

    public $timestamps = false;

    protected $fillable = [
        'model_id',
        'model_type',
        'meta_key',
        'meta_value',
        'json',
    ];

    /**
     * Get value of the meta box
     *
     * @return string
     */
    public function getKey(){
        return $this->meta_key;
    }

    /**
     * Get value of the meta box
     *
     * @return mixed
     */
    public function getValue(){
        return $this->json && $this->meta_value ? json_decode($this->meta_value) : $this->meta_value;
    }

    /**
     * Check if value of this meta box is a json
     *
     * @return boolean
     */
    public function isJson(){
        return (boolean) $this->json;
    }
}
