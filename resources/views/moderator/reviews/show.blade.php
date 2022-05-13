@extends('theme')

@section('content')
    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                        <div class="page_title_left d-flex align-items-center">
                            <h3 class="f_s_25 f_w_700 dark_text mr_30">Atsiliepimai</h3>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30 pt-4">
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h3>Atsiliepimas nr.  {{$review->id}} </h3>
                                    <div class="row">
                                        <div class="col-lg-12 margin-tb">
                                            <div class="pull-right">
                                                <form action="{{ route('reviews.destroy',$review->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn_1">Ištrinti</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="QA_table mb_30">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Autorius:</strong>
                                                <td>{{ $review->author->name }} {{ $review->author->lastName }}</td>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Atsiliepimas:</strong>
                                                {{ $review->text }}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Įvertinimas:</strong>
                                                {{ $review->rating }}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Paslaugos pasiūlymas:</strong>
                                               {{$review->offersReview->service_name}}
                                            </div>
                                            <div data-aos="fade-right" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center py-4 mt-5">
                                                <h4 class="my-4">{{ $review->offersReview->service_name }}</h4>
                                                <div class="row justify-content-center">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div id="carouselExampleControls-<?=$review->offersReview->id;?>" class="carousel slide" data-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @foreach($review->offersReview->files as $file)
                                                                        <div class="carousel-item">
                                                                            <img class="d-block w-100" src="{{ asset($file->file_path) }}" alt="file">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls-<?=$review->offersReview->id;?>" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls-<?=$review->offersReview->id;?>" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="font-weight-bold">€ <span class="display-2 font-weight-bold">{{ $review->offersReview->price }}</span> {{ $review->offersReview->price_content }}</p>
                                                <ul class="list-unstyled">
                                                    <li><i class="fa-solid fa-map-location-dot"></i> {{ $review->offersReview->cities->name }}</li>
                                                    <li><i class="fa-solid fa-clock"></i> {{ $review->offersReview->duration }}</li>
                                                    <li><i class="fa-solid fa-user"></i> {{$review->offersReview->freelancer->name}} {{$review->offersReview->freelancer->lastName}}</li>
                                                </ul>
                                                <a href="{{route('offers.show', $review->offersReview->id)}}" class="btn my-4 font-weight-bold atlas-cta cta-ghost">Peržiūrėti</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('js')
    <script>
        $('.carousel-inner > .carousel-item:first-child').addClass('active');
    </script>
@endsection
