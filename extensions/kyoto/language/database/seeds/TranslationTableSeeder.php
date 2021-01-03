<?php

use Illuminate\Database\Seeder;
use Kyoto\Language\Models\Translation;

class TranslationTableSeeder extends Seeder
{

    public function run()
    {
        $value = Translation::create([
            'source'    => 'Root',
            'target'    => 'Root',
        ]);

        $value->localized('de')->update([
            'target'    => 'Start',
        ]);

        $value = Translation::create([
            'source'    => 'Above',
            'target'    => 'Above',
        ]);

        $value->localized('de')->update([
            'target'    => 'Darüber',
        ]);

        $value = Translation::create([
            'source'    => 'Yes',
            'target'    => 'Yes',
        ]);

        $value->localized('de')->update([
            'target'    => 'Ja',
        ]);

        $value = Translation::create([
            'source'    => 'No',
            'target'    => 'No',
        ]);

        $value->localized('de')->update([
            'target'    => 'Nein',
        ]);

        $value = Translation::create([
            'source'    => 'Back',
            'target'    => 'Back',
        ]);

        $value->localized('de')->update([
            'target'    => 'Zurück',
        ]);

        $value = Translation::create([
            'source'    => 'Available',
            'target'    => 'Available',
        ]);

        $value->localized('de')->update([
            'target'    => 'Verfügbar',
        ]);

        $value = Translation::create([
            'source'    => 'Active',
            'target'    => 'Active',
        ]);

        $value->localized('de')->update([
            'target'    => 'Aktiv',
        ]);

        $value = Translation::create([
            'source'    => 'Search',
            'target'    => 'Search',
        ]);

        $value->localized('de')->update([
            'target'    => 'Suche',
        ]);

        $value = Translation::create([
            'source'    => 'Search item',
            'target'    => 'Search item',
        ]);

        $value->localized('de')->update([
            'target'    => 'Eintrag suchen',
        ]);

        $value = Translation::create([
            'source'    => 'Search for ...',
            'target'    => 'Search for ...',
        ]);

        $value->localized('de')->update([
            'target'    => 'Suchen nach ...',
        ]);

        $value = Translation::create([
            'source'    => 'Save',
            'target'    => 'Save',
        ]);

        $value->localized('de')->update([
            'target'    => 'Speichern',
        ]);

        $value = Translation::create([
            'source'    => 'Apply',
            'target'    => 'Apply',
        ]);

        $value->localized('de')->update([
            'target'    => 'Anwenden',
        ]);

        $value = Translation::create([
            'source'    => 'Reset',
            'target'    => 'Reset',
        ]);

        $value->localized('de')->update([
            'target'    => 'Zurücksetzen',
        ]);

        $value = Translation::create([
            'source'    => 'Abort',
            'target'    => 'Abort',
        ]);

        $value->localized('de')->update([
            'target'    => 'Abbrechen',
        ]);

        $value = Translation::create([
            'source'    => 'Confirm',
            'target'    => 'Confirm',
        ]);

        $value->localized('de')->update([
            'target'    => 'Bestätigen',
        ]);

        $value = Translation::create([
            'source'    => 'Includes value',
            'target'    => 'Includes value',
        ]);

        $value->localized('de')->update([
            'target'    => 'Beinhaltet Wert',
        ]);

        $value = Translation::create([
            'source'    => 'Excludes value',
            'target'    => 'Excludes value',
        ]);

        $value->localized('de')->update([
            'target'    => 'Beinhaltet Wert nicht',
        ]);

        $value = Translation::create([
            'source'    => 'Equal value',
            'target'    => 'Equal value',
        ]);

        $value->localized('de')->update([
            'target'    => 'Identischer Wert',
        ]);

        $value = Translation::create([
            'source'    => 'Except value',
            'target'    => 'Except value',
        ]);

        $value->localized('de')->update([
            'target'    => 'Nicht identischer Wert',
        ]);

        $value = Translation::create([
            'source'    => 'Exact date',
            'target'    => 'Exact date',
        ]);

        $value->localized('de')->update([
            'target'    => 'Gleiches Datum',
        ]);

        $value = Translation::create([
            'source'    => 'Before date',
            'target'    => 'Before date',
        ]);

        $value->localized('de')->update([
            'target'    => 'Vor Datum',
        ]);

        $value = Translation::create([
            'source'    => 'After date',
            'target'    => 'After date',
        ]);

        $value->localized('de')->update([
            'target'    => 'Nach Datum',
        ]);

        $value = Translation::create([
            'source'    => 'Delete item',
            'target'    => 'Delete item',
        ]);

        $value->localized('de')->update([
            'target'    => 'Eintrag löschen',
        ]);

        $value = Translation::create([
            'source'    => 'State',
            'target'    => 'State',
        ]);

        $value->localized('de')->update([
            'target'    => 'Status',
        ]);

        $value = Translation::create([
            'source'    => 'Hide',
            'target'    => 'Hide',
        ]);

        $value->localized('de')->update([
            'target'    => 'Versteckt',
        ]);

        $value = Translation::create([
            'source'    => 'Item is enabled',
            'target'    => 'Item is enabled',
        ]);

        $value->localized('de')->update([
            'target'    => 'Eintrag ist aktiv',
        ]);

        $value = Translation::create([
            'source'    => 'Item is hidden',
            'target'    => 'Item is hidden',
        ]);

        $value->localized('de')->update([
            'target'    => 'Eintrag ist versteckt',
        ]);

        $value = Translation::create([
            'source'    => 'Modified',
            'target'    => 'Modified',
        ]);

        $value->localized('de')->update([
            'target'    => 'Bearbeitet',
        ]);

        $value = Translation::create([
            'source'    => 'Created',
            'target'    => 'Created',
        ]);

        $value->localized('de')->update([
            'target'    => 'Erstellt',
        ]);

        $value = Translation::create([
            'source'    => 'Goto',
            'target'    => 'Goto',
        ]);

        $value->localized('de')->update([
            'target'    => 'Gehe zu',
        ]);

        $value = Translation::create([
            'source'    => 'Not saved yet',
            'target'    => 'Not saved yet',
        ]);

        $value->localized('de')->update([
            'target'    => 'Noch nicht gespeichert',
        ]);

        $value = Translation::create([
            'source'    => 'Saved at :updated',
            'target'    => 'Saved at :updated',
        ]);

        $value->localized('de')->update([
            'target'    => 'Zuletzt gespeichert :updated',
        ]);

        $value = Translation::create([
            'source'    => 'Action',
            'target'    => 'Action',
        ]);

        $value->localized('de')->update([
            'target'    => 'Aktion',
        ]);

        $value = Translation::create([
            'source'    => 'Actions',
            'target'    => 'Actions',
        ]);

        $value->localized('de')->update([
            'target'    => 'Aktionen',
        ]);

        $value = Translation::create([
            'source'    => 'No actions available',
            'target'    => 'No actions available',
        ]);

        $value->localized('de')->update([
            'target'    => 'Keine Aktion möglich',
        ]);

        $value = Translation::create([
            'source'    => 'No item selected|One item selected|:count items selected',
            'target'    => 'No item selected|One item selected|:count items selected',
        ]);

        $value->localized('de')->update([
            'target'    => 'Kein Eintrag ausgewählt|Ein Eintrag ausgewählt|:count Einträge ausgewählt',
        ]);

        $value = Translation::create([
            'source'    => 'Do you really want to copy this item?',
            'target'    => 'Do you really want to copy this item?',
        ]);

        $value->localized('de')->update([
            'target'    => 'Möchtest du diesen Eintrag wirklich kopieren?',
        ]);

        $value = Translation::create([
            'source'    => 'Do you really want to copy :count items?',
            'target'    => 'Do you really want to copy :count items?',
        ]);

        $value->localized('de')->update([
            'target'    => 'Möchtest du wirklich :count Einträge kopieren?',
        ]);

        $value = Translation::create([
            'source'    => 'Do you really want to delete this item?',
            'target'    => 'Do you really want to delete this item?',
        ]);

        $value->localized('de')->update([
            'target'    => 'Möchtest du diesen Eintrag wirklich löschen?',
        ]);

        $value = Translation::create([
            'source'    => 'Do you really want to delete :count items?',
            'target'    => 'Do you really want to delete :count items?',
        ]);

        $value->localized('de')->update([
            'target'    => 'Möchtest du wirklich :count Einträge löschen?',
        ]);

        $value = Translation::create([
            'source'    => 'No items|Total :count item|Total :count items',
            'target'    => 'No items|Total :count item|Total :count items',
        ]);

        $value->localized('de')->update([
            'target'    => 'Keine Einträge|Insgesamt :count Eintrag|Insgesamt :count Einträge',
        ]);

        $value = Translation::create([
            'source'    => ':count Item|:count Items',
            'target'    => ':count Item|:count Items',
        ]);

        $value->localized('de')->update([
            'target'    => ':count Eintrag|:count Einträge',
        ]);

        $value = Translation::create([
            'source'    => ':count items',
            'target'    => ':count items',
        ]);

        $value->localized('de')->update([
            'target'    => ':count Einträge',
        ]);

        $value = Translation::create([
            'source'    => 'No entries',
            'target'    => 'No entries',
        ]);

        $value->localized('de')->update([
            'target'    => 'Keine Einträge',
        ]);

        $value = Translation::create([
            'source'    => 'Delete selection',
            'target'    => 'Delete selection',
        ]);

        $value->localized('de')->update([
            'target'    => 'Auswahl löschen',
        ]);

        $value = Translation::create([
            'source'    => 'Copy selection',
            'target'    => 'Copy selection',
        ]);

        $value->localized('de')->update([
            'target'    => 'Auswahl kopieren',
        ]);

        $value = Translation::create([
            'source'    => 'Settings',
            'target'    => 'Settings',
        ]);

        $value->localized('de')->update([
            'target'    => 'Einstellungen',
        ]);

        $value = Translation::create([
            'source'    => 'Menu',
            'target'    => 'Menu',
        ]);

        $value->localized('de')->update([
            'target'    => 'Menü',
        ]);

        $value = Translation::create([
            'source'    => 'Menus',
            'target'    => 'Menus',
        ]);

        $value->localized('de')->update([
            'target'    => 'Menüs',
        ]);

        $value = Translation::create([
            'source'    => 'Create menu',
            'target'    => 'Create menu',
        ]);

        $value->localized('de')->update([
            'target'    => 'Menü erstellen',
        ]);

        $value = Translation::create([
            'source'    => 'Edit menu',
            'target'    => 'Edit menu',
        ]);

        $value->localized('de')->update([
            'target'    => 'Menü bearbeiten',
        ]);

        $value = Translation::create([
            'source'    => 'Menu has been created',
            'target'    => 'Menu has been created',
        ]);

        $value->localized('de')->update([
            'target'    => 'Menü wurde erstellt',
        ]);

        $value = Translation::create([
            'source'    => 'Menu has been updated',
            'target'    => 'Menu has been updated',
        ]);

        $value->localized('de')->update([
            'target'    => 'Menü wurde gespeichert',
        ]);

        $value = Translation::create([
            'source'    => 'Menus have been copied',
            'target'    => 'Menus have been copied',
        ]);

        $value->localized('de')->update([
            'target'    => 'Menüs wurden kopiert',
        ]);

        $value = Translation::create([
            'source'    => 'Menus have been deleted',
            'target'    => 'Menus have been deleted',
        ]);

        $value->localized('de')->update([
            'target'    => 'Menüs wurden gelöscht',
        ]);

        $value = Translation::create([
            'source'    => 'Menus have been moved',
            'target'    => 'Menus have been moved',
        ]);

        $value->localized('de')->update([
            'target'    => 'Menüs wurden verschoben',
        ]);

        $value = Translation::create([
            'source'    => 'Menus have been inserted',
            'target'    => 'Menus have been inserted',
        ]);

        $value->localized('de')->update([
            'target'    => 'Menüs wurden hinzugefügt',
        ]);

        $value = Translation::create([
            'source'    => 'Page',
            'target'    => 'Page',
        ]);

        $value->localized('de')->update([
            'target'    => 'Seite',
        ]);

        $value = Translation::create([
            'source'    => 'Pages',
            'target'    => 'Pages',
        ]);

        $value->localized('de')->update([
            'target'    => 'Seiten',
        ]);

        $value = Translation::create([
            'source'    => 'Create page',
            'target'    => 'Create page',
        ]);

        $value->localized('de')->update([
            'target'    => 'Seite erstellen',
        ]);

        $value = Translation::create([
            'source'    => 'Edit page',
            'target'    => 'Edit page',
        ]);

        $value->localized('de')->update([
            'target'    => 'Seite bearbeiten',
        ]);

        $value = Translation::create([
            'source'    => 'Page has been created',
            'target'    => 'Page has been created',
        ]);

        $value->localized('de')->update([
            'target'    => 'Seite wurde erstellt',
        ]);

        $value = Translation::create([
            'source'    => 'Page has been updated',
            'target'    => 'Page has been updated',
        ]);

        $value->localized('de')->update([
            'target'    => 'Seite wurde gespeichert',
        ]);

        $value = Translation::create([
            'source'    => 'Pages have been copied',
            'target'    => 'Pages have been copied',
        ]);

        $value->localized('de')->update([
            'target'    => 'Seiten wurden kopiert',
        ]);

        $value = Translation::create([
            'source'    => 'Pages have been deleted',
            'target'    => 'Pages have been deleted',
        ]);

        $value->localized('de')->update([
            'target'    => 'Seiten wurden gelöscht',
        ]);

        $value = Translation::create([
            'source'    => 'Media',
            'target'    => 'Media',
        ]);

        $value->localized('de')->update([
            'target'    => 'Medien',
        ]);

        $value = Translation::create([
            'source'    => 'Medias',
            'target'    => 'Medias',
        ]);

        $value->localized('de')->update([
            'target'    => 'Medien',
        ]);

        $value = Translation::create([
            'source'    => 'Create media',
            'target'    => 'Create media',
        ]);

        $value->localized('de')->update([
            'target'    => 'Datei erstellen',
        ]);

        $value = Translation::create([
            'source'    => 'Edit media',
            'target'    => 'Edit media',
        ]);

        $value->localized('de')->update([
            'target'    => 'Datei bearbeiten',
        ]);

        $value = Translation::create([
            'source'    => 'Create folder',
            'target'    => 'Create folder',
        ]);

        $value->localized('de')->update([
            'target'    => 'Ordner erstellen',
        ]);

        $value = Translation::create([
            'source'    => 'Edit folder',
            'target'    => 'Edit folder',
        ]);

        $value->localized('de')->update([
            'target'    => 'Ordner bearbeiten',
        ]);

        $value = Translation::create([
            'source'    => 'New folder',
            'target'    => 'New folder',
        ]);

        $value->localized('de')->update([
            'target'    => 'Neuer Ordner',
        ]);

        $value = Translation::create([
            'source'    => 'Add files',
            'target'    => 'Add files',
        ]);

        $value->localized('de')->update([
            'target'    => 'Dateien hinzufügen',
        ]);

        $value = Translation::create([
            'source'    => 'Media has been created',
            'target'    => 'Media has been created',
        ]);

        $value->localized('de')->update([
            'target'    => 'Datei wurde erstellt',
        ]);

        $value = Translation::create([
            'source'    => 'Media has been updated',
            'target'    => 'Media has been updated',
        ]);

        $value->localized('de')->update([
            'target'    => 'Datei wurde gespeichert',
        ]);

        $value = Translation::create([
            'source'    => 'Medias have been copied',
            'target'    => 'Medias have been copied',
        ]);

        $value->localized('de')->update([
            'target'    => 'Medien wurden kopiert',
        ]);

        $value = Translation::create([
            'source'    => 'Medias have been deleted',
            'target'    => 'Medias have been deleted',
        ]);

        $value->localized('de')->update([
            'target'    => 'Medien wurden gelöscht',
        ]);

        $value = Translation::create([
            'source'    => 'User',
            'target'    => 'User',
        ]);

        $value->localized('de')->update([
            'target'    => 'Benutzer',
        ]);

        $value = Translation::create([
            'source'    => 'Users',
            'target'    => 'Users',
        ]);

        $value->localized('de')->update([
            'target'    => 'Benutzer',
        ]);

        $value = Translation::create([
            'source'    => 'Create user',
            'target'    => 'Create user',
        ]);

        $value->localized('de')->update([
            'target'    => 'Benutzer erstellen',
        ]);

        $value = Translation::create([
            'source'    => 'Edit user',
            'target'    => 'Edit user',
        ]);

        $value->localized('de')->update([
            'target'    => 'Benutzer bearbeiten',
        ]);

        $value = Translation::create([
            'source'    => 'User has been created',
            'target'    => 'User has been created',
        ]);

        $value->localized('de')->update([
            'target'    => 'Benutzer wurde erstellt',
        ]);

        $value = Translation::create([
            'source'    => 'User has been updated',
            'target'    => 'User has been updated',
        ]);

        $value->localized('de')->update([
            'target'    => 'Benutzer wurde gespeichert',
        ]);

        $value = Translation::create([
            'source'    => 'Users have been copied',
            'target'    => 'Users have been copied',
        ]);

        $value->localized('de')->update([
            'target'    => 'Benutzer wurden kopiert',
        ]);

        $value = Translation::create([
            'source'    => 'Users have been deleted',
            'target'    => 'Users have been deleted',
        ]);

        $value->localized('de')->update([
            'target'    => 'Benutzer wurden gelöscht',
        ]);

        $value = Translation::create([
            'source'    => 'Role',
            'target'    => 'Role',
        ]);

        $value->localized('de')->update([
            'target'    => 'Rolle',
        ]);

        $value = Translation::create([
            'source'    => 'Roles',
            'target'    => 'Roles',
        ]);

        $value->localized('de')->update([
            'target'    => 'Rollen',
        ]);

        $value = Translation::create([
            'source'    => 'Create role',
            'target'    => 'Create role',
        ]);

        $value->localized('de')->update([
            'target'    => 'Rolle erstellen',
        ]);

        $value = Translation::create([
            'source'    => 'Edit role',
            'target'    => 'Edit role',
        ]);

        $value->localized('de')->update([
            'target'    => 'Rolle bearbeiten',
        ]);

        $value = Translation::create([
            'source'    => 'Role has been created',
            'target'    => 'Role has been created',
        ]);

        $value->localized('de')->update([
            'target'    => 'Rolle wurde erstellt',
        ]);

        $value = Translation::create([
            'source'    => 'Role has been updated',
            'target'    => 'Role has been updated',
        ]);

        $value->localized('de')->update([
            'target'    => 'Rolle wurde gespeichert',
        ]);

        $value = Translation::create([
            'source'    => 'Roles have been copied',
            'target'    => 'Roles have been copied',
        ]);

        $value->localized('de')->update([
            'target'    => 'Rollen wurden kopiert',
        ]);

        $value = Translation::create([
            'source'    => 'Roles have been deleted',
            'target'    => 'Roles have been deleted',
        ]);

        $value->localized('de')->update([
            'target'    => 'Rollen wurden gelöscht',
        ]);

        $value = Translation::create([
            'source'    => 'Gate',
            'target'    => 'Gate',
        ]);

        $value->localized('de')->update([
            'target'    => 'Zugang',
        ]);

        $value = Translation::create([
            'source'    => 'Gates',
            'target'    => 'Gates',
        ]);

        $value->localized('de')->update([
            'target'    => 'Zugänge',
        ]);

        $value = Translation::create([
            'source'    => 'Create gate',
            'target'    => 'Create gate',
        ]);

        $value->localized('de')->update([
            'target'    => 'Zugang erstellen',
        ]);

        $value = Translation::create([
            'source'    => 'Edit gate',
            'target'    => 'Edit gate',
        ]);

        $value->localized('de')->update([
            'target'    => 'Zugang bearbeiten',
        ]);

        $value = Translation::create([
            'source'    => 'Gate has been created',
            'target'    => 'Gate has been created',
        ]);

        $value->localized('de')->update([
            'target'    => 'Zugang wurde erstellt',
        ]);

        $value = Translation::create([
            'source'    => 'Gate has been updated',
            'target'    => 'Gate has been updated',
        ]);

        $value->localized('de')->update([
            'target'    => 'Zugang wurde gespeichert',
        ]);

        $value = Translation::create([
            'source'    => 'Gates have been copied',
            'target'    => 'Gates have been copied',
        ]);

        $value->localized('de')->update([
            'target'    => 'Zugänge wurden kopiert',
        ]);

        $value = Translation::create([
            'source'    => 'Gates have been deleted',
            'target'    => 'Gates have been deleted',
        ]);

        $value->localized('de')->update([
            'target'    => 'Zugänge wurden gelöscht',
        ]);

        $value = Translation::create([
            'source'    => 'Policy',
            'target'    => 'Policy',
        ]);

        $value->localized('de')->update([
            'target'    => 'Recht',
        ]);

        $value = Translation::create([
            'source'    => 'Policies',
            'target'    => 'Policies',
        ]);

        $value->localized('de')->update([
            'target'    => 'Rechte',
        ]);

        $value = Translation::create([
            'source'    => 'Create policy',
            'target'    => 'Create policy',
        ]);

        $value->localized('de')->update([
            'target'    => 'Recht erstellen',
        ]);

        $value = Translation::create([
            'source'    => 'Edit policy',
            'target'    => 'Edit policy',
        ]);

        $value->localized('de')->update([
            'target'    => 'Recht bearbeiten',
        ]);

        $value = Translation::create([
            'source'    => 'Policy has been created',
            'target'    => 'Policy has been created',
        ]);

        $value->localized('de')->update([
            'target'    => 'Recht wurde erstellt',
        ]);

        $value = Translation::create([
            'source'    => 'Policy has been updated',
            'target'    => 'Policy has been updated',
        ]);

        $value->localized('de')->update([
            'target'    => 'Recht wurde gespeichert',
        ]);

        $value = Translation::create([
            'source'    => 'Policies have been copied',
            'target'    => 'Policies have been copied',
        ]);

        $value->localized('de')->update([
            'target'    => 'Rechte wurden kopiert',
        ]);

        $value = Translation::create([
            'source'    => 'Policies have been deleted',
            'target'    => 'Policies have been deleted',
        ]);

        $value->localized('de')->update([
            'target'    => 'Rechte wurden gelöscht',
        ]);

        $value = Translation::create([
            'source'    => 'Language',
            'target'    => 'Language',
        ]);

        $value->localized('de')->update([
            'target'    => 'Sprache',
        ]);

        $value = Translation::create([
            'source'    => 'Languages',
            'target'    => 'Languages',
        ]);

        $value->localized('de')->update([
            'target'    => 'Sprachen',
        ]);

        $value = Translation::create([
            'source'    => 'Create language',
            'target'    => 'Create language',
        ]);

        $value->localized('de')->update([
            'target'    => 'Sprache erstellen',
        ]);

        $value = Translation::create([
            'source'    => 'Edit language',
            'target'    => 'Edit language',
        ]);

        $value->localized('de')->update([
            'target'    => 'Sprache bearbeiten',
        ]);

        $value = Translation::create([
            'source'    => 'Language has been created',
            'target'    => 'Language has been created',
        ]);

        $value->localized('de')->update([
            'target'    => 'Sprache wurde erstellt',
        ]);

        $value = Translation::create([
            'source'    => 'Language has been updated',
            'target'    => 'Language has been updated',
        ]);

        $value->localized('de')->update([
            'target'    => 'Sprache wurde gespeichert',
        ]);

        $value = Translation::create([
            'source'    => 'Languages have been copied',
            'target'    => 'Languages have been copied',
        ]);

        $value->localized('de')->update([
            'target'    => 'Sprachen wurden kopiert',
        ]);

        $value = Translation::create([
            'source'    => 'Languages have been deleted',
            'target'    => 'Languages have been deleted',
        ]);

        $value->localized('de')->update([
            'target'    => 'Sprachen wurden gelöscht',
        ]);

        $value = Translation::create([
            'source'    => 'Translation',
            'target'    => 'Translation',
        ]);

        $value->localized('de')->update([
            'target'    => 'Übersetzung',
        ]);

        $value = Translation::create([
            'source'    => 'Translations',
            'target'    => 'Translations',
        ]);

        $value->localized('de')->update([
            'target'    => 'Übersetzungen',
        ]);

        $value = Translation::create([
            'source'    => 'Create translation',
            'target'    => 'Create translation',
        ]);

        $value->localized('de')->update([
            'target'    => 'Übersetzung erstellen',
        ]);

        $value = Translation::create([
            'source'    => 'Edit translation',
            'target'    => 'Edit translation',
        ]);

        $value->localized('de')->update([
            'target'    => 'Übersetzung bearbeiten',
        ]);

        $value = Translation::create([
            'source'    => 'Translation has been created',
            'target'    => 'Translation has been created',
        ]);

        $value->localized('de')->update([
            'target'    => 'Übersetzung wurde erstellt',
        ]);

        $value = Translation::create([
            'source'    => 'Translation has been updated',
            'target'    => 'Translation has been updated',
        ]);

        $value->localized('de')->update([
            'target'    => 'Übersetzung wurde gespeichert',
        ]);

        $value = Translation::create([
            'source'    => 'Translations have been copied',
            'target'    => 'Translations have been copied',
        ]);

        $value->localized('de')->update([
            'target'    => 'Übersetzungen wurden kopiert',
        ]);

        $value = Translation::create([
            'source'    => 'Translations have been deleted',
            'target'    => 'Translations have been deleted',
        ]);

        $value->localized('de')->update([
            'target'    => 'Übersetzungen wurden gelöscht',
        ]);

        $value = Translation::create([
            'source'    => 'Package',
            'target'    => 'Package',
        ]);

        $value->localized('de')->update([
            'target'    => 'Erweiterung',
        ]);

        $value = Translation::create([
            'source'    => 'Packages',
            'target'    => 'Packages',
        ]);

        $value->localized('de')->update([
            'target'    => 'Erweiterungen',
        ]);

        $value = Translation::create([
            'source'    => 'Create package',
            'target'    => 'Create package',
        ]);

        $value->localized('de')->update([
            'target'    => 'Erweiterung erstellen',
        ]);

        $value = Translation::create([
            'source'    => 'Edit package',
            'target'    => 'Edit package',
        ]);

        $value->localized('de')->update([
            'target'    => 'Erweiterung bearbeiten',
        ]);

        $value = Translation::create([
            'source'    => 'Title',
            'target'    => 'Title',
        ]);

        $value->localized('de')->update([
            'target'    => 'Titel',
        ]);

        $value = Translation::create([
            'source'    => 'Description',
            'target'    => 'Description',
        ]);

        $value->localized('de')->update([
            'target'    => 'Beschreibung',
        ]);

        $value = Translation::create([
            'source'    => 'Slug',
            'target'    => 'Slug',
        ]);

        $value->localized('de')->update([
            'target'    => 'Slug',
        ]);

        $value = Translation::create([
            'source'    => 'Content',
            'target'    => 'Content',
        ]);

        $value->localized('de')->update([
            'target'    => 'Inhalt',
        ]);

        $value = Translation::create([
            'source'    => 'Identifier',
            'target'    => 'Identifier',
        ]);

        $value->localized('de')->update([
            'target'    => 'Identifier',
        ]);

        $value = Translation::create([
            'source'    => 'Type',
            'target'    => 'Type',
        ]);

        $value->localized('de')->update([
            'target'    => 'Typ',
        ]);

        $value = Translation::create([
            'source'    => 'Redirect',
            'target'    => 'Redirect',
        ]);

        $value->localized('de')->update([
            'target'    => 'Weiterleitung',
        ]);

        $value = Translation::create([
            'source'    => 'Country',
            'target'    => 'Country',
        ]);

        $value->localized('de')->update([
            'target'    => 'Land',
        ]);

        $value = Translation::create([
            'source'    => 'Locale',
            'target'    => 'Locale',
        ]);

        $value->localized('de')->update([
            'target'    => 'Abkürzung',
        ]);

        $value = Translation::create([
            'source'    => 'Plate',
            'target'    => 'Plate',
        ]);

        $value->localized('de')->update([
            'target'    => 'Kennzeichen',
        ]);

        $value = Translation::create([
            'source'    => 'Source',
            'target'    => 'Source',
        ]);

        $value->localized('de')->update([
            'target'    => 'Quelle',
        ]);

        $value = Translation::create([
            'source'    => 'Target',
            'target'    => 'Target',
        ]);

        $value->localized('de')->update([
            'target'    => 'Ziel',
        ]);

        $value = Translation::create([
            'source'    => 'Access',
            'target'    => 'Access',
        ]);

        $value->localized('de')->update([
            'target'    => 'Zugriff',
        ]);

        $value = Translation::create([
            'source'    => 'Security',
            'target'    => 'Security',
        ]);

        $value->localized('de')->update([
            'target'    => 'Sicherheit',
        ]);

        $value = Translation::create([
            'source'    => 'E-Mail-Address',
            'target'    => 'E-Mail-Address',
        ]);

        $value->localized('de')->update([
            'target'    => 'E-Mail-Adresse',
        ]);

        $value = Translation::create([
            'source'    => 'Password',
            'target'    => 'Password',
        ]);

        $value->localized('de')->update([
            'target'    => 'Passwort',
        ]);

        $value = Translation::create([
            'source'    => 'Password confirmation',
            'target'    => 'Password confirmation',
        ]);

        $value->localized('de')->update([
            'target'    => 'Passwort wiederholen',
        ]);

        $value = Translation::create([
            'source'    => 'Login',
            'target'    => 'Login',
        ]);

        $value->localized('de')->update([
            'target'    => 'Anmelden',
        ]);

        $value = Translation::create([
            'source'    => 'Logout',
            'target'    => 'Logout',
        ]);

        $value->localized('de')->update([
            'target'    => 'Abmelden',
        ]);

        $value = Translation::create([
            'source'    => 'YYYY-MM-DD HH:mm',
            'target'    => 'YYYY-MM-DD HH:mm',
        ]);

        $value->localized('de')->update([
            'target'    => 'DD.MM.YYYY HH:mm',
        ]);

        $value = Translation::create([
            'source'    => 'YYYY-MM-DD',
            'target'    => 'YYYY-MM-DD',
        ]);

        $value->localized('de')->update([
            'target'    => 'DD.MM.YYYY',
        ]);

    }

}
