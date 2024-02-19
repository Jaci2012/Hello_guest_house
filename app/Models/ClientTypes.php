<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTypes extends Model
{
    use HasFactory;
    protected $table = 'clients'; 
    
    protected $fillable = ['nom', 'prenom', 'identifiant'];
}
