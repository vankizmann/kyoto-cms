import Vue from 'vue';

import KyoMedias from "./medias/KyoMedias";
Vue.component(KyoMedias.name, KyoMedias);

import KyoMediaCreate from "./medias/KyoMediaCreate";
Vue.component(KyoMediaCreate.name, KyoMediaCreate);

import KyoMediaEdit from "./medias/KyoMediaEdit";
Vue.component(KyoMediaEdit.name, KyoMediaEdit);

import KyoVideos from "./modals/KyoVideos";
Vue.component(KyoVideos.name, KyoVideos);

import KyoUploads from "./modals/KyoUploads";
Vue.component(KyoUploads.name, KyoUploads);

if ( console && console.log ) {
    console.log('kyoto/media ready.');
}
