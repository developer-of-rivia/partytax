<?php

namespace App\Models;

use App\Models\MemberExpense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    // public function membersExpenses()
    // {
    //     return $this->hasMany(MemberExpense::class);
    // }

    use HasFactory;

    protected $fillable = ['price', 'name', 'room_id', 'count'];
}
