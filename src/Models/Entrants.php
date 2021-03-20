<?php

namespace App\Models\Authsch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrants extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'group_id',
        'group_name',
        'entrant_type',
    ];
}
