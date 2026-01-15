<script setup lang="ts">
import { LogOut, Settings, User } from 'lucide-vue-next'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'

defineProps<{
    name?: string
    email?: string
    avatarUrl?: string
}>()
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <button class="flex items-center gap-2 rounded-full focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
                <Avatar class="h-8 w-8 cursor-pointer">
                    <AvatarImage :src="avatarUrl" :alt="name || 'User'" />
                    <AvatarFallback class="bg-primary text-primary-foreground">
                        {{ (name || 'U').charAt(0).toUpperCase() }}
                    </AvatarFallback>
                </Avatar>
            </button>
        </DropdownMenuTrigger>
        <DropdownMenuContent class="w-56" align="end">
            <DropdownMenuLabel class="font-normal">
                <div class="flex flex-col space-y-1">
                    <p class="text-sm font-medium leading-none">{{ name || 'Guest' }}</p>
                    <p class="text-xs leading-none text-muted-foreground">{{ email || 'guest@example.com' }}</p>
                </div>
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuGroup>
                <DropdownMenuItem>
                    <User class="mr-2 h-4 w-4" />
                    <span>Profile</span>
                </DropdownMenuItem>
                <DropdownMenuItem>
                    <Settings class="mr-2 h-4 w-4" />
                    <span>Settings</span>
                </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuSeparator />
            <DropdownMenuItem class="text-destructive focus:text-destructive">
                <LogOut class="mr-2 h-4 w-4" />
                <span>Log out</span>
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
