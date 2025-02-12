<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="<?=base_url()?>/desnetLogo.png" />
    <title>History</title>
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
                    <div class="flex flex-row w-full gap-4">
                        <div class="flex text-white justify-center gap-4 items-center">
                            <div class="flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 hover:bg-primary hover:text-white" data-sort="created_at">
                                Date <i data-lucide="arrow-up-down"></i>
                            </div>
                            <div class="flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 hover:bg-primary hover:text-white" data-sort="pic_name">
                                Name <i data-lucide="arrow-up-down"></i>
                            </div>
                            <div class="flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 gap-2 justify-center items-center">
                                <input type="date" id="startDate" class="w-22 rounded-lg p-1 text-text-200">
                                <p>to</p>
                                <input type="date" id="endDate" class="w-22 rounded-lg p-1 text-text-200">
                            </div>
                            <div class="flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 text-text-100">
                                <select id="statusFilter" class="text-black p-1 rounded-lg">
                                    <option value="">All</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Scheduled</option>
                                    <option value="2">Rescheduled</option>
                                    <option value="3">Done</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col bg-white p-6 rounded-lg shadow w-full">
                        <table class="w-full border-collapse rounded-lg">
                            <thead>
                                <tr class="bg border-b border-gray-200 text-left rounded-2xl">
                                    <th class="p-3">Visit Date</th>
                                    <th class="p-3">PIC Name</th>
                                    <th class="p-3">Institution</th>
                                    <th class="p-3">Contact</th>
                                    <th class="p-3">Agenda</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3">More Info</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody" class="text-md">
                                <?php foreach ($guests as $item): ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-50" data-status="<?= $item['status'] ?>">
                                    <td class="p-3"><?= date('d-m-Y, H:i', strtotime($item['created_at'])) ?></td>
                                    <td class="p-3"><?= esc($item['pic_name']) ?></td>
                                    <td class="p-3"><?= esc($item['institution_name']) ?></td>
                                    <td class="p-3"><?= esc($item['phone_number']) ?></td>
                                    <td class="p-3"><?= esc($item['agenda']) ?></td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 text-sm justify-center items-center">
                                            <?= status($item['status']) ?>
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        <a href="/infodata/<?= $item["id"]?>" class="text-sm text-primary border-b-1 border-primary">
                                            View Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let tableBody = document.getElementById("tableBody");
            let rows = Array.from(tableBody.querySelectorAll("tr"));
            
            document.querySelectorAll("[data-sort]").forEach(header => {
                header.addEventListener("click", function () {
                    let sortKey = this.getAttribute("data-sort");
                    let ascending = this.getAttribute("data-order") !== "desc";
                    this.setAttribute("data-order", ascending ? "desc" : "asc");

                    rows.sort((rowA, rowB) => {
                        let cellA = rowA.querySelector(`td:nth-child(${sortKey === "pic_name" ? 2 : 1})`);
                        let cellB = rowB.querySelector(`td:nth-child(${sortKey === "pic_name" ? 2 : 1})`);

                        if (!cellA || !cellB) return 0;

                        let valA = cellA.textContent.trim().toLowerCase();
                        let valB = cellB.textContent.trim().toLowerCase();

                        if (sortKey === "created_at") { 
                            let parseDate = (str) => {
                                let [datePart, timePart] = str.split(", ");
                                let [day, month, year] = datePart.split("-").map(num => parseInt(num, 10));
                                return new Date(year, month - 1, day, ...timePart.split(":").map(num => parseInt(num, 10)));
                            };

                            valA = parseDate(valA);
                            valB = parseDate(valB);
                        }

                        return ascending ? (valA > valB ? 1 : -1) : (valA < valB ? 1 : -1);
                    });

                    tableBody.innerHTML = "";
                    rows.forEach(row => tableBody.appendChild(row));
                });
            });


            document.getElementById("statusFilter").addEventListener("change", function () {
                let selectedStatus = this.value;
                rows.forEach(row => {
                    let rowStatus = row.getAttribute("data-status");
                    row.style.display = (selectedStatus === "" || rowStatus === selectedStatus) ? "" : "none";
                });
            });

            document.getElementById("startDate").addEventListener("change", filterByDate);
            document.getElementById("endDate").addEventListener("change", filterByDate);

            function filterByDate() {
                let startDate = document.getElementById("startDate").valueAsDate;
                let endDate = document.getElementById("endDate").valueAsDate;

                rows.forEach(row => {
                    let dateText = row.querySelector("td:first-child").textContent.trim();
                    let rowDate = new Date(dateText.split(",")[0].split("-").reverse().join("-"));

                    row.style.display = 
                        (!startDate || rowDate >= startDate) && (!endDate || rowDate <= endDate) 
                        ? "" : "none";
                });
            }
        });

        lucide.createIcons();
    </script>
  </body>
</html>