@extends('layouts.layout')

@section('content')
    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                        <div class="page_title_left d-flex align-items-center">
                            <h3 class="f_s_25 f_w_700 dark_text mr_30">Konfliktai</h3>
                            <ol class="breadcrumb page_bradcam mb-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Pagrindinis</a></li>
                            </ol>
                        </div>
                        <div class="page_title_right">
                            <div class="page_date_button d-flex align-items-center">
                                <img src="img/icon/calender_icon.svg" alt="">
                                {{ date('Y-m-d') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('conflict.post.information.form', $conflict->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30 pt-4">
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h3>Skundas Nr. {{$conflict->id}} </h3>
                                    <div class="row">
                                        <div class="col-lg-12 margin-tb">
                                            <div class="pull-right">
                                                <button class="btn_1"> Išsaugoti </button>
                                                <a class="addPadding" href="{{route('show.history', $conflict->id)}}"><i class="fa-solid fa-clock-rotate-left fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="QA_table mb_30">
                                    <div class="pull-left">
                                        <h4>
                                            <div class="row mb-3">
                                                <label for="cause" class="col-md-4 col-form-label text-md-end">{{ __('Statusas') }}</label>
                                                <div class="col-md-6">
                                                    <select disabled name="cause" id="cause" class="form-control">
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
                                        </h4>
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
                                                <strong>Paaiškinimas:</strong>
                                                {{ $conflict->explanation }}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <strong>Failai</strong>
                                            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach($conflict->files as $file)
                                                        <div class="carousel-item">
                                                            <a href="{{ route('comments.show', $file->id) }}" >
                                                                <img  src="{{ asset($file->file_path) }}" class="d-block w-100" alt="file">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="explanation" class="col-md-4 col-form-label text-md-end">{{ __('Paaiškinimas') }}</label>

                                            <div class="col-md-6">
                                                <input id="explanation" type="text" class="form-control @error('explanation') is-invalid @enderror" name="explanation" value="{{ old('explanation') }}" required autocomplete="explanation">

                                                @error('explanation')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-form-label text-md-end">
                                                <label for="file">Failai</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" name="file[]" class="form-control" placeholder="file" multiple accept=".jpg,.png,.pdf,.jpeg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection

@section('style')
    <style>
        .carousel {
            min-width: 100%;
            min-height: 100%;
        }
        .carousel-item img {
            min-width: 100%;
            min-height: 100%;
        }
    </style>
@endsection



@section('js')
    <script>
        // $('.carousel').carousel()
        $('.carousel-item').first().addClass('active');
    </script>
@endsection
