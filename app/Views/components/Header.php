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
    <div class="flex flex-col lg:flex-row gap-4 w-100% ">
        <div class="flex flex-col gap-4 w-full ">
            <section class="flex justify-between items-center gap-5 mb-2 pl-4 py-4 px-2 bg-white border-b border-gray-200">
                <div class="w-full">
                    <form method="GET" action="<?= base_url('Home') ?>" class="relative">
                        <input
                            type="text"
                            name="search"
                            id="searchInput"
                            placeholder="Search PIC Name or Institution"
                            class="py-2 rounded-3xl border border-gray-200 px-5 bg-secondary text-black w-full"
                            value="<?= esc($_GET['search'] ?? '') ?>"
                            onkeydown="searchOnEnter(event)"
                        />
                    </form>
                </div>
                <div class="flex text-white justify-center gap-6 items-center w-1/3">
                    <?= $this->include('components/NotificationModal') ?>
                    <a href="/Settings" class="text-gray-900 p-2 rounded-full flex gap-3 justify-center items-center">
                        <div class="avatar">
                            <div class="ring-primary ring-offset-base-100 w-10 rounded-full ring ring-offset-2 overflow-hidden">
                                <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" class="w-full h-full object-cover" />
                            </div>
                        </div>
                        <div class="justify-center items-center">
                            <p class="font-bold"><?= $user["name"] ?></p>
                            <p class="text-xs"><?= $user["position"] ?></p>
                        </div>
                    </a>
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
</body>
</html>