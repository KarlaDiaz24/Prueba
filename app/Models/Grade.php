<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'grade',
    ];

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    protected function grade(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => min(max(0, $value), 100),
        );
    }
}
