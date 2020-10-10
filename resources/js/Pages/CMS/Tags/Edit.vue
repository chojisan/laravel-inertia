<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('cms.tags.index')"
          >Edit Tags</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.name }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <tag-form
          title="Edit Tag"
          description="Edit tag description."
          :form="form"
          @submit="submit"
        />

        <jet-section-border />

        <delete-tag-form class="mt-10 sm:mt-0" :tag="tag" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TrashedMessage from "@/Shared/TrashedMessage";
import TagForm from "./TagForm";
import DeleteTagForm from "./DeleteTagForm";
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
    TagForm,
    DeleteTagForm,
    JetSectionBorder
  },
  props: {
    errors: Object,
    tag: Object
  },
  // remember: "form",
  data() {
    return {
      confirmingContactRestoration: false,
      restoring: false,
      sending: false,
      form: this.$inertia.form({
        name: this.tag.name
      })
    };
  },
  methods: {
    submit(form) {
      this.sending = true;
      this.$inertia
        .put(this.route("cms.tags.update", this.tag.id), form)
        .then(() => (this.sending = false));
    }
  }
};
</script>
