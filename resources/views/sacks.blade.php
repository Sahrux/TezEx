@extends("layouts.template")

@section("title")
    TezEx
@endsection
@section("css")
@endsection
@section("logged_username")
    {{ Auth::user() ? Auth::user()->name : "Admin" }}
@endsection
@section("page_name")
    Sacks
@endsection
@section("current_page")
    Sacks
@endsection
@section("content")

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Creation Date</th>
        <th scope="col">Name</th>
        <th scope="col">Branch</th>
        <th scope="col">Type</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($sacks as $key => $sack)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td>{{ date("Y-m-d",strtotime($sack["created_at"])) }}</td>
            <td>{{ $sack["name"] }}</td>
            <td>{{ $sack["branch"]["name"] }}</td>
            <td>{{ $sack["type"]["value"] }}</td>
          </tr>
        @endforeach
    
    </tbody>
  </table>

  <div class="modal fade" id="show_privileges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Privileges</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tbody id="privileges_tbody">
                  
                </tbody>
              </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section("js")
@endsection