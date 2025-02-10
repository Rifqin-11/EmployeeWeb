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
                <div class="w-2/3">
                    <form method="GET" action="<?= base_url('Home') ?>" class="flex w-full">
                        <input
                            type="text"
                            name="search"
                            id="searchInput"
                            placeholder="Search PIC Name or Institution"
                            class="py-1 rounded-3xl border border-gray-200 px-5 bg-secondary text-black w-full"
                            value="<?= esc($_GET['search'] ?? '') ?>"
                            onkeydown="searchOnEnter(event)"
                        />
                    </form>
                </div>
                <div class="flex text-white justify-center gap-4 items-center w-1/3">
                    <a href="/" class="h-10 bg-primary p-2 rounded-full">
                        <i data-lucide="bell-ring"></i>
                    </a>
                    <a href="/" class="h-10 bg-primary p-2 rounded-full">
                        <i data-lucide="message-circle"></i>
                    </a>
                    <a href="/" class="text-gray-900 p-2 rounded-full flex gap-3 justify-center items-center">
                        <i data-lucide="circle-user-round" class="text-black"></i>
                        <div class="justify-center items-center">
                            <p class="font-bold"><?= $user["name"] ?></p>
                            <p><?= $user["position"] ?></p>
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