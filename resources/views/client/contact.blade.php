@extends('client.layout.main')

@section('title', 'Contact Us')
<!--Section: Contact v.2-->
@section('content')
    <section class="col-lg-8 mb-4 ml-50 mt-100">

        <!--Section heading-->
        <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
        <!--Section description-->
        <div class="row">

            <!--Grid column-->
            <div class="col-lg-9 mb-md-0 mb-5">
                <form id="contact-form" name="contact-form" action="mail.php" method="POST">

                    <!--Grid row-->
                    <div class="row">

                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <input type="text" id="name" name="name" class="form-control">
                                <label for="name" class="">Your name</label>
                            </div>
                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <input type="text" id="email" name="email" class="form-control">
                                <label for="email" class="">Your email</label>
                            </div>
                        </div>
                        <!--Grid column-->

                    </div>
                    <!--Grid row-->

                    <!--Grid row-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                                <input type="text" id="subject" name="subject" class="form-control">
                                <label for="subject" class="">Subject</label>
                            </div>
                        </div>
                    </div>
                    <!--Grid row-->

                    <!--Grid row-->
                    <div class="row">

                        <!--Grid column-->
                        <div class="col-md-12">

                            <div class="md-form">
                                <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                <label for="message">Your message</label>
                            </div>

                        </div>
                    </div>
                    <!--Grid row-->

                </form>

                <div class="text-center text-md-left">
                    <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Send</a>
                </div>
                <div class="status"></div>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 text-center">
                <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>Vietnam</p>
                    </li>

                    <li><i class="fas fa-phone mt-4 fa-2x"></i>
                        <p>+84 039 5784 205</p>
                    </li>

                    <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                        <p>hoangncph17413@fpt.edu.vn</p>
                    </li>
                </ul>
            </div>
            <!--Grid column-->
        </div>
        <div class="col-lg-8">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d7447.719186923744!2d105.7460504!3d21.0383033!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1658900177859!5m2!1svi!2s"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
    <!--Section: Contact v.2-->
@endsection
