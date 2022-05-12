@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $offer->service_name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pavadinimas</label>
                                <input type="text" class="form-control" value="{{ $offer->service_name }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Aprašymas</label>
                                <textarea class="form-control" rows="5" disabled>{{ $offer->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kaina</label>
                                <input type="text" class="form-control" value="{{ $offer->price }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Sukūrimo data</label>
                                <input type="text" class="form-control" value="{{ $offer->created_at }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Atnaujinimo data</label>
                                <input type="text" class="form-control" value="{{ $offer->updated_at }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Darbuotojas</label>
                                <input type="text" class="form-control" value="{{ $offer->freelancer->name }} {{ $offer->freelancer->lastName }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h3>Darbų pavyzdžiai</h3>
                            <hr/>
                            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @php $i = 0; @endphp
                                    @foreach($offer->files as $file)
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $i }}" @if($i === 0) class="active" @endif aria-current="true" aria-label="Slide 1"></button>
                                    @php $i++; @endphp
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach($offer->files as $file)
                                    <div class="carousel-item">
                                        <img src="{{ $file->file_path }}" class="d-block mx-auto" alt="{{ $file->name }}">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>{{ $file->name }}</h5>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h3>Atsiliepimai</h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>El. paštas</th>
                                    <th>Atsiliepimas</th>
                                    <th>Įvertinimas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($offer->reviews as $review)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <th>{{ $review->author->email }}</th>
                                    <th>{{ $review->text }}</th>
                                    <th>{{ $review->rating }}</th>
                                </tr>
                                @php $i++; @endphp
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                    @auth()
                        <hr>
                        <h3>Rašyti atsiliepimą</h3>
                        <hr>
                        <form action="{{ route('offers.review', $offer->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="review">Atsiliepimas</label>
                                <textarea id="review" class="form-control" name="text" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="rating">Įvertinimas</label>
                                <input type="number" id="rating" class="form-control" name="rating" min="1" max="5">
                            </div>
                            <button type="submit" class="btn btn-primary">Rašyti</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
