@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Skundo istorija</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-dark" href="{{ url()->previous() }}"> Atgal</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Veiksmas</th>
            <th>Asmuo</th>
            <th>Sukurimo data</th>
            <th width="280px"></th>
        </tr>
        @foreach ($history as $item)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $item->details }}</td>
                <td>{{ $item->user->email }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
    </table>

    {!! $history->links() !!}


@endsection
