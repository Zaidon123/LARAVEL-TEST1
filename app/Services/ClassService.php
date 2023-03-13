<?php


namespace App\Services;
use App\Models\Classes;

class ClassService extends ServiceHelper
{
    public function __construct()
    {
        $this->model = new Classes();
        $this->attributes = [
            'uniqueId',
            'userId',
            'courseId',
            'note',
        ];
    }
}
