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
    <div class="flex flex-col gap-4 w-full ">
        <!-- if not admin -->
        <?php if ($user['is_admin'] != 1): ?>
            <div class="flex justify-center items-center gap-5 mb-2 pl-4 py-4 px-2 bg-white border-b border-gray-200">
                <h1 class="text-lg font-semibold">Profile Settings</h1>
            </div>    
        <?php endif; ?>

        <!-- if admin -->
        <?php if ($user['is_admin'] == 1): ?>
            <section class="flex justify-center items-center gap-5 mb-2 pl-4 py-4 px-2 bg-white border-b border-gray-200">
                <div class="w-1/2 flex justify-between items-center">
                    <a href="/Settings" data-page="Settings" class="px-6 py-1">Profile</a>
                    <a href="/RoomSettings" data-page="RoomSettings" class="px-6 py-1">Room</a>
                    <a href="/EmployeeSettings" data-page="EmployeeSettings" class="px-6 py-1">Employee</a>
                </div>
            </section>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentPath = window.location.pathname.split('/')[1]; 

            document.querySelectorAll('[data-page]').forEach(link => {
                if (link.getAttribute("data-page") === currentPath) {
                    link.classList.add("text-primary",  "border-b-2", "border-primary");
                } else {
                    link.classList.remove("text-primary",  "border-b-2", "border-primary");
                }
            });
        });
    </script>
</body>
</html>