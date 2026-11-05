<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>

<section class="relative bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <h1 class="text-4xl md:text-5xl font-bold mt-4 mb-4">Schedule Now</h1>
    </div>
</section>


<body class="flex flex-col min-h-screen">

    <div class="mx-auto py-10" x-data="schedule">
        <section class="bg-white px-4 py-12 text-zinc-900 sm:px-6 md:py-20 lg:px-8"
            aria-labelledby="toyota-inquiry-heading">
            <div class="mx-auto max-w-6xl">

                <!-- Heading -->
                <div class="mb-8 max-w-2xl">
                    <h2 id="toyota-inquiry-heading" class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">
                        Let’s take care of your Toyota.
                    </h2>

                    <p class="mt-4 text-base leading-7 text-zinc-600">
                        Tell us about your vehicle and choose your preferred service schedule.
                    </p>
                </div>

                <form @submit.prevent="onSubmitContact($event)" method="post"
                    class="overflow-hidden rounded-none border border-zinc-200 bg-white shadow-sm">
                    <?= csrf_field('csrf_field') ?>

                    <!-- DB flags -->
                    <input type="hidden" name="inquiry_inactive" value="0" />
                    <input type="hidden" name="inquiry_delete" value="0" />

                    <div class="grid lg:grid-cols-2">

                        <!-- Vehicle and schedule -->
                        <div class="space-y-10 p-5 sm:p-8 lg:p-10">

                            <fieldset class="min-w-0">
                                <legend class="mb-6 flex items-center gap-3">
                                    <span class="text-xl font-bold">
                                        Your Toyota vehicle
                                    </span>
                                </legend>

                                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                                    <!-- Model -->
                                    <div>
                                        <label for="vehicle_no" class="mb-2 block text-sm font-medium text-zinc-700">
                                            Model
                                        </label>

                                        <select id="vehicle_no" name="vehicle_no"
                                            class="block min-h-12 w-full rounded-lg border border-zinc-300 bg-white px-3 py-3 text-sm text-zinc-900 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15 disabled:pointer-events-none disabled:opacity-50">
                                            <option value="">Select model</option>
                                            <option value="wigo">Wigo</option>
                                            <option value="vios">Vios</option>
                                            <option value="yaris">Yaris</option>
                                            <option value="corolla-altis">Corolla Altis</option>
                                            <option value="corolla-cross">Corolla Cross</option>
                                            <option value="camry">Camry</option>
                                            <option value="rav4">RAV4</option>
                                            <option value="fortuner">Fortuner</option>
                                            <option value="hilux">Hilux</option>
                                            <option value="innova">Innova</option>
                                        </select>
                                    </div>

                                    <!-- Year -->
                                    <div>
                                        <label for="inquiry_year" class="mb-2 block text-sm font-medium text-zinc-700">
                                            Year
                                        </label>

                                        <select id="inquiry_year" name="inquiry_year"
                                            class="block min-h-12 w-full rounded-lg border border-zinc-300 bg-white px-3 py-3 text-sm text-zinc-900 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15">
                                            <option value="">Select year</option>
                                            <option>2026</option>
                                            <option>2025</option>
                                            <option>2024</option>
                                            <option>2023</option>
                                            <option>2022</option>
                                            <option>2021</option>
                                            <option>2020</option>
                                        </select>
                                    </div>

                                    <!-- Plate number -->
                                    <div>
                                        <label for="inquiry_plateno"
                                            class="mb-2 block text-sm font-medium text-zinc-700">
                                            Plate number
                                        </label>

                                        <input id="inquiry_plateno" name="inquiry_plateno" type="text"
                                            placeholder="Enter plate number"
                                            class="block min-h-12 w-full rounded-lg border border-zinc-300 bg-white px-3 py-3 text-sm text-zinc-900 placeholder:text-zinc-400 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15" />
                                    </div>

                                    <!-- Mileage -->
                                    <div>
                                        <label for="inquiry_mileage"
                                            class="mb-2 block text-sm font-medium text-zinc-700">
                                            Mileage
                                        </label>

                                        <select id="inquiry_mileage" name="inquiry_mileage"
                                            class="block min-h-12 w-full rounded-lg border border-zinc-300 bg-white px-3 py-3 text-sm text-zinc-900 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15">
                                            <option value="">Select mileage</option>
                                            <option>5k</option>
                                            <option>10k</option>
                                            <option>20k</option>
                                            <option>30k</option>
                                            <option>40k</option>
                                            <option>50k</option>
                                            <option>60k</option>
                                            <option>70k</option>
                                            <option>80k</option>
                                            <option>90k</option>
                                            <option>100k</option>
                                            <option>110k</option>
                                            <option>120k</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Schedule -->
                            <fieldset class="min-w-0">
                                <legend class="mb-6 flex items-center gap-3">
                                    <span class="text-xl font-bold">
                                        Preferred service schedule
                                    </span>
                                </legend>

                                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                                    <div>
                                        <label for="inquiry_appointment_date"
                                            class="mb-2 block text-sm font-medium text-zinc-700">
                                            Preferred date
                                        </label>

                                        <input id="inquiry_appointment_date" name="inquiry_appointment_date" type="date"
                                            aria-describedby="service-schedule-note"
                                            class="block min-h-12 w-full min-w-0 rounded-lg border border-zinc-300 bg-white px-3 py-3 text-sm text-zinc-900 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15" />
                                    </div>

                                    <div>
                                        <label for="inquiry_appointment_time"
                                            class="mb-2 block text-sm font-medium text-zinc-700">
                                            Preferred time
                                        </label>

                                        <select id="inquiry_appointment_time" name="inquiry_appointment_time"
                                            class="block min-h-12 w-full rounded-lg border border-zinc-300 bg-white px-3 py-3 text-sm text-zinc-900 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15">
                                            <option value="">Select time</option>
                                            <option>8:00am</option>
                                            <option>8:30am</option>
                                            <option>9:00am</option>
                                            <option>9:30am</option>
                                            <option>10:00am</option>
                                            <option>10:30am</option>
                                            <option>11:00am</option>
                                            <option>11:30am</option>
                                            <option>12:00am</option>
                                            <option>12:30am</option>
                                            <option>1:00am</option>
                                            <option>1:30am</option>
                                            <option>2:00am</option>
                                            <option>2:30am</option>
                                            <option>3:00am</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-5 flex items-start gap-3 rounded-lg bg-red-50 p-4">
                                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-600" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                        <circle cx="12" cy="12" r="9" />
                                        <path d="M12 8v4l3 2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <p id="service-schedule-note" class="text-sm leading-6 text-red-900">
                                        Please request your Toyota service appointment at least
                                        <strong class="font-semibold">two (2) days</strong>
                                        before your preferred date.
                                    </p>
                                </div>
                            </fieldset>
                        </div>

                        <!-- Personal details -->
                        <div class="border-t border-zinc-200 bg-zinc-50 p-5 sm:p-8 lg:border-l lg:border-t-0 lg:p-10">
                            <fieldset class="min-w-0">
                                <legend class="mb-6 flex items-center gap-3">
                                    <span class="text-lg font-bold">
                                        Contact Details
                                    </span>
                                </legend>

                                <div class="space-y-5">
                                    <div>
                                        <label for="name" class="mb-2 block text-sm font-medium text-zinc-700">
                                            Full name <span class="text-red-600">*</span>
                                        </label>

                                        <input id="name" name="name" type="text" autocomplete="name" required
                                            placeholder="Enter your full name"
                                            class="block min-h-12 w-full rounded-lg border border-zinc-300 bg-white px-3 py-3 text-sm text-zinc-900 placeholder:text-zinc-400 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15" />
                                    </div>

                                    <div>
                                        <label for="email" class="mb-2 block text-sm font-medium text-zinc-700">
                                            Email address <span class="text-red-600">*</span>
                                        </label>

                                        <input id="email" name="email" type="email" autocomplete="email" required
                                            placeholder="you@example.com"
                                            class="block min-h-12 w-full rounded-lg border border-zinc-300 bg-white px-3 py-3 text-sm text-zinc-900 placeholder:text-zinc-400 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15" />
                                    </div>

                                    <div>
                                        <label for="contact" class="mb-2 block text-sm font-medium text-zinc-700">
                                            Contact number <span class="text-red-600">*</span>
                                        </label>

                                        <input id="contact" name="contact" type="tel" autocomplete="tel" required
                                            placeholder="Enter your mobile number"
                                            class="block min-h-12 w-full rounded-lg border border-zinc-300 bg-white px-3 py-3 text-sm text-zinc-900 placeholder:text-zinc-400 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15" />
                                    </div>

                                    <div>
                                        <label for="message"
                                            class="mb-2 flex items-center justify-between gap-3 text-sm font-medium text-zinc-700">
                                            Notes
                                            <span class="text-xs font-normal text-zinc-500">
                                                Optional
                                            </span>
                                        </label>

                                        <textarea id="message" name="message" rows="5"
                                            placeholder="Tell us more about your concern or requested service."
                                            class="block w-full resize-y rounded-lg border border-zinc-300 bg-white px-3 py-3 text-sm leading-6 text-zinc-900 placeholder:text-zinc-400 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div
                        class="flex flex-col gap-4 border-t border-zinc-200 bg-white p-5 sm:flex-row sm:items-center sm:justify-between sm:px-8 sm:py-6 lg:px-10">
                        <p class="text-sm text-zinc-500">
                            Fields marked <span class="font-semibold text-red-600">*</span>
                            are required.
                        </p>

                        <button type="submit" class="group inline-flex w-full items-center justify-center gap-3
                           rounded-lg bg-red-600 px-6 py-4 text-sm font-semibold text-white
                           transition-colors hover:bg-red-700
                           focus-visible:outline focus-visible:outline-2
                           focus-visible:outline-offset-4 focus-visible:outline-red-600
                           sm:w-auto">
                            Request a Toyota Service Schedule

                            <svg class="h-5 w-5 shrink-0 motion-safe:transition-transform motion-safe:group-hover:translate-x-1"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>

<?= $this->endSection() ?>