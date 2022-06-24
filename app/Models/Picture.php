<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'link','title','product_id'
    ];

    public function products(){
        return $this->belongsTo(Product::class);
    }
}
