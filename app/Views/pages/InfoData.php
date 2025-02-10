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
                <div class="flex flex-col gap-2 w-full my-2 px-5">
                    <div class="flex flex-col bg-white p-6 rounded-lg shadow w-full">
                        <div>
                            <div class="mb-4 flex flex-end w-full">
                                <p class="text-gray-600"><?= $guest["created_at"] ?></p>
                            </div>
                            <div class="mb-4">
                                <h2 class="text-lg font-medium text-gray-700">PIC Name:</h2>
                                <p class="text-gray-600"><?= $guest["pic_name"] ?></p>
                            </div>
                            <div class="flex grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <h2 class="text-lg font-medium text-gray-700">Institution:</h2>
                                    <p class="text-gray-600"><?= $guest["institution_name"] ?></p>
                                </div>
                                <div class="mb-4">
                                    <h2 class="text-lg font-medium text-gray-700">Contact:</h2>
                                    <p class="text-gray-600"><?= $guest["phone_number"] ?></p>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h2 class="text-lg font-medium text-gray-700">Agenda:</h2>
                                <p class="text-gray-600"><?= $guest["agenda"] ?></p>
                            </div>
                            <div class="flex grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <h2 class="text-lg font-medium text-gray-700">Room:</h2>
                                    <div>
                                        <select name="room" id="room" class="w-full white border border-gray-300 p-2 rounded rounded-lg">
                                            <?php foreach ($rooms as $room): ?>
                                            <option value="<?= $room["id"] ?>"><?= esc($room['name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>   
                                <div class="mb-4">
                                    <h2 class="text-lg font-medium text-gray-700">Appointment:</h2>
                                    <div class="flex flex-row gap-2 items-center justify-center">
                                        <input type="date" name="appointment" id="appointment" class="w-full white border border-gray-300 p-2 rounded rounded-lg">
                                        <input type="time" name="appointment" id="appointment" class="w-1/3 white border border-gray-300 p-2 rounded rounded-lg">
                                        <p>to</p>
                                        <input type="time" name="appointment" id="appointment" class="w-1/3 white border border-gray-300 p-2 rounded rounded-lg">
                                    </div>
                                </div>   
                            </div>
                            <Button id="buttonSave" class="mb-4 bg-primary p-2 px-4 rounded rounded-lg justify-center items-center mt-6 w-full">
                                <h2 class="text-lg font-medium text-white text-center cursor-pointer">save</h2>
                            </Button>   
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