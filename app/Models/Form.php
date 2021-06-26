<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'form';

    protected $fillable = ['status', 'task', 'other_task', 'tax', 'billing', 'pick_up_date', 'request_date', 'received_date', 'from_id', 'to_id', 'note'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function otherTransactions()
    {
        return $this->hasMany(OtherTransaction::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_id', 'id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_id', 'id');
    }
}
