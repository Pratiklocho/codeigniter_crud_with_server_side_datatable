<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to CodeIgniter</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
        <style>
            td {
                text-align: left !important;
            }
        </style>
        <style>
            tfoot input {
                width: 100%;
                padding: 3px;
                box-sizing: border-box;
            }

            tfoot {
                display: table-header-group;
            }
        </style>
    </head>
    <body>
        <section class="panel">
            <header class="panel-heading tab-bg-dark-navy-blue ">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#home">Home</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#about">ADD</a>
                    </li>

                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content">
                    <div id="home" class="tab-pane active">
                        <table id="sim"
                               class="table table-responsive table-striped table-bordered table12"
                               width="100%">
                            <thead>
                                <tr>
                                    <th><span>#</span></th>
                                    <th><span>Name</span></a></th>
                                    <th><span>Email</span></a></th>
                                    <th><span>Date</span></a></th>
                                    <th><span>Gender</span></a></th>
                                    <th><span>Image</span></th>
                                    <th><span>Action</span></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th><span>#</span></th>
                                    <th><span>Name</span></a></th>
                                    <th><span>Email</span></a></th>
                                    <th><span>Date</span></a></th>
                                    <th><span>Gender</span></a></th>
                                    <th><span>Image</span></th>
                                    <th><span>Action</span></th>
                                </tr>
                            </tfoot>
                            <tbody id="tbody">

                            </tbody>

                        </table>
                    </div>
                    <div id="about" class="tab-pane">
                        <form name="ff" method="post" action="<?php echo base_url(); ?>Welcome/addData" enctype="multipart/form-data">
                            <div class="row">

                                <div class='col-sm-12'>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="party_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control" name="date"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class='col-sm-12'>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Gender</label><br>
                                            <input type="radio" name="gender" value="M">Male
                                            <input type="radio" name="gender" value="F">Female
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <input type="submit" name="b" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>



        <!--  Edit Modal start -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <form method="post" action="<?php echo base_url() ?>Welcome/Edit" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Bill</h4>
                        </div>
                        <div class="modal-body">
                            <!--<div class="row rowmsg"></div>-->
                            <div class="row">
                                <input type="hidden" name="id" id="hid"/>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="party_name" id="party_name" class="form-control">
<!--                                            <select class="select12 form-control" name="party_name"
                                                    id="name">
                                                <option></option>
                                            <?php foreach ($party_name as $dt): ?>
                                                                                                                <option value="<?php echo $dt['reg_id']; ?>"><?php echo $dt['name']; ?></option>
                                            <?php endforeach; ?>
                                            </select>-->
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" id="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <div class='input-group date' id='datetimepicker2'>
                                                <input type='text' class="form-control" id="dd" name="date"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class='col-sm-12'>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="images" class="form-control">
                                        </div>
                                        <div id="image"></div>
                                    </div>
                                    <span id="img"></span>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Gender</label><br>
                                            <input type="radio" name="gender" id="gn" value="M">Male
                                            <input type="radio" name="gender" id="gna" value="F">Female
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-success" id="submit">Update</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!--  Edit Modal End -->
    </body>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="http://me.missethnik.com/admin/js/dataTables.responsive.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Area Name
            $(".select1").select2({
                width: '100%',
                containerCssClass: ':all:'
            });
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
            $(function () {
                $('#datetimepicker2').datetimepicker();
            });
        });
    </script>
    <script>
        var tbl = 'reg';
        var cntrl = '<?php echo $this->uri->segment(1); ?>';
        var tabs = $('.table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo base_url('Welcome/GetData'); ?>"
        });
        $('.table tfoot th').each(function (colIdx) {
            var abc = $(".table").find("tr:first th").length;
            if (colIdx == 0 || colIdx == parseInt(abc) - 1 || colIdx == parseInt(abc) - 2) {
                $(this).html('');
            } else {
                var title = $(this).text();
                $(this).html('<input type="text" />');
            }
        });

        tabs.columns().every(function (colIdx) {
            var that = this;
            $('input', tabs.column(colIdx).footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                            .column(colIdx)
                            .search(this.value)
                            .draw();
                }
            });
        });

        $('#tbody').on('click', '.status', function () {
            var id = $(this).data('id');
            var st = $(this).data('status');

            if (st == "D") {
                var msg = "You won't be deactive this menu?";
                var btn = 'Yes, De-active it!';
                var title = "De-Activate";
            } else {
                var msg = "You won't be active this menu?";
                var btn = 'Yes, Active it!';
                var title = "Activate";
            }

            swal({
                title: 'Are you sure?',
                text: msg,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: btn,
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function () {
                $.ajax({
                    type: 'post',
                    data: {'id': id, 'status': st, 'tbl': tbl},
                    url: '<?php echo base_url('Welcome/change_status'); ?>',
                    dataType: 'json',
                    success: function (data) {
                        if (data == 1) {
                            swal(
                                    'Successfully!',
                                    'Selected Menu has been ' + title + '.',
                                    'success'
                                    )
                            tabs.draw();
                        }
                    }
                });
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                            )
                }
            })
        });
        $('#tbody').on('click', '.delete', function () {
            var id = $(this).data('id');
            var st = $(this).data('status');
            swal({
                title: 'Are you sure?',
                text: "You won't be delete this menu",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function () {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url('Welcome/change_status'); ?>',
                    data: {'id': id, 'status': st, 'tbl': tbl},
                    dataType: 'html',
                    success: function (data) {
                        if (data == 1) {
                            swal(
                                    'Successfully!',
                                    'Selected Menu has been  Deleted.',
                                    'success'
                                    )
                            tabs.draw();
                        }
                    }
                });
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                            'Cancelled',
                            'Your imaginary menu is safe :)',
                            'error'
                            )
                }
            })
        });
        $('#tbody').on('click', '.edit', function () {
            var id = $(this).data('id');
            $.ajax({
                type: 'post',
                data: {'id': id, 'tbl': tbl},
                url: '<?php echo base_url('Welcome/GetEditData'); ?>',
                dataType: 'json',
                success: function (data) {
                    console.log(data);

                    var date = new Date(data.reg_date);
                    var mm = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                    if (data.gender == 'M')
                    {
                        $('#gn').attr('checked', 'checked');
                    } else
                    {
                        $('#gna').attr('checked', 'checked');
                    }
                    $('#party_name').val(data.name);
                    $('#email').val(data.email);
                    $('#dd').val(mm);
                    $('#image').html('<img src="<?php echo base_url(); ?>assets/users_profile/'+data.image+'" height=100 width=100>');
                    $('#hid').val(data.reg_id);
                    $('#myModal').modal('show');
                }
            });
        });

    </script>

</html>