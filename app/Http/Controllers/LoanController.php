<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanAmortizationSchedule;
use MathPHP\Finance;

class LoanController extends Controller
{
    public function create()
    {
        return view('loan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_amount' => 'required|numeric|min:0.01',
            'annual_interest_rate' => 'required|numeric|min:0.01',
            'loan_term_years' => 'required|integer|min:1',
            'extra_payment' => 'nullable|numeric|min:0',
        ]);

        $loan = Loan::create($validated);

        $this->generateAmortizationSchedule($loan);

        return redirect()->route('loan.show', $loan->id);
    }

    public function show(Loan $loan)
    {
        $schedule = $loan->amortizationSchedule;
        $effectiveRate = $this->calculateEffectiveInterestRate($loan);

        return view('loan.show', compact('loan', 'schedule', 'effectiveRate'));
    }

    private function generateAmortizationSchedule(Loan $loan)
    {
        $balance = $loan->loan_amount;
        $monthlyRate = ($loan->annual_interest_rate / 12) / 100;
        $months = $loan->loan_term_years * 12;
        $extra = $loan->extra_payment ?? 0;

        $monthlyPayment = ($balance * $monthlyRate) / (1 - pow(1 + $monthlyRate, -$months));
        $paymentNumber = 0;

        while ($balance > 0 && $paymentNumber < $months) {
            $interest = $balance * $monthlyRate;
            $principal = $monthlyPayment - $interest;
            $totalPayment = $monthlyPayment + $extra;
            
            if ($totalPayment > $balance + $interest) {
                $principal = $balance;
                $totalPayment = $balance + $interest;
            }

            $endingBalance = $balance - $principal - $extra;
            if ($endingBalance < 0) $endingBalance = 0;

            LoanAmortizationSchedule::create([
                'loan_id' => $loan->id,
                'month' => ++$paymentNumber,
                'starting_balance' => round($balance, 2),
                'monthly_payment' => round($totalPayment, 2),
                'principal_component' => round($principal + $extra, 2),
                'interest_component' => round($interest, 2),
                'ending_balance' => round($endingBalance, 2),
            ]);

            $balance = $endingBalance;
        }
    }

    private function calculateEffectiveInterestRate(Loan $loan)
        {
            $schedule = $loan->amortizationSchedule()->orderBy('month')->get();

            $cashFlows = [];
            $cashFlows[] = -1 * $loan->loan_amount; 

            foreach ($schedule as $payment) {
                $cashFlows[] = $payment->monthly_payment;
            }

            try {
                $monthlyIRR = Finance::irr($cashFlows);
                $effectiveAnnualRate = pow(1 + $monthlyIRR, 12) - 1;

                return round($effectiveAnnualRate * 100, 2); // in %
            } catch (\Exception $e) {
                return null;
            }
        }
}