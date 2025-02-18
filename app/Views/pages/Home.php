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
              'percentage' => $percentageLastMonth
            ]) ?>
          </div>
          
          <!-- Sorting and Filtering -->
          <div class="flex text-white gap-4 items-center mt-4">
            <button class="w-30 flex flex-row gap-2 justify-center rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 hover:bg-primary hover:text-white"
                    data-sort="created_at" data-order="asc">
              Date <i data-lucide="arrow-up-down" class="w-4"></i>
            </button>
            <button class="w-30 flex flex-row gap-2 justify-center rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 hover:bg-primary hover:text-white"
                    data-sort="pic_name" data-order="asc">
              Name <i data-lucide="arrow-up-down" class="w-4"></i>
            </button>
            <div class="flex flex-row gap-2 items-center">
              <div class="rounded-2xl border border-gray-200 px-5 bg-white py-1">
                <input type="date" id="startDate" class="w-30 rounded-lg text-text-100" placeholder="Start Date">
              </div>
              <h1 class="text-gray-400">to</h1>
              <div class="rounded-2xl border border-gray-200 px-5 bg-white py-1">
                <input type="date" id="endDate" class="w-30 rounded-lg text-text-100" placeholder="End Date">
              </div>
            </div>
            <div class="flex flex-row rounded-3xl border border-gray-200 px-5 bg-white py-1">
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
                <td class="p-4 text-center">
                  <span class="px-3 py-1 text-xs font-semibold rounded-lg">
                    <?= status($item['status']) ?>
                  </span>
                </td>
                <td class="p-4 text-center">
                  <a href="/infodata/<?= $item['id'] ?>" class="text-blue-600 hover:text-blue-800 border-b border-blue-600">
                    View Detail
                  </a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <div class="flex justify-between items-center mt-6">
            <span id="pagination-info" class="text-sm text-gray-600"></span>
            <div class="inline-flex mt-2 xs:mt-0">
              <button class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-800 bg-gray-100 rounded-s hover:bg-primary hover:text-white" id="prevPage">
                Prev
              </button>
              <button class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-800 bg-gray-100 border-0 border-s border-gray-700 rounded-e hover:bg-primary hover:text-white" id="nextPage">
                Next
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const tableBody   = document.getElementById("tableBody");
      const originalRows = Array.from(tableBody.querySelectorAll("tr"));
      let currentRows   = [...originalRows];
      let currentPage   = 1;
      const rowsPerPage = 10;

      function renderTable() {
        tableBody.innerHTML = "";
        const totalPages = Math.ceil(currentRows.length / rowsPerPage) || 1;
        if (currentPage > totalPages) currentPage = totalPages;
        const start = (currentPage - 1) * rowsPerPage;
        const pageRows = currentRows.slice(start, start + rowsPerPage);
        pageRows.forEach(row => tableBody.appendChild(row));
        document.getElementById("pagination-info").textContent = `Page ${currentPage} of ${totalPages}`;
        document.getElementById("prevPage").disabled = currentPage === 1;
        document.getElementById("nextPage").disabled = currentPage === totalPages;
      }

      function applyFilters() {
        const statusFilter   = document.getElementById("statusFilter").value;
        const startDateValue = document.getElementById("startDate").value;
        const endDateValue   = document.getElementById("endDate").value;
        
        currentRows = originalRows.filter(row => {
          let statusMatch = true;
          let dateMatch   = true;
          
          if (statusFilter !== "") {
            statusMatch = row.getAttribute("data-status") === statusFilter;
          }
          
          if (startDateValue || endDateValue) {
            const dateCellText = row.querySelector("td:first-child").textContent.trim();
            const [datePart] = dateCellText.split(", ");
            const [day, month, year] = datePart.split("-").map(Number);
            const rowDate = new Date(year, month - 1, day);
            
            if (startDateValue) {
              const startDate = new Date(startDateValue);
              dateMatch = dateMatch && (rowDate >= startDate);
            }
            if (endDateValue) {
              const endDate = new Date(endDateValue);
              dateMatch = dateMatch && (rowDate <= endDate);
            }
          }
          return statusMatch && dateMatch;
        });
        currentPage = 1;
        renderTable();
      }

      document.querySelectorAll("[data-sort]").forEach(header => {
        header.addEventListener("click", function () {
          const sortKey = this.getAttribute("data-sort");
          let order = this.dataset.order === "asc" ? "desc" : "asc";
          this.dataset.order = order;
          
          currentRows.sort((rowA, rowB) => {
            let cellA, cellB;
            if (sortKey === "pic_name") {
              cellA = rowA.querySelector("td:nth-child(2)");
              cellB = rowB.querySelector("td:nth-child(2)");
            } else if (sortKey === "created_at") {
              cellA = rowA.querySelector("td:nth-child(1)");
              cellB = rowB.querySelector("td:nth-child(1)");
            }
            if (!cellA || !cellB) return 0;
            let valA = cellA.textContent.trim();
            let valB = cellB.textContent.trim();
            if (sortKey === "created_at") {
              const parseDate = (str) => {
                let [datePart, timePart] = str.split(", ");
                let [day, month, year] = datePart.split("-").map(Number);
                let [hours, minutes] = timePart.split(":").map(Number);
                return new Date(year, month - 1, day, hours, minutes);
              };
              valA = parseDate(valA);
              valB = parseDate(valB);
              return order === "asc" ? valA - valB : valB - valA;
            } else {
              if (valA < valB) return order === "asc" ? -1 : 1;
              if (valA > valB) return order === "asc" ? 1 : -1;
              return 0;
            }
          });
          renderTable();
        });
      });

      document.getElementById("statusFilter").addEventListener("change", applyFilters);
      document.getElementById("startDate").addEventListener("change", applyFilters);
      document.getElementById("endDate").addEventListener("change", applyFilters);

      document.getElementById("prevPage").addEventListener("click", function () {
        if (currentPage > 1) {
          currentPage--;
          renderTable();
        }
      });
      document.getElementById("nextPage").addEventListener("click", function () {
        const totalPages = Math.ceil(currentRows.length / rowsPerPage) || 1;
        if (currentPage < totalPages) {
          currentPage++;
          renderTable();
        }
      });

      renderTable();
      lucide.createIcons();
    });
  </script>

</body>
</html>
