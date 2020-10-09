<template>
  <jet-action-section>
    <template #title>
      Delete Contact
    </template>

    <template #description>
      Temporarily delete this contact.
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        This will temporarily delete the contact. You can still restore this
        contact.
      </div>

      <div class="mt-5">
        <jet-danger-button @click.native="confirmContactDeletion">
          Delete Contact
        </jet-danger-button>
      </div>

      <!-- Delete Contact Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingContactDeletion"
        @close="confirmingContactDeletion = false"
      >
        <template #title>
          Delete Contact
        </template>

        <template #content>
          Are you sure you want to temporarily delete this contact? Once a
          contact is deleted, you can still restore this by clicking restore
          button.
        </template>

        <template #footer>
          <jet-secondary-button
            @click.native="confirmingContactDeletion = false"
          >
            Nevermind
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click.native="deleteContact"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Contact
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>
    </template>
  </jet-action-section>
</template>

<script>
import JetActionSection from "./../../Jetstream/ActionSection";
import JetButton from "./../../Jetstream/Button";
import JetConfirmationModal from "./../../Jetstream/ConfirmationModal";
import JetDangerButton from "./../../Jetstream/DangerButton";
import JetSecondaryButton from "./../../Jetstream/SecondaryButton";

export default {
  props: ["contact"],

  components: {
    JetActionSection,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton
  },

  data() {
    return {
      confirmingContactDeletion: false,
      deleting: false,

      form: this.$inertia.form({
        //
      })
    };
  },

  methods: {
    confirmContactDeletion() {
      this.confirmingContactDeletion = true;
    },
    deleteContact() {
      this.form.delete(this.route("contacts.destroy", this.contact.id), {
        preserveScroll: true
      });
    }
  }
};
</script>
