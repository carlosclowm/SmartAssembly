@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form method="POST" action="{{route('test')}}">
                    <input type="text" name="input" class="form-control">
                    <button type="submit" class="btn btn-primary">Analize</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
