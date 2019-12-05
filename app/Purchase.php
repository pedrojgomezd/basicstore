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
        switch ($this->status) {
            case 'CREATED':
                return 'bg-warning';
                break;
            case 'PAYED':
                return 'bg-success';
                break;
            case 'REJECTED':
                return 'bg-danger';
                break;            
            default:
                return 'bg-default';
                break;
        }
    }
}
