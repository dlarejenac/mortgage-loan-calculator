@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-4">Amortization Schedule</h2>

    <div class="bg-gray-100 p-4 rounded mb-6">
        <p><strong>Loan Amount:</strong> ${{ number_format($loan->loan_amount, 2) }}</p>
        <p><strong>Annual Interest Rate:</strong> {{ $loan->annual_interest_rate }}%</p>
        <p><strong>Loan Term:</strong> {{ $loan->loan_term }} years</p>
        <p><strong>Extra Monthly Payment:</strong> ${{ number_format($loan->extra_payment, 2) }}</p>
        <p><strong>Effective Interest Rate:</strong>
            {{ $effectiveRate !== null ? $effectiveRate . '%' : 'N/A' }}
        </p>
    </div>

    <table class="w-full text-sm text-left border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Month</th>
                <th class="p-2">Starting Balance</th>
                <th class="p-2">Monthly Payment</th>
                <th class="p-2">Principal</th>
                <th class="p-2">Interest</th>
                <th class="p-2">Ending Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedule as $row)
            <tr>
                <td class="p-2">{{ $row->month }}</td>
                <td class="p-2">${{ number_format($row->starting_balance, 2) }}</td>
                <td class="p-2">${{ number_format($row->monthly_payment, 2) }}</td>
                <td class="p-2">${{ number_format($row->principal_component, 2) }}</td>
                <td class="p-2">${{ number_format($row->interest_component, 2) }}</td>
                <td class="p-2">${{ number_format($row->ending_balance, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection