import Swal from "sweetalert2";
import Alpine from '../shared/alpine';

Alpine.data("vehicles_edit", () => ({
    validation: null,
    loading: false,

    /**
     * Updates a vehicle and handles validation errors.
     * @param {SubmitEvent} e
     */
    async updateVehicle(e) {
        e.preventDefault();

        const form = e.currentTarget;

        if (!(form instanceof HTMLFormElement)) return;

        this.loading = true;

        try {
            const response = await fetch(form.action, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                method: "POST",
                body: new FormData(form),
            });

            const data = await response.json();

            if (!response.ok) {
                if (response.status === 422) {
                    this.validation = data.errors;
                    return;
                }

                throw new Error(data.message || "Something went wrong.");
            }

            this.validation = null;

            Swal.fire({
                title: "Updated",
                text: data.message,
                icon: "success",
            });

        } catch (error) {
            console.error(error);

        } finally {
            this.loading = false;
        }
    },
}));

Alpine.start();