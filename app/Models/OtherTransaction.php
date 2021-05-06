<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherTransaction extends Model
{
    use HasFactory;

    protected $table = 'other_transaction';

    protected $fillable = ['form_id', 'name', 'selected', 'selected2', 'type'];
    
}
