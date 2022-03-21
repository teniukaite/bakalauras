@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Pasiūlymai</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('offers.create') }}"> Pridėti naują pasiūlymą</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Pavadinimas</th>
            <th>Aprasymas</th>
            <th>Kategorija</th>
            <th width="280px"></th>
        </tr>
        @foreach ($offers as $offer)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $offer->service_name }}</td>
                <td>{{ $offer->description }}</td>
                <td>{{ $offer->category->name }}</td>
                <td>
                    <form action="{{ route('offers.destroy', $offer->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('offers.show', $offer->id) }}">Peržiūrėti</a>

                        <a class="btn btn-primary" href="{{ route('offers.edit', $offer->id) }}">Redaguoti</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Ištrinti</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $offers->links() !!}

@endsection
