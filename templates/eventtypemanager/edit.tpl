<div class="panel panel-default">
    <div class="panel-heading">Classtype - {if $type.idevent_type}Update{else}Create{/if}</div>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="{Config::BASEURL}eventtypemanager/save/{$type.idevent_type}">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="dtname" value="{$type.dtname}" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputDescription" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="inputDescription" name="dtdescription">{$type.dtdescription}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">{if $type.idevent_type}Update{else}Create{/if}</button>
                </div>
            </div>
        </form>
    </div>
</div>
