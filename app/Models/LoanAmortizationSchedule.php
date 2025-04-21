<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanAmortizationSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'month',
        'starting_balance',
        'monthly_payment',
        'principal_component',
        'interest_component',
        'ending_balance'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
