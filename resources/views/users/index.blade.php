@extends('theme')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
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
                                    <h4>Naudotojų sąrašas </h4>
                                    <div class="row">
                                        <div class="col-lg-6 margin-tb">
                                            <div class="pull-right">
                                                <a class="btn_1" href="{{ route('users.blacklist') }}"> Juodasis sąrašas</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 margin-tb">
                                            <div class="pull-right">
                                                <a class="btn_1" href="{{ route('users.countPoints') }}"> Perskaičiuoti taškus</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box_right d-flex lms_block">
                                        <div class="serach_field_2">
                                            <div class="search_inner">
                                                <form action="{{ route('users.index') }}" method="GET">
                                                    <div class="search_field">
                                                        <input id="search" name="search" type="text" placeholder="Įveskite paieškos frazę...">
                                                    </div>
                                                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="QA_table mb_30">

                                    <table class="table lms_table_active ">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Vardas</th>
                                            <th scope="col">Pavardė</th>
                                            <th scope="col">El. paštas</th>
                                            <th scope="col">Rolė</th>
                                            <th scope="col">Taškai</th>
                                            <th scope="col">Veiksmai</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                        <tr>
                                            <th scope="row"><a href="#" class="question_content"> {{ ++$i }} </a></th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->lastName }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td><a href="#">{{\App\Http\Service\UserService::getRole($user->role)}}</a></td>
                                            <td>{{$user->points}}</td>
                                            <td>
                                                <div class="action_btns d-flex">
{{--                                                    <a href="{{ route('users.edit',$user->id) }}" class="action_btn mr_10"> <i class="far fa-edit"></i>--}}
{{--                                                    </a>--}}
                                                    <button type="button" onclick="showDeleteModal({{ $user->id }})" class="action_btn"> <i class="fas fa-trash"></i></button>

                                                    <a href="{{route('users.show', $user->id)}}" class="action_btn"> <i class="fas fa-solid fa-eye"></i> </a>
                                                </div>
                                            </td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {!! $users->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deletion" tabindex="-1" aria-labelledby="deletion" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletion">Profilio šalinimas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Ar tikrai norite ištrinti naudotojo profilį?</h4>
                    <form method="POST">
                        @csrf
                        @method('DELETE')

                        <button onclick="deleteUser();" type="submit" class="btn_2"><i class="fa-solid fa-trash-can addSpace"></i> Taip</button>
                        <button type="button" class="btn_6" data-bs-dismiss="modal" aria-label="Close">Ne</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let search = document.getElementById('search');

        function showDeleteModal(id) {
            $('#deletion').modal('show');
            $('#deletion').on('shown.bs.modal', function () {
                $('#deletion').find('form').attr('action', '/admin/users/' + id);
            });
        }
    </script>
@endsection
