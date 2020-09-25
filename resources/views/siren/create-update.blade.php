@extends('layouts.main')
<link href=" {{ asset('css/create.css') }} " rel="stylesheet">
@section('body')
    <body class="text-center">
        <form class="form-signin" action=" {{ route('saveTransaction') }}" method="POST">
            @csrf
            <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">
                @if(isset($transaction))
                    {{ "Modify transaction number: " . $transaction->id }}
                @else
                    Create new transaction
                @endif
            </h1>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="action_id">Action</label>
                </div>
                <select class="custom-select" id="action" name="action_id">
                    @foreach($actions as $action)
                        <option value="{{ $action->id }}"
                            {{ (isset($transaction) && $action->id === $transaction->action->id) ? "selected" : ""}}>
                            {{ $action->name }}
                        </option>
                    @endforeach
                </select>

            </div>

            <label for="cash" class="sr-only">Net cash</label>
            <input type="number" step="0.01" id="cash" name="cash" class="form-control" placeholder="Net cash" required
             @if(isset($transaction))
                {{ "value=$transaction->cash" }}
             @endif
             >

            <label for="comment" class="sr-only">Comment</label>
            <textarea id="comment" name="comment" class="form-control" placeholder="Comment">@if(isset($transaction)){{ $transaction->comment }}@endif</textarea>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="group">Group</label>
                </div>
                <select class="custom-select" id="group" name="group_id">
                    <option value="0" selected>Choose...</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}"> {{ $group->name }}</option>
                    @endforeach
                </select>

            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="parent">Parent</label>
                </div>
                <select class="custom-select" id="parent" name="parent">
                    <option value="" selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>

            <label for="size" class="sr-only">Position size</label>
            <input type="number" step="0.01" id="size" name="size" class="form-control" placeholder="Position size" required
            @if(isset($transaction))
                {{ "value=$transaction->size" }}
            @endif
            >

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="status">Status</label>
                </div>
                <select class="custom-select" id="status" name="status_id">
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}"> {{ $status->name }}</option>
                    @endforeach
                </select>

            </div>

            <label for="strike" class="sr-only">Strike</label>
            <input type="number" step="0.01" id="strike" name="strike" class="form-control" placeholder="Strike" required
            @if(isset($transaction))
                {{ "value=$transaction->strike" }}
            @endif
            >

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="type">Type</label>
                </div>
                <select class="custom-select" id="type" name="transaction_type_id">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}"> {{ $type->name }}</option>
                    @endforeach
                </select>

            </div>

            <label for="underlying" class="sr-only">Underlying</label>
            <input type="text" id="underlying" name="underlying" class="form-control" placeholder="Underlying" required
            @if(isset($transaction))
                {{ "value=$transaction->underlying" }}
            @endif
            >

            <input type="hidden" id="user_id" name="user_id" class="form-control" value=" {{ auth()->id() }}">
            @if(isset($transaction))
                <input type="hidden" id="id" name="id" class="form-control" value=" {{ $transaction->id }}">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
            @else
                <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
            @endif

            <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
        </form>
    </body>
@endsection