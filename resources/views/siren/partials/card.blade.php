<div class="col-xl-3 col-lg-4 col-md-6 col-sm12" style="margin-bottom: 25px">
    <div class="card">
        {{--<img class="card-img-top" src="{{ asset('img/herald.jpg') }}" alt="Card image cap">--}}
        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
        <div class="card-header bg-transparent">

            <h5 class="card-title">{{ $t->underlying . " @ " . $t->strike . " " . strtoupper($t->transactionType->name) }}</h5>
            @if(auth()->id() === 1 && $t->status->name !== 'closed')
                <a href=" {{ route('closeTransaction', ['id' => $t->id]) }} " class="btn btn-dark">Close</a>
                <a href=" {{ route('updateTransaction', ['id' => $t->id]) }}" class="btn btn-secondary">Modify</a>
                <a href="#" class="btn btn-success">Roll</a>
                <form class="form-signin" action=" {{ route('deleteTransaction', ['id' => $t->id]) }} " method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn-danger">Remove</button>
                </form>
            @endif
        </div>
        <div class="card-body scroll">

            <div class="card-text">
                <ol class="font-semibold" style="list-style: none">
                    {{--<li> {{ $t->underlying }} {{ "@" . $t->strike }}</li>--}}
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
                    @if ($t->comment)
                        <p style="font-style: italic; margin: 5px"> "{{ $t->comment }}" </p>
                    @endif
                </ol>
            </div>
            {{--<a href="#" class="btn btn-primary">Go somewhere</a>--}}
        </div>
    </div>
</div>