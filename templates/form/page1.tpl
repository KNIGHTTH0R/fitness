<div class="form page page1">
	<h2>{$title}</h2>
	<form method="POST">
		<div class="formline">
			<label for="dtname">{$label.name}</label>
			<input type="text" name="dtname" id="dtname" value="{$value.dtname|default:''}"{if $required.dtname|default:false} class="required"{/if} />
		</div>
		<div class="formline">
			<label for="dtfirstname">{$label.firstname}</label>
			<input type="text" name="dtfirstname" id="dtfirstname" value="{$value.dtfirstname|default:''}"{if $required.dtfirstname|default:false} class="required"{/if} />
		</div>
		<div class="formline">
			<label for="dtemail">{$label.email}</label>
			<input type="text" name="dtemail" id="dtemail" value="{$value.dtemail|default:''}"{if $required.dtemail|default:false} class="required"{/if} />
		</div>
		<div class="formline">
			<label for="dttel">{$label.tel}</label>
			<input type="text" name="dttel" id="dttel" value="{$value.dttel|default:''}"{if $required.dttel|default:false} class="required"{/if} />
		</div>
		<div class="formline">
			<label for="dtaddress">{$label.address}</label>
			<textarea name="dtaddress" id="dtaddress" maxlength="300"{if $required.dtaddress|default:false} class="required"{/if}>{$value.dtaddress|default:''}</textarea>
		</div>
		<div class="formline">
			<input type="submit" value="{$label.next}" />
		</div>
	</form>
</div>