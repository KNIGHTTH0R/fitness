<div class="panel panel-default">
    <div class="panel-heading">Courses</div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Event</th>
                    <th>Time of day</th>
                    {if !$archive}
                    <th>Visibility</th>
                    {/if}
                    <th>Subscriptions</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {foreach $events as $event}
                <tr{if $event.dtsubscribed} class="success"{/if}>
                    <td>{$event.date} - {$event.day}</td>
                    <td>{$event.dtname}</td>
                    <td>{$event.from} - {$event.to} ({$event.duration} hours)</td>
                    {if !$archive}
                    <td class="text-center {if $event.dtvisible}success{else}danger{/if}">
                        {if $event.dtvisible}
                        <a class="btn btn-default btn-xs" href="{Config::BASEURL}eventmanager/hide/{$event.idevent}">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> Hide
                        </a>
                        {else}
                        <a class="btn btn-default btn-xs" href="{Config::BASEURL}eventmanager/show/{$event.idevent}">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Show
                        </a>
                        {/if}
                    </td>
                    {/if}
                    <td class="text-center">
                        <span class="badge">{$event.dtusercount}</span>
                    </td>
                    <td>
                        <a class="btn btn-default btn-xs" href="{Config::BASEURL}eventmanager/copyToNextWeek/{$event.idevent}">
                            <span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span> Copy to next week
                        </a>
                        {if !$archive}
                        <a class="btn btn-default btn-xs" href="{Config::BASEURL}eventmanager/moveToArchive/{$event.idevent}">
                            <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Move to archive
                        </a>
                        {else}
                        <a class="btn btn-default btn-xs" href="{Config::BASEURL}eventmanager/returnFromArchive/{$event.idevent}">
                            <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Return from archive
                        </a>
                        {/if}
                    </td>
                </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
</div>
