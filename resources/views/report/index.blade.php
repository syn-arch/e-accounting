@extends('layout.app')

@section('title', 'Reports')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Reports /</span> List Reports</h4>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="">
                    <div class="mb-3">
                        <label for="start">Start</label>
                        <input type="month" name="start" id="start" class="form-control" value="{{request('start')}}">
                    </div>
                    <div class="mb-3">
                        <label for="end">End</label>
                        <input type="month" name="end" id="end" class="form-control" value="{{request('end')}}">
                    </div>
                    <div class="mb-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if (request()->has('start') && request()->has('end'))
<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th rowspan="2">
                            Catgory
                        </th>
                        @foreach ($period as $dt)
                            <th>{{$dt->format('Y-m')}} ({{$dt->format('F')}})</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($period as $dt)
                            <th>Amount</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        $balances = [];

                        foreach ($period as $dt ) {
                            $balances[] = [
                                'expense' => 0,
                                'income' => 0,
                            ];
                        }
                    @endphp

                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            @foreach ($period as $i => $dt)
                            @php
                                $expense = DB::table('transaction_details')
                                            ->select(DB::raw("sum(credit) as expense"))
                                            ->join('accounts', 'accounts.id', '=', 'transaction_details.id_account')
                                            ->join('categories', 'categories.id', '=', 'accounts.id_category')
                                            ->where('id_category', $category->id)
                                            ->whereBetween(DB::raw('MONTH(transaction_details.created_at)'), [$dt->format('m'), $dt->format('m')])
                                            ->whereBetween(DB::raw('YEAR(transaction_details.created_at)'), [$dt->format('Y'), $dt->format('Y')])
                                            ->first()->expense;

                                $balances[$i]['expense'] += $expense;

                                 $income = DB::table('transaction_details')
                                            ->select(DB::raw("sum(debit) as income"))
                                            ->join('accounts', 'accounts.id', '=', 'transaction_details.id_account')
                                            ->join('categories', 'categories.id', '=', 'accounts.id_category')
                                            ->where('id_category', $category->id)
                                            ->whereBetween(DB::raw('MONTH(transaction_details.created_at)'), [$dt->format('m'), $dt->format('m')])
                                            ->whereBetween(DB::raw('YEAR(transaction_details.created_at)'), [$dt->format('Y'), $dt->format('Y')])
                                            ->first()->income;

                                $balances[$i]['income'] += $income;

                                $amount = $income == 0 ? $expense : $income;
                            @endphp
                                <td>{{ number_format($amount) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-success">
                        <td>Total Income</td>
                        @foreach ($balances as $balance)
                            <td>{{ number_format($balance['income']) }}</td>
                        @endforeach
                    </tr>
                    <tr class="bg-warning">
                        <td>Total Expense</td>
                        @foreach ($balances as $balance)
                            <td>{{ number_format($balance['expense']) }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Net Income</td>
                        @foreach ($balances as $balance)
                        <td>{{ number_format($balance['income'] - $balance['expense']) }}</td>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endif

@endsection
