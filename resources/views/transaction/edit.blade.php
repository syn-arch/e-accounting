@extends('layout.app')

@section('title', 'Transactions')

@section('content')
<div class="card">
    <div class="card-header">
        <p class="text-muted">{{auth()->user()->name}} / {{date('Y-m-d H:i:s')}}</p>
    </div>
    <div class="card-body">
        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-2">
                    <strong>Reff No</strong>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="reff_no" placeholder="Reff No" autocomplete="off" required value="{{$transaction->reff_no}}">
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Account</th>
                                    <th>Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 1;
                                @endphp
                                @foreach ($transaction->transaction_details as $key => $transaction_detail)
                                @php
                                    $num++;
                                @endphp
                                    <tr data-filled="1">
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <select name="id_account[]" id="id_account" class="form-control select2">
                                                <option value="">Select Account</option>
                                                @foreach ($accounts as $account)
                                                <option {{$transaction_detail->id_account == $account->id ? 'selected' : ''}} value="{{ $account->id }}">{{ $account->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-right"><input type="text" class="form-control" autocomplete="off" placeholder="description" name="description[]" value="{{$transaction_detail->description}}"></td>
                                        <td class="text-right"><input type="text" class="form-control" autocomplete="off" placeholder="debit" name="debit[]" value="{{ $transaction_detail->debit ? number_format($transaction_detail->debit) : ''}}"></td>
                                        <td class="text-right"><input type="text" class="form-control" autocomplete="off" placeholder="credit" name="credit[]" value="{{ $transaction_detail->credit ? number_format($transaction_detail->credit) : ''}}"></td>
                                        <td class="text-center">
                                            <button class="btn btn-danger btn-sm remove-from-table">
                                                <i class="bx bx-trash me-1"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr data-filled="0">
                                    <td>{{$num}}</td>
                                    <td>
                                        <select name="id_account[]" id="id_account" class="form-control select2">
                                            <option value="">Select Account</option>
                                            @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-right"><input type="text" class="form-control" autocomplete="off" placeholder="description" name="description[]"></td>
                                    <td class="text-right"><input type="text" class="form-control" autocomplete="off" placeholder="debit" name="debit[]"></td>
                                    <td class="text-right"><input type="text" class="form-control" autocomplete="off" placeholder="credit" name="credit[]"></td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm remove-from-table">
                                            <i class="bx bx-trash me-1"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 offset-md-8 d-grid">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(function(){
            function formatRupiah(number){
                var number_string = number.toString().replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa  = split[0].length % 3,
                    rupiah  = split[0].substr(0, sisa),
                    ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return rupiah;
            }

            function addToTable(){
                const rowLength = $('table').find('tr').length
                const row = `
                    <tr data-filled="0">
                        <td>${rowLength}</td>
                        <td>
                            <select name="id_account[]" id="id_account" class="form-control select2">
                                <option value="">Select Account</option>
                                @foreach ($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-right"><input type="text" class="form-control" autocomplete="off" placeholder="description" name="description[]"></td>
                        <td class="text-right"><input type="text" class="form-control" autocomplete="off" placeholder="debit" name="debit[]"></td>
                        <td class="text-right"><input type="text" class="form-control" autocomplete="off" placeholder="credit" name="credit[]"></td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-sm remove-from-table">
                                <i class="bx bx-trash me-1"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('.table tbody').append(row);
                sumTotal();
            }

            function sumTotal(){
                const totalDebit = $('.table tbody tr').toArray().reduce((a, b) => {
                    const total = parseInt($(b).find('td:eq(3)').text().replace('.', ''));
                    return a + total;
                }, 0);

                $('input[name="total_debit"]').val(totalDebit);

                const totalCredit = $('.table tbody tr').toArray().reduce((a, b) => {
                    const total = parseInt($(b).find('td:eq(4)').text().replace('.', ''));
                    return a + total;
                }, 0);

                $('input[name="total_credit"]').val(totalCredit);
            }

            $(document).on('click', '.remove-from-table', function(e){
                e.preventDefault();
                $(this).closest('tr').remove();
                sumTotal();
            })

            $(document).on('change', 'select[name="id_account[]"]', function(){
                $(this).closest('tr').attr('data-filled', '1');
                if ($('tr[data-filled="0"]').length == 0) {
                    addToTable();
                }
            });

            $(document).on('keydown', ['input[name="debit[]"]','input[name="caredit[]"]'], function(e){
                if (e.keyCode === 13) {
                    e.preventDefault();
                }
            });

            $(document).on('keyup', 'input[name="debit[]"]', function(){
                $(this).val(formatRupiah($(this).val()));
            });

            $(document).on('keyup', 'input[name="credit[]"]', function(){
                $(this).val(formatRupiah($(this).val()));
            });
        })
    </script>
@endpush
