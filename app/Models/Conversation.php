<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

#[Fillable(['user_id_1', 'user_id_2'])]
class Conversation extends Model
{
    public static function orderUserIds($userId1, $userId2)
    {
        return [$userId1, $userId2] = $userId1 < $userId2 
            ? [$userId1, $userId2] 
            : [$userId2, $userId1];
    }

    public function userOne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_1');
    }

    public function userTwo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_2');
    }

    public function otherUser()
    {
        return Auth::id() === $this->user_id_1 ? $this->userTwo : $this->userOne;
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function latestMessage(): HasOne
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }
}
