<form method="POST">
	<div class="formline">
		<input type="text" name="add" />
		<input type="submit" value="Add" />
	</div>
</form>
<p></p>
<form method="POST">
	<table class="themed">
		<tr>
			<th>City</th>
			<th>Validated</th>
			<th>Replace</th>
			<th></th>
		</tr>
	{foreach from=$cities item=city}
		<tr class="{if $city.dtvalidated}validated{else}not-validated{/if}">
			<td>
				<input name="dtcity[{$city.idcity}]" size="60" value="{$city.dtcity}" />
			</td>
			<td>
				<input name="dtvalidated[{$city.idcity}]" type="checkbox"{if $city.dtvalidated} checked="checked"{/if} />
			</td>
			<td>
				<select name="replace[{$city.idcity}]">
					<option value="0">replace with</option>
					{foreach from=$cities item=city2}
						{if $city2.idcity neq $city.idcity}
						<option value="{$city2.idcity}">{$city2.dtcity}</option>
						{/if}
					{/foreach}
				</select>
			</td>
			<td>
				<a href="?id={$city.idcity}"><img src="../files/icons/cross.png"></a>
			</td>
		</tr>
	{/foreach}
	</table>
	<div class="formline">
		<input type="submit" value="Save" />
	</div>
</form>