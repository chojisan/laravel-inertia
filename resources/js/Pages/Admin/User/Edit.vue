<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('admin.users.index')"
          >Users</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.full_name }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <user-form
          title="Edit User"
          description="Edit user description."
          :form="form"
          @submit="submit"
          :permissions="permissions"
        />

        <jet-section-border />

        <delete-user-form class="mt-10 sm:mt-0" :user="user" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TrashedMessage from "@/Shared/TrashedMessage";
import UserForm from "./UserForm";
import DeleteUserForm from "./DeleteUserForm";
import JetSectionBorder from "@/Jetstream/SectionBorder";

export default {
  metaInfo() {
    return {
      title: `${this.form.full_name}`
    };
  },
  components: {
    AppLayout,
    TrashedMessage,
    UserForm,
    DeleteUserForm,
    JetSectionBorder
  },
  props: {
    errors: Object,
    user: Object,
    permissions: Array
  },
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        _method: "PUT",
        name: this.user.name,
        guard_name: this.user.guard_name,
        permissions: this.user.permissions
      })
    };
  },
  methods: {
    submit(form) {
      this.sending = true;
      this.form
        .put(this.route("admin.users.update", this.user.id), form, {
          preserveState: true
        })
        .then(() => (this.sending = false));
    }
  }
};
</script>
