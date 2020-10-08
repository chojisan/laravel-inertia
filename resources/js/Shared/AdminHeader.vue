<template>
    <header
        class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-indigo-600"
    >
        <div class="flex items-center">
            <button
                @click="sidebarOpen = true"
                class="text-gray-500 focus:outline-none lg:hidden"
            >
                <svg
                    class="h-6 w-6"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M4 6H20M4 12H20M4 18H11"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </button>

            <div class="relative mx-4 lg:mx-0">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <icon name="search" class="h-5 w-5 text-gray-500" />
                </span>

                <input
                    class="form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600"
                    type="text"
                    placeholder="Search"
                />
            </div>
        </div>

        <div class="flex items-center">
            <nav>
                <!-- Primary Navigation Menu -->
                <div>
                    <div class="flex justify-between">
                        <!-- Settings Dropdown -->
                        <div class="sm:flex sm:items-center">
                            <div class="ml-3 relative">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out"
                                        >
                                            <img
                                                class="h-8 w-8 rounded-full"
                                                :src="
                                                    $page.user.profile_photo_url
                                                "
                                                alt
                                            />
                                        </button>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400"
                                        >
                                            Manage Account
                                        </div>

                                        <jet-dropdown-link href="/user/profile"
                                            >Profile</jet-dropdown-link
                                        >

                                        <jet-dropdown-link
                                            href="/user/api-tokens"
                                            v-if="
                                                $page.jetstream.hasApiFeatures
                                            "
                                            >API Tokens</jet-dropdown-link
                                        >

                                        <div
                                            class="border-t border-gray-100"
                                        ></div>

                                        <!-- Team Management -->
                                        <template
                                            v-if="
                                                $page.jetstream.hasTeamFeatures
                                            "
                                        >
                                            <div
                                                class="block px-4 py-2 text-xs text-gray-400"
                                            >
                                                Manage Team
                                            </div>

                                            <!-- Team Settings -->
                                            <jet-dropdown-link
                                                :href="
                                                    '/teams/' +
                                                        $page.user.current_team
                                                            .id
                                                "
                                                >Team
                                                Settings</jet-dropdown-link
                                            >

                                            <jet-dropdown-link
                                                href="/teams/create"
                                                v-if="
                                                    $page.jetstream
                                                        .canCreateTeams
                                                "
                                                >Create New
                                                Team</jet-dropdown-link
                                            >

                                            <div
                                                class="border-t border-gray-100"
                                            ></div>

                                            <!-- Team Switcher -->
                                            <div
                                                class="block px-4 py-2 text-xs text-gray-400"
                                            >
                                                Switch Teams
                                            </div>

                                            <template
                                                v-for="team in $page.user
                                                    .all_teams"
                                            >
                                                <form
                                                    @submit.prevent="
                                                        switchToTeam(team)
                                                    "
                                                >
                                                    <jet-dropdown-link
                                                        as="button"
                                                    >
                                                        <div
                                                            class="flex items-center"
                                                        >
                                                            <svg
                                                                v-if="
                                                                    team.id ==
                                                                        $page
                                                                            .user
                                                                            .current_team_id
                                                                "
                                                                class="mr-2 h-5 w-5 text-green-400"
                                                                fill="none"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                />
                                                            </svg>
                                                            <div>
                                                                {{ team.name }}
                                                            </div>
                                                        </div>
                                                    </jet-dropdown-link>
                                                </form>
                                            </template>

                                            <div
                                                class="border-t border-gray-100"
                                            ></div>
                                        </template>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button"
                                                >Logout</jet-dropdown-link
                                            >
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
import JetDropdown from "@/Jetstream/Dropdown";
import JetNavLink from "@/Jetstream/NavLink";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import Icon from "@/Shared/Icon";

export default {
    components: {
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        Icon
    },
    data() {
        return {
            showingNavigationDropdown: false,
            sidebarOpen: false
        };
    },
    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                "/current-team",
                {
                    team_id: team.id
                },
                {
                    preserveState: false
                }
            );
        },

        logout() {
            axios.post("/logout").then(response => {
                window.location = "/";
            });
        }
    }
};
</script>

<style></style>
