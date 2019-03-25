<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Neighbor extends Pivot
{
    protected $table = 'neighbors';
}
