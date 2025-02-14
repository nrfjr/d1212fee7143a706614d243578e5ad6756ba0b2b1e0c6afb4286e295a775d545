<?php
$title = 'Manage Users';
require APPROOT . '/views/inc/header.php';
require APPROOT . '/views/inc/sidebar.php';

// components for pagination 

$users = $data;

$total_users = count($users);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$limit = 10;

if (!empty($current_page) && $current_page > 1) {
    $offset = ($current_page * $limit) - $limit;
} else {
    $offset = 0;
}

$total_pages = ceil($total_users / $limit);

$first_user_displayed = $offset + 1;

$last_user_displayed = $total_users >= ($offset * $limit) + $limit ? $offset + $limit : $total_users;

if ($first_user_displayed === $last_user_displayed) {
    $range = 'the Last of ' . $total_users . ' Users';
} else {
    $range = $first_user_displayed . ' - ' . $last_user_displayed . ' of ' . $total_users . ' Users ';
}
// components for pagination 
?>

<h1 class="text-3xl text-black pb-6 text-white"><b>Manage Users</b></h1>

<div class="flex justify-between items-center pb-4 bg-gray-600 ">
        <div class="z-10">
            <button id="dropdownDefault" data-dropdown-toggle="dropdown-createuser" class="inline-flex items-center text-black bg-green-300 focus:outline-none hover:bg-green-700  font-medium rounded-lg text-sm px-3 py-2  hover:text-white" type="button">
                Create
                <i class="fas fa-chevron-down ml-2"></i>
            </button>
            <div id="dropdown-createuser" class="whitespace-normal hidden w-fit bg-white rounded-md divide-y divide-gray-100 shadow max-h-48 overflow-y-auto scrollbar-hide">
                <ul class="text-sm text-gray-700" aria-labelledby="dropdownDefault">
                    <?php 
                    $db_array = array_slice(array_keys(ORACLE_DBS),1);
                    $first_db = reset($db_array);
                    $last_db = end($db_array);
                    foreach (ORACLE_DBS as $host) {
                        if ($host != 'DEFAULT') { ?>
                            <li class="block py-2 px-4 hover:bg-gray-400 hover:text-white <?php if($host == $first_db){echo 'rounded-t-md';}elseif($host == $last_db){echo 'rounded-b-md';}?>">
                                <a href="<?php echo URLROOT; ?>/users/create/<?php echo $host ?>" class="transition delay-100"><?php echo $host ?></a>
                            </li>
                    <?php }
                    } ?>
                </ul>
            </div>
        </div>
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative absolute">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                <i class="fas fa-search w-5 h-5 text-gray-500"></i>
            </div>
            <form action="<?php echo URLROOT; ?>/users/show" method="POST">
                <div class="flex justify-auto">
                    <input type="text" id="searchuser" name="searchuser" value="<?php echo isset($_SESSION['Search']) ? $_SESSION['Search'] : ''; ?>" class="block mr-4 p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg" placeholder="Search for users">
                    <button id="dropdownRadioButton" class="inline-flex items-center text-black bg-blue-200 focus:outline-none hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
<div class="overflow-x-auto relative shadow-md rounded-lg">
    <div style="height: fit-content; overflow: clip;" class="rounded-lg">
        <div class="block w-full shadow-md overflow-auto rounded-lg" style="max-height: 66vh;">
            <?php
            if (!empty($users)) {

                //Separates Column title from result set
                foreach ($data as $outer_key => $array) {

                    foreach ($array as $inner_key => $value) {
                        $column_names[] = $inner_key;
                    }
                }
            ?>
                <table class="sortable w-full text-sm text-left text-white">
                    <thead class="cursor-pointer text-xs text-black bg-indigo-200 sticky top-0">
                        <tr>
                            <?php for ($title = 0; $title <= count($array) - 1; $title++) { ?>
                                <th scope="col" class="py-2 px-6">
                                    <?php echo $column_names[$title]; ?>
                                </th>
                            <?php } ?>
                            <th scope="col" class="py-2 px-6">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-500">
                        <?php
                        $users = array_slice($users, $offset, $limit);

                        foreach ($users as $column_title => $value) {
                        ?>
                            <tr class="transition delay-50 focus:hover:bg-gray-700 hover:bg-gray-700">
                                <?php
                                foreach ($value as $user) {
                                ?>
                                    <td class="item py-4 px-6">
                                        <?php echo $user; ?>
                                    </td>
                                <?php
                                }
                                ?>
                                <td class="item py-4 px-4 text-center">
                                    <form action="<?php echo URLROOT; ?>/users/edit/<?php echo $value['ID'] ?>" method="POST">
                                        <input id="edit_db" name="edit_db" value="<?php echo $value['DB Name'] ?>" class="hidden">
                                        <button type="submit" alt="Edit" class="px-2">
                                            <font color="#005eff" title="Edit User">
                                                <i class="fas mt-1 fa-user-edit ml-2 hover:bg-blue-200 rounded-lg w-6 h-6"></i>
                                            </font>
                                        </button>
                                    </form>
                                    <div x-data="{toSubmit: false}">
                                        <button @click="toSubmit = true" alt="Delete" class="border-blue-500 md:border-green-500">
                                            <font color="#b00020" title="Deactivate User">
                                                <i class="fas mt-1 fa-user-times ml-2 hover:bg-red-200 rounded-lg w-6 h-6"></i>
                                            </font>
                                        </button>
                                        <button x-show="toSubmit" @click="toSubmit = false" alt="Delete" class="border-blue-500 md:border-green-500">
                                        </button>
                                        <!-- Delete User Modal -->
                                        <div x-show="toSubmit" class="border-double border-2 border-red-500 absolute left-1/4 top-1/2 z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                            <div class="modal fixed fade justify-center mr-48 top-72 w-5/12 h-full outline-none overflow-x-hidden overflow-y-auto" id="ModalCenteredScrollable" tabindex="-1" aria-labelledby="ModalCenteredScrollable" aria-modal="true" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable relative pointer-events-none w-auto">

                                                    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                                        <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                                            <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalCenteredScrollableLabel">
                                                                <b>Confirm User Deactivation</b>
                                                            </h5>
                                                            <button type="button" @click="toSubmit = false" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body relative p-4">
                                                            <font color="black"><?php echo 'Are you sure to deactivate ' . $value['Username'] . '?' ?></font>
                                                        </div>
                                                        <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                                                            <form action="<?php echo URLROOT; ?>/users/delete/<?php echo $value['Username'] ?>" method="POST">
                                                                <input id="delete_db" name="delete_db" value="<?php echo $value['DB Name'] ?>" class="hidden">
                                                                <button type="submit" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-700 px-4 py-2 text-base font-medium text-white shadow-sm focus:outline-none focus:ring-2  focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Proceed</button>
                                                            </form>
                                                            <button type="button" @click="toSubmit = false" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete User Modal -->
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
        </div>
    </div>
    <div class="sm:flex sm:flex-1 sm:justify-between py-4 relative">
        <div>
            <p class="text-sm text-white pl-2">
                Showing <?php
                        echo $range;
                        ?>
            </p>
        </div>

        <?php

                if ($total_pages > 1) { ?>

            <nav class="shadow-sm absolute right-0 bottom-2" aria-label="Pagination">
                <ul class="pagination inline-flex items-center -space-x-px">

                    <?php
                    if ($current_page > 1) { ?>

                        <li class="page-item"><a class="page-link block px-3 py-2 ml-0 leading-tight text-gray-700 bg-indigo-200 border border-gray-300 rounded-l-md hover:bg-gray-100" href="<?php echo '?page=1'; ?>">First</a></li>

                        <?php
                    }
                    for ($page_in_loop = 1; $page_in_loop <= $total_pages; $page_in_loop++) {
                        if ($total_pages > 3) {
                            if (($page_in_loop >= $current_page - 5 && $page_in_loop <= $current_page)  || ($page_in_loop <= $current_page + 5 && $page_in_loop >= $current_page)) {  ?>

                                <li class="page-item">
                                    <a class="page-link px-3 py-2 leading-tight <?php echo $page_in_loop == $current_page ? 'text-blue-500 pointer-events-none bg-indigo-50' : 'text-gray-700 bg-indigo-200'; ?> <?php echo $page_in_loop == 1 && $current_page == 1 ? 'rounded-l-md' : ''; ?> <?php echo $page_in_loop == $total_pages && $current_page == $total_pages ? 'rounded-r-md' : ''; ?> border border-gray-300 hover:bg-gray-100 hover:text-gray-700" href="<?php echo '?page=' . $page_in_loop; ?> "><?php echo $page_in_loop; ?></a>
                                </li>

                            <?php }
                        } else { ?>

                            <li class="page-item">
                                <a class="page-link px-3 py-2 leading-tight <?php echo $page_in_loop == $current_page ? 'text-blue-500 pointer-events-none bg-indigo-50' : 'text-gray-700 bg-indigo-200'; ?> <?php echo $page_in_loop == 1 && $current_page == 1 ? 'rounded-l-md' : ''; ?> <?php echo $page_in_loop == $total_pages && $current_page == $total_pages ? 'rounded-r-md' : ''; ?> border border-gray-300 hover:bg-gray-100 hover:text-gray-700" href="<?php echo '?page=' . $page_in_loop; ?>"><?php echo $page_in_loop; ?></a>
                            </li>

                        <?php }
                        ?>
                    <?php }

                    if ($current_page < $total_pages) { ?>

                        <li class="page-item"><a class="page-link block px-4 py-2 leading-tight text-gray-700 bg-indigo-200 border border-gray-300 rounded-r-md hover:bg-gray-100" href="<?php echo '?page=' . $total_pages; ?>">Last</a></li>

                    <?php } ?>
                </ul>
            </nav>

        <?php }
        ?>
        <div>

        </div>
    </div>
<?php
            } else {
?>
    <div class="flex w-full shadow-md overflow-auto rounded-lg bg-gray-500" style="max-height: 80%; min-height: 100%;">
        <h1 class="text-white m-auto "><b>No Users Found.</b></h1>
    </div>
<?php
            }
?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>