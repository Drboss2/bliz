@extends('user.layouts.app')
@section('content')
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center">
        <img style="width:70px;" src="assets/img/app5.png" alt="">
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="/">Home</a></li>
          <li><a class="nav-link scrollto" href="../#about">About</a></li>
          
          <li><a class="nav-link scrollto" href="../#contact">Contact</a></li>
          <li><a class="nav-link scrollto" href="/rate">Rates</a></li>

          
          <li><a class="getstarted scrollto" href="/login">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex flex-column justify-content-center">
                <h2 class="text-center">Rates</h2>
            </div>
        </div>
    </div>
  </section><!-- End Hero -->

    <main id="main">
        <section id="abouts" class="abouts">
            <div class="container" data-aos="fade-up">
                <div class="row gx-0">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                          <table class="table" style="font-size:13px">
                                <thead class="bg-dark text-light">
                                    <tr>
                                        <th>Assets</th>
                                        <th>Type</th>
                                        <th>Den</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($btc as $val)
                                    <tr>
                                        <td>{{$val->assets}}</td>
                                        <td>{{$val->crypto_name}}</td>
                                        <td>{{$val->min}}-{{$val->max}}</td>
                                        <td>₦{{$val->rate}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <table class="table" style="font-size:12px">
                                <thead class="bg-dark text-light">
                                    <tr>
                                        <th>Country</th>
                                        <th>Card name</th>
                                        <th>Card type</th>
                                        <th>Den</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $val)
                                    <tr>
                                        <td>{{$val->card_country}}</td>
                                        <td>{{$val->giftcard}}</td>
                                        <td>{{$val->card_type}}</td>
                                        <td>{{$val->buying_min}}-{{$val->buying_max}}</td>
                                        <td>₦{{$val->price}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="assets/img/logo.png" alt="">
              <span>Blizexchange</span>
            </a>
            <p>We have been in existence since 2016 trading gift cards and cryptocurrencies and offering amazing services to customers in Nigeria and beyond.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram bx bxl-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin bx bxl-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="./">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="/abount">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Giftcard </a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Bitcoin</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Auto Mobile</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              <strong>Phone:</strong> +2347069128744<br>
              <strong>Email:</strong> Blizexchange@yahoo.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Blizexchange</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="#">voke 08127352446</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@endsection