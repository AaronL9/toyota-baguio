<?= $this->extend("admin/layout/control-panel"); ?>

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
            <li><a href="/admin/banners" class="hover:text-gray-800 transition-colors">Banners</a></li>
            <li>
                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </li>
            <li class="font-medium text-gray-800">Add</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Add Banner</h1>
        <p class="text-sm text-gray-500 mt-1">Upload a banner image and set the text shown on it.</p>
    </div>

    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

    <!-- ── Upload Card ─────────────────────────────────────────────── -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

        <h2 class="text-xs font-semibold uppercase text-gray-400 tracking-wider mb-4">Banner Details</h2>

        <form
            action="/admin/banners"
            method="post"
            enctype="multipart/form-data"
            class="flex flex-col gap-5"
            x-data="bannerUpload()">

            <?= csrf_field() ?>

            <!-- File Drop Zone -->
            <div
                @dragover.prevent="dragOver = true"
                @dragleave.prevent="dragOver = false"
                @drop.prevent="onDrop($event)"
                :class="dragOver ? 'border-primary-500 bg-primary-50' : (previewUrl ? 'border-gray-300 bg-white' : 'border-gray-200 bg-gray-50')"
                class="relative flex flex-col items-center justify-center gap-3 border-2 border-dashed rounded-xl px-6 py-8 transition-colors duration-150 cursor-pointer"
                @click="$refs.fileInput.click()">

                <input
                    x-ref="fileInput"
                    type="file"
                    name="userfile"
                    id="userfile"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="hidden"
                    @change="onFileChange($event)" />

                <!-- Placeholder -->
                <div x-show="!previewUrl" class="flex flex-col items-center gap-2 pointer-events-none">
                    <div class="w-12 h-12 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                            <circle cx="9" cy="9" r="2" />
                            <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-600">Click or drag &amp; drop to upload</p>
                    <p class="text-xs text-gray-400">JPG, PNG, WEBP &mdash; max 5MB</p>
                </div>

                <!-- Preview -->
                <div x-show="previewUrl" x-cloak class="flex flex-col items-center gap-3 pointer-events-none w-full">
                    <div class="w-full max-w-md aspect-[16/6] rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                        <img :src="previewUrl" alt="Preview" class="w-full h-full object-cover object-center" />
                    </div>
                    <p class="text-xs text-gray-500" x-text="fileName"></p>
                    <p class="text-xs text-green-600 font-medium">
                        <i class="fa-solid fa-circle-check mr-1"></i>Ready to upload
                    </p>
                </div>
            </div>

            <!-- Change / Clear links -->
            <div x-show="previewUrl" x-cloak class="flex items-center gap-x-2 -mt-2">
                <button type="button" @click.stop="$refs.fileInput.click()" class="text-xs text-primary-700 hover:underline">
                    <i class="fa-solid fa-arrow-rotate-left mr-1"></i>Change file
                </button>
                <span class="text-gray-300">|</span>
                <button type="button" @click.stop="clearFile()" class="text-xs text-red-500 hover:underline">
                    <i class="fa-solid fa-xmark mr-1"></i>Clear
                </button>
            </div>

            <!-- Error: file -->
            <?php if (session()->getFlashdata('userfile_error')): ?>
                <div class="bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert">
                    <div class="flex gap-x-3">
                        <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="m15 9-6 6" />
                            <path d="m9 9 6 6" />
                        </svg>
                        <p class="font-medium"><?= esc(session()->getFlashdata('userfile_error')) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Title -->
            <div>
                <label for="banner_title" class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-gray-400 font-normal">(internal name)</span></label>
                <input
                    type="text"
                    id="banner_title"
                    name="banner_title"
                    maxlength="45"
                    required
                    value="<?= esc(old('banner_title')) ?>"
                    placeholder="e.g. Summer Promo"
                    class="py-2 px-3 block w-full border border-gray-200 rounded-lg text-sm text-gray-800 placeholder:text-gray-400 focus:border-primary-500 focus:ring-primary-500 <?= isset($errors['banner_title']) ? 'border-red-400' : '' ?>">
                <?php if (isset($errors['banner_title'])): ?>
                    <p class="text-xs text-red-600 mt-1"><?= esc($errors['banner_title']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Heading -->
            <div>
                <label for="banner_heading" class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                <input
                    type="text"
                    id="banner_heading"
                    name="banner_heading"
                    maxlength="100"
                    value="<?= esc(old('banner_heading')) ?>"
                    placeholder="Main text shown on the banner"
                    class="py-2 px-3 block w-full border border-gray-200 rounded-lg text-sm text-gray-800 placeholder:text-gray-400 focus:border-primary-500 focus:ring-primary-500 <?= isset($errors['banner_heading']) ? 'border-red-400' : '' ?>">
                <?php if (isset($errors['banner_heading'])): ?>
                    <p class="text-xs text-red-600 mt-1"><?= esc($errors['banner_heading']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Subheading -->
            <div>
                <label for="banner_subheading" class="block text-sm font-medium text-gray-700 mb-1.5">Subheading</label>
                <input
                    type="text"
                    id="banner_subheading"
                    name="banner_subheading"
                    maxlength="100"
                    value="<?= esc(old('banner_subheading')) ?>"
                    placeholder="Supporting text below the heading"
                    class="py-2 px-3 block w-full border border-gray-200 rounded-lg text-sm text-gray-800 placeholder:text-gray-400 focus:border-primary-500 focus:ring-primary-500 <?= isset($errors['banner_subheading']) ? 'border-red-400' : '' ?>">
                <?php if (isset($errors['banner_subheading'])): ?>
                    <p class="text-xs text-red-600 mt-1"><?= esc($errors['banner_subheading']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Inactive toggle -->
            <div class="flex items-center justify-between gap-4 px-4 py-3 bg-gray-50 rounded-lg border border-gray-100">
                <div>
                    <p class="text-sm font-medium text-gray-700">Save as inactive</p>
                    <p class="text-xs text-gray-400">Inactive banners are saved but not shown on the website.</p>
                </div>
                <label class="relative inline-block w-11 h-6 cursor-pointer shrink-0">
                    <input type="checkbox" name="banner_inactive" value="1" class="peer sr-only" <?= old('banner_inactive') ? 'checked' : '' ?>>
                    <span class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 peer-checked:bg-primary-950 peer-focus-visible:ring-2 peer-focus-visible:ring-primary-500"></span>
                    <span class="absolute top-0.5 left-0.5 size-5 bg-white rounded-full shadow-sm transition-transform duration-200 peer-checked:translate-x-5"></span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-x-3 pt-2 border-t border-gray-100">
                <a href="/admin/banners" class="py-2 px-4 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">Cancel</a>
                <button
                    type="submit"
                    :disabled="!previewUrl"
                    :class="!previewUrl ? 'opacity-50 pointer-events-none' : 'hover:bg-primary-800'"
                    class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 text-white transition-colors duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" x2="12" y1="3" y2="15" />
                    </svg>
                    Upload Banner
                </button>
            </div>

        </form>
    </div>

</div>

<script>
    function bannerUpload() {
        return {
            previewUrl: null,
            fileName: '',
            dragOver: false,

            onFileChange(event) {
                const file = event.target.files[0];
                if (file) this.loadPreview(file);
            },

            onDrop(event) {
                this.dragOver = false;
                const file = event.dataTransfer.files[0];
                if (file) {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    this.$refs.fileInput.files = dt.files;
                    this.loadPreview(file);
                }
            },

            loadPreview(file) {
                this.fileName = file.name;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.previewUrl = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            clearFile() {
                this.previewUrl = null;
                this.fileName = '';
                this.$refs.fileInput.value = '';
            },
        };
    }
</script>

<?= $this->endSection() ?>