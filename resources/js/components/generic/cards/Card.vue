<template>
    <div
        class='p-2 grow-1'
    >
        <slot />
    </div>
</template>
<style scoped>
    div {
        box-shadow: 2px 2px 2px 2px lightgray;
        border-radius: var(--border-radius);
    }
</style>