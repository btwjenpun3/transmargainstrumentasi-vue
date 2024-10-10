<template>
    <span v-if="status === 'on_progress'"
        class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">
        Onprogress
    </span>
    <span v-else-if="status === 'approve'"
        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">
        Diterima
    </span>
    <span v-else class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">
        Ditolak
    </span>
</template>

<script setup>
const props = defineProps({
    status: String
})
</script>