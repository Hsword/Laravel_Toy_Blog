@extends("layouts.appe")

@section("content")
<div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        {!! $article->name !!}
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse in">
      <div class="accordion-inner">
        {{ $article->content }}
      </div>
    </div>
  </div>
</div>
@endsection

