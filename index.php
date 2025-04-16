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
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="hero-title">Welcome to Blog Pro</h1>
                    <p class="hero-subtitle">Discover amazing content, share your thoughts, and connect with a community of passionate writers and readers.</p>
                    <div class="d-flex justify-content-center flex-wrap">
                        <a href="./register.php" class="hero-btn btn btn-primary">Get Started</a>
                        <a href="#features" class="hero-btn btn btn-outline-light">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section with Image -->
    <section class="content-section" id="features">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="content-text">
                        <h2 class="content-title">Create Beautiful Blog Posts</h2>
                        <p class="content-description">
                            Our platform makes it easy to create stunning blog posts with a simple, intuitive interface.
                            Whether you're a professional writer or just starting out, you'll love the powerful tools
                            we provide to help you express your ideas.
                        </p>
                        <div>
                            <a href="./create_post.php" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 0.8rem 2rem; font-weight: 500; transition: all 0.3s ease; color: white; ">Start Writing</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1546074177-ffdda98d214f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Blogging illustration" class="content-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="content-title">What Our Readers Say</h2>
                    <p class="content-description">Hear from our community of passionate readers</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" class="rounded-circle mb-3" width="80" alt="User">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="card-text">"The articles here have helped me grow my business exponentially. The quality of content is unmatched!"</p>
                            <h6 class="card-title mb-1">Sarah Johnson</h6>
                            <p class="small text-muted">Marketing Director</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/men/75.jpg" class="rounded-circle mb-3" width="80" alt="User">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="card-text">"I've been following this blog for years. The travel guides are incredibly detailed and accurate."</p>
                            <h6 class="card-title mb-1">Michael Chen</h6>
                            <p class="small text-muted">Travel Blogger</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle mb-3" width="80" alt="User">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="card-text">"The recipes are easy to follow and delicious. My family loves the weekly meal prep ideas!"</p>
                            <h6 class="card-title mb-1">Emily Rodriguez</h6>
                            <p class="small text-muted">Home Chef</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call-to-Action Section -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2>Ready to start your blogging journey?</h2>
                    <p class="mb-md-0">Join thousands of writers who are already sharing their knowledge and passion with the world.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="./register.php"><button class="btn btn-light btn-lg px-4">Register Now</button></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-9 left-section">
                <h2 class="mb-4">Latest Blog Posts</h2>
                <div class="row" id="card-container">
                    <?php
                    // Fetch blog posts
                    $sql = "SELECT id, title, content, category, image_path, author, likes, created_at 
                    FROM blog_posts 
                    WHERE is_approved = 1 
                    ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    // Check if there are any approved posts
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()):
                            // Limit content preview length
                            $content_preview = strlen($row['content']) > 150 ?
                                substr($row['content'], 0, 150) . '...' :
                                $row['content'];
                            // Format the date
                            $created_date = date('F j, Y', strtotime($row['created_at']));
                    ?>
                            <div class="col-md-6 mb-4 card-item" data-category="<?= htmlspecialchars($row['category']) ?>">
                                <div class="card">
                                    <?php if (!empty($row['image_path'])): ?>
                                        <img src="user/<?= htmlspecialchars($row['image_path']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/600x400?text=No+Image" class="card-img-top" alt="No image available">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <span class="badge bg-primary"><?= htmlspecialchars($row['category']) ?></span>
                                        <h3 class="card-title mt-2"><?= htmlspecialchars($row['title']) ?></h3>
                                        <p class="card-text"><?= htmlspecialchars($content_preview) ?></p>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div>
                                                <small class="text-muted"> <?= htmlspecialchars($row['author']) ?></small><br>
                                                <small class="text-muted"> <?= $created_date ?></small>
                                            </div>
                                            <div>
                                                <button class="btn btn-like">
                                                    <i class="far fa-heart"></i>
                                                    <span class="like-count"><?= htmlspecialchars($row['likes']) ?></span>
                                                </button>
                                                <a href="blog_deatils.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                    } else {
                        // Display a message when no approved posts are found
                        ?>
                        <div class="col-12 text-center py-5">
                            <h4>No approved blog posts found.</h4>
                            <p>Check back later or submit your own post!</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-3 right-section">
                <h2>Categories</h2>
                <ul class="categories-list">
                    <li class="category-item active" data-category="all">All Categories</li>
                    <li class="category-item" data-category="technology">Technology</li>
                    <li class="category-item" data-category="business">Business</li>
                    <li class="category-item" data-category="health">Health</li>
                    <li class="category-item" data-category="education">Education</li>
                    <li class="category-item" data-category="entertainment">Entertainment</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center my-5">
        <a href="all_blogs.php" class="modern-btn text-decoration-none">
            <span class="btn-text">All Blogs</span>
            <span class="btn-icon">→</span>
        </a>
    </div>

    <!-- Footer -->
    <?php include "./includes/footer.php" ?>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all elements
            const categoryItems = document.querySelectorAll('.category-item');
            const cards = document.querySelectorAll('#card-container .card-item');
            const likeButtons = document.querySelectorAll('.btn-like');

            // Category filtering
            categoryItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Reset pagination
                    currentPage = 1;

                    // Update active state
                    categoryItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');

                    // Filter cards
                    const category = this.getAttribute('data-category');
                    filteredCards = Array.from(cards).filter(card =>
                        category === 'all' || card.getAttribute('data-category') === category
                    );

                    // Show initial cards
                    showCards();
                });
            });

            // Like button functionality
            likeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const likeCount = this.querySelector('.like-count');
                    let count = parseInt(likeCount.textContent);

                    this.classList.toggle('liked');

                    if (this.classList.contains('liked')) {
                        icon.classList.replace('far', 'fas');
                        likeCount.textContent = count + 1;
                    } else {
                        icon.classList.replace('fas', 'far');
                        likeCount.textContent = count - 1;
                    }
                });
            });

            // Close mobile menu when clicking a link
            const navbarContent = document.querySelector('#navbarContent');
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        const bsCollapse = new bootstrap.Collapse(navbarContent, {
                            toggle: false
                        });
                        bsCollapse.hide();
                    }
                });
            });

            // Add active class to clicked nav item
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    navItems.forEach(i => i.querySelector('.nav-link').classList.remove('active'));
                    this.querySelector('.nav-link').classList.add('active');
                });
            });

            // Initial page load
            showCards();
        });
    </script>
</body>

</html>