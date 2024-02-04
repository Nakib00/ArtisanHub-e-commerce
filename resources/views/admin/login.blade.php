<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session::get('error')}}
                    </div>
                    @endif
                    <div class="card-header">
                        <h3 class="text-center">Admin Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.login')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
