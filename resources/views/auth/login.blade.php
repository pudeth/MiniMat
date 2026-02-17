<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KKD POS Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .logo {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .app-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .app-subtitle {
            font-size: 13px;
            color: #666;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-bottom: 6px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #fff;
            transition: border-color 0.2s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #4a90e2;
        }

        input.error {
            border-color: #d9534f;
            background-color: #fff5f5;
        }

        .error-message {
            color: #d9534f;
            font-size: 12px;
            margin-top: 5px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        input[type="checkbox"] {
            width: 16px;
            height: 16px;
            margin-right: 8px;
            cursor: pointer;
        }

        .checkbox-label {
            font-size: 13px;
            color: #555;
            cursor: pointer;
            user-select: none;
        }

        .btn {
            width: 100%;
            padding: 12px;
            font-size: 15px;
            font-weight: bold;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-primary {
            background-color: #4a90e2;
            color: white;
        }

        .btn-primary:hover {
            background-color: #357abd;
        }

        .btn-primary:active {
            background-color: #2a6ba8;
        }

        .btn-primary:disabled {
            background-color: #a0c4e8;
            cursor: not-allowed;
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #ddd;
        }

        .divider-text {
            background-color: #fff;
            padding: 0 15px;
            font-size: 13px;
            color: #999;
            position: relative;
            display: inline-block;
        }

        .btn-google {
            background-color: #fff;
            color: #444;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-google:hover {
            background-color: #f8f8f8;
            border-color: #ccc;
        }

        .google-icon {
            width: 18px;
            height: 18px;
        }

        .footer-text {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 12px;
            color: #888;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }

            .app-title {
                font-size: 18px;
            }

            input[type="email"],
            input[type="password"] {
                font-size: 16px; /* Prevents zoom on iOS */
            }
        }

        @media (min-width: 481px) and (max-width: 768px) {
            .login-container {
                max-width: 450px;
                padding: 45px 35px;
            }
        }

        @media (min-width: 769px) {
            .login-container {
                max-width: 420px;
            }
        }
    </style>
</head>
<body>
    
    <div class="login-container">
        
        <!-- Logo & Header -->
        <div class="logo-section">
            <div class="logo">🏪</div>
            <div class="app-title">KKD POS Dashboard</div>
            <div class="app-subtitle">KHQR Payment System</div>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            
            <!-- Email Field -->
            <div class="form-group">
                <div class="app-title">Can Access only បង Admin.</div>
                <br>
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email"
                    name="email" 
                    value="{{ old('email') }}" 
                    class="@error('email') error @enderror" 
                    placeholder="Enter your email"
                    required 
                    autofocus
                >
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    class="@error('password') error @enderror" 
                    placeholder="Enter your password"
                    required
                >
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="checkbox-group">
                <input 
                    type="checkbox" 
                    name="remember" 
                    id="remember"
                >
                <label for="remember" class="checkbox-label">Remember me</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary" id="submitBtn">
                Sign In
            </button>
        </form>

        <!-- Divider -->
        <div class="divider">
            <span class="divider-text">or</span>
        </div>

        <!-- Google Login Button -->
        <a href="{{ route('auth.google') }}" class="btn btn-google">
            <svg class="google-icon" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            <span>Sign in with Google</span>
        </a>

        <!-- Footer -->
        <div class="footer-text">
            © 2026 KKD. All rights reserved.
        </div>
    </div>

    <script>
        // Disable button on form submission
        document.getElementById('loginForm').addEventListener('submit', function() {
            var btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.textContent = 'Signing in...';
        });
    </script>

</body>
</html>
