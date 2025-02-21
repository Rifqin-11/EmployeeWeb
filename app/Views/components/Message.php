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
    <div class="flex justify-between items-center align-center bg-white p-4 rounded-lg shadow">
        <div class="flex">
            <div class="h-10 bg-primary p-2 rounded-full text-white">
                <i data-lucide="bell-ring"></i>
            </div>
            <div class="ml-4">
                <p class="font-semibold">
                    <?= $user["name"] ?>
                </p>
                <p class="text-sm text-gray-500">
                    <?= $pendingVisitors ?> visitors with pending status.
                </p>
            </div>
        </div>
        <a href="/History?status=0" class="px-4 py-2 bg-primary text-white rounded-lg cursor-pointer">
            View Detail
        </a>
    </div>
</body>
</html>