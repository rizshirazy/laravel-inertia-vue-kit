<script setup lang="ts">
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from '@/components/ui/breadcrumb';
import { Separator } from '@/components/ui/separator';
import { SidebarTrigger } from '@/components/ui/sidebar';

interface BreadcrumbItem {
    label: string;
    href?: string;
}

defineProps<{
    title?: string;
    subtitle?: string;
    breadcrumbs?: BreadcrumbItem[];
}>();
</script>

<template>
    <!-- Top row: Navigation & Actions -->
    <header class="sticky top-0 z-50 flex h-16 shrink-0 items-center justify-between px-4 bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
        <div class="flex items-center gap-2">
            <SidebarTrigger class="-ml-1" />
            <Separator orientation="vertical" class="mr-2 h-4" />
            <div v-if="breadcrumbs && breadcrumbs.length > 0">
                <Breadcrumb>
                    <BreadcrumbList>
                        <template v-for="(item, index) in breadcrumbs" :key="index">
                            <BreadcrumbItem>
                                <BreadcrumbLink v-if="item.href && index < breadcrumbs.length - 1" :href="item.href">
                                    {{ item.label }}
                                </BreadcrumbLink>
                                <BreadcrumbPage v-else>
                                    {{ item.label }}
                                </BreadcrumbPage>
                            </BreadcrumbItem>
                            <BreadcrumbSeparator v-if="index < breadcrumbs.length - 1" />
                        </template>
                    </BreadcrumbList>
                </Breadcrumb>
            </div>
        </div>
        
        <div class="flex items-center gap-2">
            <slot name="actions" />
        </div>
    </header>

    <!-- Bottom row: Title & Subtitle (optional) -->
    <div v-if="title || subtitle" class="flex flex-col gap-1 px-4">
        <h1 v-if="title" class="text-2xl font-bold tracking-tight">{{ title }}</h1>
        <p v-if="subtitle" class="text-sm text-muted-foreground">
            {{ subtitle }}
        </p>
    </div>
</template>
