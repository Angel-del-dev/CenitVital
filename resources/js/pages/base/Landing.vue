<script setup>
    import { ref, onMounted } from 'vue';
    import { Head } from '@inertiajs/vue3';
    import { useLanguage } from '@/composables/useLanguage';
    import DownloadApp from '@/components/generic/popup/DownloadApp.vue';
    import ButtonLink from '@/components/links/ButtonLink.vue';

    const { lang, islogged } = defineProps(['lang', 'islogged']);
    const loading = ref(true);
    let translation = ref({});

    onMounted(async () => {
        translation.value = await useLanguage(lang, 'generic');
        loading.value = false;
    });
</script>

<template>
    <Head :title="translation.page_landing" />
    <main class='user-select-none'>
        <article>
            <div class='small-container p-3'>
                <h1 class="text-white m-0 text-right">CENIT VITAL</h1>
                <h2 class="text-white text-right">Wellness & Massage</h2>
                <p class="text-white text-right">
                    {{ translation.message }}
                </p>
                <ButtonLink 
                    v-if="!islogged"
                    classes="float-right" 
                    palette="light-danger" 
                    :caption="translation.signin" 
                    :link="`/${lang}/login`" 
                />
                <ButtonLink 
                    v-else
                    classes="float-right" 
                    palette="light-danger" 
                    :caption="translation.page_admin_dashboard" 
                    :link="`/${lang}/panel`" 
                />
            </div>
        </article>
        <aside>
            
        </aside>
    </main>
    <DownloadApp :translation="translation" />
</template>
<style scoped>
    main {
        background-image: url('/assets/img/landing/background.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    main,
    main > article {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    main > article {
        flex: 4;
        flex-direction: column;
    }

    aside {
        width: 40svw;
        height: 100%;
    }

    main > article::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.85);
        z-index: 1;
    }

    .small-container {
        z-index: 2;
        width: 70%;
    }

    .small-container > h1 {
        font-size: 3.5rem;
    }

    .small-container > h2 {
        font-size: 2rem;
    }

    .small-container > p {
        font-size: 1.2rem;
    }

    @media screen and (max-width: 750px) {
        main {
            background-position: left;
        }
        aside {
            display: none;
        }

        .small-container {
            width: 100%;
        }

        .small-container > h1,
        .small-container > h2,
        .small-container > p {
            text-align: center;
        }

        .small-container > h1 {
            font-size: 2rem;
        }

        .small-container > p {
            font-size: 1rem;
        }
    }

    @media screen and (min-width: 750px) {
        main > article {
            transform: skewX(-9deg);
            transform-origin: top right;
        }
    }

    @media screen and (min-width: 1000px) {
        main > article {
            flex: 2;
        }
    }
</style>