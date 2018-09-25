@extends("layouts.backend")

@section("content-header")
    <h1>Rol Grupları</h1>
@endsection

@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Rol Grupları</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            {{--@if(can("admin.slider.create"))--}}
                            <a href="{{route("backend.rolegroups.create")}}" class="btn btn-warning" id="newPortfolio">Yeni Ekle</a>
                            {{--@else
                                Yeni oluştur butonunu göremiyorsun çünkü yetkin yok
                            @endif--}}
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr id="portfolioTableHeader">
                            <th>Rol</th>
                            <th>Slug</th>
                            <th>İşlem</th>
                        </tr>

                        <tr id="newPortfolioTr" hidden="">
                            <form action="{{route("backend.portfolios.create")}}" method="post"
                                  enctype="multipart/form-data">

                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <td><input class="form-control" type="text" name="name" required></td>
                                <td><input class="form-control" type="text" name="slug" required></td>
                                <td>
                                    <button type="submit" class="btn btn-success" id="Create">Ekle</button>
                                </td>
                            </form>
                        </tr>


                        @foreach($rolegroups as $group)
                            <tr>
                                <td>{{$group->name}}</td>
                                <td>{{$group->slug}}</td>
                                <td>
                                    {{-- @if(can("admin.slider.delete")) --}}
                                    <button type="submit" class="btn btn-danger Delete"
                                            data-id="{{$group->id}}">
                                        Sil
                                    </button>
                                    <a class="btn btn-primary"
                                       href="{{route("backend.rolegroups.editShow", ["id" => $group->id])}}">Düzenle</a>

                                    {{--@else
                                        Sil butonunu göremiyorsun çünkü yetkin yok
                                    @endif--}}
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


        $(".Delete").click(function () {
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
                url: "{{route("backend.rolegroups.delete")}}",
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

                        console.log(response);
                    }

                    console.log(response);
                },

                error: function (response) {

                    swal.close();

                    swal({
                        type: "error",
                        title: "Hata oluştu!",
                        text: "Lütfen formu kontrol edin!"
                    });
                    console.log(response)
                }
            })
        });

    </script>
@endpush

@push("customCss")
@endpush