<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Day</th>
            <th>Date</th>
            <th>Event</th>
            <th>From</th>
            <th>To</th>
            <th>Duration</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {foreach $events as $event}
        <tr{if $event.dtsubscribed} class="success"{/if}>
            <td>{$event.day}</td>
            <td>{$event.date}</td>
            <td>{$event.dtname}</td>
            <td>{$event.from}</td>
            <td>{$event.to}</td>
            <td>{$event.duration} hours</td>
            <td>
            {if $event.dtsubscribed}
                <a class="btn btn-danger" href="{Config::BASEURL}event/unsubscribe/{$event.idevent}">Unsubscribe</a>
            {else}
                <a class="btn btn-success" href="{Config::BASEURL}event/subscribe/{$event.idevent}">Subscribe</a>
            {/if}
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>
