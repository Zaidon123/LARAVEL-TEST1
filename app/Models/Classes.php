<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'uniqueId',
        'userId',
        'courseId',
        'note',
    ];

    public function getUserAttribute(){
    return $this->hasOne(User::class,'uniqueId','userId')->first();
    }
    public function getCourseAttribute(){
    return $this->hasOne(Courses::class,'uniqueId','courseId')->first();
    }
}
