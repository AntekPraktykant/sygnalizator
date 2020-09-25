<?php

namespace App\Http\Controllers;

use App\Mail\Welcome;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function index()
    {
//        dd('test');
        $u = new User(['email' => 'pawel.tomala@gmail.com']);
        Mail::to($u)->send(new Welcome());
//        dd($u);
//        User::where('id', 8)->get()
//return 'cool bro';
//        $t = Transaction::first();
        $today = new Carbon('2020-09-17');
        $t = new Transaction();
        $id = 1;
        $transactions = $t->filterTransactionsForTimeFrame($id, $today->copy()->startOfMonth(), $today->copy()->endOfMonth());
        $dates = $transactions->pluck('date');
        $lastDate = $dates->max();
        return view ('siren.partials.list', compact('lastDate'));
        $u = auth()->id();

        $t = Transaction::with(['groups', 'action', 'transactionType'])->where('id', 2)->first();
//        dd($t);

        $newT = new Transaction(['action_id' => 1,
            'cash' => 100,
            'group_id' => 0,
            'underlying' => 'CVS',
            'date' => new Carbon('now'),
            'size' => 1,
            'strike' => 59,
            'transaction_type_id' => 1,
        ]);
//        dd($newT->filterTransactionsForDay($u, new Carbon('yesterday')));
        dd($newT->filterTransactionsForTimeFrame($u, (new Carbon('yesterday'))->startOfDay(), new Carbon('now', 'GMT+2')), new Carbon('yesterday')) ;


        dd($t->user);
        $t->user()->associate($u);
//        $u->transactions()->saveMany($newT);
//        $newT->save();
//        $newT->groups()->attach([0]);
//        $t->groups()->detach(3);
        foreach ($t->groups as $group) {
            echo $group->name. PHP_EOL;
        }
    }
    public function data()
    {
        return [
            'data' => [
                [
                    'first_name' => 'jo',
                    'last_name' => 'oj'
                ],
                [
                    'first_name' => 'aj',
                    'last_name' => 'wa'
                ]
            ]
        ];
    }
}
