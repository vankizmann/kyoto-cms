import KyoMedias from "./medias/KyoMedias";
kyoto.component(KyoMedias.name, KyoMedias);

import KyoMediaCreate from "./medias/KyoMediaCreate";
kyoto.component(KyoMediaCreate.name, KyoMediaCreate);

import KyoMediaEdit from "./medias/KyoMediaEdit";
kyoto.component(KyoMediaEdit.name, KyoMediaEdit);

import KyoVideos from "./modals/KyoVideos";
kyoto.component(KyoVideos.name, KyoVideos);

import KyoUploads from "./modals/KyoUploads";
kyoto.component(KyoUploads.name, KyoUploads);

import KyoMediaSelect from "./inputs/KyoMediaSelect";
kyoto.component(KyoMediaSelect.name, KyoMediaSelect);

if ( console && console.log ) {
    console.log('kyoto/media ready.');
}
