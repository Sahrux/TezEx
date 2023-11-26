@extends("layouts.template")

@section("title")
    TezEx
@endsection
@section("css")
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
<style>
   .modal-backdrop {
      opacity: 0.7; /* Set the opacity for the backdrop */
    }
</style>
@endsection
@section("logged_username")
    {{ Auth::user() ? Auth::user()->name : "Admin" }}
@endsection
@section("page_name")
    Roles & Privileges
@endsection
@section("current_page")
    Roles & Privileges
@endsection
@section("content")
<div class="row d-flex justify-content-end mr-2 mb-2">
    @if (has_access_to("add_roles"))
    <div class="mr-2">
        <a class="btn btn-primary" data-toggle="modal" data-target="#new_role"><i class="fas fa-plus"> New role</i></a>
    </div>
    @endif
    <div>
        <a class="btn btn-primary" data-toggle="modal" data-target="#all_privileges"><i class="fas fa-bars"></i> Privileges</i></a>
    </div>
</div>

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Creation Date</th>
        <th scope="col">Key</th>
        <th scope="col">Value</th>
        <th scope="col">Creator</th>
        <th scope="col"><i class="fas fa-pen"></i></th>
      </tr>
    </thead>
    <tbody data-role="role-main-tbody">
        @foreach ($roles as $key => $role)
        <tr>
            <th scope="row" data-role="index">{{ $key + 1 }}</th>
            <td>{{ date("Y-m-d",strtotime($role["created_at"])) }}</td>
            <td>{{ $role["key"] }}</td>
            <td>{{ $role["value"] }}</td>
            <td>{{ $role["user"]["name"] }}</td>
            <td >
                <a href="javascript:void(0)" data-id="{{ $role["id"] }}" data-toggle="modal" data-target="#show_privileges"  data-role="show-privileges">
                    <span data-toggle="tooltip" data-title="Show privileges"><i class="fas fa-eye"></i></span>
                 </a> 
                 @if (has_access_to("delete_roles"))
                 <a class="ml-2" href="javascript:void(0)" data-id="{{ $role["id"] }}"   data-role="delete-role">
                     <span class="text-danger" data-toggle="tooltip" data-title="Delete role"><i class="fas fa-trash"></i></span>
                  </a> 
                 @endif
            </td>
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
            <div class="table-responsive">
                <table id="privileges_table" class="table table-bordered">
                    {{-- <tbody id="privileges_tbody">
                      
                    </tbody> --}}
                  </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          @if (has_access_to("edit_privileges"))
          <button type="button" data-role="save-privilege" class="btn btn-primary">Save</button>
          @endif
        </div>
      </div>
    </div>
  </div>
  @if (has_access_to("add_roles"))
  <div class="modal fade" id="new_role" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <label for="">Key</label>
            <input type="text" data-role="key" class="form-control">
            <label for="">Value</label>
            <input type="text" data-role="value" class="form-control">
            <div class="mt-2">
                <label for="">Privileges</label>
                <table class="table">
                    <tbody id="new_role_tbody"></tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" data-role="save-role" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
  @endif

  <div class="modal fade" id="all_privileges" style="z-index: 1058" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <tbody id="all_privileges_tbody"></tbody>
            </table>
        </div>
        <div class="modal-footer">
            @if (has_access_to("add_privileges"))
            <button type="button" data-target="#new_privilege" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus"></i>New</button>
            @endif
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  @if (has_access_to("add_privilege"))
  <div class="modal fade" style="z-index: 1059" id="new_privilege" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Privilege</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <label for="">Key</label>
            <input type="text" data-role="key" class="form-control">
            <label for="">Value</label>
            <input type="text" data-role="value" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" data-role="add-privilege" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
  @endif
@endsection

@section("js")
  @include("js.roles")
@endsection