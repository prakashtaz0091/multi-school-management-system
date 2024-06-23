<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MSMS</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        .cover-img {

            img {
                width: 100%;

            }
        }

        .box-shadow {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        }
    </style>


</head>

<body class="bg-light">
    @if (session()->has('error'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto text-danger">Invalid Credentials</strong>
                    <small>just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}, {{ now()->toDayDateTimeString() }}
                </div>
            </div>
        </div>
    @endif


    <div class="container">
        <div class="row  d-flex align-items-center " style="height: 100vh;">
            <div class="col-sm-12 col-md-7 cover-img">
                <img src="{{ asset('images/cover.jpg') }}" alt="cover">
            </div>
            <div class=" col-sm-12 col-md-5 d-flex justify-content-center align-items-center px-4  ">
                <form action="{{ route('login') }}" method="POST" class="px-3 py-4 rounded box-shadow">
                    @csrf

                    <div class="row gy-3 overflow-hidden">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" name="email" id="username"
                                    placeholder="name@example.com">
                                <label for="email" class="form-label">Email</label>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}" name="password" id="password" value=""
                                    placeholder="Password">
                                <label for="password" class="form-label">Password</label>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn bsb-btn-xl btn-success py-3" type="submit">Log in
                                    now</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
