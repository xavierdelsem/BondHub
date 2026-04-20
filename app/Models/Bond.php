<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bond extends Model
{
    protected $fillable = ['bondNumber', 'bondSeries', 'buying_date'];

    protected $casts = [
        'buying_date' => 'date',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
