<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

/**
 * @var Translate
 */
trait Translate
{

    public function getModelName()
    {
        return get_class($this);
    }

    public function setTranslate(srting $column,string $value,string $locale):void
    {
      
        $res = DB::table('translate')
        ->updateOrInsert(
        ["model" => $this->getModelName(),"column" => $column,"key" => $this->getKey(),"locale" => $locale],
        ['value' => $value]);
    }

    public function getTranslate(string $column,string $locale):string
    {
        $res = DB::table('translate')
        ->where('model', $this->getModelName())
        ->where('column', $column)
        ->where('key', $this->getKey())
        ->where('locale', $locale)->first();

        if($res) return $res->value;

        $noTranslate = self::find($this->getKey());


        if($noTranslate->$column !== null)
        {
            return $noTranslate->$column;
        }else{
            return abort(403, 'Такої колонки для перекладу немає в базі !');
        }
        
        
    }
    
}
