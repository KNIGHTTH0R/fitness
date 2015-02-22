{foreach $weeks as $week}
<div class="panel panel-default">
    <div class="panel-heading">Week: {$week.label}</div>
    <div class="table-responsive">
        <table class="table table-striped">
            {foreach $week.events as $date => $events}
            <thead>
                <tr>
                    <th colspan="{if $archive}5{else}6{/if}">{$date}</th>
                </tr>
                <tr>
                    <th></th>
                    <th>Event</th>
                    <th>Time of day</th>
                    {if !$archive}
                    <th class="text-center">Visibility</th>
                    {/if}
                    <th class="text-center">Subscriptions</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {foreach $events as $event}
                <tr{if $event.dtsubscribed} class="success"{/if}>
                    <td>
                        <a class="btn btn-warning btn-xs" href="{Config::BASEURL}eventmanager/edit/{$event.idevent}">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                        <a class="btn btn-danger btn-xs" href="{Config::BASEURL}eventmanager/delete/{$event.idevent}" onclick="return confirm('Are you sure?');">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>
                    </td>
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
                        <a class="btn btn-default btn-xs" href="{Config::BASEURL}eventmanager/subscriptions/{$event.idevent}">
                            Manage <span class="badge">{$event.dtusercount}</span>
                        </a>
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
            {/foreach}
        </table>
    </div>
</div>
{/foreach}
