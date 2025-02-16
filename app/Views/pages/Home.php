<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="<?= base_url() ?>/desnetLogo.png">
    <title>Desnet GuestBook</title>

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
<body class="min-h-screen bg-[#F9F9F9] flex max-w-full">
    
    <!-- Sidebar -->
    <?= $this->include('components/Sidebar') ?>

    <div class="pr-2 flex gap-2 w-full md:ml-64">
        <div class="flex flex-col gap-2 w-full">
            
            <!-- Header -->
            <?= $this->include('components/Header') ?>

            <div class="flex flex-row justify-between px-5 gap-4">
                
                <!-- Card -->
                <div class="w-full">
                    <?= $this->include('components/Message') ?>

                    <div class="w-full mt-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?= view('components/Card', [
                            'title' => 'Total Visitors',
                            'data' => $totalVisitors,
                            'percentage' => ''
                        ]) ?>

                        <?= view('components/Card', [
                            'title' => 'Monthly Visitors',
                            'data' => $totalVisitorsMonthly,
                            'percentage' => $percentageLastMonth . '% from last month'
                        ]) ?>
                    </div>
                    
                    <!-- Sorting and Filtering -->
                    <div class="flex text-white gap-4 items-center mt-4">
                        <div class="w-30 justify-center flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 hover:bg-primary hover:text-white" data-sort="created_at">
                            Date <i data-lucide="arrow-up-down"></i>
                        </div>
                        <div class="w-30 justify-center flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 hover:bg-primary hover:text-white" data-sort="pic_name">
                            Name <i data-lucide="arrow-up-down"></i>
                        </div>
                        <div class="justify-center flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 gap-2 justify-center items-center">
                            <input type="date" id="startDate" class="w-30 rounded-lg text-text-100" placeholder="Start Date">
                            <p>to</p>
                            <input type="date" id="endDate" class="w-30 rounded-lg text-text-100" placeholder="Start Date">
                        </div>
                        <div class="flex flex-row rounded-3xl border border-gray-200 px-5 bg-white py-1 text-text-100">
                            <select id="statusFilter" class="text-text-100 rounded-lg px-2">
                                <option value="">All</option>
                                <option value="0">Pending</option>
                                <option value="1">Scheduled</option>
                                <option value="2">Rescheduled</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Calendar -->
                <div class="flex">
                    <?= $this->include('components/Calendar') ?>
                </div>

            </div>

            <!-- Table Section -->
            <div class="flex flex-col gap-2 w-full my-2 px-5">
                <div class="flex flex-col bg-white p-6 rounded-lg shadow w-full">
                    <table class="w-full table-fixed min-w-0 border-collapse rounded-lg overflow-hidden">
                        <thead>
                            <tr class="text-gray-700 text-sm uppercase border-b border-gray-200">
                                <th class="p-4 w-32">Visit Date</th>
                                <th class="p-4 w-40">PIC Name</th>
                                <th class="p-4 w-40">Institution</th>
                                <th class="p-4 w-32">Contact</th>
                                <th class="p-4 w-52">Agenda</th>
                                <?php if ($user['is_admin'] == 1): ?>
                                    <th class="p-4 w-40">Employee</th>
                                <?php endif; ?>
                                <th class="p-4 w-32">Status</th>
                                <th class="p-4 w-24">More Info</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="text-gray-600 text-sm">
                            <?php foreach ($guests as $item): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition" data-status="<?= $item['status'] ?>">
                                <td class="p-4 w-40 whitespace-nowrap"><?= date('d-m-Y, H:i', strtotime($item['created_at'])) ?></td>
                                <td class="p-4 w-40 whitespace-nowrap"><?= esc($item['pic_name']) ?></td>
                                <td class="p-4"><?= esc($item['institution_name']) ?></td>
                                <td class="p-4"><?= esc($item['phone_number']) ?></td>
                                <td class="p-4 w-52 overflow-hidden truncate"><?= esc($item['agenda']) ?></td>
                                <?php if ($user['is_admin'] == 1): ?>
                                    <td class="p-4"><?= isset($item['employee_name']) ? esc($item['employee_name']) : 'N/A' ?></td>
                                <?php endif; ?>
                                <td class="p-4 justify-center">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-lg justify-center">
                                        <?= status($item['status']) ?>
                                    </span>
                                </td>
                                <td class="flex p-4 justify-center">
                                    <a href="/infodata/<?= $item['id'] ?>" class="text-blue-600 hover:text-blue-800 border-b border-blue-600">
                                        View Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="flex justify-between items-center mt-6">
                        <p id="pagination-info" class="text-sm text-gray-600"></p>
                        <div class="flex gap-2">
                            <button id="prevPage" class="px-4 py-2 bg-gray-200 rounded" disabled>Previous</button>
                            <button id="nextPage" class="px-4 py-2 bg-gray-200 rounded">Next</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let rows = Array.from(document.querySelectorAll("#tableBody tr"));
            let rowsPerPage = 10;
            let currentPage = 1;
            let totalPages = Math.ceil(rows.length / rowsPerPage);

            function showPage(page) {
                let start = (page - 1) * rowsPerPage;
                let end = start + rowsPerPage;

                rows.forEach((row, index) => {
                    row.style.display = index >= start && index < end ? "" : "none";
                });

                document.getElementById("pagination-info").textContent = `Page ${page} of ${totalPages}`;
                document.getElementById("prevPage").disabled = page === 1;
                document.getElementById("nextPage").disabled = page === totalPages;
            }

            document.getElementById("prevPage").addEventListener("click", function () {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            });

            document.getElementById("nextPage").addEventListener("click", function () {
                if (currentPage < totalPages) {
                    currentPage++;
                    showPage(currentPage);
                }
            });

            showPage(currentPage);
        });

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
