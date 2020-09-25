<div class="ml-12">
    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
        @foreach($transactions as $t)
            <div class="shadow md:border-t-0">
                <ol class="font-semibold" style="list-style: none">
                    <li> {{ $t->underlying }} {{ "@" . $t->strike }}</li>
                    <li> {{ strtoupper($t->transactionType->name) }}</li>
                    <li class="{{ $t->cash > 0 ? "positive" : "negative"}}">Net cash
                        {{ $t->cash > 0 ? "+" : "-" }}
                        {{ abs($t->cash) . "$"}}
                    </li>
                    @if ($t->commission)
                        <li>Commission {{ $t->commission }}</li>
                    @endif
                    <li>Size {{ $t->size }}</li>
                    @if($t->parent)
                        <li>Parent {{ $t->parent }}</li>
                    @endif
                    <li>Action {{ $t->action->name }}</li>
                    @if (! $t->groups->isEmpty())
                        <li> Group
                            <ul>
                                @foreach($t->groups as $g)
                                    <li>{{ $g->name }}</li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    @if(auth()->id() === 1 && $t->status->name !== 'closed')
                        <li class="buttons">
                            <form><button class="btn btn-dark">Close</button></form>
                            <form><button class="btn btn-secondary">Modify</button></form>
                            <form><button class="btn btn-success">Roll</button></form>
                        </li>
                    @endif
                </ol>
            </div>
        @endforeach
    </div>
</div>