<script setup lang="ts">
import { AppSidebar, DarkModeToggle, AvatarDropdown } from "@/components/index";
import { SidebarProvider, SidebarInset, SidebarTrigger } from "@/components/ui/sidebar";
</script>

<template>
    <SidebarProvider>
        <AppSidebar />
        <SidebarInset>
            <!-- Header with sidebar trigger -->
            <header class="flex h-16 shrink-0 items-center justify-between border-b px-4">
                <div class="flex items-center gap-2">
                    <SidebarTrigger class="-ml-1" />
                </div>
                <div class="flex items-center gap-2">
                    <DarkModeToggle />
                    <AvatarDropdown name="John Doe" email="john@example.com" />
                </div>
            </header>
            <!-- Main content area -->
            <main class="flex-1 p-4">
                <slot />
            </main>
        </SidebarInset>
    </SidebarProvider>
</template>

