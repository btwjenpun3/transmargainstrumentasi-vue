<template>
    <Navbar></Navbar>
    <AlertSuccess></AlertSuccess>
    <AlertError></AlertError>
    <slot></slot>
</template>

<script setup>
import Navbar from '@/Components/Partials/Navbar.vue';
import AlertSuccess from '@/Components/UI/AlertSuccess.vue';
import AlertError from '@/Components/UI/AlertError.vue';
import Footer from '@/Components/Partials/Footer.vue';
</script>