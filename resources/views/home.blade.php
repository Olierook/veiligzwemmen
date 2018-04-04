@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Welkom</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form" method="post" action="{{ url('/link')}}">
                      {{csrf_field()}}
                      <div class="form-group text-center">
                        <label for="code">Voer uw code in</label>
                        <input name="code" type="text" class="form-control" placeholder="U ontvangt een code van de strandwacht" required>
                        {{$wrongCode}}
                        @if (isset($wrongCode))
                          <div class="text-danger">Foute code!</div>
                        @endif
                      </div>
                      <div class="form-group text-center">
                        <label for="name">Voer de naam van uw kind in</label>
                        <input name="name" type="text" class="form-control" placeholder="Deze wordt weergegeven op de kaart" required>
                      </div>
                      <div class="form-group text-center">
                        <label for="label">Voeg eventueel een afkorting toe voor uw kind</label>
                        <input name="label" type="text" class="form-control" placeholder="1 of 2 karakters">
                      </div>
                      <button class="btn btn-primary pull-right col-md-5" type="submit">Ga verder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
