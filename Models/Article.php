<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Translate;

class Article extends Model
{
    use HasFactory , Translate;

    public function author(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    

}
