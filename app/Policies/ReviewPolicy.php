<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    /**
     * Determine if the given review can be updated by the user.
     */
    public function update(User $user, Review $review)
    {
        return $user->id === $review->user_id;
    }

    /**
     * Determine if the given review can be deleted by the user.
     */
    public function delete(User $user, Review $review)
    {
        return $user->id === $review->user_id;
    }
}
