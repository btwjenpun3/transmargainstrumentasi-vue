<template>
    <Navbar></Navbar>
    <AlertSuccess></AlertSuccess>
    <slot></slot>
</template>

<script setup>
import Navbar from '@/Components/Partials/Navbar.vue';
import AlertSuccess from '@/Components/UI/AlertSuccess.vue';
</script>