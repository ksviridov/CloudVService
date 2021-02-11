<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CloudVService</title>

    <!-- Fonts -->

</head>
<body>

<form action="{{route('api-result')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h2>Enter video name</h2>

    <div>
        <label for="name">Video name</label><input type="text" id="name" name="name" value="{{old('name')}}" required>
    </div>


    <button type="submit">Get Result</button>
</form>
</body>
</html>
