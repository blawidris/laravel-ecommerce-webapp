<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $primaryKey = 'tab';

    protected $fillable = ['tab', 'name', 'value'];
    public $timestamps = false;
}
