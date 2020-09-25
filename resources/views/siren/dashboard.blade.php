@if (Auth::user()->activated === 1)
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
        <body class="antialiased">
    @foreach($transactions as $t)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ul class="list-disc">
                    <li>Date {{ $t->date }}</li>
                    <li>Underlying {{ $t->underlying }}</li>
                    <li>Strike {{ $t->strike }}</li>
                    <li>Transaction type {{ $t->transactionType->name }}</li>
                    <li>Net cash {{ $t->cash }}</li>
                    <li>Commission {{ $t->commission }}</li>
                    <li>Size {{ $t->size }}</li>
                    <li>Parent {{ $t->parent }}</li>
                    <li>Action {{ $t->action->name }}</li>
                    @foreach($t->groups as $g)
                        <p> {{ $g->name }}</p>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
        </body>

    </x-app-layout>

@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">

                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <p>Please wait until your account is activated</p>
                </div>
            </div>
        </div>
        <div>

        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                </div>
            </div>
        </div>
    </x-app-layout>
@endif