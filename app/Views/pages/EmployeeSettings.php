<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="<?= base_url() ?>/desnetLogo.png" />
    <title>Desnet GuestBook - Room Settings</title>
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
                    <h2 class="text-2xl font-semibold text-gray-700">Employee Settings</h2>
                    <button
                      data-modal-target="crud-modal"
                      data-modal-toggle="crud-modal"
                      class="ml-auto self-center px-4 py-1 rounded-xl bg-primary text-white border border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-gray-900"
                      type="button"
                    >
                      Add Employee
                    </button>
                  </div>

                  <!-- Employee Table -->
                  <table class="w-full table-fixed min-w-0 border-collapse rounded-lg overflow-hidden">
                    <thead>
                      <tr class="bg-gray-50 text-gray-700 text-sm uppercase border-b border-gray-200">
                        <th class="px-4 py-3 text-left w-15">No</th>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Position</th>
                        <th class="flex px-20 py-3 text-left justify-end">Action</th>
                      </tr>
                    </thead>
                    <tbody id="tableBody" class="text-gray-600 text-sm">
                      <?php if (isset($employees) && is_array($employees) && count($employees) > 0): ?>
                        <?php foreach ($employees as $index => $employee): ?>
                          <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                            <td class="px-4 py-3 w-15"><?= $index + 1 ?></td>
                            <td class="px-4 py-3"><?= esc($employee['name']) ?></td>
                            <td class="px-4 py-3"><?= esc($employee['email']) ?></td>
                            <td class="px-4 py-3"><?= esc($employee['position']) ?></td>
                            <td class="flex px-20 py-3 items-center justify-end">
                              <!-- Edit Button -->
                              <button
                                data-modal-target="edit-modal"
                                data-modal-toggle="edit-modal"
                                data-employee-id="<?= $employee['id'] ?>"
                                data-employee-name="<?= esc($employee['name']) ?>"
                                data-employee-email="<?= esc($employee['email']) ?>"
                                data-employee-position="<?= esc($employee['position']) ?>"
                                class="px-2 mr-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition"
                              >
                                <i data-lucide="pencil" class="w-3"></i>
                              </button>
                              <!-- Delete Button -->
                              <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition"
                                    data-modal-target="deleteModal" data-modal-toggle="deleteModal" data-title="employee"
                                    data-delete-url="<?= base_url('settings/employees/delete/') . $employee['id']; ?>">
                                <i data-lucide="trash-2" class="w-3"></i>
                              </button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="5" class="px-4 py-3 text-center">No employee data available</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </main>
              </div>
            </div>

            <!-- Modal Delete -->
            <?= $this->include('components/DeleteModal') ?>

            <!-- Add Employee Modal -->
            <div
              id="crud-modal"
              tabindex="-1"
              aria-hidden="true"
              class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center h-[calc(100%-1rem)] max-h-full"
            >
              <div class="relative p-4 w-full max-w-lg max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm">
                  <!-- Modal Header -->
                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Add Employee</h3>
                    <button
                      type="button"
                      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                      data-modal-toggle="crud-modal"
                    >
                      <svg
                        class="w-3 h-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14"
                      >
                        <path
                          stroke="currentColor"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                        />
                      </svg>
                      <span class="sr-only">Close modal</span>
                    </button>
                  </div>
                  <!-- Modal Body -->
                  <form action="<?= base_url('settings/employees/add') ?>" method="post" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                      <div>
                          <label for="employee_name" class="block mb-2 text-sm font-medium text-gray-900">Employee Name</label>
                          <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                              <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                  <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                              </svg>
                            </div>
                            <input type="text" name="employee_name" id="employee_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Enter employee name" required>
                          </div>
                      </div>
                      <div>
                          <label for="employee_email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                          <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                              <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                  <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                  <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                              </svg>
                            </div>
                            <input type="text" name="employee_email" id="employee_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="name@mail.com" required>
                          </div>
                      </div>
                      <div>
                        <label for="employee_password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                          <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                              <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                              </svg>
                            </div>
                            <input type="text" name="employee_password" id="employee_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Enter password" required>
                          </div>
                      </div>
                      <div>
                          <label for="employee_position" class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                          <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                              <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M10 2a3 3 0 0 0-3 3v1H5a3 3 0 0 0-3 3v2.382l1.447.723.005.003.027.013.12.056c.108.05.272.123.486.212.429.177 1.056.416 1.834.655C7.481 13.524 9.63 14 12 14c2.372 0 4.52-.475 6.08-.956.78-.24 1.406-.478 1.835-.655a14.028 14.028 0 0 0 .606-.268l.027-.013.005-.002L22 11.381V9a3 3 0 0 0-3-3h-2V5a3 3 0 0 0-3-3h-4Zm5 4V5a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v1h6Zm6.447 7.894.553-.276V19a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-5.382l.553.276.002.002.004.002.013.006.041.02.151.07c.13.06.318.144.557.242.478.198 1.163.46 2.01.72C7.019 15.476 9.37 16 12 16c2.628 0 4.98-.525 6.67-1.044a22.95 22.95 0 0 0 2.01-.72 15.994 15.994 0 0 0 .707-.312l.041-.02.013-.006.004-.002.001-.001-.431-.866.432.865ZM12 10a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
                              </svg>
                            </div>
                            <input type="text" name="employee_position" id="employee_position" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Example: Managers" required>
                          </div>
                      </div>
                    </div>
                    <button
                      type="submit"
                      class="text-primary inline-flex items-center bg-white border border-primary hover:bg-primary hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                    >
                      Save
                    </button>
                  </form>
                </div>
              </div>
            </div>

            <!-- Edit Employee Modal -->
            <div
              id="edit-modal"
              tabindex="-1"
              aria-hidden="true"
              class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center h-[calc(100%-1rem)] max-h-full"
            >
              <div class="relative p-4 w-full max-w-lg max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm">
                  <!-- Modal Header -->
                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Employee</h3>
                    <button
                      type="button"
                      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                      data-modal-toggle="edit-modal"
                    >
                      <svg
                        class="w-3 h-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14"
                      >
                        <path
                          stroke="currentColor"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                        />
                      </svg>
                      <span class="sr-only">Close modal</span>
                    </button>
                  </div>
                  <!-- Modal Body -->
                  <form action="<?= base_url('settings/employees/edit') ?>" method="post" class="p-4 md:p-5">
                    <input type="hidden" name="employee_id" id="edit_employee_id" value="" />
                    <div class="grid gap-4 mb-4 grid-cols-2">
                      <div>
                        <label for="edit_employee_name" class="block mb-2 text-sm font-medium text-gray-900">Employee Name</label>
                        <input
                          type="text"
                          name="employee_name"
                          id="edit_employee_name"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                          placeholder="Enter employee name"
                          required
                        />
                      </div>
                      <div>
                        <label for="edit_employee_email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input
                          type="text"
                          name="employee_email"
                          id="edit_employee_email"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                          placeholder="Enter employee email"
                        />
                      </div>
                      <div class="col-span-2">
                        <label for="edit_employee_position" class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                        <input
                          type="text"
                          name="employee_position"
                          id="edit_employee_position"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                          placeholder="Enter employee position"
                        />
                      </div>
                    </div>
                    <button
                      type="submit"
                      class="text-primary inline-flex items-center bg-white border border-primary hover:bg-primary hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                    >
                      Save
                    </button>
                  </form>
                </div>
              </div>
            </div>
            <!-- End of Modals -->

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

      // Fill edit modal
      document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('[data-modal-toggle="edit-modal"]').forEach(button => {
          button.addEventListener("click", function () {
            document.getElementById("edit_employee_id").value = this.getAttribute("data-employee-id");
            document.getElementById("edit_employee_name").value = this.getAttribute("data-employee-name");
            document.getElementById("edit_employee_email").value = this.getAttribute("data-employee-email");
            document.getElementById("edit_employee_position").value = this.getAttribute("data-employee-position");
            document.getElementById("edit-modal").classList.remove("hidden");
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
