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
                        <a :href="route('HREmployee.card-requests.export')">
                            <Button class="mb-6">
                                تحميل Excel
                            </Button>
                        </a>
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الهوية</th>
                                    <th>قرار الموظفين</th>
                                    <th>قرار المديرين</th>
                                    <th>الحالة</th>
                                </tr>
                            </thead>
                            <tbody class=" text-center">
                                <tr v-for="request in cardRequests.data" :key="request.id">
                                    <td>{{ request.id }}</td>
                                    <td>{{ request.user.name }}</td>
                                    <td>{{ request.national_id }}</td>
                                    <td :class="statusClass(request.approved_by_HREmployee)">{{ status(request.approved_by_HREmployee) }}</td>
                                    <td :class="statusClass(request.approved_by_HRManager)">{{ status(request.approved_by_HRManager) }}</td>
                                    <td :class="statusClass(request.status)">{{ status(request.status) }}</td>
                                    <td>
                                        <InertiaLink v-if="request.status === 'pending'"
                                                     :href="route('HREmployee.card-requests.show', request)">
                                            <Button>عرض</Button>
                                        </InertiaLink>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination class="mt-6" :links="cardRequests.links"/>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head, InertiaLink} from '@inertiajs/inertia-vue3';
import Pagination from "@/Components/Pagination.vue";
import Button from "@/Components/Button.vue";
import {status} from "@/helpers.js";
import {statusClass} from "@/helpers.js";


defineProps({
    cardRequests: Object,
});


</script>
