<script setup>
import { Link } from '@inertiajs/vue3';
import logo from '@/assets/AlsterText.svg'
</script>

<template>
    <Link :href="'/'">
        <img :src="logo" alt="Logo" class="h-24" />
    </Link>
</template>
