<?php
session_start();
require_once './config/db.php';

// Get the post ID from URL
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the specific blog post
$sql = "SELECT * FROM blog_posts WHERE id = ? AND is_approved = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    header("Location: index.php");
    exit();
}

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
    $comment_text = trim($_POST['comment']);
    $user_id = $_SESSION['user_id'];

    if ($post_id && !empty($comment_text)) {
        $sql = "INSERT INTO comments (post_id, id, comment) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $post_id, $user_id, $comment_text);

        if ($stmt->execute()) {
            $_SESSION['comment_success'] = "Your comment has been submitted!";
        } else {
            $_SESSION['comment_error'] = "Failed to submit comment. Please try again.";
        }
        header("Location: blog_deatils.php?id=" . $post_id);
        exit();
    }
}

// Fetch comments for this post with user information
$comments_sql = "SELECT c.*, u.username 
                FROM comments c 
                JOIN users u ON c.id = u.id 
                WHERE c.post_id = ? 
                ORDER BY c.created_at DESC";
$comments_stmt = $conn->prepare($comments_sql);
$comments_stmt->bind_param("i", $post_id);
$comments_stmt->execute();
$comments_result = $comments_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<?php include "./includes/header.php" ?>

<body>
    <!-- navbar -->
    <?php include "./includes/navbar.php" ?>

    <!-- Post Hero Section -->
    <section class="post-hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <span class="badge bg-light text-primary mb-3"><?= htmlspecialchars($post['category']) ?></span>
                    <h1 class="post-hero-title"><?= htmlspecialchars($post['title']) ?></h1>

                    <div class="post-meta">
                        <div class="post-meta-item">
                            <i class="far fa-user"></i>
                            <span><?= htmlspecialchars($post['author']) ?></span>
                        </div>
                        <div class="post-meta-item">
                            <i class="far fa-calendar-alt"></i>
                            <span><?= date('F j, Y', strtotime($post['created_at'])) ?></span>
                        </div>
                        <div class="post-meta-item">
                            <i class="far fa-clock"></i>
                            <span><?= ceil(str_word_count($post['content']) / 200) ?> min read</span>
                        </div>
                        <div class="post-meta-item">
                            <i class="far fa-comment"></i>
                            <span><?= $comments_result->num_rows ?> comments</span>
                        </div>
                    </div>

                    <?php if (!empty($post['image_path'])): ?>
                        <img src="user/<?= htmlspecialchars($post['image_path']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="post-hero-image">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Post Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <article class="post-container">
                    <div class="post-content">
                        <?= nl2br(htmlspecialchars($post['content'])) ?>
                    </div>

                    <!-- Tags -->
                    <div class="post-tags">
                        <span class="post-tag">#<?= htmlspecialchars($post['category']) ?></span>
                        <span class="post-tag">#blogging</span>
                        <span class="post-tag">#writing</span>
                    </div>

                    <!-- Social Sharing -->
                    <div class="social-sharing">
                        <a href="#" class="social-btn facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-btn twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-btn linkedin"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-btn pinterest"><i class="fab fa-pinterest-p"></i></a>
                    </div>

                    <!-- Like Button -->
                    <div class="like-section">
                        <button class="btn-like <?= isset($_SESSION['liked_posts'][$post['id']]) ? 'liked' : '' ?>" data-post-id="<?= $post['id'] ?>">
                            <i class="<?= isset($_SESSION['liked_posts'][$post['id']]) ? 'fas' : 'far' ?> fa-heart"></i>
                            <span class="like-count"><?= $post['likes'] ?></span>
                        </button>
                        <span>Like this post</span>
                    </div>

                    <!-- Author Section -->
                    <div class="author-section">
                        <img src="https://randomuser.me/api/portraits/<?= rand(0, 1) ? 'men' : 'women' ?>/<?= rand(1, 100) ?>.jpg" alt="Author" class="author-avatar">
                        <div class="author-info">
                            <h4><?= htmlspecialchars($post['author']) ?></h4>
                            <p class="author-bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="comments-section">
                        <h3 class="comments-title">Comments (<?= $comments_result->num_rows ?>)</h3>

                        <?php if ($comments_result->num_rows > 0): ?>
                            <?php while ($comment = $comments_result->fetch_assoc()): ?>
                                <div class="comment">
                                    <img src="https://randomuser.me/api/portraits/<?= rand(0, 1) ? 'men' : 'women' ?>/<?= rand(1, 100) ?>.jpg" alt="Commenter" class="comment-avatar">
                                    <div class="comment-content">
                                        <div class="comment-meta">
                                            <span class="comment-author"><?= htmlspecialchars($comment['name']) ?></span>
                                            <span class="comment-date"><?= date('F j, Y \a\t g:i a', strtotime($comment['created_at'])) ?></span>
                                        </div>
                                        <p class="comment-text"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No comments yet. Be the first to comment!</p>
                        <?php endif; ?>

                        <!-- Comments Section -->
                        <div class="comments-section">
                            <h3 class="comments-title">Comments (<?= $comments_result->num_rows ?>)</h3>

                            <?php if ($comments_result->num_rows > 0): ?>
                                <?php while ($comment = $comments_result->fetch_assoc()): ?>
                                    <div class="comment">
                                        <img src="https://via.placeholder.com/50" alt="Commenter" class="comment-avatar">
                                        <div class="comment-content">
                                            <div class="comment-meta">
                                                <span class="comment-author"><?= htmlspecialchars($comment['username']) ?></span>
                                                <span class="comment-date"><?= date('F j, Y \a\t g:i a', strtotime($comment['created_at'])) ?></span>
                                            </div>
                                            <p class="comment-text"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>No comments yet. Be the first to comment!</p>
                            <?php endif; ?>

                            <!-- Comment Form -->
                            <div class="comment-form">
                                <h4 class="comment-form-title">Leave a Comment</h4>
                                <?php if (isset($_SESSION['comment_success'])): ?>
                                    <div class="alert alert-success"><?= $_SESSION['comment_success'] ?></div>
                                    <?php unset($_SESSION['comment_success']); ?>
                                <?php endif; ?>

                                <?php if (isset($_SESSION['comment_error'])): ?>
                                    <div class="alert alert-danger"><?= $_SESSION['comment_error'] ?></div>
                                    <?php unset($_SESSION['comment_error']); ?>
                                <?php endif; ?>

                                <form action="" method="POST">
                                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Your Comment</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>

    <!-- Related Posts -->
    <section class="related-posts">
        <div class="container">
            <h3 class="related-title">You Might Also Like</h3>
            <div class="row">
                <?php
                // Fetch related posts (same category)
                $related_sql = "SELECT id, title, content, image_path, created_at 
                               FROM blog_posts 
                               WHERE category = ? AND id != ? AND is_approved = 1
                               ORDER BY created_at DESC 
                               LIMIT 3";
                $related_stmt = $conn->prepare($related_sql);
                $related_stmt->bind_param("si", $post['category'], $post['id']);
                $related_stmt->execute();
                $related_result = $related_stmt->get_result();

                if ($related_result->num_rows > 0):
                    while ($related_post = $related_result->fetch_assoc()):
                        $content_preview = strlen($related_post['content']) > 100 ?
                            substr($related_post['content'], 0, 100) . '...' :
                            $related_post['content'];
                ?>
                        <div class="col-md-4 mb-4">
                            <div class="related-card">
                                <a href="view_post.php?id=<?= $related_post['id'] ?>">
                                    <?php if (!empty($related_post['image_path'])): ?>
                                        <img src="<?= htmlspecialchars($related_post['image_path']) ?>" class="card-img-top related-card-img" alt="<?= htmlspecialchars($related_post['title']) ?>">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/600x400?text=No+Image" class="card-img-top related-card-img" alt="No image available">
                                    <?php endif; ?>
                                </a>
                                <div class="related-card-body">
                                    <h5 class="related-card-title">
                                        <a href="view_post.php?id=<?= $related_post['id'] ?>" class="text-decoration-none text-dark"><?= htmlspecialchars($related_post['title']) ?></a>
                                    </h5>
                                    <p class="related-card-text"><?= htmlspecialchars($content_preview) ?></p>
                                    <small class="text-muted"><?= date('M j, Y', strtotime($related_post['created_at'])) ?></small>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                else:
                    ?>
                    <div class="col-12 text-center">
                        <p>No related posts found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include "./includes/footer.php" ?>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Like button functionality
            const likeBtn = document.querySelector('.btn-like');
            if (likeBtn) {
                likeBtn.addEventListener('click', function() {
                    const postId = this.getAttribute('data-post-id');
                    const icon = this.querySelector('i');
                    const likeCount = this.querySelector('.like-count');
                    let count = parseInt(likeCount.textContent);

                    // Toggle liked state
                    this.classList.toggle('liked');

                    // Update icon and count
                    if (this.classList.contains('liked')) {
                        icon.classList.replace('far', 'fas');
                        likeCount.textContent = count + 1;

                        // Send AJAX request to update likes
                        fetch('like_post.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'post_id=' + postId + '&action=like'
                        });
                    } else {
                        icon.classList.replace('fas', 'far');
                        likeCount.textContent = count - 1;

                        // Send AJAX request to update likes
                        fetch('like_post.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'post_id=' + postId + '&action=unlike'
                        });
                    }
                });
            }

            // Social sharing buttons
            const socialBtns = document.querySelectorAll('.social-btn');
            socialBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = window.location.href;
                    const title = document.querySelector('.post-hero-title').textContent;

                    if (this.classList.contains('facebook')) {
                        window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url), '_blank');
                    } else if (this.classList.contains('twitter')) {
                        window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(title) + '&url=' + encodeURIComponent(url), '_blank');
                    } else if (this.classList.contains('linkedin')) {
                        window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(url) + '&title=' + encodeURIComponent(title), '_blank');
                    } else if (this.classList.contains('pinterest')) {
                        const image = document.querySelector('.post-hero-image') ? document.querySelector('.post-hero-image').src : '';
                        window.open('https://pinterest.com/pin/create/button/?url=' + encodeURIComponent(url) + '&media=' + encodeURIComponent(image) + '&description=' + encodeURIComponent(title), '_blank');
                    }
                });
            });
        });
    </script>
</body>

</html>