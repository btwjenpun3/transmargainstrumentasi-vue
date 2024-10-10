<template>
    <main class="w-full md:w-2/3 mx-auto">
        <div v-if="flashMessage" class="bg-red-500 text-white my-4 p-4 font-medium">
            {{ flashMessage }}
        </div>
    </main>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue'

const page = usePage()

const flashMessage = computed(
    () => page.props.flash.error
)

</script>