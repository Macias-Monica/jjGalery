<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 50px;
        }
        h2, h1 {
            color: #007bff;
        }
        .btn-container {
            display: flex;
            gap: 15px;
        }
        .logout-link {
            float: right;
            color: #dc3545;
        }
        .logout-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Welcome, User</h2>
            <a href="/auth/logout" class="logout-link">Logout</a>
        </div>
        <p>This is the user dashboard, where you can manage your information and download data.</p>
    </header>

    <!-- Main Content Section -->
    <div class="container mt-4">
        <h1>User Dashboard</h1>
        <p>You can download your user data in different formats below.</p>

        <!-- Download Buttons -->
        <div class="btn-container">
            <!-- PDF Download Button -->
            <a href="<?= site_url('download-user-data'); ?>" class="btn btn-primary">
                Download User Data in PDF
            </a>

            <!-- Word Download Button -->
            <a href="<?= site_url('download-user-data-word'); ?>" class="btn btn-secondary">
                Download User Data in Word
            </a>

			<!-- Image Download Button -->
			<a href="<?= site_url('download-user-data-image'); ?>" class="btn btn-success">
				Download User Data in Image
			</a>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="container text-center mt-5">
        <p>&copy; <?= date('Y'); ?> Your Application Name. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
