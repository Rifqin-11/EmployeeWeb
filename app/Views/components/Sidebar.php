<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<body>
    <div class="fixed top-0 left-0 h-screen w-3xs bg-white p-4 rounded-lg flex flex-col border-r border-gray-200 hidden md:flex z-20">

        <!-- Logo -->
        <a href="/Home" class="flex flex-col items-start mt-6 pl-2">
            <img src="<?= base_url('desnetLogo.png') ?>" alt="Logo" class="h-14" />
        </a>

        <!-- Sidebar content -->
        <div class="flex flex-col gap-3 mb-8 mt-16">
            <a href="/Home" class="nav-link p-2 px-7 flex rounded-2xl hover:bg-primary hover:text-white" data-page="Home">
                <i data-lucide="home" class="mr-2 w-6"></i>
                Dashboard
            </a>
            <a href="/History" class="nav-link p-2 px-7 flex rounded-2xl hover:bg-primary hover:text-white" data-page="History">
                <i data-lucide="history" class="mr-2"></i>
                History
            </a>
            <a href="/Settings" class="nav-link p-2 px-7 flex rounded-2xl hover:bg-primary hover:text-white" data-page="Settings">
                <i data-lucide="settings-2" class="mr-2 w-5"></i>
                Settings
            </a>
        </div>

        <!-- Logout button -->
        <footer class="mt-auto pt-4 border-t border-gray-300">
            <div class="flex items-center gap-2 mb-3">
                <a href="/logout" class="hover:bg-primary hover:text-white flex p-2 px-7 rounded-2xl w-full">
                    <i data-lucide="log-out" class="mr-2"></i>
                    Log Out
                </a>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentPath = window.location.pathname.split('/')[1]; 

            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute("data-page") === currentPath) {
                    link.classList.add("bg-primary", "text-white");
                } else {
                    link.classList.remove("bg-primary", "text-white");
                }
            });
        });
    </script>
</body>
</html>