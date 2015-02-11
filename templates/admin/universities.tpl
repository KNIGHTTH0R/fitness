<form method="POST">
	<div class="formline">
		<input type="text" name="add" />
		<input type="submit" value="Add University" />
	</div>
</form>
<p></p>
<form method="POST">
	<table class="themed">
		<tr>
			<th>University</th>
			<th>City</th>
			<th>Validated</th>
			<th>Replace</th>
			<th></th>
		</tr>
	{foreach from=$universities item=university}
		<tr class="{if $university.dtvalidated}validated{else}not-validated{/if}">
			<td>
				<input name="dtuniversity[{$university.iduniversity}]" size="60" value="{$university.dtuniversity}" />
			</td>
			<td>
				<select name="ficity[{$university.iduniversity}]">
					<option value="0">-- select --</option>
					{foreach from=$cities item=city}
						<option value="{$city.idcity}"{if $city.idcity eq $university.ficity} selected="selected"{/if}>{$city.dtcity}</option>
					{/foreach}
				</select>
			</td>
			<td>
				<input name="dtvalidated[{$university.iduniversity}]" type="checkbox"{if $university.dtvalidated} checked="checked"{/if} />
			</td>
			<td>
				<select name="replace[{$university.iduniversity}]">
					<option value="0">replace with</option>
					{foreach from=$universities item=university2}
						{if $university2.iduniversity neq $university.iduniversity}
						<option value="{$university2.iduniversity}">{$university2.dtuniversity}</option>
						{/if}
					{/foreach}
				</select>
			</td>
			<td>
				<a href="?id={$university.iduniversity}"><img src="../files/icons/cross.png"></a>
			</td>
		</tr>
	{/foreach}
	</table>
	<div class="formline">
		<input type="submit" value="Save" />
	</div>
</form>