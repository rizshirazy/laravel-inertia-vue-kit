<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { useHeader } from '@/composables/useHeader';
import { onMounted } from 'vue';

const { setHeader } = useHeader();

onMounted(() => {
    setHeader({
        title: 'Dashboard',
        subtitle: "Welcome back! Here is what's happening today.",
        breadcrumbs: [
            { label: 'Dashboard', href: route('dashboard') },
            { label: 'Overview' }
        ],
    });
});
</script>

<template>
    <Head title="Dashboard" />
    
    <div class="flex flex-1 flex-col gap-4">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="aspect-video rounded-xl bg-muted/50 transition-colors hover:bg-muted/80" />
            <div class="aspect-video rounded-xl bg-muted/50 transition-colors hover:bg-muted/80" />
            <div class="aspect-video rounded-xl bg-muted/50 transition-colors hover:bg-muted/80" />
        </div>
        <div class="min-h-[100vh] flex-1 rounded-xl bg-muted/50 transition-colors hover:bg-muted/80 md:min-h-min" />
    </div>
</template>
