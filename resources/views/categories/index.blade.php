@extends('theme')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="modal fade" id="categoryCreate" tabindex="-1" aria-labelledby="categoryCreateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pridėti kategoriją</h5>
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

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Pavadinimas') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
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
    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                        <div class="page_title_left d-flex align-items-center">
                            <h3 class="f_s_25 f_w_700 dark_text mr_30">Kategorijos</h3>
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
                                    <h4>Kategorijų sąrašas </h4>
                                    <div class="row">
                                        <div class="col-lg-12 margin-tb">
                                            <div class="pull-right">
                                                <button type="button" class="btn_1" data-bs-toggle="modal" data-bs-target="#categoryCreate">Sukurti naują kategoriją</button>
                                            </div>
                                        </div>
                                    </div>
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
                                            <th>#</th>
                                            <th>Pavadinimas</th>
                                            <th scope="col">Veiksmai</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <th scope="row"><a href="#" class="question_content"> {{ ++$i }} </a></th>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="{{ route('categories.edit',$category->id) }}" class="action_btn mr_10"> <i class="far fa-edit"></i></a>
                                                        <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="action_btn"> <i class="fas fa-trash"></i></button>
                                                        </form>
                                                        <a href="{{route('categories.show', $category->id)}}" class="action_btn"> <i class="fas fa-solid fa-eye"></i> </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {!! $categories->links() !!}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
    let myModal = document.getElementById('categoryCreate')
    let myInput = document.getElementById('name')

    myModal.addEventListener('shown.bs.modal', function () {
        myInput.value = '';
    })

    let editModal = document.getElementById('categoryEdit')

    function open(category) {
        editModal.addEventListener('shown.bs.modal', function () {
            let myInput = document.getElementById('name')
            myInput.value = category.name;
        })
        editModal.style.display = 'block'
    }
</script>
@endsection
