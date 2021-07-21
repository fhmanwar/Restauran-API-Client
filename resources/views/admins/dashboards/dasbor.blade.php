@extends('admins.layouts.main')
@section('title','Dashboard')
@section('head-title','Welcome to Dashboard')

@section('style')
<style>
    /* amChart */
    .amChart {
        width: 100%;
        max-height: 600px;
        height: 100vh;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body ">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Visitors</p>
                            <h4 class="card-title" id="customer"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-user-cog"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Staff</p>
                            <h4 class="card-title" id="staff"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="far fa-chart-bar"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Penjualan</p>
                            <h4 class="card-title" id="sale"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                            <i class="far fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Order</p>
                            <h4 class="card-title" id="order"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Product Statistics</div>
            </div>
            <div class="card-body">
                <div class="amChart" id="pieProduct"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Top Products</div>
            </div>
            <div class="card-body pb-0">
                @foreach ($product as $row)
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="{{ url('img/product/'.$row->gambar_masakan) }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ml-2">
                            <h5 class="fw-bold mb-1">{{ $row->nama_masakan }}</h5>
                            <small class="text-muted">Stok Tersedia {{ $row->stok }}</small>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <h3 class="text-info fw-bold">@Rp {{ number_format($row->harga, 2, '.', ',') }}</h3>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function () {
       $.ajax({
           type: 'get',
           url: '/api/chart/count'
       }).then((res) => {
            var data = res.data;
            $('#customer').text(data.customer);
            $('#staff').text(data.staff);
            $('#sale').text(function () {
                num = data.sale;
                var formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                return formatter.format(num);
            });
            $('#order').text(data.order);
       });

       $.ajax({
           type: 'get',
           url: '/api/chart'
       }).then((res) => {
            var data = res.data;
            $('#customer').text(data.customer);
            $('#staff').text(data.staff);
            $('#sale').text(function () {
                num = data.sale;
                var formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                return formatter.format(num);
            });
            $('#order').text(data.order);
       });
    });

    function currencyFormat(num) {
       return 'Rp. ' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    am4core.useTheme(am4themes_animated);

    var PieProduct = am4core.createFromConfig({
        "innerRadius": "50%",

        "dataSource": {
            "url": "/api/chart",
            "parser": {
                "type": "JSONParser",
            },
        },

        "exporting": {
            "menu": {
                "items": [{
                    "label": "...",
                    "menu": [
                        {
                            "label": "Image",
                            "menu": [
                                { "type": "png", "label": "PNG" },
                                { "type": "jpg", "label": "JPG" },
                                { "type": "pdf", "label": "PDF" }
                            ]
                        }, {
                            "label": "Data",
                            "menu": [
                                { "type": "json", "label": "JSON" },
                                { "type": "csv", "label": "CSV" },
                                { "type": "xlsx", "label": "XLSX" },
                                { "type": "html", "label": "HTML" },
                                { "type": "pdfdata", "label": "PDF Data" }
                            ]
                        }, {
                            "label": "Print", "type": "print"
                        }
                    ]
                }]
            },
            "filePrefix": "Pie_Chart_User_Department-" + moment().format("DD-MM-YYYY"),
        },

        // Create series
        "series": [{
            "type": "PieSeries",
            "dataFields": {
                "value": "Quantity",
                "category": "nama_masakan",
            },
            "slices": {
                "cornerRadius": 10,
                "innerCornerRadius": 7
            },
            "hiddenState": {
                "properties": {
                    // this creates initial animation
                    "opacity": 1,
                    "endAngle": -90,
                    "startAngle": -90
                }
            },
            "children": [{
                "type": "Label",
                "forceCreate": true,
                "text": "Product",
                "horizontalCenter": "middle",
                "verticalCenter": "middle",
                "fontSize": 26
            }]
        }],

        // Add legend
        "legend": {},

    }, "pieProduct", am4charts.PieChart);
</script>
@endsection
