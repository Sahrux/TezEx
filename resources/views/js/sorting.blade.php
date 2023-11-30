<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
<script>
    $(function(){
        $(`[data-toggle="tooltip"]`).tooltip();
        const branch_counter = {};
        $(document).on("keyup",`[data-role="tracking-id"]`,function(e){
            let elem = $(this);
            if (e.keyCode === 13) {
                let id = $(this).val();
                $.get({
                    url: `/packs/${id}/get-by-tracking-id`,
                    success: function(d){
                        if(d.code === 200){
                            let branch_id = d.data.branch_id;
                            branch_counter[branch_id] = branch_counter[branch_id] ? branch_counter[branch_id] + 1 : 1;
                           
                            let link = $(`[data-toggle="tab"][data-id="${branch_id}"]`);
                            let link_h = link.data("value") + `(${branch_counter[branch_id]})`;
                            link.text(link_h)
                            $(`tbody[data-id="${branch_id}"]`).append(`<tr>
                                                                            <td ><span data-toggle="tooltip" data-placement="right" data-title="Customer">${d.data.customer.name}</span></td>
                                                                            <td ><span data-toggle="tooltip" data-placement="right" data-title="Category">${d.data.category.value}</span></td>
                                                                            <td ><span data-toggle="tooltip" data-placement="right" data-title="Type">${d.data.type.value}</span></td>
                                                                            <td ><span data-toggle="tooltip" data-placement="right" data-title="Added date">${d.data.created_at}</span></td>
                                                                        </tr>`);
                            $(`[data-toggle="tooltip"]`).tooltip();
                            elem.val("").change();                                            
                        }else if(d.code === 400){
                            Swal.fire("",d.message,"warning");
                        }
                    },
                    error: function(e){
                        console.error(e);
                    }

                })
            }
    
        })

        $(document).on("click",`[data-role="make-sack"]`,function(e){
            $.post({
                url: `/sorting/make-sack`,
                data: {_token: '{{ csrf_token() }}'},
                success: function(d){
                    Swal.fire("",d.message,d.code === 201 ? "success" : "warning")
                    if(d.code === 201){
                        $(`.tab-pane`).each(function(){
                            $(this).find(`tbody`).html("");
                        })
                        $(`a[data-toggle="tab"]`).each(function(){
                            $(this).html($(this).data("value"));
                        })
                    }
                },
                error: function(e){
                    console.error(e);
                }

            })
        })
    })
</script>