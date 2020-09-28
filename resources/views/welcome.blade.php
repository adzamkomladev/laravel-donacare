<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Donacare is a platform to perform medical donation requests from blood to organs to funds. You can sign up as a patient or a donor on donacare. Donacare offers free and charged donations.">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="Donacare - Medical donation Platform">
    <meta itemprop="description" content="Donacare is a platform to perform medical donation requests from blood to organs to funds. You can sign up as a patient or a donor on donacare. Donacare offers free and charged donations.">
    <meta itemprop="image" content="http://donacare.net/img/Home2.png">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="http://donacare.net">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Donacare - Medical donation Platform">
    <meta property="og:description" content="Donacare is a platform to perform medical donation requests from blood to organs to funds. You can sign up as a patient or a donor on donacare. Donacare offers free and charged donations.">
    <meta property="og:image" content="http://donacare.net/img/Home2.png">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Donacare - Medical donation Platform">
    <meta name="twitter:description" content="Donacare is a platform to perform medical donation requests from blood to organs to funds. You can sign up as a patient or a donor on donacare. Donacare offers free and charged donations.">
    <meta name="twitter:image" content="http://donacare.net/img/Home2.png">

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,400;0,700;1,200;1,400;1,700&display=swap"
        rel="stylesheet">

    <link rel="icon" href="favicon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.0/animate.min.css"
        integrity="sha512-kb1CHTNhoLzinkElTgWn246D6pX22xj8jFNKsDmVwIQo+px7n1yjJUZraVuR/ou6Kmgea4vZXZeUDbqKtXkEMg=="
        crossorigin="anonymous" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
    <!-- magnific popup CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
        integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw=="
        crossorigin="anonymous" />
    <!-- nice select CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
        integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
        crossorigin="anonymous" />
    <!-- swiper CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="/">
                            <img src="img/Home2.png" width="300" height="100" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-center"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item active">
                                    <a class="nav-link" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#hospitals">Hospitals</a>
                                </li>
                            </ul>
                        </div>
                        <a class="btn_2 d-none d-lg-block" href="/login">Sign in / Sign up</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-xl-5">
                    <div class="banner_text">
                        <div class="banner_text_iner">

                            <h1>Easy and affordable @
                                Your convenience</h1>
                            <p>
                            <h4>We care about the wellbeing of every citizen, find a compatible donor for yourself,
                                sibling, friend etc
                                with our DONOR platform. </h4>
                            </p>
                            <h3>Simply request for free or pay less for your donations.</h3>

                            <a href="/login" class="btn_2">Request for a donation</a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner_img">
                        <img src="img/banner_img.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!-- about us part start-->
    <section id="about" class="about_us padding_top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6 col-lg-6">
                    <div class="about_us_img">
                        <img src="img/top_service.png" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="about_us_text">
                        <h2>About us</h2>
                        <p>We are a team of committed health officials and IT experts focused on solving problems
                            through
                            cutting-edge technology. The company has been committed to providing integrated end-to-end
                            innovations to deliver excellent health care and value to patients, health workers, donors
                            and the
                            general public sector. BITTECH CORPORATION believes in Problem solving and technological
                            innovation
                            as a core value of the company, investing 10% of annual revenue in Educating brighter minds
                            in
                            technology in solving problems face by all people both local and internationally.</p>
                        <a class="btn_2 " href="#">learn more</a>
                        <div class="banner_item">
                            <div class="single_item">
                                <img src="img/icon/banner_1.svg" alt="">
                                <h5>Emergency</h5>
                            </div>
                            <div class="single_item">
                                <img src="img/icon/banner_2.svg" alt="">
                                <h5>Appointment</h5>
                            </div>
                            <div class="single_item">
                                <img src="img/icon/banner_3.svg" alt="">
                                <h5>Qualfied</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about us part end-->

    <!-- feature_part start-->
    <section class="feature_part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section_tittle text-center">
                        <h2>Our services</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-3 col-sm-12">
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><img src="img/icon/feature_1.svg" alt=""></span>
                            <h4>BLOOD DONATION</h4>
                            <p>We as a company hope to provide quality services to our clientele by deploying all
                                resources to improve blood donations services in the country saving
                                the daily lives of people. Users can simply download Our app from Playstore/Apple Store
                                register and at a click away you can find a compatible donor. EASY AND FRIENDLY.</p>
                        </div>
                    </div>
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><img src="img/icon/feature_2.svg" alt=""></span>
                            <h4>ORGAN DONATION</h4>
                            <p>We provide a more secured, wider and easy way for patient in need of transplant to find
                                their match in terms of Organ donation. This system supports inter-hospital organ search
                                engine for patient-doctor to find possible organ donors in time. </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="single_feature_img">
                        <img src="img/service.png" alt="">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><img src="img/icon/feature_1.svg" alt=""></span>
                            <h4>FUND DONATION</h4>
                            <p>We create an enabling environment for everyone in need of funds to support his/her
                                medical treatment in the country have access to public/NGO donations</p>
                        </div>
                    </div>
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><img src="img/icon/feature_2.svg" alt=""></span>
                            <h4>HOSPITAL ASSISTANT</h4>
                            <p>We provide a medium for patients to have healthy individuals assist them in the hospitals
                                in cases where patient has no family relation aid their activities in the hospital.
                                Patient can easily request the services of unkwon but willing individual to to assist
                                them.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature_part start-->

    <!-- our depertment part start-->
    <section class="our_depertment section_padding">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-12">
                    <div class="depertment_content">
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <h2>BITTECH CORPORATION</h2>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">

                                    </div>
                                    <div class="col-lg-6 col-sm-6">

                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><img src="img/icon/feature_2.svg"
                                                    alt=""></span>
                                            <h4>Mission</h4>
                                            <p>We are a company that exists to develop products that achieve excellent
                                                results through
                                                deep
                                                collaborative work, project review and expert minds.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><img src="img/icon/feature_2.svg"
                                                    alt=""></span>
                                            <h4>Vision</h4>
                                            <p>We intend to be the world’s most evolutionary IT Company that insists on
                                                improving lives
                                                through cutting edge technologies and innovative ideas.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- our depertment part end-->

    <!--::doctor_part start::-->
    <section id="hospitals" class="doctor_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section_tittle text-center">
                        <h2>Hospitals onboard this system</h2>
                        <p>There are several hospitals involved in the application that help facilitate donations and
                            requests.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="single_blog_item">
                        <div class="single_blog_img">
                            <img src="img/doctor/doctor_1.png" alt="doctor">
                            <div class="social_icon">
                                <ul>
                                    <li><a href="#"> <i class="ti-facebook"></i> </a></li>
                                    <li><a href="#"> <i class="ti-twitter-alt"></i> </a></li>
                                    <li><a href="#"> <i class="ti-instagram"></i> </a></li>
                                    <li><a href="#"> <i class="ti-skype"></i> </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single_text">
                            <div class="single_blog_text">
                                <h3>DR Adam Billiard</h3>
                                <p>Heart specialist</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single_blog_item">
                        <div class="single_blog_img">
                            <img src="img/doctor/doctor_4.png" alt="doctor">
                            <div class="social_icon">
                                <ul>
                                    <li><a href="#"> <i class="ti-facebook"></i> </a></li>
                                    <li><a href="#"> <i class="ti-twitter-alt"></i> </a></li>
                                    <li><a href="#"> <i class="ti-instagram"></i> </a></li>
                                    <li><a href="#"> <i class="ti-skype"></i> </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single_text">
                            <div class="single_blog_text">
                                <h3>Ridge Hospital</h3>
                                <p>Ring Road Central, Accra</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single_blog_item">
                        <div class="single_blog_img">
                            <img src="img/doctor/doctor_2.png" alt="doctor">
                            <div class="social_icon">
                                <ul>
                                    <li><a href="#"> <i class="ti-facebook"></i> </a></li>
                                    <li><a href="#"> <i class="ti-twitter-alt"></i> </a></li>
                                    <li><a href="#"> <i class="ti-instagram"></i> </a></li>
                                    <li><a href="#"> <i class="ti-skype"></i> </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single_text">
                            <div class="single_blog_text">
                                <h3>Korle Bu Teaching Hospital</h3>
                                <p>Korle Bu, Accra</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single_blog_item">
                        <div class="single_blog_img">
                            <img src="img/doctor/doctor_3.png" alt="doctor">
                            <div class="social_icon">
                                <ul>
                                    <li><a href="#"> <i class="ti-facebook"></i> </a></li>
                                    <li><a href="#"> <i class="ti-twitter-alt"></i> </a></li>
                                    <li><a href="#"> <i class="ti-instagram"></i> </a></li>
                                    <li><a href="#"> <i class="ti-skype"></i> </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single_text">
                            <div class="single_blog_text">
                                <h3>Kaneshie polyclinic</h3>
                                <p>Kaneshie, Accra</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::doctor_part end::-->

    <!-- footer part start-->
    <footer class="footer-area">
        <div class="footer section_padding">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-2 col-md-4 col-sm-6 single-footer-widget">
                        <a href="/" class="footer_logo">
                            BLOOD DONOR
                        </a>
                        <p>We intend to be the world’s most evolutionary IT Company that insists on improving lives
                            through cutting edge technologies and innovative ideas </p>
                        <div class="social_logo">
                            <a href="#"><i class="ti-facebook"></i></a>
                            <a href="#"> <i class="ti-twitter"></i> </a>
                            <a href="#"><i class="ti-instagram"></i></a>
                            <a href="#"><i class="ti-skype"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6 col-md-4 single-footer-widget">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Department</a></li>
                            <li><a href="#"> Online payment</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Department</a></li>
                        </ul>
                    </div>
                    {{-- <div class="col-xl-2 col-sm-6 col-md-4 single-footer-widget">
                        <h4>Explore</h4>
                        <ul>
                            <li><a href="#">In the community</a></li>
                            <li><a href="#">IU health foundation</a></li>
                            <li><a href="#">Family support </a></li>
                            <li><a href="#">Business solution</a></li>
                            <li><a href="#">Community clinic</a></li>
                        </ul>
                    </div> --}}
                    <div class="col-xl-2 col-sm-6 col-md-6 single-footer-widget">
                        <h4>Resources</h4>
                        <ul>
                            <li><a href="#">Lights were season</a></li>
                            <li><a href="#"> Their is let wherein</a></li>
                            <li><a href="#">which given over</a></li>
                            <li><a href="#">Without given She</a></li>
                            <li><a href="#">Isn two signs think</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright_part">
            <div class="container">
                <div class="row align-items-center">
                    <p class="footer-text m-0 col-lg-8 col-md-12">
                        BITTECH CORPORATION || www.bittechcorp.com || Copyright &copy;<script>
                            document.write(new Date().getFullYear());

                        </script>
                    </p>
                    <div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"> <i class="ti-twitter"></i> </a>
                        <a href="#"><i class="ti-instagram"></i></a>
                        <a href="#"><i class="ti-skype"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- footer part end-->

    <!-- jquery plugins here-->

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

    <!-- owl carousel js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"
        integrity="sha512-NqYds8su6jivy1/WLoW8x1tZMRD7/1ZfhWG/jcRQLOzV1k1rIODCpMgoBnar5QXshKJGV7vi0LXLNXPoFsM5Zg=="
        crossorigin="anonymous"></script>

    <!-- custom js -->
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
