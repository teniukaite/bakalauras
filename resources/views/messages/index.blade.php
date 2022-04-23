@extends('theme')

@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="dashboard_header mb_50">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="dashboard_header_title">
                                    <h3> Pranešimai</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-right">
                                    <p><a href="{{route('dashboard')}}">Pagrindinis</a> <i class="fas fa-caret-right"></i> Pranešimai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="email-sidebar white_box">
                        <a href="{{route('messages.create')}}">
                            <button class="btn_1 w-100 mb-2 btn-lg email-gradient gradient-9-hover email__btn waves-effect">
                                <i class="ti-plus"></i>Sukurti naują
                            </button>
                        </a>
                        <ul class="text-left mt-2">
                            <li class="active"><a href="#"><i class="ti-user"></i> <span> <span>Gautieji</span> <span
                                            class="round_badge">{{\App\Http\Service\UserService::getReceivedMessageCount() }}</span> </span> </a></li>
{{--                            <li><a href="#"><i class="ti-crown"></i> <span> <span>Promotions</span> <span--}}
{{--                                            class="round_badge">1</span> </span> </a></li>--}}
{{--                            <li><a href="#"><i class="ti-star"></i> <span> <span>Started</span> <span--}}
{{--                                            class="round_badge">2</span> </span> </a></li>--}}
                            <li><a href="#"><i class="ti-announcement"></i> <span> <span>Išsiųsti laiškai</span> <span
                                                class="round_badge">{{\App\Http\Service\UserService::getSentMessageCount() }}</span> </span> </a></li>
{{--                            <li><a href="#"><i class="ti-pin2"></i> <span> <span>Drafts</span> <span--}}
{{--                                            class="round_badge">3</span> </span> </a></li>--}}
{{--                            <li><a href="#"><i class="ti-pin"></i> <span> <span>Spam</span> </span> </a></li>--}}
{{--                            <li><a href="#"><i class="ti-trash"></i> <span> <span>Trash</span> </span> </a></li>--}}
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="white_box QA_section mb_30">
                        <div class="white_box_tittle list_header">
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form Active="#">
                                            <div class="search_field">
                                                <input type="text" placeholder="Įveskite paieškos frazę">
                                            </div>
                                            <button type="submit"><i class="ti-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="QA_table ">

                            <table class="table lms_table_active">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <label class="primary_checkbox d-flex mr-12 ">
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <th scope="col"></th>
                                    <th scope="col">Vardas</th>
                                    <th scope="col">Tema</th>
                                    <th scope="col">Pranešimas</th>
                                    <th scope="col">Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $message)
                                <tr>
                                    <th scope="row">
                                        <label class="primary_checkbox d-flex mr-12 ">
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label></th>
                                    <td><i class="far fa-star"></i></td>
                                    <td>
                                        <div class="media align-items-center">
                                            <img class="circle-rounded mr-3" src="{{asset($message->sender->photo)}}" alt="" width="30"
                                                 height="30">
                                            <div class="media-body">
                                                <p>{{$message->sender->name}} {{$message->sender->lastName}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p> {{$message->subject}}</p>
                                    </td>
                                    <td>
                                        <p class="nowrap">{!! $message->message !!}</p>
                                    </td>
                                    <td>
                                        {{$message->created_at}}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $messages->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
