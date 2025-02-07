<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container bg-white p-4 ml-2 rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <a href="?month=<?= $currentMonth - 1 ?>&year=<?= $currentYear ?>" 
                class="text-blue-500 hover:underline"><</a>
            <span class="font-bold">
                <?= date('F Y', strtotime("$currentYear-$currentMonth-01")) ?>
            </span>
            <a href="?month=<?= $currentMonth + 1 ?>&year=<?= $currentYear ?>" 
                class="text-blue-500 hover:underline">></a>
        </div>

        <!-- Header Hari -->
        <div class="grid grid-cols-7 text-center text-gray-700 font-semibold">
            <div>S</div>
            <div>M</div>
            <div>T</div>
            <div>W</div>
            <div>Th</div>
            <div>F</div>
            <div>S</div>
        </div>

        <!-- Tanggal -->
        <div class="grid grid-cols-7 text-center text-sm mt-2">
            <?php foreach ($calendar as $week): ?>
                <?php foreach ($week as $day): ?>
                    <?php if ($day === null): ?>
                        <div class="py-2"></div>
                    <?php else: ?>
                        <div class="py-1 <?= date('j') == $day && date('m') == $currentMonth && date('Y') == $currentYear ? ' bg-blue-900 text-white rounded-full' : '' ?>">
                            <?= $day ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>