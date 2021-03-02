<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Table</title>
</head>
<body  style="background: #27383d">
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
<div style="margin-top: 103px;" class="row justify-content-center">
    <div class="col-md-6">
        <table class="table table-striped table-dark table-borderless table-hover">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Name</th>
                <th scope="col">Time, sec</th>
                <th scope="col">Confidence, %</th>
            </tr>
            </thead>
            <tbody>
            @php
            $k = 1;
            @endphp
            @foreach($items as $item)
            <tr>
                <th scope="row">{{$k}}</th>
                <td>{{$item['Label']['Name']}}</td>
                <td>{{$item['Timestamp']}}</td>
                <td>{{$item['Label']['Confidence']}}</td>
            </tr>
            @php
                $k++;
            @endphp
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
-->
</body>
</html>
