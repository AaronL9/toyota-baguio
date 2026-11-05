<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>

<!-- Carousel -->
<section id="home" data-hs-carousel='{
    "loadingClasses": "opacity-0",
    "isInfiniteLoop": true
  }' class="relativeS">
    <div class="hs-carousel relative overflow-hidden w-full h-75 sm:h-100 md:h-125 lg:h-150 shadow-lg">

        <div class="text-red-900"> Test</div>
        <div
            class="hs-carousel-body absolute bottom-0 start-0 top-0 flex flex-nowrap opacity-0 transition-transform duration-700">


            <!-- Slide 1 -->
            <div class="hs-carousel-slide">
                <div class="relative h-full">
                    <img src="/img/carousel2-ExbEmYc-.jpg" alt="Mountain landscape"
                        class="h-full w-full object-cover" />
                    <div class="absolute inset-0 flex items-center justify-center px-16 text-center text-white">
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 bg-black/30"></div>

            <!-- Slide 2 -->
            <div class="hs-carousel-slide">
                <div class="relative h-full">
                    <img src="/images/slide-2.jpg" alt="Beach at sunset" class="h-full w-full object-cover" />

                    <div class="absolute inset-0 bg-black/40"></div>

                    <div class="absolute inset-0 flex items-center justify-center px-16 text-center text-white">
                        <div>
                            <h2 class="text-4xl font-bold md:text-6xl">
                                Discover beautiful places
                            </h2>
                            <p class="mt-4 text-lg">Make every journey memorable.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Previous -->
    <button type="button"
        class="hs-carousel-prev absolute inset-y-0 start-0 flex items-center justify-center w-12 text-white hover:bg-black/30 transition">
        <svg class="size-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="m15 18-6-6 6-6" />
        </svg>
    </button>

    <!-- Next -->
    <button type="button"
        class="hs-carousel-next absolute inset-y-0 end-0 flex items-center justify-center w-12 text-white hover:bg-black/30 transition">
        <svg class="size-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="m9 18 6-6-6-6" />
        </svg>
    </button>
</section>

<!-- Vehicle Cards Section -->
<section class="bg-gray-100 py-16 md:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <!-- Section Heading -->
        <div class="mb-10 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
            <div class="max-w-2xl">
                <div class="mb-4 flex items-center gap-3">
                    <!-- <span class="h-0.5 w-10 bg-red-600"></span>
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-red-600">
                        Our Collection
                    </span> -->
                </div>

                <h2 class="text-3xl font-bold tracking-tight text-gray-950 sm:text-4xl md:text-5xl">
                    Featured Vehicles
                </h2>

                <p class="mt-4 text-base leading-relaxed text-gray-600">
                    Discover our premium selection of Toyota vehicles.
                </p>
            </div>
        </div>

        <!-- Vehicle Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($vehicles as $row): ?>
                <article
                    class="group flex h-full flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white transition duration-300 hover:border-gray-300 hover:shadow-xl">

                    <!-- Vehicle Image -->
                    <div class="relative overflow-hidden bg-gray-50 px-4 pt-8 pb-6">
                        <!-- Decorative background -->
                        <div aria-hidden="true"
                            class="absolute inset-x-8 bottom-8 h-20 rounded-full bg-gray-200 opacity-50 blur-2xl">
                        </div>

                        <img src="/img/variants/<?= $row->variant_filename ?>"
                            alt="<?= htmlspecialchars($row->vehicle_title, ENT_QUOTES, 'UTF-8') ?>" loading="lazy"
                            class="relative h-48 w-full object-contain transition-transform duration-500 motion-safe:group-hover:scale-105" />
                    </div>

                    <!-- Vehicle Details -->
                    <div class="flex flex-1 flex-col p-6">

                        <div class="mb-5">
                            <div aria-hidden="true"
                                class="mb-4 h-1 w-8 rounded-fultransition-all duration-300 group-hover:w-14">
                            </div>

                            <h3 class="text-2xl font-bold tracking-tight text-gray-950">
                                <?= $row->vehicle_title ?>
                            </h3>
                        </div>

                        <!-- Pricing / Tagline -->
                        <div class="mb-6">
                            <?php if ($row->variant_isshowprice): ?>
                                <p class="mb-1 text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Starting at
                                </p>

                                <p class="text-xl font-bold tracking-tight text-gray-950">
                                    <span class="text-sm font-medium text-gray-500">PHP</span>
                                    <?= number_format($row->variant_price, 2) ?><sup class="ml-0.5 text-xs">*</sup>
                                </p>

                                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                                    <span class="font-semibold text-gray-700">
                                        PHP <?= number_format($row->variant_price_month, 2) ?><sup>*</sup>
                                    </span>
                                    / month
                                </p>
                            <?php else: ?>
                                <p class="text-sm leading-relaxed text-gray-600">
                                    <?= $row->vehicle_tagline ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <!-- Specs Button -->
                        <div class="mt-auto border-t border-gray-100 pt-5">
                            <a href="/<?= url_title($row->vehicle_title, '-', true) ?>"
                                aria-label="View full specifications for <?= htmlspecialchars($row->vehicle_title, ENT_QUOTES, 'UTF-8') ?>"
                                class="flex min-h-12 items-center justify-between gap-3 rounded-lg bg-gray-950 px-4 py-3 text-sm font-semibold text-white transition-colors duration-300 hover:bg-red-600 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-red-600">

                                <span>Full Specs</span>

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- Showroom Link -->
        <div class="mt-10 flex flex-col items-center justify-between gap-5 border-t border-gray-300 pt-8 sm:flex-row">
            <p class="text-center text-sm text-gray-600 sm:text-left">
                Your next journey starts with the right vehicle.
            </p>

            <a href="/showroom"
                class="group inline-flex min-h-12 items-center justify-center gap-4 rounded-none bg-red-600 px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-red-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-red-600">

                <span>View All Vehicles</span>

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                </svg>
            </a>
        </div>

    </div>
</section>


<!-- HERO SECTION -->
<section class="relative lg:grid lg:h-screen lg:place-content-center">
    <div class="absolute inset-0 -z-10">
        <img src="/img/banner2-DKS0BEOM.jpg" class="h-full w-full object-cover" alt="" />
        <div class="absolute inset-0 bg-black/60"></div>
    </div>
    <div
        class="mx-auto w-screen max-w-7xl px-4 py-16 sm:px-6 sm:py-24 md:grid md:grid-cols-2 md:items-center md:gap-4 lg:px-8 lg:py-32">
        <div class="max-w-prose text-left text-white">
            <h1 class="text-4xl font-bold sm:text-5xl">
                Driven by
                <strong class="text-red-500"> Innovation. </strong>
                Powered by Results
            </h1>

            <p class="mt-4 text-base sm:text-lg/relaxed text-white/90">
                Welcome to Toyota Ilocos-Sur
            </p>
        </div>
    </div>
</section>

<!-- HERO / EDITORIAL SECTION -->
<section aria-labelledby="hero-title" class="bg-white pt-24 text-zinc-900">
    <!-- Row 1: Text Left / Image Right -->
    <div class="grid items-stretch lg:grid-cols-2">

        <!-- Text -->
        <div class="flex items-center px-6 py-14 sm:px-12 lg:px-16 xl:px-24">
            <div class="mx-auto w-full max-w-lg">
                <h1 id="hero-title"
                    class="text-3xl font-semibold uppercase leading-tight tracking-[0.06em] sm:text-4xl xl:text-5xl">
                    Driven by
                    <span class="mt-2 block text-red-600 mb-10">
                        Innovation.
                    </span>
                </h1>

                <p class="text-base leading-8 text-zinc-600 sm:text-lg">
                    Welcome to Toyota Baguio City
                </p>
            </div>
        </div>

        <!-- Image -->
        <div class="relative min-h-72 overflow-hidden sm:min-h-96 lg:min-h-[520px]">
            <img src="/img/banner2-DKS0BEOM.jpg" alt="" fetchpriority="high"
                class="absolute inset-0 h-full w-full object-cover object-center">
        </div>
    </div>

    <!-- Space Between Editorial Rows -->
    <div aria-hidden="true" class="h-8 sm:h-12 lg:h-20"></div>

    <!-- Row 2: Image Left / Text Right -->
    <div class="grid items-stretch lg:grid-cols-2">

        <!-- Text: Appears First on Mobile -->
        <div class="flex items-center px-6 py-14 sm:px-12
                   lg:col-start-2 lg:row-start-1 lg:px-16 xl:px-24">
            <div class="mx-auto w-full max-w-lg">
                <h2 class="text-3xl font-semibold uppercase leading-tight tracking-[0.06em] sm:text-4xl xl:text-5xl">
                    Powered by
                    <span class="mt-2 block">
                        Results.
                    </span>
                </h2>

                <div aria-hidden="true" class="my-7 h-px w-12 bg-red-600"></div>

                <p class="text-base leading-8 text-zinc-600 sm:text-lg">
                    Discover a new perspective on every drive.
                    Your next chapter begins with Toyota Ilocos-Sur.
                </p>
            </div>
        </div>

        <!-- Image: Replace with a Second Photo if Available -->
        <div class="relative min-h-72 overflow-hidden sm:min-h-96
                   lg:col-start-1 lg:row-start-1 lg:min-h-[520px]">
            <img src="/img/banner2-DKS0BEOM.jpg" alt="" loading="lazy"
                class="absolute inset-0 h-full w-full object-cover object-right">
        </div>
    </div>

    <div aria-hidden="true" class="h-8 sm:h-12 lg:h-20"></div>
</section>

<!-- SERVICE SECTION -->
<section id="services" class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Right -->
            <div class="relative">
                <div class="rounded-none overflow-hidden shadow-2xl">
                    <img src="/img/maintenance-GiBGTARx.jpg" alt="Toyota Service Center"
                        class="w-full h-auto object-cover" />
                </div>
            </div>
            <!-- Left -->
            <div>
                <h2 class="text-4xl md:text-5xl font-bold mt-4 mb-6 text-gray-900">
                    Schedule Toyota Service
                </h2>

                <p class="text-gray-600 text-lg mb-6">
                    Keep your Toyota running at peak performance with our expert
                    maintenance services. Schedule your appointment online and
                    experience professional care from certified technicians.
                </p>

                <!-- <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-600 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span class="text-gray-700">Certified Toyota Technicians</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-600 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span class="text-gray-700">Genuine Toyota Parts</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-600 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span class="text-gray-700">Quick &amp; Convenient Scheduling</span>
                    </li>
                </ul> -->

                <a href="/schedule"
                    class="group inline-flex min-h-12 items-center justify-center gap-4 rounded-none bg-red-600 px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-red-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-red-600">

                    <span>Schedule Maintenance</span>

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                </a>
            </div>


        </div>
    </div>
</section>


<!-- Team Section -->
<section id="team" class="bg-white text-black py-16 px-6 scroll-p-24 md:px-16 lg:px-24 xl:px-32">
    <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

        <div class="flex flex-col items-center lg:items-start gap-6">
            <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">
                Meet our team
            </span>
            <h2 class="text-center lg:text-left text-4xl md:text-5xl/16 max-w-lg leading-tight text-black">
                The team driving the brand forward.
            </h2>
            <p class="text-center lg:text-left text-sm text-black max-w-md">
                Our marketing specialists, strategists, and storytellers connect
                drivers with the innovation and reliability of Toyota Motor
                Corporation through campaigns that inspire trust and loyalty.
            </p>
            <a href="/agents"
                class="group relative inline-flex h-12 items-center justify-center overflow-hidden rounded-md border border-red-600 bg-red-600 px-6 font-medium text-white transition-all duration-100 [box-shadow:5px_5px_rgb(153_27_27)] active:translate-x-0.75 active:translate-y-0.75 active:[box-shadow:0px_0px_rgb(153_27_27)]">
                See more
            </a>
        </div>


        <!-- Left Content - Image Gallery -->
        <div class="grid grid-cols-2 gap-6 max-w-2xl mx-auto lg:mx-0">
            <?php for ($i = 0; $i < count($agents); $i++): ?>
                <?php if (($i + 1) % 2 != 0): ?>
                    <div class="group relative overflow-hidden rounded-2xl shadow-xl cursor-pointer">
                        <img class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                            src="/img/agents/<?= $agents[$i]->agent_photo ?>" alt="Team Member 1" />
                        <div
                            class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/90 via-black/60 to-transparent p-4">
                            <h3 class="text-white font-semibold text-lg mb-1">
                                <?php echo "{$agents[$i]->agent_fname} {$agents[$i]->agent_lname}" ?>
                            </h3>
                            <!-- <p class="text-gray-300 text-xs mb-2">Marketing Professional</p> -->
                            <div class="space-y-1 text-xs text-gray-300">
                                <p><?= $agents[$i]->agent_email ?></p>
                                <p><?= $agents[$i]->agent_contact ?></p>
                                <div class="flex gap-3 items-center">
                                    <a href="#" rel="noreferrer" target="_blank"
                                        class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                        <span class="sr-only">Facebook</span>

                                        <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#" rel="noreferrer" target="_blank"
                                        class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                        <span class="sr-only">Instagram</span>

                                        <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#" rel="noreferrer" target="_blank"
                                        class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                        <span class="sr-only">Twitter</span>

                                        <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path
                                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="group relative overflow-hidden rounded-2xl shadow-xl cursor-pointer mt-12">
                        <img class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-105"
                            src="/img/agents/<?= $agents[$i]->agent_photo ?>" alt="Team Member 2" />
                        <div
                            class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/90 via-black/60 to-transparent p-4">
                            <h3 class="text-white font-semibold text-lg mb-1">
                                <?php echo "{$agents[$i]->agent_fname} {$agents[$i]->agent_lname}" ?>
                            </h3>
                            <p class="text-gray-300 text-xs mb-2">Marketing Professional</p>
                            <div class="space-y-1 text-xs text-gray-300">
                                <p><?= $agents[$i]->agent_email ?></p>
                                <p><?= $agents[$i]->agent_contact ?></p>
                                <div class="flex gap-3 items-center">
                                    <a href="#" rel="noreferrer" target="_blank"
                                        class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                        <span class="sr-only">Facebook</span>

                                        <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#" rel="noreferrer" target="_blank"
                                        class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                        <span class="sr-only">Instagram</span>

                                        <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#" rel="noreferrer" target="_blank"
                                        class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                        <span class="sr-only">Twitter</span>

                                        <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path
                                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>

        <!-- Right Content - Text and Button -->

    </div>
</section>

<?= $this->endSection() ?>