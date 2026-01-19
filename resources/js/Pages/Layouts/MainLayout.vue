<script setup lang="ts">
import { AppSidebar, DarkModeToggle, AppHeader } from "@/components/index";
import { SidebarProvider, SidebarInset } from "@/components/ui/sidebar";
import { useHeader } from "@/composables/useHeader";
import { usePage } from "@inertiajs/vue3";
import { useFlash } from "@/composables/useFlash";
import Toaster from "@/components/ui/sonner/Sonner.vue";

interface PageProps extends Record<string, any> {
    auth: {
        user: any;
    };
    flash: {
        success: string | null;
        error: string | null;
        info: string | null;
        warning: string | null;
    };
}

const { state } = useHeader();
const page = usePage<PageProps>();

useFlash();
</script>

<template>
    <SidebarProvider>
        <AppSidebar />
        <SidebarInset>
            <!-- Consolidated Header -->
            <AppHeader 
                :title="state.title" 
                :subtitle="state.subtitle" 
                :breadcrumbs="state.breadcrumbs"
            >
                <template #actions>
                    <DarkModeToggle />
                </template>
            </AppHeader>

            <!-- Main content area -->
            <main class="flex-1 p-4">
                <slot />
            </main>
        </SidebarInset>
    </SidebarProvider>
    <Teleport to="body">
        <Toaster position="top-center" rich-colors />
    </Teleport>
</template>

