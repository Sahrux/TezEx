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
    Branches
@endsection
@section("current_page")
    Branches
@endsection
@section("content")

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Creation Date</th>
        <th scope="col">Name</th>
        <th scope="col">Address</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($branches as $key => $branch)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td>{{ date("Y-m-d",strtotime($branch["created_at"])) }}</td>
            <td>{{ $branch["name"] }}</td>
            <td>{{ $branch["address"] }}</td>
            @php $status = $branch["status"] === "1"; @endphp
            <td class="{{ $status ? 'text-success' : 'text-danger' }}"><i class="{{ $status ? 'fas fa-check-circle' : 'fas fa-times-circle'}}"></i></td>
        </tr>
        @endforeach
    
    </tbody>
  </table>

@endsection

@section("js")
  
@endsection