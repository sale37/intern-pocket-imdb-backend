<?php

namespace App\Policies;

use App\User;
use App\Watchlist;
use Illuminate\Auth\Access\HandlesAuthorization;

class WatchlistPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Watchlist $watchlist)
    {
        return $watchlist->user_id == auth()->id();
    }
}
