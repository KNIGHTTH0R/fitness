<h1>Admin Interface</h1>
<div id="Menu">
{foreach from=$menu key=label item=link}
	<a class="button" href="{$link}">{$label}</a>
{/foreach}
</div>
<div id="Content">{$content}</div>