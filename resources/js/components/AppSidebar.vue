<script setup lang="ts">
import { ChevronRight, GalleryVerticalEnd, Home, LogIn, Settings, FileText, PieChart, Users, LayoutGrid } from "lucide-vue-next";
import {
    Sidebar,
    SidebarContent,
    SidebarGroup,
    SidebarGroupContent,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarFooter,
    SidebarMenuSub,
    SidebarMenuSubItem,
    SidebarMenuSubButton,
    SidebarSeparator,
} from "@/components/ui/sidebar";
import { CollapsibleRoot as Collapsible, CollapsibleContent, CollapsibleTrigger } from "reka-ui";
import { AvatarDropdown } from "@/components/index";
import { usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";

// User interface for type safety
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
}

const page = usePage<PageProps>();
const user = computed(() => page.props.auth?.user);

const handleLogout = () => {
    router.post(route('logout'));
};

const items = [
    {
        title: "Dashboard",
        route: "dashboard",
        icon: Home,
    },
];

const navMain = [
    {
        title: "Projects",
        icon: LayoutGrid,
        isActive: true,
        items: [
            { title: "Active Projects", url: "#" },
            { title: "Completed", url: "#" },
            { title: "Archived", url: "#" },
        ],
    },
    {
        title: "Team",
        icon: Users,
        items: [
            { title: "Members", url: "#" },
            { title: "Roles", url: "#" },
            { title: "Permissions", url: "#" },
        ],
    },
    {
        title: "Reports",
        icon: PieChart,
        items: [
            { title: "Analytics", url: "#" },
            { title: "Sales", url: "#" },
            { title: "Traffic", url: "#" },
        ],
    },
    {
        title: "Settings",
        icon: Settings,
        items: [
            { title: "General", url: "#" },
            { title: "Notifications", url: "#" },
            { title: "Security", url: "#" },
        ],
    },
];
</script>

<template>
    <Sidebar variant="floating">
         <SidebarHeader>
            <SidebarMenu>
            <SidebarMenuItem>
                <SidebarMenuButton size="lg">
                <div class="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar-primary text-sidebar-primary-foreground">
                    <GalleryVerticalEnd class="size-4" />
                </div>
                <div class="flex flex-col gap-0.5 leading-none">
                    <span class="font-semibold">Documentation</span>
                    <span class="">v1.0.0</span>
                </div>
                </SidebarMenuButton>
            </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>
        <SidebarContent>
            <SidebarGroup>
                <SidebarGroupLabel>Application</SidebarGroupLabel>
                <SidebarGroupContent>
                    <SidebarMenu>
                        <SidebarMenuItem
                            v-for="item in items"
                            :key="item.title"
                        >
                            <SidebarMenuButton as-child :is-active="route().current(item.route)">
                                <Link :href="route(item.route)">
                                    <component :is="item.icon" />
                                    <span>{{ item.title }}</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </SidebarGroupContent>
            </SidebarGroup>

            <SidebarSeparator class="" />

            <!-- Collapsible Groups -->
            <SidebarGroup>
                <SidebarGroupLabel>Management</SidebarGroupLabel>
                <SidebarMenu>
                    <Collapsible
                        v-for="item in navMain"
                        :key="item.title"
                        as-child
                        :default-open="item.isActive"
                        class="group/collapsible"
                    >
                        <SidebarMenuItem>
                            <CollapsibleTrigger as-child>
                                <SidebarMenuButton :tooltip="item.title">
                                    <component :is="item.icon" />
                                    <span>{{ item.title }}</span>
                                    <ChevronRight class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                                </SidebarMenuButton>
                            </CollapsibleTrigger>
                            <CollapsibleContent>
                                <SidebarMenuSub>
                                    <SidebarMenuSubItem
                                        v-for="subItem in item.items"
                                        :key="subItem.title"
                                    >
                                        <SidebarMenuSubButton as-child>
                                            <Link :href="subItem.url">
                                                <span>{{ subItem.title }}</span>
                                            </Link>
                                        </SidebarMenuSubButton>
                                    </SidebarMenuSubItem>
                                </SidebarMenuSub>
                            </CollapsibleContent>
                        </SidebarMenuItem>
                    </Collapsible>
                </SidebarMenu>
            </SidebarGroup>
        </SidebarContent>
        <SidebarFooter v-if="user">
            <SidebarMenu>
                <SidebarMenuItem>
                    <AvatarDropdown 
                        :name="user.name" 
                        :email="user.email" 
                        :avatar-url="user.profile_picture"
                        @logout="handleLogout"
                        is-sidebar
                    />
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarFooter>
    </Sidebar>
</template>
