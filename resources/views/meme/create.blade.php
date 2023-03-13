@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class ="d-flex gap-1 justify-content-center mb-3">
                <div class="mt-5 pl-30 pr-30 w-50">
                    <h4 class="display-7 ">Create a New Meme</h4><br>
                   

                   

                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="title">Post Title</label>
                                <input type="text" id="title" class="form-control" name="title"
                                       placeholder="Enter Post Title" required>
                            </div>

                            <div class="control-group col-12">
                                <label for="photo">Post Photo</label>
                                <input type="file" id="photo" class="form-control" name="photo">
                            </div>


                            <div class="control-group col-12 mt-2">
                                <label for="body">Post Body</label>
                                <textarea id="body" class="form-control" name="body" placeholder="Enter Post Body"
                                          rows=""></textarea>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="control-group col-12 text-center">
                                <a href="/meme" class="btn btn-danger btn-sm">Go back</a>
                                <button id="btn-submit" class="btn btn-primary btn-sm">
                                    Create Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection