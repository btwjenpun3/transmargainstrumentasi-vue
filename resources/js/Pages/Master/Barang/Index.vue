<template>
    <Content>
        <form @submit.prevent="create">
            <div class="text-xl font-medium border-b pb-2">
                <h1>Input Barang</h1>
            </div>
            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                <div class="col-span-2 mt-3">
                    <label for="nama" class="label">Nama Barang</label>
                    <input v-model="form.nama" id="nama" type="text" class="input"
                        :class="{ 'is-invalid': form.errors.nama }">
                    <InvalidFeedback v-if="form.errors.nama">
                        {{ form.errors.nama }}
                    </InvalidFeedback>
                </div>
            </div>
            <div class="flex justify-end mt-3">
                <SubmitButton :processing="form.processing">
                    Tambah
                </SubmitButton>
            </div>
        </form>
    </Content>
    <Content class="mb-4">
        <div class="text-xl font-medium border-b pb-2">
            <h1>Daftar Barang</h1>
        </div>
        <Table>
            <thead>
                <tr class="bg-gray-100">
                    <th class="th">#</th>
                    <th class="th">Nama</th>
                    <th class="th">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="barang.data.length" v-for="(b, index) in barang.data" :key="b.id" class="hover:bg-gray-50">
                    <td class="td">{{ index + 1 }}</td>
                    <td class="td w-full">
                        <div v-if="editId === b.id">
                            <form @submit.prevent="update(b.id)"
                                class="flex flex-col md:flex-row md:justify-start gap-3">
                                <input v-model="editForm.nama" type="text" class="input"
                                    :class="{ 'is-invalid': editForm.errors.nama }">
                                <SubmitButton :processing="editForm.processing" class="btn-success" type="submit">
                                    Simpan
                                </SubmitButton>
                                <button class="btn-secondary" @click.prevent="clearEditId">Batal</button>
                            </form>
                            <InvalidFeedback v-if="editForm.errors.nama">
                                {{ editForm.errors.nama }}
                            </InvalidFeedback>
                        </div>
                        <div v-else>
                            {{ b.nama }}
                        </div>
                    </td>
                    <td class="td">
                        <div class="flex justify-start">
                            <button :class="editId === b.id ? 'hidden' : null" id="content" class="btn-primary me-3"
                                @click.prevent="edit(b.id, b.nama)">
                                Edit
                            </button>
                            <Link :href="route('barang.destroy', b.id)" :class="editId === b.id ? 'hidden' : null"
                                method="delete" as="button" class="btn-danger">
                            Hapus
                            </Link>
                        </div>
                    </td>
                </tr>
                <tr v-else>
                    <td class="border px-4 py-2 text-center italic" colspan="3">Data tidak ditemukan</td>
                </tr>
            </tbody>
        </Table>
        <div v-if="barang.data.length" class="w-full flex justify-center mt-8 mb-8">
            <Pagination :links="barang.links" />
        </div>
    </Content>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import Content from '../../../Components/UI/Content.vue'
import Table from '../../../Components/UI/Table.vue';
import SubmitButton from '../../../Components/UI/SubmitButton.vue';
import InvalidFeedback from '../../../Components/UI/InvalidFeedback.vue';
import Pagination from '../../../Components/UI/Pagination.vue';

defineProps({
    barang: Object
})

const form = useForm({
    nama: null
})

const create = () => form.post(route('barang.store'), {
    onSuccess: () => {
        form.reset()
    }
})

const editForm = useForm({
    nama: null
});

const update = (id) => editForm.put(route('barang.update', id), {
    onSuccess: () => {
        clearEditId()
    }
})

const editId = ref(null)

const edit = (id, nama) => {
    editId.value = id
    editForm.nama = nama
}

const clearEditId = () => {
    editId.value = null
}
</script>