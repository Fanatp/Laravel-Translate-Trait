<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

/**
 * 
 */
trait Translate
{

    public function getModelName()
    {
        return get_class($this);
    }

    public function setTranslate($column,$value, $locale)
    {
      
        $res = DB::table('translate')
        ->updateOrInsert(
        ["model" => $this->getModelName(),"column" => $column,"key" => $this->getKey(),"locale" => $locale],
        ['value' => $value]);

        return response()->json(["status" => "200 OK"]);
    }

    public function getTranslate($column, $locale){
        $res = DB::table('translate')
        ->where('model', $this->getModelName())
        ->where('column', $column)
        ->where('key', $this->getKey())
        ->where('locale', $locale)->first();

        if($res) return $res->value;

        $noTranslate = self::find($this->getKey());

        // return abort(403, 'Переклад відсутній ');

        if($noTranslate->$column !== null)
        {
            return $noTranslate->$column;
        }else{
            return abort(403, 'Такої колонки для перекладу немає в базі !');
        }
        
        
    }
    
}
