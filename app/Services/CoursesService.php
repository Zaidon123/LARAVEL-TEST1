<?php


namespace App\Services;


use App\Models\Courses;

class CoursesService extends ServiceHelper
{
    public function __construct()
    {
        $this->model = new Courses();
        $this->attributes = [
            'uniqueId',
            'name',
            'teacher',
            'description',
            'cost',
        ];
        $this->searchBy = ['name'];
    }
}
