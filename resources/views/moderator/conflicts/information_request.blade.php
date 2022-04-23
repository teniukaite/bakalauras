@extends('theme')

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
            <div class="row">
                <form action="{{ route('moderator.send.conflict.information', $conflict->id) }}" method="POST">
                    @csrf
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30 pt-4">
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h3>Skundas Nr. {{$conflict->id}} </h3>
                                    <div class="row">
                                        <div class="col-lg-12 margin-tb">
                                            <div class="pull-right">
                                                <button type="submit" class="btn_1"> Išsaugoti </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="QA_table mb_30">
                                    <div class="pull-left">
                                        <h4>
                                            <div class="row mb-3">
                                                <label for="user" class="col-md-4 col-form-label text-md-end">{{ __('Pasirinkite, kuris asmuo turi pateikti informaciją') }}</label>
                                                <div class="col-md-6">
                                                    <select name="user" id="user" class="form-control">
                                                        <option value="{{$conflict->plaintiff->email}}"> {{ $conflict->plaintiff->name }} {{$conflict->plaintiff->lastName}} (ieškovas) </option>
                                                        <option value="{{$conflict->conflictOrders->service->freelancer->email}}">{{$conflict->conflictOrders->service->freelancer->name}} {{$conflict->conflictOrders->service->freelancer->lastName}} (atsakovas)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>
@endsection
