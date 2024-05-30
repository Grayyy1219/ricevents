<?php

$locations_query = "SELECT DISTINCT Location FROM events";
$locations_result = mysqli_query($con, $locations_query);
$selected_location = isset($_GET['location']) ? $_GET['location'] : '';

$items_per_page = 8;

$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$offset = ($current_page - 1) * $items_per_page;

$where_clause = '';
if ($selected_location) {
    $where_clause = "WHERE Location = '" . mysqli_real_escape_string($con, $selected_location) . "'";
}

$total_items_query = "SELECT COUNT(*) AS count FROM events $where_clause";
$total_items_result = mysqli_query($con, $total_items_query);
$total_items_row = mysqli_fetch_assoc($total_items_result);
$total_items = $total_items_row['count'];

$total_pages = ceil($total_items / $items_per_page);

$get_events = "SELECT * FROM events $where_clause LIMIT $offset, $items_per_page";
$run_events = mysqli_query($con, $get_events);
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">View Events</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = $offset;
                            while ($row_event = mysqli_fetch_array($run_events)) {
                                $event_id = $row_event['EventID'];
                                $event_title = $row_event['EventTitle'];
                                $event_description = $row_event['Description'];
                                $event_date = $row_event['Date'];
                                $event_location = $row_event['Location'];
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td class="nowrap"><?php echo $event_title; ?></td>
                                    <td><?php echo $event_description; ?></td>
                                    <td class="nowrap"><?php echo $event_date; ?></td>
                                    <td class="nowrap"><?php echo $event_location; ?></td>
                                    <td><a href="admin2.php?delete_event&eventId=<?php echo $event_id; ?>" style=" color: #337ab7; text-decoration: none; ">Delete</a></td>
                                    <td><a href="admin2.php?edit_event&eventId=<?php echo $event_id; ?>" style=" color: #337ab7; text-decoration: none; ">Edit</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <ul class="pagination">
                        <?php if ($current_page > 1) : ?>
                            <li><a href="http://localhost/ricevents/admin2.php?view_events&location=<?php echo $selected_location; ?>&page=<?php echo $current_page - 1; ?>">&laquo; Previous</a></li>
                        <?php endif; ?>

                        <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                            <li <?php if ($page == $current_page) echo 'class="active"'; ?>>
                                <a href="http://localhost/ricevents/admin2.php?view_events&location=<?php echo $selected_location; ?>&page=<?php echo $page; ?>"><?php echo $page; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($current_page < $total_pages) : ?>
                            <li><a href="http://localhost/ricevents/admin2.php?view_events&location=<?php echo $selected_location; ?>&page=<?php echo $current_page + 1; ?>">Next &raquo;</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination ul {
        list-style-type: none;
        padding: 0;
    }

    .pagination li {
        display: inline;
        margin: 0 5px;
    }

    .pagination li a {
        text-decoration: none;
        color: #007bff;
    }

    .pagination li.active a {
        font-weight: bold;
        text-decoration: underline;
    }
</style>