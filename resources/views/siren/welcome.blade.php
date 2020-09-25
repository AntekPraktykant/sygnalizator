@extends('layouts.main')

@section('body')
    <body class="">
        <div class="jumbotron">
            <div class="container-fluid container-md">
                <div class="row">
            <form action="{{ route('createTransaction') }}" method="POST">
                @csrf
                {{--<select>--}}
                    {{--@foreach($dates as $date)--}}
                        {{--<option value="{{ $date }}">{{ $date }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
                @if(auth()->id() === 1)
                    <button class="btn btn-lg btn-primary" type="submit">Create</button>
                @endif

                Last update: {{ $lastDate }}
            </form>
            </div>
            </div>
            <h2>Open</h2>
            <div class="card-group">
                @foreach ($open as $t)
                     @include('siren.partials.card', ['t' => $t])
                 @endforeach
            </div>
        </div>
        <div class="jumbotron">
            <h3>Closed</h3>
            <div class="card-group">
                @foreach ($closed as $t)
                    @include('siren.partials.card', ['t' => $t])
                @endforeach
            </div>
        </div>
    </body>
@endsection
