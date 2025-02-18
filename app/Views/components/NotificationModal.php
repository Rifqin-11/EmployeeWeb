<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
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
  <div>
      <!-- Icon -->
      <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="relative inline-flex items-center text-sm font-medium text-center text-white hover:text-gray-900 focus:outline-none" type="button">
        <div href="/" class="h-10 bg-primary p-2 rounded-full">
          <i data-lucide="bell-ring"></i>
        </div>
        <div class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5"></div>
      </button>
    
      <!-- Dropdown menu -->
      <div id="dropdownNotification" class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow-sm" aria-labelledby="dropdownNotificationButton">
        <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 ">
            Notifications
        </div>
        <div class="divide-y divide-gray-100">
          <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
              <div class="shrink-0">
              </div>
              <div class="w-full ps-3">
                  <div class="text-gray-500 text-sm mb-1.5">
                      New guest arrival: <span class="font-semibold text-gray-900">Rifqi Naufal Pambudi</span> 
                      from <span class="font-semibold text-gray-900">Desnet</span>.
                      <br>
                      Agenda: 
                      <span class="font-semibold block truncate max-w-[300px]">
                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi rerum quam repudiandae perspiciatis voluptatibus! Minus quibusdam recusandae blanditiis dolor molestiae velit non consectetur temporibus. Odio ipsa saepe magni magnam expedita.
                      </span>
                  </div>
                  <div class="text-xs text-blue-600">a few moments ago</div>
              </div>
          </a>
          <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
              <div class="shrink-0">
              </div>
              <div class="w-full ps-3">
                  <div class="text-gray-500 text-sm mb-1.5">
                      New guest arrival: <span class="font-semibold text-gray-900">John Doe</span> 
                      from <span class="font-semibold text-gray-900">Undip</span>.
                      <br>
                      Agenda: 
                      <span class="font-semibold block truncate max-w-[300px]">
                          Membahas perkembangan Indonesia Emas 2040
                      </span>
                  </div>
                  <div class="text-xs text-blue-600">a few moments ago</div>
              </div>
          </a>
          <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
              <div class="shrink-0">
              </div>
              <div class="w-full ps-3">
                  <div class="text-gray-500 text-sm mb-1.5">
                      New guest arrival: <span class="font-semibold text-gray-900">Budi Pekerti</span> 
                      from <span class="font-semibold text-gray-900">Desnet</span>.
                      <br>
                      Agenda: 
                      <span class="font-semibold block truncate max-w-[300px]">
                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi rerum quam repudiandae perspiciatis voluptatibus! Minus quibusdam recusandae blanditiis dolor molestiae velit non consectetur temporibus. Odio ipsa saepe magni magnam expedita.
                      </span>
                  </div>
                  <div class="text-xs text-blue-600">a few moments ago</div>
              </div>
          </a>
        </div>
        <a href="/History" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100">
          <div class="inline-flex items-center ">
            <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
              <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
            </svg>
              View all
          </div>
        </a>
      </div>
  </div>
<script>
  lucide.createIcons();
</script>
</body>
</html>