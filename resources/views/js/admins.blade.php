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