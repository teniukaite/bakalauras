@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Failo komentarai</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-dark" href="{{ url()->previous() }}"> Atgal</a>
            </div>
            <div class="pull-left">
                <a class="btn btn-outline-dark" href="{{ route('comments.create', $file->id) }}"> Pakomentuoti failą</a>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="cause" class="col-md-4 col-form-label text-md-end">{{ __('Failas') }}</label>
        <div class="col-md-6">
            <img  src="{{ asset($file->file_path) }}" class="d-block w-100" alt="file">
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Komentaras</th>
            <th>Asmuo</th>
            <th>Sukurimo data</th>
            <th width="280px"></th>
        </tr>
        @foreach ($comments as $item)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $item->comment }}</td>
                <td>{{ $item->user->email }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
    </table>

    {!! $comments->links() !!}


@endsection
