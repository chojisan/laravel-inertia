<template>
  <jet-action-section>
    <template #title>
      Delete Role
    </template>

    <template #description>
      Permanently delete this role.
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a role is deleted, all of its resources, associated permissions and
        data will be permanently deleted.
      </div>

      <div class="mt-5">
        <jet-danger-button @click.native="confirmRoleDeletion">
          Delete Role
        </jet-danger-button>
      </div>

      <!-- Delete Role Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingRoleDeletion"
        @close="confirmingRoleDeletion = false"
      >
        <template #title>
          Delete Role
        </template>

        <template #content>
          Are you sure you want to delete this role? Once a role is deleted, all
          of its resources, associated permissions and data will be permanently
          deleted.
        </template>

        <template #footer>
          <jet-secondary-button @click.native="confirmingRoleDeletion = false">
            Nevermind
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click.native="deleteRole"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Role
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>
    </template>
  </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection";
import JetButton from "@/Jetstream/Button";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
  props: ["role"],

  components: {
    JetActionSection,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton
  },

  data() {
    return {
      confirmingRoleDeletion: false,
      deleting: false,

      form: this.$inertia.form({
        //
      })
    };
  },

  methods: {
    confirmRoleDeletion() {
      this.confirmingRoleDeletion = true;
    },
    deleteRole() {
      this.form.delete(this.route("admin.roles.destroy", this.role.id), {
        preserveScroll: true
      });
    }
  }
};
</script>
