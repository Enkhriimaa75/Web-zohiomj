<?php
require_once 'db_connect.php';
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_breed'])) {
        try {
            $stmt = $conn->prepare("INSERT INTO breeds (NAME, description, origin, size, weight, coat, colors, lifespan, temperament, grooming_needs, activity_level, vocalization, care_info, health_issues, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$_POST['name'], $_POST['description'], $_POST['origin'], $_POST['size'], $_POST['weight'], $_POST['coat'], $_POST['colors'], $_POST['lifespan'], $_POST['temperament'], $_POST['grooming_needs'], $_POST['activity_level'], $_POST['vocalization'], $_POST['care_info'], $_POST['health_issues'], $_POST['image_url']]);
            $message = "Breed added successfully!";
            $messageType = "success";
        } catch(PDOException $e) {
            $message = "Error: " . $e->getMessage();
            $messageType = "danger";
        }
    } elseif (isset($_POST['delete_breed'])) {
        try {
            $stmt = $conn->prepare("DELETE FROM breeds WHERE id = ?");
            $stmt->execute([$_POST['breed_id']]);
            $message = "Breed deleted successfully!";
            $messageType = "success";
        } catch(PDOException $e) {
            $message = "Error: " . $e->getMessage();
            $messageType = "danger";
        }
    }
}
$stmt = $conn->query("SELECT * FROM breeds ORDER BY NAME ASC");
$breeds = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px;">

<div style="max-width: 1200px; margin: 0 auto;">
    
    <div style="background: white; padding: 15px; border-radius: 10px; margin-bottom: 30px; text-align: center;">
        <a href="index.html" style="color: #9b59b6; text-decoration: none; margin: 0 15px; font-weight: bold;">Home</a>
        <a href="breeds.php" style="color: #9b59b6; text-decoration: none; margin: 0 15px; font-weight: bold;">Cat Breeds</a>
        <a href="care.html" style="color: #9b59b6; text-decoration: none; margin: 0 15px; font-weight: bold;">Care Guide</a>
        <a href="admin.php" style="color: #9b59b6; text-decoration: none; margin: 0 15px; font-weight: bold;">Admin</a>
    </div>

    <h1 style="color: white; text-align: center; font-size: 42px; margin-bottom: 30px;">🔧 Admin Panel</h1>

    <?php if ($message): ?>
    <div style="background: <?php echo $messageType === 'success' ? '#d4edda' : '#f8d7da'; ?>; color: <?php echo $messageType === 'success' ? '#155724' : '#721c24'; ?>; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
        <strong><?php echo $message; ?></strong>
    </div>
    <?php endif; ?>

    <div style="background: white; padding: 30px; border-radius: 15px; margin-bottom: 30px;">
        <h2 style="color: #9b59b6; margin-bottom: 20px;">➕ Add New Breed</h2>
        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label style="font-weight: bold;">Breed Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label style="font-weight: bold;">Origin *</label>
                    <input type="text" name="origin" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label style="font-weight: bold;">Description *</label>
                <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label style="font-weight: bold;">Size *</label>
                    <input type="text" name="size" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label style="font-weight: bold;">Weight *</label>
                    <input type="text" name="weight" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label style="font-weight: bold;">Lifespan *</label>
                    <input type="text" name="lifespan" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label style="font-weight: bold;">Coat *</label>
                    <input type="text" name="coat" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label style="font-weight: bold;">Colors *</label>
                    <input type="text" name="colors" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label style="font-weight: bold;">Grooming *</label>
                    <select name="grooming_needs" class="form-select" required>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label style="font-weight: bold;">Activity *</label>
                    <select name="activity_level" class="form-select" required>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                        <option value="Very High">Very High</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label style="font-weight: bold;">Vocalization *</label>
                    <select name="vocalization" class="form-select" required>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label style="font-weight: bold;">Temperament *</label>
                <textarea name="temperament" class="form-control" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label style="font-weight: bold;">Care Info *</label>
                <textarea name="care_info" class="form-control" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label style="font-weight: bold;">Health Issues</label>
                <textarea name="health_issues" class="form-control" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label style="font-weight: bold;">Image URL *</label>
                <input type="url" name="image_url" class="form-control" required>
            </div>
            <button type="submit" name="add_breed" style="background: #9b59b6; color: white; border: none; padding: 12px 30px; font-size: 16px; border-radius: 5px; cursor: pointer;">Add Breed</button>
        </form>
    </div>

    <div style="background: white; padding: 30px; border-radius: 15px;">
        <h2 style="color: #9b59b6; margin-bottom: 20px;">📋 All Breeds (<?php echo count($breeds); ?> total)</h2>
        
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: linear-gradient(135deg, #9b59b6, #667eea);">
                    <th style="padding: 15px; text-align: left; color: white;">BREED NAME</th>
                    <th style="padding: 15px; text-align: left; color: white;">ORIGIN</th>
                    <th style="padding: 15px; text-align: left; color: white;">SIZE</th>
                    <th style="padding: 15px; text-align: left; color: white;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($breeds as $breed): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 15px; color: #9b59b6; font-weight: bold; font-size: 17px;"><?php echo htmlspecialchars($breed['NAME']); ?></td>
                    <td style="padding: 15px; color: #000;"><?php echo htmlspecialchars($breed['origin']); ?></td>
                    <td style="padding: 15px; color: #000;"><?php echo htmlspecialchars($breed['size']); ?></td>
                    <td style="padding: 15px;">
                        <a href="breeds.php" target="_blank" style="background: #17a2b8; color: white; padding: 6px 12px; text-decoration: none; border-radius: 5px; margin-right: 5px;">View</a>
                        <form method="POST" style="display: inline;" onsubmit="return confirm('Delete <?php echo htmlspecialchars($breed['NAME']); ?>?');">
                            <input type="hidden" name="breed_id" value="<?php echo $breed['id']; ?>">
                            <button type="submit" name="delete_breed" style="background: #dc3545; color: white; padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer;">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>