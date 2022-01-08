<template>
    <Head title="طلبات البطاقات"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                طلبات البطاقات
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="p-5">
                            <div>
                                <span>الاسم </span>
                                <span>{{cardRequest.name}}</span>
                            </div>
                            <div class="mt-4">
                                <span>رقم الهوية </span>
                                <span>{{cardRequest.national_id}}</span>
                            </div>

                            <div class="mt-4">
                                <span>اسم الجهة </span>
                                <span>{{cardRequest.department_name}}</span>
                            </div>

                            <div class="mt-4">
                                <span>البريد الإلكتروني </span>
                                <span>{{cardRequest.email}}</span>
                            </div>

                            <div class="mt-4">
                                <span>الصورة الشخصية</span>
                                <img class="w-96" :src="cardRequest.photo_url"/>
                            </div>
                            <div v-if="!(user.type === 'HREmployee' && cardRequest.approved_by_HREmployee)" class="flex mt-8 justify-around">
                                <Link :href="route('HREmployee.card-requests.accept', cardRequest)" as="button" method="put">
                                    <Button>موافقة</Button>
                                </Link>
                                <Link :href="route('HREmployee.card-requests.reject', cardRequest)" as="button" method="put">
                                    <Button>رفض</Button>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';
import Button from "@/Components/Button.vue";
import {useUser} from "@/useUser.js";

defineProps({
    cardRequest: Object,
});

const user = useUser();

</script>
