@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
           <!-- Current Users -->
            @if (count($users) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Users
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
								<th>Email</th>
								<th>Roles</th>
								<th>&nbsp</th>
                            </thead>
                            <tbody>
								@foreach ($users as $user)
                                    <tr>
										<td class="table-text"><div>{{ $user->id   }}</div></td>
										<td class="table-text"><div><a href="/users/{{$user->id}}">{{ $user->name }}</a></div></td>
										<td class="table-text"><div>{{ $user->email }}</div></td>
										<td class="table-text"><div>{{ $user->roles }}</div></td>
                                        <!-- User Delete Button -->
                                        <td>
                                            <form action="{{url('user/' . $user->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
					
												@if (Auth::user()->id != $user->id)
													<button type="submit" id="delete-user-{{ $user->id }}" class="btn btn-danger">
														<i class="fa fa-btn fa-trash"></i>Delete
													</button>
												@else
													<button type="submit" id="delete-user-{{ $user->id }}" class="btn btn-danger" disabled>
														<i class="fa fa-btn fa-trash"></i>Delete
													</button>
												@endif
												
                                                
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
