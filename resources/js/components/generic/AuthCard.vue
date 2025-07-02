<template>
    <main
        class="w-100 h-100 flex justify-center align-center user-select-none"
    >
        <div id="AuthCard">
            <slot />
        </div>
    </main>
</template>
<style scoped>
    #AuthCard {
        background-color: whitesmoke;
        width: 50vmin;
        height: 50vmin;
        border-radius: var(--border-radius);
        box-shadow: 2px 2px 2px 2px lightgray;
    }

    @media screen and (max-width: 750px) {
        #AuthCard {
            background-color: transparent;
            box-shadow: none;

            width: 70%;

            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
    }
</style>