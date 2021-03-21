<?php

namespace App\Models\Authsch;

//use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'displayName',
        'sn',
        'givenName',
        'mail',
        'mobile',
        'bmeunitscope',
        'permanentaddress',
        'birthdate',
    ];

    public function get_ad_memberships()
    {
        return $this->hasMany(AdMemberships::class);
    }
    public function get_attended_courses()
    {
        return $this->hasMany(AttendedCourses::class);
    }
    public function get_entrants()
    {
        return $this->hasMany(Entrants::class);
    }
    public function get_linked_accounts()
    {
        return $this->hasMany(LinkedAccounts::class);
    }
    public function get_student_club_memberships()
    {
        return $this->hasMany(StudentClubMemberships::class);
    }

}
