<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'loan_amount',
        'annual_interest_rate',
        'loan_term_years',
        'extra_payment',
    ];

    public function amortizationSchedule() {
        return $this->hasMany(LoanAmortizationSchedule::class);
    }
}
