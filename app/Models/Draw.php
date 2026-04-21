<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
    public function admins(){
        return $this->belongsTo(User::class, 'draw_id')->where('is_admin', true);
    }

}
