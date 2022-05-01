@extends('layout.app')

@section('title', 'Transaction')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaction /</span> List Transaction</h4>

<div class="card">
    <div class="card-body">
        @if ($message = Session::get('message'))
        <div class="alert alert-success mt-4">
            <strong>Success</strong>
            <p>{{$message}}</p>
        </div>
        @endif
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Reff No</th>
                        <th>Total Debit</th>
                        <th>Total Credit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($transactions as $index => $transaction)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ strftime( "%A, %d %B %Y %H:%M", strtotime($transaction->created_at))}}</td>
                        <td>{{$transaction->user->name}}</td>
                        <td>{{$transaction->reff_no}}</td>
                        <td>{{number_format($transaction->total_debit)}}</td>
                        <td>{{number_format($transaction->total_credit)}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('transactions.edit', $transaction->id) }}"><i
                                    class="bx bx-edit-alt me-1"></i>
                                Edit
                            </a>
                            <button class="btn btn-danger delete-button" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-id={{$transaction->id}}>
                                <i class="bx bx-trash me-1"></i>
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Deleted data cannot be recovered.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" class="d-inline form-delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    const delete_button = document.querySelectorAll('.delete-button');
    delete_button.forEach(element => {
        element.addEventListener('click', function(){
            const id_transaction = this.getAttribute('data-id')
            const form_delete = document.querySelector('.form-delete');
            form_delete.action = `/transactions/${id_transaction}`
        })
    });
</script>
@endpush
@endsection
