@extends("layouts.app")




@section("title", "Edit User")
  

@section("content")
    <form class="form=horizontal" action="{{ route("users.update", ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-4" style="background-color: red">
        
                <img src="{{ $user->image ?  asset('storage/' . $user->image->path) : asset('avatar.png') }}" width="100" class="img-thumbnail" alt="..." />
               

                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Upload a different photo</h6>
                        <input type="file" class="form-control-file" name="avatar">
                    </div>
                </div>
            </div>

            @error("avatar")
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="col-8">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" value="" id="name" name="name">
                </div>

                @error("name")
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </div>
            </div>
        </div>
    </form>
@endsection