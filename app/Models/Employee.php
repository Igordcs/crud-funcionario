<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cpf',
        'birth_date',
        'phone_number',
        'gender'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
