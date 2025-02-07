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
      }
    </style>
  </head>
  <body>
    <div class="min-h-screen bg-[#F9F9F9] flex max-w-full">
        <?= $this->include('components/sidebar') ?>
        
        <div class="pr-2 flex gap-2 w-full">
            <div class="flex flex-col gap-2 w-full">
                <?= $this->include('components/header') ?>
                <div class="justify-between flex flex-row px-5 gap-4">
                    <div class="w-full">
                        <div class="w-full">
                            <?= $this->include('components/message') ?>
                        </div>
                        <div class="w-full mt-7 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?= $this->include('components/Card') ?>
                            <?= $this->include('components/Card') ?>
                        </div>
                    </div>
                    <div class="w-1/3">
                        <?= $this->include('components/Calendar') ?>
                    </div>
                </div>
                <div class="flex flex-col gap-2 w-full mt-4 px-5">
                    <div class="flex bg-white p-6 rounded-lg shadow w-full">
                        <table class="w-full gap-2 border-separate border-spacing-2">
                            <thead>
                                <tr class="border">
                                    <th class="text-left ">Name</th>
                                    <th class="text-left">Institution</th>
                                    <th class="text-left">Phone</th>
                                    <th class="text-left w-xl">Agenda</th>
                                    <th class="text-left">Date</th>
                                    <th class="text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-md ">
                                <?php foreach ($guest as $item): ?>
                                <tr>
                                    <td><?= esc($item['pic_name']) ?></td>
                                    <td><?= esc($item['institution_name']) ?></td>
                                    <td><?= esc($item['phone_number']) ?></td>
                                    <td><?= esc($item['agenda']) ?></td>
                                    <td><?= esc($item['created_at']) ?></td>
                                    <!-- <td><?= esc($item['pic_name']) ?></td> -->
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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