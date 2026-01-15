<script setup lang="ts">
import { AppSidebar, DarkModeToggle, AvatarDropdown, AppHeader } from "@/components/index";
import { SidebarProvider, SidebarInset } from "@/components/ui/sidebar";
import { useHeader } from "@/composables/useHeader";

const { state } = useHeader();
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
                    <AvatarDropdown name="John Doe" email="john@example.com" />
                </template>
            </AppHeader>

            <!-- Main content area -->
            <main class="flex-1 p-4">
                <slot />
            </main>
        </SidebarInset>
    </SidebarProvider>
</template>

