<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
      @theme {
        --color-primary: #084E8F;
        --color-secondary: #f9f9f9;
        --color-button: #2563eb;
        --color-text-100: #7E7E7E;
        --color-text-200: #414141;
        --color-text-600: #364153;
      }
    </style>
</head>
<body class="flex items-center justify-center h-screen bg-gradient-to-r from-gray-200 to-blue-200">
    <div class="bg-white rounded-3xl shadow-lg relative overflow-hidden w-[768px] max-w-full min-h-[480px]">
        <div class="absolute w-full h-full opacity-100 z-10 flex flex-col justify-center items-center px-10 text-center sign-in">
            <h1 class="text-2xl font-semibold">Sign In</h1>
            <span class="text-sm">use your email for Login</span>
            <input type="email" placeholder="Email" class="mt-10 w-full bg-gray-200 my-2 p-2 rounded-lg border border-gray-300 outline-none">
            <input type="password" placeholder="Password" class="w-full bg-gray-200 my-2 p-2 rounded-lg border border-gray-300 outline-none">
            <a href="#" class="text-xs text-gray-600 mt-2 hover:underline">Forget Password?</a>
            <button class="bg-purple-700 text-white px-6 py-2 rounded-lg mt-4 hover:bg-purple-800 transition">Sign In</button>
        </div>
    </div>
</body>
</html>