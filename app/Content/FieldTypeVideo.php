<?php

namespace App\Content; 

use App\Field;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FieldTypeVideo {


    private $template = 'admin.space.content.field_video';
    private $storage_path;


    /**
     * Create a new field type instance.
     *
     * @param String $storage_path
     *
     * @return void
     */
    public function __construct($storage_path) {

        $this->storagePath = $storage_path;
    }

  
    /**
     * Process.
     *
     * @param String $field_key
     * @param Array $properties
     *
     * @return Array
     */
    public function process($field_key, $properties) {

        $field = [];
        $field = $properties;
        $field['#template'] = $this->template;

        return $field;
    }


    /**
     * Load content.
     *
     * @param integer $content_id
     * @param String $field_key
     *
     * @return Array
     */
    public function load($content_id, $field_key) {

        try {
            $field = Field::where('content_id', $content_id)->where('key', $field_key)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            abort(404);
        }

        $field_arr = [];

        $field_arr['#content'] = array('#value' => $field->value);

        return $field_arr;
    }


    /**
     * Get validation rules and messages.
     *
     * @param Array $validation_rules_messages
     * @param String $field_key
     * @param Array $properties
     *
     * @return Array
     */
    public function get_validation_rules_messages($validation_rules_messages, $field_key, $properties) {

        return $validation_rules_messages;
    }


    /**
     * Save entry.
     *
     * @param String $content_id
     * @param String $field_key
     * @param String $type
     * @param String $value
     *
     * @return True
     */
    public function save($content_id, $field_key, $type, $value) {

        try {
            /* there is only one field key per content (id) */
            $field = Field::where('content_id', $content_id)->where('key', $field_key)->firstOrFail();
            $field->value = $value;
            $field->save();

        } catch (ModelNotFoundException $e) {

            $field = new Field;
            $field->content_id = $content_id;
            $field->key = $field_key;
            $field->type = $type;
            $field->value = $value;
            $field->save();
        }

        return true;
    }


}
