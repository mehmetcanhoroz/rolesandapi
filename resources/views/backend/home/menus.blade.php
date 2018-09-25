@extends("layouts.backend")

@section("content-header")
    <h1>Menüler</h1>
@endsection

@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Site Menüleri</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            @if(can("admin.menu.create"))
                                <input type="submit" value="Yeni Ekle" class="btn btn-warning" id="newMenu">
                            @else
                                Yeni oluştur butonunu göremiyorsun çünkü yetkin yok
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr id="menuTableHeader">
                            <th>Ad</th>
                            <th>Link</th>
                            <th>İşlem</th>
                        </tr>

                        @foreach($menus as $menu)
                            <tr>
                                <td><input type="text" class="form-control " value="{{$menu->name}}" name="name"></td>
                                <td><input type="text" class="form-control " value="{{$menu->link}}" name="link"></td>
                                <td>
                                    @if(can("admin.menu.delete"))
                                    <button type="submit" class="btn btn-danger menuDelete" data-id="{{$menu->id}}">
                                        Sil
                                    </button>
                                    @else
                                        Sil butonunu göremiyorsun çünkü yetkin yok
                                    @endif
                                </td>

                            </tr>
                        @endforeach

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection

@push("customJs")
    <script>
        {{--$(".menuInput").on("change", function () {
            var input = $(this);
            $.ajax({
                type: "post",
                url: "{{route("backend.settings.create")}}",
                data: {
                    _token: "{{csrf_token()}}",
                    key: input.attr("name"),
                    value: input.val()
                },

                success: function (response) {

                    console.log(response);

                },

                error: function (response) {

                    console.log(response);
                }

            });
        })--}}

        $("#newMenu").click(function () {
            var data = "<tr>\n" +
                "<td><input class=\"form-control\" type=\"text\" name=\"name\" id='newSettingKey'></td>\n" +
                "<td><input class=\"form-control\" type=\"text\" name=\"link\" id='newSettingValue'> </td>\n" +
                "</tr>"
            $("#menuTableHeader").after(data);
        })

        $(document).on("change", "#newSettingKey", function () {
            if ($(this).val().length > 3 && $("#newSettingValue").val().length > 3) {
                newSetting()
            }
        });

        $(document).on("change", "#newSettingValue", function () {
            if ($(this).val().length > 3 && $("#newSettingKey").val().length > 3) {
                newSetting()
            }
        })

        function newSetting() {
            var key = $("#newSettingKey").val();
            var value = $("#newSettingValue").val();

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

            $.ajax({
                type: "post",
                url: "{{route("backend.menus.create")}}",
                data: {
                    _token: "{{csrf_token()}}",
                    name: key,
                    link: value
                },

                success: function (response) {
                    if (response.status == "success") {

                        swal.close();

                        swal({
                            type: response.status,
                            title: response.title,
                            text: response.message,
                        }).then(() => {
                            location.reload();
                        });
                    }

                    console.log(response);
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
            })
        }


        $(".menuDelete").click(function () {
            var button = $(this);


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


            $.ajax({
                type: "post",
                url: "{{route("backend.menus.delete")}}",
                data: {
                    _token: "{{csrf_token()}}",
                    id: button.data("id")
                },

                success: function (response) {
                    if (response.status == "success") {
                        button.closest("tr").remove();

                        swal.close();

                        swal({
                            type: response.status,
                            title: response.title,
                            text: response.message,
                        });
                    }

                    console.log(response);
                },

                error: function (response) {
                    console.log(response);

                    swal.close();

                    swal({
                        type: "error",
                        title: "Hata oluştu!",
                        text: "Lütfen formu kontrol edin!"
                    });
                }
            })
        });

    </script>
@endpush

@push("customCss")
@endpush