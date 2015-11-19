@extends("layouts.app")

@section("content")
    <div class="panel-body">
        @include('common.errors')
		<div><a class="btn btn-success btn-block" href="create">New essay</a></div>
		<!-- Show current Essays -->
        @if(count($essays) > 0)
            <div class="panel panel-default">
                <div class="panel panel-heading">
                    Current Essays
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                Titles
                            </th>
                            <th>
                                Time
							</th>
                            <th>
                                Check
							</th>
							<th>
								Operation
							</th>
                        </tr>
                    </thead>

                    <!--Table Body-->
                    <tbody>
                        @foreach($essays as $essay)
                            <tr>
                                <td class="table-hover">
                                    <div><a class="btn btn-info btn-block" href="essay/{{ $essay->id }}">{{ $essay->name }}</a></div>
                                </td>
                                <td class="t">
                                    <div>{{ $essay->created_at }}</div>
								</td>
								<td class="t">
									<a href="edit/{{$essay->id}}" class="btn btn-primary"> EDIT Essay </a>
								</td>
                                <td>
                                    <form action="/essay/{{ $essay->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger"> Delete Essay </button>
									</form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

 @endsection
