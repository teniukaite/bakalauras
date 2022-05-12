@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Pakomentuoti failą</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-primary" href="{{ url()->previous() }}"> Atgal</a>
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

    <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <label for="cause" class="col-md-4 col-form-label text-md-end">{{ __('Failas') }}</label>
            <div class="col-md-6">
                <img  src="{{ asset($file->file_path) }}" class="d-block w-100" alt="file">
            </div>
        </div>

        <input id="file" type="hidden" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ $file->id}}" required autocomplete="file">

        <div class="row mb-3">
            <label for="comment" class="col-md-4 col-form-label text-md-end">{{ __('Paaiškinimas') }}</label>
            <div class="col-md-6">
                <input id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" required autocomplete="comment">

                @error('comment')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
@endsection

