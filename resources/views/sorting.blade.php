@extends("layouts.template")

@section("title")
    TezEx
@endsection
@section("css")
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">

@endsection
@section("logged_username")
    {{ Auth::user() ? Auth::user()->name : "Admin" }}
@endsection
@section("page_name")
    Sorting
@endsection
@section("current_page")
    Sorting
@endsection
@section("content")

<div class="container">
  <div class="row">
    <div class="col-6">
      <input type="text" data-role="tracking-id" class="form-control" placeholder="Tracking id + enter">
    </div>
      <button data-role="make-sack" class="btn btn-primary col-1 mb-2"><i class="fas fa-save"></i></button>
    <div class="col-7">
      <ul class="nav nav-tabs" id="myTabs">
        @foreach ($branches as $key => $branch)
        @if ((string)$branch["status"] === "0")
          @php
            continue;
          @endphp
        @endif
        <li class="nav-item">
          <a class="nav-link {{ $key === 0 ? "active" : "" }}" id="tab__{{ $branch["id"] }}" data-value="{{ $branch["name"] }}" data-id="{{ $branch["id"] }}" data-toggle="tab" href="#tab_{{ $branch["id"] }}">{{ $branch["name"] }}</a>
        </li>
        @endforeach
      </ul>
    </div>
  </div>

  <div class="tab-content mt-2">
    @foreach ($branches as $key => $branch)
    @if ((string)$branch["status"] === "0")
      @php
        continue;
      @endphp
    @endif
    <div class="tab-pane fade {{ $key === 0 ? "show active" : "" }}" id="tab_{{ $branch["id"] }}">
      <table class="table table-responsive">
        <tbody data-id="{{ $branch["id"] }}">

        </tbody>
      </table>
    </div>
    @endforeach
    
  
  </div>
</div>


@endsection
@section("js")
  @include("js.sorting")
@endsection