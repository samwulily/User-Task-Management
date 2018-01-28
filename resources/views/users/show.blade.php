@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user->name}}</div>
                <div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/users/'.$user->id) }}">
                        {!! csrf_field() !!}

						<div class="form-group">
							<label class="col-md-4 control-label">ID</label>
							<div class="col-md-6">
								<label class="form-control" name="ID">{{$user->id}}</label>
							</div>
						</div>
							
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group">
							<label class="col-md-4 control-label">Role</label>
							<div class="col-md-6">
							
								<select class="form-control" name="roles" id="roles">
								@if (strcmp($user->roles,"super admin")==0)
									<option value=1 selected>super admin</option>
								@else
									<option value=1>super admin</option>
								@endif
								
								@if (strcmp($user->roles,"admin")==0)
									<option value=2 selected>admin</option>
								@else
									<option value=2>admin</option>
								@endif
									
								@if(strcmp($user->roles,"user")==0)
									<option value=3 selected>user</option>
								@else
									<option value=3>user</option>
								@endif
									
								</select>
							</div>
						</div>
						
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
