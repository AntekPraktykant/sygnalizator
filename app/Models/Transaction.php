<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function action(): Relation
    {
        return $this->hasOne(Action::class, 'id', 'action_id');
    }

    public function groups(): Relation
    {
        return $this->belongsToMany(Group::class, 'group_transaction', 'transaction_id');
    }

    public function transactionType(): Relation
    {
        return $this->hasOne(TransactionType::class, 'id', 'transaction_type_id');
    }

    public function status(): Relation
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getAllTransactionsForUser(int $userId): Collection
    {
        return $this->with(['groups', 'action', 'transactionType', 'status', 'user'])
            ->where('user_id', $userId)
            ->get();
    }

    public function filterTransactionsForDay(int $userId, Carbon $day): Collection
    {
        return $this->getAllTransactionsForUser($userId)->filter(function ($value) use ($day) {
            return $value->date < $day->copy()->endOfDay()
                && $value->date > $day->copy()->startOfDay();
        });
    }

    public function filterTransactionsForTimeFrame(int $userId, Carbon $beginning, Carbon $end): Collection
    {
        return $this->getAllTransactionsForUser($userId)->filter(function ($value) use ($beginning, $end) {
            return $value->date >= $beginning && $value->date <= $end;
        });
    }

//    public function note()
//    {
//        return $this->hasOne(Note::class, 'note_id', 'id');
//    }
}
