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
                <div class="flex flex-col gap-2 w-full my-2 px-5">
                    <div class="flex flex-col bg-white p-6 rounded-lg shadow w-full">
                        <form action="<?= base_url('infoData/edit') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">    
                        <input type="hidden" name="guestbook-id" value="<?= $guest['id'] ?>">
                            <input type="hidden" name="status" id="status" value="<?= $guest['status'] ?>">
                        <div>
                            <div class="mb-7 flex justify-between w-full">
                                <div class="flex gap-3">
                                    <p class="font-semibold">Visit Date:</p>
                                    <p class="text-gray-600"><?= $guest["created_at"] ?></p>
                                </div>
                                <div>
                                    <span class="px-2 py-1 text-sm justify-center items-center">
                                        <?= status($guest['status']) ?>
                                    </span>
                                </div>
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
                                        
                                        <input type="date" name="date" id="date" value="<?= $guest['date'] ?>" class="w-full white border border-gray-300 p-2 rounded rounded-lg">
                                        <input type="time" name="start-at" id="start-at" value="<?= $guest['start_at'] ?>" class="w-1/3 white border border-gray-300 p-2 rounded rounded-lg">
                                        <p>to</p>
                                        <input type="time" name="end-at" id="end-at" value="<?= $guest['end_at'] ?>" class="w-1/3 white border border-gray-300 p-2 rounded rounded-lg">
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-center mb-4 border border-gray-400 w-200 h-100 rounded rounded-xl justify-center items-center text-center">
                                <input type="file" name="images[]" multiple>
                            </div>
                            <button id="buttonSave" type="submit" class="mb-4 bg-primary p-2 px-4 rounded rounded-lg justify-center items-center mt-6 w-full">
                                <h2 class="text-lg font-medium text-white text-center cursor-pointer">save</h2>
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script>
        document.getElementById("buttonSave").addEventListener("click", function(event) {
        event.preventDefault();

        let alertToast = document.getElementById("alertToast");
        alertToast.classList.remove("hidden");

        setTimeout(() => {
            alertToast.classList.add("hidden");
            document.querySelector("form").submit();
        }, 1500);
    });
        lucide.createIcons();
    </script>
  </body>

<div id="alertToast" class="fixed bottom-8 right-5 hidden">
    <div class="flex items-center gap-3 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
        </svg>
        <span class="font-semibold">Data saved successfully!</span>
    </div>
</div>


</html>