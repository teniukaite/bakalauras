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
            <th>Statusas</th>
            <th scope="col">Užsakymas</th>
            <th>Sukūrimo data</th>
            <th width="280px"></th>
        </tr>
        @foreach ($conflicts as $conflict)
            <tr>
                <td>{{ ++$i }}</td>
                <td> {{ \App\Http\Service\ConflictsService::getStatus( $conflict->status) }}</td>
                <td>{{ $conflict->conflictOrders->service->service_name }}</td>
                <td>{{substr($conflict->created_at, 0, 10)}}</td>
                <td>
                    <a class="btn btn-outline-info" href="{{ route('conflicts.show',$conflict->id) }}">Peržiūrėti</a>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $conflicts->links() !!}

@endsection
