{include file='header.tpl'}


<div class="ingemedia" data-role="page" id="accueil">
    <div data-role="header">
        <h1><img src="./img/logo_ingemedia.png" alt="Logo Ingémédia" /></h1>
    </div>
    <div data-role="content">

        <select name="formation" id="formation" data-native-menu="false">
            <option>Choisir une formation test</option>
            <option value="formation-all">Toutes les formations</option>
            {foreach from=$formation item=formation_array}
                <option value="formation-{$formation_array->id}">{$formation_array->name}</option>
            {/foreach}
        </select>


        <select name="type" id="type" data-native-menu="false">
            <option>Choisir une catégorie</option>
            <option value="categorie-all">Toutes les catégories</option>
            {foreach from=$categorie item=categorie_array}
                <option value="categorie-{$categorie_array->id}">{$categorie_array->name}</option>
            {/foreach}
        </select>
    </div>
</div>


ààààà
{include file='footer.tpl'}