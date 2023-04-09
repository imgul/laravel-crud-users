@extends('user.layouts.app')

@push('scripts')
    <script>
        $(document).ready(function() {
            let hobbyInput = $('#hobbyInput');
            hobbyInput.on('click', '.addHobby', function() {
                let hobbyInput = $('#hobbyInput');
                let newInput = $('<div class="row mt-2">' +
                    '<div class="col-11">' +
                    '<input type="text" name="hobbies[]" class="form-control" id="hobbies" placeholder="Enter New Hobby">' +
                    '</div>' +
                    '<div class="col-1">' +
                    '<div class="btn btn-primary addHobby" id="addHobby">+</div>' +
                    '</div>' +
                    '</div>');

                $(this).attr('class', 'btn btn-danger removeHobby');
                $(this).text('X');
                hobbyInput.append(newInput);
            });

            hobbyInput.on('click', '.removeHobby', function() {
                $(this).closest('.row').remove();
            });
        });
    </script>
@endpush

@section('content')
    <div class="container pt-4">
        <div class="row py-4">
            <div class="col-6">
                <h1>Create User</h1>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('user.index') }}">
                    <button class="btn btn-primary">All Users</button>
                </a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6 col-sm-8">
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">User ID</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp"
                            value="{{ $user->id }}" placeholder="Enter User Name" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">User Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp"
                            value="{{ $user->name }}" placeholder="Enter User Name">
                        @if ($errors->has('name'))
                            <span class="form-text text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email"
                            aria-describedby="emailHelp" value="{{ $user->email }}" placeholder="Enter Email Address">
                        @if ($errors->has('email'))
                            <span class="form-text text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="hobbies" class="form-label">Hobbies</label>
                        <div id="hobbyInput">
                            @php
                                $hobbies = explode(', ', $user->hobbies);
                            @endphp
                            @foreach ($hobbies as $hobby)
                                <div class="row mt-2">
                                    <div class="col-11">
                                        <input type="text" name="hobbies[]" class="form-control" id="hobbies"
                                            aria-describedby="hobbiesHelp" placeholder="Enter Hobby"
                                            value="{{ $hobby }}">
                                    </div>
                                    <div class="col-1">
                                        <div class="btn btn-danger removeHobby">X</div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row mt-2">
                                <div class="col-11">
                                    <input type="text" name="hobbies[]" class="form-control" id="hobbies"
                                        aria-describedby="hobbiesHelp" placeholder="Enter New Hobby">
                                </div>
                                <div class="col-1">
                                    <div class="btn btn-primary addHobby">+</div>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('hobbies'))
                            <span class="form-text text-danger">{{ $errors->first('hobbies') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
