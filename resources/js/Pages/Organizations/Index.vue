<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Organizations
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-6 flex justify-between items-center">
                    <search-filter
                        v-model="form.search"
                        class="w-full max-w-md mr-4"
                        @reset="reset"
                    >
                        <label class="block text-gray-700">Trashed:</label>
                        <select
                            v-model="form.trashed"
                            class="mt-1 w-full form-select"
                        >
                            <option :value="null" />
                            <option value="with">With Trashed</option>
                            <option value="only">Only Trashed</option>
                        </select>
                    </search-filter>
                    <link-button :link="route('organizations.create')">
                        <span>Create Organization</span>
                    </link-button>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-white rounded shadow overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-6 pb-4">Name</th>
                                <th class="px-6 pt-6 pb-4">City</th>
                                <th class="px-6 pt-6 pb-4" colspan="2">
                                    Phone
                                </th>
                            </tr>
                            <tr
                                v-for="organization in organizations.data"
                                :key="organization.id"
                                class="hover:bg-gray-100 focus-within:bg-gray-100"
                            >
                                <td class="border-t">
                                    <inertia-link
                                        class="px-6 py-4 flex items-center focus:text-indigo-500"
                                        :href="
                                            route(
                                                'organizations.edit',
                                                organization.id
                                            )
                                        "
                                    >
                                        {{ organization.name }}
                                        <icon
                                            v-if="organization.deleted_at"
                                            name="trash"
                                            class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2"
                                        />
                                    </inertia-link>
                                </td>
                                <td class="border-t">
                                    <inertia-link
                                        class="px-6 py-4 flex items-center"
                                        :href="
                                            route(
                                                'organizations.edit',
                                                organization.id
                                            )
                                        "
                                        tabindex="-1"
                                    >
                                        {{ organization.city }}
                                    </inertia-link>
                                </td>
                                <td class="border-t">
                                    <inertia-link
                                        class="px-6 py-4 flex items-center"
                                        :href="
                                            route(
                                                'organizations.edit',
                                                organization.id
                                            )
                                        "
                                        tabindex="-1"
                                    >
                                        {{ organization.phone }}
                                    </inertia-link>
                                </td>
                                <td class="border-t w-px">
                                    <inertia-link
                                        class="px-4 flex items-center"
                                        :href="
                                            route(
                                                'organizations.edit',
                                                organization.id
                                            )
                                        "
                                        tabindex="-1"
                                    >
                                        <icon
                                            name="cheveron-right"
                                            class="block w-6 h-6 fill-gray-400"
                                        />
                                    </inertia-link>
                                </td>
                            </tr>
                            <tr v-if="organizations.data.length === 0">
                                <td class="border-t px-6 py-4" colspan="4">
                                    No organizations found.
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <pagination :links="organizations.links" />
            </div>
        </div>
    </app-layout>
</template>

<script>
import Icon from "./../../Shared/Icon";
import AppLayout from "./../../Layouts/AppLayout";
import mapValues from "lodash/mapValues";
import Pagination from "./../../Shared/Pagination";
import pickBy from "lodash/pickBy";
import SearchFilter from "./../../Shared/SearchFilter";
import LinkButton from "./../../Shared/LinkButton";
import throttle from "lodash/throttle";

export default {
    metaInfo: { title: "Organizations" },
    components: {
        Icon,
        Pagination,
        AppLayout,
        LinkButton,
        SearchFilter
    },
    props: {
        organizations: Object,
        filters: Object
    },
    data() {
        return {
            form: {
                search: this.filters.search,
                trashed: this.filters.trashed
            }
        };
    },
    watch: {
        form: {
            handler: throttle(function() {
                let query = pickBy(this.form);
                this.$inertia.replace(
                    this.route(
                        "organizations",
                        Object.keys(query).length
                            ? query
                            : { remember: "forget" }
                    )
                );
            }, 150),
            deep: true
        }
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null);
        }
    }
};
</script>
