<div class="flex flex-col lg:flex-row gap-4 w-100% z-10">
    <div class="flex flex-col gap-4 w-full ">
        <section class="flex justify-between items-center gap-5 mb-2 pl-4 py-4 px-2 bg-white border-b border-gray-200">
            <!-- Search -->
            <div class="w-full">
                <form method="GET" action="<?= base_url('Home') ?>" class="relative">
                    <input
                        type="text"
                        name="search"
                        id="searchInput"
                        placeholder="Search PIC Name or Institution"
                        class="py-2 rounded-3xl border border-gray-200 px-5 bg-secondary text-black w-full z-0"
                        value="<?= esc($_GET['search'] ?? '') ?>"
                        onkeydown="searchOnEnter(event)" />
                </form>
            </div>

            <!-- Notif and Profile -->
            <div class="flex text-white justify-center gap-3 items-center w-1/3">
                <?= $this->include('components/NotificationModal') ?>
                <a data-tooltip-target="tooltip-bottom" data-tooltip-placement="bottom" href="<?= base_url('Settings/Profile') ?>" class="text-gray-900 p-2 rounded-full flex gap-3 justify-center items-center">
                    <div class="avatar">
                        <div class="ring-primary ring-offset-base-100 w-9 h-9 rounded-full ring ring-offset-2 overflow-hidden">
                            <img id="profileImage" src="<?= base_url('uploads/profile_photos/') . $user['photo'] ?>" class="w-full h-full object-cover" />
                        </div>
                    </div>
                    <div class="justify-center items-center">
                        <p class="font-bold"><?= $user["name"] ?></p>
                        <p class="text-xs"><?= $user["position"] ?></p>
                    </div>
                </a>
                <div id="tooltip-bottom" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 tooltip">
                    <?= $user["name"] ?>
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    function searchOnEnter(event) {
        if (event.keyCode === 13) {
            event.preventDefault();

            let searchValue = document.getElementById('searchInput').value;
            let url = new URL(window.location.href);

            if (searchValue) {
                url.searchParams.set('search', searchValue);
            } else {
                url.searchParams.delete('search');
            }

            window.location.href = url.toString();
        }
    }
</script>