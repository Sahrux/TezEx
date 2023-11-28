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
    Packs
@endsection
@section("current_page")
Packs
@endsection
@section("content")
<div class="form-row">
    <div class="form-group col-2">
      <label for="filterColumn">Customer</label>
      <select class="form-control" data-role="customer">
        <option value="">Select customer</option>
        @foreach ($customers as $customer)
            <option value="{{ $customer["id"] }}" {{ request("customer_id") === $customer["id"] ? "selected" : "" }}>{{ $customer["name"] . "( ". $customer["count"] ." )" }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-2">
      <label for="filterColumn">Branch</label>
      <select class="form-control" data-role="branch">
        <option value="">Select branch</option>
        @foreach ($branches as $branch)
            <option value="{{ $branch["id"] }}" {{ isset($_GET["branch_id"]) &&  $_GET["branch_id"] === $branch["id"] ? "selected" : "" }}>{{ $branch["name"] . "( ". $branch["count"] ." )" }}</option>
        @endforeach
      </select>
    </div>
<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Creation Date</th>
        <th scope="col">Tracking ID</th>
        <th scope="col">Customer</th>
        <th scope="col">Branch</th>
        <th scope="col">Category</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody id="pack_tbody">
        @if (false)
        @foreach ($packs as $key => $pack)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td>{{ date("Y-m-d",strtotime($pack["created_at"])) }}</td>
            <td>{{ $pack["tracking_id"] }}</td>
            <td>{{ $pack["customer"]["name"] }}</td>
            <td>{{ $pack["branch"]["name"] }}</td>
            <td>{{ $pack["category"]["value"] }}</td>
            <td>{{ $statuses[$pack["status"]] }}</td>
        </tr>
        @endforeach
        @endif
  
    
    </tbody>
  </table>

@endsection

@section("js")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function () {
        const getUrlParameter = (name, url) => {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }



        let customer_id = getUrlParameter("customer_id"),branch_id = getUrlParameter("branch_id");

        const filter_url = (params = null) => {
            let new_url = window.location.href;

            if(params){
                let url_strs = [];
                $params = params.map(v => {
                    for (let key in v) {
                        if(v[key]){
                             url_strs.push(`${key}=${v[key]}`);
                        }
                    }
                });
                
                new_url = "?" + url_strs.join("&");
            }
            window.history.pushState({ path: new_url }, '', new_url);

        }

     


        $(document).on("change",`[data-role="customer"]`,function(){
            customer_id = $(this).val();
            branch_id = $(`[data-role="branch"]`).val();
            filter_url([{customer_id},{branch_id}]);
            getPacks({customer_id,branch_id})
        })

        $(document).on("change",`[data-role="branch"]`,function(){
            branch_id = $(this).val();
            customer_id = $(`[data-role="customer"]`).val();
            filter_url([{customer_id},{branch_id}]);
            getPacks({customer_id,branch_id})
        })


        const packContainer = (v,i) => {
            return `<tr>
                        <td>${i + 1}</td>
                        <td>${v.created_at ?? ""}</td>
                        <td>${v.tracking_id ?? ""}</td>
                        <td>${v.customer.name ?? ""}</td>
                        <td>${v.branch.name ?? ""}</td>
                        <td>${v.category.value ?? ""}</td>
                        <td>${v.status ?? ""}</td>
                    </tr>`;
        }


        const getPacks = (data) => {
            $.get({
                url: `/packs/live`,
                data,
                success: function(d){
                    if(d.code === 200){
                        let h = "";
                        d.data.map((v,i) => {
                            h += packContainer(v,i);
                        });
                        $(`#pack_tbody`).html(h);
                    }
                },
                error: function(e){
                    console.error(e);
                }
            })
        }

        getPacks({customer_id,branch_id})
    });
</script>
@endsection