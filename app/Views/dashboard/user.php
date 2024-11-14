<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h2>Welcome, User</h2>
    <p>This is the user dashboard.</p>
    <a href="/auth/logout">Logout</a>

<div class="container mt-4">
    <h1>Welcome to the Dashboard</h1>
    <p>Here you can download your user data.</p>
    
    <!-- PDF Download Button -->
    <a href="<?= site_url('download-user-data'); ?>" class="btn btn-primary">
        Download User Data in PDF
    </a>
</div>

</body>
</html>

