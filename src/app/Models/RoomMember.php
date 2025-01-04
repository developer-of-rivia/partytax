<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomMember extends Model
{
    use HasFactory;

    protected $fillable = ['member_name', 'room_id', 'relationships_id', 'name'];
}
