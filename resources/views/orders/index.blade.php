@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Užsakymai</h4>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pavadinimas</th>
                                    <th>Užsakymo data</th>
                                    <th>Kaina</th>
                                    <th>Atlieka</th>
                                    <th>Veiksmai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->service->service_name }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->price }} {{ $order->service->price_content }}</td>
                                        <td>{{ $order->freelancer->name }} {{ $order->freelancer->lastName }}</td>
                                        <td><a href="{{ route('offers.show', $order->service_id) }}">Peržiūrėti pasiūlymą</a> | <a href="#" onclick="deleteData({{$order->id}})">Ištrinti</a> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if (auth()->user()->type == 1)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Mano paslaugų užsakymai</h4>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pavadinimas</th>
                                    <th>Užsakymo data</th>
                                    <th>Kaina</th>
                                    <th>Klientas</th>
                                    <th>Veiksmai</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($services as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->service->service_name }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->price }} {{ $order->service->price_content }}</td>
                                        <td>{{ $order->client->name }} {{ $order->client->lastName }}</td>
                                        <td><a href="{{ route('offers.show', $order->service_id) }}">Peržiūrėti pasiūlymą</a> | <a href="#" onclick="deleteData({{$order->id}})">Ištrinti</a> </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        function deleteData(id) {
            $.ajax({
                url: '/orders/' + id,
                type: 'DELETE',
                data: {
                    '_token': '{{ csrf_token() }}',
                }
            }).done(function (data) {
                location.reload();
            });
        }
    </script>
@endsection
