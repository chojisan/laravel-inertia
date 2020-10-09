<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Categories
      </h2>
    </template>

    <div class="my-6 px-4 sm:px-6 lg:px-8">
      <div class="mt-3 flex justify-between items-center">
        <search-filter
          v-model="form.search"
          class="w-full max-w-md mr-4"
          @reset="reset"
        >
          <div class="relative">
            <select
              v-model="form.perPage"
              class="appearance-none h-full rounded-l block appearance-none w-full bg-white text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            >
              <option>10</option>
              <option>20</option>
            </select>

            <div
              class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
            >
              <icon name="chevron-down" class="h-4 w-4" />
            </div>
          </div>
        </search-filter>
        <link-button :link="route('cms.categories.create')">
          <span>Create Category</span>
        </link-button>
      </div>

      <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
          <table class="min-w-full bg-white leading-normal">
            <thead>
              <tr class="text-left font-bold">
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                >
                  Name
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                >
                  Slug
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                >
                  Parent
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                  colspan="2"
                >
                  Image
                </th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="category in categories.data"
                :key="category.id"
                class="hover:bg-gray-100 focus-within:bg-gray-100"
              >
                <td class="border-b border-gray-200 text-sm">
                  <inertia-link
                    class="px-5 py-5 flex items-center"
                    :href="route('cms.categories.edit', category.id)"
                  >
                    {{ category.name }}
                  </inertia-link>
                </td>
                <td class="border-b border-gray-200 text-sm">
                  <inertia-link
                    class="px-5 py-5 flex items-center"
                    :href="route('cms.categories.edit', category.id)"
                    tabindex="-1"
                  >
                    {{ category.slug }}
                  </inertia-link>
                </td>
                <td class="border-b border-gray-200 text-sm">
                  <inertia-link
                    class="px-5 py-5 flex items-center"
                    :href="route('cms.categories.edit', category.id)"
                    tabindex="-1"
                  >
                    {{ category.parent_id }}
                  </inertia-link>
                </td>
                <td class="border-b border-gray-200 text-sm">
                  <inertia-link
                    class="px-5 py-5 flex items-center"
                    :href="route('cms.categories.edit', category.id)"
                    tabindex="-1"
                  >
                    {{ category.image }}
                  </inertia-link>
                </td>
                <td class="border-b border-gray-200 text-sm w-px">
                  <inertia-link
                    class="py-5 px-5 flex items-center"
                    :href="route('cms.categories.edit', category.id)"
                    tabindex="-1"
                  >
                    <icon
                      name="chevron-right"
                      class="block w-6 h-6 fill-gray-400"
                    />
                  </inertia-link>
                </td>
              </tr>
              <tr v-if="categories.data.length === 0">
                <td
                  class="px-5 py-5 border-b border-gray-200 text-center items-center text-sm"
                  colspan="5"
                >
                  No categories found.
                </td>
              </tr>
            </tbody>
          </table>

          <div
            class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between"
          >
            <div class="inline-flex mt-2 xs:mt-0">
              <pagination :links="categories.links" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import Icon from "@/Shared/Icon";
import AppLayout from "@/Layouts/AppLayout";
import mapValues from "lodash/mapValues";
import Pagination from "@/Shared/NewPagination";
import pickBy from "lodash/pickBy";
import SearchFilter from "@/Shared/SearchFilter";
import LinkButton from "@/Shared/LinkButton";
import throttle from "lodash/throttle";

export default {
  metaInfo: { title: "Categories" },
  components: {
    Icon,
    Pagination,
    AppLayout,
    LinkButton,
    SearchFilter
  },
  props: {
    categories: Object,
    filters: Object,
    perPage: Number
  },
  data() {
    return {
      form: {
        search: this.filters.search
        //trashed: this.filters.trashed,
        //perPage: this.perPage
      }
    };
  },
  watch: {
    form: {
      handler: throttle(function() {
        let query = pickBy(this.form);
        this.$inertia.replace(
          this.route(
            "cms.categories.index",
            Object.keys(query).length ? query : { remember: "forget" }
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
