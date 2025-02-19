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
  <div class="bg-white p-6 rounded-lg shadow">
      <p class="font-semibold">
          <?= esc($title) ?>
      </p>
      <p class="pt-3 text-3xl font-bold">
          <?= esc($data) ?>
      </p>
      <p class="text-sm text-gray-500">
          <?= esc($percentage) ?>
      </p>
  </div>
</body>
</html>