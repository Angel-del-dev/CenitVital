<script setup>
    import * as Icons from 'lucide-vue-next';
    
    const { active, translation, menu, toggled, user, role } = defineProps(['active', 'translation', 'menu', 'toggled', 'user', 'role']);

</script>
<template>
    <aside
        :class="`flex justify-start align-start direction-column user-select-none h-100 ${!toggled ? 'none' : ''}`"
    >
        <div class="w-100 flex justify-center align-center direction-column p-2">
            <img src="/assets/img/profile/placeholder.png" alt="">
            <strong>{{ user.name }}</strong>
            <span class="off">{{ role.name }}</span>
        </div>
        <div class="grow-1 overflow-y-auto w-100">
            <ul class="w-100">
                <li v-for="item of menu">
                    <span :class="`radius-auto p-1 w-100 flex gap-3 ${active === item.code ? 'active' : ''}`" v-if="item.items === undefined">
                        <component :is="Icons[item.icon]" />
                        <a :href="item.link">{{ translation[item.code] }}</a>
                    </span>
                    <span class="w-100 block" v-else>
                        <span :class="`radius-auto p-1 w-100 flex gap-3 pointer ${active === item.code ? 'active' : ''}`">
                            <component :is="Icons[item.icon]" />
                            {{ translation[item.code] }}
                        </span>
                        <ul class="w-100">
                            <li class='radius-auto p-1 flex gap-3' v-for="children of item.items">
                                <component :is="Icons[children.icon]" />
                                <a :href="children.link">{{ translation[children.code] }}</a>
                            </li>
                        </ul>
                    </span>
                </li>
            </ul>
        </div>
    </aside>
</template>

<style scoped>
    .active {
        background-color: lightgray;
    }
    a {
        color: var(--black);
        text-decoration: none;
        width: 100%;
        display: block;
    }
    ul {
        margin: 0;
        padding: 0;
    }
    li {
        list-style-type: none;
        padding: 5px 20px;
        width: 100%;
    }
    li:hover {
        background-color: lightgray;
    }
    img {
        width: 100px;
        height: 100px;
        object-fit: contain;
        border-radius: 50%;
        border: 5px double lightgray;
    }
    aside {
        min-width: 40vmin;
        width: fit-content;
        background-color: var(--white);
        border: 1px solid lightgray;
        border-radius: var(--border-radius);
        z-index: 2;
    }

    span.off {
        color: gray;
    }

    @media screen and (max-width: 700px) {
        aside {
            position: absolute;
            width: 100%;
            background-color: var(--light-black);
            border: 1px solid var(--light-black);
            border-radius: 0;
            z-index: 10;
        }
        strong {
            color: var(--white);
        }
        .active,
        li:hover {
            background-color: transparent;
        }

        a,
        span {
            color: var(--white);
            padding: 10px;
        }
    }
</style>