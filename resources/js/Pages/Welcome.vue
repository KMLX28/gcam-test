<template>
    <Head title="Welcome"/>

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto my-auto p-5 border-b border-indigo-400 bg-indigo-100 rounded text-indigo-800">
            <div v-if="$page.props.auth.user" class="grid gap-4">
                <Link  :href="route('dashboard')" class="text-sm text-gray-700 underline">
                    <Button>
                        الرئيسية
                    </Button>
                </Link>
            </div>

            <div v-if="!$page.props.auth.user" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <Link  :href="route('login')" class="text-sm text-gray-700 mx-auto">
                    <Button>
                        دخول
                    </Button>
                </Link>

                <Link :href="route('register')" class="text-sm text-gray-700 mx-auto">
                    <Button>
                        تسجيل
                    </Button>
                </Link>
            </div>
        </div>
    </div>


</template>

<style scoped>
</style>

<script setup>
import {Head, Link, usePage} from '@inertiajs/inertia-vue3';
import Button from "@/Components/Button.vue";

const page = usePage();
</script>
