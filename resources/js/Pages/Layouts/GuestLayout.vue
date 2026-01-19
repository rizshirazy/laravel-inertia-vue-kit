<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { useFlash } from "@/composables/useFlash";
import Toaster from "@/components/ui/sonner/Sonner.vue";

useFlash();
</script>

<template>
    <div class="flex min-h-screen w-full flex-col lg:flex-row bg-background">
        <!-- Left Side: Unsplash Image -->
        <div class="relative hidden lg:flex lg:w-3/5 xl:w-2/3 items-center justify-center bg-muted overflow-hidden">
            <img 
                src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=2070&auto=format&fit=crop" 
                alt="Workspace" 
                class="absolute inset-0 h-full w-full object-cover brightness-[0.7]"
            />
            <!-- Subtle gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-0" />
        </div>

        <!-- Right Side: Content -->
        <div class="flex flex-1 flex-col items-center justify-center p-6 sm:p-12 lg:w-2/5 xl:w-1/3">
            <div class="w-full max-w-[400px] space-y-8">
                <slot />
            </div>
        </div>
    </div>
    <Teleport to="body">
        <Toaster position="top-right" rich-colors />
    </Teleport>
</template>

<style scoped>
/* Optional: smooth entry animations */
.flex {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>