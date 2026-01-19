<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'email',
        'phone',
        'status',
    ];

    /**
     * Model relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
