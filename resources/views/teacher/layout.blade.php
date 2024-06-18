<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MSMS | Teacher </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- bootstrap fonts --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        .navbar-brand {
            display: flex;
            align-items: center;
            line-height: 1.5rem;

            img {
                height: 50px;
                width: 50px;
                border-radius: 50%;
                margin-right: 10px;
                object-fit: cover;
            }
        }



        .logout-btn {
            padding-top: 0;

            i {
                margin: 0;
                padding: 0;
                font-size: 1.5rem;
            }
        }

        @media screen and (max-width: 576px) {
            .navbar-brand {
                font-size: 0.8rem;

                line-height: 0.8rem;

                img {
                    height: 40px;
                    width: 40px;
                }
            }

            .logout-btn {
                margin-top: 0.5rem;

                i {

                    font-size: 1rem;
                }
            }

            .navbar-toggler-icon {
                font-size: 0.9rem;
            }
        }
    </style>

    @yield('internal-css')

</head>

<body>


    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('storage/' . $teacher->image) }}" alt="Logo"
                    class="d-inline-block align-text-top">
                <div class='d-flex flex-column'>
                    <div>
                        <strong>
                            {{ $teacher->name }}
                        </strong>
                    </div>
                    <div>
                        <small>
                            {{ $teacher->school->name }}
                        </small>
                    </div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-sm-none d-lg-flex justify-content-end " id="navbarNavDropdown">
                <ul class="navbar-nav me-3">

                    <li class="nav-item">
                        <a class="nav-link" href="#">Attendence</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Marks Entry</a>
                    </li>

                </ul>
                <a href="{{ route('logout') }}" class="btn btn-danger logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                </a>

            </div>
        </div>
    </nav>


    @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
