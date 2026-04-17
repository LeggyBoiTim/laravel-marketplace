<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConversationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Conversation $conversation): Response
    {
        return $user->id === $conversation->user_id_1 || $user->id === $conversation->user_id_2
            ? Response::allow()
            : Response::deny('You do not have access to this conversation.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Conversation $conversation): Response
    {
        return $user->id === $conversation->user_id_1 || $user->id === $conversation->user_id_2
            ? Response::allow()
            : Response::deny('You do not have access to this conversation.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Conversation $conversation): Response
    {
        return $user->id === $conversation->user_id_1 || $user->id === $conversation->user_id_2
            ? Response::allow()
            : Response::deny('You do not have access to this conversation.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Conversation $conversation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Conversation $conversation): bool
    {
        return false;
    }
}
