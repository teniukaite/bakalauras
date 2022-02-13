@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Konfliktai</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-dark" href="{{ route('conflicts.create') }}"> Pateikti skundą</a>
            </div>
        </div>
    </div>

@endsection
