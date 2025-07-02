<script setup lang="ts">
    import { ref } from 'vue';
    import VerticalMenu from './VerticalMenu.vue';
    import Breadcumbs from './Breadcumbs.vue';
    import { Menu } from 'lucide-vue-next';

    const { breadcumbs } = defineProps(['breadcumbs']);
    
    const width = ref(window.innerWidth);
    window.addEventListener('resize', e => {
        width.value = window.innerWidth
        IsMenuToggled.value = !(width.value <= 700);
    });
    const IsMenuToggled = ref(!(width.value <= 700));

    const change_menu_state = () => IsMenuToggled.value = !IsMenuToggled.value;
</script>

<template>
    <main
        class="w-100 h-100 p-3 flex justify-center align-center gap-3"
    >
        <VerticalMenu :toggled="IsMenuToggled" />
        <div
            id="container"
            class="grow-1 h-100 flex justify-center align-center direction-column"
        >
            <nav
                class="w-100 p-2 flex justify-start align-center gap-3"
            >   
                <Menu class="pointer" @click="change_menu_state" />
                <Breadcumbs :current="breadcumbs" />
            </nav>
            <article
                class="w-100 grow-1 p-2 overflow-y-auto"
            >
                <slot />
            </article>
        </div>
    </main>
    <!-- Aside -->
    <!-- Navbar -->
    <!-- Actual content -->
</template>
<style scoped>
    main {
        background-color: whitesmoke;
        position: relative;
    }
    article {
        background-color: var(--white);
        border-radius: var(--border-radius);
        border: 1px solid lightgray;
    }

    nav {

    }
</style>