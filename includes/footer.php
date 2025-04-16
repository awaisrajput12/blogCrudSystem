<style>
    /* Footer Styles */
    .hover-white:hover {
        color: white !important;
        transition: all 0.3s ease;
    }

    .social-icons {
        display: flex;
        gap: 12px;
    }

    .social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        color: white;
    }

    .social-icon:hover {
        background: linear-gradient(135deg, rgb(41, 70, 197) 0%, #764ba2 100%);
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Improved list styles with better hover effect */
    .list-unstyled li a {
        position: relative;
        display: inline-block;
        text-decoration: none;
        padding-bottom: 2px;
        /* Space for the underline */
        transition: color 0.3s ease;
    }

    .list-unstyled li a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        left: 0;
        bottom: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        /* Gradient underline */
        transition: width 0.3s ease;
    }

    .list-unstyled li a:hover::after {
        width: 100%;
    }

    .list-unstyled li a:hover {
        color: white !important;
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .footer-brand {
            text-align: center;
        }

        .social-icons {
            justify-content: center;
        }

        .col-md-6.text-center.text-md-start,
        .col-md-6.text-center.text-md-end {
            text-align: center !important;
        }

        .list-inline {
            justify-content: center;
        }
    }

    @media (max-width: 575.98px) {
        .row.g-4>div {
            text-align: center;
        }

        ul.list-unstyled {
            display: inline-block;
            text-align: left;
        }
    }
</style>

<footer class="mt-3 pt-5 pb-4" style="background: linear-gradient(135deg,rgb(4, 4, 4) 0%,rgba(9, 9, 9, 0.78) 100%); color: #fff;">
    <div class="container">
        <div class="row g-4">
            <!-- Brand Column -->
            <div class="col-lg-5 col-md-6 mb-4">
                <div class="footer-brand mb-3">
                    <a class="navbar-brand fs-2 text-white" href="#" style="font-weight: 700;">Blog Pro</a>
                </div>
                <p class="mb-4" style="opacity: 0.8; line-height: 1.6;">Your premier destination for quality content creation and community engagement.</p>

                <div class="social-icons">
                    <a href="#" class="social-icon" aria-label="Facebook"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                        </svg></a>
                    <a href="#" class="social-icon" aria-label="Twitter"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg></a>
                    <a href="#" class="social-icon" aria-label="Instagram"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg></a>
                    <a href="#" class="social-icon" aria-label="LinkedIn"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                        </svg></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-4 mb-4">
                <h5 class="text-white mb-4" style="font-weight: 600; letter-spacing: 0.5px;">EXPLORE</h5>
                <ul class="list-unstyled">
                    <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none hover-white">Home</a></li>
                    <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none hover-white">Blog</a></li>
                    <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none hover-white">Categories</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div class="col-lg-2 col-md-4 mb-4">
                <h5 class="text-white mb-4" style="font-weight: 600; letter-spacing: 0.5px;">COMPANY</h5>
                <ul class="list-unstyled">
                    <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none hover-white">About Us</a></li>
                    <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none hover-white">Our Team</a></li>
                    <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none hover-white">Contact</a></li>
                </ul>
            </div>

            <!-- New Contact Details -->
            <div class="col-lg-2 col-md-4 mb-4">
                <h5 class="text-white mb-4" style="font-weight: 600; letter-spacing: 0.5px;">CONTACT US</h5>
                <ul class="list-unstyled">
                    <li class="mb-3"><a href="mailto:info@blogpro.com" class="text-white-50 text-decoration-none hover-white">
                            <svg width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                            awaisrajput13566@gmail.com
                        </a></li>
                    <li class="mb-3"><a href="tel:+1234567890" class="text-white-50 text-decoration-none hover-white">
                            <svg width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 1.44 3.32 2.76 4.56 2.76 1.34 0 2.57-1.12 3.63-2.06.35-.3.69-.56 1.02-.8.47-.33.94-.56 1.32-.76.16-.09.32-.14.49-.21V6.5L15 7l-3-4-3 4 1.5-.5v3.32c.13.09.26.18.37.29z" />
                                <path d="M20 15.5c-1.25 0-2.45-.2-3.57-.57-.1-.04-.21-.06-.32-.06-.26 0-.51.1-.7.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1z" />
                            </svg>
                            +923280248901
                        </a></li>
                    <li class="mb-3" class="text-white-50">
                        <svg width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                        Sahiwal Punjab Pakistan
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="mb-0" style="opacity: 0.7; font-size: 0.9rem;">&copy; 2023 Blog Pro. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="#" class="text-white-50 text-decoration-none hover-white" style="font-size: 0.9rem;">Terms</a></li>
                    <li class="list-inline-item mx-2" style="opacity: 0.5;">•</li>
                    <li class="list-inline-item"><a href="#" class="text-white-50 text-decoration-none hover-white" style="font-size: 0.9rem;">Privacy</a></li>
                    <li class="list-inline-item mx-2" style="opacity: 0.5;">•</li>
                    <li class="list-inline-item"><a href="#" class="text-white-50 text-decoration-none hover-white" style="font-size: 0.9rem;">Cookies</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>