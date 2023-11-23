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
    Admins
@endsection
@section("current_page")
    Admins
@endsection
@section("content")

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Creation Date</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($admins as $key => $admin)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td>{{ date("Y-m-d",strtotime($admin["created_at"])) }}</td>
            <td>{{ $admin["name"] }}</td>
            <td>{{ $admin["email"] }}</td>
            <td ><a href="javascript:void(0)" data-id="{{ $admin["role_id"] }}" data-toggle="modal" data-target="#show_privileges"  data-role="show-privileges">
                <span data-toggle="tooltip" data-title="Show privileges">{{ $admin["role"]["value"] }}</span>
            </a> </td>
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
    <script>
        $(function(){
            $(`[data-toggle="tooltip"]`).tooltip();
            $(document).on("click",`[data-role="show-privileges"]`,function(){
                let h = "", id = $(this).data("id");
                $("#privileges_tbody").html(h);
                $.get({
                    url: `/role/${id}/privileges`,
                    success: function(d){
                        if(d.code === 200){
                            d.data.map(v => {
                                h += `<tr>
                                        <td>${v.value}</td>
                                        <td class="${v.status ? "text-success" : "text-danger"}">${v.status ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' }</td>
                                    </tr>`;
                            })

                        }
                        $("#privileges_tbody").html(h);
                    },
                    error: function(e){
                        console.error(e);
                    }

                })
            })
        })
    </script>
@endsection