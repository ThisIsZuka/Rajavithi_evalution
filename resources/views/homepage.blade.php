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

    {{-- Snakebar css --}}
    <link rel="stylesheet" href="{{ URL::asset('') }}public/assets/SnackBar-master/dist/snackbar.min.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="{{ URL::asset('') }}public/assets/bootstrap/dist/js/bootstrap.min.js"></script>

    {{-- Jquery --}}
    <script src="{{ URL::asset('') }}public/assets/jquery-3.5.1.min.js"></script>

    {{-- Rating --}}
    <script src="{{ URL::asset('') }}public/assets/auxiliary-rater/rater.js" charset="utf-8"></script>

    {{-- Snakebar JS --}}
    <script src="{{ URL::asset('') }}public/assets/SnackBar-master/dist/snackbar.min.js"></script>

</head>

<body>
    <div>
        @include ('component.header')
    </div>

    <div class="container mt-3">
        <div class="card">
            <div class="card-body">

                <h3 class="text-center mb-5">กรุณาประเมินความพึงพอใจในการปฎิบัติงานเจ้าหน้าที่เวรเปล</h3>

                <div class="mb-4">
                    <h5>1.ความพึงพอใจในการปฎิบัติงานเจ้าหน้าที่เวรเปลตรงต่อเวลา</h5>
                    <div id="Rating_1">
                        <div class="rate2"></div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5>2.ความพึงพอใจในการปฎิบัติงานเจ้าหน้าที่ถูกต้อง แม่นยำ</h5>
                    <div id="Rating_2">
                        <div class="rate2"></div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5>3.ความพึงพอใจต่อการใช้ระบบการจองเปล</h5>
                    <div id="Rating_3">
                        <div class="rate2"></div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="button" id="btn_submit" class="btn btn-info btn-lg">ส่งผลการประเมิน</button>
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

        var ans_1 = 0;
        var ans_2 = 0;
        var ans_3 = 0;

        var options = {
            max_value: 5,
            step_size: 1,
        }
        $(".rate2").rate(options);


        $(".rate2").rate(options);

        $(".rate2").on("updateError", function (ev, jxhr, msg, err) {
            console.log("This is a custom error event");
        });

        $("#Rating_1 .rate2").on("change", function (ev, data) {
            console.log(data, data.to);
        });

        $("#Rating_2 .rate2").on("change", function (ev, data) {
            console.log(data, data.to);
        });

        $("#Rating_3 .rate2").on("change", function (ev, data) {
            console.log(data, data.to);
        });


        $('#btn_submit').click(function () {
            // alert(ans_1+"||"+ans_2+"||"+ans_3)
            ans_1 = $("#Rating_1 .rate2").rate("getValue");
            ans_2 = $("#Rating_2 .rate2").rate("getValue");
            ans_3 = $("#Rating_3 .rate2").rate("getValue");
            if (ans_1 == 0 || ans_2 == 0 || ans_3 == 0) {
                Snackbar.show({
                    actionText: 'close',
                    pos: 'top-center',
                    actionTextColor: '#ff0000',
                    backgroundColor: '#323232',
                    width: 'auto',
                    text: 'กรุณาให้คะแนนประเมินความพึงพอใจ'
                });
                return false;
            }
            $.ajax({
                type: "POST",
                url: "save_report",
                cache: false,
                data: {
                    ans_1: ans_1,
                    ans_2: ans_2,
                    ans_3: ans_3
                },
                success: function (data) {
                    $("#Rating_1 .rate2").rate("setValue", 0);
                    $("#Rating_2 .rate2").rate("setValue", 0);
                    $("#Rating_3 .rate2").rate("setValue", 0);
                    Snackbar.show({
                        actionText: 'close',
                        pos: 'top-center',
                        actionTextColor: '#4CAF50',
                        backgroundColor: '#323232',
                        width: 'auto',
                        text: 'บันทึกการประเมินความพึงพอใจเรียบร้อยแล้ว'
                    });
                }
            });
        });

    });

</script>
