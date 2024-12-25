<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberExpense extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'expense_id'];
}