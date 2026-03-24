<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['user_id_1', 'user_id_2'])]
class Conversation extends Model
{
    public function userOne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_1');
    }

    public function userTwo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_2');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
