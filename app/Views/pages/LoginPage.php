<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desnet | Login</title>
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
<body class="bg-gray-100 flex flex-col min-h-screen">
    <nav class="bg-white p-7">
        <a href="<?= base_url('/'); ?>" class="container flex justify-between items-center">
            <img src="<?= base_url('desnetLogo.png') ?>" alt="desnet logo" class="w-24">
        </a>
    </nav>

    <div class="flex flex-grow justify-center items-center">
        <div class="bg-white flex flex-col justify-center items-center w-full max-w-lg px-8 py-20 rounded-xl shadow-lg">
            <h2 class="text-black text-3xl font-bold text-center">Welcome Back!</h2>
            <p class="text-gray-400 text-sm text-center pb-6">Please enter your details</p>

            <form action="/auth" method="post" class="w-full pt-8">
                <input type="text" name="username" class="bg-white border text-black text-sm rounded-lg w-full p-2.5 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Username" required>

                <div class="relative w-full">
                    <input id="password" type="password" name="password"
                        class="bg-white border text-black text-sm rounded-lg w-full p-2.5 pr-16 mb-6 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Password" required oninput="checkInput()" onblur="checkEmpty()">

                        <button id="toggleButton" type="button" onclick="togglePassword()" 
                            class="absolute top-5 right-8 w-20 h-5 bg-white transform -translate-y-1/2 flex hidden items-center justify-end px-2">
                            <div class="bg-white rounded-lg text-right">
                                <p id="show" class="font-semibold hover:font-regular hover:text-gray-400">Show</p>
                                <p id="hide" class="font-semibold hover:font-regular hover:text-gray-400 hidden">Hide</p>
                            </div>
                        </button>
                </div>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Login</button>
            </form>
        </div>
    </div>

    <footer class="bg-white text-gray-400 font-normal text-center py-3 shadow-md">
        <p>© 2025 PT Des Teknologi Informasi All Rights Reserved</p>
    </footer>

    <script>
        function togglePassword() {
        let passwordInput = document.getElementById("password");
        let showText = document.getElementById("show");
        let hideText = document.getElementById("hide");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            showText.classList.add("hidden");
            hideText.classList.remove("hidden");
        } else {
            passwordInput.type = "password";
            showText.classList.remove("hidden");
            hideText.classList.add("hidden");
        }
    }

    function checkInput() {
        let passwordInput = document.getElementById("password");
        let toggleButton = document.getElementById("toggleButton");

        if (passwordInput.value.length > 0) {
            toggleButton.classList.remove("hidden");
        }
    }

    function checkEmpty() {
        let passwordInput = document.getElementById("password");
        let toggleButton = document.getElementById("toggleButton");

        if (passwordInput.value.length === 0) {
            toggleButton.classList.add("hidden");
        }
    }
    </script>
</body>
</html>
