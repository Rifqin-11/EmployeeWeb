<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<?php if ($pager->hasPages()) : ?>
<nav class="flex items-center justify-center space-x-2 mt-4">
    <!-- prev button -->
    <?php if ($pager->hasPrevious()) : ?>
        <a href="<?= $pager->getFirst() ?>" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">&laquo;</a>
        <a href="<?= $pager->getPrevious() ?>" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">&lt;</a>
    <?php endif; ?>

    <!-- page number -->
    <?php foreach ($pager->links() as $link) : ?>
        <a href="<?= $link['uri'] ?>" class="px-3 py-2 <?= $link['active'] ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' ?> rounded-md hover:bg-gray-300">
            <?= $link['title'] ?>
        </a>
    <?php endforeach; ?>

    <!-- next button -->
    <?php if ($pager->hasNext()) : ?>
        <a href="<?= $pager->getNext() ?>" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">&gt;</a>
        <a href="<?= $pager->getLast() ?>" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">&raquo;</a>
    <?php endif; ?>
</nav>
<?php endif; ?>
</body>
</html>