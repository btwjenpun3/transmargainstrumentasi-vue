<template>
    <header class="w-full bg-darkblue shadow-md">
        <div class="container mx-auto">
            <nav class="p-4 text-white">
                <div class="md:flex md:justify-start gap-4 items-center">
                    <div class="hidden md:block w-20 me-3">
                        <img src="/assets/img/Trans_Marga_Jateng.webp" alt="" class="bg-white p-1">
                    </div>
                    <Link :href="route('home')" class="hidden md:block text-md font-medium cursor-pointer"
                        :class="{ 'active': isActive('/') }">Home</Link>
                    <Link :href="route('laporan.create')" class="hidden md:block text-md font-medium cursor-pointer"
                        :class="{ 'active': isActive('/laporan/create') }">Laporan</Link>
                    <div class="md:ms-auto md:cursor-pointer">
                        <div class="hidden md:flex md:justify-between">
                            <div class="w-7 me-3">
                                <img src="/assets/img/avatar.png" alt="" class="rounded-xl bg-white">
                            </div>
                            <div class="text-center">
                                Welcome, Helmi
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2 cursor-pointer"
                            id="burger-icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 6l16 0" />
                            <path d="M4 12l16 0" />
                            <path d="M4 18l16 0" />
                        </svg>
                    </div>
                    <div class="block w-20 me-3 md:hidden">
                        <img src="/assets/img/Trans_Marga_Jateng.webp" alt="" class="bg-white p-1">
                    </div>
                </div>
                <!-- Overlay for clicking outside canvas -->
                <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden"></div>

                <!-- Off-canvas menu (hidden by default) -->
                <div id="off-canvas"
                    class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white transform -translate-x-full transition-transform duration-300">
                    <div class="p-4">
                        <div class="flex justify-start items-center bg-softblue rounded-xl p-3 text-white text-medium">
                            <div class="max-w-10 me-3">
                                <img src="/assets/img/avatar.png" alt="" class="rounded-full bg-white">
                            </div>
                            <div class="text-center">
                                Helmi
                            </div>
                        </div>
                        <ul class="mt-4">
                            <li class="py-2">
                                <Link :href="route('home')" :class="{ 'active': isActive('/') }">Home</Link>
                            </li>
                            <li class="py-2">
                                <Link :href="route('laporan.create')"
                                    :class="{ 'active': isActive('/laporan/create') }">Laporan</Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const page = usePage();

const isActive = (path) => {
    return page.url === path
}
// Referensi ke elemen DOM
const burgerIcon = ref(null);
const offCanvas = ref(null);
const overlay = ref(null);

// Function to show the canvas and overlay
function showCanvas() {
    offCanvas.value.classList.remove('-translate-x-full');
    overlay.value.classList.remove('hidden');
}

// Function to hide the canvas and overlay
function hideCanvas() {
    offCanvas.value.classList.add('-translate-x-full');
    overlay.value.classList.add('hidden');
}

// Menggunakan onMounted untuk menambahkan event listener
onMounted(() => {
    burgerIcon.value = document.getElementById('burger-icon');
    offCanvas.value = document.getElementById('off-canvas');
    overlay.value = document.getElementById('overlay');

    // Show canvas when burger icon is clicked
    burgerIcon.value.addEventListener('click', showCanvas);

    // Hide canvas when clicking outside of the canvas (on the overlay)
    overlay.value.addEventListener('click', hideCanvas);
});
</script>
