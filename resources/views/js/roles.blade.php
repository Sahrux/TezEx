<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
<script>
    $(function(){
        $(`[data-toggle="tooltip"]`).tooltip();

        const PRIVS = {
            "add_roles": !!'{{ has_access_to("add_roles") }}',
            "edit_roles": !!'{{ has_access_to("edit_roles") }}',
            "delete_roles": !!'{{ has_access_to("delete_roles") }}',
            "add_privileges": !!'{{ has_access_to("add_privileges") }}',
            "edit_privileges": !!'{{ has_access_to("edit_privileges") }}',
            "delete_privileges": !!'{{ has_access_to("delete_privileges") }}',
        }

        $(document).on("click",`[data-role="show-privileges"]`,function(){
            let h = "", id = $(this).data("id");
            $(`[data-role="save-privilege"]`).data("id",id);
            $("#privileges_table").html(h);
            $.get({
                url: `/role/${id}/privileges`,
                success: function(d){
                    if(d.code === 200){
                        h = `<thead>
                                <td></td>
                                <td>Description</td>
                                <td>Status</td>
                            </thead>
                            <tbody id="privileges_tbody">`;
                        d.data.map(v => {
                            
                            h += `<tr>
                                    <td>${v.value}</td>
                                    <td>${v.description ?? ""}</td>
                                    ${PRIVS["edit_privileges"] ? `<td><input type="checkbox" data-id="${v.id}" data-role="priv-status" ${v.status ? 'checked' : ''}></td>` : `<td class="${v.status ? "text-success" : "text-danger"}">${v.status ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' }</td>`}
                                </tr>`;
                        })
                        h += `</tbody>`;

                    }
                    $("#privileges_table").html(h);
                },
                error: function(e){
                    console.error(e);
                }

            })
        })


            $(document).on("click",`[data-target="#new_role"]`,function(){
                getPrivileges("#new_role");
            })
            
            $(document).on("click",`[data-target="#all_privileges"]`,function(){
                getPrivileges("#all_privileges");
            })


            const getPrivileges = (parent = null) => {
                let h = "", id = 0,is_all_priv = parent === "#all_privileges";
                $(parent).find(parent+"_tbody").html(h);
                $.get({
                    url: `/role/${id}/privileges`,
                    success: function(d){
                        if(d.code === 200){
                            d.data.map((v,i) => {
                                h += `<tr>
                                        ${is_all_priv ? `<td data-role="index">${i+1}</td>` : ""}
                                        <td>${v.value}</td>
                                        ${is_all_priv ? "" : `<td><input type="checkbox" data-id="${v.id}" data-role="priv-status"></td>`}
                                        ${is_all_priv && PRIVS["delete_privileges"]? `<td>
                                            <a class="ml-2" href="javascript:void(0)" data-id="${v.id}"   data-role="delete-privilege">
                                                <span class="text-danger" data-toggle="tooltip" data-title="Delete privilege"><i class="fas fa-trash"></i></span>
                                            </a> 
                                            </td>` : ""}
                                    </tr>`;
                            })

                            if(is_all_priv){
                                $(`[data-toggle="tooltip"]`).tooltip();
                            }

                        }
                        $(parent).find(parent+"_tbody").html(h);
                    },
                    error: function(e){
                        console.error(e);
                    }

                })
            }


        $(document).on("click",`[data-role="save-privilege"]`,function(){
            let id = $(this).data("id"),privileges = [];
            $("#privileges_tbody").find(`[data-role="priv-status"]`).each(function(){
                if($(this).prop("checked")){
                    privileges.push($(this).data("id"));
                }
            })

            if(!id || (id && id == 2 && !privileges.length)){
                Swal.fire("","Admin must have at least one privilege","warning")
                return;
            }
            //loader funksiyasi baslayir
            $.ajax({
                type: `put`,
                url: `/role/${id}/set-privilege`,
                data: {_token: '{{ csrf_token() }}',privileges},
                success: function(d){
                    Swal.fire("",d.message,d.code === 202 ? "success" : "warning")
                    if(d.code === 202){
                    $(`#show_privileges`).modal("hide");
                    }
                },
                error: function(e){
                    console.error(e)
                },
                complete: function(){
                    //loader funksiyasi bitir
                }
            })
        })


        function getCurrentDate() {
            const currentDate = new Date();

            // Get the full year
            const year = currentDate.getUTCFullYear();

            // Get month and day with leading zeros
            const month = ('0' + (currentDate.getUTCMonth() + 1)).slice(-2); // Months are zero-based
            const day = ('0' + currentDate.getUTCDate()).slice(-2);

            // Assemble the date string in "YYYY-MM-DD" format
            const formattedDate = `${year}-${month}-${day}`;

            return formattedDate;
        }


        $(document).on("click",`[data-role="delete-role"]`,function(){
            let id = $(this).data("id"),elem = $(this).parents("tr");
            deleteService(id,elem,true);
        })

        $(document).on("click",`[data-role="delete-privilege"]`,function(){
            let id = $(this).data("id"),elem = $(this).parents("tr");
            deleteService(id,elem);
        })

        const refreshIndexes = (is_role = false) => {
            $i = 1;
            $(is_role ? `[data-role="role-main-tbody"] > tr` : `#all_privileges_tbody > tr`).each(function(){
                $(this).find(`[data-role="index"]`).html($i);
                $i++;
            })
        }

        const deleteService = (id,elem,is_role = null) => {
            Swal.fire({
                text: is_role ? "Are u sure to delete this role?" : "Are u sure to delete this privilege?",
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then(response => {
                if(response.isConfirmed){
                    $.ajax({
                        type: `delete`,
                        url: is_role ? `/roles/${id}/delete` : `/privileges/${id}/delete`,
                        data: {_token: '{{ csrf_token() }}',type: is_role ? "role" : "privilege"},
                        success: function(d){
                            Swal.fire("",d.message,d.code === 202 ? "success" : "warning")
                            if(d.code === 202){
                                elem.remove();
                                refreshIndexes(is_role);
                            }
                        }
                    })
                }
            })
       
        }


        const resetInputs = (parent) => {
            $(".modal").modal("hide");
            parent.find("input").val("").change();
            parent.find(`input[type="checkbox"]`).prop("checked",false).change();
        }



        $(document).on("click",`[data-role="save-role"]`,function(){
            let parent = $("#new_role"),
                key = parent.find(`[data-role="key"]`).val(),
                value = parent.find(`[data-role="value"]`).val(),
                privileges = [];
            parent.find(`[data-role="priv-status"]`).each(function(){
                if($(this).prop("checked")){
                        privileges.push($(this).data("id"));
                    }
                }
            )

            if(["developer","admin","viewer"].includes(key)){
                Swal.fire("","This role already exists","warning")
            }

            $.post({
                url: `/roles/add`,
                data: {
                    _token: '{{ csrf_token() }}',
                    key,
                    value,
                    privileges
                },
                success: function(d){
                    Swal.fire("",d.message,d.code === 201 ? "success" : "warning");
                    if(d.code === 201){
                        resetInputs();
                        let count = $(`[data-role="role-main-tbody"] > tr`).length;
                        $(`[data-role="role-main-tbody"]`).append(`<tr>
                                            <th scope="row">${ count+1 }</th>
                                            <td>${ getCurrentDate() }</td>
                                            <td>${ key }</td>
                                            <td>${ value }</td>
                                            <td>{{ auth()->user()->name }}</td>
                                            <td >
                                                <a href="javascript:void(0)" data-id="${ d.data.id }" data-toggle="modal" data-target="#show_privileges"  data-role="show-privileges">
                                                    <span data-toggle="tooltip" data-title="Show privileges"><i class="fas fa-eye"></i></span>
                                                </a> 
                                                <a class="ml-2" href="javascript:void(0)" data-id="${ d.data.id }"   data-role="delete-role">
                                                    <span class="text-danger" data-toggle="tooltip" data-title="Delete role"><i class="fas fa-trash"></i></span>
                                                </a> 
                                            </td>
                                        </tr>`)
                    }
              
                },
                error: function(e){
                    console.error(e)
                },
                complete: function(){

                }
            })
        })


        $(document).on("click",`[data-role="add-privilege"]`,function(){
            let parent = $("#new_privilege"),
                key = parent.find(`[data-role="key"]`).val(),
                value = parent.find(`[data-role="value"]`).val();

            $.post({
                url: `/privileges/add`,
                data: {
                    _token: '{{ csrf_token() }}',
                    key,
                    value
                },
                success: function(d){
                    Swal.fire("",d.message,d.code === 201 ? "success" : "warning");
                    if(d.code === 201){
                        resetInputs();
                    }
              
                },
                error: function(e){
                    console.error(e)
                },
                complete: function(){

                }
            })
        })
    })
</script>