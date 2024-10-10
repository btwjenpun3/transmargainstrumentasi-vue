<template>
    <Content>
        <div class="heading">Detail Laporan</div>
        <div class="mt-3">
            <div class="flex justify-start gap-4 border p-4 shadow-sm">
                <p class="w-20">Nomor</p>
                <p>:</p>
                <p class="font-medium">{{ laporan.no }}</p>
            </div>
            <div class="flex justify-start gap-4 mt-3 border p-4 shadow-sm">
                <p class="w-20">Nama</p>
                <p>:</p>
                <p class="font-medium">{{ laporan.user.name }}</p>
            </div>
            <div class="flex justify-start gap-4 mt-3 border p-4 shadow-sm">
                <p class="w-20">Jabatan</p>
                <p>:</p>
                <p class="font-medium">{{ laporan.user.jabatan }}</p>
            </div>
            <div class="flex justify-start gap-4 mt-3 border p-4 shadow-sm">
                <p class="w-20">Rencana Kerja</p>
                <p>:</p>
                <p class="font-medium">{{ laporan.rencana_kerja }}</p>
            </div>
            <div class="flex justify-start gap-4 mt-3 border p-4 shadow-sm md:items-center">
                <p class="w-20">Perlengkapan</p>
                <p>:</p>
                <div class="flex flex-col md:flex-row gap-3">
                    <p v-for="l in laporan.barang" class="font-medium  border p-2 bg-blue-100">{{ l.nama }}</p>
                </div>
            </div>
            <div class="flex justify-start gap-4 mt-3 border p-4 shadow-sm md:items-center">
                <p class="w-20">Status</p>
                <p>:</p>
                <Badge :status="laporan.status" />
            </div>
        </div>
        <div v-if="laporan.status === 'on_progress'" class="flex justify-between mt-3">
            <Link :href="route('laporan.reject', laporan.id)" class="btn-danger" method="POST" as="button">
            Tolak
            </Link>
            <Link :href="route('laporan.approve', laporan.id)" class="btn-success" method="POST" as="button">
            Terima
            </Link>
        </div>
        <div v-else class="flex justify-end mt-3">
            <Link :href="route('laporan.index')" class="btn-secondary">
            Kembali
            </Link>
        </div>
    </Content>
</template>

<script setup>
import Content from '../../Components/UI/Content.vue';
import Badge from '../../Components/UI/Badge.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    laporan: Object
})
</script>
