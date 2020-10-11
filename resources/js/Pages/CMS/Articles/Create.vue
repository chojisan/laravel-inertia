<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('cms.articles.index')"
          >Articles</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span> Create
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <article-form
          title="Create Article"
          description="Create article description."
          :form="form"
          @submit="submit"
          :categories="categories"
          :tags="tags"
          :options="options"
        />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ArticleForm from "./ArticleForm";

export default {
  metaInfo: { title: "Create Article" },
  components: {
    AppLayout,
    ArticleForm
  },
  props: {
    errors: Object,
    categories: Array,
    tags: Array,
    options: Array
  },
  // remember: "form",
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        title: null,
        featured: null,
        short_description: null,
        description: null,
        category_id: null,
        tags: [],
        image: null,
        meta_description: null,
        meta_keywords: null,
        status: null,
        article_image_path: null
      })
    };
  },
  methods: {
    submit(form) {
      this.sending = true;
      this.form
        .post(this.route("cms.articles.store"), form, { preserveState: true })
        .then(() => (this.sending = false));
    }
  }
};
</script>
