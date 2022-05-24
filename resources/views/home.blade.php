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
                <!-- Modal para cuestionario -->
                <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Consult
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{route('formPC')}}">
                                @csrf
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="form-control">
                                <label class="form-check-label" for="titleCheap">
                            Do you need it to be cheap?
                              </label>
                              <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="cheap" id="inlineRadio1" value="true">
                              <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="cheap" id="inlineRadio2" value="false">
                              <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                            </div>
                            <div class="form-control">
                                <label class="form-check-label" for="titleGamer">
                            Do you need it to be for games?
                              </label>
                              <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="games" id="inlineRadio1" value="true">
                              <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="games" id="inlineRadio2" value="false">
                              <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                            </div>

                            <div class="form-control">
                                <label class="form-check-label" for="titleIntel">
                            Do you prefer intel?
                              </label>
                              <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="intel" id="inlineRadio1" value="true">
                              <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="intel" id="inlineRadio2" value="false">
                              <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                            </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Consult</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                <!-- fin modal -->
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
