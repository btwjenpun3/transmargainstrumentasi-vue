<template>
    <button class="btn-success" type="submit" :class="{ 'disabled': processing }" @click="handleClick">
        <div v-if="processing" class="loading"></div>
        <div v-else>
            <slot></slot>
        </div>
    </button>
</template>

<script setup>
const props = defineProps({
    processing: {
        type: Boolean,
        default: false
    }
})
</script>
