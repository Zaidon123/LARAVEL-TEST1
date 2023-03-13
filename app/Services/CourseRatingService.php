<?php

namespace App\Services;

use App\Models\CourseRating;

class CourseRatingService extends ServiceHelper
{
    public function __construct()
    {
        $this->model = new CourseRating();
        $this->attributes = [
            'userId',
            'courseId',
            'rate'
        ];
    }
}
