<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociateData extends Model
{
    protected $table = 'associate_information';

    protected $guarded = ['id'];

    public static function associate($associate)
    {
        return $associate->belongsTo(Associate::class, 'user_id', 'user_id');
    }

    public function getUpdatedValues($associateData) {

        //Singular Arrays
        $associateData->learning_delivery_methods = $this->singularArray($associateData->learning_delivery_methods);
        $associateData->technologies = $this->singularArray($associateData->technologies);
        $associateData->coaching_style = $this->singularArray($associateData->coaching_style);
        $associateData->areas_of_expertise = $this->singularArray($associateData->areas_of_expertise);
        $associateData->sectors_worked_in = $this->singularArray($associateData->sectors_worked_in);
        $associateData->working_languages = $this->singularArray($associateData->working_languages);
        $associateData->awards = $this->singularArray($associateData->awards);
        $associateData->educational_qualifications = $this->singularArray($associateData->educational_qualifications);
        $associateData->credentials = $this->singularArray($associateData->credentials);
        $associateData->end_to_end_design = $this->singularArray($associateData->end_to_end_design);
        $associateData->work_with_preferences = $this->singularArray($associateData->work_with_preferences);

        //Merged Arrays
        $associateData->coaching_accreditations = $this->doubleArray($associateData->primary_coaching_accreditations, $associateData->secondary_coaching_accreditations);
        $associateData->skillset = $this->doubleArray($associateData->primary_skillset, $associateData->secondary_skillsets);
        $associateData->facilitating_accreditations = $this->doubleArray($associateData->primary_facilitating_accreditations, $associateData->secondary_facilitating_accreditations);

//        dd($associateData);
        return $associateData;
    }

    public function singularArray($field) {

        if ($field) {
            $field = str_replace(['"', '[', ']'], "", $field);
            $field = str_replace(['\/'], "/", $field);
            $field = str_replace(' ,', ",", $field);
            $field = explode(',', $field);
        } else {
            $field[0] = '';
        }
        $removables = [null, '', ' ', 'null'];
        return array_diff($field, $removables);

    }

    public function doubleArray($field1, $field2) {
        if ($field1) {
            $field1 = str_replace(['"', '[', ']'], "", $field1);
            $field1 = str_replace(['\/'], "/", $field1);
            $field1 = str_replace(' ,', ",", $field1);
            $field1 = explode(',', $field1);
        } else {
            $field1[0] = '';
        }

        if ($field2) {
            $field2 = str_replace(['"', '[', ']'], "", $field2);
            $field2 = str_replace(['\/'], "/", $field2);
            $field2 = str_replace(' ,', ",", $field2);
            $field2 = explode(',', $field2);
        } else {
            $field2[0] = '';
        }

        $removables = [null, '', ' ', 'null'];

        $array = array_merge($field1, $field2);
        return array_diff($array, $removables);

    }

}
