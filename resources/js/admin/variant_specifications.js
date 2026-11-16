import Swal from "sweetalert2";
import Alpine from '../shared/alpine';
import collapse from '@alpinejs/collapse'

Alpine.plugin(collapse)

Alpine.data("variant_specifications", (csrf_token = "", id = "") => ({
    csrf_token,

    validation: null,
    loading: false,
    updating: false,
    timeout: null,
    controller: null,

    toast: {
        show: false,
        type: "success",
        message: "",
        _timer: null,
    },

    data: [],

    /**
     * Fetches specifications associated with the variant.
     */
    async init() {
        try {
            const uri = new URL("/api/variants-specifications", location.origin);
            uri.searchParams.set("variant_id", id);

            const response = await fetch(uri);
            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || "Failed to fetch specifications.");
            }

            this.data = data;

        } catch (error) {
            console.error(error);
        }
    },

    /**
     * Adds specifications to the current variant.
     * @param {SubmitEvent} e
     */
    async addSpecification(e) {
        e.preventDefault();

        const form = e.currentTarget;

        if (!(form instanceof HTMLFormElement)) return;

        this.loading = true;

        try {
            const response = await fetch(form.action, {
                method: form.method || "POST",
                body: new FormData(form),
            });

            const data = await response.json();

            if (!response.ok) {
                this.validation = data.errors ?? null;
                throw new Error(data.message || "Failed to add specification.");
            }

            this.csrf_token = data.csrf_token;
            this.validation = null;

            await this.init();

            await Swal.fire({
                title: "Added!",
                text: data.message,
                icon: "success",
            });

        } catch (error) {
            console.error(error);

        } finally {
            this.loading = false;
        }
    },

    /**
     * Updates a specification value after a debounce delay.
     * Cancels any pending request before sending another.
     * @param {string} spec_val
     * @param {string} uri
     */
    updateSpecification(spec_val, uri) {
        this.updating = true;

        if (this.timeout) clearTimeout(this.timeout);

        // Cancel the previous request.
        if (this.controller) this.controller.abort();

        this.controller = new AbortController();

        this.timeout = setTimeout(async () => {
            const controller = this.controller;

            try {
                const response = await fetch(uri, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        spec_val,
                        csrf_token: this.csrf_token,
                    }),
                    signal: controller.signal,
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || "Failed to update specification.");
                }

                this.csrf_token = data.csrf_token;

                this.showToast("success", "Specification has been updated");

            } catch (error) {
                if (error instanceof Error && error.name === "AbortError") return;

                console.error(error);
                this.showToast("error", "Failed to update specification.");

            } finally {
                // Only the latest request should reset the loading state.
                if (this.controller === controller) {
                    this.updating = false;
                }
            }
        }, 1000);
    },

    /**
     * Deletes a specification after confirmation.
     * @param {string} vsc
     * @param {string} vs
     * @param {string} uri
     */
    async deleteSpecification(vsc, vs, uri) {
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
                    const response = await fetch(uri, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            vsc,
                            vs,
                            csrf_token: this.csrf_token,
                        }),
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || "Failed to delete specification.");
                    }

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

        this.csrf_token = result.value.csrf_token;

        await this.init();

        await Swal.fire({
            title: "Deleted!",
            text: result.value.message,
            icon: "success",
        });
    },

    /**
     * Displays a temporary notification.
     * @param {"success" | "error"} type
     * @param {string} message
     */
    showToast(type, message) {
        if (this.toast._timer) clearTimeout(this.toast._timer);

        this.toast = {
            ...this.toast,
            type,
            message,
            show: true,
        };

        this.toast._timer = setTimeout(() => {
            this.toast.show = false;
        }, 3000);
    },
}));

Alpine.start();