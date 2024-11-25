<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    //
    public function messsages() {
        return $this->hasMany(Message::class);
    }
}
