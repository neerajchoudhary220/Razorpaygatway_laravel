<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Test</title>
</head>

<body>
    <div class="conatiner p-3">
        <div class="row text-center d-flex justify-content-center">
            <div class="col-8">
                <form id="LoginForm">
                    <div class="card">
                        <div class="card-header bg-info text-light">
                            Login User
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="input-group">
                                        <span class="input-group-text text-light bg-success">Mobile Number</span>
                                        <input type="text" class="form-control" name="mobile">
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="input-group">
                                        <span class="input-group-text bg-success text-light">Password</span>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-info text-light btn-lg px-5" id="LoginBtn">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script>
                const welcomePageUrl ="{{route('web.welcome.page')}}";
            </script>
            <script src="{{asset('assets/js/website/forms/auth/login.js')}}"></script>
    </div>

</body>

</html>
