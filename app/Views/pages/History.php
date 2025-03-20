<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/svg+xml" href="<?= base_url() ?>/desnetLogo.png" />

  <title>History</title>
  
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <script src="https://cdn.jsdelivr.net/npm/daisyui@latest"></script>
  <script src="<?= base_url('js/flowbite.min.js') ?>"></script>
  <script src="<?= base_url('js/lucide.js') ?>"></script>
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

    <!-- Sidebar -->
    <?= $this->include('components/Sidebar') ?>

    <div class="pr-2 flex gap-2 w-full md:ml-64">
      <div class="flex flex-col gap-2 w-full">

        <!-- Header -->
        <?= $this->include('components/Header') ?>

        <!-- Main content -->
        <div class="flex flex-col gap-2 w-full my-2 px-5">

          <!-- Sorting & Filtering-->
          <div class="flex flex-row w-full gap-4">
            <div class="flex text-white justify-center gap-4 items-center">
              <button class="flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 hover:bg-primary hover:text-white"
                data-sort="created_at" data-order="asc">
                Date <i data-lucide="arrow-up-down" class="w-4"></i>
              </button>
              <button class="flex flex-row gap-2 rounded-3xl border border-gray-200 px-5 bg-white py-1 cursor-pointer text-text-100 hover:bg-primary hover:text-white"
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
                  <option value="3">Done</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Table Section -->
          <div class="flex flex-col bg-white p-6 rounded-lg shadow w-full">
            <table class="w-full table-fixed min-w-0 border-collapse rounded-lg overflow-hidden">
              <thead>
                <tr class="text-gray-700 text-sm uppercase border-b border-gray-200">
                  <?php if ($user['is_admin'] == 1): ?>
                    <th class="p-4 w-20 2xl:w-30">Visit Date</th>
                  <?php endif; ?>
                  <?php if ($user['is_admin'] != 1): ?>
                    <th class="p-4 w-30">Visit Date</th>
                  <?php endif; ?>
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
                    <?php if ($user['is_admin'] == 1): ?>
                      <td class="p-4 w-28 2xl:w-40"><?= date('d-m-Y, H:i', strtotime($item['created_at'])) ?></td>
                    <?php endif; ?>
                    <?php if ($user['is_admin'] != 1): ?>
                      <td class="p-4 w-40"><?= date('d-m-Y, H:i', strtotime($item['created_at'])) ?></td>
                    <?php endif; ?>
                    <td class="p-4 w-40 whitespace-nowrap truncate"><?= esc($item['pic_name']) ?></td>
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

            <!-- Pagination -->
            <div class="flex justify-between items-center">
              <div class="flex items-center justify-center">
                <p class="text-sm text-gray-400">Show <?= $totalVisitors ?> guest</p>
              </div>
              <nav aria-label="Page navigation example" class="mt-4 flex justify-end">
                <ul id="paginationLinks" class="flex items-center -space-x-px h-8 text-sm">
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const tableBody = document.getElementById("tableBody");
      const originalRows = Array.from(tableBody.querySelectorAll("tr"));
      let currentRows = [...originalRows];
      let currentPage = 1;
      const rowsPerPage = 20;

      // Pagination
      function updatePaginationLinks(totalPages) {
        const paginationLinksContainer = document.getElementById("paginationLinks");
        paginationLinksContainer.innerHTML = "";

        // Pagination Prev Button
        const liPrev = document.createElement("li");
        const aPrev = document.createElement("a");
        aPrev.href = "#";
        aPrev.innerHTML = `<span class="sr-only">Previous</span>
          <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" 
               xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" 
                  stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
          </svg>`;
        aPrev.className = "flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700";
        if (currentPage === 1) {
          aPrev.classList.add("opacity-50", "cursor-not-allowed");
        } else {
          aPrev.addEventListener("click", function(e) {
            e.preventDefault();
            currentPage--;
            renderTable();
          });
        }
        liPrev.appendChild(aPrev);
        paginationLinksContainer.appendChild(liPrev);

        // Max Page Number
        let startPage, endPage;
        if (totalPages <= 3) {
          startPage = 1;
          endPage = totalPages;
        } else {
          startPage = currentPage - 1;
          endPage = currentPage + 1;
          if (startPage < 1) {
            startPage = 1;
            endPage = 3;
          }
          if (endPage > totalPages) {
            endPage = totalPages;
            startPage = totalPages - 2;
          }
        }

        if (startPage > 1) {
          const liFirst = document.createElement("li");
          const aFirst = document.createElement("a");
          aFirst.href = "#";
          aFirst.textContent = "1";
          aFirst.className = "flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700";
          aFirst.addEventListener("click", function(e) {
            e.preventDefault();
            currentPage = 1;
            renderTable();
          });
          liFirst.appendChild(aFirst);
          paginationLinksContainer.appendChild(liFirst);

          if (startPage > 2) {
            const liEllipsis = document.createElement("li");
            const spanEllipsis = document.createElement("span");
            spanEllipsis.textContent = "...";
            spanEllipsis.className = "flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300";
            liEllipsis.appendChild(spanEllipsis);
            paginationLinksContainer.appendChild(liEllipsis);
          }
        }

        // Page Number
        for (let i = startPage; i <= endPage; i++) {
          const li = document.createElement("li");
          const a = document.createElement("a");
          a.href = "#";
          a.textContent = i;
          if (i === currentPage) {
            a.setAttribute("aria-current", "page");
            a.className = "z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700";
          } else {
            a.className = "flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700";
            a.addEventListener("click", function(e) {
              e.preventDefault();
              currentPage = i;
              renderTable();
            });
          }
          li.appendChild(a);
          paginationLinksContainer.appendChild(li);
        }

        if (endPage < totalPages) {
          if (endPage < totalPages - 1) {
            const liEllipsis = document.createElement("li");
            const spanEllipsis = document.createElement("span");
            spanEllipsis.textContent = "...";
            spanEllipsis.className = "flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300";
            liEllipsis.appendChild(spanEllipsis);
            paginationLinksContainer.appendChild(liEllipsis);
          }
          const liLast = document.createElement("li");
          const aLast = document.createElement("a");
          aLast.href = "#";
          aLast.textContent = totalPages;
          aLast.className = "flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700";
          aLast.addEventListener("click", function(e) {
            e.preventDefault();
            currentPage = totalPages;
            renderTable();
          });
          liLast.appendChild(aLast);
          paginationLinksContainer.appendChild(liLast);
        }

        // Pagination Next Button
        const liNext = document.createElement("li");
        const aNext = document.createElement("a");
        aNext.href = "#";
        aNext.innerHTML = `<span class="sr-only">Next</span>
          <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" 
               xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" 
                  stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>`;
        aNext.className = "flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700";
        if (currentPage === totalPages) {
          aNext.classList.add("opacity-50", "cursor-not-allowed");
        } else {
          aNext.addEventListener("click", function(e) {
            e.preventDefault();
            currentPage++;
            renderTable();
          });
        }
        liNext.appendChild(aNext);
        paginationLinksContainer.appendChild(liNext);
      }

      // render Table
      function renderTable() {
        tableBody.innerHTML = "";
        const totalPages = Math.ceil(currentRows.length / rowsPerPage) || 1;
        if (currentPage > totalPages) currentPage = totalPages;
        const start = (currentPage - 1) * rowsPerPage;
        const pageRows = currentRows.slice(start, start + rowsPerPage);
        pageRows.forEach(row => tableBody.appendChild(row));
        updatePaginationLinks(totalPages);
      }

      // Filtering by date
      function applyFilters() {
        const statusFilter = document.getElementById("statusFilter").value;
        const startDateValue = document.getElementById("startDate").value;
        const endDateValue = document.getElementById("endDate").value;

        currentRows = originalRows.filter(row => {
          let statusMatch = true;
          let dateMatch = true;

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

      // Sorting
      document.querySelectorAll("[data-sort]").forEach(header => {
        header.addEventListener("click", function() {
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

      // Filtering
      document.getElementById("statusFilter").addEventListener("change", applyFilters);
      document.getElementById("startDate").addEventListener("change", applyFilters);
      document.getElementById("endDate").addEventListener("change", applyFilters);

      // Apply Filter from home
      const urlParams = new URLSearchParams(window.location.search);
      const statusParam = urlParams.get('status');
      if (statusParam !== null) {
        document.getElementById("statusFilter").value = statusParam;
        applyFilters();
      } else {
        renderTable();
      }

      lucide.createIcons();
    });
  </script>
</body>

</html>