<script setup lang="ts">
import { AppSidebar, DarkModeToggle, AvatarDropdown, AppHeader } from "@/components/index";
import { SidebarProvider, SidebarInset } from "@/components/ui/sidebar";
import { useHeader } from "@/composables/useHeader";
import { usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";
import { useFlash } from "@/composables/useFlash";
import Toaster from "@/components/ui/sonner/Sonner.vue";

interface User {
    id: number;
    name: string;
    email: string;
    profile_picture: string | null;
}

interface PageProps extends Record<string, any> {
    auth: {
        user: User | null;
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
const user = computed(() => page.props.auth?.user);

useFlash();

const handleLogout = () => {
    router.post(route('logout'));
};
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
                    <AvatarDropdown 
                        v-if="user"
                        :name="user.name" 
                        :email="user.email" 
                        :avatar-url="user.profile_picture"
                        @logout="handleLogout"
                    />
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

