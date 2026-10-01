const API_URL = "http://localhost/personal-portfolio/backend/projects/rest-crud/api/items/items.php";

async function loadItems() {

    // get itemsTableBody element by id
    const itemsTableBody = document.querySelector("#itemsTableBody");

    // validate itemsTableBody if exist
    if (!itemsTableBody) {
        throw new Error("Could not find #itemsTableBody in the DOM.");
    }

    // do operations
    try {
        // get response from the url
        const response = await fetch(API_URL, {
            method: "GET",
            headers: {
                Accept: "application/json"
            }
        });

        // return error status if failed
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        // get content type if exist else empty string 
        const contentType = response.headers.get("content-type") || "";

        // if contenttype does not include application/json throw err
        if (!contentType.toLowerCase().includes("application/json")) {
            throw new Error("The server returned an unexpected response format.");
        }

        // get response json and store in json variable
        const json = await response.json();

        // if json status is false thorw error 
        if (json?.status === false) {
            throw new Error(typeof json.message === "string" ? json.message : "The request failed.");
        }

        // if json has nested array or the json object has array 
        const items = Array.isArray(json) ? json : json?.data;

        // else if items is not an array 
        if (!Array.isArray(items)) {
            throw new Error("The server response did not contain an item list.");
        }

        // 
        const isDisplayValue = (value) => value === null || ["string", "number"].includes(typeof value);

        // 
        if (items.some((item) => !item || typeof item !== "object" || Array.isArray(item)
            || !isDisplayValue(item.id) || !isDisplayValue(item.name)
            || !isDisplayValue(item.category) || !isDisplayValue(item.rarity)
            || !isDisplayValue(item.price))) {
            throw new Error("The server returned an item with invalid fields.");
        }

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

loadItems();
