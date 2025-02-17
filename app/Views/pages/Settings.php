<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="<?=base_url()?>/desnetLogo.png" />
    <title>Desnet GuestBook</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/daisyui@latest"></script>
    <style type="text/tailwindcss">
      @theme {
        --color-primary: #084E8F;
        --color-secondary: #f9f9f9;
        --color-button: #2563eb;
        --color-text-100: #7E7E7E;
        --color-text-200: #414141;
        --color-text-600: #364153;
        --color-yellow-700: #F9A329;
        --color-yellow-200: #fff0dc;
      }
    </style>
  </head>
  <body>
    <div class="min-h-screen bg-[#F9F9F9] flex max-w-full">
        <?= $this->include('components/Sidebar') ?>
        <div class="pr-2 flex gap-2 w-full md:ml-64">
            <div class="flex flex-col gap-2 w-full">
                <?= $this->include('components/Header') ?>
                <div class="flex flex-col gap-2 w-full  my-2 px-5">
                    <div class="flex flex-row bg-white rounded-lg shadow w-full h-screen">

                        <!-- Sidebar -->
                        <div class="w-3xs bg-white p-4 flex flex-col border-r border-gray-200 md:flex">
                            <h1 class="text-lg font-bold mt-5 text-gray-800 ml-7">Settings</h1>
                            <div class="border-b border-gray-200 mt-4"></div>
                            <div class="flex flex-col gap-3 mt-4">
                                <div href="/" class="nav-link p-2 px-7 flex rounded-2xl hover:bg-primary hover:text-white" data-page="Home">
                                    Profile
                                </div>
                                <div href="/" class="nav-link p-2 px-7 flex rounded-2xl hover:bg-primary hover:text-white" data-page="History">
                                    Room
                                </div>
                                <div href="/" class="nav-link p-2 px-7 flex rounded-2xl hover:bg-primary hover:text-white" data-page="Settings">
                                    Employee
                                </div>
                            </div>
                        </div>

                        <!-- Settings Content -->
                        <div class="flex flex-col mx-10 my-10">
                            <div href="/" class="text-gray-900 p-2 rounded-full flex flex-col gap-3">
                                <div class="flex flex-col gap-2">
                                    <h1 class="text-gray-700 font-semibold">Profile Pictures</h1>
                                    <div class="flex flex-row gap-5 justify-center mt-2">
                                        <div class="avatar">
                                            <div class="ring-primary ring-offset-base-100 w-20 rounded-full ring ring-offset-2 overflow-hidden">
                                                <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" class="w-full h-full object-cover" />
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-center gap-3">
                                            <button class="bg-blue-400 text-white p-2 rounded-lg">Change Pictures</button>
                                            <button class="bg-red-400 text-white p-2 rounded-lg">Delete Pictures</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="justify-center items-center mt-5">
                                    <div class="flex flex-col gap-2 mt-2 ">
                                        <h1 class="text-gray-700 font-semibold">Profile Name</h1>
                                        <input class="border border-gray-200 p-2 rounded-lg w-full" value="<?= $user["name"] ?>"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        lucide.createIcons();
    </script>
  </body>
</html>