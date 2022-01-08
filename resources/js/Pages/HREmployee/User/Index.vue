<template>
    <Head title="المستخدمون" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                المستخدمون
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>رقم الجوال</th>
                                    <th>رقم الهوية</th>
                                    <th>الحالة</th>
                                </tr>
                            </thead>
                            <tbody class=" text-center">
                                <tr v-for="user in users.data" :key="user.id">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td :class="{'bg-green-200' : user.email_verified_at, 'bg-red-200': !user.email_verified_at}">{{ user.email }}</td>
                                    <td>{{ user.mobile }}</td>
                                    <td>{{ user.national_id }}</td>
                                    <td :class="{'bg-green-200' : user.approved_by, 'bg-red-200': !user.approved_by}">
                                        {{ user.approved_by ? 'مصرح' : 'غير مصرح' }}
                                    </td>
                                    <td>
                                        <InertiaLink v-if="!user.approved_by" as="button" :href="route('HREmployee.users.approve', user)" method="put">
                                            <Button>موافقة</Button>
                                        </InertiaLink>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination class="mt-6" :links="users.links" />

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, InertiaLink } from '@inertiajs/inertia-vue3';
import Pagination from "@/Components/Pagination.vue";
import Button from "@/Components/Button.vue";

defineProps({
    users: Object,
});

</script>
