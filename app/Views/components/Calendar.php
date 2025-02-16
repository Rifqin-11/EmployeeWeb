<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="bg-white p-4 ml-2 rounded-lg shadow-sm min-w-2xs hidden md:block">
        <div class="flex justify-between items-center mb-4">
            <span class="pt-4 font-bold justify-center items-center">
                <?= date('F Y', strtotime("$currentYear-$currentMonth-01")) ?>
            </span>
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