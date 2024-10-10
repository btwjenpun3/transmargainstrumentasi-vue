<template>
    <Content>
        <form @submit.prevent="create">
            <div class="text-xl font-medium border-b pb-2">
                <h1>Form Laporan</h1>
            </div>
            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                <div class="col-span-1 mt-3">
                    <label for="nama" class="label">Nama</label>
                    <input v-model="form.nama" id="nama" type="text" class="input"
                        :class="{ 'is-invalid': form.errors.nama }" disabled>
                    <InvalidFeedback v-if="form.errors.nama">
                        {{ form.errors.nama }}
                    </InvalidFeedback>
                </div>
                <div class="col-span-1 mt-3">
                    <label class="label">Jabatan</label>
                    <input v-model="form.jabatan" type="text" class="input"
                        :class="{ 'is-invalid': form.errors.jabatan }" disabled>
                    <InvalidFeedback v-if="form.errors.jabatan">
                        {{ form.errors.jabatan }}
                    </InvalidFeedback>
                </div>
                <div class="col-span-2 mt-3">
                    <label class="label">Rencana Kerja</label>
                    <input v-model="form.rencana_kerja" type="text" class="input"
                        :class="{ 'is-invalid': form.errors.rencana_kerja }">
                    <InvalidFeedback v-if="form.errors.rencana_kerja">
                        {{ form.errors.rencana_kerja }}
                    </InvalidFeedback>
                </div>
                <div class="col-span-2 mt-3">
                    <label class="label">Lokasi</label>
                    <input v-model="form.lokasi" type="text" class="input"
                        :class="{ 'is-invalid': form.errors.lokasi }">
                    <InvalidFeedback v-if="form.errors.lokasi">
                        {{ form.errors.lokasi }}
                    </InvalidFeedback>
                </div>
                <div class="col-span-2 mt-3">
                    <div class="flex flex-col items-start">
                        <div class="flex justify-start">
                            <input v-model="form.sesuaiSchedule" id="checkbox" type="checkbox" class="me-3">
                            <label for="checkbox">Sesuai Schedule</label>
                        </div>
                        <div class="flex justify-start">
                            <input v-model="form.tidakSesuaiSchedule" id="checkbox" type="checkbox" class="me-3">
                            <label for="checkbox">Tidak Sesuai Schedule</label>
                        </div>
                        <div class="flex justify-start">
                            <input v-model="form.rencanaTambahan" id="checkbox" type="checkbox" class="me-3">
                            <label for="checkbox">Rencana Tambahan</label>
                        </div>
                        <div class="flex justify-start">
                            <input v-model="form.lainLain" id="checkbox" type="checkbox" class="me-3">
                            <label for="checkbox">Lain-lain</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2 mt-3">
                <label class="label">Perlengkapan</label>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                    <div v-for="b in barang" :key="`barang-${b.id}`" class="flex justify-start items-center gap-2">
                        <input v-model="form.perlengkapan" :value="b.id" :id="`checkbox-${b.id}`" type="checkbox"
                            class="me-1">
                        <label :for="`checkbox-${b.id}`">{{ b.nama }}</label>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-3">
                <SubmitButton :processing="form.processing">
                    Submit
                </SubmitButton>
            </div>
        </form>
    </Content>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import Content from '../../Components/UI/Content.vue'
import InvalidFeedback from '../../Components/UI/InvalidFeedback.vue';
import SubmitButton from '../../Components/UI/SubmitButton.vue';

const page = usePage();

const form = useForm({
    nama: page.props.user.name,
    jabatan: page.props.user.jabatan,
    rencana_kerja: null,
    lokasi: null,
    sesuaiSchedule: false,
    tidakSesuaiSchedule: false,
    rencanaTambahan: false,
    lainLain: false,
    perlengkapan: []
})

defineProps({
    barang: Object
})

const create = () => form.post(route('laporan.store'), {
    onSuccess: () => {
        form.reset()
    }
})
</script>