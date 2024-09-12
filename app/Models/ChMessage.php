<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;

class ChMessage extends Model
{
    use UUID;
    protected $table = 'ch_messages'; 

    protected $fillable = ['id ', 'from_id', 'to_channel_id' , 'to_id', 'body', 'attachment', 'seen','created_at','updated_at'];
    protected $casts = [
        'seen' => 'array'
    ];
}
