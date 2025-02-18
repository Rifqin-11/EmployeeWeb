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
      <div class="divide-y divide-gray-100 notification-container">

      </div>
      <a href="/History" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100">
        <div class="inline-flex items-center ">
          <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
            <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
          </svg>
          View all
        </div>
      </a>
    </div>
  </div>

  <script>
    let row;
    const notificationContainer = document.querySelector('.notification-container');
    fetch('<?= base_url('Home/notification') ?>', {
        method: 'GET',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json())
      .then(data => {
        data.guests.forEach(guest => {
          row = `<a href="#" class="flex px-4 py-3 hover:bg-gray-100">
                            <div class="shrink-0">
                            </div>
                            <div class="w-full ps-3">
                                <div class="text-gray-500 text-sm mb-1.5">
                                    New guest arrival: <span class="font-semibold text-gray-900">${guest.pic_name}</span> 
                                    from <span class="font-semibold text-gray-900">${guest.institution_name}</span>.
                                    <br>
                                    Agenda: 
                                    <span class="font-semibold block truncate max-w-[300px]">
                                      ${guest.agenda}
                                    </span>
                                </div>
                                <div class="text-xs text-blue-600">${guest.created_at}</div>
                            </div>
                        </a>`;
          notificationContainer.insertAdjacentHTML('beforeend', row);
        });

      });
  </script>