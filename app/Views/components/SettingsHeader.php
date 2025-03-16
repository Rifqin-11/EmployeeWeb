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
                <a href="<?= base_url('Settings/Profile') ?>" data-page="Profile" class="px-6 py-1">Profile</a>
                <a href="<?= base_url('Settings/Rooms') ?>" data-page="Rooms" class="px-6 py-1">Room</a>
                <a href="<?= base_url('Settings/Employees') ?>" data-page="Employees" class="px-6 py-1">Employee</a>
            </div>
        </section>
    <?php endif; ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const currentPath = window.location.pathname.split('/')[2];

        document.querySelectorAll('[data-page]').forEach(link => {
            if (link.getAttribute("data-page") === currentPath) {
                link.classList.add("text-primary", "border-b-2", "border-primary");
            } else {
                link.classList.remove("text-primary", "border-b-2", "border-primary");
            }
        });
    });
</script>