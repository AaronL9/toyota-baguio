
import Swal from "sweetalert2";
import Alpine from '../shared/alpine';

Alpine.data("variants_edit", (csrf_token = "") => ({
    csrf_token,

    /** @type {Record<string, string> | null} */
    validation: null,

    loading: false,

    /**
     * Handles the default variant toggle confirmation.
     *
     * @param {Event} e
     */
    async onDefaultToggle(e) {
        const input = e.currentTarget;

        if (!(input instanceof HTMLInputElement)) return;

        // Only warn when turning ON.
        if (!input.checked) return;

        const result = await Swal.fire({
            title: "Overwrite default variant?",
            text: "If you set this as default, it will overwrite the current default variant for this vehicle.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, set as default",
            cancelButtonText: "Cancel",
        });

        if (!result.isConfirmed) {
            input.checked = false;
        }
    },

    /**
     * Updates the variant using the native Fetch API.
     *
     * @param {SubmitEvent} e
     */
    async update(e) {
        e.preventDefault();

        const form = e.currentTarget;

        if (!(form instanceof HTMLFormElement)) return;

        this.loading = true;

        const uri = form.action;

        try {
            const response = await fetch(form.action, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                method: "POST",
                body: new FormData(form),
            });

            const data = await response.json();

            // Update the CSRF token when the server provides one.
            if (data.csrf_token) {
                this.csrf_token = data.csrf_token;
            }

            if (response.status === 422) {
                this.validation = data.errors ?? null;
                return;
            }

            if (!response.ok) {
                throw new Error(data.message || "Something went wrong.");
            }

            Swal.fire({
                title: "Updated",
                text: data.message,
                icon: "success",
            });

            this.validation = null;

        } catch (error) {
            console.error(error);

            Swal.fire({
                title: "Error",
                text: error instanceof Error
                    ? error.message
                    : "Unable to update variant.",
                icon: "error",
            });

        } finally {
            this.loading = false;
        }
    },
}));

Alpine.start();