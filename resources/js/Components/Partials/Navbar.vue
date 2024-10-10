<template>
    <header class="w-full bg-darkblue shadow-md">
        <div class="container mx-auto">
            <nav class="p-4 text-white">
                <div v-if="user" class="md:flex md:justify-start gap-4 items-center">
                    <div class="hidden md:block w-20 me-3">
                        <img src="/assets/img/Trans_Marga_Jateng.webp" alt="" class="bg-white p-1">
                    </div>
                    <Link :href="route('home')" class="hidden md:block text-md font-medium cursor-pointer"
                        :class="{ 'active': isActive('/') }">Beranda</Link>
                    <Link :href="route('laporan.create')" class="hidden md:block text-md font-medium cursor-pointer"
                        :class="{ 'active': isActive('/laporan/create') }">Buat Laporan</Link>
                    <Link :href="route('laporan.index')" class="hidden md:block text-md font-medium cursor-pointer"
                        :class="{ 'active': isActive('/laporan') }">Daftar Laporan</Link>
                    <Link :href="route('barang.index')" class="hidden md:block text-md font-medium cursor-pointer"
                        :class="{ 'active': isActive('/barang') }">Barang</Link>
                    <Link :href="route('user.index')" class="hidden md:block text-md font-medium cursor-pointer"
                        :class="{ 'active': isActive('/user') }">User</Link>
                    <div class="md:ms-auto md:cursor-pointer relative" @click="toggleSubMenu">
                        <div class="hidden md:flex md:justify-between items-center">
                            <div class="w-7 me-3">
                                <img src="/assets/img/avatar.png" alt="" class="rounded-xl bg-white">
                            </div>
                            <div class="text-center">
                                Welcome, {{ user.name }}
                            </div>
                        </div>
                        <!-- Sub-menu -->
                        <div v-if="isSubMenuVisible" class="absolute shadow-lg right-0 mt-2 w-60 bg-white border p-4">
                            <ul>
                                <li
                                    class="py-2 cursor-pointer text-black hover:bg-indigo-500 hover:text-white hover:ps-3">
                                    Profile
                                </li>
                                <li
                                    class="py-2 cursor-pointer text-red-500 hover:bg-red-500 hover:text-white hover:ps-3">
                                    <Link :href="route('logout')" method="post" as="button">Logout</Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div v-else class="md:flex md:justify-start gap-4 items-center">
                    <div class="hidden md:block w-20 me-3">
                        <img src="/assets/img/Trans_Marga_Jateng.webp" alt="" class="bg-white p-1">
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
                    <div class="block w-20 me-3 md:hidden" :class="{ 'mx-auto': user === null }">
                        <img src="/assets/img/Trans_Marga_Jateng.webp" alt="" class="bg-white p-1">
                    </div>
                </div>
                <!-- Overlay for clicking outside canvas -->
                <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-20"></div>

                <!-- Off-canvas menu (hidden by default) -->
                <div id="off-canvas"
                    class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white transform -translate-x-full transition-transform duration-300 z-20">
                    <div v-if="user" class="p-4">
                        <div class="flex justify-start items-center bg-softblue rounded-xl p-3 text-white text-medium">
                            <div class="max-w-10 me-3">
                                <img src="/assets/img/avatar.png" alt="" class="rounded-full bg-white">
                            </div>
                            <div class="text-center">
                                {{ user.name }}
                            </div>
                        </div>
                        <ul class="mt-4">
                            <li class="py-2">
                                <Link :href="route('home')" :class="{ 'active': isActive('/') }">Beranda</Link>
                            </li>
                            <li class="py-2">
                                <Link :href="route('laporan.create')"
                                    :class="{ 'active': isActive('/laporan/create') }">Buat Laporan</Link>
                            </li>
                            <li class="py-2">
                                <Link :href="route('laporan.index')" :class="{ 'active': isActive('/laporan') }">Daftar
                                Laporan</Link>
                            </li>
                            <li class="py-2">
                                <Link :href="route('barang.index')" :class="{ 'active': isActive('/barang') }">
                                Barang</Link>
                            </li>
                            <li class="py-2">
                                <Link :href="route('user.index')" :class="{ 'active': isActive('/user') }">
                                User</Link>
                            </li>
                        </ul>
                        <ul class="absolute bottom-2">
                            <li class="py-2 text-red-500">
                                <Link :href="route('logout')" method="post" as="button">Logout</Link>
                            </li>
                        </ul>
                    </div>
                    <div v-else class="p-4">
                        <div
                            class="flex justify-start items-center bg-yellow-600 rounded-xl p-3 text-white text-medium">
                            <div class="text-center">
                                Harap login terlebih dahulu
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';

const page = usePage();

const isActive = (path) => {
    return page.url === path
}

const user = computed(
    () => page.props.user
)

// Properti reaktif untuk sub-menu
const isSubMenuVisible = ref(false);

// Fungsi untuk toggle sub-menu

// Referensi ke elemen DOM
const burgerIcon = ref(null);
const offCanvas = ref(null)
const overlay = ref(null)

function toggleSubMenu() {
    isSubMenuVisible.value = !isSubMenuVisible.value;
}

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
