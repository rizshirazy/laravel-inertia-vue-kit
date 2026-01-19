<script setup lang="ts">
import { LogOut, Settings, User, ChevronsUpDown } from 'lucide-vue-next'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { router } from '@inertiajs/vue3'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import { SidebarMenuButton, useSidebar } from '@/components/ui/sidebar'

defineProps<{
    name?: string
    email?: string
    avatarUrl?: string | null
    isSidebar?: boolean
}>()
const emit = defineEmits(['logout'])
const { isMobile } = useSidebar()
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <SidebarMenuButton 
                v-if="isSidebar" 
                size="lg" 
                class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
            >
                <Avatar class="h-8 w-8 rounded-lg">
                    <AvatarImage :src="avatarUrl || ''" :alt="name || 'User'" />
                    <AvatarFallback class="rounded-lg bg-primary text-primary-foreground text-xs">
                        {{ (name || 'U').charAt(0).toUpperCase() }}
                    </AvatarFallback>
                </Avatar>
                <div class="grid flex-1 text-left text-sm leading-tight">
                    <span class="truncate font-semibold">{{ name || 'Guest' }}</span>
                    <span class="truncate text-xs">{{ email || 'guest@example.com' }}</span>
                </div>
                <ChevronsUpDown class="ml-auto size-4" />
            </SidebarMenuButton>
            <button v-else class="flex items-center gap-2 rounded-full focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
                <Avatar class="h-8 w-8 cursor-pointer">
                    <AvatarImage :src="avatarUrl || ''" :alt="name || 'User'" />
                    <AvatarFallback class="bg-primary text-primary-foreground">
                        {{ (name || 'U').charAt(0).toUpperCase() }}
                    </AvatarFallback>
                </Avatar>
            </button>
        </DropdownMenuTrigger>
        <DropdownMenuContent 
            :class="isSidebar ? 'w-[--radix-dropdown-menu-trigger-width] min-w-56 rounded-lg' : 'w-56'" 
            :align="isSidebar ? 'end' : 'end'"
            :side="isSidebar ? (isMobile ? 'bottom' : 'right') : 'bottom'"
            :side-offset="8"
            :align-offset="0"
        >
            <DropdownMenuLabel class="p-0 font-normal">
                <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                  <Avatar class="h-8 w-8 rounded-lg">
                    <AvatarImage :src="avatarUrl || ''" :alt="name || 'User'" />
                    <AvatarFallback class="rounded-lg bg-primary text-primary-foreground text-xs">
                         {{ (name || 'U').charAt(0).toUpperCase() }}
                    </AvatarFallback>
                  </Avatar>
                  <div class="grid flex-1 text-left text-sm leading-tight">
                    <span class="truncate font-semibold">{{ name || 'Guest' }}</span>
                    <span class="truncate text-xs">{{ email || 'guest@example.com' }}</span>
                  </div>
                </div>
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuGroup>
                <DropdownMenuItem @click="router.visit(route('profile.edit'))">
                    <User class="mr-2 h-4 w-4" />
                    <span>Profile</span>
                </DropdownMenuItem>
                <DropdownMenuItem>
                    <Settings class="mr-2 h-4 w-4" />
                    <span>Settings</span>
                </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuSeparator />
            <DropdownMenuItem 
                class="text-destructive focus:text-destructive"
                @click="emit('logout')"
            >
                <LogOut class="mr-2 h-4 w-4" />
                <span>Log out</span>
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
