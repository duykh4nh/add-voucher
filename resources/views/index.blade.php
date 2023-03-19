<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Shopee</title>
</head>
<style>
    #voucher-list-today {
        display: none;
    }
</style>
<body>
    <form action="/store" method="post">
        @csrf
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <button type="button" class="btn btn-warning btn-lg border border-secondary rounded-pill mx-2" id="pass">Get</button>
            <button type="submit"
                class="btn btn-success btn-lg border border-secondary rounded-pill mx-2" id="save">Save</button>
        </div>
        {{-- <div class="text-center">
            <button type="submit" class="btn btn-outline-danger" id="save">Save</button>
        </div>
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <button type="button" class="btn btn-outline-success" id="pass">Pass</button>
                </div>
            </div>
        </div> --}}
        <div class="show-data_parent" style="display:none">
            <textarea id="show-data" name="pass-data" rows="40" cols="200"></textarea>
        </div>
        <div>{{ $dataAPI ?? null }}</div>
    </form>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        console.log("document loaded");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#pass").click(function() {
            event.preventDefault();
            var arrVC = [];
            var bc_voucher_button = document.querySelectorAll(".bc_voucher_button");
            for (var value of bc_voucher_button) {
                arrVC.push(value.dataset.code);
            }
            function unique(array) {
                return array.filter(function(el, index, arr) {
                    return index == arr.indexOf(el);
                });
            }
            let uniqueArray = unique(arrVC);

            if (true) {
                $('#show-data').append(uniqueArray + '\n');
            }
            // alert(uniqueArray);
            console.log(uniqueArray);
            alert(uniqueArray);
            $('.save').removeAttr('disabled');
        });
    });
</script>

</html>
