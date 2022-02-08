@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Kategorijos</h2>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryCreate">Sukurti naują kategoriją</button>

    <div class="modal fade" id="categoryCreate" tabindex="-1" aria-labelledby="categoryCreateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prideti kategorija</h5>
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
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Pavadinimas</th>
            <th width="280px"></th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <form action="{{ route('categories.destroy',$category->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('categories.show',$category->id) }}">Peržiūrėti</a>

                        <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Redaguoti</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Ištrinti</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $categories->links() !!}

@endsection

<script>
    let myModal = document.getElementById('categoryCreate')
    let myInput = document.getElementById('name')

    myModal.addEventListener('shown.bs.modal', function () {
        myInput.value = '';
    })
</script>
