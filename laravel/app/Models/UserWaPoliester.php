<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWaPoliester extends Model
{
    use HasFactory;
    protected $table = 'user_wa_poliesters';
    public $timestamps = true;
    protected $fillable = ['token', 'user_id', 'domain_hit', 'token_limit'];

}
