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

    public function getAmountFormatAttribute()
    {
        $format = number_format($this->amount, 2, ',', '.');
        return "$$format";
    }

    public function getStatusColorAttribute()
    {
        $colorForStatu = [
            'CREATED' => 'bg-warning',
            'PAYED' => 'bg-success',
            'REJECTED' => 'bg-danger'
        ];

        return $colorForStatu[$this->status];
    }
}
