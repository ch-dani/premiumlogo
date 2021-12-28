@extends('layouts.checkout')

@section('content')
    <header class="dashboard-header checkout1">
        <div class="container">
            <div class="dashboard-header__back dashboard-active"><a href="#"><img
                        src="/site/img/arroew-left-back.svg">back</a></div>
            <div class="dashboard-header__logo dashboard-no-active">
                <div class="logo">
                    <a href="index.php">
                        <img src="/site/img/logo.svg" alt="">
                    </a>
                </div>
            </div>
            <div class="dashboard-header__next dashboard-no-active"><a href="#">next <img src="/site/img/arrow-left-next.svg"></a>
            </div>
        </div>
    </header>
    <main>
        <section class="preview">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                        <div class="preview1 preview__item">
                            <div class="preview-logo"><img src="/site/img/LOGO1.png"></div>
                            <img src="/site/img/preveiw1.png" width="238" height="294">
                        </div>
                        <div class="preview2 preview__item">
                            <div class="preview-logo"><img src="/site/img/LOGO2.png"></div>
                            <img src="/site/img/preveiw2.png" width="197" height="268">
                        </div>
                        <div class="preview3 preview__item">
                            <div class="preview-logo"><img src="/site/img/LOGO3.png"></div>
                            <img src="/site/img/preveiw3.png" width="167" height="240">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="preview4 preview__item">
                            <div class="preview-logo"><img src="/site/img/LOGO4.png"></div>
                            <img src="/site/img/preveiw4.png" width="610" height="448">
                        </div>
                        <div class="preview-logo-big">
                            <img src="/site/img/preview-logo.png">
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                        <div class="preview5 preview__item">
                            <img src="/site/img/preveiw5.svg" width="276" height="163">
                        </div>
                        <div class="preview6 preview__item">
                            <div class="preview-logo"><img src="/site/img/LOGO6.png"></div>
                            <img src="/site/img/preveiw6.png" width="300" height="226">
                        </div>
                        <div class="preview7 ">
                            <img src="/site/img/preveiw7.png" width="190" height="78">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
