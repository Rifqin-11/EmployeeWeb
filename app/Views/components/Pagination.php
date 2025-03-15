
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