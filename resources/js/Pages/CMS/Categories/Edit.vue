<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('cms.categories.index')"
          >Categories</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.name }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <category-form
          title="Edit Category"
          description="Edit category description."
          :form="form"
          @submit="submit"
          :categories="categories"
        />

        <jet-section-border />

        <delete-category-form class="mt-10 sm:mt-0" :category="category" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TrashedMessage from "@/Shared/TrashedMessage";
import CategoryForm from "./CategoryForm";
import DeleteCategoryForm from "./DeleteCategoryForm";
import JetSectionBorder from "@/Jetstream/SectionBorder";

export default {
  metaInfo() {
    return {
      title: `${this.form.name}`
    };
  },
  components: {
    AppLayout,
    TrashedMessage,
    CategoryForm,
    DeleteCategoryForm,
    JetSectionBorder
  },
  props: {
    errors: Object,
    categories: Array,
    category: Object
  },
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        name: this.category.name,
        description: this.category.description,
        parent_id: this.category.parent_id,
        image: this.category.image,
        published: this.category.published,
        category_image_path: this.category.category_image_path
      })
    };
  },
  methods: {
    submit(form) {
      this.sending = true;

      const formData = new FormData();

      formData.append("name", form.name);
      formData.append("description", form.description);
      formData.append("parent_id", form.parent_id);
      formData.append("image", form.image);
      formData.append("published", form.published);

      console.log(formData);
      console.log(form.name);
      console.log(form.image);

      for (var pair of formData.entries()) {
        console.log(pair[0] + ", " + pair[1]);
      }

      this.form
        .put(this.route("cms.categories.update", this.category.id), form, {
          preserveState: true
        })
        .then(() => (this.sending = false));
    }
  }
};
</script>
