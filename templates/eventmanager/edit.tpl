<div class="panel panel-default">
    <div class="panel-heading">Class - {if $event}Update{else}Create{/if}</div>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="{Config::BASEURL}eventmanager/save/{$event.idevent}">
            <div class="form-group">
                <label for="inputEventType" class="col-sm-2 control-label">Event type</label>
                <div class="col-sm-10">
                    <select class="form-control" id="inputEventType" name="fievent_type">
                        <option></option>
                        {foreach $types as $type}
                        <option value="{$type.idevent_type}"{if $type.idevent_type eq $event.fievent_type} selected="selected"{/if}>{$type.dtname}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputDate" class="col-sm-2 control-label">Date</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputDate" placeholder="dd/mm/yyyy" name="dtdate" value="{$event.dtdate}" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputTime" class="col-sm-2 control-label">Time</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTime" placeholder="hh:mm" name="dttime" value="{$event.dttime}" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputDuration" class="col-sm-2 control-label">Duration</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputDuration" placeholder="minutes" name="dtduration" value="{$event.dtduration}" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">{if $event}Update{else}Create{/if}</button>
                </div>
            </div>
        </form>
    </div>
</div>
