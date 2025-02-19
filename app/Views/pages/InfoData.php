<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="<?= base_url() ?>/desnetLogo.png" />
    <title>Desnet GuestBook</title>
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
                    <div class="flex flex-col bg-white p-6 rounded-lg shadow w-full">
                        <form action="<?= base_url('infodata/edit') ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="guestbook-id" value="<?= $guest['id'] ?>">
                            <input type="hidden" name="status" id="status" value="<?= $guest['status'] ?>">
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

                            <!-- data -->
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

                            <!-- Room and appointment -->
                            <div class="flex grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <h2 class="text-lg font-medium text-gray-700">Room:</h2>
                                    <div>
                                    <select name="room" id="room" class="w-full white border border-gray-300 p-2 rounded-lg">
                                        <?php if ($selectedRoom): ?>
                                            <option value="<?= $selectedRoom['id'] ?>" selected><?= $selectedRoom['name'] ?></option>
                                        <?php else: ?>
                                            <option value="" disabled selected>Select Room</option>
                                        <?php endif; ?>

                                        <?php foreach ($rooms as $room): ?>
                                            <option value="<?= $room["id"] ?>" <?= ($selectedRoom && $room["id"] == $selectedRoom['id']) ? 'selected' : '' ?>>
                                                <?= $room['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="mb-4 appointments-input">
                                    <h2 class="text-lg font-medium text-gray-700">Appointment:</h2>
                                    <div class="flex flex-row gap-2 items-center justify-center">
                                        <div class="relative max-w-sm w-1/2">
                                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input name="date" id="date" value="<?= $guest['date'] ?>" type="date" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Select date">
                                        </div>

                                        <input type="time" name="start-at" id="start-at" value="<?= $guest['start_at'] ?>" class="w-1/3 white border border-gray-300 p-2 rounded rounded-lg">
                                        <p>to</p>
                                        <input type="time" name="end-at" id="end-at" value="<?= $guest['end_at'] ?>" class="w-1/3 white border border-gray-300 p-2 rounded rounded-lg">
                                    </div>
                                </div>
                            </div>

                            <!-- Upload Pictures -->
                            <div class="flex justify-center items-center <?= $guest['status'] == 0 ? 'hidden' : '' ?>">
                                <div class="flex flex-col p-6 w-150 text-center">
                                    <h2 class="text-lg font-semibold mb-3">Upload documentation images</h2>

                                    <!-- Documentation View -->
                                    <div class="grid grid-cols-3 gap-2 mb-4">
                                        <?php foreach($documentations as $doc): ?>
                                            <div class="relative group">
                                            <img src="<?= base_url('documentations/' . $guest['id'] . '/' . $doc['image_name']) ?>" alt="Dokumentasi">
                                                <div class="absolute inset-0 bg-black bg-opacity-50 hidden group-hover:flex items-center justify-center rounded-lg">
                                                    <a href="<?= base_url('documentations/'.$guest['id'].'/'.$doc['image_name']) ?>" 
                                                    target="_blank"
                                                    class="text-white p-1 hover:text-blue-300">
                                                        <i data-lucide="eye"></i>
                                                    </a>
                                                    <button 
                                                        data-modal-target="deleteModal" 
                                                        data-modal-toggle="deleteModal" 
                                                        data-title="documentation image"
                                                        data-delete-url="<?= base_url('infodata/deleteImage/' . $doc['id']) ?>"
                                                        class="text-white p-1 hover:text-red-300">
                                                        <i data-lucide="trash-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Modal Delete -->
                                    <?= $this->include('components/DeleteModal') ?>

                                    <!-- Upload section -->
                                    <label for="fileInput" class="cursor-pointer flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-400 rounded-lg bg-gray-50 hover:bg-gray-100">
                                        <span class="text-gray-500">Click to upload</span>
                                        <input type="file" id="fileInput" name="images[]" multiple class="hidden">
                                    </label>

                                    <div id="preview" class="mt-4 grid grid-cols-3 gap-2"></div>
                                </div>
                            </div>

                            <button id="buttonSave" type="submit" onclick="uploadFiles()" class="mb-4 bg-primary p-2 px-4 rounded rounded-lg justify-center items-center mt-6 w-full">
                                <h2 class="text-lg font-medium text-white text-center cursor-pointer">save</h2>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll('[data-modal-target="deleteModal"][data-delete-url]');
        
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const deleteUrl = button.getAttribute('data-delete-url');
                const dataTitle = button.getAttribute('data-title');
                
                const confirmLink = document.getElementById('confirmDeleteLink');
                confirmLink.setAttribute('href', deleteUrl);

                const modalTitle = document.getElementById('deleteModalTitle');
                modalTitle.textContent = 'Are you sure you want to delete this ' + dataTitle + '?';
            });
        });

        document.getElementById('confirmDeleteLink').addEventListener('click', function(e) {
            e.preventDefault();
            const deleteUrl = this.getAttribute('href');
            
            fetch(deleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '<?= csrf_hash() ?>',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Failed to delete');
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('Error occurred while deleting');
            });
        });

        const fileInput = document.getElementById('fileInput');
        const previewContainer = document.getElementById('preview');
        let currentFiles = [];

        fileInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            currentFiles = currentFiles.concat(files);
            updatePreviews();
            updateFileInput();
        });

        function updatePreviews() {
            previewContainer.innerHTML = '';
            currentFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const div = document.createElement('div');
                    div.className = 'relative group';

                    const imgWrapper = document.createElement('div');
                    imgWrapper.className = 'relative';

                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.className = 'w-full h-32 object-cover rounded-lg';

                    const overlay = document.createElement('div');
                    overlay.className = 'absolute inset-0 bg-black bg-opacity-50 hidden group-hover:flex items-center justify-center rounded-lg';

                    const deleteBtn = document.createElement('button');
                    deleteBtn.className = 'text-white p-1 hover:text-red-300';
                    deleteBtn.onclick = () => {
                        currentFiles.splice(index, 1);
                        updatePreviews();
                        updateFileInput();
                    };

                    const deleteIcon = document.createElement('i');
                    deleteIcon.setAttribute('data-lucide', 'trash-2');
                    deleteBtn.appendChild(deleteIcon);

                    overlay.appendChild(deleteBtn);
                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(overlay);
                    div.appendChild(imgWrapper);
                    previewContainer.appendChild(div);

                    lucide.createIcons();
                };
                reader.readAsDataURL(file);
            });
        }

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            currentFiles.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;
        }

        const appointments = document.querySelectorAll(".appointments-input input");
        const roomSelect = document.getElementById("room");

        function fetchRooms() {
            let date = document.getElementById("date").value;
            let startAt = document.getElementById("start-at").value;
            let endAt = document.getElementById("end-at").value;
            let selectedRoomId = roomSelect.dataset.selected;

            if (!date || !startAt || !endAt) {
                roomSelect.innerHTML = '<option value="" disabled selected>Please insert appointments first</option>';
                return;
            }

            fetch("<?= base_url('infodata/getrooms') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: JSON.stringify({
                    date: date,
                    start_at: startAt,
                    end_at: endAt
                })
            })
            .then(response => response.json())
            .then(rooms => {
                let options = '<option value="" disabled>Select rooms...</option>';
                rooms.forEach(room => {
                    let isSelected = (room.id == selectedRoomId) ? "selected" : "";
                    options += `<option value="${room.id}" ${isSelected}>${room.name}</option>`;
                });
                roomSelect.innerHTML = options;
            })
            .catch(error => console.error("Error fetching rooms:", error));
        }

        roomSelect.dataset.selected = "<?= $selectedRoom['id'] ?? '' ?>";

        appointments.forEach(input => {
            input.addEventListener("change", fetchRooms);
        });

        fetchRooms();
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