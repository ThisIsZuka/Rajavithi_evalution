<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- add icon link -->
    <link rel="icon" href="{{ URL::asset('') }}public/assets/Image/title_logo.png" type="image/x-icon">
    <title>Document</title>

    {{-- Library --}}
    <link rel="stylesheet" href="{{ URL::asset('') }}public/assets/css/homepage.css">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">

    {{-- Bootstrap --}}
    <link href="{{ URL::asset('') }}public/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ URL::asset('') }}public/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="{{ URL::asset('') }}public/assets/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="{{ URL::asset('') }}public/assets/jquery-3.5.1.min.js"></script>
</head>

<body>
    <div>
        @include ('component.header')
    </div>

    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center mb-5">ผลการประเมินความพึงพอใจในการปฎิบัติงานเจ้าหน้าที่เวรเปล</h4>
                <div class="container">
                    <div class="text-right">
                        <h5 id="num_count">จำนวนผู้ประเมิน</h5>
                    </div>

                    <table class="table table-striped table-responsive">
                        <thead class="">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">หัวข้อ</th>
                                <th scope="col">ค่าเฉลี่ยผลการประเมิน</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th scope="col">1</th>
                                <th scope="col">ความพึงพอใจในการปฎิบัติงานเจ้าหน้าที่เวรเปลตรงต่อเวลา</th>
                                <th scope="col" id="data_1"></th>
                            </tr>
                            <tr>
                                <th scope="col">2</th>
                                <th scope="col">ความพึงพอใจในการปฎิบัติงานเจ้าหน้าที่ถูกต้อง แม่นยำ</th>
                                <th scope="col" id="data_2"></th>
                            </tr>
                            <tr>
                                <th scope="col">3</th>
                                <th scope="col">ความพึงพอใจต่อการใช้ระบบการจองเปล</th>
                                <th scope="col" id="data_3"></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        list_data();

        function list_data() {
            $.ajax({
                type: "POST",
                url: "get_report",
                cache: false,
                dataType: 'json',
                success: function (data) {
                    var count_1 = 0;
                    var count_2 = 0;
                    var count_3 = 0;
                    $('#num_count').text('จำนวนผู้ประเมิน ' + data.length + ' คน')
                    console.log(data)
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            count_1 += parseInt(data[i].data_1)
                            count_2 += parseInt(data[i].data_2)
                            count_3 += parseInt(data[i].data_3)
                        }
                        $('#data_1').text((count_1 / parseInt(data.length)).toFixed(2))
                        $('#data_2').text((count_2 / parseInt(data.length)).toFixed(2))
                        $('#data_3').text((count_3 / parseInt(data.length)).toFixed(2))
                    }
                }
            });
        }

    });

</script>
