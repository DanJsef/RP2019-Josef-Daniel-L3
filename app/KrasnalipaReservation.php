<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KrasnalipaReservation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'h_7', 'h_8','h_9', 'h_10', 'h_11', 'h_12', 'h_13', 'h_14', 'h_15'
    ];
}