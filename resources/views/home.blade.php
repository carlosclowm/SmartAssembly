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
                @if(isset($Products))
                <div class="card mb-3 align-self-center" style="max-width: 540px;">
                    @foreach($Products as $Product)
                      <div class="row g-0">
                        <div class="col-md-4">
                          <img src="{{$Product['thumbnail']}}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title">{{$Product['title']}}</h5>
                            <p class="card-text">{{$Product['price']}}</p>
                            <a href="{{$Product['link']}}" class="btn btn-success">Buy</a>
                            <p class="card-text"><small class="text-muted">{{$Product['source']}}</small></p>
                          </div>
                        </div>
                      </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
