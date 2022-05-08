@extends('layouts.layout')

@section('content')
    <div class="row">
        @foreach($offers as $offer)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ $offer->files[0] ?? 'https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640' }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $offer->service_name }}</h5>
                    <p class="card-text"><strong>Kaina: {{ $offer->price }} {{ $offer->price_content }}<br/>Miestas: {{$offer->cities->name}}</strong></p>
                    <div class="d-flex justify-content-center"><a href="{{ route('offers.show', $offer->id) }}" class="btn btn-primary align-content-center">Peržiūrėti</a></div>
                </div>
            </div>
        </div>
        @endforeach

        {{ $offers->links() }}

    </div>
@endsection
