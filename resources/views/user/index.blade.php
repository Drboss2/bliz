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
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
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
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Trade Bitcoins & Giftcards <br><span style="font-size:26px;color:#051441;">with instant payment</span></h1>
          <br>
          <p data-aos="fade-up" data-aos-delay="400" style="font-weight:400;line-height:1.867; font-style: normal;color:#6a7c92;">A platform crafted for you to sell your giftcards,bitcoins,In Nigeria At Best Rates</p>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a style="border-radius:20px;" href="/register" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Started</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="{{asset('assets/img/hero-img.png')}}" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Who We Are</h3>
              <h2>What is Blizexchange</h2>
              <p>
                We have been in existence since 2016 trading gift cards and cryptocurrencies and offering amazing services to customers in Nigeria and beyond.
              </p>
              <p>On here, you can Sell iTunes Gift Cards, Amazon Gift Cards, Walmart Gift Cards, Steam Wallet Gift Cards, Google Play Gift Cards, Target Cards and just any gift cards</p>
              <div class="text-center text-lg-start">
                <a href="/login" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Login</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/apex.png" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

    <!-- ======= Values Section ======= -->
    <section id="values" class="values">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Our Values</h2>
        </header>

        <div class="row">

          <div class="col-lg-4">
            <div class="box" data-aos="fade-up" data-aos-delay="200">
              <img src="assets/img/values-1.png" class="img-fluid" alt="">
              <h3>Fast Payment</h3>
              <p>All Payment are processed and paid as quickly as possible </p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="fade-up" data-aos-delay="400">
              <img src="assets/img/values-2.png" class="img-fluid" alt="">
              <h3>Limitless Cash Out</h3>
              <p>We process any amount of trade without any restriction .</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="fade-up" data-aos-delay="600">
              <img src="assets/img/values-3.png" class="img-fluid" alt="">
              <h3>24/7 Availability</h3>
               <p>We are always available 24/7 to give customer support when needed.</p>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Values Section -->
    <section id="values" class="values bg-primary">
    <div class="container" data-aos="fade-up">
        <header class="section-header text-light">
          <h2 class='text-light'>DOWNLOAD OUR APP</h2>
        </header>
        <div class="row">
          <div class="col-lg-6 order-md-2 d-flex align-items-center p-4">
            <div class="" data-aos="fade-up" data-aos-delay="200">
              <h1 class="text-light text-bold">Its suitable to all devices</h1>
              <p class='text-light'>Trade Giftcards, Bitcoins and get paid instantly within minutes.</p>
              <p class="text-light text-center">Coming soon</p>

              <p class="mt-3 text-center  p-4"><a style="border-radius:20px;" class="btn btn-default btn-hover  border text-light pr-3" href="#"> <i style="color:blue" class="fab fa-google-play"></i> Play Store</a>&nbsp;&nbsp;
              <a  style="border-radius:20px;" class="btn btn-default btn-hover  border text-light" href="#"><i style="color:lightgreen" class="fab fa-apple"></i> App Store</a></p>

            </div>
          </div>
            <div class="col-lg-3 d-none d-sm-block">
               <img width="100%" class="img-fluid" src="assets/img/app4.png" alt="">
            </div>
            <div class="col-lg-3 order-md-2  d-flex align-items-center bounce">
                <div class="" data-aos="fade-up" data-aos-delay="400">
                   <img width="100%" height="390px" class="img-fluid" src="assets/img/app6.png" alt="">
                </div>
            </div>
        </div>
      </div>
    </section><!-- End Values Section -->
    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="{{$user}}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Happy Clients</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="count-box">
              <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="{{$trade}}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Trades</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="count-box">
              <i class="bi bi-headset" style="color: #15be56;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
                <p>Hours Of Support</p>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>F.A.Q</h2>
          <p>Frequently Asked Questions</p>
        </header>

        <div class="row">
          <div class="col-lg-6">
            <!-- F.A.Q List 1-->
            <div class="accordion accordion-flush" id="faqlist1">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                    What is Blizexhange ?
                  </button>
                </h2>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Blizexchange is an exchange platform that makes it easy to sell your Bitcoin and gift cards for cash..
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                    Why should I use Blizexhange?
                  </button>
                </h2>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Blizexhange offers a simple, safe, and convenient way to sell gift cards. To provide our customers with peace of mind, we securely process every bitcoin and gift card transaction.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                    What are the major asset traded on Blizexchange?
                  </button>
                </h2>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                     We buy all major gift cards at very good rate, we also  sell Bitcoin and other cryptocurrencies.
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-6">

            <!-- F.A.Q List 2-->
            <div class="accordion accordion-flush" id="faqlist2">

              <!-- <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-1">
                    Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?
                  </button>
                </h2>
                <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                  </div>
                </div>
              </div> -->

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-2">
                    How long does it take to process a gift card?
                  </button>
                </h2>
                <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    For iTunes, Amazon, steam and google the turnaround time is 5-10 minutes while other cards such as Apple, Wal-Mart, Sephora, Nordstrom, E-bay etc. takes between 1-3 hours to process.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-3">
                    Are you Avaliable 24/7?
                  </button>
                </h2>
                <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                     We are available for all trades at all time.
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>

    </section><!-- End F.A.Q Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Location</h3>
                  <p>Lagos,Nigeria</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-telephone"></i>
                  <h3>Call/Whats app</h3>
                  <p>+2347069128744</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>Blizexchange@yahoo.com</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-clock"></i>
                  <h3>Open Hours</h3>
                  <p>24/7</p>
                </div>
              </div>
            </div>

          </div>

           <div class="col-lg-6">
                <form class="pemail_form">
                    <div class="row gy-4">

                        <div class="col-md-6">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                        </div>

                        <div class="col-md-6 ">
                        <input type="email" class="form-control" name="p_email" id="p_email" placeholder="Your Email" required>
                        </div>

                        <div class="col-md-12">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>

                        <div class="col-md-12">
                        <textarea class="form-control" name="message" id="message" rows="6" placeholder="Message" required></textarea>
                        </div>

                        <div class="col-md-12 text-center">


                        <button class='btn btn-primary btn-sm' type="submit">Send Message</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>

      </div>

    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center">
            <h4>Our Newsletter</h4>
            <p>Subscribe and get out latest updates on any product we launch.</p>
          </div>
          <div class="col-lg-6">
          <p id="put"></p>
            <form id="sub">
              <input type="email" name="email" id="email">
              <input id="submt" type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>

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
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
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
        Designed by <a href="https://bootstrapmade.com/">Techhouse</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script>
        $(document).ready(function(){ 
            function setHeader(data){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': data
                    }
                });
            }
           setHeader($('meta[name="csrf-token"]').attr('content'))
            function refreshToken(){
                $.get('refresh',function(data){
                    setHeader(data);
                })
            }
            $("#sub").on('submit',function(e){
                e.preventDefault();
                let email = $("#email").val();

                if(email == ""){
                    alert('enter email address')
                    $("#email").focus()
                }else{
                    $.ajax({
                        url:"/subscribe",
                        type:"post",
                        data:{
                            email:email
                        },
                        beforeSend:function(){
                            $("#submt").prop('disabled',true);
                            $("#submt").val('Sending..');
                        },
                        success:function(data){
                            $("#submt").prop('disabled',false);
                            $("#submt").val('Subscribe');

                            if(data == 'sent'){
                               $("#put").html("<p class='text-success'>Thanks!! You have Successful subscribe'</p>");
                               $("#email").val('')
                            }
                            refreshToken()
                        },
                        error:function(error){
                            if(error.status === 419){
                                refreshToken()  
                                $("#put").html("<p class='text-danger'>Your session has expire relogin to continue'</p>");
                            }else if(error.status === 422){
                                $("#put").html("<p class='text-danger'>"+error.responseJSON.errors.email +"</p>");
                                $("#email").val('')
                            }
                            $("#submt").prop('disabled',false);
                            $("#submt").val('Subscrib');                           
                        }
                    })
                }
                
            })
            $("#pemail_form").on('submit',function(e){
                e.preventDefault();
                let email    = $("#p_email").val();
                let name     = $("#name").val();
                let subject  = $("#subject").val();
                let message  = $("#message").val()

                if(email == ""){
                    alert('enter email address')
                    $("#email").focus()
                }else{
                    $.ajax({
                        url:"/subscribe",
                        type:"post",
                        data:$(this).serialize(),
                        beforeSend:function(){
                            $("#submt").prop('disabled',true);
                            $("#submt").val('Sending..');
                        },
                        success:function(data){
                            $("#submt").prop('disabled',false);
                            $("#submt").val('Subscribe');

                            if(data == 'sent'){
                               $("#put").html("<p class='text-success'>Thanks!! You have Successful subscribe'</p>");
                               $("#email").val('')
                            }
                            refreshToken()
                        },
                        error:function(error){
                            if(error.status === 419){
                                refreshToken()  
                                $("#put").html("<p class='text-danger'>Your session has expire relogin to continue'</p>");
                            }else if(error.status === 422){
                                $("#put").html("<p class='text-danger'>"+error.responseJSON.errors.email +"</p>");
                                $("#email").val('')
                            }
                            $("#submt").prop('disabled',false);
                            $("#submt").val('Subscrib');                           
                        }
                    })
                }
                
            })
        })
  </script>
@endsection