<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <inertia-link
                    class="text-indigo-400 hover:text-indigo-600"
                    :href="route('organizations')"
                    >Organizations</inertia-link
                >
                <span class="text-indigo-400 font-medium">/</span> Create
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <organization-form :form="form" />
            </div>
        </div>

        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
                    <form @submit.prevent="submit">
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <text-input
                                v-model="form.name"
                                :error="errors.name"
                                class="pr-6 pb-8 w-full lg:w-1/2"
                                label="Name"
                            />
                            <text-input
                                v-model="form.email"
                                :error="errors.email"
                                class="pr-6 pb-8 w-full lg:w-1/2"
                                label="Email"
                            />
                            <text-input
                                v-model="form.phone"
                                :error="errors.phone"
                                class="pr-6 pb-8 w-full lg:w-1/2"
                                label="Phone"
                            />
                            <text-input
                                v-model="form.address"
                                :error="errors.address"
                                class="pr-6 pb-8 w-full lg:w-1/2"
                                label="Address"
                            />
                            <text-input
                                v-model="form.city"
                                :error="errors.city"
                                class="pr-6 pb-8 w-full lg:w-1/2"
                                label="City"
                            />
                            <text-input
                                v-model="form.region"
                                :error="errors.region"
                                class="pr-6 pb-8 w-full lg:w-1/2"
                                label="Province/State"
                            />
                            <select-input
                                v-model="form.country"
                                :error="errors.country"
                                class="pr-6 pb-8 w-full lg:w-1/2"
                                label="Country"
                            >
                                <option :value="null" />
                                <option value="CA">Canada</option>
                                <option value="US">United States</option>
                            </select-input>
                            <text-input
                                v-model="form.postal_code"
                                :error="errors.postal_code"
                                class="pr-6 pb-8 w-full lg:w-1/2"
                                label="Postal code"
                            />
                        </div>
                        <div
                            class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center"
                        >
                            <jet-button>Create Organization</jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import LoadingButton from "@/Shared/LoadingButton";
import SelectInput from "@/Shared/SelectInput";
import TextInput from "@/Shared/TextInput";
import JetButton from "@/Jetstream/Button";
import OrganizationForm from "./OrginizationForm";

export default {
    metaInfo: { title: "Create Organization" },
    components: {
        LoadingButton,
        SelectInput,
        TextInput,
        AppLayout,
        JetButton,
        OrganizationForm
    },
    props: {
        errors: Object
    },
    //remember: "form",
    data() {
        return {
            sending: false,
            form: this.$inertia.form({
                name: null,
                email: null,
                phone: null,
                address: null,
                city: null,
                region: null,
                country: null,
                postal_code: null
            })
        };
    },
    methods: {
        submit() {
            this.sending = true;
            this.$inertia
                .post(this.route("organizations.store"), this.form)
                .then(() => (this.sending = false));
        }
    }
};
</script>
