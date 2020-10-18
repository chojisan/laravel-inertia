<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('admin.roles.index')"
          >Roles</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.name }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <role-form
          title="Edit Role"
          description="Edit role description."
          :form="form"
          @submit="submit"
          :permissions="permissions"
        />

        <jet-section-border />

        <delete-role-form class="mt-10 sm:mt-0" :role="role" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TrashedMessage from "@/Shared/TrashedMessage";
import RoleForm from "./RoleForm";
import DeleteRoleForm from "./DeleteRoleForm";
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
    RoleForm,
    DeleteRoleForm,
    JetSectionBorder
  },
  props: {
    errors: Object,
    role: Object,
    permissions: Array
  },
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        _method: "PUT",
        name: this.role.name,
        guard_name: this.role.guard_name,
        permissions: this.role.permissions
      })
    };
  },
  methods: {
    submit(form) {
      this.sending = true;
      this.form
        .put(this.route("admin.roles.update", this.role.id), form, {
          preserveState: true
        })
        .then(() => (this.sending = false));
    }
  }
};
</script>
