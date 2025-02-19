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
      /* @theme {
        --color-primary: #084E8F;
        --color-secondary: #f9f9f9;
        --color-button: #2563eb;
        --color-text-100: #7E7E7E;
        --color-text-200: #414141;
        --color-text-600: #364153;
        --color-yellow-700: #F9A329;
        --color-yellow-200: #fff0dc;
      } */
    </style>
  </head>
  <body>
    <div class="min-h-screen bg-[#F9F9F9] flex max-w-full">
      <?= $this->include('components/Sidebar') ?>
      <div class="pr-2 flex gap-2 w-full md:ml-64">
        <div class="flex flex-col gap-2 w-full">
          <?= $this->include('components/Header') ?>
          <div class="flex flex-col gap-2 w-full my-2 px-5">
            <div class="flex flex-col bg-white rounded-lg shadow w-full h-screen">
              <?= $this->include('components/SettingsHeader'); ?>

              <!-- Settings Content -->
              <div class="flex flex-col mx-10 my-10">
                <div href="/" class="text-gray-900 p-2 rounded-full flex flex-col gap-3">
                  <div class="p-8 flex flex-col gap-2 rounded-lg border border-gray-200">
                    <div class="flex flex-row gap-5 justify-start mt-2 w-full">
                      <div class="avatar">
                        <div class="ring-primary ring-offset-base-100 w-20 rounded-full ring ring-offset-2 overflow-hidden">
                          <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" class="w-full h-full object-cover" />
                        </div>
                      </div>
                      <div class="flex flex-col gap-1">
                        <p class="font-bold text-xl text-gray-900"><?= $user["name"] ?></p>
                        <p class="text-sm text-gray-500"><?= $user["position"] ?></p>
                        <p class="text-sm text-gray-500">PT Des Teknologi Informasi</p>
                      </div>
                      <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="ml-auto self-center px-4 py-1 rounded-xl border border-gray-200 cursor-pointer text-gray-700 hover:bg-gray-100" type="button">
                        Edit
                      </button>
                    </div>
                  </div>
                  
                  <div class="px-8 flex flex-col gap-2 rounded-lg border border-gray-200">
                    <h1 class="text-gray-700 font-semibold mt-6">Personal Information</h1>
                    <div class="py-6 flex flex-col gap-5 justify-start w-full">
                      <div class="gap-40 grid grid-cols-2">
                        <div>
                          <p class="text-gray-500 mb-2">Name:</p>
                          <p class="text-gray-900"><?= $user["name"] ?></p>
                        </div>
                        <div>
                          <p class="text-gray-500 mb-2">Position:</p>
                          <p class="text-gray-900"><?= $user["position"] ?></p>
                        </div>
                      </div>
                      <div class="gap-40 grid grid-cols-2">
                        <div>
                          <p class="text-gray-500 mb-2">Email:</p>
                          <p class="text-gray-900"><?= $user["email"] ?></p>
                        </div>
                        <div>
                          <p class="text-gray-500 mb-2">Phone Number:</p>
                          <p class="text-gray-900">08123456789</p>
                        </div>
                      </div>
                    </div>
                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="ml-auto self-center px-4 py-1 rounded-xl border border-gray-200 cursor-pointer text-gray-700 hover:bg-gray-100" type="button">
                      Edit
                    </button>
                  </div>

                  <div class="px-8 flex flex-col gap-2 rounded-lg border border-gray-200">
                    <h1 class="text-gray-700 font-semibold mt-6">Password Information</h1>
                    <div class="py-6 flex flex-row gap-5 justify-start w-full">
                      <div class="gap-40 grid grid-cols-2">
                        <div>
                          <p>Current Password</p>
                          <p class="p-2">********</p>
                        </div>
                        <div>
                          <p>New Password</p>
                          <input type="text" placeholder="Input new password here" class="bg-gray-200 p-2 rounded-lg">
                        </div>
                      </div>
                      <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="ml-auto self-center px-4 py-1 rounded-xl border border-gray-200 cursor-pointer text-gray-700 hover:bg-gray-100" type="button">
                        Edit
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal yang telah disesuaikan -->
            <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative p-4 w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm">
                  <!-- Modal header -->
                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                      Edit Profile
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                    </button>
                  </div>
                  <!-- Modal body -->
                  <form class="p-4 md:p-5">
                    <!-- Personal Information -->
                    <div class="grid gap-4 mb-4 grid-cols-2">
                      <div class="col-span-2">
                        <h2 class="text-gray-700 font-semibold">Personal Information</h2>
                      </div>
                      <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <input type="text" name="name" id="name" value="<?= $user['name'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter your name" required>
                      </div>
                      <div>
                        <label for="position" class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                        <input type="text" name="position" id="position" value="<?= $user['position'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter your position" required>
                      </div>
                      <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" id="email" value="<?= $user['email'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter your email" required>
                      </div>
                      <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
                        <input type="text" name="phone" id="phone" value="08123456789" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter your phone number" required>
                      </div>
                    </div>
                    <!-- Password Information -->
                    <div class="grid gap-4 mb-4 grid-cols-2">
                      <div class="col-span-2">
                        <h2 class="text-gray-700 font-semibold">Password Information</h2>
                      </div>
                      <div>
                        <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter current password" required>
                      </div>
                      <div>
                        <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Enter new password" required>
                      </div>
                    </div>
                    <button type="submit" class="text-primary inline-flex items-center bg-white border border-primary hover:bg-primary hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                      Save
                    </button>
                  </form>
                </div>
              </div>
            </div>
            <!-- End Modal -->
          </div>
        </div>
      </div>
    </div>
    <script>
      lucide.createIcons();
    </script>
  </body>
</html>
