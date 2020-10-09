<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('crm.organizations.index')"
          >Organizations</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span> Create
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <organization-form
          title="Create Organization"
          description="Create organization description."
          :form="form"
          @submit="submit"
        />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import OrganizationForm from "./OrginizationForm";

export default {
  metaInfo: { title: "Create Organization" },
  components: {
    AppLayout,
    OrganizationForm
  },
  props: {
    errors: Object
  },
  //remember: "form",
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        name: null,
        email: null,
        phone: null,
        address: null,
        city: null,
        region: null,
        country: null,
        postal_code: null
      })
    };
  },
  methods: {
    submit(form) {
      this.sending = true;
      this.$inertia
        .post(this.route("crm.organizations.store"), form)
        .then(() => (this.sending = false));
    }
  }
};
</script>
