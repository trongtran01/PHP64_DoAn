<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanh toán thành công</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Varela Round', sans-serif;
        }
        .modal-confirm {
            color: #434e65;
            width: 525px;
            margin: 30px auto;
        }
        .modal-confirm .modal-content {
            padding: 20px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
        }
        .modal-confirm .modal-header {
            background: #cd2626;
            border-bottom: none;
            position: relative;
            text-align: center;
            margin: -20px -20px 0;
            border-radius: 5px 5px 0 0;
            padding: 35px;
        }
        .modal-confirm h4 {
            text-align: center;
            font-size: 36px;
            margin: 10px 0;
        }
        .modal-confirm .form-control, .modal-confirm .btn {
            min-height: 40px;
            border-radius: 3px;
        }
        .modal-confirm .close {
            position: absolute;
            top: 15px;
            right: 15px;
            color: #fff;
            text-shadow: none;
            opacity: 0.5;
        }
        .modal-confirm .close:hover {
            opacity: 0.8;
        }
        .modal-confirm .icon-box {
            color: #fff;
            width: 95px;
            height: 95px;
            display: inline-block;
            border-radius: 50%;
            z-index: 9;
            border: 5px solid #fff;
            padding: 15px;
            text-align: center;
        }
        .modal-confirm .icon-box i {
            font-size: 64px;
            margin: -4px 0 0 -4px;
        }
        .modal-confirm .btn {
            color: #fff;
            border-radius: 4px;
            background: #cd2626;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            border-radius: 30px;
            margin-top: 10px;
            padding: 6px 20px;
            border: none;
            line-height: 35px;
            margin-bottom: 20px;
        }
        .modal-confirm .btn:hover, .modal-confirm .btn:focus {
            background: #eda645;
            outline: none;
        }
        .modal-confirm .btn span {
            margin: 1px 3px 0;
            float: left;
        }
        .modal-confirm .btn i {
            margin-left: 1px;
            font-size: 20px;
            float: right;
        }
        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
    </style>
</head>
<body>
<div class="text-center">
    <!-- Button HTML (to Trigger Modal) -->
    <a href="#myModal" class="trigger-btn" data-toggle="modal" {{ url('/') }}"></a>
</div>

<!-- Modal HTML -->
<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-center">
                <h4>Chúc mừng!</h4>
                <p>Bạn đã mua hàng thành công.</p>
                @if(isset($order))
                    <a href="{{ route('order.view', ['order_id' => $order->id]) }}" class="btn btn-success">View Order Details <i class="material-icons">&#xE5C8;</i></a>
                @endif
                <a href="{{ url('/') }}" class="btn btn-info">Tiếp tục mua sắm</a>
                <p>Trở vê trang chủ sau <span id="countdown">5</span> giây</p>
            </div>

            <script>
                $(document).ready(function(){
                    $('#myModal').modal('show');

                    var seconds = 5;
                    var countdownElement = $('#countdown');

                    var countdownInterval = setInterval(function() {
                        seconds--;
                        countdownElement.text(seconds);
                        if (seconds <= 0) {
                            clearInterval(countdownInterval);
                            window.location.href = "{{ url('/') }}";
                        }
                    }, 1000); // Update every 1 second (1000 milliseconds)
                });
            </script>

        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#myModal').modal('show');
    });
</script>

</body>
</html>
