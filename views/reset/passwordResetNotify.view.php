<?php view('partials/head.php', [
    'pageTitle' => 'Password Reset Link'
]); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Link</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm animate-fade-in">
        <h2 class="text-2xl font-bold text-center mb-4 text-gray-800">Password Reset Link</h2>
        <p class="text-center text-gray-600 mb-6 text-sm">
            A password reset link has been sent to <b><?= $email ?></b>.
        </p>
        <div class="text-center mt-6">
            <a href="/login" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                Back to Login
            </a>
        </div>
    </div>


</body>
</html>
</div>

<?php view('partials/footer.php'); ?>