<div class="form page page3">
	<h2>{$title}</h2>
	<form method="POST">
		<div class="formline">
			<label for="dtdisplay_email">{$label.display_email}</label>
			<input type="checkbox" name="dtdisplay_email" id="dtdisplay_email"{if $value.dtdisplay_email|default:false} checked="checked"{/if}{if $required.dtdisplay_email|default:false} class="required"{/if} />
		</div>
		<div class="formline">
			<label for="dtdisplay_tel">{$label.display_tel}</label>
			<input type="checkbox" name="dtdisplay_tel" id="dtdisplay_tel"{if $value.dtdisplay_tel|default:false} checked="checked"{/if}{if $required.dtdisplay_tel|default:false} class="required"{/if} />
		</div>
		<div class="formline">
			<label for="dtdisplay_address">{$label.display_address}</label>
			<input type="checkbox" name="dtdisplay_address" id="dtdisplay_address"{if $value.dtdisplay_address|default:false} checked="checked"{/if}{if $required.dtdisplay_address|default:false} class="required"{/if} />
		</div>
		<div class="formline">
			<label for="dtdisplay_pdf">{$label.display_pdf}</label>
			<input type="checkbox" name="dtdisplay_pdf" id="dtdisplay_pdf"{if $value.dtdisplay_pdf|default:false} checked="checked"{/if}{if $required.dtdisplay_pdf|default:false} class="required"{/if} />
		</div>
		{if $admin}
		<div class="formline">
			<label for="dtvalidated">{$label.validated}</label>
			<input type="checkbox" name="dtvalidated" id="dtvalidated"{if $value.dtvalidated|default:false} checked="checked"{/if}{if $required.dtvalidated|default:false} class="required"{/if} />
		</div>
		{/if}
		<div class="formline">
			<input type="submit" name="save" value="{$label.save}" />
		</div>
	</form>
</div>