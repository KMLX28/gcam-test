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
                    <div class="p-6 bg-white border-b border-gray-200 md:w-1/2">
                        <validation-errors class="mb-4"/>

                        <form @submit.prevent="submit">
                            <div class="mt-4">
                                <Label for="name" value="الاسم"/>
                                <Input id="name"
                                       type="text"
                                       class="mt-1 block w-full"
                                       v-model="form.name"
                                       required
                                       autocomplete="name"/>
                            </div>
                            <div class="mt-4">
                                <Label for="email" value="البريد الإلكتروني"/>
                                <Input id="email"
                                       type="text"
                                       class="mt-1 block w-full"
                                       v-model="form.email"
                                       required
                                       autocomplete="email"/>
                            </div>
                            <div class="mt-4">
                                <Label for="department_name" value="اسم الجهة"/>
                                <Input id="department_name"
                                       type="text"
                                       class="mt-1 block w-full"
                                       v-model="form.department_name"
                                       required
                                       autocomplete="department_name"/>
                            </div>
                            <div class="mt-4">
                                <Label for="national_id" value="رقم الهوية"/>
                                <Input id="national_id"
                                       type="number"
                                       class="mt-1 block w-full"
                                       v-model="form.national_id"
                                       required
                                       autocomplete="national_id"/>
                            </div>
                            <div class="mt-4">
                                <Label value="الصورة الشخصية"/>
                                <input
                                    type="file"
                                    @change="imageUrl"
                                    ref="photo"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                />
                                <img
                                    v-if="photoUrl"
                                    :src="photoUrl"
                                    class="w-full mt-4 rounded"
                                />
                            </div>

                            <div class="flex justify-end mt-4">
                                <Button class="mx-4"
                                        :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                    طلب
                                </Button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import {ref} from "vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import Button from "@/Components/Button.vue";

const form = useForm({
    name: '',
    email: '',
    department_name: '',
    national_id: '',
    photo: ''
});

const photo = ref(null);
const photoUrl = ref(null);

const imageUrl = (e) => {
    const file = e.target.files[0];
    photoUrl.value = URL.createObjectURL(file);
};

const submit = () => {
    form.photo = photo.value.files[0];

    form.post(route('card-requests.store'));
};

</script>
