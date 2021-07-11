<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Service extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ["name", "description"];

    /**
     * function take array of translatable data
     * [ 'name' =>['en'=>'service1', 'ar'=>'any thing'],  'description'=> ['en'=>'', 'ar'=>'']]
     */
    public function setFieldsTranslations(array $array){
        foreach($this->translatable as $prop){
            if(isset($array[$prop])){
                $this->setTranslations($prop, $array[$prop]);
            }
            $this->save();
        }
    }

    public function doctors(){
        return $this->hasMany(Doctor::class);
    }
}
