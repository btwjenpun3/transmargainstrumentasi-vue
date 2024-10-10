<template>
    <Content>
        <form @submit.prevent="create">
            <div class="heading">
                Login
            </div>
            <div class="grid grid-cols-1">
                <div class="mt-3">
                    <label for="email" class="label">Email</label>
                    <input v-model="form.email" type="email" id="email" class="input"
                        :class="{ 'is-invalid': form.errors.email }">
                    <InvalidFeedback v-if="form.errors.email">
                        {{ form.errors.email }}
                    </InvalidFeedback>
                </div>
                <div class="mt-3">
                    <label for="password" class="label">Password</label>
                    <input v-model="form.password" type="password" id="password" class="input"
                        :class="{ 'is-invalid': form.errors.password }">
                    <InvalidFeedback v-if="form.errors.password">
                        {{ form.errors.password }}
                    </InvalidFeedback>
                </div>
                <div class="mt-3">
                    <SubmitButton :processing="form.processing" class="btn-success">
                        Login
                    </SubmitButton>
                </div>
            </div>
        </form>
    </Content>
</template>


<script setup>
import { useForm } from '@inertiajs/vue3';
import Content from '../../Components/UI/Content.vue';
import SubmitButton from '../../Components/UI/SubmitButton.vue';
import InvalidFeedback from '../../Components/UI/InvalidFeedback.vue';

const form = useForm({
    email: null,
    password: null
})

const create = () => form.post(route('login.store'))
</script>