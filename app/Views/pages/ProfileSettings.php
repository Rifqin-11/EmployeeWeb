<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="<?=base_url()?>/desnetLogo.png" />
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
    
    <title>Settings</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/daisyui@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
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
            <div class="flex flex-col bg-white rounded-lg shadow w-full h-full">
              <?= $this->include('components/SettingsHeader'); ?>

              <!-- Settings Content -->
              <div class="flex flex-col mx-10 my-10">
                <div href="/" class="text-gray-900 p-2 rounded-full flex flex-col gap-3">
                  <div class="p-8 flex flex-col gap-2 rounded-lg border border-gray-200">
                    <div class="flex flex-row gap-5 justify-start mt-2 w-full">
                      <div class="avatar">
                        <div class="ring-primary ring-offset-base-100 w-20 h-20 rounded-full ring ring-offset-2 overflow-hidden">
                          <?php if (!empty($user['photo'])) : ?>
                            <img src="<?= base_url($user['photo']) ?>" class="w-full h-full object-cover" />
                          <?php else : ?>
                            <div class="flex items-center justify-center w-full h-full overflow-hidden bg-gray-100 rounded-full">
                              <svg class="absolute w-15 h-15 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                              </svg>
                            </div>
                          <?php endif; ?>
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
                          <p class="text-gray-900">-</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="px-8 flex flex-col gap-2 rounded-lg border border-gray-200">
                    <h1 class="text-gray-700 font-semibold mt-6">Password Information</h1>
                    <div class="py-6 flex flex-row gap-5 justify-start w-full">
                      <div class="gap-40 grid grid-cols-2">
                        <div>
                          <p>Current Password</p>
                          <p class="p-2">********</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative p-4 w-full max-w-xl max-h-full">
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
                  <form action="<?= base_url('/Settings/updateProfile') ?>" method="post" enctype="multipart/form-data" class="px-4 py-2">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">

                    <!-- Profile Pictures -->
                    <h1 class="font-medium text-sm text-gray-400 mb-2">Profile Pictures</h1>
                    <div class="flex flex-row gap-7 mb-8">
                      <div class="avatar">
                        <div class="ring-primary ring-offset-base-100 w-15 h-15 rounded-full ring ring-offset-2 overflow-hidden">
                          <?php if (!empty($user['photo'])) : ?>
                            <img id="profileImage" src="<?= base_url($user['photo']) ?>" class="w-full h-full object-cover" />
                          <?php else : ?>
                            <div class="flex items-center justify-center w-full h-full overflow-hidden bg-gray-100 rounded-full">
                              <svg class="absolute w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                              </svg>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                      <input type="file" id="imageUpload" name="profile_photo" class="hidden" accept="image/*">
                      <div class="flex items-center gap-3">
                          <button type="button" onclick="document.getElementById('imageUpload').click();" class="h-9 px-4 py-1 text-white bg-blue-400 text-sm rounded-lg hover:bg-blue-600">Change picture</button>
                          <button type="button" onclick="removePhoto();" class=" h-9 px-4 py-1 text-red-700 bg-gray-100 border border-gray-200 text-sm rounded-lg hover:bg-red-600 hover:text-white">Delete Profile</button>
                      </div>
                    </div>

                    <h1 class="font-medium text-sm text-gray-400 mb-2">Profile Information</h1>
                    <div class="grid gap-2 mb-6 grid-cols-1">
                      <div class="grid gap-4 grid-cols-2">
                        <div>
                          <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                          <div class="relative mb-2">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                              <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                  <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                              </svg>
                            </div>
                            <input type="text" name="name" id="name" value="<?= $user['name'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Your Name">
                          </div>
                        </div>
                        <div>
                          <label for="position" class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                          <div class="relative mb-2">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                              <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M10 2a3 3 0 0 0-3 3v1H5a3 3 0 0 0-3 3v2.382l1.447.723.005.003.027.013.12.056c.108.05.272.123.486.212.429.177 1.056.416 1.834.655C7.481 13.524 9.63 14 12 14c2.372 0 4.52-.475 6.08-.956.78-.24 1.406-.478 1.835-.655a14.028 14.028 0 0 0 .606-.268l.027-.013.005-.002L22 11.381V9a3 3 0 0 0-3-3h-2V5a3 3 0 0 0-3-3h-4Zm5 4V5a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v1h6Zm6.447 7.894.553-.276V19a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-5.382l.553.276.002.002.004.002.013.006.041.02.151.07c.13.06.318.144.557.242.478.198 1.163.46 2.01.72C7.019 15.476 9.37 16 12 16c2.628 0 4.98-.525 6.67-1.044a22.95 22.95 0 0 0 2.01-.72 15.994 15.994 0 0 0 .707-.312l.041-.02.013-.006.004-.002.001-.001-.431-.866.432.865ZM12 10a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
                              </svg>
                            </div>
                            <input type="text" name="position" id="position" value="<?= $user['position'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Example: Managers">
                          </div>
                        </div>
                      </div>
                        <div>
                          <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                          <div class="relative mb-2">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                              <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                  <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                  <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                              </svg>
                            </div>
                            <input type="text" name="email" id="email" value="<?= $user['email'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="name@mail.com">
                          </div>
                        </div>
                    </div>

                    <h1 class="font-medium text-sm text-gray-400 mb-2">Password Settings</h1>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div>
                            <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        </div>
                        <div>
                            <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        </div>
                    </div>

                    <button type="submit" class="text-primary inline-flex items-center bg-white border border-primary hover:bg-primary hover:text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">
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
      function removePhoto() {
        const container = document.querySelector('#profileImage').parentElement;
        container.innerHTML = `
          <div class="flex items-center justify-center w-full h-full overflow-hidden bg-gray-100 rounded-full">
            <svg class="absolute w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
            </svg>
          </div>
        `;
      }

      let removeInput = document.createElement('input');
        removeInput.type = 'hidden';
        removeInput.name = 'remove_photo';
        removeInput.value = '1';
        document.querySelector('form').appendChild(removeInput);

        document.getElementById('imageUpload').addEventListener('change', function(e) {
          if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
              document.getElementById('profileImage').src = e.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
          }
        });
        
      lucide.createIcons();
    </script>
  </body>
  <?= $this->include('components/Toasts'); ?>
</html>
