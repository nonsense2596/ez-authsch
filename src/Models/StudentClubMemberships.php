<?php

namespace App\Models\Authsch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClubMemberships extends Model
{
    use HasFactory;

    protected $dateFormat = 'YYYY-MM-DD';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'club_id',
        'club_name',
        'title',
        'status',
        'start',
        'end',
    ];

}
