@extends("layouts.appe")

@section("content")
<form action = "/update" method = "POST" class = "form-horizontal">
			{{ csrf_field() }}		
			<!-- Essay name here -->
            <div class="form-group">
                <label for="essay" class="col-sm-3 control-label">Essay</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="essay-name"  value={{ $article->name }} class="form-control" />
					<input  name="id" value={{ $article->id }} type="hidden" />
					<textarea type="text" name="content" id="essay-content" class="form-control"/>{{ $article->content }}</textarea>
				</div>
            </div>

            <!-- Add Essay Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus">Update Essay</i>
                    </button>
                </div>
            </div>

        </form>

@endsection
