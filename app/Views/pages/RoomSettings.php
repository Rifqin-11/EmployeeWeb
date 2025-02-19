<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="<?= base_url() ?>/desnetLogo.png" />
    <title>Room Settings</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/daisyui@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
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
            <div class="flex flex-col bg-white rounded-lg shadow w-full h-full">
              <?= $this->include('components/SettingsHeader'); ?>

              <!-- Settings Content -->
              <div class="flex-1">
                <main class="p-6">
                  <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Room Settings</h2>
                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="ml-auto self-center px-4 py-1 rounded-xl bg-primary text-white border border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-gray-900" type="button">
                      Add Room
                    </button>
                  </div>

                  <!-- Room Table -->
                  <table class="w-full table-fixed min-w-0 border-collapse rounded-lg overflow-hidden">
                    <thead>
                      <tr class="bg-gray-50 text-gray-700 text-sm uppercase border-b border-gray-200">
                        <th class="px-4 py-3 text-left w-25">No</th>
                        <th class="px-4 py-3 text-left">Room Name</th>
                        <th class="flex px-20 py-3 text-left justify-end">Action</th>
                      </tr>
                    </thead>
                    <tbody id="tableBody" class="text-gray-600 text-sm">
                      <?php if (isset($rooms) && count($rooms) > 0): ?>
                        <?php foreach ($rooms as $index => $room): ?>
                          <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                            <td class="px-4 py-3 w-25"><?= $index + 1 ?></td>
                            <td class="px-4 py-3"><?= esc($room['name']) ?></td>
                            <td class="flex px-20 py-3 items-center justify-end">
                              <!-- Button edit -->
                              <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                      data-room-id="<?= $room['id'] ?>"
                                      data-room-name="<?= esc($room['name']) ?>"
                                      data-room-description="<?= isset($room['description']) ? esc($room['description']) : '' ?>"
                                      class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition mr-2">
                                <i data-lucide="pencil" class="w-3"></i>
                              </button>
                              <!-- Button delete -->
                              <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition"
                                    data-modal-target="deleteModal" data-modal-toggle="deleteModal" data-title="room"
                                    data-delete-url="<?= base_url('settings/rooms/delete/') . $room['id']; ?>">
                                <i data-lucide="trash-2" class="w-3"></i>
                              </button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="4" class="px-4 py-3 text-center">No room data available</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </main>
              </div>
            </div>

            <!-- Delete Room Modal -->
            <?= $this->include('components/DeleteModal') ?>

            <!-- Add Room Modal -->
            <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative p-4 w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm">
                  <!-- Modal header -->
                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                      Add Room
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                    </button>
                  </div>
                  <!-- Modal body -->
                  <form action="<?= base_url('settings/rooms/add') ?>" method="post" class="p-4 md:p-5">

                    <div class="gap-4 mb-4">
                      <div class="mt-2">
                        <div class="relative">
                          <input type="text" name="room_name" id="room_name" value="" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required/>
                          <label for="room_name" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Room Name</label>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="text-primary inline-flex items-center bg-white border border-primary hover:bg-primary hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                      Save
                    </button>
                  </form>
                </div>
              </div>
            </div>

            <!-- Edit Room Modal -->
            <div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative p-4 w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm">
                  <!-- Modal header -->
                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                      Edit Room
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                    </button>
                  </div>
                  <!-- Modal body -->
                  <form action="<?= base_url('settings/rooms/edit') ?>" method="post" class="p-4 md:p-5">
                    <input type="hidden" name="room_id" id="edit_room_id" value="">
                    <div class="gap-4 mb-4">
                      <div class="mt-2">
                        <label for="edit_room_name" class="block mb-2 text-sm font-medium text-gray-900">Room Name</label>
                        <input type="text" name="room_name" id="edit_room_name" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter room name" required>
                      </div>
                    </div>
                    <button type="submit" class="text-primary inline-flex items-center bg-white border border-primary hover:bg-primary hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                      Save
                    </button>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <script>
      // Close Modal
      function closeModalOnClickOutside(modalId) {
        const modal = document.getElementById(modalId);
        window.addEventListener('click', (e) => {
          if (e.target === modal) {
            modal.classList.add('hidden');
          }
        });
      }
      closeModalOnClickOutside('crud-modal');
      closeModalOnClickOutside('edit-modal');

      document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('[data-modal-toggle="edit-modal"]').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('edit_room_id').value = this.getAttribute('data-room-id');
                document.getElementById('edit_room_name').value = this.getAttribute('data-room-name');
                document.getElementById('edit_room_description').value = this.getAttribute('data-room-description');
                document.getElementById('edit-modal').classList.remove('hidden'); 
          });
        });
        const deleteButtons = document.querySelectorAll('[data-modal-target="deleteModal"][data-delete-url]');
        
        deleteButtons.forEach(function(button) {
          button.addEventListener('click', function() {
            const deleteUrl = button.getAttribute('data-delete-url');
            const dataTitle = button.getAttribute('data-title');
            
            const confirmLink = document.getElementById('confirmDeleteLink');
            confirmLink.setAttribute('href', deleteUrl);

            const modalTitle = document.getElementById('deleteModalTitle');
            modalTitle.textContent = 'Are you sure you want to delete this ' + dataTitle + '?';
          });
        });
      });

      lucide.createIcons();
    </script>
  </body>
</html>
