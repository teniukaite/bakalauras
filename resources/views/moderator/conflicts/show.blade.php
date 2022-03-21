@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Skundas {{$conflict->identification}}</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('conflicts.index') }}"> Atgal </a>
            </div>
            <div class="pull-right">
                <a href="{{route('show.history', $conflict->id)}}"><i class="fa-solid fa-clock-rotate-left fa-2x"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="pull-left">
                <h3>
                    Statusas: {{ $conflict->status }}
                    <div class="row mb-3">
                        <label for="cause" class="col-md-4 col-form-label text-md-end">{{ __('Statusas') }}</label>
                        <div class="col-md-6">
                            <select name="cause" id="cause" class="form-control">
                                <option @if ($conflict->status == 0) selected @endif value="0">Pateiktas </option>
                                <option @if ($conflict->status == 1) selected @endif value="1">Peržiūrėtas</option>
                                <option @if ($conflict->status == 2) selected @endif value="2">Laukiama informacijos</option>
                                <option @if ($conflict->status == 3) selected @endif value="3">Priimamas sprendimas</option>
                                <option @if ($conflict->status == 4) selected @endif value="4">Išspręstas</option>
                                <option @if ($conflict->status == 5) selected @endif value="5">Atšauktas</option>
                                <option @if ($conflict->status == 6) selected @endif value="6">Grąžintas</option>
                            </select>
                        </div>
                    </div>
                </h3>

            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Skunda pateike:</strong>
                {{ $conflict->plaintiff->name }} {{$conflict->plaintiff->lastName}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Priezastis:</strong>
                {{ \App\Http\Service\ConflictsService::getCause( $conflict->cause) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Uzsakymas:</strong>
                {{ $conflict->conflictOrders->service->service_name }} ({{$conflict->conflictOrders->service->freelancer->email}})
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Paaiskinimas:</strong>
                {{ $conflict->explanation }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <strong>Failai</strong>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div id="carouselExampleControls" class="carousel slide " data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($conflict->files as $file)
                                        <div class="carousel-item">
                                            <img  src="{{ asset($file->file_path) }}" class="d-block w-100" alt="file">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.carousel-item').first().addClass('active');
    </script>
@endsection
