<template>
  <jet-action-section>
    <template #title>
      Delete Article
    </template>

    <template #description>
      Permanently delete this article.
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a article is deleted, all of its resources and data will be
        permanently deleted.
      </div>

      <div class="mt-5">
        <jet-danger-button @click.native="confirmArticleDeletion">
          Delete Article
        </jet-danger-button>
      </div>

      <!-- Delete Article Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingArticleDeletion"
        @close="confirmingArticleDeletion = false"
      >
        <template #title>
          Delete Article
        </template>

        <template #content>
          Are you sure you want to delete this article? Once a article is
          deleted, all of its resources and data will be permanently deleted.
        </template>

        <template #footer>
          <jet-secondary-button
            @click.native="confirmingArticleDeletion = false"
          >
            Nevermind
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click.native="deleteArticle"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Article
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
  props: ["article"],

  components: {
    JetActionSection,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton
  },

  data() {
    return {
      confirmingArticleDeletion: false,
      deleting: false,

      form: this.$inertia.form({
        //
      })
    };
  },

  methods: {
    confirmArticleDeletion() {
      this.confirmingArticleDeletion = true;
    },
    deleteArticle() {
      this.form.delete(route("cms.articles.destroy", this.article.id), {
        preserveScroll: true
      });
    }
  }
};
</script>
