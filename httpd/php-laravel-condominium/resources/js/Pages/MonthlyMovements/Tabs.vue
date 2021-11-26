<template>
    <div>
        <page-header> Movimientos Mensuales </page-header>
        <div class="flex space-x-2">
            <Link class="btn btn-primary" :href="route('monthly-movements')">
                Ver todas
            </Link>
        </div>

        <div class="panel mt-6">
            <div id="dynamic-component-demo" class="demo">
                <button
                    v-for="tab in tabs"
                    v-bind:key="tab"
                    v-bind:class="[
                        'tab-button',
                        { active: currentTab === tab },
                    ]"
                    v-on:click="currentTab = tab"
                >
                    {{ tab }}
                </button>

                <!--keep-alive-->
                <component
                    v-bind:is="currentTabComponent"
                    class="tab"
                    :propiedad="currentTabProps"
                >
                </component>
                <!--/keep-alive-->
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "@/Layouts/AppLayout";
import PageHeader from "@/Shared/PageHeader";
import TabHome from "./TabHome.vue";
import TabPosts from "./TabPosts.vue";
import TabArchive from "./TabArchive.vue";

export default {
    layout: Layout,
    components: {
        Link,
        TabHome,
        TabPosts,
        TabArchive,
        PageHeader,
    },
    props: {
        errors: Object,
        home: Object,
        posts: Array,
        archive: Object,
    },
    data() {
        return {
            currentTab: "Home",
            tabs: ["Home", "Posts", "Archive"],
        };
    },
    computed: {
        currentTabComponent() {
            return "tab-" + this.currentTab.toLowerCase();
        },
        currentTabProps() {
            return [this.$props[this.currentTab.toLowerCase()], this.errors];
        },
    },
};
</script>

<style>
.demo {
    font-family: sans-serif;
    border: 1px solid #eee;
    border-radius: 2px;
    padding: 0px 0px;
    margin-top: 1em;
    margin-bottom: 40px;
    user-select: none;
    overflow-x: auto;
}

.tab-button {
    padding: 6px 10px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    border: 1px solid #ccc;
    cursor: pointer;
    background: #f0f0f0;
    margin-bottom: -1px;
    margin-right: -1px;
}
.tab-button:hover {
    background: #e0e0e0;
}
.tab-button.active {
    background: #e0e0e0;
}
.demo-tab {
    border: 1px solid #ccc;
    padding: 10px;
}
</style>
