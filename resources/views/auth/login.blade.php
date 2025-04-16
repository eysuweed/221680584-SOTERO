<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Welcome Back</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    class="w-full px-4 py-2 border rounded-lg"
                >
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-gray-700 mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    class="w-full px-4 py-2 border rounded-lg"
                >
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

                @if(session('error'))
                    <div class="text-red-500 text-sm mt-2">{{ session('error') }}</div>
                @endif
            </div>

            <!-- Login Button -->
            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300"
            >
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register now</a>
        </p>
    </div>
</div>

</body>
</html>
