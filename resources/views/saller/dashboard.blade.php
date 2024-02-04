<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard {
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 dashboard">
                @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{session::get('error')}}
                </div>
                @endif
                <h2>Welcome Saller</h2>
                <!-- show admin name as database -->
                <p>You are logged in as: <strong>{{ Auth::guard('sallers')->user()->name }}</strong></p>
                <a href="{{route('admin.logout')}}" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
