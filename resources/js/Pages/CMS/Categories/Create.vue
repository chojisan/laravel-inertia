<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('cms.categories.index')"
          >Categories</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span> Create
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <category-form
          title="Create Category"
          description="Create category description."
          :form="form"
          @submit="submit"
          :categories="categories"
        />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import CategoryForm from "./CategoryForm";

export default {
  metaInfo: { title: "Create Category" },
  components: {
    AppLayout,
    CategoryForm
  },
  props: {
    errors: Object,
    categories: Array
  },
  // remember: "form",
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        name: null,
        description: null,
        parent_id: null,
        image: null,
        published: 0,
        category_image_path: null
      })
    };
  },
  methods: {
    submit(form) {
      this.sending = true;
      this.form
        .post(this.route("cms.categories.store"), form)
        .then(() => (this.sending = false));
    }
  }
};
</script>
