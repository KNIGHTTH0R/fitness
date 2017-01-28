<div class="panel panel-default">
    <div class="panel-heading">
        Users
        <input id="searchInput" class="form-control" placeholder="Search" value="{$search}" />
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="userList">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>E-Mail</th>
                    <th>Telephone</th>
                    <th>Birthdate</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody id="rowsContainer">
            </tbody>
        </table>
        <div id="loadingOverlay" class="loadingOverlay hidden"></div>
    </div>
</div>
<script src="{Config::BASEURL}js/usermanager/list.js"></script>
