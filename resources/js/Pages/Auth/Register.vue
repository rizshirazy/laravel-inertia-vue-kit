<script setup lang="ts">
import { useForm, Head, Link } from '@inertiajs/vue3';
import GuestLayout from '../Layouts/GuestLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';

defineOptions({
    layout: GuestLayout,
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <Head title="Register" />

    <Card class="border-none shadow-none bg-transparent">
        <CardHeader class="p-0 mb-8">
            <CardTitle class="text-3xl font-bold">Create an account</CardTitle>
            <CardDescription class="text-base text-muted-foreground">
                Enter your details below to create your account.
            </CardDescription>
        </CardHeader>

        <CardContent class="p-0">
            <form @submit.prevent="submit" class="space-y-6">
                <div class="space-y-2">
                    <Label for="name">Full Name</Label>
                    <Input
                        id="name"
                        type="text"
                        placeholder="Enter your name"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                        :class="{ 'border-destructive focus-visible:ring-destructive': form.errors.name }"
                    />
                    <p v-if="form.errors.name" class="text-sm font-medium text-destructive">
                        {{ form.errors.name }}
                    </p>
                </div>

                <div class="space-y-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        placeholder="Enter your email"
                        v-model="form.email"
                        required
                        autocomplete="username"
                        :class="{ 'border-destructive focus-visible:ring-destructive': form.errors.email }"
                    />
                    <p v-if="form.errors.email" class="text-sm font-medium text-destructive">
                        {{ form.errors.email }}
                    </p>
                </div>

                    <div class="space-y-2">
                        <Label for="password">Password</Label>
                        <Input
                            id="password"
                            type="password"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                            :class="{ 'border-destructive focus-visible:ring-destructive': form.errors.password }"
                        />
                    </div>
                    <div class="space-y-2">
                        <Label for="password_confirmation">Confirm Password</Label>
                        <Input
                            id="password_confirmation"
                            type="password"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                            :class="{ 'border-destructive focus-visible:ring-destructive': form.errors.password_confirmation }"
                        />
                    </div>
                    <div v-if="form.errors.password || form.errors.password_confirmation" class="col-span-full">
                        <p class="text-sm font-medium text-destructive">
                            {{ form.errors.password || form.errors.password_confirmation }}
                        </p>
                    </div>

                <Button type="submit" class="w-full" :disabled="form.processing">
                    <template v-if="form.processing">Creating account...</template>
                    <template v-else>Register</template>
                </Button>
            </form>
        </CardContent>

        <CardFooter class="p-0 mt-8 flex flex-col space-y-4">
            <div class="relative w-full">
                <div class="absolute inset-0 flex items-center">
                    <span class="w-full border-t" />
                </div>
                <div class="relative flex justify-center text-xs uppercase">
                    <span class="bg-background px-2 text-muted-foreground">
                        Or join with
                    </span>
                </div>
            </div>

            <Button variant="outline" type="button" class="w-full">
                <svg class="mr-2 h-4 w-4" viewBox="0 0 24 24">
                    <path
                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                        fill="#4285F4"
                    />
                    <path
                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                        fill="#34A853"
                    />
                    <path
                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.26.81-.58z"
                        fill="#FBBC05"
                    />
                    <path
                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 12-4.53z"
                        fill="#EA4335"
                    />
                </svg>
                Google
            </Button>

            <p class="text-center text-sm text-muted-foreground">
                Already have an account?
                <Link :href="route('login')" class="font-medium text-primary hover:underline underline-offset-4">
                    Log in
                </Link>
            </p>
        </CardFooter>
    </Card>
</template>
