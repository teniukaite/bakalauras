@extends('theme')

@section('content')

    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                        <div class="page_title_left d-flex align-items-center">
                            <h3 class="f_s_25 f_w_700 dark_text mr_30">Naudotojai</h3>
                            <ol class="breadcrumb page_bradcam mb-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Pagrindinis</a></li>
                            </ol>
                        </div>
                        <div class="page_title_right">
                            <div class="page_date_button d-flex align-items-center">
                                <img src="{{asset('/img/icon/calender_icon.svg')}}" alt="">
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
                                    <h3> {{$user->name}} {{$user->lastName}} </h3>
                                    <div class="row">
                                        <div class="col-lg-12 margin-tb">
                                            <div class="pull-right">
                                                <button type="button" class="btn_6" data-bs-toggle="modal" data-bs-target="#addPoints"><i class="fa-solid fa-star addSpace"></i>Skirti taškus</button>
                                                <button type="button" class="btn_2" data-bs-toggle="modal" data-bs-target="#removePoints"><i class="fa-solid fa-x addSpace"></i> Skirti nuobaudą</button>
                                                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn_2"><i class="fa-solid fa-trash-can addSpace"></i> Ištrinti profilį</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="QA_table mb_30">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <img class="profilePhoto" src="{{$user->photo}}" alt="photo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <i class="fa-solid fa-envelope"></i>
                                                    {{ $user->email}}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <i class="fa-solid fa-phone"></i>
                                                    {{ $user->phone }}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                    {{ $user->birthday }}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <i class="fa-solid fa-user"></i>
                                                    {{ \App\Http\Service\UserService::getUserGender($user->gender) }}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <i class="fa-solid fa-plus"></i>
                                                    {{ $user->points}} @if($user->points == 0) taškų @elseif($user->points == 1) taškas @else taškai @endif
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <i class="fa-solid fa-briefcase"></i>
                                                    {{ \App\Http\Service\UserService::getRole($user->role) }}
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
    </div>
    <div class="modal fade" id="addPoints" tabindex="-1" aria-labelledby="addPoints" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPoints">Skirti taškus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.addPoints', $user->id) }}" method="POST">
                        @method('PATCH')
                        @csrf

                        <div class="row mb-3">
                            <h4>
                                <div class="row mb-3">
                                    <label for="cause" class="col-md-4 col-form-label text-md-end">{{ __('Taškai') }}</label>
                                    <div class="col-md-6">
                                        <select name="points" id="points" class="form-control">
                                            @for($i = 1; $i <= 20; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </h4>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Išsaugoti</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="removePoints" tabindex="-1" aria-labelledby="addPoints" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removePoints">Skirti nuobaudą</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.removePoints', $user->id) }}" method="POST">
                        @method('PATCH')
                        @csrf

                        <div class="row mb-3">
                            <h4>
                                <div class="row mb-3">
                                    <label for="cause" class="col-md-4 col-form-label text-md-end">{{ __('Taškai') }}</label>
                                    <div class="col-md-6">
                                        <select name="points" id="points" class="form-control">
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}"> - {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </h4>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Išsaugoti</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .profilePhoto {
            max-height: 100px;
        }
        .addSpace {
            padding-right: 10px;
        }
    </style>
@endsection
