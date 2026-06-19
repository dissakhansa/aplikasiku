<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    //
    protected $fillable = [
        "full_name",
        "nidn",
        "user_id"
    ];

    public function hasUser(): bool
    {
        return $this->user_id !== null;
    }
}