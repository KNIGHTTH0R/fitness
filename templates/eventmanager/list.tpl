<div class="panel panel-default">
    <div class="panel-heading">Courses</div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Event</th>
                    <th>Time of day</th>
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
                    <td>{$event.dtusercount}</td>
                    <td>
                        <a class="btn btn-default" href="{Config::BASEURL}eventmanager/copyToNextWeek/{$event.idevent}">
                            <span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span> Copy to next week
                        </a>
                    </td>
                </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
</div>
