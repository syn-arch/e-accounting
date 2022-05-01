<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        return view('transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Account::all();
        return view('transaction.create', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $total_debit = 0;
            $total_credit = 0;

            for ($i = 0; $i < count($request->id_account); $i++) {
                if ($request->id_account[$i] != null) {
                    $total_debit += str_replace('.', '', $request->debit[$i]) == '' ? 0 : str_replace('.', '', $request->debit[$i]);
                    $total_credit += str_replace('.', '', $request->credit[$i]) == '' ? 0 : str_replace('.', '', $request->credit[$i]);
                }
            }

            $transaction = Transaction::create([
                'reff_no' => $request->reff_no,
                'id_user' => auth()->user()->id,
                'total_debit' => $total_debit,
                'total_credit' => $total_credit,
            ]);

            for ($i = 0; $i < count($request->id_account); $i++) {
                if ($request->id_account[$i] != null) {
                    TransactionDetail::create([
                        'id_transaction' => $transaction->id,
                        'id_account' => $request->id_account[$i],
                        'description' => $request->description[$i],
                        'debit' => $request->debit[$i],
                        'credit' => $request->credit[$i],
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect('/transactions')->with('message', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $accounts = Account::all();
        return view('transaction.edit', compact('transaction', 'accounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {

        DB::beginTransaction();

        try {
            $transaction->delete();
            $transaction->transaction_details()->delete();

            $total_debit = 0;
            $total_credit = 0;

            for ($i = 0; $i < count($request->id_account); $i++) {
                if ($request->id_account[$i] != null) {
                    $total_debit += str_replace('.', '', $request->debit[$i]) == '' ? 0 : str_replace('.', '', $request->debit[$i]);
                    $total_credit += str_replace('.', '', $request->credit[$i]) == '' ? 0 : str_replace('.', '', $request->credit[$i]);
                }
            }

            $transaction = Transaction::create([
                'reff_no' => $request->reff_no,
                'id_user' => auth()->user()->id,
                'total_debit' => $total_debit,
                'total_credit' => $total_credit,
            ]);

            for ($i = 0; $i < count($request->id_account); $i++) {
                if ($request->id_account[$i] != null) {
                    TransactionDetail::create([
                        'id_transaction' => $transaction->id,
                        'id_account' => $request->id_account[$i],
                        'description' => $request->description[$i],
                        'debit' => $request->debit[$i],
                        'credit' => $request->credit[$i],
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect('/transactions')->with('message', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        $transaction->transaction_details()->delete();

        return redirect('/transactions')->with('message', 'Data deleted successfully');
    }
}
