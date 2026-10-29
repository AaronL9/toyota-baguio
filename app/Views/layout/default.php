<?php

use App\Libraries\Vite;

$vite = new Vite();
$tags = $vite->tags(
    "main.ts",
)
?>

<!DOCTYPE html>
<html lang="en" data-page="<?= isset($page) ? $page : "" ?>">

<head>
    <meta charset="UTF-8">
    <title>Toyota Ilocos Sur</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <base href="<?= base_url() ?>">
    <?= $tags->css ?>
</head>

<body class=" flex flex-col min-h-screen">
    <?= $this->include('data-privacy') ?>

    <header id="header" class="fixed inset-x-0 top-0 z-50 bg-transparent text-white transition-colors duration-300">
        <nav class="mx-auto flex flex-wrap items-center justify-between max-w-7xl px-6 py-4">

            <!-- Logo -->
            <a href="/" class="shrink-0" aria-label="Home">
                <img id="header-logo" class="w-40 h-auto" src="/img/ilocos-sur-white-DHIjoD-c.png" alt="Logo" />
            </a>

            <!-- Mobile toggle and schedule button -->
            <div class="sm:order-3 flex items-center gap-x-2">
                <button type="button"
                    class="sm:hidden hs-collapse-toggle relative size-9 inline-flex items-center justify-center text-current"
                    id="hs-navbar-alignment-collapse" aria-expanded="false" aria-controls="hs-navbar-alignment"
                    aria-label="Toggle navigation" data-hs-collapse="#hs-navbar-alignment">
                    <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>

                    <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>

                <a href="/schedule"
                    class="inline-flex h-10 items-center justify-center whitespace-nowrap rounded-md border border-red-600 bg-red-600 px-3 text-sm font-semibold text-white">
                    Schedule Now
                </a>
            </div>

            <!-- Right-aligned navigation -->
            <div id="hs-navbar-alignment"
                class="hs-collapse hidden basis-full grow overflow-hidden transition-all duration-300 sm:order-2 sm:ms-auto sm:me-6 sm:block sm:basis-auto sm:grow-0"
                aria-labelledby="hs-navbar-alignment-collapse">
                <div class="mt-5 flex flex-col gap-5 sm:mt-0 sm:flex-row sm:items-center sm:ps-5">
                    <?php
                    $links = [
                        "Home" => "/",
                        "Showroom" => "/showroom",
                        "About us" => "#team",
                        "Contact us" => "/contact",
                        "CSR" => "/csr"
                    ];
                    ?>

                    <?php foreach ($links as $key => $value): ?>
                        <?php $isActive = url_is($value); ?>

                        <a class="<?= $isActive ? 'underline decoration-red-600 ' : '' ?>text-current font-medium whitespace-nowrap hover:underline hover:decoration-red-600 underline-offset-2"
                            href="<?= $value ?>">
                            <?= $key ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

        </nav>
    </header>



    <?= $this->renderSection("mainContent") ?>
    <!-- FOOTER -->
    <footer class="py-8 bg-black text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-5 md:grid-cols-5 items-start gap-6">
                <div class="col-span-2">
                    <img src="toyota-banner.png" class="h-14 bg-center w-auto" />
                    <p class="text-gray-300 text-sm pt-2">
                        Langlangca Segundo, Candon City, 2710
                    </p>
                </div>
                <div>
                    <h6 class="font-semibold text-sm mb-3 uppercase tracking-wide text-gray-400">
                        Quick Links
                    </h6>
                    <ul class="space-y-1 text-sm">
                        <li>
                            <a href="/" class="text-gray-300 hover:text-white">Home</a>
                        </li>

                        <li>
                            <a href="showroom" class="text-gray-300 hover:text-white">Showroom</a>
                        </li>

                        <li>
                            <a href="about-us" class="text-gray-300 hover:text-white">About Us</a>
                        </li>
                        <li>
                            <a href="contact" class="text-gray-300 hover:text-white">Contact Us</a>
                        </li>
                        <li>
                            <a href="csr" class="text-gray-300 hover:text-white"> CSR </a>
                        </li>
                    </ul>
                </div>
                <div class="md:text-left">
                    <h6 class="font-semibold text-sm mb-3 uppercase tracking-wide text-gray-400">
                        Office Hours
                    </h6>
                    <div class="text-sm text-gray-300 space-y-1">
                        <p>Mon – Saturday: 8:00 AM – 5:00 PM</p>
                        <p>Sunday: Closed</p>
                    </div>
                </div>

                <div style="width: fit-content"
                    class="w-25 text-gray-300 mt-5 flex flex-col justify-self-end items-end">
                    <img class="h-30 m-auto" src="dop-2.png">
                    <a class="text-center w-full text-[10px]" href="privacy-policy">Privacy Policy</a>
                </div>
            </div>
            <hr class="my-6 border-red-600" />
            <div class="flex flex-col md:flex-row justify-between items-center text-xs text-gray-400 gap-2">
                <p>© 2026 Toyota Ilocos-Sur. All rights reserved.</p>
                <p>Powered by BStech Solutions</p>
            </div>
        </div>
    </footer>

    <script>
        const header = document.getElementById("header");
        const logo = document.getElementById("header-logo");

        function updateHeader() {
            const scrolled = window.scrollY > 50;

            // Header background and text
            header.classList.toggle("bg-transparent", !scrolled);
            header.classList.toggle("text-white", !scrolled);
            header.classList.toggle("bg-white", scrolled);
            header.classList.toggle("text-gray-900", scrolled);
            header.classList.toggle("shadow-md", scrolled);

            // Logo: original white at the top, black after scrolling
            logo.classList.toggle("brightness-0", scrolled);
        }

        window.addEventListener("scroll", updateHeader, {
            passive: true
        });
        window.addEventListener("pageshow", updateHeader);

        updateHeader();
    </script>

    <?= $tags->js ?>
</body>

</html>