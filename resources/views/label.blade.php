<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CloudVService</title>

    <!-- Fonts -->

</head>
<body>

<form action="{{route('labelCheckResults')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h2>Add video</h2>

    <div>
        <input type="file" id="video" name="video" value="{{old('video')}}" required>
    </div>


    <button type="submit">Submit</button>
</form>
</body>
</html>
