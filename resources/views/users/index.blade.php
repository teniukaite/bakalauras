@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example from scratch - ItSolutionStuff.com</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Pridėti naują naudotoją</a>
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
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>El. paštas</th>
            <th width="280px"></th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->lastName }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Peržiūrėti</a>

                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Redaguoti</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Ištrinti</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $users->links() !!}

@endsection
