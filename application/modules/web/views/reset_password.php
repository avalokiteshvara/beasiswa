<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>CodePen - Bootstrap 5 verify OTP with validation form inputs</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css'>

    <style>
        .height-100 {
            height: 100vh
        }

        .card {
            width: 400px;
            border: none;
            height: 300px;
            box-shadow: 0px 5px 20px 0px #d2dae3;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center
        }

        .card h6 {
            color: red;
            font-size: 20px
        }

        .inputs input {
            width: 40px;
            height: 40px
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0
        }

        .card-2 {
            background-color: #fff;
            padding: 10px;
            width: 350px;
            height: 100px;
            bottom: -50px;
            left: 20px;
            position: absolute;
            border-radius: 5px
        }

        .card-2 .content {
            margin-top: 50px
        }

        .card-2 .content a {
            color: red
        }

        .form-control:focus {
            box-shadow: none;
            border: 2px solid red
        }

        .validate {
            border-radius: 20px;
            height: 40px;
            background-color: red;
            border: 1px solid red;
            width: 140px
        }
    </style>
</head>

<body translate="no">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="position-relative">
            <div class="card p-2 text-center">
                <h6>Silahkan masukkan Password baru</h6>

                <form role="form" name="form-reset" action="" method="POST">
                    <div class="mb-3">
                        <label for="new_pass" class="form-label">Password baru</label>
                        <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="Masukkan Password baru" required>
                    </div>
                    <div class="mb-3">
                        <label for="repeat_pass" class="form-label">Ulangi Password</label>
                        <input type="password" class="form-control" id="repeat_pass" name="repeat_pass" placeholder="Ulangi Password" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Reset</button>
                </form>

            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $('#form-reset').submit(function() {
            var new_pass = $('#new_pass').val().trim();
            var pass_repeat = $('#repeat_pass').val().trim();

            if (new_pass == '' || repeat_pass == '') {
                alert('Password tidak boleh kosong');
                return false;
            } else {
                if (new_pass != pass_repeat) {
                    alert('password tidak sama!');
                    return false;
                }
            }
        })
    </script>
</body>

</html>