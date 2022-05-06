@extends('theme')

@section('content')
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
                                    <h3>Užklausa Nr. {{$request->id}} </h3>
                                    <div class="row">
                                        <div class="col-lg-12 margin-tb">
                                            <div class="pull-right">
                                                <button @if(!is_null($request->answer)) style="display: none" @endif type="button" class="btn_1" data-bs-toggle="modal" data-bs-target="#answer">Atsakyti į užklausą</button>
                                                <button @if(is_null($request->answer)) style="display: none" @endif type="button" class="btn_1" data-bs-toggle="modal" data-bs-target="#edit-answer">Redaguoti užklausą</button>
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
                                                        <option @if ($request->state == 0) selected @endif value="0">Pateikta </option>
                                                        <option @if ($request->state == 1) selected @endif value="1">Peržiūrėta</option>
                                                        <option @if ($request->state == 2) selected @endif value="2">Atsakyta</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Klausimas:</strong>
                                                {{ $request->question }}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Atsakymas:</strong>
                                                {{ $request->answer ?? 'Nėra atsakymo' }}
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
    <div class="modal fade" id="answer" tabindex="-1" aria-labelledby="answer" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="answer">Pateikti atsakymą</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('requests.answer', $request->id) }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="answer" class="col-md-4 col-form-label text-md-end">{{ __('Atsakymas') }}</label>

                            <div class="col-md-6">
                                <textarea id="answer" type="text" class="form-control" name="answer"> </textarea>

                                @error('answer')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Išsaugoti</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-answer" tabindex="-1" aria-labelledby="edit-answer" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-answer">Pateikti atsakymą</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('requests.answer', $request->id) }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="answer" class="col-md-4 col-form-label text-md-end">{{ __('Atsakymas') }}</label>

                            <div class="col-md-6">
                                <textarea id="answer" type="text" class="form-control" name="answer"> {{$request->answer}} </textarea>

                                @error('answer')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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

@endsection

@section('js')
    <script>
        let myModal = document.getElementById('answer')
        let myInput = document.getElementById('answer')

        myModal.addEventListener('shown.bs.modal', function () {
            myInput.value = '';
        })

        let editAnswerModal = document.getElementById('edit-answer')
        let editAnswerInput = document.getElementById('edit-answer')

        myModal.addEventListener('shown.bs.modal', function () {
            editAnswerModal.value = '';
        })
    </script>
@endsection
