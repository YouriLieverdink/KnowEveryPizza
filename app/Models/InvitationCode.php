<?php

namespace App\Models;

use App\Traits\Children;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvitationCode extends Code
{
    use HasFactory, Children;
}
