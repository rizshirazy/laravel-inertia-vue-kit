<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useForm, Head } from '@inertiajs/vue3';
import MainLayout from '../Layouts/MainLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { Camera } from 'lucide-vue-next';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { useHeader } from '@/composables/useHeader';

const props = defineProps<{
    user: {
        name: string;
        email: string;
        profile_picture: string | null;
    };
    success?: string;
}>();

const profileForm = useForm({
    name: props.user.name,
    email: props.user.email,
    profile_picture: null as File | null,
});

const passwordForm = useForm({
    current_password: '',
    new_password: '',
    new_password_confirmation: '',
});

const avatarPreview = ref(props.user.profile_picture || '');
const fileInput = ref<HTMLInputElement | null>(null);

const handleImageSelect = (event: any) => {
    const file = event.target.files[0];
    if (file) {
        profileForm.profile_picture = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            avatarPreview.value = e.target?.result as string;
        };
        reader.readAsDataURL(file);
    }
};

const triggerFileInput = () => {
    fileInput.value?.click();
};

const updateProfile = () => {
    profileForm.post(route('profile.update'), {
        preserveScroll: true,
        onSuccess: () => {
            profileForm.reset('profile_picture');
        },
    });
};

const updatePassword = () => {
    passwordForm.post(route('profile.password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            passwordForm.reset();
        },
    });
};

const { setHeader } = useHeader();

onMounted(() => {
    setHeader({
        title: 'Edit Profile',
        subtitle: "Update your account's profile information and password.",
        breadcrumbs: [
            { label: 'Profile'},
            { label: 'Edit' }
        ],
    });
});
</script>

<template>
    <Head title="Edit Profile" />

    <div class="w-full space-y-8 py-8">
        <!-- Profile Information Card -->
        <Card>
            <CardHeader>
                <CardTitle>Profile Information</CardTitle>
                <CardDescription>
                    Update your account's profile information and email address.
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="updateProfile" class="space-y-6">
                    <div class="flex items-center gap-8">
                        <div class="relative group cursor-pointer" @click="triggerFileInput">
                            <Avatar class="h-28 w-28 border-2 border-muted hover:border-muted-foreground transition-transform group-hover:scale-105">
                                <AvatarImage 
                                    :src="avatarPreview" 
                                    class="object-cover"
                                />
                                <AvatarFallback class="text-2xl bg-muted text-muted-foreground">
                                    {{ profileForm.name.charAt(0).toUpperCase() }}
                                </AvatarFallback>
                            </Avatar>
                            <div class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <Camera class="h-8 w-8 text-white" />
                            </div>
                        </div>
                        
                        <div class="flex-1 space-y-3">
                            <div class="space-y-1">
                                <Label for="profile_picture" class="text-base font-semibold">Profile Picture</Label>
                                <p class="text-sm text-muted-foreground italic">Click the image or use the button below to upload a new one.</p>
                            </div>
                            <div class="flex flex-col gap-2">
                                <input
                                    ref="fileInput"
                                    id="profile_picture"
                                    type="file"
                                    @change="handleImageSelect"
                                    accept="image/*"
                                    class="hidden"
                                />
                                <Button 
                                    type="button" 
                                    variant="outline" 
                                    size="sm" 
                                    class="w-fit"
                                    @click="triggerFileInput"
                                >
                                    Browse Files
                                </Button>
                                <p v-if="profileForm.errors.profile_picture" class="text-sm font-medium text-destructive">
                                    {{ profileForm.errors.profile_picture }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <Label for="name">Name</Label>
                        <Input
                            id="name"
                            type="text"
                            v-model="profileForm.name"
                            required
                            autocomplete="name"
                            placeholder="Enter your name"
                            class="max-w-2xl"
                            :class="{ 'border-destructive focus-visible:ring-destructive': profileForm.errors.name }"
                        />
                        <p v-if="profileForm.errors.name" class="text-sm font-medium text-destructive">
                            {{ profileForm.errors.name }}
                        </p>
                    </div>

                    <div class="space-y-2">
                        <Label for="email">Email</Label>
                        <Input
                            id="email"
                            type="email"
                            v-model="profileForm.email"
                            required
                            autocomplete="username"
                            placeholder="Enter your email"
                            class="max-w-2xl"
                            :class="{ 'border-destructive focus-visible:ring-destructive': profileForm.errors.email }"
                        />
                        <p v-if="profileForm.errors.email" class="text-sm font-medium text-destructive">
                            {{ profileForm.errors.email }}
                        </p>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <Button type="submit" :disabled="profileForm.processing">
                            Save Profile
                        </Button>
                    </div>
                </form>
            </CardContent>
        </Card>

        <!-- Update Password Card -->
        <Card>
            <CardHeader>
                <CardTitle>Security</CardTitle>
                <CardDescription>
                    Ensure your account is using a long, random password to stay secure.
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="updatePassword" class="space-y-6">
                    <div class="space-y-2">
                        <Label for="current_password">Current Password</Label>
                        <Input
                            id="current_password"
                            type="password"
                            v-model="passwordForm.current_password"
                            autocomplete="current-password"
                            placeholder="Enter your current password"
                            class="max-w-2xl"
                            :class="{ 'border-destructive focus-visible:ring-destructive': passwordForm.errors.current_password }"
                        />
                        <p v-if="passwordForm.errors.current_password" class="text-sm font-medium text-destructive">
                            {{ passwordForm.errors.current_password }}
                        </p>
                    </div>

                    <div class="space-y-2">
                        <Label for="new_password">New Password</Label>
                        <Input
                            id="new_password"
                            type="password"
                            v-model="passwordForm.new_password"
                            autocomplete="new-password"
                            placeholder="Enter your new password"
                            class="max-w-2xl"
                            :class="{ 'border-destructive focus-visible:ring-destructive': passwordForm.errors.new_password }"
                        />
                        <p v-if="passwordForm.errors.new_password" class="text-sm font-medium text-destructive">
                            {{ passwordForm.errors.new_password }}
                        </p>
                    </div>

                    <div class="space-y-2">
                        <Label for="new_password_confirmation">Confirm New Password</Label>
                        <Input
                            id="new_password_confirmation"
                            type="password"
                            v-model="passwordForm.new_password_confirmation"
                            autocomplete="new-password"
                            placeholder="Confirm your new password"
                            class="max-w-2xl"
                            :class="{ 'border-destructive focus-visible:ring-destructive': passwordForm.errors.new_password_confirmation }"
                        />
                    </div>
                  

                    <div class="flex items-center gap-4 pt-4">
                        <Button type="submit" :disabled="passwordForm.processing">
                            Update Password
                        </Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
