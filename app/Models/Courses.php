<?php

namespace App\Models;

use App\Services\CourseRatingService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'uniqueId',
        'name',
        'teacher',
        'description',
        'cost',
    ];
    protected $appends = ['rate'];

    public function getClassesAttribute()
    {
        return $this->hasMany(User::class, 'coursesId', 'uniqueId')->get();
    }

    public function getCourseRatingAttribute()
    {
        return $this->hasMany(Courses::class, 'coursesId', 'uniqueId')->get();
    }

    public function getRateAttribute()
    {
        $sum = 0;
        $courseRate = ((new CourseRatingService())->getList(['courseId' => $this->attributes['uniqueId']]));
        if (count($courseRate) == 0) {
            return 'there are no rate for this course';
        }
        foreach ($courseRate as $ob) {
            $sum = $sum + $ob->score;
        }
        return $sum / count($courseRate);
    }
}
