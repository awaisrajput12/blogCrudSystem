<?php
require_once './config/db.php';

$category = $_POST['category'] ?? 'all';

if ($category === 'all') {
    $sql = "SELECT id, title, content, category, image_path, author, likes, created_at 
            FROM blog_posts 
            WHERE is_approved = 1 
            ORDER BY created_at DESC 
            LIMIT 2";
} else {
    $sql = "SELECT id, title, content, category, image_path, author, likes, created_at 
            FROM blog_posts 
            WHERE is_approved = 1 AND category = '$category'
            ORDER BY created_at DESC 
            LIMIT 2";
}

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
    ?>
    <div class="col-12 text-center py-5">
        <h4>No posts found in this category.</h4>
    </div>
<?php
}
?>