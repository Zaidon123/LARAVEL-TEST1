<?php

namespace App\Models;

use App\Services\ClassService;
use App\Services\CoursesService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [
        'courses',
    ];

    public function getClassesAttribute()
    {
        return $this->hasMany(User::class, 'userId', 'uniqueId')->get();
    }

    public function getCourseRatingAttribute()
    {
        return $this->hasMany(Courses::class, 'userId', 'uniqueId')->get();
    }

    public function getCoursesAttribute()
    {
        $myCourse = [];
        $course = ((new ClassService())->getList(['userId' => $this->attributes['uniqueId']]));
        foreach ($course as $data) {
            $data->courseId;
            $courseName = ((new CoursesService())->getFirst(['uniqueId' => $data->courseId])->name);
            array_push($myCourse, $courseName);
        }
        return $myCourse;
    }

}
