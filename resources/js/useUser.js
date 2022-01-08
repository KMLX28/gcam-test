import {usePage} from "@inertiajs/inertia-vue3";

export const useUser = () => usePage().props.value.auth.user;

