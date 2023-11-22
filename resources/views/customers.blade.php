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
    Customers
@endsection
@section("current_page")
    Customers
@endsection
@section("content")

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Creation Date</th>
        <th scope="col">Code</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($customers as $key => $customer)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td>{{ date("Y-m-d",strtotime($customer["created_at"])) }}</td>
            <td>{{ $customer["code"] }}</td>
            <td>{{ $customer["name"] }}</td>
            <td>{{ $customer["email"] }}</td>
        </tr>
        @endforeach
    
    </tbody>
  </table>

@endsection

@section("js")
  
@endsection