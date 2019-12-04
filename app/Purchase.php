<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['description', 'amount', 'status', 'request_id', 'process_url'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
