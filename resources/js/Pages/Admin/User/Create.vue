<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('admin.users.index')"
          >Users</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span> Create
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <user-form
          title="Create User"
          description="Create user description."
          :form="form"
          @submit="submit"
        />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import UserForm from "./UserForm";

export default {
  metaInfo: { title: "Create User" },
  components: {
    AppLayout,
    UserForm
  },
  props: {
    errors: Object
  },
  // remember: "form",
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        username: null,
        slug: null,
        first_name: null,
        middle_name: null,
        last_name: null,
        email: null,
        name_extension: null,
        gender: null,
        birth_date: null,
        password: null,
        confirm_password: null,
        mobile_number: null,
        phone_number: null,
        is_active: null,
        is_superuser: null,
        is_staff: null
      })
    };
  },
  methods: {
    submit(form) {
      this.sending = true;
      this.form
        .post(this.route("admin.users.store"), form, { preserveState: true })
        .then(() => (this.sending = false));
    }
  }
};
</script>
