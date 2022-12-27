@extends("layouts.app")


@section("title", "Register")

@section("content")
    
    <form action="{{ route("register") }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Username *</label>
            <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control {{ $errors->has('name') ? "is-invalid" : "" }}">
        </div>

        @error("name")
            <div class="text-danger"><strong>{{ $message }}</strong></div>
        @enderror

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control {{ $errors->has('email') ? "is-invalid" : "" }}">
        </div>

        @error("email")
            <div class="text-danger"><strong>{{ $message }}</strong></div>
        @enderror

        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? "is-invalid" : "" }}">
        </div>

        @error("password")
            <div class="text-danger"><strong>{{ $message }}</strong></div>
        @enderror

        <div class="form-group">
            <label for="">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-dark">Register</button>
        </div>
    </form>


@endsection