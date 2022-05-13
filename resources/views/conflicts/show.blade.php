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
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Statusas:</strong>
                {{ \App\Http\Service\ConflictsService::getStatus( $conflict->status) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Priežastis:</strong>
                {{ \App\Http\Service\ConflictsService::getCause( $conflict->cause) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Užsakymas:</strong>
                {{ $conflict->conflictOrders->service->service_name }} ({{$conflict->conflictOrders->service->freelancer->email}})
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Paaiškinimas:</strong>
                {{ $conflict->explanation }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <strong>Failai</strong>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            @foreach($conflict->files as $file)
                                @if(substr($file->name, -3) == 'pdf')
                                    <a href="{{ env('APP_URL').'/'.$file->file_path}}">{{$file->name}}</a>
                                @endif
                                    <a class="btn btn-info" href="{{ route('comments.show', $file->id) }}">Peržiūrėti komentarus</a>
                            @endforeach
                            <div id="carouselExampleControls" class="carousel slide " data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($conflict->files as $file)
                                        @if(substr($file->name, -3) !== 'pdf')

                                        <div class="carousel-item">
                                          <a href="{{route('comments.show', $file->id)}}">
                                              <img  src="{{ asset($file->file_path) }}" class="d-block w-100" alt="file">
                                          </a>
                                        </div>
                                        @endif
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
