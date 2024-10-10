<template>
    <Content>
        <div class="heading">
            Daftar Laporan
        </div>
        <Table>
            <thead>
                <tr class="bg-gray-100">
                    <th class="th">#</th>
                    <th class="th">Nomor Laporan</th>
                    <th class="th">Nama</th>
                    <th class="th">Jabatan</th>
                    <th class="th">Di buat</th>
                    <th class="th">Status</th>
                    <th class="th">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(l, index) in laporan.data" :key="`laporan-${l.id}`" class="hover:bg-gray-50">
                    <td class="td">{{ index + 1 }}</td>
                    <td class="td font-medium">{{ l.no }}</td>
                    <td class="td">{{ l.user.name }}</td>
                    <td class="td">{{ l.user.jabatan }}</td>
                    <td class="td">{{ l.dibuat }}</td>
                    <td class="td">
                        <Badge :status="l.status" />
                    </td>
                    <td class="td">
                        <div class="flex justify-start">
                            <Link :href="route('laporan.show', l.id)" class="btn-primary">Lihat</Link>
                        </div>
                    </td>
                </tr>
            </tbody>
        </Table>
        <div v-if="laporan.data.length" class="w-full flex justify-center mt-8 mb-8">
            <Pagination :links="laporan.links" />
        </div>
    </Content>
</template>

<script setup>
import Content from '../../Components/UI/Content.vue'
import Table from '../../Components/UI/Table.vue'
import Pagination from '../../Components/UI/Pagination.vue';
import Badge from '../../Components/UI/Badge.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    laporan: Object
})
</script>