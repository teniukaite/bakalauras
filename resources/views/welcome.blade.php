<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- AOS -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
<!-- banner -->
<div class="jumbotron jumbotron-fluid" id="banner" style="background-image: url(../img/testas.png);">
    <div class="container text-center text-md-left">
        <header>
            <div class="row justify-content-between">
                <div class="col-2">
                    <img src="../img/logo.png" alt="logo">
                </div>
                <div class="col-6 align-self-center text-right">
                    @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <a href="{{ url('/home') }}" class="text-white lead">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="text-white lead">Prisijungti</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-white lead">Registruotis</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </header>

        <p data-aos="fade" data-aos-easing="linear" data-aos-duration="1000" data-aos-once="true" class="lead text-white my-4">
            Lorem ipsum dolor sit amet, id nec enim autem oblique, ei dico mentitum duo.
            <br> Illum iusto laoreet his te. Lorem partiendo mel ex. Ad vitae admodum voluptatum per.
        </p>
    </div>
</div>
<!-- three-blcok -->
<div class="container my-5 py-2">
    <h2 class="text-center font-weight-bold my-5">Mūsų teikiamos paslaugos</h2>
    <div class="row">
        <div data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center">
            <img src="../img/smart-protect-1.jpg" alt="Anti-spam" class="mx-auto">
            <h4>Anti-spam</h4>
            <p>Lorem ipsum dolor sit amet porro his no his deleniti</p>
        </div>
        <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center">
            <img src="../img/smart-protect-2.jpg" alt="Phishing Detect" class="mx-auto">
            <h4>Phishing Detect</h4>
            <p>Ne error antiopam usu. Sed vocen concludaturque ea</p>
        </div>
        <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center">
            <img src="../img/smart-protect-3.jpg" alt="Smart Scan" class="mx-auto">
            <h4>Smart Scan</h4>
            <p>Et usu ocurreret elaboraret doctus prodesse assueverit.</p>
        </div>
    </div>
</div>
<!-- feature (skew background) -->
<div class="jumbotron jumbotron-fluid feature" id="feature-first">
    <div class="container my-5">
        <div class="row justify-content-between text-center text-md-left">
            <div data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" class="col-md-6">
                <h2 class="font-weight-bold">Prisijunkite prie bendruomenės</h2>
                <p class="my-4">Te iisque labitur eos, nec sale argumentum scribentur no,
                    <br> augue disputando in vim. Erat fugit sit at, ius lorem deserunt deterruisset no.</p>
                <a href="#" class="btn my-4 font-weight-bold atlas-cta cta-blue">Registruotis</a>
            </div>
            <div data-aos="fade-left" data-aos-duration="1000" data-aos-once="true" class="col-md-6 align-self-center">
                <img src="../img/feature-1.png" alt="Take a look inside" class="mx-auto d-block">
            </div>
        </div>
    </div>
</div>
<!-- feature (green background) -->
<div class="jumbotron jumbotron-fluid feature" id="feature-last">
    <div class="container">
        <div class="row justify-content-between text-center text-md-left">
            <div data-aos="fade-left" data-aos-duration="1000" data-aos-once="true" class="col-md-6 flex-md-last">
                <h2 class="font-weight-bold">Safe and reliable</h2>
                <p class="my-4">
                    Duo suas detracto maiestatis ad, commodo lucilius invenire nec ad,
                    <br> eum et oratio disputationi. Falli lobortis his ad
                </p>
                <a href="#" class="btn my-4 font-weight-bold atlas-cta cta-blue">Learn More</a>
            </div>
            <div data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" class="col-md-6 align-self-center flex-md-first">
                <img src="../img/feature-2.png" alt="Safe and reliable" class="mx-auto d-block">
            </div>
        </div>
    </div>
</div>

<!-- price table -->
<div class="container my-5 py-2" id="price-table">
    <h2 class="text-center font-weight-bold d-block mb-3">Paslaugų pasiūlymai</h2>
    <div class="row">
        @foreach($offers as $offer)
            <div data-aos="fade-right" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center py-4 mt-5">
                <h4 class="my-4">{{ $offer->service_name }}</h4>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div id="carouselExampleControls-<?=$offer->id;?>" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($offer->files as $file)
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{ asset($file->file_path) }}" alt="file">
                                    </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls-<?=$offer->id;?>" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls-<?=$offer->id;?>" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="font-weight-bold">€ <span class="display-2 font-weight-bold">{{ $offer->price }}</span> {{ $offer->price_content }}</p>
                <ul class="list-unstyled">
                    <li><i class="fa-solid fa-map-location-dot"></i> {{ $offer->cities->name }}</li>
                    <li><i class="fa-solid fa-clock"></i> {{ $offer->duration }}</li>
                    <li><i class="fa-solid fa-user"></i> {{$offer->freelancer->name}} {{$offer->freelancer->lastName}}</li>
                    <li>Limited Support</li>
                </ul>
                <a href="#" class="btn my-4 font-weight-bold atlas-cta cta-ghost">Get Free</a>
            </div>
        @endforeach
    </div>
</div>
<!-- contact -->
<div class="jumbotron jumbotron-fluid" id="contact" style="background-image: url(../img/contact-bk.jpg);">
    <div class="container my-5">
        <div class="row justify-content-between">
            <div class="col-md-6 text-white">
                <h2 class="font-weight-bold">Contact Us</h2>
                <p class="my-4">
                    Te iisque labitur eos, nec sale argumentum scribentur,
                    <br> augue disputando in vim. Erat fugit sit at, ius lorem.
                </p>
                <ul class="list-unstyled">
                    <li>Email : company_email@com</li>
                    <li>Phone : 361-688-5824</li>
                    <li>Address : 4826 White Avenue, Corpus Christi, Texas</li>
                </ul>
            </div>
            <div class="col-md-6">
                <form>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Your Name</label>
                            <input type="name" class="form-control" id="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Email">Your Email</label>
                            <input type="email" class="form-control" id="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn font-weight-bold atlas-cta atlas-cta-wide cta-green my-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

<script src="{{asset('js/app.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $('.carousel-inner > .carousel-item:first-child').addClass('active');
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" integrity="sha512-yFjZbTYRCJodnuyGlsKamNE/LlEaEAxSUDe5+u61mV8zzqJVFOH7TnULE2/PP/l5vKWpUNnF4VGVkXh3MjgLsg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
</html>
