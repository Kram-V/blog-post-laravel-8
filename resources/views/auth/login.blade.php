@extends("layouts.app")

@section("title", "Login")


@section("content")
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? "is-invalid" : "" }}">
        </div>

        @error("email")
            <div class="text-danger"><strong>{{ $message }}</strong></div>
        @enderror

        <div class="form-group">
            <label for="email">Password *</label>
            <input type="password" name="password" class="form-control {{ $errors->has('password') ? "is-invalid" : "" }}">
        </div>

        @error("password")
            <div class="text-danger"><strong>{{ $message }}</strong></div>
        @enderror

        {{-- <div class="form-group">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="checkbox" name="remember" value="{{ old('remember')  ? 'checked' : '' }}">

                <label for="checkbox" class="form-check-label">Remember me</label>
            </div>
        </div> --}}

        <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-dark">Login</button>
        </div>
    </form>
@endsection