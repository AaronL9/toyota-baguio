<?= $this->extend("admin/layout/admin_control_panel"); ?>

<?= $this->section("page"); ?>

<div class="max-w-5xl mx-auto">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Website Content</h1>
        <p class="mt-1 text-sm text-gray-500">Review what each section of the website currently shows.</p>
    </div>

    <!-- Success message -->
    <div class="mb-6 flex items-start gap-3 p-4 text-sm text-emerald-800 bg-emerald-50 border border-emerald-200 rounded-xl" role="status">
        <i class="fa-solid fa-circle-check mt-0.5"></i>
        <p>Section updated successfully.</p>
    </div>

    <div class="space-y-4">

        <!-- Section card: Hero -->
        <div class="bg-white border border-gray-200 rounded-xl">
            <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-4 border-b border-gray-200">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="inline-flex items-center justify-center size-8 rounded-lg bg-gray-100 text-xs font-semibold text-gray-700">1</span>
                    <div>
                        <h2 class="text-sm font-semibold text-gray-900">Hero Section</h2>
                        <p class="text-xs text-gray-500">Updated Nov 19, 2026 10:30 AM</p>
                    </div>
                    <span class="inline-flex items-center py-0.5 px-2 rounded-md text-xs font-medium bg-gray-100 text-gray-700">hero</span>
                    <span class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                        <span class="size-1.5 rounded-full bg-emerald-500"></span>Visible
                    </span>
                </div>
                <a href="/admin/cms/edit/1" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-[#CC0000] text-white hover:bg-[#A30000] focus:outline-hidden focus:bg-[#A30000] transition-colors">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit content
                </a>
            </div>
            <div class="p-5 grid gap-5 sm:grid-cols-2">
                <div>
                    <p class="mb-1 text-xs font-medium text-gray-500">Title</p>
                    <p class="text-sm text-gray-800">Welcome to Our Website</p>
                </div>
                <div>
                    <p class="mb-1 text-xs font-medium text-gray-500">Subtitle</p>
                    <p class="text-sm text-gray-800">Discover our services</p>
                </div>
                <div>
                    <p class="mb-1 text-xs font-medium text-gray-500">Background image</p>
                    <p class="text-sm text-gray-400">Not set</p>
                </div>
                <div>
                    <p class="mb-1 text-xs font-medium text-gray-500">Button</p>
                    <p class="text-sm text-gray-800">Learn More <span class="text-gray-400">&rarr;</span> /about</p>
                </div>
            </div>
        </div>

        <!-- Section card: About -->
        <div class="bg-white border border-gray-200 rounded-xl">
            <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-4 border-b border-gray-200">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="inline-flex items-center justify-center size-8 rounded-lg bg-gray-100 text-xs font-semibold text-gray-700">2</span>
                    <div>
                        <h2 class="text-sm font-semibold text-gray-900">About Section</h2>
                        <p class="text-xs text-gray-500">Updated Nov 19, 2026 10:30 AM</p>
                    </div>
                    <span class="inline-flex items-center py-0.5 px-2 rounded-md text-xs font-medium bg-gray-100 text-gray-700">about</span>
                    <span class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                        <span class="size-1.5 rounded-full bg-gray-400"></span>Hidden
                    </span>
                </div>
                <a href="/admin/cms/edit/2" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-[#CC0000] text-white hover:bg-[#A30000] focus:outline-hidden focus:bg-[#A30000] transition-colors">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit content
                </a>
            </div>
            <div class="p-5 grid gap-5 sm:grid-cols-2">
                <div>
                    <p class="mb-1 text-xs font-medium text-gray-500">Title</p>
                    <p class="text-sm text-gray-800">About Us</p>
                </div>
                <div>
                    <p class="mb-1 text-xs font-medium text-gray-500">Image</p>
                    <p class="text-sm text-gray-400">Not set</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="mb-1 text-xs font-medium text-gray-500">Description</p>
                    <p class="text-sm text-gray-800">Add your company description here.</p>
                </div>
            </div>
        </div>

        <!-- Repeat the card for Services and Contact -->
    </div>
</div>

<?= $this->endSection(); ?>