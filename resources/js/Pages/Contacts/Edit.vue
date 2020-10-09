<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('contacts')"
          >Edit Contacts</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.first_name }} {{ form.last_name }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <trashed-message
          v-if="contact.deleted_at"
          class="mb-6"
          @click.native="confirmContactRestoration"
        >
          This contact has been deleted.
        </trashed-message>

        <contact-form
          title="Edit Contact"
          description="Edit contact description."
          :form="form"
          @submit="submit"
          :organizations="organizations"
        />

        <jet-section-border />

        <delete-contact-form class="mt-10 sm:mt-0" :contact="contact" />

        <!-- Restore Contact Confirmation Modal -->
        <jet-confirmation-modal
          :show="confirmingContactRestoration"
          @close="confirmingContactRestoration = false"
        >
          <template #title>
            Restore Contact
          </template>

          <template #content>
            Are you sure you want to restore this contact?
          </template>

          <template #footer>
            <jet-secondary-button
              @click.native="confirmingContactRestoration = false"
            >
              Nevermind
            </jet-secondary-button>

            <jet-button
              class="ml-2"
              @click.native="restoreContact"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Restore Contact
            </jet-button>
          </template>
        </jet-confirmation-modal>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import TrashedMessage from "./../../Shared/TrashedMessage";
import ContactForm from "./ContactForm";
import DeleteContactForm from "./DeleteContactForm";
import JetSectionBorder from "./../../Jetstream/SectionBorder";
import JetConfirmationModal from "./../../Jetstream/ConfirmationModal";
import JetDangerButton from "./../../Jetstream/DangerButton";
import JetSecondaryButton from "./../../Jetstream/SecondaryButton";
import JetButton from "./../../Jetstream/Button";

export default {
  metaInfo() {
    return {
      title: `${this.form.first_name} ${this.form.last_name}`
    };
  },
  components: {
    AppLayout,
    TrashedMessage,
    ContactForm,
    DeleteContactForm,
    JetSectionBorder,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
    JetButton
  },
  props: {
    errors: Object,
    contact: Object,
    organizations: Array
  },
  // remember: "form",
  data() {
    return {
      confirmingContactRestoration: false,
      restoring: false,
      sending: false,
      form: this.$inertia.form({
        first_name: this.contact.first_name,
        last_name: this.contact.last_name,
        organization_id: this.contact.organization_id,
        email: this.contact.email,
        phone: this.contact.phone,
        address: this.contact.address,
        city: this.contact.city,
        region: this.contact.region,
        country: this.contact.country,
        postal_code: this.contact.postal_code
      })
    };
  },
  methods: {
    submit() {
      this.sending = true;
      this.$inertia
        .put(this.route("contacts.update", this.contact.id), this.form)
        .then(() => (this.sending = false));
    },
    confirmContactRestoration() {
      this.confirmingContactRestoration = true;
    },
    restoreContact() {
      this.form
        .put(this.route("contacts.restore", this.contact.id), {
          preserveScroll: true
        })
        .then(() => (this.confirmingContactRestoration = false));
    }
  }
};
</script>
