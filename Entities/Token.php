<?php

namespace Modules\Traccar\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Entities\Sentinel\User;

class Token extends Model
{

    protected $table = 'traccar__tokens';
    protected $fillable = ['user_id', 'user_api_hash'];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
