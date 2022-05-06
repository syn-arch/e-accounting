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
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Month</th>
                        <th>Category</th>
                        <th>Income</th>
                        <th>Expense</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$report->month}}</td>
                        <td>{{$report->category}}</td>
                        <td class="text-end">{{ $report->income ? number_format($report->income) : 0}}</td>
                        <td class="text-end">{{ $report->expense ? number_format($report->expense) : 0}}</td>
                    </tr>
                    @endforeach
                </tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end">{{ $total_income ? number_format($total_income) : 0}}</td>
                        <td class="text-end">{{ $total_expense ? number_format($total_expense) : 0}}</td>
                    </tr>
                     <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end">Net Income</td>
                        <td class="text-end">{{ number_format($total_income - $total_expense)}}</td>
                    </tr>
            </table>
        </div>
    </div>
</div>
@endif

@endsection
