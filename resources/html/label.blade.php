{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--    <title>CloudVService</title>--}}

{{--    <!-- Fonts -->--}}

{{--</head>--}}
{{--<body>--}}

{{--<form action="{{route('labelCheckResults')}}" method="post" enctype="multipart/form-data">--}}
{{--    @csrf--}}
{{--    <h2>Add video</h2>--}}

{{--    <div>--}}
{{--        <input type="file" id="video" name="video" value="{{old('video')}}" required>--}}
{{--    </div>--}}


{{--    <button type="submit">Submit</button>--}}
{{--</form>--}}
{{--</body>--}}
{{--</html>--}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name = "viewport" content="width = device-width, initial-scale = 1.0">
    <meta http-equiv="X-UA-Compayible" content = "ie=edge">
    <title>Label Detection</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body style="background: #27383d">
<div class="container" style="background: #212f33">
    <div class = "d-md-flex flex-md-equal w-100 my-md-3 pl-md-3 row justify-content-center">
        <div class=" text-center py-1 px-3 float-left mw-25" >

            <form class="form" action="{{route('labelCheckResults')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class = "custom-file">
                    <input type="file" class="custom-file-input" name="video" id = "video" value="{{old('video')}}" required>
                    <label class="custom-file-label text-left" for="video">Choose file</label>
                </div>
                <button class = "btn btn-dark btn-block text-center" type = "submit">Submit</button>

            </form>
        </div>
    </div>
</div>
</body>
</html>

