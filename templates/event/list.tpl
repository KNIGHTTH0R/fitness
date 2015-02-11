<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Day</th>
            <th>Date</th>
            <th>Event</th>
            <th>From</th>
            <th>To</th>
            <th>Duration</th>
        </tr>
    </thead>
    <tbody>
        {foreach $events as $event}
        <tr>
            <td>{$event.day}</td>
            <td>{$event.date}</td>
            <td>{$event.dtname}</td>
            <td>{$event.from}</td>
            <td>{$event.to}</td>
            <td>{$event.duration} hours</td>
        </tr>
        {/foreach}
    </tbody>
</table>
