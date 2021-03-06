{foreach $weeks as $week}
<div class="panel panel-default">
    <div class="panel-heading">Week: {$week.label}</div>
    <div class="table-responsive">
        <table class="table table-striped">
            {foreach $week.events as $date => $events}
            <thead>
                <tr>
                    <th colspan="4">{$date}</th>
                </tr>
            </thead>
            <tbody>
                {foreach $events as $event}
                <tr{if $event.dtsubscribed} class="success"{/if}>
                    <td>{$event.dtname}</td>
                    <td>{$event.from} - {$event.to}</td>
                    <td>
                        <span class="badge">{$event.dtcount}{if $event.dtlimit} / {$event.dtlimit}{/if}</span>
                    </td>
                    <td>
                    {if $event.dtsubscribed}
                        <a class="btn btn-danger btn-xs" href="{Config::BASEURL}event/unsubscribe/{$event.idevent}">Unsubscribe</a>
                    {elseif $event.dtcansubscribe}
                        <a class="btn btn-success btn-xs" href="{Config::BASEURL}event/subscribe/{$event.idevent}">Subscribe</a>
                    {else}
                        <em>complete</em>
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
