<!DOCTYPE html>
<html lang="en" {{ App::getLocale() == 'ar' ? 'dir=rtl' : '' }}>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}" />

    <!--- Style css -->
    @if (App::getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('css/frontend/loginstyle.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
            integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">


    @else
        <link rel="stylesheet" href="{{ asset('css/frontend/loginstyle.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    @endif
    @toastr_css
    <title>ZAKEM</title>
</head>

<body class="text-center bg-light">

    @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ URL::asset('DataTables/datatables.min.js') }}"></script>

    <script src="{{ URL::asset('js/script.js') }}"></script>
    @if (App::getLocale() == 'ar')
        <script src="{{ URL::asset('DataTables/rtlscript.js') }}"></script>
    @endif
    @toastr_js
    @toastr_render
    <script>
        $('.carousel'), carousel({
            interval: 6000,
            pause: 'hover'
        });
        // Get the current year for the copyright
        $('#year').text(new Date().getFullYear());
        $(document).ready(function() {
            // // image preview
            $(".image").change(function() {

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.image-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }

            });
        }); //end of ready
    </script>
</body>

</html>
