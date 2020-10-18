<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('admin.roles.index')"
          >Roles</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span> Create
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <role-form
          title="Create Role"
          description="Create role description."
          :form="form"
          @submit="submit"
        />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import RoleForm from "./RoleForm";

export default {
  metaInfo: { title: "Create Role" },
  components: {
    AppLayout,
    RoleForm
  },
  props: {
    errors: Object
  },
  // remember: "form",
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        name: null,
        guard_name: null
      })
    };
  },
  methods: {
    submit(form) {
      this.sending = true;
      this.form
        .post(this.route("admin.roles.store"), form, { preserveState: true })
        .then(() => (this.sending = false));
    }
  }
};
</script>
