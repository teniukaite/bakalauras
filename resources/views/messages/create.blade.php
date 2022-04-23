@extends('theme')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_body">
                    <div class="row">
                        <div class="main_content_iner ">
                            <div class="container-fluid p-0 ">
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="dashboard_header mb_50">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="dashboard_header_title">
                                                        <h3> Sukurti pranešimą</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="dashboard_breadcam text-right">
                                                        <p><a href="{{route('messages.index')}}">Pranešimai</a> <i class="fas fa-caret-right"></i> Naujas pranešimas</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="col-12" action="{{ route('messages.store') }}" method="POST">
                                        @csrf
                                    <div class="col-12">
                                        <div class="white_box mb_30">
                                            <div class="box_header ">
                                                <div class="main-title">
                                                    <h3 class="mb-0">Sukurkite pranešimą</h3>
                                                </div>
                                            </div>
                                            <div class="box_body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="common_input mb_15">
                                                            <input type="text" placeholder="Adresato el. pašto adresas" name="receiver_id">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="common_input mb_15">
                                                            <input type="text" placeholder="Tema" name="subject">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <textarea name="message" id="kt-ckeditor-1"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <div class="create_report_btn mt_30">
                                                <button type="submit" class="btn_1 radius_btn d-block text-center col-12">Siųsti</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#kt-ckeditor-1' ), {
                placeholder: 'Jūsų pranešimas'
            } )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
