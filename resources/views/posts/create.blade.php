@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Post
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Post Form -->
                    <form action="{{ url('post') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Post Title -->
                        <div class="form-group">
                            <label for="post-title" class="col-sm-3 control-label">Title</label>

                            <div class="col-sm-6">
                                <input type="text" name="title" id="post-title" class="form-control" value="{{ old('post') }}">
                            </div>
                        </div>

						<!-- Post Body -->
                        <div class="form-group">
                            <label for="post-body" class="col-sm-3 control-label">Body</label>

                            <div class="col-sm-6">
                                <input type="text" name="body" id="post-body" class="form-control" value="{{ old('post') }}">
                            </div>
                        </div>
						
                        <!-- Add Post Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
