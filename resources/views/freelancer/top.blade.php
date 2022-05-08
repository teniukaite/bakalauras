@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Laisvai samdomi darbuotojai</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    #
                                </th>
                                <th>
                                    Vardas ir pavardė
                                </th>
                                <th>
                                    El. paštas
                                </th>
                                <th>
                                    Taškai
                                </th>
                            </thead>
                            <tbody>
                                @foreach($freelancers as $freelancer)
                                    <tr>
                                        <td>{{ $freelancer->id }}</td>
                                        <td>{{ $freelancer->name }} {{ $freelancer->lastName }}</td>
                                        <td>{{ $freelancer->email }}</td>
                                        <td>{{ $freelancer->points }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $freelancers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
