<?php if (session()->getFlashdata('success')) : ?>
    <div id="toast-simple" class="fixed bottom-5 right-5 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-green-400 bg-white rounded-lg shadow-md border border-gray-200 toast" role="alert">
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
          </svg>
        <div class="ps-4 text-sm font-normal"><?= session()->getFlashdata('success'); ?></div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
  <div id="toast-simple" class="fixed bottom-5 right-5 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-red-400 bg-white rounded-lg shadow-md border border-gray-200 toast" role="alert">
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 0.5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207a1 1 0 0 0-1.414 0L10 9.793 7.707 7.5a1 1 0 1 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414Z"/>
    </svg>
    <div class="ps-4 text-sm font-normal"><?= session()->getFlashdata('error'); ?></div>
  </div>
<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
            const toast = document.querySelector(".toast");
            if (toast) {
            setTimeout(() => {
                toast.style.opacity = "0";
                setTimeout(() => {
                toast.remove();
                }, 1000);
            }, 1500);
            }
        });
</script>
