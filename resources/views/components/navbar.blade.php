
<div id="navbar">

    <nav >
        <div class="container-xl ">

            <div id="links"></div>


            <div class="row">
                <div class="col-12 d-none">

                    <a class="ofcan-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                        aria-controls="offcanvasExample">

                        <div class="menue-btn">
                            <div class="menue-btn-burger"></div>
                        </div>
                    </a>

                </div>
                <div class="col-sm-4 d-sm-flex justify-content-sm-center col-lg-2 col-md-4 d-md-flex justify-content-md-center ">
                    <div class="mt-1">
                        <a class="navbar-brand font-weight-bolder" href="{{ route('home') }}">CairoSouth</a>
                    </div>


                </div>

                <div class="col-lg-3 col-sm-6 col-md-6  ">
                    <div class=" form-group mt-1">
                        <form class="form-inline">
                            <input class="mr-sm-2 search form-control" type="text" formControlName="search"
                                aria-label="Search">
                            <button type="submit" class="form-control searchBtn ">Search </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12">

                    <div class="collapse " id="navbarSupportedContent">
                        <ul class="main-ul mb-0 ">
                            <li class="nav-item active">
                                <a class="nav-link">Home </a>
                            </li>

                            <li class="nav-item">
                                <div class="image_container">

                                </div>

                            </li>


                            <li class="nav-item">
                                {{-- <p class="nav-link" *ngIf="isLogin">{{userName}}</p> --}}
                            </li>
                            <li class="nav-item dropdown">

                                <a class="nav-link dropdown-toggle" id="dropdownMenuLink" aria-haspopup="true"
                                    aria-expanded="false">
                                    Admin
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li class="nav-item">
                                        <div class="test">
                                            <a class="dropdown-item">Sites</a>
                                            <div class="test2">
                                                <a class="dropdown-item ">All Sites</a>
                                                <a class="dropdown-item  ">Create New</a>
                                            </div>
                                        </div>

                                    </li>
                                    <li><a class="dropdown-item">Modifications</a>
                                    </li>
                                    <li><a class="dropdown-item">Statestics</a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="test">
                                            <a class="dropdown-item ">NUR</a>
                                            <div class="test2">
                                                <a class="dropdown-item ">Show NUR</a>
                                                <a class="dropdown-item ">Add NUR</a>

                                            </div>

                                        </div>



                                    </li>
                                    <li> <a class="dropdown-item">Users</a></li>
                                </ul>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">Register</a>
                            </li>
                        </ul>



                    </div>


                </div>

            </div>
        </div>
    </nav>

</div>
