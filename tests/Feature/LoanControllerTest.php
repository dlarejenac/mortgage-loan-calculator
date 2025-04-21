<?php
namespace Tests\Feature;

use App\Models\Loan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoanControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_loan_amount_is_positive()
    {
        $response = $this->post('/loan', [
            'loan_amount' => -100000,
            'annual_interest_rate' => 5,
            'loan_term_years' => 30,
            'extra_payment' => 0
        ]);

        $response->assertSessionHasErrors('loan_amount');
    }

    /** @test */
    public function it_validates_interest_rate_is_positive()
    {
        $response = $this->post('/loan', [
            'loan_amount' => 200000,
            'annual_interest_rate' => -5,
            'loan_term_years' => 30,
            'extra_payment' => 0
        ]);

        $response->assertSessionHasErrors('annual_interest_rate');
    }

    /** @test */
    public function it_validates_loan_term_is_positive()
    {
        $response = $this->post('/loan', [
            'loan_amount' => 200000,
            'annual_interest_rate' => 5,
            'loan_term_years' => -30,
            'extra_payment' => 0
        ]);

        $response->assertSessionHasErrors('loan_term_years');
    }
}