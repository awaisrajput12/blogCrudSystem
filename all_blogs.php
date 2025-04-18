<?php
session_start();
require_once './config/db.php';

// Get categories with post counts
$categoryQuery = "SELECT category, COUNT(*) as count FROM blog_posts WHERE is_approved = 1 GROUP BY category";
$categoryResult = $conn->query($categoryQuery);
$categories = [];
while ($cat = $categoryResult->fetch_assoc()) {
    $categories[$cat['category']] = $cat['count'];
}

// Get current category filter
$currentCategory = isset($_GET['category']) ? $_GET['category'] : 'all';
?>

<!DOCTYPE html>
<html lang="en">

<?php include "./includes/header.php" ?>

<body>
    <!-- navbar -->
    <?php include "./includes/navbar.php" ?>

    <!-- Blog Header -->
    <section class="blog-header">
        <div class="container">
            <h1><?= $currentCategory === 'all' ? 'All Blog Posts' : htmlspecialchars($currentCategory) ?></h1>
            <p>
                <?php if ($currentCategory === 'all'): ?>
                    Discover our complete collection of articles, tutorials, and stories from our community of writers.
                <?php else: ?>
                    Explore all posts in the <?= htmlspecialchars($currentCategory) ?> category.
                <?php endif; ?>
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <!-- Current Category Display -->
        <div class="current-category">
            <h2>Currently Viewing:
                <span class="badge"><?= $currentCategory === 'all' ? 'All Categories' : htmlspecialchars($currentCategory) ?></span>
            </h2>
        </div>

        <!-- Top Categories -->
        <div class="top-categories">
            <h2>Browse by Category</h2>
            <div class="text-center">
                <a href="all_blogs.php" class="category-badge <?= $currentCategory === 'all' ? 'active' : '' ?>">
                    All Categories
                    <span class="count"><?= array_sum($categories) ?></span>
                </a>
                <?php foreach ($categories as $category => $count): ?>
                    <a href="all_blogs.php?category=<?= urlencode($category) ?>"
                        class="category-badge <?= $currentCategory === $category ? 'active' : '' ?>">
                        <?= htmlspecialchars($category) ?>
                        <span class="count"><?= $count ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="row">
            <!-- Blog Posts Column -->
            <div class="col-lg-8">
                <div class="row" id="blog-container">
                    <?php
                    // Pagination setup
                    $postsPerPage = 6;
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $postsPerPage;

                    // Base query
                    $sql = "SELECT id, title, content, category, image_path, author, likes, created_at 
                            FROM blog_posts 
                            WHERE is_approved = 1";

                    // Add category filter if specified
                    if ($currentCategory !== 'all') {
                        $sql .= " AND category = '" . $conn->real_escape_string($currentCategory) . "'";
                    }

                    // Get total number of posts for pagination
                    $totalPostsQuery = "SELECT COUNT(*) as total FROM blog_posts WHERE is_approved = 1";
                    if ($currentCategory !== 'all') {
                        $totalPostsQuery .= " AND category = '" . $conn->real_escape_string($currentCategory) . "'";
                    }
                    $totalResult = $conn->query($totalPostsQuery);
                    $totalPosts = $totalResult->fetch_assoc()['total'];
                    $totalPages = ceil($totalPosts / $postsPerPage);

                    // Complete the query with ordering and pagination
                    $sql .= " ORDER BY created_at DESC LIMIT $postsPerPage OFFSET $offset";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()):
                            // Limit content preview length
                            $content_preview = strlen($row['content']) > 150 ?
                                substr($row['content'], 0, 150) . '...' :
                                $row['content'];
                            // Format the date
                            $created_date = date('F j, Y', strtotime($row['created_at']));
                    ?>
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <?php if (!empty($row['image_path'])): ?>
                                        <img src="user/<?= htmlspecialchars($row['image_path']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/600x400?text=No+Image" class="card-img-top" alt="No image available">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <span class="badge bg-primary"><?= htmlspecialchars($row['category']) ?></span>
                                        <h3 class="card-title"><?= htmlspecialchars($row['title']) ?></h3>
                                        <p class="card-text"><?= htmlspecialchars($content_preview) ?></p>

                                        <div class="author-info">
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($row['author']) ?>&background=random" alt="Author" class="author-img">
                                            <div>
                                                <p class="author-name mb-0"><?= htmlspecialchars($row['author']) ?></p>
                                                <small class="post-date"><?= $created_date ?></small>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <button class="btn-like">
                                                <i class="far fa-heart"></i>
                                                <span class="like-count"><?= htmlspecialchars($row['likes']) ?></span>
                                            </button>
                                            <a href="blog_deatils.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                    } else {
                        ?>
                        <div class="col-12 text-center py-5">
                            <h4>No blog posts found in this category.</h4>
                            <p>Check back later for new content!</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Blog pagination">
                        <ul class="pagination">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="all_blogs.php?page=<?= $page - 1 ?><?= $currentCategory !== 'all' ? '&category=' . urlencode($currentCategory) : '' ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="all_blogs.php?page=<?= $i ?><?= $currentCategory !== 'all' ? '&category=' . urlencode($currentCategory) : '' ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($page < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="all_blogs.php?page=<?= $page + 1 ?><?= $currentCategory !== 'all' ? '&category=' . urlencode($currentCategory) : '' ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- Search Box -->
                    <div class="sidebar-card">
                        <div class="sidebar-body">
                            <div class="search-box">
                                <input type="text" class="search-input" placeholder="Search blogs...">
                                <button class="search-btn"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="sidebar-card">
                        <div class="sidebar-header">
                            Categories
                        </div>
                        <div class="sidebar-body">
                            <ul class="categories-list">
                                <li class="category-item <?= $currentCategory === 'all' ? 'active' : '' ?>" data-category="all">
                                    All Categories
                                    <span class="category-count"><?= array_sum($categories) ?></span>
                                </li>
                                <?php foreach ($categories as $category => $count): ?>
                                    <li class="category-item <?= $currentCategory === $category ? 'active' : '' ?>" data-category="<?= htmlspecialchars($category) ?>">
                                        <?= htmlspecialchars($category) ?>
                                        <span class="category-count"><?= $count ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Popular Posts -->
                    <div class="sidebar-card">
                        <div class="sidebar-header">
                            Popular Posts
                        </div>
                        <div class="sidebar-body">
                            <?php
                            // Get popular posts (most liked)
                            $popularQuery = "SELECT id, title, image_path, created_at, likes 
                                            FROM blog_posts 
                                            WHERE is_approved = 1 
                                            ORDER BY likes DESC 
                                            LIMIT 3";
                            $popularResult = $conn->query($popularQuery);

                            if ($popularResult->num_rows > 0):
                                while ($popular = $popularResult->fetch_assoc()):
                                    $popularDate = date('M j, Y', strtotime($popular['created_at']));
                            ?>
                                    <div class="popular-post">
                                        <?php if (!empty($popular['image_path'])): ?>
                                            <img src="user/<?= htmlspecialchars($popular['image_path']) ?>" alt="<?= htmlspecialchars($popular['title']) ?>" class="popular-post-img">
                                        <?php else: ?>
                                            <img src="https://via.placeholder.com/70x70?text=No+Image" alt="No image" class="popular-post-img">
                                        <?php endif; ?>
                                        <div>
                                            <h4 class="popular-post-title">
                                                <a href="blog_deatils.php?id=<?= $popular['id'] ?>" class="text-decoration-none"><?= htmlspecialchars($popular['title']) ?></a>
                                            </h4>
                                            <div class="d-flex align-items-center">
                                                <small class="popular-post-date me-2"><?= $popularDate ?></small>
                                                <small class="text-muted"><i class="fas fa-heart me-1"></i><?= $popular['likes'] ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                            else:
                                ?>
                                <p class="text-muted">No popular posts yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Tags Cloud -->
                    <div class="sidebar-card">
                        <div class="sidebar-header">
                            Tags
                        </div>
                        <div class="sidebar-body">
                            <?php
                            // Get all tags (assuming you have a tags system)
                            $tagsQuery = "SELECT tag_name FROM tags ORDER BY RAND() LIMIT 12";
                            $tagsResult = $conn->query($tagsQuery);

                            if ($tagsResult->num_rows > 0):
                            ?>
                                <div class="d-flex flex-wrap">
                                    <?php while ($tag = $tagsResult->fetch_assoc()): ?>
                                        <a href="#" class="btn btn-sm btn-outline-secondary m-1"><?= htmlspecialchars($tag['tag_name']) ?></a>
                                    <?php endwhile; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted">No tags available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "./includes/footer.php" ?>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <?php include "./includes/js.php" ?>
    <!-- script js  -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category filtering
            const categoryItems = document.querySelectorAll('.category-item');

            categoryItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Get selected category
                    const category = this.getAttribute('data-category');

                    // Redirect to filtered page
                    if (category === 'all') {
                        window.location.href = 'all_blogs.php';
                    } else {
                        window.location.href = `all_blogs.php?category=${encodeURIComponent(category)}`;
                    }
                });
            });

            // Like button functionality
            const likeButtons = document.querySelectorAll('.btn-like');

            likeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const likeCount = this.querySelector('.like-count');
                    let count = parseInt(likeCount.textContent);

                    this.classList.toggle('liked');

                    if (this.classList.contains('liked')) {
                        icon.classList.replace('far', 'fas');
                        likeCount.textContent = count + 1;

                        // Here you would typically send an AJAX request to update the like count in the database
                    } else {
                        icon.classList.replace('fas', 'far');
                        likeCount.textContent = count - 1;

                        // Here you would typically send an AJAX request to update the like count in the database
                    }
                });
            });

            // Search functionality
            const searchInput = document.querySelector('.search-input');
            const searchBtn = document.querySelector('.search-btn');

            searchBtn.addEventListener('click', function() {
                const searchTerm = searchInput.value.trim();
                if (searchTerm) {
                    window.location.href = `all_blogs.php?search=${encodeURIComponent(searchTerm)}`;
                }
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const searchTerm = searchInput.value.trim();
                    if (searchTerm) {
                        window.location.href = `all_blogs.php?search=${encodeURIComponent(searchTerm)}`;
                    }
                }
            });
        });
    </script>

</body>

</html>