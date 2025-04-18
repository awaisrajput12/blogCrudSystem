<?php
session_start();
require_once './config/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<!-- head -->
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
                    <p class="hero-subtitle">Discover amazing content, share your thoughts, and connect with a community
                        of passionate writers and readers.</p>
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
                            <a href="./create_post.php" class="btn btn-primary"
                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 0.8rem 2rem; font-weight: 500; transition: all 0.3s ease; color: white; ">Start
                                Writing</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1546074177-ffdda98d214f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                        alt="Blogging illustration" class="content-img">
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
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" class="rounded-circle mb-3"
                                width="80" alt="User">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="card-text">"The articles here have helped me grow my business exponentially. The
                                quality of content is unmatched!"</p>
                            <h6 class="card-title mb-1">Sarah Johnson</h6>
                            <p class="small text-muted">Marketing Director</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/men/75.jpg" class="rounded-circle mb-3"
                                width="80" alt="User">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="card-text">"I've been following this blog for years. The travel guides are
                                incredibly detailed and accurate."</p>
                            <h6 class="card-title mb-1">Michael Chen</h6>
                            <p class="small text-muted">Travel Blogger</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle mb-3"
                                width="80" alt="User">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="card-text">"The recipes are easy to follow and delicious. My family loves the
                                weekly meal prep ideas!"</p>
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
                    <p class="mb-md-0">Join thousands of writers who are already sharing their knowledge and passion
                        with the world.</p>
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
                    // Fetch only 2 most recent blog posts
                    $sql = "SELECT id, title, content, category, image_path, author, likes, created_at 
            FROM blog_posts 
            WHERE is_approved = 1 
            ORDER BY created_at DESC 
            LIMIT 2";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()):
                            $content_preview = strlen($row['content']) > 150 ?
                                substr($row['content'], 0, 150) . '...' :
                                $row['content'];
                            $created_date = date('F j, Y', strtotime($row['created_at']));
                    ?>
                            <div class="col-md-6 mb-4 card-item" data-category="<?= htmlspecialchars($row['category']) ?>">
                                <div class="card">
                                    <?php if (!empty($row['image_path'])): ?>
                                        <img src="user/<?= htmlspecialchars($row['image_path']) ?>" class="card-img-top"
                                            alt="<?= htmlspecialchars($row['title']) ?>">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/600x400?text=No+Image" class="card-img-top"
                                            alt="No image available">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <span class="badge bg-primary">
                                            <?= htmlspecialchars($row['category']) ?>
                                        </span>
                                        <h3 class="card-title mt-2">
                                            <?= htmlspecialchars($row['title']) ?>
                                        </h3>
                                        <p class="card-text">
                                            <?= htmlspecialchars($content_preview) ?>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div>
                                                <small class="text-muted">
                                                    <?= htmlspecialchars($row['author']) ?>
                                                </small><br>
                                                <small class="text-muted">
                                                    <?= $created_date ?>
                                                </small>
                                            </div>
                                            <div>
                                                <button class="btn btn-like" data-post-id="<?= $row['id'] ?>">
                                                    <i class="far fa-heart"></i>
                                                    <span class="like-count">
                                                        <?= htmlspecialchars($row['likes']) ?>
                                                    </span>
                                                </button>
                                                <a href="blog_deatils.php?id=<?= $row['id'] ?>"
                                                    class="btn btn-sm btn-outline-primary">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                    } else {
                        ?>
                        <div class="col-12 text-center py-5">
                            <h4>No approved blog posts found.</h4>
                            <p>Check back later or submit your own post!</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Handle like button clicks
                        document.querySelectorAll('.btn-like').forEach(button => {
                            button.addEventListener('click', function() {
                                const postId = this.getAttribute('data-post-id');
                                const likeCountElement = this.querySelector('.like-count');
                                const heartIcon = this.querySelector('i');

                                // Send AJAX request to update like count
                                fetch('update_likes.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded',
                                        },
                                        body: 'post_id=' + postId
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            // Update like count display
                                            likeCountElement.textContent = data.new_likes;

                                            // Toggle heart icon
                                            if (heartIcon.classList.contains('far')) {
                                                heartIcon.classList.remove('far');
                                                heartIcon.classList.add('fas');
                                            } else {
                                                heartIcon.classList.remove('fas');
                                                heartIcon.classList.add('far');
                                            }
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                            });
                        });
                    });
                </script>
            </div>
            <div class="col-md-3 right-section">
                <h2>Categories</h2>
                <ul class="categories-list">
                    <li class="category-item active" data-category="all">All Categories</li>
                    <li class="category-item" data-category="My Life Journey">My Life Journey</li>
                    <li class="category-item" data-category="Book Notes">Book Notes</li>
                    <li class="category-item" data-category="Game Review">Game Review</li>
                    <li class="category-item" data-category="Business">Business</li>
                    <li class="category-item" data-category="Food">Food</li>
                    <li class="category-item" data-category="News">News</li>
                    <li class="category-item" data-category="Life style">Life style</li>
                    <li class="category-item" data-category="Sport">Sport</li>
                    <li class="category-item" data-category="Health">Health</li>
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
    <?php include "./includes/js.php" ?>
    <!-- script js  -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all elements
            const categoryItems = document.querySelectorAll('.category-item');
            const cardContainer = document.getElementById('card-container');

            // Category filtering
            categoryItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Update active state
                    categoryItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');

                    const category = this.getAttribute('data-category');

                    if (category === 'all') {
                        // Show 2 most recent posts for "All Categories"
                        fetchPosts('all');
                    } else {
                        // Show 2 posts from selected category
                        fetchPosts(category);
                    }
                });
            });

            // Function to fetch posts
            function fetchPosts(category) {
                const formData = new FormData();
                formData.append('category', category);

                fetch('fetch_posts.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        cardContainer.innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Like button functionality
            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-like')) {
                    const button = e.target.closest('.btn-like');
                    const icon = button.querySelector('i');
                    const likeCount = button.querySelector('.like-count');
                    let count = parseInt(likeCount.textContent);

                    button.classList.toggle('liked');

                    if (button.classList.contains('liked')) {
                        icon.classList.replace('far', 'fas');
                        likeCount.textContent = count + 1;
                    } else {
                        icon.classList.replace('fas', 'far');
                        likeCount.textContent = count - 1;
                    }
                }
            });
        });
        // Disable right-click (basic deterrent)
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // Disable text selection
        document.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });
    </script>

</body>

</html>