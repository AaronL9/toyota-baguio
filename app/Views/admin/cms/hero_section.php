<?= $this->extend("admin/layout/admin_control_panel"); ?>

<?= $this->section("page"); ?>

<div class="w-full max-w-3xl" x-data="heroForm('<?= csrf_hash() ?>', <?= esc(json_encode([
                                                                            'id'              => $section['id'] ?? 78,
                                                                            'title'           => $section['title'] ?? '',
                                                                            'subtitle'        => $section['subtitle'] ?? '',
                                                                            'button_text'     => $section['button_text'] ?? '',
                                                                            'button_link'     => $section['button_link'] ?? '',
                                                                            'is_visible'      => (bool) ($section['is_visible'] ?? true),
                                                                            'background_url'  => $section['background_image'] ?? '',
                                                                        ]), 'attr') ?>)">

    <!-- Page heading -->
    <div class="flex gap-3 mb-6">
        <a href="/admin/cms"
            class="size-8 inline-flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 transition-colors">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>
        <div>
            <h1 class="text-base font-semibold text-gray-900 leading-none">Edit Hero Section</h1>
            <p class="text-xs text-gray-400 mt-0.5">Update what visitors see at the top of the website.</p>
        </div>
    </div>

    <pre>
        <?php print_r($cms) ?>
    </pre>

    <form @submit.prevent="submit" enctype="multipart/form-data" novalidate>
        <div class="flex flex-col gap-5">

            <!-- Title -->
            <div class="flex flex-col gap-1.5">
                <label for="hero_title" class="text-sm font-medium text-gray-700">
                    Title <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="hero_title"
                    name="title"
                    x-model="form.title"
                    maxlength="150"
                    placeholder="e.g. Welcome to Our Website"
                    class="py-2 px-3 block w-full bg-layer border border-layer-line rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:border-primary-focus focus:ring-primary-focus"
                    :class="errors.title ? 'border-red-400 focus:border-red-400 focus:ring-red-400' : ''">
                <p x-show="errors.title" x-text="errors.title" class="text-xs text-red-500 mt-0.5"></p>
            </div>

            <!-- Subtitle -->
            <div class="flex flex-col gap-1.5">
                <label for="hero_subtitle" class="text-sm font-medium text-gray-700">Subtitle</label>
                <textarea
                    id="hero_subtitle"
                    name="subtitle"
                    x-model="form.subtitle"
                    rows="3"
                    maxlength="300"
                    placeholder="e.g. Discover our services"
                    class="py-2 px-3 block w-full bg-layer border border-layer-line rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:border-primary-focus focus:ring-primary-focus"
                    :class="errors.subtitle ? 'border-red-400 focus:border-red-400 focus:ring-red-400' : ''"></textarea>
                <div class="flex justify-between">
                    <p x-show="errors.subtitle" x-text="errors.subtitle" class="text-xs text-red-500 mt-0.5"></p>
                    <p class="text-xs text-gray-400 ml-auto" x-text="form.subtitle.length + '/300'"></p>
                </div>
            </div>

            <!-- Background image -->
            <div class="flex flex-col gap-1.5">
                <label class="text-sm font-medium text-gray-700">Background image</label>

                <div class="bg-layer border border-layer-line rounded-xl p-4 flex flex-col gap-3"
                    :class="errors.background_image ? 'border-red-400' : ''">

                    <!-- Preview -->
                    <template x-if="preview">
                        <div class="relative w-full aspect-[16/6] rounded-lg overflow-hidden bg-gray-100">
                            <img :src="preview" alt="Background preview" class="size-full object-cover">
                            <button type="button" @click="removeImage"
                                class="absolute top-2 right-2 size-7 inline-flex items-center justify-center rounded-full bg-white/90 text-gray-600 hover:bg-white shadow-sm"
                                title="Remove image">
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </button>
                        </div>
                    </template>

                    <template x-if="!preview">
                        <label for="hero_image"
                            class="flex flex-col items-center justify-center gap-2 py-8 border-2 border-dashed border-layer-line rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <svg class="size-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="3" rx="2" />
                                <circle cx="9" cy="9" r="2" />
                                <path d="m21 15-3.09-3.09a2 2 0 0 0-2.82 0L6 21" />
                            </svg>
                            <span class="text-sm text-gray-600">Click to upload an image</span>
                            <span class="text-xs text-gray-400">JPG, PNG or WebP, up to 2 MB</span>
                        </label>
                    </template>

                    <input type="file" id="hero_image" name="background_image" accept="image/jpeg,image/png,image/webp"
                        class="hidden" x-ref="image" @change="onFile($event)">

                    <div x-show="preview" class="flex items-center gap-2">
                        <label for="hero_image"
                            class="py-1.5 px-3 text-xs font-medium rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 cursor-pointer transition-colors">
                            Replace image
                        </label>
                    </div>
                </div>

                <p x-show="errors.background_image" x-text="errors.background_image" class="text-xs text-red-500 mt-0.5"></p>
            </div>

            <!-- Button text + link: two columns -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="flex flex-col gap-1.5">
                    <label for="hero_button_text" class="text-sm font-medium text-gray-700">Button text</label>
                    <input
                        type="text"
                        id="hero_button_text"
                        name="button_text"
                        x-model="form.button_text"
                        maxlength="40"
                        placeholder="e.g. Learn More"
                        class="py-2 px-3 block w-full bg-layer border border-layer-line rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:border-primary-focus focus:ring-primary-focus"
                        :class="errors.button_text ? 'border-red-400 focus:border-red-400 focus:ring-red-400' : ''">
                    <p x-show="errors.button_text" x-text="errors.button_text" class="text-xs text-red-500 mt-0.5"></p>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="hero_button_link" class="text-sm font-medium text-gray-700">Button link</label>
                    <input
                        type="text"
                        id="hero_button_link"
                        name="button_link"
                        x-model="form.button_link"
                        maxlength="255"
                        placeholder="e.g. /about"
                        class="py-2 px-3 block w-full bg-layer border border-layer-line rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:border-primary-focus focus:ring-primary-focus"
                        :class="errors.button_link ? 'border-red-400 focus:border-red-400 focus:ring-red-400' : ''">
                    <p x-show="errors.button_link" x-text="errors.button_link" class="text-xs text-red-500 mt-0.5"></p>
                </div>
            </div>

            <!-- Visibility -->
            <div class="flex items-center justify-between gap-4 p-4 bg-layer border border-layer-line rounded-xl">
                <div>
                    <p class="text-sm font-medium text-gray-700">Visible on website</p>
                    <p class="text-xs text-gray-400 mt-0.5">Turn off to hide this section without deleting it.</p>
                </div>
                <button type="button" role="switch" :aria-checked="form.is_visible"
                    @click="form.is_visible = !form.is_visible"
                    class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors focus:outline-hidden"
                    :class="form.is_visible ? 'bg-emerald-500' : 'bg-gray-300'">
                    <span class="pointer-events-none inline-block size-5 rounded-full bg-white shadow transform transition-transform"
                        :class="form.is_visible ? 'translate-x-5' : 'translate-x-0'"></span>
                </button>
            </div>

            <!-- Form actions -->
            <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                <a href="/admin/cms"
                    class="py-2 px-4 text-sm font-medium rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" :disabled="submitting"
                    class="py-2 px-4 inline-flex items-center gap-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover disabled:opacity-60 disabled:pointer-events-none focus:outline-hidden transition-colors">
                    <template x-if="submitting">
                        <svg class="animate-spin size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                        </svg>
                    </template>
                    <template x-if="!submitting">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                    </template>
                    <span x-text="submitting ? 'Saving…' : 'Save changes'"></span>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('heroForm', (csrfHash, initial) => ({
            csrf: csrfHash,
            submitting: false,
            errors: {},
            preview: initial.background_url || '',
            removeBackground: false,
            form: {
                title: initial.title,
                subtitle: initial.subtitle,
                button_text: initial.button_text,
                button_link: initial.button_link,
                is_visible: initial.is_visible,
            },

            onFile(e) {
                const file = e.target.files[0];
                if (!file) return;

                delete this.errors.background_image;

                if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
                    this.errors.background_image = 'Please choose a JPG, PNG or WebP image.';
                    e.target.value = '';
                    return;
                }
                if (file.size > 2 * 1024 * 1024) {
                    this.errors.background_image = 'Image must be 2 MB or smaller.';
                    e.target.value = '';
                    return;
                }

                this.removeBackground = false;
                this.preview = URL.createObjectURL(file);
            },

            removeImage() {
                this.$refs.image.value = '';
                this.preview = '';
                this.removeBackground = true;
            },

            validate() {
                this.errors = {};
                if (!this.form.title.trim()) {
                    this.errors.title = 'Title is required.';
                }
                // Button text and link should go together
                if (this.form.button_text.trim() && !this.form.button_link.trim()) {
                    this.errors.button_link = 'Add a link for the button.';
                }
                if (this.form.button_link.trim() && !this.form.button_text.trim()) {
                    this.errors.button_text = 'Add text for the button.';
                }
                return Object.keys(this.errors).length === 0;
            },

            async submit() {
                if (!this.validate()) return;

                this.submitting = true;

                const data = new FormData();
                data.append('csrf_test_name', this.csrf); // use your app's CSRF token name
                data.append('title', this.form.title.trim());
                data.append('subtitle', this.form.subtitle.trim());
                data.append('button_text', this.form.button_text.trim());
                data.append('button_link', this.form.button_link.trim());
                data.append('is_visible', this.form.is_visible ? '1' : '0');
                data.append('remove_background', this.removeBackground ? '1' : '0');

                const file = this.$refs.image.files[0];
                if (file) data.append('background_image', file);

                try {
                    const res = await fetch('/admin/cms/<?= $section['id'] ?? 78 ?>/update', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: data,
                    });
                    const json = await res.json();

                    if (json.csrf) this.csrf = json.csrf; // CI4 regenerates the hash per request

                    if (!res.ok) {
                        this.errors = json.errors || {
                            title: json.message || 'Something went wrong.'
                        };
                        return;
                    }

                    window.location.href = '/admin/cms';
                } catch (err) {
                    this.errors.title = 'Network error. Please try again.';
                } finally {
                    this.submitting = false;
                }
            },
        }));
    });
</script>

<?= $this->endSection(); ?>