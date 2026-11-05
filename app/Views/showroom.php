<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>

<body class="flex flex-col min-h-screen">

    <section class="relative bg-black text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <h1 class="text-4xl md:text-5xl font-bold mt-4 mb-4">Showroom</h1>
        </div>
    </section>

    <!-- New Vehicles Section (sidebar + grid layout) -->
    <section class="bg-zinc-100 px-4 py-12 sm:px-6 lg:px-8 lg:py-16" aria-labelledby="new-vehicles-heading">
        <?php
        $escape = static function ($value) {
            return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
        };
        ?>

        <div class="mx-auto max-w-7xl">

            <!-- Section heading -->
            <div class="mb-8 flex items-center gap-4">
            </div>

            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:gap-8">

                <!-- Category sidebar -->
                <aside class="w-full shrink-0 lg:sticky lg:top-28 lg:w-56 xl:w-64">
                    <div class="overflow-hidden rounded-none border border-zinc-200 bg-white">
                        <div class="border-b border-zinc-100 px-5 py-5">
                            <p class="text-xs font-semibold uppercase tracking-widest text-zinc-500">
                                Browse by category
                            </p>
                        </div>

                        <nav class="space-y-2 p-3" aria-label="Vehicle categories" aria-orientation="vertical"
                            role="tablist">
                            <?php $haveDefaultActive = false; ?>

                            <?php foreach ($vehicles_category as $row): ?>
                                <?php $isActive = !$haveDefaultActive; ?>

                                <button type="button" id="vertical-tab-item-<?= $escape($row->cat_no) ?>"
                                    data-hs-tab="#vertical-tab-<?= $escape($row->cat_no) ?>"
                                    aria-controls="vertical-tab-<?= $escape($row->cat_no) ?>"
                                    aria-selected="<?= $isActive ? 'true' : 'false' ?>" role="tab" class="flex w-full items-center justify-between gap-3
                                       rounded-none px-4 py-3.5 text-left text-sm font-semibold
                                       text-zinc-600 transition-colors
                                       hover:bg-zinc-100 hover:text-zinc-950
                                       hs-tab-active:bg-red-600 hs-tab-active:text-white
                                       focus-visible:outline focus-visible:outline-2
                                       focus-visible:outline-offset-2 focus-visible:outline-red-600
                                       <?= $isActive ? 'active' : '' ?>">
                                    <span><?= $escape($row->cat_title) ?></span>

                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8" aria-hidden="true">
                                        <path d="m9 5 7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <?php $haveDefaultActive = true; ?>
                            <?php endforeach; ?>
                        </nav>
                    </div>
                </aside>

                <!-- Vehicle panels -->
                <div class="min-w-0 flex-1 rounded-none border border-zinc-200 bg-white p-4 sm:p-6 lg:p-8">

                    <?php $haveDefaultPanel = false; ?>

                    <?php foreach ($vehicles_category as $row): ?>
                        <?php $isActivePanel = !$haveDefaultPanel; ?>

                        <div id="vertical-tab-<?= $escape($row->cat_no) ?>" role="tabpanel"
                            aria-labelledby="vertical-tab-item-<?= $escape($row->cat_no) ?>"
                            class="<?= $isActivePanel ? '' : 'hidden' ?>">

                            <!-- Category heading -->
                            <div class="mb-6 border-b border-zinc-100 pb-5">
                                <h3 class="text-2xl font-bold tracking-tight text-zinc-900">
                                    <?= $escape($row->cat_title) ?>
                                </h3>
                            </div>

                            <!-- Scrollable vehicle grid -->
                            <div class="lg:max-h-[600px] lg:overflow-y-auto lg:pr-3">
                                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">

                                    <?php foreach ($vehicles as $vehicle): ?>
                                        <?php if ($vehicle->cat_no == $row->cat_no): ?>

                                            <article class="group min-w-0">
                                                <a href="/<?= $escape(url_title($vehicle->vehicle_title, '-', true)) ?>" class="flex h-full flex-col overflow-hidden rounded-none
                                                       border border-zinc-200 bg-white
                                                       transition-colors hover:border-red-300
                                                       focus-visible:outline focus-visible:outline-2
                                                       focus-visible:outline-offset-4 focus-visible:outline-red-600">
                                                    <!-- Vehicle image -->
                                                    <div class="aspect-[4/3] overflow-hidden bg-zinc-50 p-4">
                                                        <img src="/img/variants/<?= $escape($vehicle->variant_filename) ?>"
                                                            alt="<?= $escape($vehicle->vehicle_title) ?>" loading="lazy" class="h-full w-full object-contain object-center
                                                               motion-safe:transition-transform
                                                               motion-safe:duration-500
                                                               motion-safe:group-hover:scale-105" />
                                                    </div>

                                                    <!-- Vehicle information -->
                                                    <div class="flex flex-1 flex-col p-5">
                                                        <h4 class="text-lg font-bold leading-snug text-zinc-900">
                                                            <?= $escape($vehicle->vehicle_title) ?>
                                                        </h4>

                                                        <div class="mt-auto pt-5">
                                                            <div
                                                                class="flex items-center justify-between border-t border-zinc-100 pt-4">
                                                                <span
                                                                    class="text-xs font-bold uppercase tracking-widest text-red-600">
                                                                    Explore
                                                                </span>

                                                                <span class="flex h-8 w-8 items-center justify-center
                                                                       rounded-full bg-red-50 text-red-600
                                                                       transition-colors
                                                                       group-hover:bg-red-600 group-hover:text-white"
                                                                    aria-hidden="true">
                                                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="1.8">
                                                                        <path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </article>

                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>

                        <?php $haveDefaultPanel = true; ?>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </section>
    <?= $this->endSection() ?>