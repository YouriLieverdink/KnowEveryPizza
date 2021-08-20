<?php

namespace App\Models;

use App\Traits\Parents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory, Parents;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'codes';
}
