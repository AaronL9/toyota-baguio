import Swal from "sweetalert2";
import Alpine from "../shared/alpine";
// import { HSSelect } from "preline";
// import HSSelect from "@preline/select";
import HSSelect from "@preline/select/non-auto";

Alpine.data('vehicles_new', (csrf_token) => ({
    // CSRF token used to validate API requests.
    csrf_token,

    validation: null,
    loading: false,

    /**
     * Add Vehicle
     * 
     * @param {Event} e 
     * @returns 
     */
    async addVehicle(e) {
        this.loading = true;
        const form = e.currentTarget;

        if (!(form instanceof HTMLFormElement)) {
            this.loading = false;
            return;
        }

        try {
            const response = await fetch("/api/vehicle", {
                method: "POST",
                body: new FormData(form),
            });

            const responseData = await response.json();

            // return console.log(responseData)

            if (response.status === 422) {
                this.validation = responseData.errors;
                this.csrf_token = responseData.csrf_token;
                return;
            }

            if (!response.ok) {
                throw new Error(responseData.message || "Something went wrong.");
            }

            Swal.fire({
                title: "Added",
                text: responseData.message,
                icon: "success",
            });

            this.csrf_token = responseData.csrf_token;

            form.reset();

            const select = HSSelect.getInstance(
                '#hs-multiple-with-option-template'
            );
            select.setValue("");
        } catch (error) {
            console.error(error);
        } finally {
            this.loading = false;
        }
    },
}));

Alpine.start();