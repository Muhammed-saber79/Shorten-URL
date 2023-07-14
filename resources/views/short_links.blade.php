<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h3 class="my-3 text-center">Short Links Website</h3>
        <div class="row my-5">
            @if ($errors->has('link'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ $errors->first('link') }}
                </div>
                
                <script>
                    var alertList = document.querySelectorAll('.alert');
                    alertList.forEach(function (alert) {
                        new bootstrap.Alert(alert)
                    })
                </script>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
                </div>
                
                <script>
                    var alertList = document.querySelectorAll('.alert');
                    alertList.forEach(function (alert) {
                        new bootstrap.Alert(alert)
                    })
                </script>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('danger') }}
                </div>
                
                <script>
                    var alertList = document.querySelectorAll('.alert');
                    alertList.forEach(function (alert) {
                        new bootstrap.Alert(alert)
                    })
                </script>
            @endif
            
            <div class="card my-3">
                <div class="card-header">
                    <form action="{{ route('generate') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="link" class="form-control" placeholder="Enter your link">
                            <button class="btn btn-outline-success">Generate</button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Original Link</th>
                                    <th scope="col">Shorten Link</th>
                                    <th scope="col">Visits</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>    
                            <tbody>
                                @foreach ($short_links as $row)
                                    <tr class="">
                                        <td scope="row">{{ $row->link }}</td>
                                        <td>
                                            <a href="{{ route('show.shorten.link', $row->code) }}">
                                            {{ url('') . '/' . $row->code }}
                                            </a>
                                        </td>
                                        <td>{{ $row->visit_count }}</td>
                                        <td>
                                            <form action="{{ route('delete.link', $row->code) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $short_links->links() !!}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>