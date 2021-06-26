<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = ['form_id', 'name', 'selected', 'selected2', 'type', 'to_id'];

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_id', 'id');
    }
}
