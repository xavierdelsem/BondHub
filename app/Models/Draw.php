<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
    public function admins(){
        return $this->belongsTo(User::class, 'user_id')->where('is_admin', true);
    }

    // protected $primaryKey = 'draw_id';
    protected $fillable = ['drawNumber','drawDate'];
    protected $casts = [
        'drawDate' => 'date',
    ];

}
