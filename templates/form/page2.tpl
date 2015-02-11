<div class="form page page2">
	<h2>{$title}</h2>
	<form method="POST" enctype="multipart/form-data">
		<div class="formline">
			<label for="dttitle">{$label.title}</label>
			<input type="text" name="dttitle" id="dttitle" value="{$value.dttitle|default:''}"{if $required.dttitle|default:false} class="required"{/if} />
		</div>
		<div class="formline">
			<label for="dtcity">{$label.city}</label>
			<select name="dtcity" id="dtcity" value="{$value.dtcity|default:''}" data-dojo-type="dijit/form/ComboBox"{if $required.dtcity|default:false} class="required"{/if}>
			{foreach from=$options.dtcity item=item}
				<option>{$item}</option>
			{/foreach}
			</select>
		</div>
		
		<div class="formline">
			<label for="dtuniversity">{$label.university}</label>
			<select name="dtuniversity" id="dtuniversity" value="{$value.dtuniversity|default:''}" data-dojo-type="dijit/form/ComboBox"{if $required.dtuniversity|default:false} class="required"{/if}>
			</select>
		</div>
		<script>
			require([
				'dojo/store/Memory',
				'dojo/ready'
			], function(Memory, ready) {
				var universities = {$universities};
				ready(function() {
					var citySelect = dijit.byId('dtcity');
					var universitySelect = dijit.byId('dtuniversity');
					universitySelect.set('searchAttr', 'dtuniversity');
					var updateSelect = function(city) {
						if (typeof city == 'undefined' || !universities[city]) {
							city = 'all';
						}
						universitySelect.set('store', new Memory(universities[city]));
					}

					var resetUniversity = true;
					var updateCities = function(uni){
						for (var key in universities) {
							if (key != 'all'){
								for ( var i = 0; i < universities[key]['data'].length; ++i ) {
									var myuni = universities[key]['data'][i]['dtuniversity']
									if (uni == myuni && citySelect.get('value') != key) {
										resetUniversity = false;
										citySelect.set('value',key);
										return;
									}
								}
							}
						}
					}

					citySelect.on('change', function() {
						if (resetUniversity)
							universitySelect.set('value','');
						resetUniversity = true;
						updateSelect(this.get('value'));
					});

					
					universitySelect.on('change', function() {
						if (!this.get('value') || citySelect.get('value')) {
							return;
						}
						updateCities(this.get('value'));
					});
					updateSelect();
					//updateCities();
				});
			});
		</script>
		<div class="formline">
			<label for="dtyear">{$label.year}</label>
			<input type="text" name="dtyear" id="dtyear" value="{$value.dtyear|default:''}"{if $required.dtyear|default:false} class="required"{/if} />
		</div>
		<div class="formline">
			<label for="dtresearch">{$label.research}</label>
			<input type="text" name="dtresearch" id="dtresearch" value="{$value.dtresearch|default:''}"{if $required.dtresearch|default:false} class="required"{/if} />
		</div>
		<div class="formline">
			<label for="dtsummary">{$label.summary}</label>
			<textarea name="dtsummary" id="dtsummary" maxlength="300"{if $required.dtsummary|default:false} class="required"{/if}>{$value.dtsummary|default:''}</textarea>
		</div>
		<div class="formline">
			<label for="dtkeyword1">{$label.keyword1}</label>
			<select name="dtkeyword1" id="dtkeyword1" value="{$value.dtkeyword1|default:''}" data-dojo-type="dijit/form/ComboBox"{if $required.dtkeyword1|default:false} class="required"{/if}>
				{foreach from=$options.dtkeyword item=item}
					<option>{$item}</option>
				{/foreach}
			</select>
		</div>
		<div class="formline">
			<label for="dtkeyword2">{$label.keyword2}</label>
			<select name="dtkeyword2" id="dtkeyword2" value="{$value.dtkeyword2|default:''}" data-dojo-type="dijit/form/ComboBox"{if $required.dtkeyword2|default:false} class="required"{/if}>
				{foreach from=$options.dtkeyword item=item}
					<option>{$item}</option>
				{/foreach}
			</select>
		</div>
		<div class="formline">
			<label for="dtkeyword3">{$label.keyword3}</label>
			<select name="dtkeyword3" id="dtkeyword3" value="{$value.dtkeyword3|default:''}" data-dojo-type="dijit/form/ComboBox"{if $required.dtkeyword3|default:false} class="required"{/if}>
				{foreach from=$options.dtkeyword item=item}
					<option>{$item}</option>
				{/foreach}
			</select>
		</div>
		<div class="formline">
			<label for="dtpdf">{$label.pdf}</label>
			<input type="file" name="dtpdf" id="dtpdf"{if $required.dtpdf|default:false} class="required"{/if} />
			{if $pdfFile}
			<a href="{$pdfFile}" target="_blank">{$value.dtpdf|default:'thesis.pdf'}</a>
			<input type="checkbox" name="deletePdf" value="deletePdf" /> {$label.delete}
			{/if}
		</div>		
		<div class="formline">
			<input type="submit" value="{$label.next}" />
		</div>
	</form>
</div>