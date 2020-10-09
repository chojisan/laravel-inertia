<template>
  <jet-action-section>
    <template #title>
      Delete Category
    </template>

    <template #description>
      Permanently delete this category.
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a category is deleted, all of its resources and data will be
        permanently deleted.
      </div>

      <div class="mt-5">
        <jet-danger-button @click.native="confirmCategoryDeletion">
          Delete Category
        </jet-danger-button>
      </div>

      <!-- Delete Category Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingCategoryDeletion"
        @close="confirmingCategoryDeletion = false"
      >
        <template #title>
          Delete Category
        </template>

        <template #content>
          Are you sure you want to delete this category? Once a category is
          deleted, all of its resources and data will be permanently deleted.
        </template>

        <template #footer>
          <jet-secondary-button
            @click.native="confirmingCategoryDeletion = false"
          >
            Nevermind
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click.native="deleteCategory"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Category
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
  props: ["category"],

  components: {
    JetActionSection,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton
  },

  data() {
    return {
      confirmingCategoryDeletion: false,
      deleting: false,

      form: this.$inertia.form({
        //
      })
    };
  },

  methods: {
    confirmCategoryDeletion() {
      this.confirmingCategoryDeletion = true;
    },
    deleteCategory() {
      this.form.delete(this.route("cms.categories.destroy", this.category.id), {
        preserveScroll: true
      });
    }
  }
};
</script>
