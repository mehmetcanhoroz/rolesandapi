@extends("layouts.backend")

@section("content")
    <div class="row">
        <!-- right column -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Rol Grubu Oluştur</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Ad</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name"
                                       value="@if($rolegroup->name){{$rolegroup->name}}@endif" name="name"
                                       placeholder="Adı">
                            </div>
                        </div>

                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$rolegroup->id}}">

                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Slug</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="slug"
                                       value="@if($rolegroup->slug){{$rolegroup->slug}}@endif" name="slug"
                                       placeholder="Slug">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Roller</label>

                                <div class="col-sm-10">
                                    @foreach($roles as $role)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="roles[]"
                                                       @if(isset($rolegroup) && !empty($rolegroup->roles->where("id",$role->id)->first())){{"checked"}}@endif value="{{$role->id}}">
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{route("backend.rolegroups.show")}}" class="btn btn-default">İptal</a>
                        <button type="button" class="btn btn-info pull-right" id="save">Güncelle</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
@endsection

@push("customJs")

    <script>
        $("#save").click(function () {
            $(".has-error").removeClass("has-error");
            $(".label-danger").remove();

            swal({
                title: 'Yükleniyor...',
                html:
                '<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>' +
                ' <span class="sr-only">Loading...</span>',
                closeModel: false,
                closeOnEsc: false,
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false
            });

            var form = $("#form").serialize();
            $.ajax({
                type: "post",
                url: "{{route("backend.rolegroups.edit")}}",
                data: form,
                success: function (response) {
                    console.log(response);

                    swal.close();

                    swal({
                        type: response.status,
                        title: response.title,
                        text: response.message,
                    }).then(() => {

                        location.href = "{{route("backend.rolegroups.show")}}";
                    });
                },
                error: function (response) {
                    swal.close();

                    $.each(response.responseJSON.errors, function (k, v) {
                        $.each(v, function (kk, vv) {
                            $("[name='" + k + "']").parent().addClass("has-error");
                            $("[name='" + k + "']").parent().append(" <span class=\"label label-danger\">" + vv + "</span>");
                        })
                    });

                    swal({
                        type: "error",
                        title: "Hata oluştu!",
                        text: "Lütfen formu kontrol edin!"
                    });

                    console.log(response);
                }
            });
        });
    </script>
@endpush
@push("customCss")
@endpush