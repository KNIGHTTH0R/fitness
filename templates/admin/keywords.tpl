<form method="POST">
	<div class="formline">
		<input type="text" name="add" />
		<input type="submit" value="Add Keyword" />
	</div>
</form>
<p></p>
<form method="POST">
	<table class="themed">
		<tr>
			<th>Keyword</th>
			<th>Validated</th>
			<th>Replace</th>
			<th></th>
		</tr>
	{foreach from=$keywords item=keyword}
		<tr class="{if $keyword.dtvalidated}validated{else}not-validated{/if}">
			<td>
				<input name="dtkeyword[{$keyword.idkeyword}]" size="60" value="{$keyword.dtkeyword}" />
			</td>
			<td>
				<input name="dtvalidated[{$keyword.idkeyword}]" type="checkbox"{if $keyword.dtvalidated} checked="checked"{/if} />
			</td>
			<td>
				<select name="replace[{$keyword.idkeyword}]">
					<option value="0">replace with</option>
					{foreach from=$keywords item=keyword2}
						{if $keyword2.idkeyword neq $keyword.idkeyword}
						<option value="{$keyword2.idkeyword}">{$keyword2.dtkeyword}</option>
						{/if}
					{/foreach}
				</select>
			</td>
			<td>
				<a href="?id={$keyword.idkeyword}"><img src="../files/icons/cross.png"></a>
			</td>
		</tr>
	{/foreach}
	</table>
	<div class="formline">
		<input type="submit" value="Save" />
	</div>
</form>