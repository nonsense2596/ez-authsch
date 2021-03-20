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

    protected $fillable = [
        'id',
        'displayName',
        'sn',
        'givenName',
        'mail',
        'linkedAccounts',
        'eduPersonEntitlement',
        'mobile',
        'niifEduPersonAttendedCourse',
        'entrants',
        'admembership',
        'bmeunitscope',
        'permanentaddress',
        'birthdate',
    ];
}
