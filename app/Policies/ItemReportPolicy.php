<?php

namespace App\Policies;

use App\Models\User;

class ItemReportPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(User $user, ItemReport $item)
{
    // Returns true if user is owner OR admin
    return $user->id === $item->user_id || $user->role === 'admin';
}
}
