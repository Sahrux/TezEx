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
    Packages
@endsection
@section("current_page")
    Packages
@endsection
@section("content")

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Creation Date</th>
        <th scope="col">Tracking ID</th>
        <th scope="col">Customer</th>
        <th scope="col">Branch</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($packs as $key => $pack)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td>{{ date("Y-m-d",strtotime($pack["created_at"])) }}</td>
            <td>{{ $pack["tracking_id"] }}</td>
            <td>{{ $pack["customer"]["name"] }}</td>
            <td>{{ $pack["branch"]["name"] }}</td>
            <td>{{ $statuses[$pack["status"]] }}</td>
        </tr>
        @endforeach
    
    </tbody>
  </table>

@endsection

@section("js")
  
@endsection