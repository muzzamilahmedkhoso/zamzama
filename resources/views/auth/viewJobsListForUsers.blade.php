@include('includes._normalUserNavigation')
<br />
<div class="container-fluid">
    <div class="well">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="well">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span class="subHeadingLabelClass">View Jobs List</span>
                                </div>
                            </div>
                            <div class="lineHeight">&nbsp;</div>
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered sf-table-list">
                                                    <thead>
                                                        <th class="text-center col-sm-1">S.No</th>
                                                        <th class="text-center">Job Title</th>
                                                        <th class="text-center">Employer Name</th>
                                                        <th class="text-center">Department</th>
                                                        <th class="text-center">Job Type</th>
                                                        <th class="text-center col-sm-1">Action</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $counter = 1;?>
                                                        @foreach($jobs as $key => $y)
                                                            <tr>
                                                                <td class="text-center"><?php echo $counter++;?></td>
                                                                <td><?php echo $y->job_title;?></td>
                                                                <td><?php echo $y->employer_id;?></td>
                                                                <td><?php echo $y->department_id;?></td>
                                                                <td><?php echo $y->job_type_id;?></td>
                                                                <td class="text-center">
                                                                    <a onclick="showDetailModelOneParamerter('nu/ViewandApplyDetail','<?php echo $y->id;?>','View and Apply Job Detail')" class="btn btn-xs btn-success">Apply Job</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showDetailModelOneParamerter(url,id,modalName){
        $.ajax({
            url: '<?php echo url('/')?>/'+url+'',
            type: "GET",
            data: {id:id},
            success:function(data) {
                
                jQuery('#showDetailModelOneParamerter').modal('show', {backdrop: 'false'});
                jQuery('#showDetailModelOneParamerter .modalTitle').html(modalName);
                jQuery('#showDetailModelOneParamerter .modal-body').html('<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="loader"></div></div></div>');
                setTimeout(function(){
                    jQuery('#showDetailModelOneParamerter .modal-body').html(data);
                },1000);
                
                
            }
        });
    }
</script>
<div class="modal fade" id="showDetailModelOneParamerter">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style=" padding: 15px; background-color: #f7f7f7; border-bottom: 5px solid #9170E4; width: 100%;">
                <div class="row">
                    <div class="col-md-4 col-sm-1 col-xs-12 text-center">
                        <a style="float: left; font-size: 15px; 
                        color: #9170E4; margin-right:10px; margin: -9px 0px -31px 0px;" class="triangle-obtuse top">Logo Area</a>
                    </div>
                    <div class="col-md-4 col-sm-1 col-xs-12 text-center">
                        <span class="modalTitle subHeadingLabelClass"></span>
                    </div>
                    <div class="col-md-4 col-sm-1 col-xs-12 text-right">
                        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
                    </div>
                </div>
            </div>
            <div  class="modal-body"></div>
            <div class="modal-footer" style=" padding: 15px; background-color: #f7f7f7; border-top: 5px solid #9170E4; width: 100%;">
                <div class="row">
                    <div class="text-center">
                        &copy; <?php echo date('Y')?> Innovative-net.com |<a href="http://www.innovative-net.com/" target="_blank"  > Designed by : innovative-net.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>