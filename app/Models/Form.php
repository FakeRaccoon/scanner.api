<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'form';

    protected $fillable = ['status', 'task', 'tax_billing', 'pick_up_date', 'request_date', 'received_date'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
