<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class PrepaidSubscription extends Model
{
    /**
     * Get the account record associated with the address.
     *
     * @return BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
