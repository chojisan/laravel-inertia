<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('cms.tags.index')"
          >Tags</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span> Create
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <tag-form
          title="Create Tag"
          description="Create tag description."
          :form="form"
          @submit="submit"
        />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TagForm from "./TagForm";

export default {
  metaInfo: { title: "Create Tag" },
  components: {
    AppLayout,
    TagForm
  },
  props: {
    errors: Object
  },
  // remember: "form",
  data() {
    return {
      sending: false,
      form: this.$inertia.form(
        {
          name: null
        },
        {
          bag: "submit",
          resetOnSuccess: false
        }
      )
    };
  },
  methods: {
    submit(form) {
      this.sending = true;
      form
        .post(route("cms.tags.store"), { preserveState: true })
        .then(() => (this.sending = false));
    }
  }
};
</script>
