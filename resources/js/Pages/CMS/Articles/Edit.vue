<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('cms.articles.index')"
          >Articles</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.title }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <article-form
          title="Edit Article"
          description="Edit article description."
          :form="form"
          @submit="submit"
          :categories="categories"
          :tags="tags"
          :options="options"
        />

        <jet-section-border />

        <delete-article-form class="mt-10 sm:mt-0" :article="article" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TrashedMessage from "@/Shared/TrashedMessage";
import ArticleForm from "./ArticleForm";
import DeleteArticleForm from "./DeleteArticleForm";
import JetSectionBorder from "@/Jetstream/SectionBorder";

export default {
  metaInfo() {
    return {
      title: `${this.form.title}`
    };
  },
  components: {
    AppLayout,
    TrashedMessage,
    ArticleForm,
    DeleteArticleForm,
    JetSectionBorder
  },
  props: {
    errors: Object,
    article: Object,
    categories: Array,
    tags: Array,
    options: Array
  },
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        _method: "PUT",
        title: this.article.title,
        featured: this.article.featured,
        short_description: this.article.short_description,
        description: this.article.description,
        category_id: this.article.category_id,
        tags: this.article.tags,
        image: this.article.image,
        meta_description: this.article.meta_description,
        meta_keywords: this.article.meta_keywords,
        status: this.article.status,
        article_image_path: this.article.article_image_path
      })
    };
  },
  methods: {
    submit(form) {
      this.sending = true;
      this.form
        .put(this.route("cms.articles.update", this.article.id), form, {
          preserveState: true
        })
        .then(() => (this.sending = false));
    }
  }
};
</script>
