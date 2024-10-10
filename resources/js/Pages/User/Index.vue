<template>
    <Content>
        <form @submit.prevent="create">
            <div class="text-xl font-medium border-b pb-2">
                <h1>Input User</h1>
            </div>
            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                <div class="col-span-1 mt-3">
                    <label for="nama" class="label">Nama</label>
                    <input v-model="form.name" id="name" type="text" class="input"
                        :class="{ 'is-invalid': form.errors.name }">
                    <InvalidFeedback v-if="form.errors.name">
                        {{ form.errors.name }}
                    </InvalidFeedback>
                </div>
                <div class="col-span-1 mt-3">
                    <label for="email" class="label">Email</label>
                    <input v-model="form.email" id="email" type="email" class="input"
                        :class="{ 'is-invalid': form.errors.email }">
                    <InvalidFeedback v-if="form.errors.email">
                        {{ form.errors.email }}
                    </InvalidFeedback>
                </div>
                <div class="col-span-1 mt-3">
                    <label for="password" class="label">Password</label>
                    <input v-model="form.password" id="password" type="password" class="input"
                        :class="{ 'is-invalid': form.errors.password }">
                    <InvalidFeedback v-if="form.errors.password">
                        {{ form.errors.password }}
                    </InvalidFeedback>
                </div>
                <div class="col-span-1 mt-3">
                    <label for="jabatan" class="label">Jabatan</label>
                    <select v-model="form.jabatan" id="jabatan" class="input"
                        :class="{ 'is-invalid': form.errors.jabatan }">
                        <option v-for="j in daftarJabatan" :key="j.id" :value="j.nama">{{ j.nama }}</option>
                    </select>
                    <InvalidFeedback v-if="form.errors.jabatan">
                        {{ form.errors.jabatan }}
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
            <h1>Daftar User</h1>
        </div>
        <Table>
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2 text-left">#</th>
                    <th class="border px-4 py-2 text-left">Nama</th>
                    <th class="border px-4 py-2 text-left">Email</th>
                    <th class="border px-4 py-2 text-left">Jabatan</th>
                    <th class="border px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(u, index) in users.data" :key="u.id" class="hover:bg-gray-50">
                    <td class="border px-4 py-2 text-left">{{ index + 1 }}</td>
                    <td v-if="editId === u.id" colspan="4">
                        <form @submit.prevent="update(u.id)">
                            <div class="flex justify-center gap-4 m-2">
                                <div class="">
                                    <label for="name" class="label">Nama</label>
                                    <input v-model="editForm.name" id="name" type="text" class="input"
                                        placeholder="Nama" />
                                    <InvalidFeedback v-if="editForm.errors.name">
                                        {{ editForm.errors.name }}
                                    </InvalidFeedback>
                                </div>
                                <div class="">
                                    <label for="name" class="label">Email</label>
                                    <input v-model="editForm.email" type="email" class="input" placeholder="Email" />
                                    <InvalidFeedback v-if="editForm.errors.email">
                                        {{ editForm.errors.email }}
                                    </InvalidFeedback>
                                </div>
                                <div class="">
                                    <label for="name" class="label">Jabatan</label>
                                    <select v-model="editForm.jabatan" class="input" placeholder="Jabatan">
                                        <option v-for="m in daftarJabatan" :key="m.id" :value="m.nama">{{ m.nama }}
                                        </option>
                                    </select>
                                    <InvalidFeedback v-if="editForm.errors.jabatan">
                                        {{ editForm.errors.jabatan }}
                                    </InvalidFeedback>
                                </div>
                                <div class="">
                                    <label for="name" class="label">Password</label>
                                    <input v-model="editForm.password" type="password" class="input"
                                        placeholder="Password" />
                                    <InvalidFeedback v-if="editForm.errors.password">
                                        {{ editForm.errors.password }}
                                    </InvalidFeedback>
                                </div>
                            </div>
                            <div class="flex justify-end items-center p-3 gap-3">
                                <SubmitButton :processing="editForm.processing">Simpan</SubmitButton>
                                <button type="button" class="btn-secondary" @click.prevent="clearEditId">Batal</button>
                            </div>
                        </form>
                    </td>

                    <!-- Kolom untuk menampilkan data user jika tidak dalam mode edit -->
                    <template v-else>
                        <td class="border px-4 py-2 text-left w-full">
                            {{ u.name }}
                        </td>
                        <td class="border px-4 py-2 text-left w-full">
                            {{ u.email }}
                        </td>
                        <td class="border px-4 py-2 text-left w-full">
                            {{ u.jabatan }}
                        </td>
                        <td class="border px-4 py-2 text-left">
                            <div class="flex justify-start">
                                <button class="btn-primary me-3" @click.prevent="edit(u.id)">
                                    Edit
                                </button>
                                <!-- <Link :href="route('barang.destroy', u.id)" method="delete" as="button"
                                    class="btn-danger">
                                Hapus
                                </Link> -->
                            </div>
                        </td>
                    </template>
                </tr>
            </tbody>
        </Table>
        <div v-if="users.data.length" class="w-full flex justify-center mt-8 mb-8">
            <Pagination :links="users.links" />
        </div>
    </Content>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import Content from '../../Components/UI/Content.vue';
import InvalidFeedback from '../../Components/UI/InvalidFeedback.vue';
import SubmitButton from '../../Components/UI/SubmitButton.vue';
import Table from '../../Components/UI/Table.vue';
import Pagination from '../../Components/UI/Pagination.vue';

const props = defineProps({
    daftarJabatan: Object,
    users: Object
})

const form = useForm({
    name: null,
    email: null,
    password: null,
    jabatan: null,
})

const editForm = useForm({
    name: null,
    email: null,
    password: null,
    jabatan: null,
});

const create = () => form.post(route('user.store'), {
    onSuccess: () => {
        form.reset()
    }
}
)

const update = (id) => editForm.put(route('user.update', id), {
    onSuccess: () => {
        clearEditId()
    }
})

const editId = ref(null)

const edit = (id) => {
    // Cari user berdasarkan ID
    const user = props.users.data.find((user) => user.id === id);

    if (user) {
        editId.value = id;
        editForm.name = user.name;
        editForm.email = user.email;
        editForm.jabatan = user.jabatan;
    }
}

const clearEditId = () => {
    editId.value = null
}
</script>