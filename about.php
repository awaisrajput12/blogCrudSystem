<?php
session_start();
require_once './config/db.php';

?>
<!DOCTYPE html>
<html lang="en">

<?php include "./includes/header.php" ?>

<body>
    <!-- navbar -->
    <?php include "./includes/navbar.php" ?>

    <!-- Hero Section -->
    <section class="hero-section-1 text-center">
        <div class="hero"></div>
        <div class="container hero-content">
            <h1 class="display-3 mb-4 fw-bold">Empowering Voices, Connecting Minds</h1>
            <p class="lead mb-5">Blog Pro: Where Every Story Finds Its Platform</p>
            <div class="hero-buttons">
                <a href="#our-story" class="btn btn-light btn-lg px-5 shadow-sm">Our Story</a>
                <a href="#team" class="btn btn-outline-light btn-lg px-5 shadow-sm">Meet the Team</a>
            </div>
        </div>
    </section>

    <!-- Mission and Vision -->
    <section class="mission-vision" id="our-story">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="mission-card">
                        <h2 class="mb-4">Our Mission</h2>
                        <p class="lead">To democratize content creation, empowering individuals from all walks of life to share their unique stories, insights, and perspectives with the world.</p>
                        <p>We believe that every person has a valuable story to tell, and we provide the tools, community, and platform to amplify those voices.</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="vision-card">
                        <h2 class="mb-4">Our Vision</h2>
                        <p class="lead">To become the most inclusive, innovative, and inspiring global platform for content creators.</p>
                        <p>We envision a world where creativity knows no boundaries, where writers can connect, learn, and grow together, transcending geographical and cultural limitations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="core-values">
        <div class="container">
            <h2 class="text-center mb-5">Our Core Values</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3>Creativity</h3>
                        <p>We champion original thinking and provide a canvas for unbridled creativity.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Community</h3>
                        <p>We believe in the power of connection and mutual support among creators.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Integrity</h3>
                        <p>We maintain the highest standards of honesty, respect, and ethical content creation.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Timeline -->
    <section class="timeline" id="timeline">
        <div class="container">
            <h2 class="text-center mb-5">Our Evolutionary Journey</h2>
            <div class="timeline-container">
                <div class="timeline-item">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">2018: The Spark</h3>
                            <p>Blog Pro began as a passionate startup, driven by the belief that everyone has a unique story to share.</p>
                        </div>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">2020: Global Expansion</h3>
                            <p>We launched globally, connecting writers from over 50 countries and creating a truly international community.</p>
                        </div>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">2022: Innovation Breakthrough</h3>
                            <p>Introduced AI-powered writing tools and advanced content recommendation algorithms.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section" id="team">
        <div class="container">
            <h2 class="text-center mb-5">Meet Our Founders</h2>
            <div class="row">
                <div class="col-md-4 team-member">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Emily Rodriguez">
                    <h4 class="mt-4">Emily Rodriguez</h4>
                    <p class="text-muted">Founder & CEO</p>
                    <p class="small">A visionary leader passionate about democratizing content creation.</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="./assets/imgs/MainPhoto_cropped.jpg" alt="Michael Chen">
                    <h4 class="mt-4">Michael Chen</h4>
                    <p class="text-muted">CTO & Lead Developer</p>
                    <p class="small">Tech innovator driving our platform's cutting-edge features.</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Sarah Thompson">
                    <h4 class="mt-4">Sarah Thompson</h4>
                    <p class="text-muted">Creative Director</p>
                    <p class="small">Design maestro ensuring our platform's intuitive experience.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include "./includes/footer.php" ?>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <?php include "./includes/js.php" ?>
    <!-- script js  -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

</body>

</html>