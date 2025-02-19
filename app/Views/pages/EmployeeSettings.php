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
                        <input
                          type="text"
                          name="employee_name"
                          id="employee_name"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                          placeholder="Enter employee name"
                          required
                        />
                      </div>
                      <div>
                        <label for="employee_email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input
                          type="text"
                          name="employee_email"
                          id="employee_email"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                          placeholder="Enter email"
                        />
                      </div>
                      <div>
                        <label for="employee_password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input
                          type="text"
                          name="employee_password"
                          id="employee_password"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                          placeholder="Enter password"
                        />
                      </div>
                      <div>
                        <label for="employee_position" class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                        <input
                          type="text"
                          name="employee_position"
                          id="employee_position"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                          placeholder="Enter position"
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
