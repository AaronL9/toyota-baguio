
import Swal from "sweetalert2";
import Alpine from '../shared/alpine';

Alpine.data("variants_create", (csrf_token = "") => ({
    csrf_token,
    validation: null,
    loading: false,
    isValid: true,
    validationMessage: "Something went wrong",

    /**
     * Confirms before setting a variant as default.
     * @param {Event} e
     */
    async onDefaultToggle(e) {
        const input = e.currentTarget;

        if (!(input instanceof HTMLInputElement)) return;

        // Only warn when enabling the default option.
        if (!input.checked) return;

        const result = await Swal.fire({
            title: "Overwrite default variant?",
            text: "If you set this as default, it will overwrite the current default variant for this vehicle.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, set as default",
            cancelButtonText: "Cancel",
            confirmButtonColor: "#b91c1c",
        });

        if (!result.isConfirmed) {
            input.checked = false;
        }
    },

    /**
     * Creates a new vehicle variant.
     * @param {SubmitEvent} e
     */
    async add(e) {
        e.preventDefault();

        const form = e.currentTarget;

        if (!(form instanceof HTMLFormElement)) return;

        this.loading = true;

        try {
            const response = await fetch(form.action, {
                method: "POST",
                body: new FormData(form),
            });

            const data = await response.json();

            if (response.status === 422) {
                this.validation = data.errors;
                this.csrf_token = data.csrf_token;
                return;
            }

            if (!response.ok) {
                throw new Error(data.message || "Failed to create variant.");
            }

            this.csrf_token = data.csrf_token;
            this.validation = null;

            form.reset();

            await Swal.fire({
                title: "Added",
                text: data.message,
                icon: "success",
            });

        } catch (error) {
            console.error(error);

            await Swal.fire({
                title: "Error",
                text: error instanceof Error ? error.message : "Something went wrong.",
                icon: "error",
            });

        } finally {
            this.loading = false;
        }
    },
}));

Alpine.start();