<?php
namespace App\Services;
use App\Models\User;

class UserService extends ServiceHelper {
    public function __construct()
    {
        $this->model = new User();
        $this->attributes = [
            'uniqueId',
            'name',
            'email',
            'password',
            'phone',
            'address',
            'photo',
            'skills',
            'about'
        ];
        $this->searchBy = ['name'];
    }

}
