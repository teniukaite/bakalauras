@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Aprašykite ir įkelkite savo paslaugą!</div>
                <div class="card-body">
                    <form action="{{ route('offers.store') }}" method="post"  enctype="multipart/form-data" >
                        @csrf
                        <div class="form-input" style=" margin-bottom: 30px; margin-top: 30px;">
                            <label><i class="fa-solid fa-comments"></i>PAVADINIMAS:</label><br>
                            <input type="text" name="service_name"
                                   class="form-control {{ $errors->has('service_name') ? 'is-invalid' : '' }}"
                                   placeholder="Įveskite pavadinimą:" value="{{ old('service_name') }}" >
                        </div>
                        <div  class="form-group">
                            <label> <i class="fa-solid fa-audio-description"></i>APRAŠYMAS:</label><br>
                            <textarea  name="description" rows="4" cols="50"
                                       class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                       placeholder="Aprašykite savo teikiamas paslaugas:" value="{{ old('description') }}">
                                </textarea>
                            <br>
                        </div >
                        <div class="form-group">
                            <label>  <i class="fa-solid fa-clock"> timer  &nbsp</i>TRUKMĖ:</label><br>
                            <input  style="width: 40%" placeholder="Įveskite paslaugos trukmę" class="form-control" type="number" step="0.01"  min="0" name="duration" required="required">VAL.

                        </div>
                        <div class="form-group">
                            <label>  <i class="fa-solid fa-eur"></i>KAINA:</label><br>
                            <input  placeholder="Įveskite kainą" class="form-control" type="number" step="0.01"  min="1" name="price" required="required">
                        </div>
                        <div class="form-group">
                            <select name="price_content"  required="required">
                                <option>EUR/VAL</option>
                                <option>UŽ ATLIKTĄ DARBĄ</option>
                            </select>
                        </div>
                        <br>
                        <label  for="$category" > <p>  <i class="fa-solid fa-archive"></i>KATEGORIJA:</p></label><br>
                        <select style=" margin-bottom: 30px; margin-top: 0px"required="required" class="form-control {{ $errors->has('categories') ? 'is-invalid' : '' }}"  name="category_id">
                            <option class="select" style="font-size: 20px" value="">Nustatykite paslaugos kategoriją:</option>
                            @foreach(App\Models\Category::all() as $type)
                                <option  style="font-size: 18px" {{ old('category')==$type->id ? 'selected' : '' }} value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                        <div class="form-group" style="justify-content: center">
                            <i class="fa-solid fa-home"></i>
                            <label>MIESTAS:</label><br>
                            <input  required="required" class="form-control" type="text" name="city"  placeholder="Įveskite miestą">
                        </div>
                        <br>
                        <h4 class="text-center mb-5" style="margin-top: 20px; margin-bottom: 0px; color: rgb(153, 51, 102);">Įkelkite savo darbo pavyzdį, kuris geriausiai atspindi Jūsų teikiamą paslaugą.</h4>

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-4 col-form-label text-md-end">
                                <label for="file">Failai</label>
                            </div>
                            <div class="col-md-6">
                                <input type="file" name="file[]" class="form-control" placeholder="file" multiple accept=".jpg,.png,.pdf,.jpeg">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
