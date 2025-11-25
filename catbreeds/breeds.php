<?php
require_once 'db_connect.php';
$stmt = $conn->query("SELECT * FROM breeds ORDER BY NAME ASC");
$breeds = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cat Breeds - Database Powered</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
<div class="container-fluid justify-content-center">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse justify-content-center" id="navbarNav">
<ul class="navbar-nav">
<li class="nav-item"><a class="nav-link fw-bold px-4 py-3" href="index.html">Home</a></li>
<li class="nav-item"><a class="nav-link fw-bold px-4 py-3" href="breeds.php">Cat Breeds</a></li>
<li class="nav-item"><a class="nav-link fw-bold px-4 py-3" href="care.html">Care Guide</a></li>
<li class="nav-item"><a class="nav-link fw-bold px-4 py-3" href="admin.php">Admin</a></li>
</ul>
</div>
</div>
</nav>

<div class="title-section">
<h1>🐈 All Cat Breeds (Database Powered!)</h1>
<p>Showing data from your MySQL database</p>
</div>

<div class="main-container">
<div class="alert alert-success text-center">
<strong><i class="bi bi-database-check me-2"></i>Success!</strong> Showing <?php echo count($breeds); ?> breeds from database!
</div>

<div class="row g-4">
<?php foreach ($breeds as $breed): ?>
<div class="col-lg-4 col-md-6">
<div class="card h-100">
<img src="<?php echo htmlspecialchars($breed['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($breed['NAME']); ?>">
<div class="card-body">
<h3 class="card-title"><?php echo htmlspecialchars($breed['NAME']); ?></h3>
<p><strong>Origin:</strong> <?php echo htmlspecialchars($breed['origin']); ?></p>
<p><strong>Size:</strong> <?php echo htmlspecialchars($breed['size']); ?></p>
<p><?php echo htmlspecialchars(substr($breed['description'], 0, 150)); ?>...</p>
<button class="btn btn-outline-primary w-100" data-bs-toggle="collapse" data-bs-target="#details-<?php echo $breed['id']; ?>">View Details</button>
<div class="collapse mt-3" id="details-<?php echo $breed['id']; ?>">
<hr>
<p><strong>Temperament:</strong> <?php echo htmlspecialchars($breed['temperament']); ?></p>
<p><strong>Care:</strong> <?php echo htmlspecialchars($breed['care_info']); ?></p>
</div>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
</div>

<footer>
<div class="container">
<p><strong>Author:</strong> E.Enkhriimaa MT-2</p>
<p>&copy; 2025 Cat Breeds Guide</p>
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>