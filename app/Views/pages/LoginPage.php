<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="<?=base_url()?>/desnetLogo.png" />
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">

    <title>Desnet | Login</title>
    <script src="https://unpkg.com/lucide@latest"></script>
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
    <nav class="bg-white p-7 md:p-3 lg:p-2 2xl:p-7 shadow-md">
        <a href="<?= base_url('/'); ?>" class="container flex justify-between items-center">
            <img src="<?= base_url('desnetLogo.png') ?>" alt="desnet logo" class="w-24">
        </a>
    </nav>

    <div class="flex flex-grow justify-center items-center">
        <div class="bg-white flex flex-col justify-center items-center w-full max-w-lg px-8 py-20 rounded-xl shadow-lg">
            <img src="<?= base_url('desnetLogo.png') ?>" alt="desnet logo" class="w-42 mb-3">
            <h2 class="text-black text-3xl font-bold text-center mt-4">Sign-In</h2>
            <p class="text-gray-400 text-sm text-center pb-4">Good to See You Again! Sign In Below</p>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="text-red-700 rounded relative text-center" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="/auth" method="post" class="w-full pt-5 gap-3">
                <div class="relative">
                    <input type="text" name="username" id="floating_outlined" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required/>
                    <label for="floating_outlined" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Username</label>
                </div>
                
                <div class="relative mt-2">
                    <input type="password" name="password" id="password" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required oninput="checkInput()" onblur="checkEmpty()"/>
                    <label for="floating_outlined" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Password</label>

                    <button id="toggleButton" type="button" onclick="togglePassword()" 
                            class="absolute top-6 right-3 w-20 h-5 bg-white transform -translate-y-1/2 flex hidden items-center justify-end px-2">
                            <div class="bg-white rounded-lg text-right">
                                <p id="show" class="font-semibold hover:font-regular hover:text-gray-400">Show</p>
                                <p id="hide" class="font-semibold hover:font-regular hover:text-gray-400 hidden">Hide</p>
                            </div>
                    </button>
                </div>

                <button type="submit" class=" mt-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Login</button>
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
