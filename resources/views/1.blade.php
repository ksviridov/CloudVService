<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name = "viewport" content="width = device-width, initial-scale = 1.0">
    <meta http-equiv="X-UA-Compayible" content = "ie=edge">
    <title> Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body style="background: #27383d">
<div class="container" style="background: #212f33">
    <div class = "d-md-flex flex-md-equal w-100 my-md-3 pl-md-3 row justify-content-center">
        <div class=" text-center py-1 px-3 float-left mw-25" >

            <div class="mb-3 mt-3">
            @csrf
                <h2 class="font-weight-bold text-white bg-dark mb-3" style="font-weight: 300">Upload video</h2>

                <div class="form-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file_input" id="file_input" oninput="input_filename();">
                        <label id="file_input_label" class="custom-file-label" for="image">Select file</label>
                    </div>
                </div>

                <button onclick="upload('{{route('labelCheckResults')}}');" id="upload_btn" class="btn btn-dark">Upload</button>

                <button class="btn btn-dark d-none" id="loading_btn" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Uploading...
                </button>

                <button type="button" id="cancel_btn" class="btn btn-secondary d-none">Cancel upload</button>

            </div>

            <div id="progress_wrapper" class="d-none">
                <label id="progress_status"></label>
                <div class="progress mb-3">
                    <div id="progress" class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div id="alert_wrapper"></div>
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
            @if(isset($items))
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
            @endif
        </table>

    </div>
</div>
<script>
    var progress = document.getElementById("progress");
    var progress_wrapper = document.getElementById("progress_wrapper");
    var progress_status = document.getElementById("progress_status");

    // Get a reference to the 3 buttons
    var upload_btn = document.getElementById("upload_btn");
    var loading_btn = document.getElementById("loading_btn");
    var cancel_btn = document.getElementById("cancel_btn");

    // Get a reference to the alert wrapper
    var alert_wrapper = document.getElementById("alert_wrapper");

    // Get a reference to the file input element & input label
    var input = document.getElementById("file_input");
    var file_input_label = document.getElementById("file_input_label");

    // Function to show alerts
    function show_alert(message, alert) {

        alert_wrapper.innerHTML = `
    <div id="alert" class="alert alert-${alert} alert-dismissible fade show" role="alert">
      <span>${message}</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  `

    }

    // Function to upload file
    function upload(url) {

        // Reject if the file input is empty & throw alert
        if (!input.value) {

            show_alert("No file selected", "warning")

            return;

        }

        // Create a new FormData instance
        var data = new FormData();

        // Create a XMLHTTPRequest instance
        var request = new XMLHttpRequest();

        // Set the response type
        request.responseType = "json";

        // Clear any existing alerts
        alert_wrapper.innerHTML = "";

        // Disable the input during upload
        input.disabled = true;

        // Hide the upload button
        upload_btn.classList.add("d-none");

        // Show the loading button
        loading_btn.classList.remove("d-none");

        // Show the cancel button
        cancel_btn.classList.remove("d-none");

        // Show the progress bar
        progress_wrapper.classList.remove("d-none");

        // Get a reference to the file
        var file = input.files[0];

        // Get a reference to the filename
        var filename = file.name;

        // Get a reference to the filesize & set a cookie
        var filesize = file.size;
        document.cookie = `filesize=${filesize}`;

        // Append the file to the FormData instance
        data.append("file", file);

        // request progress handler
        request.upload.addEventListener("progress", function (e) {

            // Get the loaded amount and total filesize (bytes)
            var loaded = e.loaded;
            var total = e.total

            // Calculate percent uploaded
            var percent_complete = (loaded / total) * 100;

            // Update the progress text and progress bar
            progress.setAttribute("style", `width: ${Math.floor(percent_complete)}%`);
            progress_status.innerText = `${Math.floor(percent_complete)}% uploaded`;

        })

        // request load handler (transfer complete)
        request.addEventListener("load", function (e) {

            if (request.status == 200) {

                show_alert(`${request.response.message}`, "success");

            }
            else {

                show_alert(`Error uploading file`, "danger");

            }

            reset();

        });

        // request error handler
        request.addEventListener("error", function (e) {

            reset();

            show_alert(`Error uploading file`, "warning");

        });

        // request abort handler
        request.addEventListener("abort", function (e) {

            reset();

            show_alert(`Upload cancelled`, "primary");

        });

        // Open and send the request
        request.open("post", url);
        request.send(data);

        cancel_btn.addEventListener("click", function () {

            request.abort();

        })

    }

    // Function to update the input placeholder
    function input_filename() {

        file_input_label.innerText = input.files[0].name;

    }

    // Function to reset the page
    function reset() {

        // Clear the input
        input.value = null;

        // Hide the cancel button
        cancel_btn.classList.add("d-none");

        // Reset the input element
        input.disabled = false;

        // Show the upload button
        upload_btn.classList.remove("d-none");

        // Hide the loading button
        loading_btn.classList.add("d-none");

        // Hide the progress bar
        progress_wrapper.classList.add("d-none");

        // Reset the progress bar state
        progress.setAttribute("style", `width: 0%`);

        // Reset the input placeholder
        file_input_label.innerText = "Select file";

    }
</script>
</body>
</html>
