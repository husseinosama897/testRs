<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class advertising extends Model
{
    use HasFactory;
    protected $fillable = [
       'name',
     'from',
    'to',
    'total',
        'daily_budget',
    ];
    public function image(){
        return $this->hasmany(image::class,'advertising_id');
    }
}
