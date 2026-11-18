<?= $this->extend("admin/layout/admin_control_panel"); ?>

<?= $this->section("page") ?>

<div class="w-full max-w-3xl px-2 flex flex-col gap-6">
    <nav class="mb-5" aria-label="Breadcrumb">
        <ol class="flex items-center gap-1.5 text-sm text-gray-500">
            <li><a href="/admin" class="hover:text-gray-800 transition-colors">Dashboard</a></li>
            <li>
                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </li>
            <li class="font-medium text-gray-800">Banners</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Banners</h1>
            <p class="text-sm text-gray-500 mt-1">Manage the banner images shown on your website.</p>
        </div>
        <a
            href="/admin/banners/new"
            class="shrink-0 py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 text-white hover:bg-primary-800 transition-colors duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            Add Banner
        </a>
    </div>

    <!-- Flash: success -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-50 border border-green-200 text-sm text-green-800 rounded-lg p-4" role="alert">
            <div class="flex gap-x-3">
                <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
                <p class="font-medium"><?= esc(session()->getFlashdata('success')) ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Flash: error -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert">
            <div class="flex gap-x-3">
                <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="m15 9-6 6" />
                    <path d="m9 9 6 6" />
                </svg>
                <p class="font-medium"><?= esc(session()->getFlashdata('error')) ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- ── Banner List Card ────────────────────────────────────────── -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xs font-semibold uppercase text-gray-400 tracking-wider">Uploaded Banners</h2>
            <?php if (!empty($banners)): ?>
                <span class="py-1 px-2.5 inline-flex items-center text-xs font-medium bg-gray-100 text-gray-600 rounded-full">
                    <?= count($banners) ?> banner<?= count($banners) !== 1 ? 's' : '' ?>
                </span>
            <?php endif; ?>
        </div>

        <?php if (!empty($banners)): ?>

            <div class="rounded-lg border border-gray-100 overflow-hidden divide-y divide-gray-100">
                <?php foreach ($banners as $banner): ?>
                    <div class="flex items-center gap-4 px-4 py-3 bg-white hover:bg-gray-50 transition-colors duration-100">

                        <!-- Thumbnail -->
                        <div class="shrink-0 w-28 h-16 rounded-lg overflow-hidden border border-gray-200 bg-gray-100">
                            <img
                                src="<?= site_url('uploads/img/banners/' . esc($banner->banner_photo)) ?>"
                                alt="<?= esc($banner->banner_title) ?>"
                                class="w-full h-full object-cover object-center <?= $banner->banner_inactive ? 'opacity-50 grayscale' : '' ?>">
                        </div>

                        <!-- Details -->
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate"><?= esc($banner->banner_title) ?></p>
                            <?php if (!empty($banner->banner_heading)): ?>
                                <p class="text-xs text-gray-600 truncate mt-0.5"><?= esc($banner->banner_heading) ?></p>
                            <?php endif; ?>
                            <?php if (!empty($banner->banner_subheading)): ?>
                                <p class="text-xs text-gray-400 truncate"><?= esc($banner->banner_subheading) ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Status -->
                        <?php if ($banner->banner_inactive): ?>
                            <span class="shrink-0 inline-flex items-center gap-1.5 py-1 px-2.5 text-xs font-medium bg-gray-100 text-gray-500 rounded-full">
                                <span class="size-1.5 rounded-full bg-gray-400"></span>Inactive
                            </span>
                        <?php else: ?>
                            <span class="shrink-0 inline-flex items-center gap-1.5 py-1 px-2.5 text-xs font-medium bg-green-50 text-green-700 rounded-full">
                                <span class="size-1.5 rounded-full bg-green-500"></span>Active
                            </span>
                        <?php endif; ?>

                        <!-- Delete -->
                        <form
                            action="/admin/banners/<?= $banner->banner_no ?>"
                            method="post"
                            onsubmit="return confirm('Delete this banner? This cannot be undone.')">
                            <input type="hidden" name="_method" value="DELETE">
                            <?= csrf_field() ?>
                            <button
                                type="submit"
                                class="p-1.5 inline-flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors duration-150"
                                title="Delete banner">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </form>

                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-3 flex items-center justify-end">
                <p class="text-xs text-gray-400">
                    Showing <span class="font-medium text-gray-600"><?= count($banners) ?></span>
                    banner<?= count($banners) !== 1 ? 's' : '' ?>
                </p>
            </div>

        <?php else: ?>

            <div class="flex flex-col items-center justify-center gap-3 rounded-xl border border-dashed border-gray-200 bg-gray-50 px-6 py-14 text-center">
                <div class="w-12 h-12 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center">
                    <i class="fa-regular fa-images text-xl text-gray-400"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">No banners yet</p>
                    <p class="text-xs text-gray-400 mt-0.5">Add your first banner to see it listed here.</p>
                </div>
                <a href="/admin/banners/new" class="text-xs font-medium text-primary-700 hover:underline">Add banner</a>
            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>