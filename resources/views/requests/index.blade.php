@extends('theme')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                        <div class="page_title_left d-flex align-items-center">
                            <h3 class="f_s_25 f_w_700 dark_text mr_30">Užklausos</h3>
                            <ol class="breadcrumb page_bradcam mb-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Pagrindinis</a></li>
                            </ol>
                        </div>
                        <div class="page_title_right">
                            <div class="page_date_button d-flex align-items-center">
                                <img src="img/icon/calender_icon.svg" alt="">
                                {{date('Y-m-d')}}
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
                                    <h4>Užklausų sąrašas </h4>
                                    <div class="box_right d-flex lms_block">
                                        <div class="serach_field_2">
                                            <div class="search_inner">
                                                <form Active="#">
                                                    <div class="search_field">
                                                        <input type="text" placeholder="Įveskite paieškos frazę...">
                                                    </div>
                                                    <button type="submit"><i class="ti-search"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="add_button ml-10">
                                            <a href="#" data-toggle="modal" data-target="#addcategory" class="btn_1">Ieškoti</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="QA_table mb_30">

                                    <table class="table lms_table_active ">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Klausimas</th>
                                            <th scope="col">Paklausė</th>
                                            <th scope="col">Atsakė</th>
                                            <th scope="col">Statusas</th>
                                            <th scope="col">Data</th>
                                            <th scope="col">Veiksmai</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($requests as $request)
                                            <tr>
                                                <th scope="row"><a href="#" class="question_content"> {{ ++$i }} </a></th>
                                                <td>{{ $request->question }}</td>
                                                <td>{{ $request->asker->name }}</td>
                                                <td>{{ $request->answerer->name ?? 'null' }}</td>
                                                <td><a href="#">{{\App\Http\Service\RequestService::getStatus($request->state)}}</a></td>
                                                <td>{{$request->created_at}}</td>
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="{{ route('users.edit',$request->id) }}" class="action_btn mr_10"> <i class="far fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('users.destroy',$request->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="action_btn"> <i class="fas fa-trash"></i></button>
                                                        </form>
                                                        <a href="{{route('requests.show', $request->id)}}" class="action_btn"> <i class="fas fa-solid fa-eye"></i> </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {!! $requests->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
