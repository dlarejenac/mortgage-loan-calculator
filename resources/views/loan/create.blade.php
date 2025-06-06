@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Mortgage Loan Calculator</h1>
    <form method="POST" action="{{ route('loan.store') }}">
        @csrf
        <div class="mb-4">
            <label>Loan Amount</label>
            @error('loan_amount')
                <div class="text-yellow-500 text-sm">{{ $message }}</div>
            @enderror
            <input type="number" step="0.01" name="loan_amount" class="w-full border p-2" required>
        </div>
        <div class="mb-4">
            <label>Annual Interest Rate (%)</label>
            @error('annual_interest_rate')
                <div class="text-yellow-500 text-sm">{{ $message }}</div>
            @enderror
            <input type="number" step="0.01" name="annual_interest_rate" class="w-full border p-2" required>
        </div>
        <div class="mb-4">
            <label>Loan Term (Years)</label>
            @error('loan_term_years')
                <div class="text-yellow-500 text-sm">{{ $message }}</div>
            @enderror
            <input type="number" name="loan_term_years" class="w-full border p-2" required>
        </div>
        <div class="mb-4">
            <label>Extra Monthly Payment (optional)</label>
            @error('extra_payment')
                <div class="text-yellow-500 text-sm">{{ $message }}</div>
            @enderror
            <input type="number" step="0.01" name="extra_payment" class="w-full border p-2">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Calculate</button>
    </form>
</div>
@endsection