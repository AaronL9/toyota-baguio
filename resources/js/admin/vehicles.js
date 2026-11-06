import Swal from "sweetalert2";
import Alpine from "../shared/alpine";

Alpine.data('vehicles', (csrf_token) => ({
    // CSRF token used to validate API requests.
    csrf_token,

    // Vehicle records and pagination metadata.
    vehicles: [],
    pageDetails: {
        total: 0,
        currentPage: 0,
        pageCount: 0,
        next: null,
        previous: null,
    },

    // Indicates whether vehicle data is being loaded.
    loading: true,

    /**
     * Fetches vehicles and updates the list and pagination data.
     * @param {string} uri API endpoint to fetch.
     */
    async init(uri = "/api/vehicle") {
        try {
            const response = await fetch(uri);
            const json = await response.json();

            this.vehicles = json.vehicles;
            this.pageDetails = json.pageDetails;
            this.loading = false;

            console.log(json);
        } catch (error) {
            console.log(error);
        }
    },

    /**
     * Loads the next page using the URL from the clicked button.
     * @param {Event} e Click event.
     */
    async next(e) {
        const btn = e.currentTarget;

        if (!(btn instanceof HTMLButtonElement)) return;

        this.loading = true;
        this.init(btn.dataset.uri);
    },

    /**
     * Loads the previous page using the URL from the clicked button.
     * @param {Event} e Click event.
     */
    async prev(e) {
        const btn = e.currentTarget;

        if (!(btn instanceof HTMLButtonElement)) return;

        this.loading = true;
        this.init(btn.dataset.uri);
    },

    /**
     * Filters vehicles using the search input value.
     * @param {Event} e Input event.
     */
    async search(e) {
        this.loading = true;

        const target = e.currentTarget;

        if (!(target instanceof HTMLInputElement)) return;

        const uri = new URL("/api/vehicle", location.origin);
        uri.searchParams.append("search", target.value);

        this.init(uri.toString());
    },

    /**
     * Updates a vehicle's active/inactive status.
     * @param {string} id Vehicle ID.
     * @param {boolean} active Current active status.
     */
    async toggleActive(id, active) {
        try {
            const response = await fetch(`/api/vehicle/${id}`, {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    inactive: Number(!active),
                    csrf_token: this.csrf_token,
                }),
            });

            if (!response.ok) {
                throw new Error("Failed to update variant status.");
            }

            const data = await response.json();

            // Store the refreshed CSRF token returned by the API.
            this.csrf_token = data.csrf_token;

            Swal.fire({
                title: "Success",
                text: data.message,
                icon: "success",
            });
        } catch (error) {
            console.error(error);

            await Swal.fire({
                title: "Error",
                text: "Failed to update variant status.",
                icon: "error",
            });
        }
    },

    /**
     * Confirms and deletes a vehicle.
     * @param {string} id Vehicle ID.
     */
    async deleteRow(id) {
        await Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            showLoaderOnConfirm: true,

            // Executes the deletion after confirmation.
            preConfirm: async () => {
                try {
                    const response = await fetch(`/api/vehicle/${id}`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            csrf_token: this.csrf_token,
                        }),
                    });

                    if (!response.ok) {
                        throw new Error("Failed to delete vehicle.");
                    }

                    const data = await response.json();

                    // Refresh CSRF token and reload the vehicle list.
                    this.csrf_token = data.csrf_token;
                    this.init();

                    Swal.fire({
                        title: "Deleted!",
                        text: data.message,
                        icon: "success",
                    });
                } catch (error) {
                    console.error(error);

                    Swal.fire({
                        title: "Error",
                        text: "Something went wrong",
                        icon: "error",
                    });
                }
            }
        });
    }
}));

Alpine.start();