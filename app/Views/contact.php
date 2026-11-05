<?= $this->extend("layout/default"); ?>

<?= $this->section("mainContent"); ?>

<!-- Contact Us Section -->
<section class="relative bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <h1 class="text-4xl md:text-5xl font-bold mt-4 mb-4">Contact Us</h1>
    </div>
</section>


<section class="bg-zinc-100 px-4 py-16 sm:px-6 md:py-24 lg:px-8" aria-labelledby="contact-heading">
    <div class="mx-auto max-w-6xl">

        <!-- Heading -->
        <header class="mb-10 md:mb-12">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-red-600">
                Contact us
            </span>

            <h2 id="contact-heading"
                class="mt-3 text-3xl font-bold tracking-tight text-zinc-900 sm:text-4xl md:text-5xl">
                We'd love to hear from you!
            </h2>
        </header>

        <div
            class="grid overflow-hidden rounded-none  border border-zinc-200 bg-white shadow-sm lg:grid-cols-[5fr_6fr]">

            <!-- Contact information -->
            <aside class="bg-zinc-900 p-6 text-white sm:p-8 lg:p-10" aria-labelledby="contact-info-heading">
                <div class="mb-8 border-b border-white/15 pb-6">
                    <h3 id="contact-info-heading" class="text-2xl font-semibold">
                        Visit or call
                    </h3>
                </div>

                <address class="space-y-8 not-italic">

                    <!-- Address -->
                    <div class="flex gap-4">
                        <span
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 text-red-400"
                            aria-hidden="true">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <circle cx="12" cy="11" r="3" />
                            </svg>
                        </span>

                        <div class="min-w-0">
                            <h4 class="text-sm font-semibold text-white">
                                Our location
                            </h4>

                            <p class="mt-2 text-sm leading-7 text-zinc-300">
                                Baguio City
                            </p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex gap-4">
                        <span
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 text-red-400"
                            aria-hidden="true">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </span>

                        <div class="min-w-0 flex-1">
                            <h4 class="text-sm font-semibold text-white">
                                Call our team
                            </h4>

                            <div class="mt-3 flex flex-wrap gap-x-3 gap-y-2 text-sm text-zinc-300">
                                <a href="tel:09956310512"
                                    class="rounded-sm underline-offset-4 hover:text-white hover:underline focus-visible:outline focus-visible:outline-2 focus-visible:outline-red-400">
                                    0995-631-0512
                                </a>

                                <span class="text-zinc-500" aria-hidden="true">/</span>

                                <a href="tel:09209662715"
                                    class="rounded-sm underline-offset-4 hover:text-white hover:underline focus-visible:outline focus-visible:outline-2 focus-visible:outline-red-400">
                                    0920-966-2715
                                </a>
                            </div>

                            <dl class="mt-5 space-y-4 border-t border-white/10 pt-5">
                                <div>
                                    <dt class="text-xs text-zinc-400">
                                        Vehicle Sales Department
                                    </dt>
                                    <dd class="mt-1">
                                        <a href="tel:0776440112"
                                            class="text-sm text-zinc-200 underline-offset-4 hover:text-white hover:underline">
                                            077-644-0112
                                        </a>
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-xs text-zinc-400">
                                        Customer Relations Department
                                    </dt>
                                    <dd class="mt-1">
                                        <a href="tel:0776440154"
                                            class="text-sm text-zinc-200 underline-offset-4 hover:text-white hover:underline">
                                            077-644-0154
                                        </a>
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-xs text-zinc-400">
                                        Service Department
                                    </dt>
                                    <dd class="mt-1">
                                        <a href="tel:0776440251"
                                            class="text-sm text-zinc-200 underline-offset-4 hover:text-white hover:underline">
                                            077-644-0251
                                        </a>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex gap-4">
                        <span
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 text-red-400"
                            aria-hidden="true">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 6 9-6" />
                            </svg>
                        </span>

                        <div class="min-w-0">
                            <h4 class="text-sm font-semibold text-white">
                                Email us
                            </h4>

                            <a href="mailto:customercare@toyotailocossur.com"
                                class="mt-2 block break-words text-sm leading-6 text-zinc-300 underline-offset-4 hover:text-white hover:underline">
                                customercare@toyotailocossur.com
                            </a>
                        </div>
                    </div>
                </address>

                <!-- Office hours -->
                <div class="mt-8 flex items-start gap-4 rounded-xl border border-white/10 bg-white/5 p-4">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-400" fill="none" stroke="currentColor"
                        stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="12" cy="12" r="9" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2" />
                    </svg>

                    <div>
                        <h4 class="text-sm font-semibold">Office hours</h4>
                        <p class="mt-2 text-sm leading-6 text-zinc-300">
                            Monday – Saturday<br />
                            8:00 AM – 5:00 PM
                        </p>
                    </div>
                </div>
            </aside>

            <!-- Contact form -->
            <div x-data="contact" class="min-w-0 p-6 sm:p-8 lg:p-10">
                <div class="mb-8">
                    <h3 class="text-2xl font-bold tracking-tight text-zinc-900">
                        Send a message
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-zinc-500">
                        Fields marked <span class="text-red-600">*</span> are required.
                    </p>
                </div>

                <form @submit.prevent="onSubmitContact($event)" action="#" method="post" class="space-y-6">
                    <?= csrf_field('csrf_field') ?>

                    <div>
                        <label for="contact-name" class="mb-2 block text-sm font-medium text-zinc-700">
                            Name <span class="text-red-600">*</span>
                        </label>

                        <input type="text" id="contact-name" name="name" autocomplete="name" required
                            placeholder="Your name"
                            class="block w-full rounded-lg border border-zinc-300 bg-white px-4 py-3 text-sm text-zinc-900 placeholder:text-zinc-400 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15" />
                    </div>

                    <div>
                        <label for="contact-email" class="mb-2 block text-sm font-medium text-zinc-700">
                            Email <span class="text-red-600">*</span>
                        </label>

                        <input type="email" id="contact-email" name="email" autocomplete="email" required
                            placeholder="you@example.com"
                            class="block w-full rounded-lg border border-zinc-300 bg-white px-4 py-3 text-sm text-zinc-900 placeholder:text-zinc-400 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15" />
                    </div>

                    <div>
                        <label for="contact-phone"
                            class="mb-2 flex items-center justify-between gap-3 text-sm font-medium text-zinc-700">
                            Phone
                        </label>

                        <input type="tel" id="contact-phone" name="phone" autocomplete="tel"
                            placeholder="+63 123 456 7890"
                            class="block w-full rounded-lg border border-zinc-300 bg-white px-4 py-3 text-sm text-zinc-900 placeholder:text-zinc-400 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15" />
                    </div>

                    <div>
                        <label for="contact-message" class="mb-2 block text-sm font-medium text-zinc-700">
                            Message <span class="text-red-600">*</span>
                        </label>

                        <textarea id="contact-message" name="message" rows="6" required placeholder="How can we help?"
                            class="block w-full resize-y rounded-lg border border-zinc-300 bg-white px-4 py-3 text-sm leading-6 text-zinc-900 placeholder:text-zinc-400 transition focus:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600/15"></textarea>
                    </div>

                    <div class="border-t border-zinc-100 pt-6">
                        <button type="submit"
                            class="group inline-flex w-full items-center justify-center gap-3 rounded-none bg-red-600 px-6 py-4 text-sm font-semibold text-white transition-colors hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-red-600">
                            Send message

                            <svg class="h-5 w-5 motion-safe:transition-transform motion-safe:group-hover:translate-x-1"
                                fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>