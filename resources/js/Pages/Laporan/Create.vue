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
                        :class="{ 'is-invalid': form.errors.nama }">
                    <InvalidFeedback v-if="form.errors.nama">
                        {{ form.errors.nama }}
                    </InvalidFeedback>
                </div>
                <div class="col-span-1 mt-3">
                    <label class="label">Jabatan</label>
                    <input v-model="form.jabatan" type="text" class="input"
                        :class="{ 'is-invalid': form.errors.jabatan }">
                    <InvalidFeedback v-if="form.errors.jabatan">
                        {{ form.errors.jabatan }}
                    </InvalidFeedback>
                </div>
                <div class="col-span-2 mt-3">
                    <label class="label">Rencana Kerja</label>
                    <input v-model="form.rencanaKerja" type="text" class="input"
                        :class="{ 'is-invalid': form.errors.rencanaKerja }">
                    <InvalidFeedback v-if="form.errors.rencanaKerja">
                        {{ form.errors.rencanaKerja }}
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
            <div class="flex justify-end mt-3">
                <button class="btn-success" type="submit" :class="{ 'disabled': form.processing }">
                    <div v-if="form.processing" class="loading"></div>
                    <div v-else>
                        Submit
                    </div>
                </button>
            </div>
        </form>
    </Content>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Content from '../../Components/UI/Content.vue'
import InvalidFeedback from '../../Components/UI/InvalidFeedback.vue';

const form = useForm({
    nama: null,
    jabatan: null,
    rencanaKerja: null,
    sesuaiSchedule: false,
    tidakSesuaiSchedule: false,
    rencanaTambahan: false,
    lainLain: false,
})

const create = () => form.post(route('laporan.store'))
</script>