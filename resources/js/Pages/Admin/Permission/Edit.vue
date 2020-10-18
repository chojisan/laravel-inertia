<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('admin.permissions.index')"
          >Permissions</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.name }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <permission-form
          title="Edit Permission"
          description="Edit permission description."
          :form="form"
          @submit="submit"
        />

        <jet-section-border />

        <delete-permission-form
          class="mt-10 sm:mt-0"
          :permission="permission"
        />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TrashedMessage from "@/Shared/TrashedMessage";
import PermissionForm from "./PermissionForm";
import DeletePermissionForm from "./DeletePermissionForm";
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
    PermissionForm,
    DeletePermissionForm,
    JetSectionBorder
  },
  props: {
    errors: Object,
    permission: Object
  },
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        _method: "PUT",
        name: this.permission.name,
        guard_name: this.permission.guard_name
      })
    };
  },
  methods: {
    submit(form) {
      this.sending = true;
      this.form
        .put(this.route("admin.permissions.update", this.permission.id), form, {
          preserveState: true
        })
        .then(() => (this.sending = false));
    }
  }
};
</script>
