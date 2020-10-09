<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('contacts')"
          >Contacts</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span> Create
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <contact-form
          title="Create Contact"
          description="Create contact description."
          :form="form"
          @submit="submit"
          :organizations="organizations"
        />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import ContactForm from "./ContactForm";

export default {
  metaInfo: { title: "Create Contact" },
  components: {
    AppLayout,
    ContactForm
  },
  props: {
    errors: Object,
    organizations: Array
  },
  // remember: "form",
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        first_name: null,
        last_name: null,
        organization_id: null,
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
        .post(this.route("contacts.store"), form)
        .then(() => (this.sending = false));
    }
  }
};
</script>
