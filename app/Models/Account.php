<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    
    protected $fillable = ['item','type','amount'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
