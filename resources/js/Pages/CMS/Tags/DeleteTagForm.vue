<template>
  <jet-action-section>
    <template #title>
      Delete Tag
    </template>

    <template #description>
      Permanently delete this tag.
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a tag is deleted, all of its resources and data will be permanently
        deleted.
      </div>

      <div class="mt-5">
        <jet-danger-button @click.native="confirmTagDeletion">
          Delete Tag
        </jet-danger-button>
      </div>

      <!-- Delete Tag Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingTagDeletion"
        @close="confirmingTagDeletion = false"
      >
        <template #title>
          Delete Tag
        </template>

        <template #content>
          Are you sure you want to delete this tag? Once a tag is deleted, all
          of its resources and data will be permanently deleted.
        </template>

        <template #footer>
          <jet-secondary-button @click.native="confirmingTagDeletion = false">
            Nevermind
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click.native="deleteTag"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Tag
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
  props: ["tag"],

  components: {
    JetActionSection,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton
  },

  data() {
    return {
      confirmingTagDeletion: false,
      deleting: false,

      form: this.$inertia.form({
        //
      })
    };
  },

  methods: {
    confirmTagDeletion() {
      this.confirmingTagDeletion = true;
    },
    deleteTag() {
      this.form.delete(this.route("cms.tags.destroy", this.tag.id), {
        preserveScroll: true
      });
    }
  }
};
</script>
