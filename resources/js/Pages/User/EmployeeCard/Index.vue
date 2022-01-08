<template>
    <Head title="بطاقتي"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                بطاقتي
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                            <template v-if="isCardActive">
                                <span class="bg-green-200 rounded p-1">بطاقتك فعالة</span>
                                <div class="mt-4">
                                    <a v-if="isCardActive" :href="route('employee-cards.download')">
                                        <Button>تحميل البطاقة</Button>
                                    </a>
                                </div>
                            </template>

                            <template v-else-if="isCardRequestPending">
                                <span class="bg-yellow-200 rounded p-1">لقد طلبت بطاقة جديدة </span>
                            </template>

                            <template v-else-if="isCardNotRequested || isCardExpired">
                                <span v-if="isCardExpired" class="bg-yellow-200 rounded p-1">بطاقتك متنهية</span>
                                <span v-if="isCardNotRequested" class="bg-red-200 rounded p-1">لم تستخرج بطاقة بعد</span>
                                <div class="mt-4">
                                    <Link :href="route('card-requests.create')">
                                        <Button>طلب بطاقة</Button>
                                    </Link>
                                </div>
                            </template>

                            <template v-else-if="isCardExpired">
                            </template>
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

const props = defineProps({
    card: Object,
    cardRequest: Object,
});

const isPast = firstDate => firstDate.setHours(0, 0, 0, 0) <= new Date().setHours(0, 0, 0, 0);

const isCardExpired = props.card && isPast(new Date(props.card.expire_at));

const isCardActive = props.card && !isCardExpired;

const isCardRequestPending = props.cardRequest?.status === 'pending';

const isCardNotRequested = !props.card && !props.cardRequest;

</script>
