@extends("layouts.backend")

@section("content-header")
    <h1>Portfolyolar</h1>
@endsection

@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Portfolyolar</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            @if(can("admin.slider.create"))
                            <input type="submit" value="Yeni Ekle" class="btn btn-warning" id="newPortfolio">
                            @else
                                Yeni oluştur butonunu göremiyorsun çünkü yetkin yok
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr id="portfolioTableHeader">
                            <th>Portfolyo</th>
                            <th>Adı</th>
                            <th>İşlem</th>
                        </tr>

                        <tr id="newPortfolioTr" hidden="">
                            <form action="{{route("backend.portfolios.create")}}" method="post"
                                  enctype="multipart/form-data">

                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <td><input class="form-control" type="file" name="image" required></td>
                                <td><input class="form-control" type="text" name="name" required></td>
                                <td>
                                    <button type="submit" class="btn btn-success" id="portfolioCreate">Ekle</button>
                                </td>
                            </form>
                        </tr>


                        @foreach($portfolios as $portfolio)
                            <tr>
                                <td>{{$portfolio->image}}</td>
                                <td>{{$portfolio->name}}</td>
                                <td>
                                    @if(can("admin.slider.delete"))
                                    <button type="submit" class="btn btn-danger portfolioDelete"
                                            data-id="{{$portfolio->id}}">
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


        $("#newPortfolio").click(function () {

            $("#newPortfolioTr").show();
        })


        $(".portfolioDelete").click(function () {
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
                url: "{{route("backend.portfolios.delete")}}",
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