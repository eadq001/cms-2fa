<?php view('partials/head.php', [
    'pageTitle' => 'Email Verification'
]); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        /* Hide spin buttons for number inputs (optional, for single digit OTP inputs) */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm animate-fade-in">
        <h2 class="text-2xl font-bold text-center mb-4 text-gray-800">Verify OTP</h2>
        <p class="text-center text-gray-600 mb-6 text-sm">
            A 6-digit verification code has been sent to your email (or phone number).
        </p>
        <form id="otpForm" action="/verify_email" method="POST">
            <div class="flex justify-center space-x-2 mb-6">
                <!-- OTP Input Fields -->
                <input type="text" id="otp-1" name="otp-1" maxlength="1"
                       class="otp-input w-12 h-12 text-center text-2xl font-bold border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                       inputmode="numeric" pattern="[0-9]*" required>
                <input type="text" id="otp-2" name="otp-2" maxlength="1"
                       class="otp-input w-12 h-12 text-center text-2xl font-bold border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                       inputmode="numeric" pattern="[0-9]*" required>
                <input type="text" id="otp-3" name="otp-3" maxlength="1"
                       class="otp-input w-12 h-12 text-center text-2xl font-bold border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                       inputmode="numeric" pattern="[0-9]*" required>
                <input type="text" id="otp-4" name="otp-4" maxlength="1"
                       class="otp-input w-12 h-12 text-center text-2xl font-bold border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                       inputmode="numeric" pattern="[0-9]*" required>
                <input type="text" id="otp-5" name="otp-5" maxlength="1"
                       class="otp-input w-12 h-12 text-center text-2xl font-bold border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                       inputmode="numeric" pattern="[0-9]*" required>
                <input type="text" id="otp-6" name="otp-6" maxlength="1"
                       class="otp-input w-12 h-12 text-center text-2xl font-bold border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                       inputmode="numeric" pattern="[0-9]*" required>
            </div>

            <div class="flex items-center justify-between mb-4">
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full"
                >
                    Verify Code
                </button>
            </div>
            <div class="text-center text-sm">
                <a href="#" class="font-bold text-blue-500 hover:text-blue-800" onclick="alert('Resending OTP...')">
                    Resend Code
                </a>
            </div>
        </form>
        <div class="text-center mt-6">
            <a href="login.html" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                Back to Login
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const otpInputs = document.querySelectorAll('.otp-input');
            const otpForm = document.getElementById('otpForm');

            otpInputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    // Move to next input if a digit is entered
                    if (e.data && /^\d$/.test(e.data)) { // Check if input data is a single digit
                        if (index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                    }
                });

                input.addEventListener('keydown', (e) => {
                    // Move to previous input on backspace if current is empty
                    if (e.key === 'Backspace' && input.value === '') {
                        if (index > 0) {
                            otpInputs[index - 1].focus();
                        }
                    }
                });
            });

            otpForm.addEventListener('submit', (e) => {
                e.preventDefault(); // Prevent actual form submission for this demo
                let otpCode = '';
                otpInputs.forEach(input => {
                    otpCode += input.value;
                });
                alert('OTP Submitted: ' + otpCode);
                console.log('OTP Submitted:', otpCode);
                // In a real application, you would send otpCode to your server for verification
            });
        });
    </script>
</body>
</html>
</div>

<?php view('partials/footer.php'); ?>