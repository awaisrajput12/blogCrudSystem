<?php
session_start();
require_once './config/db.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./includes/header.php" ?>

    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fa;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
            --text-color: #495057;
            --text-muted: #6c757d;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        /* Card Styles (removed hover effect) */
        .contact-card {
            border: 2px solid rgba(0, 0, 0, 0.05);
        }

        /* Icon Box */
        .icon-box {
            width: 60px;
            height: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Form Styles */
        .form-control,
        .form-select {
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            border-radius: 8px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        .form-floating>label {
            color: var(--text-muted);
            padding: 12px 15px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #3a5bd9;
            border-color: #3a5bd9;
            transform: translateY(-2px);
        }

        /* Accordion Styles */
        .accordion-button {
            font-weight: 600;
            padding: 15px 20px;
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(78, 115, 223, 0.05);
            color: var(--primary-color);
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(78, 115, 223, 0.25);
        }

        /* Hero Image Styles */
        .contact-hero img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .contact-hero {
                text-align: center;
            }

            .contact-hero .d-flex {
                justify-content: center;
            }

            .icon-box {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
        }

        /* Enhanced Hero Section */
        .contact-hero {
            background: linear-gradient(135deg, rgba(78, 115, 226, 0.95) 0%, rgba(165, 104, 180, 0.95) 100%);
            color: white;
            padding: 7rem 0;
            position: relative;
            overflow: hidden;
        }

        .contact-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
            background-size: cover;
            z-index: -1;
            opacity: 0.1;
        }

        .hero-content h1 {
            font-size: 3.2rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero-content p.lead {
            font-size: 1.35rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .hero-content h1 {
                font-size: 2.8rem;
            }

            .hero-content p.lead {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 768px) {
            .contact-hero {
                padding: 5rem 0;
                text-align: center;
            }

            .hero-content h1 {
                font-size: 2.3rem;
            }

            .hero-content p.lead {
                font-size: 1.1rem;
            }

            .hero-cta {
                justify-content: center;
            }

            .d-flex.text-white-50 {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <?php include "./includes/navbar.php" ?>
    <!-- Main Content -->
    <main>

        <!-- Hero Section -->
        <section class="contact-hero">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 hero-content animate-fade-in">
                        <h1 class="display-4 fw-bold mb-4">Let's Connect & Create Something Amazing</h1>
                        <p class="lead mb-4">We're passionate about helping you. Whether you have a question, feedback, or just want to say hello - we'd love to hear from you!</p>

                        <div class="d-flex flex-wrap gap-3 mb-5 mb-lg-0">
                            <a href="#contact-form" class="btn btn-hero btn-hero-primary">
                                <i class="fas fa-paper-plane me-2"></i> Send a Message
                            </a>
                            <a href="tel:+1234567890" class="btn btn-hero btn-hero-secondary">
                                <i class="fas fa-phone me-2"></i> Call Us Now
                            </a>
                        </div>

                        <div class="d-flex align-items-center text-white-50">
                            <div class="me-3">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>24/7 Support</span>
                            </div>
                            <div class="me-3">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Fast Response</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="hero-image-container position-relative">
                            <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                                alt="Contact us"
                                class="img-fluid rounded-4 shadow-lg">
                            <div class="position-absolute bottom-0 start-0 bg-white p-3 rounded-end rounded-top shadow-sm">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle p-2 me-2">
                                        <i class="fas fa-headset text-white"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold">Need immediate help?</p>
                                        <p class="mb-0 text-primary fw-bold">+1 (234) 567-890</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Options -->
        <section class="contact-options py-5">
            <div class="container">
                <div class="row g-4">
                    <!-- Support Card -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 contact-card">
                            <div class="card-body p-4 text-center">
                                <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-4">
                                    <i class="fas fa-headset fs-4"></i>
                                </div>
                                <h4 class="fw-bold mb-3">Support</h4>
                                <p class="text-muted mb-4">Need help with our platform or content? Our support team is here to assist you.</p>
                                <a href="mailto:support@blogname.com" class="btn btn-outline-primary">Contact Support</a>
                            </div>
                        </div>
                    </div>

                    <!-- Collaboration Card -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 contact-card">
                            <div class="card-body p-4 text-center">
                                <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-4">
                                    <i class="fas fa-handshake fs-4"></i>
                                </div>
                                <h4 class="fw-bold mb-3">Collaborate</h4>
                                <p class="text-muted mb-4">Interested in guest posting, partnerships, or sponsorships? Let's work together.</p>
                                <a href="mailto:collab@blogname.com" class="btn btn-outline-success">Collaborate With Us</a>
                            </div>
                        </div>
                    </div>

                    <!-- General Inquiry Card -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 contact-card">
                            <div class="card-body p-4 text-center">
                                <div class="icon-box bg-info bg-opacity-10 text-info rounded-circle mx-auto mb-4">
                                    <i class="fas fa-envelope fs-4"></i>
                                </div>
                                <h4 class="fw-bold mb-3">General Inquiry</h4>
                                <p class="text-muted mb-4">For all other questions or feedback, our team is ready to help.</p>
                                <a href="#contact-form" class="btn btn-outline-info">Send Message</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section id="contact-form" class="py-5 bg-light">
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center mb-5">
                        <h2 class="fw-bold mb-3">Send Us a Message</h2>
                        <p class="text-muted">Fill out the form below and we'll get back to you as soon as possible.</p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class=" border-0 shadow-sm">
                            <div class="card-body p-4 p-md-5">
                                <form id="blogContactForm" action="process_contact.php" method="POST">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                                <label for="name">Your Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                                <label for="email">Your Email</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <select class="form-select" id="inquiry-type" name="inquiry_type" required>
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="General Inquiry">General Inquiry</option>
                                                    <option value="Technical Support">Technical Support</option>
                                                    <option value="Collaboration">Collaboration</option>
                                                    <option value="Advertising">Advertising</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <label for="inquiry-type">Inquiry Type</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" id="message" name="message" placeholder="Your Message" style="height: 150px" required></textarea>
                                                <label for="message">Your Message</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="subscribe" name="subscribe">
                                                <label class="form-check-label" for="subscribe">
                                                    Subscribe to our newsletter for updates and new content
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <button class="btn btn-primary px-4 py-3 w-100" type="submit">
                                                <i class="fas fa-paper-plane me-2"></i> Send Message
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Form Response Message -->
                                <div id="formResponse" class="mt-4 d-none">
                                    <div class="alert alert-dismissible fade show">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <span id="responseMessage"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section py-5">
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center mb-5">
                        <h2 class="fw-bold mb-3">Frequently Asked Questions</h2>
                        <p class="text-muted">Quick answers to common questions</p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="accordion" id="faqAccordion">
                            <!-- FAQ Item 1 -->
                            <div class="accordion-item border-0 shadow-sm mb-3">
                                <h3 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                        How long does it take to get a response?
                                    </button>
                                </h3>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        We typically respond to all inquiries within 24-48 hours. During weekends or holidays, responses may take slightly longer. For urgent matters, please mention "URGENT" in your subject line.
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 2 -->
                            <div class="accordion-item border-0 shadow-sm mb-3">
                                <h3 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                        Do you accept guest posts or collaborations?
                                    </button>
                                </h3>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes! We're always open to quality collaborations. Please use the "Collaborate" option above or select "Collaboration" in the inquiry type dropdown. Include details about your proposal and any relevant samples of your work.
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 3 -->
                            <div class="accordion-item border-0 shadow-sm mb-3">
                                <h3 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                        Can I advertise on your blog?
                                    </button>
                                </h3>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Absolutely! We offer various advertising options for brands and businesses. Select "Advertising" in the inquiry type dropdown or email us directly at advertising@blogname.com to discuss rates, audience demographics, and available ad spaces.
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 4 -->
                            <div class="accordion-item border-0 shadow-sm mb-3">
                                <h3 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                        What topics do you cover on your blog?
                                    </button>
                                </h3>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Our blog covers a wide range of topics including technology, lifestyle, travel, personal development, and current trends. We're always looking to provide engaging, informative content that resonates with our readers.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- footer -->
    <?php include "./includes/footer.php" ?>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <?php include "./includes/js.php" ?>
    <!-- script js  -->
    <script>
        document.getElementById('blogContactForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const formResponse = document.getElementById('formResponse');
            const responseMessage = document.getElementById('responseMessage');

            fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    formResponse.classList.remove('d-none');

                    if (data.status === 'success') {
                        formResponse.querySelector('.alert').classList.add('alert-success');
                        formResponse.querySelector('.alert').classList.remove('alert-danger');
                        responseMessage.textContent = data.message || 'Message sent successfully!';
                        form.reset();
                    } else {
                        formResponse.querySelector('.alert').classList.add('alert-danger');
                        formResponse.querySelector('.alert').classList.remove('alert-success');
                        responseMessage.textContent = data.message || 'An error occurred. Please try again.';
                    }
                })
                .catch(error => {
                    formResponse.classList.remove('d-none');
                    formResponse.querySelector('.alert').classList.add('alert-danger');
                    formResponse.querySelector('.alert').classList.remove('alert-success');
                    responseMessage.textContent = 'Network error. Please check your connection.';
                    console.error('Error:', error);
                });
        });
    </script>

</body>

</html>