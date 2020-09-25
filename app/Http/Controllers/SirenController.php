<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Group;
use App\Models\Status;
use App\Models\Transaction;
use App\Models\TransactionType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SirenController extends Controller
{
    public function index()
    {
        $today = new Carbon('2020-09-17');
        $t = new Transaction();
        $id = 1;
        $transactions = $t->filterTransactionsForTimeFrame($id, $today->copy()->startOfMonth(), $today->copy()->endOfMonth());
        $dates = $transactions->pluck('date');
        $lastDate = $dates->max();
        $dates = $dates->map(function ($value) {
                return explode(" ", $value)[0];
            })
            ->unique()
            ->sort();

        $open = $transactions->filter(function ($t) {
            return $t->status->name === 'open';
        });
        $closed = $transactions->filter(function ($t) {
            return $t->status->name === 'closed';
        });
        $pending = $transactions->filter(function ($t) {
            return $t->status->name === 'pending';
        });
        return view('siren.welcome')->with([
            'transactions' => $transactions,
            'date' => $today->format('Y-m-d'),
            'pending' => $pending,
            'open' => $open,
            'closed' => $closed,
            'dates' => $dates,
            'lastDate' => $lastDate,
            ]);
    }

    public function close(int $id) {
        $transaction = Transaction::find($id);
        $status = Status::where('name', 'closed')->first();

        $transaction->status_id = $status->id;

        $transaction->save();
        return redirect('/main');
    }

    public function update(int $id, Request $request)
    {
        if ($request->method() === 'POST') {
            return $this->save($request);
        }
        $transaction = Transaction::find($id);

        $actions = Action::all();
        $groups = Group::all();
        $statuses = Status::all();
        $types = TransactionType::all();

        return view('siren.create-update', compact('actions', 'groups', 'statuses', 'types', 'transaction'));
    }

    public function save(Request $request)
    {
        $params = $request->request->all();
        unset($params['_token']);
        $id = $request->get('id') ?? null;
        if($id !== null) {
            $transaction = Transaction::find($id);
            if (isset($params['discuss'])) {
                $params['comment'] .= PHP_EOL . $transaction->comment;
                unset($params['discuss']);
            }

            $transaction->update($params);
        } else {
            $params['date'] = (new Carbon('now'))->format('Y-m-d');
            $transaction = new Transaction($params);
            $transaction->save();
        }

        return redirect('/main');
    }

    public function create()
    {
        $actions = Action::all();
        $groups = Group::all();
        $statuses = Status::all();
        $types = TransactionType::all();

        return view('siren.create-update', compact('actions', 'groups', 'statuses', 'types'));
    }

    public function delete(int $id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();
        return redirect('/main');
    }

    public function data()
    {
        $today = new Carbon('2020-09-17');
        $t = new Transaction();
        $id = 1;
        $transactions = $t->filterTransactionsForTimeFrame($id, $today->copy()->startOfMonth(), $today->copy()->endOfMonth());
        $dates = $transactions->pluck('date');
        $lastDate = $dates->max();
        $dates = $dates->map(function ($value) {
            return explode(" ", $value)[0];
        })
            ->unique()
            ->sort();
        $transactions->map(function ($value) {
            $value->user->name = ucfirst($value->user->name);
            return $value;
        });
        $open = $transactions->filter(function ($t) {
            return $t->status->name === 'open';
        });
        $closed = $transactions->filter(function ($t) {
            return $t->status->name === 'closed';
        });
        $pending = $transactions->filter(function ($t) {
            return $t->status->name === 'pending';
        });
        return [
            'data' => $transactions->toArray()
        ];
    }
}
