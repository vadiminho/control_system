<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Users table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href="styles.css" rel="stylesheet">


<div class="d-flex justify-content-center">
    <div class="btn-group">
        <button type="button" class="btn btn-primary mr-3" data-toggle="modal" id="addUser" data-target="#saveUsers">Add
            User
        </button>
        <div class="btn-group">
            <select class="select" aria-label="Default select example" id="selectAction"
                    name="selectAction">
                <option value="">Please select</option>
                <option value="1">Set active</option>
                <option value="0">Set not active</option>
                <option value="Delete">Delete</option>
            </select>
        </div>
        <button type="button" id="btn_delete" class="update btn btn-primary ml-3">Ок</button>
    </div>
</div>
<?php
$role = [1 => "Admin", 2 => "User"];
?>

<!-- Modal -->
<div class="modal fade" id="saveUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="saveStudent">
                <div class="modal-body">

                    <div id="errorMessage" class="alert alert-warning d-none"></div>
                    <input type="hidden" name="user_id" id="user_id">

                    <div class="mb-3">
                        <label for="first-name">First Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Role: </label>
                        <select class="custom-select my-1 mr-sm-2" id="role" name="role">
                            <?php
                            foreach ($role as $key => $value):
                                //use  value attr
                                echo '<option value=' . $value . '>' . $value . '</option>';
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input form-control"
                                   id="switcher"
                                   name="switcher">
                            <label class="switcher custom-control-label" for="switcher" id="switcher"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="exit" class="btn btn-secondary">Close</button>
                    <button type="button" id="save" class="update btn btn-primary">Ок</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<div class="container">
    <div class="row flex-lg-nowrap mt-3">
        <div class="col">
            <div class="row flex-lg-nowrap">
                <div class="col mb-3">
                    <div class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>Users</span></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="UsersTable">
                                        <thead>
                                        <tr>
                                            <th class="align-top">
                                                <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                                                    <input type="checkbox" id="all-items" name="sample" value="false"
                                                           class="SelectAll custom-control-input"/>
                                                    <label class="custom-control-label" for="all-items"></label>
                                                </div>
                                            </th>
                                            <th class="max-width">Name</th>
                                            <th class="max-width">Last Name</th>
                                            <th class="sortable">Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        require 'db.php';
                                        $sql = "SELECT * FROM user ORDER BY id";
                                        $query = $pdo->prepare($sql);
                                        $query->execute([]);
                                        $users = $query->fetchAll(PDO::FETCH_ASSOC);


                                        foreach ($users as $user) {
                                            ?>
                                            <tr class="tr_<?= $user['id']; ?>">
                                                <td class="align-middle">
                                                    <div id="checkboxlist"
                                                         class="CheckboxList custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                        <input type="checkbox"
                                                               class="custom-control-input" id="<?= $user['id']; ?>"
                                                               value="<?= $user['id']; ?>">
                                                        <label class="custom-control-label"
                                                               for="<?= $user['id']; ?>"></label>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap align-middle"><?= $user['name']; ?></td>
                                                <td class="text-nowrap align-middle"><?= $user['lastname']; ?></td>
                                                <td class="text-nowrap align-middle">
                                                    <span><?= $user['role']; ?></span>
                                                </td>
                                                <td class="text-center align-middle"><i
                                                            class="fa fa-circle <?= "color" . "-" . $user['switch']; ?>"></i>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="btn-group align-top">
                                                        <button class="editUserBtn btn btn-sm btn-outline-secondary badge"
                                                                type="button" name="editUserBtn"
                                                                value="<?= $user['id']; ?>">Edit
                                                        </button>
                                                        <button class="deleteUserBtn btn btn-sm btn-outline-secondary badge"
                                                                type="button" id="deleteUserBtn"
                                                                value="<?= $user['id']; ?>"><i
                                                                    class="fa fa-trash"></i></button>
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#saveUsers">Add
                        User
                    </button>
                    <div class="btn-group">
                        <select class="select" aria-label="Default select example" id="selectSecondAction"
                                name="selectSecondAction">
                            <option value="">Please select</option>
                            <option value="1">Set active</option>
                            <option value="0">Set not active</option>
                            <option value="Delete">Delete</option>
                        </select>
                    </div>
                    <button type="button" id="btn_second_delete" class="update btn btn-primary ml-3">Ок</button>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="checkboxMessage">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Please select atleast one checkbox</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="actionMessage">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Please select the action</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                            </button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="deleteMessage">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure that you want to delete this data <span class="deleteUserMessage"></span>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                            </button>
                            <button type="button" class="btn btn-primary" id="commit">Ok</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="deleteOneUserMessage">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure that you want to delete <span class="deleteOneMessage"></span>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                            </button>
                            <button type="button" class="btn btn-primary" id="second_commit">Ok</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="notExistModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <script>

                $(document).on('click', '#exit', function () {
                    $('#saveUsers').find('h5').text('Add User');
                    $('#saveUsers').find("input[type=text],input[type=hidden]").val('').end().find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
                    $('#saveUsers').modal('hide');
                });

                $(document).on('click', '#save', function () {

                    let id = $("#user_id").val();
                    let name = $("#name").val();
                    let lastname = $("#lastname").val();
                    let role = $("#role").val();
                    let switcher = $("#switcher").prop('checked');

                    if (name.length === 0 || lastname.length === 0) {
                        alert('fill the input');
                        return false;
                    }

                    $.ajax({
                        url: 'insert.php',
                        type: 'POST',
                        cache: false,
                        data: {
                            'user_id': id,
                            'name': name,
                            'lastname': lastname,
                            'role': role,
                            'switcher': switcher
                        },
                        dataType: 'html',
                        success: function (response) {
                            let res = jQuery.parseJSON(response);
                            if (res.method === 'insert') {
                                $('#UsersTable').append('<tr class="tr_' + res.user.id + '">' +
                                    '<td><div id="checkboxlist" class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">' +
                                    '<input type="checkbox" class="custom-control-input" id="' + res.user.id + '" value="' + res.user.id + '">' +
                                    '<label class="custom-control-label" for="' + res.user.id + '"></label>' +
                                    '</div>' +
                                    '</td>' +
                                    '<td class="text-nowrap align-middle">' + res.user.name +
                                    '</td>' +
                                    '<td class="text-nowrap align-middle">' + res.user.lastname +
                                    '</td>' +
                                    '<td class="text-nowrap align-middle">' + '<span>' + res.user.role + '</span>' +
                                    '</td>' +
                                    '<td class="text-center align-middle">' + '<i class="fa fa-circle color-' + res.user.switch + '">' + '</i>' +
                                    '</td>' +
                                    '<td class="text-center align-middle"' +
                                    '<div class="btn-group align-top">' +
                                    '<button class="editUserBtn btn btn-sm btn-outline-secondary badge" type="button" name="editUserBtn" value="' + res.user.id + '">Edit </button>' +
                                    '<button class="deleteUserBtn btn btn-sm btn-outline-secondary badge" type="button" id="deleteUserBtn" value="' + res.user.id + '"><i class="fa fa-trash"></i></button>' +
                                    '</div>' +
                                    '</tr>' +
                                    '</tr>'
                                );
                                $('#checkboxlist input[type=checkbox]').prop('checked', false);
                                $('#all-items').prop('checked', false);
                                $('#saveUsers').find("input[type=text]").val('').end().find("input[type=checkbox], input[type=radio],input[type=hidden]").prop("checked", "").end();
                                $('#saveUsers').modal('hide');

                            } else if (res.method === 'update') {

                                $('#UsersTable .tr_' + res.user.id).find("td").eq(1).html(res.user.name);
                                $('#UsersTable .tr_' + res.user.id).find("td").eq(2).html(res.user.lastname);
                                $('#UsersTable .tr_' + res.user.id).find("td").eq(3).html(res.user.role);
                                $('#UsersTable .tr_' + res.user.id).find("td").eq(4).html('<i class="fa fa-circle color-' + res.user.switch + '">');

                                $('#saveUsers').find('h5').text('Add User');
                                $('#saveUsers').find("input[type=text],input[type=hidden]").val('').end().find("input[type=checkbox], input[type=radio],input[type=hidden]").prop("checked", "").end();
                                $('#saveUsers').modal('hide');
                            }
                        }

                    });
                });

                $("#UsersTable").on('click', '#deleteUserBtn', function () {
                    let user_id = $(this).val();
                    let name = $("#UsersTable .tr_" + user_id).find("td:eq(1)").text();
                    $('#deleteOneUserMessage').modal();
                    $('#deleteOneUserMessage').find(".deleteOneMessage").text(name);
                    $('#second_commit').on("click", function () {
                        $.ajax({
                            type: "GET",
                            url: "delete.php?user_id=" + user_id,
                            success: function (response) {
                                let res = jQuery.parseJSON(response);
                                if (res.status === true) {
                                    $("#UsersTable .tr_" + user_id).remove();
                                    $('#deleteOneUserMessage').modal('hide');
                                    $('#notExistModal').modal('hide');
                                } else if (res.status === false) {
                                    $('#notExistModal').modal().find('.modal-body p').text(res.error['message'] + ', please refresh the page');
                                    $('#deleteOneUserMessage').modal('hide');
                                }
                            }
                        });
                    });

                });


                $('.SelectAll').on('change', function (e) {
                    var $inputs = $('#checkboxlist input[type=checkbox]');
                    if (e.originalEvent === undefined) {
                        var allChecked = true;
                        $inputs.each(function () {
                            allChecked = allChecked && this.checked;
                        });
                        this.checked = allChecked;
                    } else {
                        $inputs.prop('checked', this.checked);
                    }
                });

                $('#UsersTable').on('change', ' #checkboxlist input[type=checkbox]', function () {
                    $('.SelectAll').trigger('change');
                });


                $('#UsersTable').on('click', '.editUserBtn', function () {
                    var user_id = $(this).val();
                    $('#saveUsers').find('h5').text('Update User');
                    $.ajax({
                        type: "GET",
                        url: "edit.php?user_id=" + user_id,
                        success: function (response) {
                            let res = jQuery.parseJSON(response);
                            if (res.status === true) {
                                $("#user_id").val(res.data.id);
                                $('#name').val(res.data.name);
                                $('#lastname').val(res.data.lastname);
                                $('#role').val(res.data.role);
                                if (res.data.switch == 1) {
                                    $('#switcher').prop('checked', 1);
                                } else {
                                    $('#switcher').prop('checked', 0);
                                }
                                $('#saveUsers').modal('show');
                            } else if (res.status === false) {
                                $('#notExistModal').modal().find('.modal-body p').text(res.error['message']);
                            }

                        }
                    });

                });


                $(document).ready(function () {
                    $('#btn_delete').click(function (evt) {
                        let action = $("#selectAction option:selected").val();
                        if ($('#selectAction').val() === '') {
                            $('#actionMessage').modal();
                            evt.preventDefault();
                        } else {
                            var id = [];
                            $(':checkbox:checked').each(function (i) {
                                id[i] = $(this).val();
                            });
                            if (id.length === 0) {
                                $('#checkboxMessage').modal();
                                evt.preventDefault();
                            } else if (action === 'Delete') {
                                $('#deleteMessage').modal();
                                $('#commit').on("click", function () {
                                    $.ajax({
                                        url: 'action.php',
                                        method: 'POST',
                                        data: {'id': id, 'selectAction': action},
                                        success: function (response) {
                                            var res = jQuery.parseJSON(response);
                                            if (res.status === true) {
                                                $('td input:checked').closest('tr').remove();
                                                $('#all-items').prop('checked', false);
                                                $('#deleteMessage').modal('hide');
                                            } else if (res.status === false) {
                                                $('#notExistModal').modal().find('.modal-body p').text(res.error['message']);
                                                $('#deleteMessage').modal('hide');
                                            }

                                        }

                                    });
                                });
                            } else {
                                $.ajax({
                                    url: 'action.php',
                                    method: 'POST',
                                    data: {'id': id, 'selectAction': action},
                                    success: function (response) {
                                        var res = jQuery.parseJSON(response);
                                        if (res.status === true) {
                                            $('td input:checked').closest("tr").find("i:first").replaceWith('<i class="fa fa-circle color-' + action + '">');
                                            $('#all-items').prop('checked', false);
                                            $('td input:checked').prop('checked', false);
                                        } else if (res.status === false) {
                                            $('#notExistModal').modal().find('.modal-body p').text(res.error['message']);
                                        }

                                    }

                                });
                            }
                        }

                    });
                });


                $(document).ready(function () {

                    $('#btn_second_delete').click(function (evt) {
                        let action = $("#selectSecondAction option:selected").val();
                        if ($('#selectSecondAction').val() === '') {
                            $('#actionMessage').modal();
                            evt.preventDefault();
                        } else {
                            var id = [];
                            $(':checkbox:checked').each(function (i) {
                                id[i] = $(this).val();
                            });
                            if (id.length === 0) {
                                $('#checkboxMessage').modal();
                                evt.preventDefault();
                            } else if (action === 'Delete') {
                                $('#deleteMessage').modal();
                                $('#commit').on("click", function () {
                                    $.ajax({
                                        url: 'secondAction.php',
                                        method: 'POST',
                                        data: {'id': id, 'selectSecondAction': action},
                                        success: function (response) {
                                            var res = jQuery.parseJSON(response);
                                            if (res.status === true) {
                                                $('td input:checked').closest('tr').remove();
                                                $('#all-items').prop('checked', false);
                                                $('#deleteMessage').modal('hide');
                                            } else if (res.status === false) {
                                                $('#notExistModal').modal().find('.modal-body p').text(res.error['message']);
                                                $('#deleteMessage').modal('hide');
                                            }

                                        }

                                    });
                                });
                            } else {
                                $.ajax({
                                    url: 'secondAction.php',
                                    method: 'POST',
                                    data: {'id': id, 'selectSecondAction': action},
                                    success: function (response) {
                                        var res = jQuery.parseJSON(response);
                                        if (res.status === true) {
                                            $('td input:checked').closest("tr").find("i:first").replaceWith('<i class="fa fa-circle color-' + action + '">');
                                            $('#all-items').prop('checked', false);
                                            $('td input:checked').prop('checked', false);
                                        } else if (res.status === false) {
                                            $('#notExistModal').modal().find('.modal-body p').text(res.error['message']);
                                        }

                                    }

                                });
                            }


                        }

                    });
                });

            </script>

</body>
</html>