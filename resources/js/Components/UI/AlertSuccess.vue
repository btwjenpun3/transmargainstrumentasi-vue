<template>
    <main class="w-full md:w-1/2 mx-auto">
        <div v-if="flashMessage" class="bg-green-500 text-white my-4 p-4 font-medium">
            {{ flashMessage }}
        </div>
    </main>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue'

const page = usePage()

const flashMessage = computed(
    () => page.props.flash.success
)

</script>