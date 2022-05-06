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
                        <input type="date" name="start" id="start" class="form-control" value="{{request('start')}}">
                    </div>
                    <div class="mb-3">
                        <label for="end">End</label>
                        <input type="date" name="end" id="end" class="form-control" value="{{request('end')}}">
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
                        <th>Date</th>
                        <th>Reff No</th>
                        <th>Account Number</th>
                        <th>Description</th>
                        <th>Debit</th>
                        <th>Credit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$report->created_at}}</td>
                        <td>{{$report->reff_no}}</td>
                        <td>{{$report->account_number}}</td>
                        <td>{{$report->description}}</td>
                        <td class="text-end">{{ $report->debit ? number_format($report->debit) : 0}}</td>
                        <td class="text-end">{{ $report->credit ? number_format($report->credit) : 0}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endif

@endsection
