@if (Auth::user()->activated === 1)
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
        <h1 style="display: grid; padding-top: 50px; text-align: center; font-size: x-large; font-style: oblique;">Pana Pawła aplikacja coming soon</h1>
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