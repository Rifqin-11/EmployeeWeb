<!-- components/DeleteModal.php -->
<div id="deleteModal" tabindex="-1" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="relative p-4 w-full max-w-md max-h-full">
    <div class="relative bg-white py-5 rounded-lg shadow">
      <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8" data-modal-hide="deleteModal">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
        <span class="sr-only">Close modal</span>
      </button>
      <div class="p-4 text-center">
        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        <h3 id="deleteModalTitle" class="mb-5 text-lg font-normal text-gray-900">
          Are you sure you want to delete this item?
        </h3>
        <a href="#" id="confirmDeleteLink" data-modal-hide="deleteModal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
          Yes, I'm sure
        </a>
        <button data-modal-hide="deleteModal" type="button" class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100">
          No, cancel
        </button>
      </div>
    </div>
  </div>
</div>
