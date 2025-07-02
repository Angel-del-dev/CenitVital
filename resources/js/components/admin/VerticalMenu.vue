<script setup>

    const { toggled, user, role } = defineProps(['toggled', 'user', 'role']);
</script>
<template>
    <aside
        :class="`h-100 ${!toggled ? 'none' : ''} overflow-y-auto`"
    >
        <div class="w-100 flex justify-center align-center direction-column p-2">
            <img src="/assets/img/profile/placeholder.png" alt="">
            <strong>{{ user.name }}</strong>
            <span class="off">{{ role.name }}</span>
        </div>
    </aside>
</template>

<style scoped>
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
    }
</style>