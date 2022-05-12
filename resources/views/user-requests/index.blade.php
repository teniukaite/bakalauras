@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Jūsų klausimai</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Klausimas</th>
                                <th>Atsakymas</th>
                            </thead>
                            <tbody>
                                @foreach ($requests as $user_request)
                                    <tr>
                                        <td>{{ $user_request->question }}</td>
                                        <td>{{ $user_request->answer }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $requests->links() }}
                    </div>
                    <hr>
                    <h3>Pateikti klausimą</h3>
                    <hr>
                    <form action="{{ route('user_requests.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="question">Klausimas</label>
                            <textarea name="question" id="question" class="form-control" rows="3" required></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Pateikti" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
