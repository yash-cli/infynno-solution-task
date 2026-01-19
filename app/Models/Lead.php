<?php

namespace App\Models;

use App\Enums\LeadStatus as LeadStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'title',
        'email',
        'phone',
        'status',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => LeadStatusEnum::class,
            'created_at' => 'timestamp',
        ];
    }

    /**
     * Model relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
