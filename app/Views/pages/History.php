<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="<?=base_url()?>/desnetLogo.png" />
    <title>History</title>
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
        --color-yellow-700: #F9A329;
        --color-yellow-200: #fff0dc;
      }
    </style>
  </head>
  <body>

    <div class="min-h-screen bg-[#F9F9F9] flex max-w-full">
        <?= $this->include('components/sidebar') ?>
        
        <div class="pr-2 flex gap-2 w-full md:ml-72">
            <div class="flex flex-col gap-2 w-full">
                <?= $this->include('components/header') ?>
                <div class="flex flex-col gap-2 w-full my-2 px-5">
                    <div class="flex flex-row w-full gap-4">
                        <div class="flex text-white justify-center gap-4 items-center">
                            <div class="flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 hover:bg-primary hover:text-white">
                                Name
                                <i data-lucide="arrow-up-down"></i>
                            </div>
                            <div class="flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 hover:bg-primary hover:text-white">
                                Date
                                <i data-lucide="arrow-up-down"></i>
                            </div>
                            <div class="flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 hover:bg-primary hover:text-white">
                                Status
                                <i data-lucide="arrow-up-down"></i>
                            </div>
                            <div class="flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 gap-2 justify-center items-center">
                                <input type="date" class="w-22 rounded-lg p-1 text-text-200" placeholder="Periode">
                                <p>to</p>
                                <input type="date" class="w-22 rounded-lg p-1 text-text-200 " placeholder="Periode">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col bg-white p-6 rounded-lg shadow w-full">
                        <table class="w-full border-collapse rounded-lg">
                            <thead>
                                <tr class="bg border-b border-gray-200 text-left rounded-2xl">
                                    <th class="p-3">Date</th>
                                    <th class="p-3">PIC Name</th>
                                    <th class="p-3">Institution</th>
                                    <th class="p-3">Contact</th>
                                    <th class="p-3">Agenda</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3">More Info</th>
                                </tr>
                            </thead>
                            <tbody class="text-md">
                                <?php foreach ($guests as $item): ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="p-3"><?= date('d-m-Y, H:i', strtotime($item['created_at'])) ?></td>
                                    <td class="p-3"><?= esc($item['pic_name']) ?></td>
                                    <td class="p-3"><?= esc($item['institution_name']) ?></td>
                                    <td class="p-3"><?= esc($item['phone_number']) ?></td>
                                    <td class="p-3"><?= esc($item['agenda']) ?></td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 text-sm justify-center items-center">
                                            <?= status($item['status']) ?>
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        <a href="/infodata/<?= $item["id"]?>" class="text-sm text-primary border-b-1 border-primary">
                                            View Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="flex flex-row justify-between gap-4 mt-4">
                            <p class="text-sm text-gray-600 mt-4">Showing 8 of 240 entries</p>
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