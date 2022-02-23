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

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Identificinis nr.</th>
            <th>Statusas</th>
            <th>Sukurimo data</th>
            <th width="280px"></th>
        </tr>
        @php
        $i = 0;
        @endphp
        @foreach ($conflicts as $conflict)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $conflict->identification }}</td>
                <td>{{ $conflict->status }}</td>
                <td>{{ $conflict->created_at }}</td>
                <td>
                    <form action="{{ route('conflicts.destroy',$conflict->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('moderator.show.conflict',$conflict->id) }}">Peržiūrėti</a>

                        <a class="btn btn-primary" href="{{ route('conflicts.edit',$conflict->id) }}">Redaguoti</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Ištrinti</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $conflicts->links() !!}

@endsection
