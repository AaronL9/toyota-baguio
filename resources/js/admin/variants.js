
import Alpine from "../shared/alpine";
import Swal from "sweetalert2";

Alpine.data("variants", (csrf_token = "", vehicle_id = "") => ({
    csrf_token,
    vehicle_id,

    variants: [],
    pagination: {
        total: 0,
        currentPage: 0,
        pageCount: 0,
        next: null,
        previous: null,
    },
    loading: true,

    /**
     * Fetches vehicle variants and pagination data.
     * @param {string} uri
     */
    async init(uri = `/api/vehicle/${this.vehicle_id}`) {
        this.loading = true;

        try {
            const response = await fetch(uri);
            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || "Failed to fetch variants.");
            }

            this.variants = data.variants;
            this.pagination = data.pagination;

        } catch (error) {
            console.error(error);
        } finally {
            this.loading = false;
        }
    },

    /**
     * Loads the next page of variants.
     * @param {Event} e
     */
    async next(e) {
        const btn = e.currentTarget;

        if (!(btn instanceof HTMLButtonElement)) return;
        if (!btn.dataset.uri) return;

        await this.init(btn.dataset.uri);
    },

    /**
     * Loads the previous page of variants.
     * @param {Event} e
     */
    async prev(e) {
        const btn = e.currentTarget;

        if (!(btn instanceof HTMLButtonElement)) return;
        if (!btn.dataset.uri) return;

        await this.init(btn.dataset.uri);
    },

    /**
     * Searches variants by model or other supported fields.
     * @param {Event} e
     */
    async search(e) {
        const target = e.currentTarget;

        if (!(target instanceof HTMLInputElement)) return;

        const uri = new URL(
            `/api/vehicle/${this.vehicle_id}/variants`,
            location.origin
        );

        uri.searchParams.set("search", target.value);

        await this.init(uri.toString());
    },

    /**
     * Updates a variant's active status.
     * @param {string} id
     * @param {boolean} active
     */
    async toggleVariant(id, active) {
        try {
            const response = await fetch(`/api/variants/${id}`, {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    inactive: Number(!active),
                    csrf_token: this.csrf_token,
                }),
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || "Failed to update variant.");
            }

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
     * Deletes a variant after confirmation.
     * @param {string} id
     */
    async deleteVariant(id) {
        const result = await Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                try {
                    const response = await fetch(`/api/variants/${id}`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            csrf_token: this.csrf_token,
                        }),
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || "Failed to delete variant.");
                    }

                    this.csrf_token = data.csrf_token;

                    return data;

                } catch (error) {
                    console.error(error);
                    Swal.showValidationMessage(
                        error instanceof Error ? error.message : "Something went wrong."
                    );

                    return false;
                }
            },
        });

        if (!result.isConfirmed || !result.value) return;

        this.variants = this.variants.filter((variant) => variant.id !== id);
        this.pagination.total = Math.max(0, this.pagination.total - 1);

        await Swal.fire({
            title: "Deleted!",
            text: result.value.message,
            icon: "success",
        });
    },
}));

Alpine.start();
