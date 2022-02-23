@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Pateikti skundą</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-primary" href="{{ route('conflicts.index') }}"> Atgal</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('conflicts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <label for="cause" class="col-md-4 col-form-label text-md-end">{{ __('Prežastis') }}</label>
            <div class="col-md-6">
                <select name="cause" id="cause" class="form-control">
                    <option value="0">Pasirinkite skundo priežastį: </option>
                    <option value="1">Nekokybiškas darbas</option>
                    <option value="2">Nesumokėti pinigai</option>
                    <option value="3">Neatliktas darbas</option>
                    <option value="4">Neadekvatus bendravimas</option>
                    <option value="5">Vagystė</option>
                    <option value="6">Kita</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="defendant_id" class="col-md-4 col-form-label text-md-end">{{ __('Kaltinamasis') }}</label>
            <div class="col-md-6">
                <select name="defendant_id" id="defendant_id" class="form-control">
                    <option value="0">Pasirinkite kaltinajį asmenį: </option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name }} {{ $user->lastName }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="explanation" class="col-md-4 col-form-label text-md-end">{{ __('Paaiškinimas') }}</label>

            <div class="col-md-6">
                <input id="explanation" type="text" class="form-control @error('explanation') is-invalid @enderror" name="explanation" value="{{ old('explanation') }}" required autocomplete="explanation">

                @error('explanation')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-form-label text-md-end">
                <label for="file">Failai</label>
            </div>
            <div class="col-md-6">
                <input type="file" name="file[]" class="form-control" placeholder="file" multiple accept=".jpg,.png,.pdf,.jpeg">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
@endsection

