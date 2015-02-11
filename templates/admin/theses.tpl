<table class="thesis">
	<tr>
		<th></th>
		<th>Writer</th>
		<th>Year</th>
		<th>Title</th>
		<th>University</th>
		<th>City</th>
		<th>PDF</th>
		<th>Validated</th>
		<th></th>
	</tr>
	{foreach from=$theses item=thesis}
	<tr>
		<td>
			<a href="{$thesis.edit}" target="_blank">edit</a>
			<a href="{$thesis.detail}" target="_blank">detail</a>
		</td>
		<td>{$thesis.dtname} {$thesis.dtfirstname}</td>
		<td>{$thesis.dtyear}</td>
		<td>{$thesis.dttitle}</td>
		<td>{$thesis.dtuniversity}</td>
		<td>{$thesis.dtcity}</td>
		<td>
			{if $thesis.pdfFile}
			<a href="{$thesis.pdfFile}" target="_blank">{$thesis.dtpdf}</a>
			{/if}
		</td>
		<td>{if $thesis.dtvalidated}Yes{else}No{/if}</td>
		<td>
			<a href="?id={$thesis.idthesis}"><img src="../files/icons/cross.png"></a>
		</td>
	</tr>
	{/foreach}
</table>