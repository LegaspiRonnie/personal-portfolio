const API_URL = "http://localhost/personal-portfolio/backend/projects/rest-crud/api/items/items.php";
const ITEMS_PER_PAGE = 10;
let currentPage = 1;

async function loadItems(page = currentPage) {

    // get itemsTableBody element by id
    const itemsTableBody = document.querySelector("#itemsTableBody");

    // validate itemsTableBody if exist
    if (!itemsTableBody) {
        throw new Error("Could not find #itemsTableBody in the DOM.");
    }

    const previousButton = document.querySelector("#previousPage");
    const nextButton = document.querySelector("#nextPage");
    const pageStatus = document.querySelector("#pageStatus");

    // The API uses offset, so page 1 starts at 0, page 2 at ITEMS_PER_PAGE, and so on.
    const offset = (page - 1) * ITEMS_PER_PAGE;
    const params = new URLSearchParams({ limit: String(ITEMS_PER_PAGE), offset: String(offset) });

    // do operations
    try {
        // get response from the url
        const response = await fetch(`${API_URL}?${params}`, {
            method: "GET",
            headers: {
                Accept: "application/json"
            }
        });

        // return error status if failed
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const contentType = response.headers.get("content-type") || "";
        if (!contentType.toLowerCase().includes("application/json")) {
            throw new Error("The server returned an unexpected response format.");
        }

        const json = await response.json();

        if (json?.status === false) {
            throw new Error(typeof json.message === "string" ? json.message : "The request failed.");
        }
        const items = Array.isArray(json) ? json : json?.data;
        if (!Array.isArray(items)) {
            throw new Error("The server response did not contain an item list.");
        }
        const isDisplayValue = (value) => value === null || ["string", "number"].includes(typeof value);
        if (items.some((item) => !item || typeof item !== "object" || Array.isArray(item)
            || !isDisplayValue(item.id) || !isDisplayValue(item.name)
            || !isDisplayValue(item.category) || !isDisplayValue(item.rarity)
            || !isDisplayValue(item.price))) {
            throw new Error("The server returned an item with invalid fields.");
        }

        currentPage = page;
        const pagination = json.pagination;
        const totalItems = Number(pagination?.total ?? items.length);
        const pageLimit = Number(pagination?.limit ?? ITEMS_PER_PAGE);
        const totalPages = Number.isFinite(totalItems) && Number.isFinite(pageLimit) && pageLimit > 0
            ? Math.max(1, Math.ceil(totalItems / pageLimit))
            : 1;
        const hasMore = typeof pagination?.has_more === "boolean"
            ? pagination.has_more
            : currentPage < totalPages;
        if (previousButton) previousButton.disabled = currentPage <= 1;
        if (nextButton) nextButton.disabled = !hasMore;
        if (pageStatus) pageStatus.textContent = `Page ${currentPage} of ${totalPages}`;

        itemsTableBody.replaceChildren();

        if (items.length === 0) {
            const row = itemsTableBody.insertRow();
            const cell = row.insertCell();
            cell.colSpan = 6;
            cell.textContent = "No items found.";
            return;
        }

        items.forEach((item) => {
            const row = document.createElement("tr");
            [item.id, item.name, item.category, item.rarity, item.price, "—"].forEach((value) => {
                const cell = row.insertCell();
                cell.textContent = value === null || value === undefined ? "" : String(value);
            });
            itemsTableBody.appendChild(row);
        });
    } catch (error) {
        console.error("Failed to load items:", error);
        itemsTableBody.replaceChildren();
        const row = itemsTableBody.insertRow();
        const cell = row.insertCell();
        cell.colSpan = 6;
        cell.textContent = "Failed to load items.";
    }
}

// Previous and Next ask the API for a different slice of the same item list.
document.querySelector("#previousPage")?.addEventListener("click", () => {
    if (currentPage > 1) loadItems(currentPage - 1);
});

document.querySelector("#nextPage")?.addEventListener("click", () => {
    const nextButton = document.querySelector("#nextPage");
    if (nextButton && !nextButton.disabled) loadItems(currentPage + 1);
});

loadItems(1);
