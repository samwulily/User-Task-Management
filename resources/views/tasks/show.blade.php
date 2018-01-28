@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
			
			 <div class="panel panel-default">
                <div class="panel-heading">
					{{	$task->name	}}
                </div>

                <div class="panel-body">
					<!-- Display Validation Errors -->
                    @include('common.errors')
					<form action="{{ url("tasks/$task->id") }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
						<div class="form-group">
							<label for="task-name" class="col-sm-3 control-label">Task Name</label>

							<div class="col-sm-6">
								<input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}">
							</div>
						</div>
						
						<div class="form-group">
							<label for="belong-user" class="col-sm-3 control-label">User</label>

							<div class="col-sm-6">
								@if (count($users) > 0)
									<select class="form-control" name="user" id="user">
										@foreach ($users as $user)
											@if($user->id == $task->user_id)
												<option value="{{$user->id}}" name="{{$user->id}}" id="{{$user->id}}" selected>{{$user->name}}</option>
											@else
												<option value="{{$user->id}}" name="{{$user->id}}" id="{{$user->id}}">{{$user->name}}</option>
											@endif
										@endforeach
									</select>
								@endif
							</div>
						</div>
						
						<!-- Update Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    Update Task
                                </button>
                            </div>
                        </div>
					</form>
               </div>
            </div>
           
        </div>
    </div>
@endsection
