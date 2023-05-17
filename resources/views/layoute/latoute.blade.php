<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Layoute</title>
    <link rel="apple-touch-icon" href="{{ asset('Assets/image/logo_rounded.png') }}">
    <link rel="stylesheet" href="{{ asset('Assets/css/dycalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/css/basedStayle.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/css/popupStyle.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
    integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />

    <link href="https://repo.rachmat.id/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="https://repo.rachmat.id/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="https://repo.rachmat.id/jquery-ui-1.12.1/jquery-ui.js"></script>
</head>
<body>

    <div class="container-content">
        {{-- sidebar   --}}

      @include('layoute.sidebar')
        {{--  end sidebar  --}}
        <div class="main-content">
            {{-- navbar   --}}
           @include('layoute.navbar')
            {{-- end navbar  --}}

            {{--  content  --}}
           @yield('content')
            {{--  end content  --}}
        </div>
    </div>

    <script src="{{ asset('Assets/javascript/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('Assets/javascript/.js') }}"></script>
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
    integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    ></script>
    @yield('script')
</body>
</html>
