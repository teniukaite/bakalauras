@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Laisvai samdomi darbuotojai</h4>
                </div>
                <div class="card-body">

                        <div class="row">
                            @foreach($freelancers as $freelancer)
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ $freelancer->photo ?? 'https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640' }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $freelancer->name }} {{ $freelancer->lastName }}</h5>
                                        <p class="card-text">Pasiūlymų: {{ $freelancer->offers_count }}</p>
                                        <button class="btn btn-primary" onclick="window.location.href='{{ route('freelancers.offers', $freelancer->id) }}'">Peržiūrėti</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    {{ $freelancers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
