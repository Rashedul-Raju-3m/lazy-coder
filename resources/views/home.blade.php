@extends('layouts.app')

@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts.message')

            <div class="card">
                <div class="card-header">{{ __('messages.dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('messages.You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
