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
