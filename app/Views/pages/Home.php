<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="<?=base_url()?>/desnetLogo.png" />
    <title>Desnet GuestBook</title>
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
                <div class="justify-between flex flex-row px-5 gap-4">
                    <div class="w-full">
                        <div class="w-full">
                            <?= $this->include('components/message') ?>
                        </div>
                            <div class="w-full mt-7 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <?= view('components/Card', [
                                    'title' => 'Total Visitors', 
                                    'data' => $totalVisitors, 
                                    'percentage' => ''
                                ]) ?>
                                
                                <?= view('components/Card', [
                                    'title' => 'Monthly Visitors', 
                                    'data' => $totalVisitorsMonthly, 
                                    'percentage' => $percentageLastMonth.'% from last month'
                                ]) ?>
                            </div>
                    </div>
                    <div class="flex">
                        <?= $this->include('components/Calendar') ?>
                    </div>
                </div>
                <div class="flex flex-col gap-2 w-full my-4 px-5">
                    <div class="flex flex-col bg-white p-6 rounded-lg shadow w-full">
                        <table class="w-full border-collapse rounded-lg">
                            <thead>
                                <tr class="bg border-b border-gray-200 text-left rounded-2xl">
                                    <th class="p-3">No</th>
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
                                <?php $i=1 ?>
                                <?php foreach ($guests as $item): ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-50" onclick="">
                                    <td><?= $i++ ?></td>
                                    <td class="p-3"><?= time_parsing($item['created_at']) ?></td>
                                    <td class="p-3"><?= esc($item['pic_name']) ?></td>
                                    <td class="p-3"><?= esc($item['institution_name']) ?></td>
                                    <td class="p-3"><?= esc($item['phone_number']) ?></td>
                                    <td class="p-3"><?= esc($item['agenda']) ?></td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 text-sm">
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
                            <p class="text-sm text-gray-600 mt-4">Showing <?= $totalVisitors ?> of <?= $totalVisitors ?></p>
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