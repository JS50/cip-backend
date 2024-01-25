<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Todo extends Model
{
    use HasFactory;
    protected $guarded=[];

//    public function created_at(): Attribute
//    {
//        return new Attribute(
//            set: fn($value) => $value,
//            get: fn($value) => $value->diffForHumans(),
//        );
//    }

//    public function getCreatedAtAttribute($date)
//    {
//        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
//    }
}
