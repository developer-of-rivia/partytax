<?php

namespace App\Models;

use App\Models\RoomSubscriber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    // public function subscribers()
    // {
    //     return $this->hasMany(RoomSubscriber::class);
    // }

    // public function members()
    // {
    //     return $this->hasMany(RoomMember::class);
    // }

    // public function expenses()
    // {
    //     return $this->hasMany(Expense::class);
    // }

    use HasFactory;

    protected $fillable = ['link', 'password', 'name', 'creator_id', 'description'];
}
