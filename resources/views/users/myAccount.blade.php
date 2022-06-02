@extends('layouts.layout')
@section('content')
<div class="container rounded bg-white mb-5">
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
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{asset($user->photo)}}"><span class="font-weight-bold">{{$user->name}} {{$user->lastName}}</span><span class="text-black-50">{{$user->email}}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <form action="{{route('update-my-account')}}" method="POST">
                @csrf
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Mano profilis</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Vardas</label>
                            <input type="text" name="name" class="form-control" placeholder="Vardas" value="{{$user->name}}">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Pavardė</label>
                            <input type="text" name="lastName" class="form-control" value="{{$user->lastName}}" placeholder="Pavardė">
                            @error('lastName')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Telefono numeris</label>
                            <input type="text" name="phone_number" class="form-control" placeholder="Jūsų telefono numeris" value="{{$user->phone_number ?? ''}}">
                            @error('phone_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12"><label class="labels">El. paštas</label><input type="text" name="email" class="form-control" placeholder="Jūsų telefono numeris" value="{{$user->email}}"></div>
                        <div class="col-md-12"><label class="labels">Taškai</label><input disabled type="text" class="form-control" placeholder="enter address line 1" value="{{$user->points}}"></div>
                        <div class="col-md-12"><label class="labels">Lytis</label> <select class="form-control" id="gender" name="gender">
                                <option @if($user->gender == 0) selected @endif value="0">Nenurodyti</option>
                                <option @if($user->gender == 1) selected @endif value="1">Moteris</option>
                                <option @if($user->gender == 2) selected @endif value="2">Vyras</option>
                            </select></div>
                        <div class="col-md-12"><label class="labels">Miestas</label><select class="form-control" id="city" name="city">
                                @foreach(\App\Models\City::all() as $city)
                                    <option @if($user->cities->id == $city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select></div>
                        <div class="col-md-12"><label class="labels">Gimimo data</label><input type="date" name="birthday" class="form-control" placeholder="enter address line 2" value="{{$user->birthday}}"></div>
                        <div class="col-md-12"> <input @if($user->subscribed == 1) checked @endif type="checkbox" id="newsletter" name="subscribed" value="newsletter">
                            <label for="newsletter"> Noriu gauti naujienlaiškius</label><br></div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Išsaugoti pakeitimus</button></div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <form action="{{ route('update-password') }}" method="POST">
                @csrf
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Keisti slaptažodį</span></div><br>
                <div class="col-md-12"><label class="labels">Senas slaptažodis</label><input type="password" name="old_password" class="form-control" placeholder="********" value="">
                    @error('old_password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror</div> <br>
                <div class="col-md-12"><label class="labels">Naujas slaptažodis</label><input type="password" name="new_password" class="form-control" placeholder="********" value=""></div>
                <div class="col-md-12"><label class="labels">Pakartokite slaptažodį</label><input type="password" name="new_password_confirmation" class="form-control" placeholder="********" value=""></div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Pakeisti slaptažodį</button></div>
            </div>
                </form>
        </div>
    </div>
</div>
    @endsection
